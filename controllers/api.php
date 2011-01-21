<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct(); 

		// Load Media Model
		$this->load->model('media_model');             
	}
	
    /* GET types */
    function recent_get()
    {
        $media = $this->social_igniter->get_content_module('media', $limit=10);
        
        if($media)
        {
            $this->response($media, 200);
        }

        else
        {
            $this->response(array('error' => 'No media could be find'), 404);
        }
    }

	function view_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        $comments = $this->social_tools->get_comment($this->get('id'));
    	
        if($comments)
        {
            $this->response($comments, 200);
        }
        else
        {
            $this->response(array('error' => 'No comments could be found'), 404);
        }
    }

	/* POST types */
    function create_post()
    {
		if (!$this->input->post('userfile'))
		{
			if (!$this->input->post('category_id'))
			{
				$category_id = 2;//$this->social_tools->get_categories_default_user();
			}
			else
			{
				$category_id = $this->input->post('category_id');
			}
			
			$config['upload_path'] 		= config_item('uploads_folder');
			$config['allowed_types'] 	= config_item('media_images_formats');		
			$config['overwrite']		= true;
			$config['max_size']			= config_item('media_images_max_size');
			$config['max_width']  		= config_item('media_images_max_dimensions');
			$config['max_height']  		= config_item('media_images_max_dimensions');
		
			$this->load->library('upload',$config);
			
			if (!$this->upload->do_upload())
			{				
				$message	= array('status' => 'error', 'message' => $this->upload->display_errors());
			    $response	= 200;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());					
				$this->media_model->make_images($data['upload_data']['file_name'], $data['upload_data']['image_width'], $data['upload_data']['image_height'], $category_id);										
				$data['deleted'] = unlink("uploads/".$data['upload_data']['file_name']);
				$uploaded_image = $data['upload_data']['file_name'];
				
				// Values
				$viewed 	= 'Y';
				$approval	= 'Y';
	        	
		    	$content_data = array(
		    		'site_id'			=> config_item('site_id'),
					'parent_id'			=> 0,
					'category_id'		=> $category_id,
					'module'			=> 'media',
					'type'				=> 'image',
					'source'			=> 'website',
					'order'				=> 0,
		    		'user_id'			=> $this->session->userdata('user_id'),//$this->oauth_user_id,
					'title'				=> $this->input->post('title'),
					'title_url'			=> form_title_url($this->input->post('title'), $this->input->post('title_url')),
					'content'			=> $uploaded_image,
					'details'			=> '',
					'access'			=> $this->input->post('access'),
					'comments_allow'	=> 'Y',
					'geo_lat'			=> $this->input->post('geo_lat'),
					'geo_long'			=> $this->input->post('geo_long'),
					'geo_accuracy'		=> $this->input->post('geo_accuracy'),
					'viewed'			=> $viewed,
					'approval'			=> $approval,
					'status'			=> 'P'
		    	);
		    	
				$activity_data = array(			
					'title'			=> '',
					'content' 		=> $uploaded_image,
					'thumb' 		=> base_url().config_item('media_images_folder').$category_id."/small_".$uploaded_image,
					'description'	=> ''
				);
								     		
				// Insert
				$result = $this->social_igniter->add_content($content_data, $activity_data);	    	
	
		    	if ($result)
			    {
		        	$message	= array('status' => 'success', 'message' => 'Awesome we posted your '.$content_data['type'], 'data' => $result['content'], 'activity' => $result['activity']);		    
		        	$response	= 200;
		        }
		        else
		        {
			        $message	= array('status' => 'error', 'message' => 'Oops unable to add image to site');
			        $response	= 200;		        
		        }
			}
		}					
		else 
		{ 
			$message 	= array('status' => 'error', 'message' => 'No file to upload');
			$response	= 200;
		}
		
		// KLUDGY ASS SOLUTION
		// So it works with the nasty browser bug of wraping <pre></pre>
		if ($this->get('format') == 'html') $message = json_encode($message);

        $this->response($message, $response);
    }    
    
    
    /* PUT types */
    function viewed_put()
    {
		$viewed = $this->social_tools->update_comment_viewed($this->get('id'));			
    	
        if($viewed)
        {
            $this->response(array('status' => 'success', 'message' => 'Comment viewed'), 200);
        }
        else
        {
            $this->response(array('status' => 'error', 'message' => 'Could not mark as viewed'), 404);
        }    
    }   
    
    function approve_put()
    {
    	$approve = $this->social_tools->update_comment_approve($this->get('id'));	

        if($approve)
        {
            $this->response(array('status' => 'success', 'message' => 'Comment approved'), 200);
        }
        else
        {
            $this->response(array('status' => 'error', 'message' => 'Could not be approved'), 404);
        }
    } 

    /* DELETE types */
    function destroy_delete()
    {		
		// Make sure user has access to do this func
		$access = $this->social_tools->has_access_to_delete('comment', $this->get('id'));
    	
    	// Move this up to result of "user_has_access"
    	if ($access)
        {
			//$comment = $this->social_tools->get_comment($this->get('id'));
        
        	$this->social_tools->delete_comment($this->get('id'));
        
			// Reset comments with this reply_to_id
			$this->social_tools->update_comment_orphaned_children($this->get('id'));
			
			// Update Content
			$this->social_igniter->update_content_comments_count($this->get('id'));
        
        	$this->response(array('status' => 'success', 'message' => 'Comment deleted'), 200);
        }
        else
        {
            $this->response(array('status' => 'error', 'message' => 'You do not have access to delete comment!'), 404);
        }
        
    }

}
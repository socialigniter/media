<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->load->config('media');
		$this->load->helper('media');
		$this->load->library('media_igniter');
		$this->load->model('media_model');
	}
	
    function recent_get()
    {        
        if($media = $this->social_igniter->get_content_module('media', $limit=10))
        {
            $message = array('status' => 'success', 'message' => 'Yay media was found', 'data' => $media);
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'No media could be find');
        }

        $this->response($message, 200);
    }

	function view_get()
    {
        if($this->get('id'))
        {
	        $comments = $this->social_tools->get_comment($this->get('id'));
	    	
	        if($comments)
	        {
	            $message = array('status' => 'success',' message' => 'Yay media has been found', 'data' => $comments);
	        }
	        else
	        {
	            $message = array('status' => 'error', 'message' => 'No media  could be found');
	        }        
        }
        else
        {
        	$message = array('status' => 'error', 'message' => 'Opps you need an id');        
        }

        $this->response($message, 200);
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
				$message = array('status' => 'error', 'message' => $this->upload->display_errors());
			}
			else
			{
				// Load Image Model
				$this->load->model('image_model');

				// Upload & Sizes
				$file_data		= $this->upload->data();
				$image_sizes	= array('full', 'large', 'medium', 'small');
				$create_path	= config_item('media_images_folder').$category_id.'/';

				// Make Thumb
				$this->image_model->make_thumbnail($create_path, $file_data['file_name'], 'media', 'medium');

				// Values
				$viewed 	= 'Y';
				$approval	= 'Y';
	        	
		    	$content_data = array(
		    		'site_id'			=> config_item('site_id'),
					'parent_id'			=> 0,
					'category_id'		=> $category_id,
					'module'			=> 'media',
					'type'				=> 'photo',
					'source'			=> 'website',
					'order'				=> 0,
		    		'user_id'			=> $this->session->userdata('user_id'),
					'title'				=> $this->input->post('title'),
					'title_url'			=> form_title_url($this->input->post('title'), $this->input->post('title_url')),
					'content'			=> $file_data['file_name'],
					'details'			=> '',
					'access'			=> $this->input->post('access'),
					'comments_allow'	=> 'Y',
					'geo_lat'			=> $this->input->post('geo_lat'),
					'geo_long'			=> $this->input->post('geo_long'),
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
		        	$message = array('status' => 'success', 'message' => 'Awesome we posted your '.$content_data['type'], 'data' => $result['content'], 'activity' => $result['activity']);		    
		        }
		        else
		        {
			        $message = array('status' => 'error', 'message' => 'Oops unable to add image to site');
		        }
			}
		}					
		else 
		{ 
			$message = array('status' => 'error', 'message' => 'No file to upload');
		}
		
		// KLUDGY ASS SOLUTION - So it works with the nasty browser bug of wraping <pre></pre>
		if ($this->get('format') == 'html') $message = json_encode($message);

        $this->response($message, 200);
    }    
    
    
    /* PUT types */
    function viewed_get()
    {
		$viewed = $this->social_tools->update_comment_viewed($this->get('id'));			
    	
        if($viewed)
        {
            $message = array('status' => 'success', 'message' => 'Comment viewed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not mark as viewed');
        }

        $this->response($message, 200);           
    }   
    
    function approve_get()
    {
    	$approve = $this->social_tools->update_comment_approve($this->get('id'));	

        if($approve)
        {
            $message = array('status' => 'success', 'message' => 'Comment approved');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not be approved');
        }

        $this->response($message, 200);        
    } 

    /* DELETE types */
    function destroy_get()
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
        
        	$message = array('status' => 'success', 'message' => 'Comment deleted');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'You do not have access to delete comment!');
        }
        
        $this->response($message, 200);        
    }
    
    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');        

		// Settings & Create Folders
		$settings	= $this->installer->install_settings('media', config_item('media_settings'));
		$folders	= $this->installer->create_folders(config_item('media_folders'));
	
		if ($settings == TRUE AND $folders == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the Media App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'No media could be find');
        }		
		
		$this->response($message, 200);
	}  

	function reinstall_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');        

		// Settings & Create Folders
		$settings	= $this->installer->install_settings('media', config_item('media_settings'), TRUE);
		$folders	= $this->installer->create_folders(config_item('media_folders'));
	
		if ($settings == true AND $folders == true)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the Media App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'No media could be find');
        }		
		
		$this->response($message, 200);
	}  

	
	function uninstall_authd_get()
	{
		$this->load->library('installer');
	
		$settings	= $this->installer->uninstall_settings('media');
		$files		= $this->installer->delete_app('app');
	
		if ($settings == true AND $files == true)
		{		
            $message = array('status' => 'success', 'message' => 'Media App was unistalled');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang, the Media App could not be uninstalled');
        }		
		
		$this->response($message, 200);	
	}

}
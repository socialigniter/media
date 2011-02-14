<?php
class Media extends Site_Controller
{
    function __construct()
    {
        parent::__construct();	
        
		$this->load->config('media');
	}
	
	function index()
	{	
		$this->data['page_title'] = 'Media';

		$this->render();
	}

	function view()
	{
		$media = $this->social_igniter->get_content($this->uri->segment(3));	
	
		redirect(base_url().'media/'.$media->type.'/'.$media->content_id, 'refresh');
	}
	
	function image()
	{
		$image = $this->social_igniter->get_content($this->uri->segment(3));	

		$this->data['page_title'] = 'Image';
		
		$this->data['image'] = $image;
		
		$this->data['image_large'] = base_url().config_item('media_images_folder').$image->category_id.'/large_'.$image->content;
	
		$this->data['content_id']		= $image->content_id;
		$this->data['comments_allow']	= $image->comments_allow;

		// Comments Widget
		if ((config_item('comments_enabled') == 'TRUE') && ($image->comments_allow != 'N'))
		{		
			// Get Comments
			$comments 						= $this->social_tools->get_comments_content($image->content_id);
			$comments_count					= $this->social_tools->get_comments_content_count($image->content_id);
			
			if ($comments_count)	$comments_title = $comments_count;
			else					$comments_title = 'Write';

			$this->data['comments_title']	= $comments_title;
			$this->data['comments_list'] 	= $this->social_tools->render_children_comments($comments, '0');

			// Write
			$this->data['comment_name']			= $this->session->flashdata('comment_name');
			$this->data['comment_email']		= $this->session->flashdata('comment_email');
			$this->data['comment_write_text'] 	= $this->session->flashdata('comment_write_text');
			$this->data['reply_to_id']			= $this->session->flashdata('reply_to_id');
			$this->data['comment_type']			= 'page';
			$this->data['geo_lat']				= $this->session->flashdata('geo_lat');
			$this->data['geo_long']				= $this->session->flashdata('geo_long');
			$this->data['geo_accuracy']			= $this->session->flashdata('geo_accuracy');
			$this->data['comment_error']		= $this->session->flashdata('comment_error');

			// ReCAPTCHA Enabled
			if ((config_item('comments_recaptcha') == 'TRUE') && (!$this->social_auth->logged_in()))
			{			
				$this->load->library('recaptcha');
				$this->data['recaptcha']		= $this->recaptcha->get_html();
			}
			else
			{
				$this->data['recaptcha']		= '';
			}

			$this->data['comments_write']		= $this->load->view(config_item('site_theme').'/partials/comments_write', $this->data, true);
		}	
	
		$this->render('site_wide');
	}

	function audio()
	{
		$this->data['page_title'] = 'Audio';
	
		$this->render();
	}

	function files()
	{
		$this->data['page_title'] = 'File';
	
		$this->render();
	}
	
}

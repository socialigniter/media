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
		redirect(base_url().'media/'.$media->type.'/'.$media->content_id);
	}

	function image()
	{
		$this->load->model('image_model');
	
		$image = $this->social_igniter->get_content($this->uri->segment(3));	

		$this->data['page_title'] = 'Image';

		$this->data['image'] 			= $image;
		$this->data['image_large'] 		= base_url().$this->image_model->get_thumbnail(config_item('media_images_folder').$image->category_id, $image->content, 'media', 'large');
		$this->data['content_id']		= $image->content_id;
		$this->data['comments_allow']	= $image->comments_allow;

		// Comments Widget
		if (check_app_installed('comments'))
		{
			$this->data['comments_list']	= modules::run('comments/widgets_comments_list', $this->data);
			$this->data['comments_write']	= modules::run('comments/widgets_comments_write', $this->data);
		}
		else
		{
			$this->data['comments_list']	= '';
			$this->data['comments_write']	= '';
		}
	
		$this->render('wide');
	}

	function audio()
	{
		$this->data['page_title'] = 'Audio';
	
		$this->render();
	}
	
	/* Widgets */
	function widgets_recent_pictures()
	{
		
		$this->load->view('widgets/recent_pictures', $this->data);	
	}


	function widgets_recent_audio()
	{
		
		$this->load->view('widgets/recent_audio', $this->data);	
	}
	
}

<?php
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();
		
		$this->load->library('media_igniter');
		$this->load->helper('media');	

		$this->data['page_title'] 	= 'Media';
	}
	
	function index()
	{				
		$this->data['type']			= '';
		$this->data['file']			= '';

		// Recent Media	
		$recent_media				= $this->media_igniter->get_media();
		$view_media					= NULL;
		
		foreach ($recent_media as $media)
		{		
			$view_media			   .= $this->load->view($this->config->item('dashboard_theme').'/partials/feed_timeline.php', $this->data, true);	
		}
				
		$this->data['view_media']	= $view_media;
	
		$this->render();
	}
	
	function images()
	{		
		$this->data['sub_title']			= 'Images';
		$this->data['category_id']			= '';
		$this->data['categories']			= $this->social_tools->get_categories_view('type', 'image-album');
		$this->data['categories_dropdown'] 	= $this->social_tools->get_categories_dropdown('type', 'image-album', $this->session->userdata('user_id'), $this->session->userdata('user_level_id'), '+ Add Photo Album');			
		
		$this->render('dashboard_wide');
	}

	function gallery()
	{		
		if (!$this->uri->segment(4))
		{
			redirect(base_url().'home/media/images', 'refresh');
		}

		$this->data['sub_title']		= 'Images';
		$this->data['category']			= $this->social_tools->get_category($this->uri->segment(4));
		$this->data['images']			= $this->social_igniter->get_content_view('category_id', $this->uri->segment(4));
		
		$this->render('dashboard_wide');
	}

}
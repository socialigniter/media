<?php
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->load->config('media');
		$this->load->helper('media');
		$this->load->library('media_igniter');
		$this->load->model('media_model');

		$this->data['page_title'] = 'Media';
	}
	
	function index()
	{				
		$this->render();
	}
	
	function images()
	{		
		$this->data['sub_title']			= 'Images';
		$this->data['category_id']			= '';
		$this->data['categories']			= $this->social_tools->get_categories_view('type', 'photo-album');
		$this->data['categories_dropdown'] 	= $this->social_tools->make_categories_dropdown(array('categories.type' => 'photo-album'), $this->session->userdata('user_id'), $this->session->userdata('user_level_id'), '+ Add Photo Album');

		$this->render('dashboard_wide');
	}

	function photo_album()
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
	
	function audio()
	{
		$this->data['sub_title']		= 'Audio';		
	
		$this->render();
	}

	function video()
	{
		$this->data['sub_title']		= 'Video';
		
		$this->render();
	}

}
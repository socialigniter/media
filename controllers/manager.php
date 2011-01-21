<?php
class Manager extends Dashboard_Controller
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
		echo 'aaaaaaahhhh';
	}
	
	function images_lightbox()
	{				
	
		$this->load->view('manager/images_lightbox');
	}


	function images_inline()
	{				
	
		$this->load->view('manager/images_inline');
	}



}
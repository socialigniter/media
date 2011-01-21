<?php
class Comments extends Dashboard_Controller
{

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('media_igniter');
		
		$this->data['page_title']		= 'Comments';	
			
	}
	
	function index() 
	{	

		$this->data['sub_title'] 	= 'Media';
		$this->data['comments']		= $this->social_tools->get_comments('media');
		
		$this->render();
		
	}


}
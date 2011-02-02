<?php
class Media extends Site_Controller
{
    function __construct()
    {
        parent::__construct();	
	}
	
	function index()
	{
	
		$this->data['page_title'] = 'Blog';

		$this->render();
	
	}

	// FOR MULTI BLOG SYSTEM
	function chooser()
	{
		if ($this->uri->segment(2) == 'dogfood') {
		
			$this->data['page_title'] = "Tha Dog Blog";
			$this->data['text'] = "Welcome to Tha Dog Blog";


		} elseif ($this->uri->segment(2) == 'cats') {

			$this->data['page_title'] = "Pretty Kitty Blog";
			$this->data['text'] = "Welcome to Pretty Kitty Blog";
		
		} elseif ($this->uri->segment(2) == 'singer') {

			redirect('http://google.com');

		} else {
			
			$this->data['page_title'] = "Ummmmm";
			$this->data['text'] = "Welcome to Ummmmmmm";
					
		}
		
		$this->render();
	}
	
	
}

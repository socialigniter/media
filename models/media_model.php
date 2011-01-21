<?php

class Media_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
  
	function make_images($upload_file, $upload_width, $upload_height, $category_id)
	{
		$this->load->helper('file');
				
		make_folder(config_item('media_images_folder').$category_id);	
	    
	    $raw_path 	= config_item('uploads_folder').$upload_file;
	    $thumb_path = config_item('media_images_folder').$category_id."/".$upload_file;
	    
	    if (!file_exists($thumb_path))
	    {	    
			delete_files(config_item('media_images_folder').$category_id."/full_".$upload_file);
			delete_files(config_item('media_images_folder').$category_id."/large_".$upload_file);
			delete_files(config_item('media_images_folder').$category_id."/medium_".$upload_file);
			delete_files(config_item('media_images_folder').$category_id."/small_".$upload_file);			
		}	    
	    
	    $original_width		= 0;
	    $original_height	= 0;
	    
	    // Is raw width/height larger than allowed width/height
		if ($upload_width >= config_item('media_images_full_width'))
		{
			$original_width = config_item('media_images_full_width');
		}
		else
		{
			$original_width = $upload_width;
		}

		if ($upload_height >= config_item('media_images_full_height'))
		{
			$original_height = config_item('media_images_full_height');
		}
		else
		{
			$original_height = $upload_height;
		}
	       
	    // Is horizontal or vertical picture	    
	    if($upload_width > $upload_height) {
	        $res_width 		= $original_width; 
	        $res_height 	= $original_height; 
	        $set_master_dim = 'width';
	    } else {
	        $res_width 		= $original_width;
	        $res_height 	= $original_height;
	        $set_master_dim = 'height';
	    }
	    
	    // Resizing the uploaded image
	    $resize_config['image_library'] 	= 'gd2';
	    $resize_config['source_image'] 		= $raw_path;
	    $resize_config['maintain_ratio'] 	= TRUE;
	    $resize_config['new_image'] 		= config_item('media_images_folder').$category_id."/original_".$upload_file;	    
	    $resize_config['width'] 			= $res_width;
	    $resize_config['height'] 			= $res_height;
	    $resize_config['master_dim'] 		= $set_master_dim;
	    
	    $this->load->library('image_lib', $resize_config);
	    
	    if (!$this->image_lib->resize()) {
	        echo "error first resize";
	        echo $this->image_lib->display_errors();
	        return false;
	    }
	    
	    $this->image_lib->clear();
		     
	    // Calculate offset
	    if($upload_width > $upload_height) {
	    // Horizontal picture
	        $diff = $upload_width - $upload_height;
	        $cropsize = $upload_height - 1;
	        $x_axis = round($diff / 2);
	        $y_axis = 0;
	    } else {
	    // Vertical picture
	        $cropsize = $upload_width - 1;
	        $diff = $upload_height - $upload_width;
	        $x_axis = 0;
	        $y_axis = round($diff / 2);
	    }
	    
	    // Makes largest size possible square image	 
		$crop_config['image_library']	= 'gd2';
	    $crop_config['source_image'] 	= $raw_path;
	    $crop_config['maintain_ratio']	= FALSE;
	    $crop_config['new_image'] 		= config_item('media_images_folder').$category_id."/".$upload_file; 
	    $crop_config['x_axis']		 	= $x_axis;
	    $crop_config['y_axis'] 			= $y_axis;
	    $crop_config['width'] 			= $cropsize;
	    $crop_config['height'] 			= $cropsize;
	        
	    $this->image_lib->initialize($crop_config);
	
	    if (!$this->image_lib->crop()) {
	        echo "error croping";
	        echo $this->image_lib->display_errors();
	        return false;
	    }	    
  
  	    $this->image_lib->clear();

	    // Bigger image crop resize
	    $thumb_config['image_library'] 		= 'gd2';
	    $thumb_config['source_image'] 		= $thumb_path;
	    $thumb_config['maintain_ratio'] 	= TRUE;
	    $thumb_config['new_image']			= config_item('media_images_folder').$category_id."/"."large_".$upload_file;
	    $thumb_config['width'] 				= config_item('media_images_large_width');
	    $thumb_config['height'] 			= config_item('media_images_large_height');
	    
	    $this->image_lib->initialize($thumb_config);
	    
	    if (!$this->image_lib->resize()) {
	        echo "error resize croping";
	        echo $this->image_lib->display_errors();
	        return false;
	    }

	    $this->image_lib->clear();

	    // Normal image crop resize	    
	    $thumb2_config['image_library'] 	= 'gd2';
	    $thumb2_config['source_image'] 		= $thumb_path;
	    $thumb2_config['maintain_ratio'] 	= TRUE;
	    $thumb2_config['new_image']			= config_item('media_images_folder').$category_id."/"."medium_".$upload_file;
	    $thumb2_config['width'] 			= config_item('media_images_medium_width');
	    $thumb2_config['height'] 			= config_item('media_images_medium_height');
	    
	    $this->image_lib->initialize($thumb2_config);
	    
	    if (!$this->image_lib->resize()) {
	        echo "error resize croping";
	        echo $this->image_lib->display_errors();
	        return false;
	    }

	    $this->image_lib->clear();

	    // Small image crop resize	    
	    $thumb3_config['image_library'] 	= 'gd2';
	    $thumb3_config['source_image'] 		= $thumb_path;
	    $thumb3_config['maintain_ratio'] 	= TRUE;
	    $thumb3_config['new_image']			= config_item('media_images_folder').$category_id."/"."small_".$upload_file;
	    $thumb3_config['width'] 			= config_item('media_images_small_width');
	    $thumb3_config['height'] 			= config_item('media_images_small_height');
	    
	    $this->image_lib->initialize($thumb3_config);
	    
	    if (!$this->image_lib->resize()) {
	        echo "error resize croping";
	        echo $this->image_lib->display_errors();
	        return false;
	    }
	    
	    unlink($thumb_path);
	    
	    return true;    
	    	    
	}
	

}
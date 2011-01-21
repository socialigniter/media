<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Media Library
*
* @package		Media Igniter
* @subpackage	Media Igniter Library
* @author		Brennan Novak
* @link			http://social-igniter.com
*
*/
 
class Media_igniter
{

	function __construct()
	{
		$this->ci =& get_instance();
		
		// Load Configs
		$this->ci->load->config('media');

		// Load Universal Models
		$this->ci->load->model('media_model');
	}
	
	
	function get_media()
	{
		return $this->ci->media_model->get_media();
	}
	

	function display_image_album_thumbnail($category)
	{	
		if (!$category->details)
		{
			// Get Most Recent Image
			$image = $this->ci->social_igniter->get_content_view_recent('category_id', $category->category_id);
			
			// Update Category
			$this->ci->social_tools->update_category_details($category->category_id, json_encode(array('thumb' => $image->content)));
			
			$thumb = base_url().config_item('media_images_folder').$category->category_id.'/small_'.$image->content;
		}
		else
		{	
			$details = json_decode($category->details);
			
			// If Image Does Not Exist
		    if (!file_exists(config_item('media_images_folder').$category->category_id.'/small_'.$details->thumb))
		    {
				$this->ci->social_tools->update_category_details($category->category_id, '');
					  
				// Recursive
				$this->display_image_album_thumbnail($category);
			}
			else
			{
				$thumb = base_url().config_item('media_images_folder').$category->category_id.'/small_'.$details->thumb;			
			}
		}
		
		return $thumb;
	}

}
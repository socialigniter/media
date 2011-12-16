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
	}

	function display_image_album_thumbnail($category, $thumb='small')
	{
		$details = json_decode($category->details);

	    if (!is_object($details))
	    {
			$details = new stdClass();
	    }

		// Has Thumbnail
		if (isset($details->thumb))
		{
			$thumbnail = base_url().config_item('media_images_folder').$category->category_id.'/'.$thumb.'_'.$details->thumb;
		}
		else
		{
			// Get Album Images
			if ($images = $this->ci->social_igniter->get_content_view('category_id', $category->category_id))
			{
				// Update Thumbnail
			    $details->thumb = $images[0]->content;
				$this->ci->social_tools->update_category_details($category->category_id, json_encode($details));
				
				// Get Thumbnail
		    	$this->ci->load->model('image_model');
		    	$result = $this->ci->image_model->get_thumbnail(config_item('media_images_folder').$category->category_id.'/', $images[0]->content, 'media', 'small');

				$thumbnail = base_url().$result;
			}
			else
			{
				$thumbnail = base_url().'application/views/'.config_item('site_theme').'/assets/images/large_no_photo.png';
			}
		}
		
		return $thumbnail;
	}

}
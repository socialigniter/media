<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Media : Install
* Author: 		Brennan Novak
* 		  		contact@social-igniter.com
*         		@brennannovak
*          
* Created: 		Brennan Novak
*
* Project:		http://social-igniter.com/
* Source: 		http://github.com/socialigniter/media
*
* Description: 	Install values for Media App for Social Igniter 
*/
/* Settings */
$config['media_settings']['widgets'] 				= 'TRUE';
$config['media_settings']['categories'] 			= 'TRUE';
$config['media_settings']['enabled'] 				= 'TRUE';
$config['media_settings']['create_permission']		= '3';
$config['media_settings']['publish_permission']		= '2';
$config['media_settings']['manage_permission']		= '2';
$config['media_settings']['images_allow']			= 'no';
$config['media_settings']['images_sizes_full']		= 'yes';
$config['media_settings']['images_sizes_large']		= 'yes';
$config['media_settings']['images_sizes_medium'] 	= 'yes';
$config['media_settings']['images_sizes_small'] 	= 'yes';
$config['media_settings']['images_full_width']		= '1200';
$config['media_settings']['images_full_height']		= '900';
$config['media_settings']['images_large_width']		= '800';
$config['media_settings']['images_large_height'] 	= '600';
$config['media_settings']['images_medium_width'] 	= '600';
$config['media_settings']['images_medium_height'] 	= '400';
$config['media_settings']['images_small_width'] 	= '125';
$config['media_settings']['images_small_height'] 	= '125';
$config['media_settings']['images_formats'] 		= 'gif|jpg|jpeg|png';
$config['media_settings']['images_max_size'] 		= '25600';
$config['media_settings']['images_max_dimensions'] 	= '3000';
$config['media_settings']['images_folder'] 			= 'upload/images/';
$config['media_settings']['images_sizes_original'] 	= 'yes';
$config['media_settings']['audio_allow'] 			= 'no';
$config['media_settings']['audio_formats'] 			= 'mp3|oog|wav|aiff';
$config['media_settings']['audio_max_size'] 		= '25600';
$config['media_settings']['files_allow'] 			= 'no';
$config['media_settings']['files_formats']		 	= 'pdf|doc|txt|zip';
$config['media_settings']['files_max_size'] 		= '51200';
$config['media_settings']['comments_allow'] 		= 'no';
$config['media_settings']['comments_per_page'] 		= '5';

/* Folders */
$config['media_folders'] 							= array('images','audio','video');
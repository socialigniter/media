<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Module : Media
* Author: 	Brennan Novak
* 		  	brennan@reverseproductions.com
*         	@brennannovak
*          
* Created by Brennan Novak
*
* Project:	http://social-igniter.com
* Source: 	http://github.com/social-igniter/module-blog
*
* Description: basic media and admin functionality module for Social Igniter
*/

// Media Settings
$config['media_audio_path']		= 'media/audio/';
$config['media_images_path']	= 'media/images/';
$config['media_files_path']		= 'media/files/';
$config['media_types']			= array(
	'image'		=> 'Image',
	'audio'		=> 'Audio',
	'file'		=> 'File',
	'video'		=> 'Video',
);
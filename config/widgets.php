<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Media : Widgets
* Author: 		Brennan Novak
* 		  		contact@social-igniter.com
*         		@brennannovak
*          
* Project:		http://social-igniter.com/
* Source: 		http://github.com/socialigniter/media
*
* Description: 	Widgets for Media App for Social Igniter
*/

$config['media_widgets'][] = array(
	'regions'	=> array('sidebar','content'),
	'widget'	=> array(
		'module'	=> 'media',
		'name'		=> 'Recent Pictures',
		'method'	=> 'run',
		'path'		=> 'widgets_recent_pictures',
		'multiple'	=> 'FALSE',		
		'order'		=> '1',
		'content'	=> ''			
	)
);

$config['media_widgets'][] = array(
	'regions'	=> array('sidebar','content'),
	'widget'	=> array(
		'module'	=> 'media',
		'name'		=> 'Recent Audio',
		'method'	=> 'run',
		'path'		=> 'widgets_recent_audio',
		'multiple'	=> 'FALSE',		
		'order'		=> '1',
		'content'	=> ''			
	)
);
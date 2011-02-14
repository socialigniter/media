<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Blog Module : Routes
* Author: 	Brennan Novak
* 		  	contact@social-igniter.com
*
* Project:	http://social-igniter.com/
* Source: 	http://github.com/socialigniter/blog
*
* Standard installed routes for Blog Module. 
* All routes must start with the first segment being 'blog'
*/
$route['media'] 					= 'media/index';
$route['media/view/(:any)']			= 'media/view';
$route['media/home/images']			= 'home/images';
$route['media/home/images/(:num)']	= 'home/gallery';
$route['media/manager']				= 'manager/index';	
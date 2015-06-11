<?php 
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2014 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 07/11/2013 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

$moduleclass_sfx		= $params->get('moduleclass_sfx');

// Facebook
$ext_fb					= (int)$params->get('ext_fb', 1);	
$ext_fb_lang			= $params->get('ext_fb_lang', 'en_US');
$ext_fb_color_scheme	= $params->get('ext_fb_color_scheme', 'light');
$ext_fb_data_action		= $params->get('ext_fb_data_action', 'like');
$ext_fb_show_faces		= $params->get('ext_fb_show_faces', 'false');
$ext_fb_data_send		= $params->get('ext_fb_data_send', 'false');
$ext_fb_layout			= $params->get('ext_fb_layout', 'button_count');
$ext_fb_data_width		= (int)$params->get('ext_fb_data_width', 90);	
$ext_fb_data_height		= (int)$params->get('ext_fb_data_height', 20);				
	
// Twitter Tweet
$ext_twitter			= (int)$params->get('ext_twitter', 1);			
$ext_twitter_lang		= $params->get('ext_twitter_lang', 'en');
$ext_twitter_via		= $params->get('ext_twitter_via', 'extjoom');
$ext_twitter_related	= $params->get('ext_twitter_related', 'extjoom');
$ext_twitter_hashtags	= $params->get('ext_twitter_hashtags', '');
$ext_twitter_data_count	= $params->get('ext_twitter_data_count', 'none');			
	
// Twitter Follow
$ext_twitter_follow		= (int)$params->get('ext_twitter_follow', 1);
$ext_twitter_show_count	= $params->get('ext_twitter_show_count', 'false');
$ext_twitter_screen_name= $params->get('ext_twitter_screen_name', 'false');
$ext_twitter_name		= $params->get('ext_twitter_name', 'extjoom');
$ext_twitter_data_width	= (int)$params->get('ext_twitter_data_width', 140);

// Google +1
$ext_google				= (int)$params->get('ext_google', 1);
$ext_google_type		= $params->get('ext_google_type', 'medium');
$ext_google_lang		= $params->get('ext_google_lang', 'en');
$ext_google_annotation	= $params->get('ext_google_annotation', 'none');
$ext_google_width		= (int)$params->get('ext_google_width', 450);

// Linkedin
$ext_linkedin			= (int)$params->get('ext_linkedin', 1);
$ext_in_language		= $params->get('ext_in_language', 'en_US');
$ext_link_data_counter	= $params->get('ext_link_data_counter', 'none');			
	
// Vk
$ext_vk					= (int)$params->get('ext_vk', 1);
$ext_vk_api_id			= $params->get('ext_vk_api_id');
$ext_vk_type			= $params->get('ext_vk_type', 'mini');
$ext_vk_height			= (int)$params->get('ext_vk_height', 20);
$ext_vk_verb			= (int)$params->get('ext_vk_verb', 0);


require JModuleHelper::getLayoutPath('mod_ext_social_buttons', $params->get('layout', 'default'));

?>
<?php

/**
 * Plugin Name: Tiny YouTube Post Widget
 * Version: 1.0.0
 * Plugin URI: http://rnaby.github.io
 * Description: A plugin for embeding YouTube videos to sidebar through widget for each different posts.
 * Author: Khan Mohammad Rashedun-Naby
 * Author URI: bd.linkedin.com/in/rnaby
 * License: GPL V3
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Requiring class for core logic
require_once('inc/class-tiny-youtube-post-widget-core.php');

// Instanciating the class
RnabyTinyYouTubePostWidgetCore::get_instance();
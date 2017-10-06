<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://bd.linkedin.com/in/rnaby
 * @since      3.0.1
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      3.0.1
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    3.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tiny-youtube-post-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

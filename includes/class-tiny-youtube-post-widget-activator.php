<?php

/**
 * Fired during plugin activation
 *
 * @link       https://bd.linkedin.com/in/rnaby
 * @since      3.0.1
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.1
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    3.0.1
	 */
	public static function activate() {
		$sodathemes_typw_post_types = get_option('sodathemes_typw_post_types');
		if ( empty( $sodathemes_typw_post_types ) ) {
			add_option( 'sodathemes_typw_post_types', 'post' );
		}

		add_option('typw_do_activation_redirect', true);
	}

}

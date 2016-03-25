<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://sodathemes.com
 * @since             3.0.0
 * @package           Tiny_Youtube_Post_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Tiny YouTube Post Widget
 * Plugin URI:        http://sodathemes.com/product/tiny-youtube-post-widget-pro/
 * Description:       A plugin for embeding YouTube videos to sidebar through widget for each different posts.
 * Version:           3.0.0
 * Author:            SodaThemes
 * Author URI:        http://sodathemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tiny-youtube-post-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tiny-youtube-post-widget-activator.php
 */
function activate_tiny_youtube_post_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tiny-youtube-post-widget-activator.php';
	Tiny_Youtube_Post_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tiny-youtube-post-widget-deactivator.php
 */
function deactivate_tiny_youtube_post_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tiny-youtube-post-widget-deactivator.php';
	Tiny_Youtube_Post_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tiny_youtube_post_widget' );
register_deactivation_hook( __FILE__, 'deactivate_tiny_youtube_post_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tiny-youtube-post-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_tiny_youtube_post_widget() {

	$plugin = new Tiny_Youtube_Post_Widget();
	$plugin->run();

}
run_tiny_youtube_post_widget();

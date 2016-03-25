<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      3.0.0
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/public
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $sodathemes_tywp    The ID of this plugin.
	 */
	private $sodathemes_tywp;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param      string    $sodathemes_tywp       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sodathemes_tywp, $version ) {

		$this->sodathemes_tywp = $sodathemes_tywp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tiny_Youtube_Post_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tiny_Youtube_Post_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->sodathemes_tywp, plugin_dir_url( __FILE__ ) . 'css/tiny-youtube-post-widget-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tiny_Youtube_Post_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tiny_Youtube_Post_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->sodathemes_tywp, plugin_dir_url( __FILE__ ) . 'js/tiny-youtube-post-widget-public.js', array( 'jquery' ), $this->version, false );

	}
    /**
     * Code for calling widget class here.
     */
	public function sodathemes_typw_register_widget() {
	    register_widget( 'RnabyTinyYouTubePostWidget' );
	}
}

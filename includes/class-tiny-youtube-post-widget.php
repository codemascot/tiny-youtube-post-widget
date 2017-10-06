<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://bd.linkedin.com/in/rnaby
 * @since      3.0.1
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      3.0.1
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget {
	
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    3.0.1
	 * @access   protected
	 * @var      Tiny_Youtube_Post_Widget_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    3.0.1
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	
	/**
	 * The current version of the plugin.
	 *
	 * @since    3.0.1
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    3.0.1
	 */
	public function __construct() {
		
		$this->plugin_name = 'tiny-youtube-post-widget';
		$this->version     = '3.0.1';
		
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		
	}
	
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tiny_Youtube_Post_Widget_Loader. Orchestrates the hooks of the plugin.
	 * - Tiny_Youtube_Post_Widget_i18n. Defines internationalization functionality.
	 * - Tiny_Youtube_Post_Widget_Admin. Defines all hooks for the admin area.
	 * - Tiny_Youtube_Post_Widget_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    3.0.1
	 * @access   private
	 */
	private function load_dependencies() {
		
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tiny-youtube-post-widget-loader.php';
		
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tiny-youtube-post-widget-i18n.php';
		
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tiny-youtube-post-widget-admin.php';
		
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tiny-youtube-post-widget-public.php';
		
		/**
		 * The class responsible for the widget.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widget/class-tiny-youtube-post-widget.php';
		
		/**
		 * The class responsible for Tax Meta Functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/Tax-meta-class.php';
		
		$this->loader = new Tiny_Youtube_Post_Widget_Loader();
		
	}
	
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tiny_Youtube_Post_Widget_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    3.0.1
	 * @access   private
	 */
	private function set_locale() {
		
		$plugin_i18n = new Tiny_Youtube_Post_Widget_i18n();
		
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		
	}
	
	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    3.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {
		
		$plugin_admin = new Tiny_Youtube_Post_Widget_Admin( $this->get_plugin_name(), $this->get_version() );
		
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'sodathemes_typw_admin_menu_page' );
		// Adding meta box.
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_box' );
		// Saving meta box's content.
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_metabox_data' );
		// Redirection after activation
		$this->loader->add_action( 'admin_init', $plugin_admin, 'plugin_redirect' );
		
		$plugin_admin->tax_meta();
		
	}
	
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.0.1
	 * @access   private
	 */
	private function define_public_hooks() {
		
		$plugin_public = new Tiny_Youtube_Post_Widget_Public( $this->get_plugin_name(), $this->get_version() );
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		$this->loader->add_action( 'widgets_init', $plugin_public, 'register_widget' );
		
		add_shortcode( 'typw_tax', [ $plugin_public, 'tax_shortcode' ] );
		add_shortcode( 'typw_post', [ $plugin_public, 'post_shortcode' ] );
	}
	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    3.0.1
	 */
	public function run() {
		
		$this->loader->run();
	}
	
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     3.0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		
		return $this->plugin_name;
	}
	
	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     3.0.1
	 * @return    Tiny_Youtube_Post_Widget_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		
		return $this->loader;
	}
	
	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     3.0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		
		return $this->version;
	}
	
}

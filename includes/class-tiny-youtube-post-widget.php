<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://sodathemes.com
 * @since      3.0.0
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
 * @since      3.0.0
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      Tiny_Youtube_Post_Widget_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      string    $sodathemes_tywp    The string used to uniquely identify this plugin.
	 */
	protected $sodathemes_tywp;

	/**
	 * The current version of the plugin.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    3.0.0
	 */
	public function __construct() {

		$this->sodathemes_tywp = 'tiny-youtube-post-widget';
		$this->version = '3.0.0';

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
	 * @since    3.0.0
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

		// Requiring class for widget
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widget/class-tiny-youtube-post-widget.php';

		// Requiring class for taxonomy meta
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/class-tax-meta.php';

		$this->loader = new Tiny_Youtube_Post_Widget_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tiny_Youtube_Post_Widget_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    3.0.0
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
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$sodathemes_tywp_admin = new Tiny_Youtube_Post_Widget_Admin( $this->get_sodathemes_tywp(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $sodathemes_tywp_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $sodathemes_tywp_admin, 'enqueue_scripts' );

		// Adding meta box.
		$this->loader->add_action( 'add_meta_boxes', $sodathemes_tywp_admin, 'sodathemes_add_meta_box' );
		// Saving meta box's content.
		$this->loader->add_action( 'save_post', $sodathemes_tywp_admin, 'sodathemes_typw_save_metabox_data' );

		$sodathemes_tywp_admin->sodathemes_typw_tax_meta();
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$sodathemes_tywp_public = new Tiny_Youtube_Post_Widget_Public( $this->get_sodathemes_tywp(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $sodathemes_tywp_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $sodathemes_tywp_public, 'enqueue_scripts' );

		$this->loader->add_action( 'widgets_init', $sodathemes_tywp_public, 'sodathemes_typw_register_widget' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    3.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     3.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_sodathemes_tywp() {
		return $this->sodathemes_tywp;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     3.0.0
	 * @return    Tiny_Youtube_Post_Widget_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     3.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

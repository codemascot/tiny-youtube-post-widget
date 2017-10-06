<?php

/**
 * TinyYouTubePostWidget Class
 */

// Requiring class for widget
require_once('class-tiny-youtube-post-widget.php');

// Requiring class for taxonomy meta
require_once('class-tax-meta.php');

/**
 * Core TinyYouTubePostWidgetCore Class
 */
class RnabyTinyYouTubePostWidgetCore {
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;
	private $widget;
    private $text_domain = '';

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {
		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */
	private function __construct() {
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );

		load_plugin_textdomain( $this->text_domain, false, '/lang' );

		// Registering Admin Scripts and Styles
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );

		// Registering Front Scripts and Styles
		add_action( 'wp_enqueue_scripts', array( $this, 'register_front_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_front_styles' ) );

		// Adding meta box.
		add_action( 'add_meta_boxes', array( $this, 'rnaby_add_meta_box' ) );
		// Saving meta box's content.
		add_action( 'save_post', array( $this, 'rnaby_typw_save_metabox_data' ) );
		
		// Adding widget class and calling them.
		$this->widget = new RnabyTinyYouTubePostWidget;
		add_action( 'widgets_init', array($this, 'rnaby_typw_register_widget') );

		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		$this->rnaby_typw_tax_meta();
		
		$this->run_plugin();
	}

	public function get_plugin_url() {
		return $this->plugin_url;
	}

	public function get_plugin_path() {
		return $this->plugin_path;
	}

    /**
     * Code which will run in activation.
     */
    public function activation() {

	}

    /**
     * Code which will run in deactivation.
     */
    public function deactivation() {

	}

    /**
     * Code registering custom scripts.
     */
    public function register_admin_scripts() {
    	wp_enqueue_script( 'rnaby_typw_widget_admin_script', plugins_url('js/admin.js', __FILE__), array( 'jquery' ), false, false);	
	}
    
    /**
     * Code registering custom scripts.
     */
    public function register_front_scripts() {
    	wp_enqueue_script( 'rnaby_typw_widget_front_script', plugins_url('js/front.js', __FILE__), array( 'jquery' ), false, false);
	}
    
    /**
     * Code for enqueue and register CSS files.
     */
    public function register_admin_styles() {
    	wp_enqueue_style( 'rnaby_typw_widget_admin_style', plugins_url('css/admin.css', __FILE__) );
	}
    
    /**
     * Code for enqueue and register CSS files.
     */
    public function register_front_styles() {
    	wp_enqueue_style( 'rnaby_typw_widget_front_style', plugins_url('css/front.css', __FILE__) );

	}

    /**
     * Code for your plugin's functionality here.
     */
    private function run_plugin() {

	}
    /**
     * Code for calling widget class here.
     */
	function rnaby_typw_register_widget() {
	    register_widget( 'RnabyTinyYouTubePostWidget' );
	}

	/**
	 * Add the YouTube meta box container.
	 */
	public function rnaby_add_meta_box( $post_type ) {
        $post_types = array('post', 'page');     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'rnaby_typw_metabox',
				__( 'Tiny YouTube Post Widget URL', $this->text_domain ),
				array( $this, 'rnaby_typw_render_meta_box_content' ),
				$post_type,
				'normal',
				'high'
			);
        }
	}
	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function rnaby_typw_render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'rnaby_typw_inner_custom_box', 'rnaby_typw_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_rnaby_typw_meta_value_key', true );

		// Display the form, using the current value.
		echo '<label for="rnaby_typw_meta_field">';
		echo '</label> ';
		echo '<input type="text" id="rnaby_typw_meta_field" name="rnaby_typw_meta_field"';
        echo ' value="' . esc_attr( $value ) . '" size="95" placeholder="Give your YouTube URL"/>';
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function rnaby_typw_save_metabox_data( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['rnaby_typw_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['rnaby_typw_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'rnaby_typw_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$rnaby_typw_data = sanitize_text_field( $_POST['rnaby_typw_meta_field'] );

		// Update the meta field.
		update_post_meta( $post_id, '_rnaby_typw_meta_value_key', $rnaby_typw_data );
	}

	public function rnaby_typw_tax_meta(){
		if (is_admin()) {
			/* 
			 * prefix of meta keys, optional
			 */
			$prefix = 'rnaby_typw_';
			/* 
			 *  Meta box configuration
			 */
			$config = array(
					'id' => 'rnaby_typw_meta_box',          // meta box id, unique per meta box
					'title' => 'Tiny YouTube Post Widget',          // meta box title
					'pages' => array('category','post_tag'),        // taxonomy name, accept categories, post_tag and custom taxonomies
					'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
					'fields' => array(),            // list of meta fields (can be added by field arrays)
					'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
					'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
				);

			$typw_tax_meta = new Tax_Meta_Class($config);

			$typw_tax_meta->addText($prefix.'meta_tax_youtube_url',array('name'=> __('YouTube URL','tax-meta'),'desc' => 'Put your YouTube video URL assigned for this taxonomy.'));
  
		}
	}
}

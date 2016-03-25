<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      3.0.0
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tiny_Youtube_Post_Widget
 * @subpackage Tiny_Youtube_Post_Widget/admin
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Tiny_Youtube_Post_Widget_Admin {

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
	 * @param      string    $sodathemes_tywp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sodathemes_tywp, $version ) {

		$this->sodathemes_tywp = $sodathemes_tywp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->sodathemes_tywp, plugin_dir_url( __FILE__ ) . 'css/tiny-youtube-post-widget-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->sodathemes_tywp, plugin_dir_url( __FILE__ ) . 'js/tiny-youtube-post-widget-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the YouTube meta box container.
	 */
	public function sodathemes_add_meta_box( $post_type ) {
        $post_types = array('post', 'page');     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'rnaby_typw_metabox',
				__( 'Tiny YouTube Post Widget URL', 'sodathemes' ),
				array( $this, 'sodathemes_typw_render_meta_box_content' ),
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
	public function sodathemes_typw_render_meta_box_content( $post ) {
	
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
	public function sodathemes_typw_save_metabox_data( $post_id ) {
	
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


	public function sodathemes_typw_tax_meta(){
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

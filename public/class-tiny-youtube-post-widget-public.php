<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://bd.linkedin.com/in/rnaby
 * @since      3.0.1
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
	 * @since    3.0.1
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.1
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.1
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    3.0.1
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

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/tiny-youtube-post-widget-public.css',
			[],
			$this->version,
			'all'
		);
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    3.0.1
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
		
		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/tiny-youtube-post-widget-public.js',
			[ 'jquery' ], $this->version, false );
		
	}
	
	/**
	 * Code for calling widget class here.
	 */
	public function register_widget() {

		register_widget( 'SodaThemesTinyYouTubePostWidget' );
	}
	
	/**
	 * This method is responsible for post shortcode.
	 *
	 * @since   3.2.1
	 * @param   $atts
	 *
	 * @return bool
	 */
	public function post_shortcode( $atts ) {
		
		$atts = shortcode_atts(
			[
				'id'     => get_the_ID(),
				'height' => '220',
				'width'  => '220',
			], $atts
		);
		
		$height            = $atts[ 'height' ];
		$width             = $atts[ 'width' ];
		$postid            = $atts[ 'id' ];
		$video             = get_post_meta( $postid, '_rnaby_typw_meta_value_key', true );
		$post_types        = (array) get_option( 'sodathemes_typw_post_types' );
		$current_post_type = get_post_type( get_the_ID() );
		
		if ( 1 === get_option( 'sodathemes_typw_user_check' ) ) {
			$typw_user_role          = (array) get_option( 'typw_user_role' );
			$typw_current_user_roles = $this->get_user_role( get_current_user_id() );
			$is_auth                 = array_intersect( $typw_user_role, $typw_current_user_roles ) ? 'true' : 'false';
			if ( ! empty( $typw_user_role ) ) {
				if ( $is_auth ) {
					switch ( true ) {
						case ! empty( $video )
							 && in_array( $current_post_type, $post_types, true )
							 && is_user_logged_in():
							include 'partials/html-public-iframe.php';
							break;
						default:
							return false;
					}
				}
			} else {
				switch ( true ) {
					case ! empty( $video )
						&& in_array( $current_post_type, $post_types, true )
						&& is_user_logged_in():
						include 'partials/html-public-iframe.php';
						break;
					default:
						return false;
				}
			}
		} else {
			switch ( true ) {
				case ! empty( $video ) && in_array( $current_post_type, $post_types, true ):
					include 'partials/html-public-iframe.php';
					break;
				default:
					return false;
			}
		}
	}
	
	/**
	 * This method is responsible for taxonomy shortcode.
	 *
	 * @since   3.2.1
	 * @param   $atts
	 *
	 * @return  bool
	 */
	public function tax_shortcode( $atts ) {
		
		$atts = shortcode_atts(
			[
				'id'     => '',
				'height' => '220',
				'width'  => '220',
			], $atts
		);
		
		$height                = $atts[ 'height' ];
		$width                 = $atts[ 'width' ];
		$term_id               = $atts[ 'id' ];
		$video                 = get_term_meta( $term_id, 'rnaby_typw_meta_tax_youtube_url' )[ 0 ];
		$term_tax              = get_term( $term_id )->taxonomy;
		$typw_saved_taxonomies = get_option( 'sodathemes_typw_taxonomies' );
		
		if ( 1 === get_option( 'sodathemes_typw_user_check' ) ) {
			$typw_user_role          = get_option( 'typw_user_role' );
			$typw_current_user_roles = $this->get_user_role( get_current_user_id() );
			$is_auth                 = array_intersect( $typw_user_role, $typw_current_user_roles ) ? 'true' : 'false';
			
			if ( ! empty( $typw_user_role ) ) {
				
				if ( $is_auth ) {
					switch ( true ) {
						case ! empty( $video )
							 && in_array( $term_tax, $typw_saved_taxonomies, true )
							 && is_user_logged_in():
							include 'partials/html-public-iframe.php';
							break;
						default:
							return false;
					}
				}
			} else {

				switch ( true ) {
					case ! empty( $video )
						 && in_array( $term_tax, $typw_saved_taxonomies, true )
						 && is_user_logged_in():
						include 'partials/html-public-iframe.php';
						break;
					default:
						return false;
				}
			}
		} else {
			switch ( true ) {
				case ! empty( $video ) && in_array( $term_tax, $typw_saved_taxonomies, true ):
					include 'partials/html-public-iframe.php';
					break;
				default:
					return false;
			}
		}

	}
	
	/**
	 * Gettig user role.
	 *
	 * @since    3.2.1
	 * @param $user_ID
	 *
	 * @return array|bool
	 */
	public static function get_user_role( $user_ID ) {
		
		if ( is_user_logged_in() ) {
			$user = new WP_User( $user_ID );
			if ( ! empty( $user->roles ) && is_array( $user->roles ) ) {
				return $user->roles;
			}
		}
		
		return false;
	}
}

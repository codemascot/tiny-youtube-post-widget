<?php

class SodaThemesTinyYouTubePostWidget extends WP_Widget {
    private $text_domain = '';
	public function __construct() {
		parent::__construct(
				'sodathemes-tiny-youtube-post-widget',
				__( 'Tiny YouTube Post Widget', $this->text_domain ),
				array(
						'classname' 	=>	'tiny-youtube-post-widget',
						'description' 	=>	__( 'A YouTube widget to embed video to each posts.', $this->text_domain )
					)
			);
		
		load_plugin_textdomain( $this->text_domain, false, '../lang' );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= $instance['rnaby-typw-title'];
		$video 		= $instance['rnaby-typw-video-link'];
		$checked 	= $instance['rnaby-typw-check'];
		$height 	= $instance['rnaby-typw-height'];
		$width 		= $instance['rnaby-typw-width'];
		include( plugin_dir_path( __FILE__ ).'views/widget.php');
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array)$instance, array(
				'rnaby-typw-title' 		=>	'',
				'rnaby-typw-video-link'	=>	'',
				'rnaby-typw-check'		=>	'',
				'rnaby-typw-height' 	=>	'220',
				'rnaby-typw-width' 		=>	'220'
			) );
		include( plugin_dir_path( __FILE__ ).'views/admin.php');
	}

	public function update( $new_instance, $old_instance ) {
		$old_instance['rnaby-typw-title'] 		= strip_tags( stripslashes( $new_instance['rnaby-typw-title'] ) );
		$old_instance['rnaby-typw-video-link'] 	= strip_tags( stripslashes( $new_instance['rnaby-typw-video-link'] ) );
		$old_instance['rnaby-typw-check'] 		= $new_instance['rnaby-typw-check'];
		$old_instance['rnaby-typw-height'] 		= strip_tags( $new_instance['rnaby-typw-height'] );
		$old_instance['rnaby-typw-width'] 		= strip_tags( $new_instance['rnaby-typw-width'] );

		return $old_instance;
	}
}
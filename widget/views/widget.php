<?php
if( empty($height) || !is_numeric($height) ){
	$height = '220';
}
if( empty($width) || !is_numeric($width) ){
	$width = '220';
}

if ( is_single() || is_page() ) {
	$postid = get_the_id();
	$video = get_post_meta( $postid, '_rnaby_typw_meta_value_key', true );
	$post_types = (array) get_option( 'sodathemes_typw_post_types' );
	$current_post_type = get_post_type( get_the_ID() );

	if ( get_option('sodathemes_typw_user_check') == 1 ) {
        $sodathemes_typw_user_role = (array) get_option( 'sodathemes_typw_user_role' );
        $sodathemes_typw_current_user_roles = Tiny_Youtube_Post_Widget_Public::typw_get_user_role( get_current_user_id() );
		$is_auth = array_intersect( $sodathemes_typw_user_role, $sodathemes_typw_current_user_roles )  ? 'true' : 'false';
        if ( !empty( $sodathemes_typw_user_role ) ) {
            if( $is_auth ){
				switch ( true ) {
				    case !empty( $video ) && in_array( $current_post_type, $post_types ) && is_user_logged_in():
						include 'partials/html-public-iframe.php';
				        break;
				    case empty( $video ) && $checked && in_array( $current_post_type, $post_types ) && is_user_logged_in():
					    $video = $instance['rnaby-typw-video-link'];
						include 'partials/html-public-iframe.php';
				        break;
				    default:
						return NULL; 
				}
            }
        } else {
			switch ( true ) {
			    case !empty( $video ) && in_array( $current_post_type, $post_types ) && is_user_logged_in():
					include 'partials/html-public-iframe.php';
			        break;
			    case empty( $video ) && $checked && in_array( $current_post_type, $post_types ) && is_user_logged_in():
				    $video = $instance['rnaby-typw-video-link'];
					include 'partials/html-public-iframe.php';
			        break;
			    default:
					return NULL; 
			}
        }
    } else {
		switch ( true ) {
		    case !empty( $video ) && in_array( $current_post_type, $post_types ):
				include 'partials/html-public-iframe.php';
		        break;
		    case empty( $video ) && $checked && in_array( $current_post_type, $post_types ):
			    $video = $instance['rnaby-typw-video-link'];
				include 'partials/html-public-iframe.php';
		        break;
		    default:
				return NULL; 
		}
    }
} elseif ( is_category() || is_tag() || is_tax() ) {
	$term_id = get_queried_object()->term_id;
	$video = get_term_meta( $term_id, 'rnaby_typw_meta_tax_youtube_url' )[0];
	$term_tax = get_queried_object()->taxonomy;
	$typw_saved_taxonomies = get_option( 'sodathemes_typw_taxonomies' );
	if ( get_option('sodathemes_typw_user_check') == 1 ) {
        $sodathemes_typw_user_role = (array) get_option( 'sodathemes_typw_user_role' );
        $sodathemes_typw_current_user_roles = Tiny_Youtube_Post_Widget_Public::typw_get_user_role( get_current_user_id() );
		$is_auth = array_intersect( $sodathemes_typw_user_role, $sodathemes_typw_current_user_roles )  ? 'true' : 'false';
        if ( !empty( $sodathemes_typw_user_role ) ) {
            if( $is_auth ){
				switch ( true ) {
				    case !empty( $video ) && in_array( $term_tax, $typw_saved_taxonomies ) && is_user_logged_in():
						include 'partials/html-public-iframe.php';
				        break;
				    case empty( $video ) && $checked && in_array( $term_tax, $typw_saved_taxonomies ) && is_user_logged_in():
					    $video = $instance['rnaby-typw-video-link'];
						include 'partials/html-public-iframe.php';
				        break;
				    default:
						return NULL; 
				}
            }
        } else {
			switch ( true ) {
			    case !empty( $video ) && in_array( $term_tax, $typw_saved_taxonomies ) && is_user_logged_in():
					include 'partials/html-public-iframe.php';
			        break;
			    case empty( $video ) && $checked && in_array( $term_tax, $typw_saved_taxonomies ) && is_user_logged_in():
				    $video = $instance['rnaby-typw-video-link'];
					include 'partials/html-public-iframe.php';
			        break;
			    default:
					return NULL; 
			}
        }
    } else {
		switch ( true ) {
		    case !empty( $video ) && in_array( $term_tax, $typw_saved_taxonomies ):
				include 'partials/html-public-iframe.php';
		        break;
		    case empty( $video ) && $checked && in_array( $term_tax, $typw_saved_taxonomies ):
			    $video = $instance['rnaby-typw-video-link'];
				include 'partials/html-public-iframe.php';
		        break;
		    default:
				return NULL; 
		}
    }
} else {
	if ( get_option('sodathemes_typw_user_check') == 1 ) {
        $sodathemes_typw_user_role = (array) get_option( 'sodathemes_typw_user_role' );
        $sodathemes_typw_current_user_roles = Tiny_Youtube_Post_Widget_Public::typw_get_user_role( get_current_user_id() );
		$is_auth = array_intersect( $sodathemes_typw_user_role, $sodathemes_typw_current_user_roles )  ? 'true' : 'false';
        if ( !empty( $sodathemes_typw_user_role ) ) {
            if( $is_auth ){
				switch ( true ) {
				    case !empty( $video ) && is_user_logged_in():
						include 'partials/html-public-iframe.php';
				        break;
				    case empty( $video ) && $checked && is_user_logged_in():
					    $video = $instance['rnaby-typw-video-link'];
						include 'partials/html-public-iframe.php';
				        break;
				    default:
						return NULL; 
				}
            }
        } else {
			switch ( true ) {
			    case !empty( $video ) && is_user_logged_in():
					include 'partials/html-public-iframe.php';
			        break;
			    case empty( $video ) && $checked && is_user_logged_in():
				    $video = $instance['rnaby-typw-video-link'];
					include 'partials/html-public-iframe.php';
			        break;
			    default:
					return NULL; 
			}
        }
    } else {
		switch ( true ) {
		    case !empty( $video ):
				include 'partials/html-public-iframe.php';
		        break;
		    case empty( $video ) && $checked:
			    $video = $instance['rnaby-typw-video-link'];
				include 'partials/html-public-iframe.php';
		        break;
		    default:
				return NULL; 
		}
    }
}

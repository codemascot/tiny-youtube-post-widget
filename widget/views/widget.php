<?php

if( empty($height) || !is_numeric($height) ){
	$height = '220';
}

if (is_single()) {
	$postid = get_the_id();
	$post_video = get_post_meta( $postid, '_rnaby_typw_meta_value_key', true );
	if ( !empty($post_video)) {
		$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
		$video_link = str_replace($protocol, '', $post_video);
		$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		echo $the_result;
		echo  $args['after_widget'];
	} else {
		if ( !empty($video) && $checked == true ) {
			$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
			$video_link = str_replace($protocol, '', $video);
			$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			echo $the_result;
			echo  $args['after_widget'];
		} else {
			return NULL; 
		}
	}
} elseif ( is_page() ) {
	$postid = get_the_id();
	$post_video = get_post_meta( $postid, '_rnaby_typw_meta_value_key', true );
	if ( !empty($post_video)) {
		$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
		$video_link = str_replace($protocol, '', $post_video);
		$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		echo $the_result;
		echo  $args['after_widget'];
	} else {
		if ( !empty($video) && $checked == true ) {
			$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
			$video_link = str_replace($protocol, '', $video);
			$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			echo $the_result;
			echo  $args['after_widget'];
		} else {
			return NULL; 
		}
	}
} elseif (is_category()) {
	// $categories = get_category( get_query_var( 'cat' ) );;
	// $term_id = $categories->cat_ID;
	$term_id = get_queried_object()->term_id;
	$cat_video = get_tax_meta($term_id,'rnaby_typw_meta_tax_youtube_url');
	if ( !empty($cat_video)) {
		$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
		$video_link = str_replace($protocol, '', $cat_video);
		$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		echo $the_result;
		echo  $args['after_widget'];
	} else {
		if ( !empty($video) && $checked == true ) {
			$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
			$video_link = str_replace($protocol, '', $video);
			$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			echo $the_result;
			echo  $args['after_widget'];
		} else {
			return NULL; 
		}
	}
} elseif (is_tag()) {
	$term_id = get_queried_object()->term_id;
	$tag_video = get_tax_meta($term_id,'rnaby_typw_meta_tax_youtube_url');
	if ( !empty($tag_video)) {
		$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
		$video_link = str_replace($protocol, '', $tag_video);
		$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		echo $the_result;
		echo  $args['after_widget'];
	} else {
		if ( !empty($video) && $checked == true ) {
			$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
			$video_link = str_replace($protocol, '', $video);
			$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			echo $the_result;
			echo  $args['after_widget'];
		} else {
			return NULL; 
		}
	}
} else {
	if ( !empty($video) && $checked == true ) {
		$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
		$video_link = str_replace($protocol, '', $video);
		$the_result = '<iframe class="rnaby-typw-video-link" style="height:'.$height.'px;" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		echo $the_result;
		echo  $args['after_widget'];
	} else {
		return NULL; 
	}
}

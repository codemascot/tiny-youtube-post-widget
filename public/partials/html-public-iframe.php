<?php
$protocol 	= array('http://', 'https://', 'www.', 'youtube.com', 'youtu.be', 'embed', 'watch?v=', '/');
$video_link = str_replace($protocol, '', $video);
$the_result = '<iframe class="rnaby-typw-video-link" height="'.$height.'" width="'.$width.'" src="http://youtube.com/embed/'.$video_link.'" allowfullscreen></iframe>';
echo $the_result;
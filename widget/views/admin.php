<div class="tiny-youtube-post-widget">
	<label><?php _e( 'Title:', $this->text_domain ); ?></label>
	<input type="text" id="<?php echo $this->get_field_id( 'rnaby-typw-title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'rnaby-typw-title' ); ?>" value="<?php echo $instance['rnaby-typw-title']; ?>">
</div>
<div id="widget-rnaby-typw-youtube-url-input" class="tiny-youtube-post-widget">
	<label><?php _e( 'Default YouTube URL:', $this->text_domain ); ?></label>
	<input type="text" id="<?php echo $this->get_field_id( 'rnaby-typw-video-link' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'rnaby-typw-video-link' ); ?>" value="<?php echo $instance['rnaby-typw-video-link']; ?>">
</div>
<div id="widget-rnaby-typw-height-input" class="tiny-youtube-post-widget">
	<label><?php _e( 'Video Height:', $this->text_domain ); ?></label>
	<input type="number" id="<?php echo $this->get_field_id( 'rnaby-typw-height' ); ?>" name="<?php echo $this->get_field_name( 'rnaby-typw-height' ); ?>" value="<?php echo $instance['rnaby-typw-height']; ?>">
	<label><?php _e( 'px', $this->text_domain ); ?></label>
</div>
<div class="tiny-youtube-post-widget widget-rnaby-typw-last">
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('rnaby-typw-check'); ?>" name="<?php echo $this->get_field_name('rnaby-typw-check'); ?>" value="1" <?php checked( 1, $instance['rnaby-typw-check'], true ); ?> />
	<label><?php _e( 'Display Default YouTube URL if post URL input is empty.', $this->text_domain ); ?></label>
</div>
<div class="wrap about-wrap">

	<h1><?php
		printf(
		/* translators: %s: version number */
			esc_html__( 'Tiny YouTube Post Widget %s', 'tiny-youtube-post-widget' ),
			$this->version
		); ?></h1>
	<div class="about-text">
		<?php printf(
			esc_html__(
				'Thank you for downloading this product. For any kind of support please post in forum.',
				'tiny-youtube-post-widget'
			)
		); ?>
	</div>
	<form method="post" action="options.php">
		<?php settings_fields( 'sodathemes-typw-settings-group' ); ?>
		<?php do_settings_sections( 'sodathemes-typw-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<?php esc_html_e( 'Select Post Type(s)', 'tiny-youtube-post-widget' ); ?>
				</th>
				<td>
					<select
						id="sodathemes_typw_post_types"
						name="sodathemes_typw_post_types[]"
						required="required" multiple>
						<optgroup label="
							<?php _e( 'Please select post types....', 'tiny-youtube-post-widget' ); ?>">
							<?php $this->post_types(); ?>
						</optgroup>
					</select>
					<br><br>
					<span class="description">
					    <?php
						    esc_html_e(
								'From here you can select the "Post Types" where you wanna use the "Tiny YouTube Post Widget"',
								'tiny-youtube-post-widget'
							);
						?>
						.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Select Taxonomy(s)', 'tiny-youtube-post-widget' ); ?></th>
				<td>
					<select id="sodathemes_typw_taxonomies" name="sodathemes_typw_taxonomies[]" multiple>
						<optgroup
							label="
							<?php
							_e(
								'Please select taxonomies....',
								'tiny-youtube-post-widget'
							);
							?>
						">
							<?php $this->taxonomies(); ?>
						</optgroup>
					</select>
					<br><br>
					<span class="description">
						<?php
						esc_html_e(
							'Here you can select the "Taxonomies" where you wanna use the "Tiny YouTube Post Widget".',
							'tiny-youtube-post-widget'
						);
						?>
					</span>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<?php esc_html_e( 'Auth Restriction', 'tiny-youtube-post-widget' ); ?></th>
				<td>
					<fieldset>
						<label>
							<input type="radio" value="" name="sodathemes_typw_user_check"
								<?php checked( '', get_option( 'sodathemes_typw_user_check' ) ); ?>/>
								<?php esc_html_e( 'All Users', 'tiny-youtube-post-widget' ); ?>
						</label>
						<label>
							<input type="radio" value="1" name="sodathemes_typw_user_check"
								<?php checked( '1', get_option( 'sodathemes_typw_user_check' ) ); ?>/>
							<?php esc_html_e( 'Only Registered Users', 'tiny-youtube-post-widget' ); ?>
						</label>
					</fieldset>
					<br>
					<span class="description">
						<?php esc_html_e(
							'This option helps you with which kind of users you want to give the access to the product input field.',
							'tiny-youtube-post-widget'
						) ?>
						
					</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php esc_html_e( 'Role Restriction', 'tiny-youtube-post-widget' ) ?>
				</th>
				<td>
					<select id="sodathemes_typw_user_role" name="sodathemes_typw_user_role[]"
						<?php echo 1 === get_option( 'sodathemes_typw_user_check' ) ? '' : 'disabled'; ?> multiple>
						<option value="">All</option>
						<?php $this->dropdown_roles( get_option( 'sodathemes_typw_user_role' ) ); ?>
					</select>
					<br><br>
					<span class="description">
						<?php esc_html_e(
							'It is not gonna work if you set the previous option to . So you must set "Only Registered Users" option to make this work.',
							'tiny-youtube-post-widget'
						) ?>
						</span>
				</td>
			</tr>
		</table>
		
		<?php submit_button(); ?>

	</form>
</div>
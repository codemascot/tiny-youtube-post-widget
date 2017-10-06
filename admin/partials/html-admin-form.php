<div class="wrap about-wrap">
    <h1><?php printf( __( 'Tiny YouTube Post Widget %s' ), $this->version ); ?></h1>
    <div class="about-text">
        <?php printf( __( 'Thank you for downloading this product. For any kind of support please post in forum or mail me at <a href="mailto:naby88@gmail.com">naby88@gmail.com</a><br>' ), $this->version ); ?>
    </div>
    <form method="post" action="options.php">
        <?php settings_fields( 'sodathemes-typw-settings-group' ); ?>
        <?php do_settings_sections( 'sodathemes-typw-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Select Post Type(s)</th>
                <td>
                    <select id="sodathemes_typw_post_types" name="sodathemes_typw_post_types[]" required="required" multiple>
                        <optgroup label="<?php _e( 'Please select post types....', 'sodathemes' )?>">
                            
                            <?php $this->sodathemes_typw_post_types();?>
                        
                        </optgroup>
                    </select>
                    <br><br>
                    <span class="description">From here you can select the <code>Post Types</code> where you wanna use the "Tiny YouTube Post Widget".</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Select Taxonomy(s)</th>
                <td>
                    <select id="sodathemes_typw_taxonomies" name="sodathemes_typw_taxonomies[]" multiple>
                        <optgroup label="<?php _e( 'Please select taxonomies....', 'sodathemes' )?>">
                            
                            <?php $this->sodathemes_typw_taxonomies();?>
                        
                        </optgroup>
                    </select>
                    <br><br>
                    <span class="description">Here you can select the <code>Taxonomies</code> where you wanna use the "Tiny YouTube Post Widget".</span>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Auth Restriction</th>
                <td>
                    <fieldset>
                        <label><input type="radio" value="" name="sodathemes_typw_user_check" <?php checked( '', get_option( 'sodathemes_typw_user_check' ) ); ?>/>All Users</label>
                        <label><input type="radio" value="1" name="sodathemes_typw_user_check" <?php checked( '1', get_option( 'sodathemes_typw_user_check' ) ); ?>/>Only Registered Users</label>
                    </fieldset>
                    <br>
                    <span class="description">This option helps you with which kind of users you want to give the access to the product input field.</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Role Restriction</th>
                <td>
                    <select id="sodathemes_typw_user_role" name="sodathemes_typw_user_role[]" <?php echo get_option( 'sodathemes_typw_user_check' ) == 1 ? '' : 'disabled'; ?> multiple>
                        <option value="">All</option>
                        <?php $this->typw_dropdown_roles( get_option( 'sodathemes_typw_user_role' ) ); ?>
                    </select>
                    <br><br>
                    <span class="description">It is not gonna work if you set the previous option to <code>All Users</code>. So you must set <code>Only Registered Users</code> option to make this work.</span>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>
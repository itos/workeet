<?php 

/* Meta boxes */

function leanbiz_settings(){
	add_meta_box("et_post_meta", "ET Settings", "leanbiz_display_options", "page", "normal", "high");
	add_meta_box("et_post_meta", "ET Settings", "leanbiz_display_options", "post", "normal", "high");
}
add_action("admin_init", "leanbiz_settings");

function leanbiz_display_options($callback_args) {
	global $post;
	
	$post_type = $callback_args->post_type;
	$temp_array = array();

	$temp_array = maybe_unserialize(get_post_meta($post->ID,'_et_leanbiz_settings',true));
			
	$et_is_featured = isset( $temp_array['et_is_featured'] ) ? (bool) $temp_array['et_is_featured'] : false;
	$et_fs_variation = isset( $temp_array['et_fs_variation'] ) ? (int) $temp_array['et_fs_variation'] : 1;
	$et_fs_video = isset( $temp_array['et_fs_video'] ) ? $temp_array['et_fs_video'] : '';
	$et_fs_video_embed = isset( $temp_array['et_fs_video_embed'] ) ? $temp_array['et_fs_video_embed'] : '';
	$et_fs_title = isset( $temp_array['et_fs_title'] ) ? $temp_array['et_fs_title'] : '';
	$et_fs_description = isset( $temp_array['et_fs_description'] ) ? $temp_array['et_fs_description'] : '';
	$et_fs_link = isset( $temp_array['et_fs_link'] ) ? $temp_array['et_fs_link'] : '';
	$et_fs_link_custom_text = isset( $temp_array['et_fs_link_custom_text'] ) ? $temp_array['et_fs_link_custom_text'] : ''; ?>
	
	<div id="et_custom_settings" style="margin: 13px 0 17px 4px;">
		<label class="selectit" for="et_is_featured" style="font-weight: bold;">
			<input type="checkbox" name="et_is_featured" id="et_is_featured" value=""<?php checked( $et_is_featured ); ?> /> This <?php echo $post_type; ?> is Featured</label><br/>
		
		<div id="et_settings_featured_options" style="margin-top: 12px;">
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_variation" style="color: #000; font-weight: bold;"> Featured Slider: </label>				
				<select id="et_fs_variation" name="et_fs_variation">
					<option value="1" <?php selected( $et_fs_variation, 1 ); ?>>Centered Png Image</option>
					<option value="2" <?php selected( $et_fs_variation, 2 ); ?>>Image on the left</option>
					<option value="3" <?php selected( $et_fs_variation, 3 ); ?>>Png Image on the left</option>
					<option value="4" <?php selected( $et_fs_variation, 4 ); ?>>Image on the right</option>
					<option value="5" <?php selected( $et_fs_variation, 5 ); ?>>Png Image on the right</option>
					<option value="6" <?php selected( $et_fs_variation, 6 ); ?>>Video &amp; Text</option>
					<option value="7" <?php selected( $et_fs_variation, 7 ); ?>>Video Only</option>
					<option value="8" <?php selected( $et_fs_variation, 8 ); ?>>Description Only</option>
				</select>
				<br />
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_video" style="color: #000; font-weight: bold;"> Video url: </label>
				<input type="text" style="width: 30em;" value="<?php echo esc_url($et_fs_video); ?>" id="et_fs_video" name="et_fs_video" size="67" />
				<br />
				<small style="position: relative; top: 8px;">ex: <code><?php echo htmlspecialchars("http://www.youtube.com/watch?v=WkuHbkaieZ4");?></code></small>
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_video_embed" style="color: #000; font-weight: bold;"> Video Embed Code: </label>
				<br />
				<textarea id="et_fs_video_embed" name="et_fs_video_embed" cols="40" rows="1" tabindex="6" style="display: inline; position: relative; top: 5px; width: 490px; height: 125px;"><?php echo esc_textarea($et_fs_video_embed); ?></textarea>
				<br />
				<small style="position: relative; top: 8px;">Paste embed code if video link cannot be used</small>
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_title" style="color: #000; font-weight: bold;"> Custom Title: </label>
				<input type="text" style="width: 30em;" value="<?php echo esc_attr($et_fs_title); ?>" id="et_fs_title" name="et_fs_title" size="67" />
				<br />
				<small style="position: relative; top: 8px;">ex: <code><?php echo htmlspecialchars("The Best Design!");?></code></small>
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_description" style="color: #000; font-weight: bold;"> Description Text: </label>
				<input type="text" style="width: 30em;" value="<?php echo esc_attr($et_fs_description); ?>" id="et_fs_description" name="et_fs_description" size="67" />
				<br />
				<small style="position: relative; top: 8px;">ex: <code><?php echo htmlspecialchars("Twenty Percent Off All Pillows");?></code></small>
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_link_custom_text" style="color: #000; font-weight: bold;"> Custom Read More Text: </label>
				<input type="text" style="width: 30em;" value="<?php echo esc_attr($et_fs_link_custom_text); ?>" id="et_fs_link_custom_text" name="et_fs_link_custom_text" size="67" />
				<br />
				<small style="position: relative; top: 8px;">ex: <code><?php echo htmlspecialchars("Learn More Today");?></code></small>
			</div>
			
			<div class="et_fs_setting" style="display: none; margin: 13px 0 26px 4px;">
				<label for="et_fs_link" style="color: #000; font-weight: bold;"> Custom Link: </label>
				<input type="text" style="width: 30em;" value="<?php echo esc_url($et_fs_link); ?>" id="et_fs_link" name="et_fs_link" size="67" />
				<br />
			</div>
			
		</div> <!-- #et_settings_featured_options -->
	</div> <!-- #et_custom_settings -->
		
	<?php
}

add_action('save_post', 'leanbiz_save_details');
function leanbiz_save_details($post_id){
	global $pagenow;
	if ( 'post.php' != $pagenow ) return $post_id;
		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	$temp_array = array();
	
	if ( !isset($_POST['et_is_featured']) ) {
		if ( get_post_meta( $post_id, "_et_leanbiz_settings", true ) ) $temp_array = maybe_unserialize( get_post_meta( $post_id, "_et_leanbiz_settings", true ) ); 
		$temp_array['et_is_featured'] = 0;
		update_post_meta( $post_id, "_et_leanbiz_settings", $temp_array );
		
		return $post_id;
	}
	
	$temp_array['et_is_featured'] = isset( $_POST["et_is_featured"] ) ? 1 : 0;
	$temp_array['et_fs_variation'] = isset($_POST["et_fs_variation"]) ? (int) $_POST["et_fs_variation"] : '';
	$temp_array['et_fs_video'] = isset($_POST["et_fs_video"]) ? esc_url($_POST["et_fs_video"]) : '';
	$temp_array['et_fs_video_embed'] = isset($_POST["et_fs_video_embed"]) ? $_POST["et_fs_video_embed"] : '';
	$temp_array['et_fs_title'] = isset($_POST["et_fs_title"]) ? wp_kses( $_POST["et_fs_title"], array( 'span' => array(), 'strong' => array() ) ) : '';
	$temp_array['et_fs_description'] = isset($_POST["et_fs_description"]) ? wp_kses( $_POST["et_fs_description"], array( 'span' => array(), 'strong' => array() ) ) : '';
	$temp_array['et_fs_link'] = isset($_POST["et_fs_link"]) ? esc_url($_POST["et_fs_link"]) : '';
	$temp_array['et_fs_link_custom_text'] = isset($_POST["et_fs_link_custom_text"]) ? esc_attr($_POST["et_fs_link_custom_text"]) : '';
		
	update_post_meta( $post_id, "_et_leanbiz_settings", $temp_array );
}

add_action( 'admin_enqueue_scripts', 'leanbiz_metabox_upload_scripts' );
function leanbiz_metabox_upload_scripts( $hook_suffix ) {
	if ( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
		wp_register_script('et_admin_featured_slide_options', get_bloginfo('template_directory').'/js/et_admin_featured_slide_options.js', array('jquery'));
		wp_enqueue_script('et_admin_featured_slide_options');
	}
} ?>
<?php 
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Import epanel settings</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;
	
	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results("SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP 'http://et_sample_images.com'");
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();
				
				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];
			
			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );
			
			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );
			
			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => $local_image ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;
	
	$importOptions = 'YTo2Mjp7czoxMjoibGVhbmJpel9sb2dvIjtzOjA6IiI7czoxNToibGVhbmJpel9mYXZpY29uIjtzOjA6IiI7czoyMDoibGVhbmJpel9jb2xvcl9zY2hlbWUiO3M6NzoiRGVmYXVsdCI7czoyMDoibGVhbmJpel9jYXRudW1fcG9zdHMiO3M6MToiNiI7czoyNDoibGVhbmJpel9hcmNoaXZlbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjM6ImxlYW5iaXpfc2VhcmNobnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjA6ImxlYW5iaXpfdGFnbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MTk6ImxlYW5iaXpfZGF0ZV9mb3JtYXQiO3M6NjoiTSBqLCBZIjtzOjI0OiJsZWFuYml6X25ld190aHVtYl9tZXRob2QiO3M6Mjoib24iO3M6MjI6ImxlYW5iaXpfaG9tZXBhZ2VfcG9zdHMiO3M6MToiNyI7czoxNjoibGVhbmJpel9mZWF0dXJlZCI7czoyOiJvbiI7czoxNzoibGVhbmJpel9kdXBsaWNhdGUiO3M6Mjoib24iO3M6MTY6ImxlYW5iaXpfZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MjA6ImxlYW5iaXpfZmVhdHVyZWRfbnVtIjtzOjE6IjMiO3M6MjQ6ImxlYW5iaXpfc2xpZGVyX2F1dG9zcGVlZCI7czo0OiI3MDAwIjtzOjI0OiJsZWFuYml6X2VuYWJsZV9kcm9wZG93bnMiO3M6Mjoib24iO3M6MTc6ImxlYW5iaXpfaG9tZV9saW5rIjtzOjI6Im9uIjtzOjE4OiJsZWFuYml6X3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MTg6ImxlYW5iaXpfb3JkZXJfcGFnZSI7czozOiJhc2MiO3M6MjU6ImxlYW5iaXpfdGllcnNfc2hvd25fcGFnZXMiO3M6MToiMyI7czozNToibGVhbmJpel9lbmFibGVfZHJvcGRvd25zX2NhdGVnb3JpZXMiO3M6Mjoib24iO3M6MjQ6ImxlYW5iaXpfY2F0ZWdvcmllc19lbXB0eSI7czoyOiJvbiI7czozMDoibGVhbmJpel90aWVyc19zaG93bl9jYXRlZ29yaWVzIjtzOjE6IjMiO3M6MTY6ImxlYW5iaXpfc29ydF9jYXQiO3M6NDoibmFtZSI7czoxNzoibGVhbmJpel9vcmRlcl9jYXQiO3M6MzoiYXNjIjtzOjE3OiJsZWFuYml6X3Bvc3RpbmZvMiI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MTg6ImxlYW5iaXpfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyNToibGVhbmJpel9zaG93X3Bvc3Rjb21tZW50cyI7czoyOiJvbiI7czoxNzoibGVhbmJpel9wb3N0aW5mbzEiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjI0OiJsZWFuYml6X3RodW1ibmFpbHNfaW5kZXgiO3M6Mjoib24iO3M6MjA6ImxlYW5iaXpfY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoyMjoibGVhbmJpel9jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MjI6ImxlYW5iaXpfY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjIyOiJsZWFuYml6X2NvbG9yX3BhZ2VsaW5rIjtzOjA6IiI7czoyOToibGVhbmJpel9jb2xvcl9wYWdlbGlua19hY3RpdmUiO3M6MDoiIjtzOjIyOiJsZWFuYml6X2NvbG9yX2hlYWRpbmdzIjtzOjA6IiI7czoyNzoibGVhbmJpel9jb2xvcl9zaWRlYmFyX2xpbmtzIjtzOjA6IiI7czoxOToibGVhbmJpel9mb290ZXJfdGV4dCI7czowOiIiO3M6MjU6ImxlYW5iaXpfY29sb3JfZm9vdGVybGlua3MiO3M6MDoiIjtzOjI2OiJsZWFuYml6X3Nlb19ob21lX3RpdGxldGV4dCI7czowOiIiO3M6MzI6ImxlYW5iaXpfc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czoyOToibGVhbmJpel9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjIxOiJsZWFuYml6X3Nlb19ob21lX3R5cGUiO3M6Mjc6IkJsb2dOYW1lIHwgQmxvZyBkZXNjcmlwdGlvbiI7czoyNToibGVhbmJpel9zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzA6ImxlYW5iaXpfc2VvX3NpbmdsZV9maWVsZF90aXRsZSI7czo5OiJzZW9fdGl0bGUiO3M6MzY6ImxlYW5iaXpfc2VvX3NpbmdsZV9maWVsZF9kZXNjcmlwdGlvbiI7czoxNToic2VvX2Rlc2NyaXB0aW9uIjtzOjMzOiJsZWFuYml6X3Nlb19zaW5nbGVfZmllbGRfa2V5d29yZHMiO3M6MTI6InNlb19rZXl3b3JkcyI7czoyMzoibGVhbmJpel9zZW9fc2luZ2xlX3R5cGUiO3M6MjE6IlBvc3QgdGl0bGUgfCBCbG9nTmFtZSI7czoyNzoibGVhbmJpel9zZW9fc2luZ2xlX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyMjoibGVhbmJpel9zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjI2OiJsZWFuYml6X3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzE6ImxlYW5iaXpfaW50ZWdyYXRlX2hlYWRlcl9lbmFibGUiO3M6Mjoib24iO3M6Mjk6ImxlYW5iaXpfaW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjM0OiJsZWFuYml6X2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjM3OiJsZWFuYml6X2ludGVncmF0ZV9zaW5nbGVib3R0b21fZW5hYmxlIjtzOjI6Im9uIjtzOjI0OiJsZWFuYml6X2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjI0OiJsZWFuYml6X2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjMwOiJsZWFuYml6X2ludGVncmF0aW9uX3NpbmdsZV90b3AiO3M6MDoiIjtzOjMzOiJsZWFuYml6X2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjE3OiJsZWFuYml6XzQ2OF9pbWFnZSI7czowOiIiO3M6MTU6ImxlYW5iaXpfNDY4X3VybCI7czowOiIiO3M6MTk6ImxlYW5iaXpfNDY4X2Fkc2Vuc2UiO3M6MDoiIjt9';
	
	/*global $options;
	
	foreach ($options as $value) {
		if( isset( $value['id'] ) ) { 
			update_option( $value['id'], $value['std'] );
		}
	}*/
	
	$importedOptions = unserialize(base64_decode($importOptions));
	
	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}
	
	update_option( $shortname . '_use_pages', 'false' );
} ?>
jQuery(document).ready(function() {
	var $custom_portfolio_box = jQuery('#et_custom_settings'),
		$et_featured_options = $custom_portfolio_box.find('#et_settings_featured_options > div'),
		$et_settings_portfolio_options = $custom_portfolio_box.find('#et_settings_portfolio_options > div'),
		$et_variation_select = jQuery('select#et_fs_variation'),
		$et_video_box_1 = jQuery('.et_fs_setting input#et_fs_video').parent(),
		$et_video_box_2 = jQuery('.et_fs_setting textarea#et_fs_video_embed').parent();
	
	if ($custom_portfolio_box.find('input#et_is_featured:checked').length) {
		$custom_portfolio_box.find('#et_settings_featured_options > div').css('display','block');
	}
		
	$custom_portfolio_box.find('input#et_is_featured').click(function(){
		if (jQuery(this).attr('checked')) {
			$et_featured_options.css({'display':'block','opacity':'0'}).animate({opacity:1},500);
			$et_video_box_1.css('display','none');
			$et_video_box_2.css('display','none');
		} else {
			$et_featured_options.css({'display':'block'}).animate({opacity:0},500,function(){
				jQuery(this).css('display','none');
			});
		}
	});
	
	$et_variation_select.bind('change',function(){
		var this_value = jQuery(this).val();
		if ( this_value != 6 && this_value != 7 ) {
			$et_video_box_1.slideUp( 'fast' );
			$et_video_box_2.slideUp( 'fast' );
		} else {
			$et_video_box_1.slideDown( 'fast' );
			$et_video_box_2.slideDown( 'fast' );
		}
	});
	
	$et_variation_select.trigger('change');
});
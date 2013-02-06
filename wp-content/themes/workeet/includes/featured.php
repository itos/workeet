<?php
	global $wp_embed, $ids;
	
	$ids = array();
	$arr = array();
	$i=1;
				
	$featured_cat = get_option('leanbiz_feat_cat');
	$featured_num = (int) get_option('leanbiz_featured_num');
	$et_first_slide = true;
	
	if (get_option('leanbiz_use_pages') == 'false') query_posts("showposts=$featured_num&cat=".get_catId($featured_cat));
	else { 
		global $pages_number;
		
		if (get_option('leanbiz_feat_pages') <> '') $featured_num = count(get_option('leanbiz_feat_pages'));
		else $featured_num = $pages_number;
		
		query_posts(array
						('post_type' => 'page',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'post__in' => (array) get_option('leanbiz_feat_pages'),
						'showposts' => $featured_num)
					);
	}
	
	while (have_posts()) : the_post();
		$et_leanbiz_settings = maybe_unserialize( get_post_meta($post->ID,'_et_leanbiz_settings',true) );
		
		$variation = isset( $et_leanbiz_settings['et_fs_variation'] ) ? (int) $et_leanbiz_settings['et_fs_variation'] : 1;
		$link = isset( $et_leanbiz_settings['et_fs_link'] ) && !empty($et_leanbiz_settings['et_fs_link']) ? $et_leanbiz_settings['et_fs_link'] : get_permalink();
		$link_custom_text = isset( $et_leanbiz_settings['et_fs_link_custom_text'] ) && !empty($et_leanbiz_settings['et_fs_link_custom_text']) ? $et_leanbiz_settings['et_fs_link_custom_text'] : __('Read more','LeanBiz');
		$title = isset( $et_leanbiz_settings['et_fs_title'] ) && !empty($et_leanbiz_settings['et_fs_title']) ? $et_leanbiz_settings['et_fs_title'] : get_the_title();
		$description = isset( $et_leanbiz_settings['et_fs_description'] ) && !empty($et_leanbiz_settings['et_fs_description']) ? $et_leanbiz_settings['et_fs_description'] : truncate_post(30,false);
		$video = isset( $et_leanbiz_settings['et_fs_video'] ) && !empty($et_leanbiz_settings['et_fs_video']) ? $et_leanbiz_settings['et_fs_video'] : '';
		$video_manual_embed = isset( $et_leanbiz_settings['et_fs_video_embed'] ) && !empty($et_leanbiz_settings['et_fs_video_embed']) ? $et_leanbiz_settings['et_fs_video_embed'] : '';
		
		$additional_class = ' ';
		
		switch ($variation) {
			case 2:
				$additional_class .= 'et_slide_imageleft';
				break;
			case 3:
				$additional_class .= 'et_slide_imageleft_png';
				break;
			case 4:
				$additional_class .= 'et_slide_imageright';
				break;
			case 5:
				$additional_class .= 'et_slide_imageright_png';
				break;
			case 6:
				$additional_class .= 'et_slide_video';
				break;
			case 7:
				$additional_class .= 'et_slide_lonevideo';
				break;
			case 8:
				$additional_class .= 'et_slide_text';
				break;
		}
?>
		<div class="slide clearfix<?php echo esc_attr($additional_class); if ( $et_first_slide ) echo ' slide1'; ?>">
			<?php
				if ( in_array($variation, array(1,3,5)) ) {
					$et_slide_class = '';
					$width = 282;
					$height = 287;
					
					if ( 1 == $variation ) { 
						$et_slide_class = 'featured-image';
						$width = 390;
						$height = 171;
					}
					if ( 3 == $variation ) $et_slide_class = 'featured_png_left';
					if ( 5 == $variation ) $et_slide_class = 'featured_png_right';					
					
					$thumbnail = get_thumbnail($width,$height,'',$title,$title,false,'Featured');
					$thumb = $thumbnail["thumb"];
					if ( $thumb != '' ) {
						echo '<a href="' . esc_url( $link ) . '">';
						print_thumbnail($thumb, $thumbnail["use_timthumb"], $title, $width, $height, $et_slide_class);
						echo '</a>';
					}
				}
				
				if ( in_array($variation, array(2,4)) ) {
					$width = 274;
					$height = 274;
					
					$thumbnail = get_thumbnail($width,$height,'',$title,$title,false,'Featured');
					$thumb = $thumbnail["thumb"];
					if ( $thumb != '' ) {
						echo '<div class="featured_image_shadow">';
							echo '<a href="' . esc_url( $link ) . '">';
							print_thumbnail($thumb, $thumbnail["use_timthumb"], $title, $width, $height, '');
							echo '</a>';
						echo '</div> <!-- end .featured_image_shadow -->';
					}
				}
				
				if ( in_array($variation, array(6,7)) ){
					$width = 560;
					$height = 312;
					
					if ( 7 == $variation ){
						$width = 650;
						$height = 362;
					}
					
					echo '<div class="featured_shadow_bg">';
					
					if ( $video <> '' ) { 
						$video_embed = $wp_embed->shortcode( '', $video );
						if ( $video_embed == '<a href="'.esc_url($video).'">'.esc_html($video).'</a>' ) $video_embed = $video_manual_embed;
					} else {
						$video_embed = $video_manual_embed;
					}
														
					$video_embed = preg_replace('/<embed /','<embed wmode="transparent" ',$video_embed);
					$video_embed = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video_embed); 
					$video_embed = preg_replace("/height=\"[0-9]*\"/", "height={$height}", $video_embed);
					$video_embed = preg_replace("/width=\"[0-9]*\"/", "width={$width}", $video_embed);
					
					echo $video_embed;
					
					echo '</div> <!-- end .featured_shadow_bg -->';
					
					if ( 7 == $variation ) echo '<div class="clear"></div>';
				}
			?>
			
			<?php if ( 7 != $variation ) { ?>
				<div class="featured-description">
					<h2 class="featured-title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h2>
					<p><?php echo wp_kses_post( $description ); ?></p>
					<?php if ( in_array($variation, array(2,3,4,5)) ){ ?>
						<a href="<?php echo esc_url($link); ?>" class="featured-more"><span><?php echo esc_html( $link_custom_text ); ?></span></a>
					<?php } ?>
				</div> <!-- end .featured-description -->
			<?php } ?>
			
			<?php if ( in_array($variation, array(1,6,7,8)) ){ ?>
				<a href="<?php echo esc_url($link); ?>" class="featured-more et_centered"><span><?php echo esc_html( $link_custom_text ); ?></span></a>
			<?php } ?>
		</div> <!-- end .slide -->
<?php
		$et_first_slide = false;
		$ids[]= $post->ID;
	endwhile; wp_reset_query();	
?>
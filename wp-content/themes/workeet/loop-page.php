<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>				
	<?php if (get_option('leanbiz_page_thumbnails') == 'on') { ?>
		<?php 
			$thumb = '';
			$width = 190;
			$height = 190;
			$classtext = 'post-thumb';
			$titletext = get_the_title();
			$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
			$thumb = $thumbnail["thumb"];
		?>
		
		<?php if($thumb <> '') { ?>
			<div class="post-thumbnail">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
				<span class="post-overlay"></span>
			</div> 	<!-- end .post-thumbnail -->
		<?php } ?>
	<?php } ?>
	
	<h1 class="title"><?php the_title(); ?></h1>

	<?php the_content(); ?>
	<?php wp_link_pages(array('before' => '<p><strong>'.esc_attr__('Pages','LeanBiz').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	<?php edit_post_link(esc_attr__('Edit this page','LeanBiz')); ?>
<?php endwhile; // end of the loop. ?>
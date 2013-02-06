<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="entry post clearfix<?php if ( get_option('leanbiz_show_postcomments') == 'false' || 0 == get_comments_number() ) echo ' comments_disabled'; ?>">
		<?php if (get_option('leanbiz_integration_single_top') <> '' && get_option('leanbiz_integrate_singletop_enable') == 'on') echo(get_option('leanbiz_integration_single_top')); ?>
		
		<?php if ( get_option('leanbiz_postinfo2') <> '' && ( in_array( 'date', get_option('leanbiz_postinfo2') ) || in_array( 'comments', get_option('leanbiz_postinfo2') ) ) ) { ?>
			<div class="post-meta">
				<?php if ( in_array( 'date', get_option('leanbiz_postinfo2') ) ) { ?>
					<span class="post-meta-date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>
				<?php } ?>
				<?php if ( in_array( 'comments', get_option('leanbiz_postinfo2') ) ) { ?>
					<span class="meta-comment"><?php comments_popup_link( '0','1','%' ); ?></span>
				<?php } ?>
			</div> <!-- end .post-meta-->
		<?php } ?>
		
		<?php
			$thumb = '';
			$width = 191;
			$height = 191;
			$classtext = 'post-thumb';
			$titletext = get_the_title();
			$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
			$thumb = $thumbnail["thumb"];
		?>
		<?php if ( $thumb <> '' && get_option( 'leanbiz_thumbnails' ) == 'on' ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
					<span class="post-overlay"></span>
				</a>
			</div> 	<!-- end .post-thumbnail -->
		<?php } ?>
		
		<h1 class="title"><?php the_title(); ?></h1>
	
		<?php the_content(); ?>
		<?php if ( get_option('leanbiz_postinfo2') <> '' && ( in_array( 'author', get_option('leanbiz_postinfo2') ) || in_array( 'categories', get_option('leanbiz_postinfo2') ) ) ) { ?>
			<p class="meta-info"><?php esc_html_e('Escrito','LeanBiz'); ?><?php if (in_array('author', get_option('leanbiz_postinfo2'))) { ?> <?php esc_html_e('por','LeanBiz'); ?> <?php the_author_posts_link(); ?><?php } ?><?php if (in_array('categories', get_option('leanbiz_postinfo2'))) { ?> <?php esc_html_e('en','LeanBiz'); ?> <?php the_category(', ') ?><?php } ?> | <?php the_tags( 'Tags: ', $sep, $after ); ?></p>
		<?php } ?>
		<?php wp_link_pages(array('before' => '<p><strong>'.esc_attr__('Pages','LeanBiz').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php edit_post_link(esc_attr__('Edit this page','LeanBiz')); ?>
	</div> <!-- end .entry -->

	<?php if (get_option('leanbiz_integration_single_bottom') <> '' && get_option('leanbiz_integrate_singlebottom_enable') == 'on') echo(get_option('leanbiz_integration_single_bottom')); ?>		
					
	<?php if (get_option('leanbiz_468_enable') == 'on') { ?>
		<?php 
			if(get_option('leanbiz_468_adsense') <> '') echo(get_option('leanbiz_468_adsense'));
			else { ?>
			   <a href="<?php echo esc_url(get_option('leanbiz_468_url')); ?>"><img src="<?php echo esc_url(get_option('leanbiz_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
	   <?php } ?>   
	<?php } ?>

	<?php if (get_option('leanbiz_show_postcomments') == 'on') comments_template('', true); ?>
<?php endwhile; // end of the loop. ?>
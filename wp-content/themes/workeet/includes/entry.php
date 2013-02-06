<?php
	if ( is_home() ) {
		$args=array(
			'showposts'=> (int) get_option('leanbiz_homepage_posts'),
			'paged'=>$paged,
			'category__not_in' => (array) get_option('leanbiz_exlcats_recent'),
		);
		if (get_option('leanbiz_duplicate') == 'false'){
			global $ids;
			$args['post__not_in'] = $ids;
		}
		query_posts($args);
	}
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post clearfix">
		<?php if ( get_option('leanbiz_postinfo1') <> '' && ( in_array( 'date', get_option('leanbiz_postinfo1') ) || in_array( 'comments', get_option('leanbiz_postinfo1') ) ) ) { ?>
			<div class="post-meta">
				<?php if ( in_array( 'date', get_option('leanbiz_postinfo1') ) ) { ?>
					<span class="post-meta-date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>
				<?php } ?>
				<?php if ( in_array( 'comments', get_option('leanbiz_postinfo1') ) ) { ?>
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
		<?php if ( $thumb <> '' && get_option('leanbiz_thumbnails_index') == 'on' ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
					<span class="post-overlay"></span>
				</a>	
			</div> 	<!-- end .post-thumbnail -->
		<?php } ?>
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		
		<?php if (get_option('leanbiz_blog_style') == 'on') the_content(''); else { ?>
			<p><?php truncate_post(500); ?></p>
		<?php } ?>
		
			<?php if ( get_option('leanbiz_postinfo1') <> '' && ( in_array( 'author', get_option('leanbiz_postinfo1') ) || in_array( 'categories', get_option('leanbiz_postinfo1') ) ) ) { ?>
				<p class="meta-info"><?php esc_html_e('Escrito','LeanBiz'); ?><?php if (in_array('author', get_option('leanbiz_postinfo1'))) { ?> <?php esc_html_e('por','LeanBiz'); ?> <?php the_author_posts_link(); ?><?php } ?><?php if (in_array('categories', get_option('leanbiz_postinfo1'))) { ?> <?php esc_html_e('en','LeanBiz'); ?> <?php the_category(', ') ?>  | <?php the_tags( 'Tags: ', $sep, $after ); ?> <?php } ?></p>
			<?php } ?>
	</div> 
	
		<!-- end .post-->
	
<?php 
endwhile; 
	if (function_exists('wp_pagenavi')) { wp_pagenavi(); }
	else { get_template_part('includes/navigation','entry'); }
else:
	get_template_part('includes/no-results','entry');
endif;
if ( is_home() ) wp_reset_query(); ?>
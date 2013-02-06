<?php 
/* 
Template Name: Full Width Page
*/
?>
<?php get_header(); ?>

<?php get_template_part('includes/breadcrumbs','page'); ?>

<div id="content-border" class="fullwidth">
	<div id="content-top-border-shadow"></div>
	<div id="content-bottom-border-shadow"></div>
	<div id="content" class="clearfix">
		<div id="content-right-bg" class="clearfix">
			<div id="left-area">
				<div class="entry post clearfix<?php if ( get_option('leanbiz_show_pagescomments') == 'false' || 0 == get_comments_number() ) echo ' comments_disabled'; ?>">
					<?php get_template_part('loop','page'); ?>
				</div> <!-- end .entry -->
				<?php if (get_option('leanbiz_show_pagescomments') == 'on') comments_template('', true); ?>
			</div> 	<!-- end #left-area -->
		</div> <!-- end #content-right-bg -->	
	</div> <!-- end #content -->
</div> <!-- end #content-border -->	

<?php get_footer(); ?>
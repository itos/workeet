<?php 
/*
Template Name: Sitemap Page
*/
?>
<?php 
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>

<?php get_template_part('includes/breadcrumbs','page'); ?>

<div id="content-border" <?php if($fullwidth) echo ('class="fullwidth"');?>>
	<div id="content-top-border-shadow"></div>
	<div id="content-bottom-border-shadow"></div>
	<div id="content" class="clearfix">
		<div id="content-right-bg" class="clearfix">
			<div id="left-area">
				<div class="entry post clearfix<?php if ( get_option('leanbiz_show_pagescomments') == 'false' || 0 == get_comments_number() ) echo ' comments_disabled'; ?>">
					<?php get_template_part('loop','page'); ?>
					
					<div id="sitemap">
						<div class="sitemap-col">
							<h2><?php esc_html_e('Pages','LeanBiz'); ?></h2>
							<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
						
						<div class="sitemap-col">
							<h2><?php esc_html_e('Categories','LeanBiz'); ?></h2>
							<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
						
						<div class="sitemap-col<?php if (!$fullwidth) echo ' last'; ?>">
							<h2><?php esc_html_e('Tags','LeanBiz'); ?></h2>
							<ul id="sitemap-tags">
								<?php $tags = get_tags();
								if ($tags) {
									foreach ($tags as $tag) {
										echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li> ';
									}
								} ?>
							</ul>
						</div> <!-- end .sitemap-col -->
						
						<?php if (!$fullwidth) { ?>
							<div class="clear"></div>
						<?php } ?>
						
						<div class="sitemap-col<?php if ($fullwidth) echo ' last'; ?>">
							<h2><?php esc_html_e('Authors','LeanBiz'); ?></h2>
							<ul id="sitemap-authors" ><?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?></ul>
						</div> <!-- end .sitemap-col -->
					</div> <!-- end #sitemap -->
					
					<div class="clear"></div>
				</div> <!-- end .entry -->
				<?php if (get_option('leanbiz_show_pagescomments') == 'on') comments_template('', true); ?>
			</div> 	<!-- end #left-area -->
			<?php if (!$fullwidth){ ?>
				<div id="content-top-shadow"></div>
				<div id="content-bottom-shadow"></div>
				<div id="content-widget-light"></div>
				<?php get_sidebar(); ?>
			<?php } ?>
		</div> <!-- end #content-right-bg -->	
	</div> <!-- end #content -->
</div> <!-- end #content-border -->	

<?php get_footer(); ?>
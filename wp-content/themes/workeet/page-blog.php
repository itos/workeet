<?php 
/*
Template Name: Blog Page
*/
?>
<?php 
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;

$et_ptemplate_blogstyle = isset( $et_ptemplate_settings['et_ptemplate_blogstyle'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_blogstyle'] : false;

$et_ptemplate_showthumb = isset( $et_ptemplate_settings['et_ptemplate_showthumb'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showthumb'] : false;

$blog_cats = isset( $et_ptemplate_settings['et_ptemplate_blogcats'] ) ? (array) $et_ptemplate_settings['et_ptemplate_blogcats'] : array();
$et_ptemplate_blog_perpage = isset( $et_ptemplate_settings['et_ptemplate_blog_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_blog_perpage'] : 10;
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
					
					<div id="et_pt_blog">
						<?php $cat_query = ''; 
						if ( !empty($blog_cats) ) $cat_query = '&cat=' . implode(",", $blog_cats);
						else echo '<!-- blog category is not selected -->'; ?>
						<?php 
							$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
						?>
						<?php query_posts("showposts=$et_ptemplate_blog_perpage&paged=" . $et_paged . $cat_query); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<div class="et_pt_blogentry clearfix">
								<h2 class="et_pt_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<p class="et_pt_blogmeta"><?php esc_html_e('Escrito','LeanBiz'); ?> <?php esc_html_e('por','LeanBiz'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','LeanBiz'); ?> <?php the_time(get_option('leanbiz_date_format')) ?> <?php esc_html_e('en','LeanBiz'); ?> <?php the_category(', ') ?> | <?php the_tags( 'Tags: ', $sep, $after ); ?> | <?php comments_popup_link(esc_html__('0 comentarios','LeanBiz'), esc_html__('1 comentario','LeanBiz'), '% '.esc_html__('comments','LeanBiz')); ?></p>
								
								<?php $thumb = '';
								$width = 184;
								$height = 184;
								$classtext = '';
								$titletext = get_the_title();

								$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
								$thumb = $thumbnail["thumb"]; ?>
								
								<?php if ( $thumb <> '' && !$et_ptemplate_showthumb ) { ?>
									<div class="et_pt_thumb alignleft">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
										<a href="<?php the_permalink(); ?>"><span class="overlay"></span></a>
									</div> <!-- end .thumb -->
								<?php }; ?>
								
								<?php if (!$et_ptemplate_blogstyle) { ?>
									<p><?php truncate_post(550);?></p>
									<a href="<?php the_permalink(); ?>" class="readmore"><span><?php esc_html_e('read more','LeanBiz'); ?></span></a>
								<?php } else { ?>
									<?php
										global $more;
										$more = 0;
									?>
									<?php the_content(); ?>
								<?php } ?>
							</div> <!-- end .et_pt_blogentry -->
							
						<?php endwhile; ?>
							<div class="page-nav clearfix">
								<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
								else { ?>
									 <?php get_template_part('includes/navigation'); ?>
								<?php } ?>
							</div> <!-- end .entry -->
						<?php else : ?>
							<?php get_template_part('includes/no-results'); ?>
						<?php endif; wp_reset_query(); ?>
					
					</div> <!-- end #et_pt_blog -->
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
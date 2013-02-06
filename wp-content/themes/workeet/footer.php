					</div> <!-- end .container -->
					<?php 
						global $et_show_featured_slider;
						if ( $et_show_featured_slider ){
							echo '<a id="left-arrow" href="#">' . esc_html__('Previous','LeanBiz') . '</a>';
							echo '<a id="right-arrow" href="#">' . esc_html__('Next','LeanBiz') . '</a>';
						}
					?>
				</div> <!-- end #featured-light -->	
			</div> <!-- end #featured-shadow -->	
		</div> <!-- end #featured -->
		
		<?php if ( is_home() ) { ?>
			<?php if ( get_option('leanbiz_blog_style') == 'on' ) { ?>
				<div class="container">
					<div id="content-border">
						<div id="content-top-border-shadow"></div>
						<div id="content-bottom-border-shadow"></div>
						<div id="content" class="clearfix">
							<div id="content-right-bg" class="clearfix">
								<div id="left-area">
									<?php get_template_part('includes/entry','home'); ?>
								</div> 	<!-- end #left-area -->
								<div id="content-top-shadow"></div>
								<div id="content-bottom-shadow"></div>
								<div id="content-widget-light"></div>

								<?php get_sidebar(); ?>
							</div> <!-- end #content-right-bg -->	
						</div> <!-- end #content -->
					</div> <!-- end #content-border -->	
				</div> <!-- end .container -->	
			<?php } else { ?>
				<div id="featured-border">
					<div id="featured-bottom-shadow"></div>
				</div> <!-- end #featured-border -->
			<?php } ?>
		<?php } ?>
			
		<div id="footer">
			<div class="container">
				<?php if ( is_active_sidebar('footer-area') ) { ?>
					<div id="footer-widgets" class="clearfix">
						<?php dynamic_sidebar('footer-area'); ?>
					</div> <!-- end #footer-widgets -->
				<?php } ?>
				<div id="footer-bottom">
					<p>Copyright &copy; 2012 workeet. Todos los derechos reservados.</p> 
				</div> <!-- end #footer-bottom -->
			</div> <!-- end .container -->
		</div> <!-- end #footer -->		
	</div> <!-- end #et-wrapper -->
	
	<?php wp_footer(); ?>
</body>
</html>
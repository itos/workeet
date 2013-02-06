<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorpicker.css" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Kreon:light,regular' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, span.overlay, a.zoom-icon, a.more-icon, #menu, #menu-right, #menu-content, ul#top-menu ul, #menu-bar, .footer-widget ul li, span.post-overlay, #content-area, .avatar-overlay, .comment-arrow, .testimonials-item-bottom, #quote, #bottom-shadow, #quote .container');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8style.css" />
<![endif]-->

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script type="text/javascript">
  var _kmq = _kmq || [];
  function _kms(u){
    setTimeout(function(){
    var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
    s.src = u; f.parentNode.insertBefore(s, f);
    }, 1);
  }
  _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/28c177686d1a1aedff8a5061c831f2ba78cf0f87.1.js');
</script>

</head>
<body <?php body_class(); ?>>
	<div id="et-wrapper">
		<div id="header">
			<div class="container clearfix">
				<div id="fb-root"></div>
				<?php
					global $default_colorscheme;
					$colorSchemePath = '';
					$colorScheme = get_option('leanbiz_color_scheme');
					if ( $colorScheme <> $default_colorscheme ) $colorSchemePath = strtolower($colorScheme) . '/';
				?>
				<a href="<?php echo home_url(); ?>">
					<?php $logo = (get_option('leanbiz_logo') <> '') ? esc_attr(get_option('leanbiz_logo')) : get_template_directory_uri() . '/images/' . $colorSchemePath . 'logo.png'; ?>
					<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/>
				</a>
				<?php $menuClass = 'nav';
				if ( get_option('leanbiz_disable_toptier') == 'on' ) $menuClass .= ' et_disable_top_tier';
				$menuID = 'top-menu';
				$primaryNav = '';
				if (function_exists('wp_nav_menu')) {
					$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
				};
				if ($primaryNav == '') { ?>
					<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
						<?php if (get_option('leanbiz_home_link') == 'on') { ?>
							<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo home_url(); ?>"><?php esc_html_e('Blog','LeanBiz') ?></a></li>
						<?php }; ?>

						<?php show_page_menu($menuClass,false,false); ?>
						<?php show_categories_menu($menuClass,false); ?>
					</ul> <!-- end ul#nav -->
				<?php }
				else echo($primaryNav); ?>
				
				<?php do_action('et_header_top'); ?>
			</div> <!-- end .container -->
		</div> <!-- end #header -->
		
		<?php global $et_show_featured_slider;
			$et_show_featured_slider = is_home() && get_option('leanbiz_featured') == 'on';
		?>
		
		<div id="featured"<?php if ( $et_show_featured_slider ) echo ' class="home-featured-slider"'; ?>>
			<div id="featured-shadow">
				<div id="featured-light">
					<?php
						$et_slider_settings_class = '';
						if ( $et_show_featured_slider ) {
							$et_slider_auto = 'on' == get_option('leanbiz_slider_auto') ? ' et_slider_auto' : '';
							
							$et_slider_auto_speed = false !== get_option('leanbiz_slider_autospeed') ? get_option('leanbiz_slider_autospeed') : '7000';
							$et_slider_auto_speed = ' et_slider_autospeed_' . $et_slider_auto_speed;
							
							$et_slider_pause = 'on' == get_option('leanbiz_slider_pause') ? ' et_slider_pause' : '';
							
							$et_slider_settings_class = $et_slider_auto . $et_slider_auto_speed . $et_slider_pause;
						}
					?>
					<div <?php if ( $et_show_featured_slider ) echo ' id="main-featured-slider"'; ?> class="container<?php echo $et_slider_settings_class; ?>">
						<?php if ( $et_show_featured_slider ) get_template_part('includes/featured','home'); ?>
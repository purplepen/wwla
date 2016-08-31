<?php
/**
* The Header for our theme.
*
* @package Profile
* @since Profile 2.0
*
*/
?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<!-- Social Buttons -->
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	
	<?php get_template_part( 'style', 'options' ); ?>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrap -->
<div id="wrap">
	
	<!-- BEGIN #navigation -->
	<nav id="navigation" class="navigation-main mobile-nav" role="navigation">
		
		<span class="menu-toggle"><i class="fa fa-bars"></i></span>
		
		<?php if ( has_nav_menu( 'header-menu' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'title_li' => '',
				'depth' => 4,
				'container_class' => '',
				'menu_class'      => 'menu'
				)
			);
		} else { ?>
			<div class="menu-container"><ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul></div>
		<?php } ?>
	
	<!-- END #navigation -->			
	</nav>
	
	<?php $header_image = get_header_image(); ?>
	
	<!-- BEGIN #header -->
	<div id="header" class="<?php if ( is_home() ) { ?>home-header<?php } else { ?>default-header<?php } ?><?php if ( empty( $header_image ) ) { ?> empty-header<?php } ?>" <?php if ( ! empty( $header_image ) ) { ?> style="background-image: url(<?php header_image(); ?>);"<?php } ?>>
		
		<!-- BEGIN #header-info -->
		<div id="header-info">
	
			<!-- BEGIN .row -->
			<div class="row">
			
				<?php if ( is_home() ) { ?>
				
					<?php if ( get_theme_mod( 'profile_logo' ) ) { ?>
					
						<h1 id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'profile_logo' ) ); ?>" alt="" />
								<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
							</a>
						</h1>
						
					<?php } else { ?>
					
						<div id="masthead">
							<h1 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
						
					<?php } ?>
	
				<?php } else { ?>
				
					<?php if ( get_theme_mod( 'profile_logo' ) ) { ?>
					
						<h4 id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'profile_logo' ) ); ?>" alt="" />
								<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
							</a>
						</h4>
						
					<?php } else { ?>
					
						<div id="masthead">
							<h4 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h4>
							<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
						</div>
						
					<?php } ?>
					
				<?php } ?>
			
			<!-- END .row -->
			</div>
			
			<!-- BEGIN #navigation -->
			<nav id="navigation" class="navigation-main desktop-nav<?php if ( is_home() || is_front_page() ) { echo " home-nav"; } ?>" role="navigation">
				
				<?php if ( has_nav_menu( 'header-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'title_li' => '',
						'depth' => 4,
						'container_class' => '',
						'menu_class'      => 'menu'
						)
					);
				} else { ?>
					<div class="menu-container"><ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul></div>
				<?php } ?>
			
			<!-- END #navigation -->		
			</nav>
		
		<!-- END #header-info -->
		</div>
		
		<?php if ( is_home() && ! empty( $header_image ) ) { ?>
			<img id="custom-header" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo esc_attr( get_bloginfo() ); ?>" />
		<?php } ?>
	
	<!-- END #header -->
	</div>
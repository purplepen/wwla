<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container home">

	<?php if ( 'false' != get_theme_mod( 'page_featured_top' ) ) { ?>
	<?php if ( '' != get_theme_mod( 'page_featured_top' ) ) { ?>
	
	<!-- BEGIN #homepage -->
	<div id="homepage">
	
		<!-- BEGIN .row -->
		<div class="row">
			
			<!-- BEGIN .twelve columns -->
			<div class="twelve columns">
			
				<?php get_template_part( 'content/loop', 'home' ); ?>
				
			<!-- END .twelve columns -->
			</div>
			
		<!-- END .row -->
		</div>
	
	<!-- END #homepage -->
	</div>
	
	<?php } ?>
	<?php } ?>
	
	<?php if ( 'false' != get_theme_mod( 'category_slideshow_home' ) ) { ?>
	<?php if ( '' != get_theme_mod( 'category_slideshow_home' ) ) { ?>
	
	<!-- BEGIN #slideshow -->
	<div id="slideshow">
	
		<h2 class="headline borderless text-center"><?php echo esc_html( profile_cat_id_to_name(get_theme_mod('category_slideshow_home') ) ); ?></h2>

		<!-- BEGIN .row -->
		<div class="row">
		
			<!-- BEGIN .twelve columns -->
			<div class="twelve columns">
				
				<?php get_template_part( 'content/loop', 'slider' ); ?>
			
			<!-- END .twelve columns -->
			</div>
			
		<!-- END .row -->
		</div>
	
	<!-- END #slideshow -->
	</div>
	
	<?php } ?>
	<?php } ?>

<!-- END .container -->
</div>

<?php get_footer(); ?>
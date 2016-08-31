<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<?php $thumb = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'profile-featured-medium' ) : false; ?>
	
<!-- BEGIN .container -->
<div class="container">

	<?php if (get_theme_mod('display_feature_page') == '1') { ?>
	<?php if ( has_post_thumbnail() ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<div class="feature-img page" >
			<div class="banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url( $thumb[0] ); ?>);" <?php } ?>>
				<h1 class="headline img-headline"><?php the_title(); ?></h1>
				<?php the_post_thumbnail( 'profile-featured-medium' ); ?>
			</div>
		</div>
	
	<!-- END .row -->
	</div>
			
	<?php } ?>
	<?php } ?>
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
	
		<!-- BEGIN .eight columns -->
		<div class="eight columns">
		
			<!-- BEGIN .postarea blog -->
			<div class="postarea blog">
			
				<?php get_template_part( 'content/loop', 'blog' ); ?>
				
			</div>
			
		<!-- END .columns -->
		</div>
		
		<!-- BEGIN .four columns -->
		<div class="four columns">
		
			<?php get_sidebar('blog'); ?>
			
		<!-- END .four columns -->
		</div>
		
		<?php } else { ?>
		
		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">
		
			<!-- BEGIN .postarea blog -->
			<div class="postarea blog">
			
				<?php get_template_part( 'content/loop', 'blog' ); ?>
				
			</div>
			
		<!-- END .columns -->
		</div>
		
		<?php } ?>
	
	<!-- END .row -->
	</div>
	
<!-- END .container -->	
</div>

<?php get_footer(); ?>
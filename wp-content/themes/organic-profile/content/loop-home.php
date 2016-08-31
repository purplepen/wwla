<?php $page_top = new WP_Query('page_id='.get_theme_mod('page_featured_top')); while($page_top->have_posts()) : $page_top->the_post(); ?>
<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'profile-featured-square' ) : false; ?>

<div class="featured-page">
	
	<?php if ( has_post_thumbnail()) { ?>
		<div class="profile-img">
			<div class="feature-img cover-img" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>
				<?php the_post_thumbnail( 'profile-featured-square' ); ?>
			</div>
		</div>
	<?php } ?>
	
	<div class="information<?php if ( has_post_thumbnail()) { ?> has-profile<?php } ?>">
	
		<?php if ( '' != get_theme_mod( 'profile_twitter_widget_id' ) ) { ?>
			<?php require_once( trailingslashit( get_template_directory() ). 'includes/latest-tweet.php' ); ?>
			<div id="tweets"></div>
		<?php } ?>
		
		<?php if ( has_nav_menu( 'social-menu' ) ) { ?>
			
			<?php wp_nav_menu( array(
				'theme_location' => 'social-menu',
				'title_li' => '',
				'depth' => 1,
				'container_class' => 'social-menu',
				'menu_class'      => 'social-icons',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				)
			); ?>
			
		<?php } ?>
		
		<h2 class="headline text-center"><?php the_title(); ?></h2>
		<?php the_content(__("Read More", 'organic-profile')); ?>
	
	</div>
	
</div>

<?php endwhile; ?>
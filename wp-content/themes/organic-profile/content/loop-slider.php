<!-- BEGIN .flexslider -->
<div class="flexslider loading" data-speed="<?php echo get_theme_mod('transition_interval'); ?>" data-transition="<?php echo get_theme_mod('transition_style'); ?>">

	<div class="preloader"></div>

	<!-- BEGIN .slides -->
	<ul class="slides">
	
		<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_slideshow_home'), 'posts_per_page'=>get_theme_mod('postnumber_slideshow_home'), 'suppress_filters'=>0)); ?>
		<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['featurevid'][0]; ?>
		<?php global $more; $more = 0; ?>
		
		<li>
			<?php if ( $video ) : ?>
			    <div class="feature-vid"><?php echo $video; ?></div>
			<?php else: ?>
			    <?php if ( has_post_thumbnail()) { ?>
				    <a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'profile-featured-slide' ); ?></a>
			    <?php } else { ?>
			    	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-img.svg" alt="<?php the_title(); ?>" /></a>
			    <?php } ?>
			<?php endif; ?>
		</li>
		
		<?php endwhile; ?>
		<?php endif; ?>
		
	<!-- END .slides -->
	</ul>
	
<!-- END .flexslider -->
</div>

<img class="screen" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/screen.png" title="Screen" alt="Screen" />
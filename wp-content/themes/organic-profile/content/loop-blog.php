<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('category_blog'), 'posts_per_page'=>get_theme_mod('postnumber_blog'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
<?php if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
<?php global $more; $more = 0; ?>

<!-- BEGIN .post class -->
<div <?php post_class('blog-holder'); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .article -->
	<div class="article">
		
	    <h1 class="headline small text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h1>
	    <p class="post-date text-center"><span><i class="fa fa-clock-o"></i> <?php _e("Posted on", 'organic-profile'); ?> <?php the_time(__("M j, Y", 'organic-profile')); ?></span><?php if ( comments_open() || '0' != get_comments_number() ) { ?><span><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organic-profile'), __("1 Comment", 'organic-profile'), '% Comments'); ?></a></span><?php } ?></p>
	    
        <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
        	<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
        <?php } else { ?>
            <?php if ( has_post_thumbnail()) { ?>
            	<a class="feature-img blog-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organic-profile' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'profile-featured-medium' ); ?></a>
            <?php } ?>
        <?php } ?>
    
    	<?php the_content(__("Read More", 'organic-profile')); ?>
    	
    <!-- END .article -->
    </div>

<!-- END .post class -->
</div>

<?php endwhile; ?>

	<?php if ($wp_query->max_num_pages > 1) { ?>
		<div class="pagination">
			<?php echo get_pagination_links(); ?>
		</div><!-- END .pagination -->
	<?php } ?>

<?php else : // do not delete ?>
        
<div class="error-404">
    <h1 class="headline"><?php _e("Page not Found", 'organic-profile'); ?></h1>
    <p><?php _e("We're sorry, but the page you're looking for isn't here.", 'organic-profile'); ?></p>
    <p><?php _e("Try searching for the page you are looking for or using the navigation in the header or sidebar", 'organic-profile'); ?></p>
</div>

<?php endif; // do not delete ?>
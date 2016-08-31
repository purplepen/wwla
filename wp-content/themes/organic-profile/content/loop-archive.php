<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
	<!-- BEGIN .postarea archive -->
    <div class="postarea archive">
        
        <div class="information">    
                  
            <h2 class="headline small text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>
            
            <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
            		<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
            <?php } else { ?>
                <?php if ( has_post_thumbnail()) { ?>
                	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organic-profile' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'profile-featured-medium' ); ?></a>
                <?php } ?>
            <?php } ?>
            
            <?php the_excerpt(); ?>
            
            <a class="button" href="<?php the_permalink(); ?>"><?php _e("Read More", 'organic-profile'); ?></a>
            
        </div>
    
    </div><!-- END .postarea archive -->

<?php endwhile; ?>

	<?php if($wp_query->max_num_pages > 1) { ?>
		<div class="pagination archive">
			<?php echo get_pagination_links(); ?>
		</div><!-- END .pagination -->
	<?php } ?>

<?php else : ?>

	<!-- BEGIN .postarea archive -->
    <div class="postarea archive">

       	<h1 class="headline"><?php _e("No Posts Found", 'organic-profile'); ?></h1>
        <p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organic-profile'); ?></p>
    
	</div><!-- END .postarea archive -->
	
<?php endif; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>

<h1 class="headline text-center"><?php the_title(); ?></h1>

<?php if (get_theme_mod('display_feature_post') == '1') { ?>
    <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
    	<div class="feature-vid post"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
    <?php } else { ?>
        <?php if ( has_post_thumbnail() ) { ?>
        	<div class="feature-img post"><?php the_post_thumbnail( 'profile-featured-medium' ); ?></div>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php the_content(); ?>

<?php wp_link_pages(array(
    'before' => '<p class="page-links"><span class="link-label">' . __('Pages:', 'organic-profile') . '</span>',
    'after' => '</p>',
    'link_before' => '<span>',
    'link_after' => '</span>',
    'next_or_number' => 'next_and_number',
    'nextpagelink' => __('Next', 'organic-profile'),
    'previouspagelink' => __('Previous', 'organic-profile'),
    'pagelink' => '%',
    'echo' => 1 )
); ?>

<!-- BEGIN .post-meta -->
<div class="post-meta">
	
	<div class="six columns">
		<p><i class="fa fa-reorder"></i> <?php _e("Category:", 'organic-profile'); ?> <?php the_category(', '); ?></p>
		<?php $tag_list = get_the_tag_list( __( ", ", 'organic-profile' ) ); if ( ! empty( $tag_list ) ) { ?>
			<p><i class="fa fa-tags"></i> <?php _e("Tagged:", 'organic-profile'); ?> <?php the_tags(''); ?></p>
		<?php } ?>
	</div>
	
	<?php if (get_theme_mod('display_social_post') == '1') { ?>
	<div class="six columns">
		<?php get_template_part( 'social', 'share' ); ?>
	</div>
	<?php } ?>

<!-- END .post-meta -->
</div>

<div class="post-navigation">
	<div class="previous-post"><?php previous_post_link('&larr; %link'); ?></div>
	<div class="next-post"><?php next_post_link('%link &rarr;'); ?></div>
</div><!-- .post-navigation -->

<?php if ( comments_open() || '0' != get_comments_number() ) comments_template(); ?>

<div class="clear"></div>        

<?php endwhile; else: ?>
<p><?php _e("Sorry, no posts matched your criteria.", 'organic-profile'); ?></p>
<?php endif; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if ( ! has_post_thumbnail() ) { ?>
	<h1 class="headline"><?php the_title(); ?></h1>
<?php } ?>

<?php the_content(__("Read More", 'organic-profile')); ?>

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

<div class="clear"></div>
<?php edit_post_link(__("(Edit)", 'organic-profile'), '', ''); ?>

<?php endwhile; else: ?>

<p><?php _e("Sorry, no posts matched your criteria.", 'organic-profile'); ?></p>

<?php endif; ?>
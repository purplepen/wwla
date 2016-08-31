<?php get_header(); ?>

<!-- BEGIN .container archive -->
<div class="container archive">

	<!-- BEGIN .post class -->
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<!-- BEGIN .row -->
		<div class="row">
		
			<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
		
				<!-- BEGIN .eight columns -->
				<div class="eight columns">
		
					<?php get_template_part( 'content/loop', 'archive' ); ?>
			    
			    <!-- END .eight columns -->
			    </div>
			    
			    <!-- BEGIN .four columns -->
			    <div class="four columns">
			    
			    	<?php get_sidebar(); ?>
			    
			    <!-- END .four columns -->
			    </div>
			    
			<?php else : ?>
			
				<!-- BEGIN .twelve columns -->
				<div class="twelve columns">
		
					<?php get_template_part( 'content/loop', 'archive' ); ?>
			    
			    <!-- END .twelve columns -->
			    </div>
			    
			<?php endif; ?>
	    
	    <!-- END .row -->
	    </div>
    
    <!-- END .post class -->
    </div>
    
<!-- END .container archive -->
</div>

<?php get_footer(); ?>
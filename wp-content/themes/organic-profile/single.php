<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">

	<!-- BEGIN .row -->
	<div class="row">
	
		<?php if ( is_active_sidebar( 'right-sidebar' ) ) { ?>
	
		<!-- BEGIN .eight columns -->
		<div class="eight columns">
	  		
	  		<!-- BEGIN .postarea -->
		    <div class="postarea">
		    	
		    	<!-- BEGIN .post class -->
		    	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		    	
				 	<?php get_template_part( 'content/loop', 'single' ); ?>
				
				<!-- END .post class -->
			    </div>
		    
		    <!-- END .postarea -->
		    </div>
	    
	    <!-- END .eight columns -->
	    </div>
	    
	    <!-- BEGIN .four columns -->
	    <div class="four columns">
	    
	    	<?php get_sidebar(); ?>
	    	
	    <!-- END .four columns -->
	    </div>
	    
	    <?php } else { ?>
	    
	    <!-- BEGIN .twelve columns -->
	    <div class="twelve columns">
	    		
	    	<!-- BEGIN .postarea -->
	        <div class="postarea full">
	        	
	        	<!-- BEGIN .post class -->
	        	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	        	
	    		 	<?php get_template_part( 'content/loop', 'single' ); ?>
	    		
	    		<!-- END .post class -->
	    	    </div>
	        
	        <!-- END .postarea -->
	        </div>
	    
	    <!-- END .twelve columns -->
	    </div>
	    
	    <?php } ?>
    
    <!-- END .row -->
    </div>
 
<!-- END .container -->
</div>

<?php get_footer(); ?>
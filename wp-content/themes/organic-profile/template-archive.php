<?php
/*
Template Name: Archive
*/
?>

<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">
	
	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">
			
			<!-- BEGIN .postarea full -->
		    <div class="postarea full clearfix">
		
		        <h1 class="headline"><?php the_title(); ?></h1>		
		
		        <div class="archive-column">
		            <h6><?php _e("By Page:", 'organic-profile'); ?></h6>
		            <ul><?php wp_list_pages('title_li='); ?></ul>      
		        </div>		
		
		        <div class="archive-column">
		            <h6><?php _e("By Post:", 'organic-profile'); ?></h6>
		            <ul><?php wp_get_archives('type=postbypost&limit=100'); ?></ul>
		        </div>
		        
		        <div class="archive-column last">	
		        	<h6><?php _e("By Month:", 'organic-profile'); ?></h6>
    	            <ul><?php wp_get_archives('type=monthly'); ?></ul>	
    	
    	            <h6><?php _e("By Category:", 'organic-profile'); ?></h6>
    	            <ul><?php wp_list_categories('sort_column=name&title_li='); ?></ul>	
    	        </div>            
			
			<!-- END .postarea full -->
		    </div>
		
		<!-- END .twelve columns --> 
		</div>
	
	<!-- END .row -->
	</div>

<!-- END .container -->
</div>

<?php get_footer(); ?>
<?php
/*
Template Name: Slideshow
*/
?>

<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">
	
	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">
			
			<!-- BEGIN #slideshow -->
			<div id="slideshow" class="slideshow-page">
				
				<!-- BEGIN .flexslider -->
				<div class="flexslider loading" data-speed="<?php echo get_theme_mod('transition_interval'); ?>" data-transition="<?php echo get_theme_mod('transition_style'); ?>">
				
					<!-- BEGIN .slides -->
					<ul class="slides">
							
						<?php $data = array(
					    	'post_parent'		=> $post->ID,
					    	'post_type' 		=> 'attachment',
					    	'post_mime_type' 	=> 'image',
					    	'order'         	=> 'ASC',
					    	'orderby'	 		=> 'menu_order',
					        'numberposts' 		=> -1
						); ?>
						
						<?php 
						$images = get_posts($data); foreach( $images as $image ) { 
							$imageurl = wp_get_attachment_url($image->ID);
							echo '<li><img src="'.$imageurl.'" /></li>' . "\n";
						} ?>
						
					<!-- END .slides -->
					</ul>
					
				<!-- END .flexslider -->
				</div>
			
			<!-- END #slideshow -->
			</div>
				
			<!-- BEGIN .postarea full -->
			<div class="postarea full">
		
		        <?php get_template_part( 'content/loop', 'page' ); ?>
		    
		    <!-- END .postarea full -->
		    </div>
		
		<!-- END .twelve columns -->
		</div>
		
	<!-- END .row -->
	</div>

<!-- END .container -->
</div>
		

<?php get_footer(); ?>
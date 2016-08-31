<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">

	<!-- BEGIN .post class -->
	<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
		
		<!-- BEGIN .row -->
		<div class="row">
			
			<!-- BEGIN .twelve columns -->
			<div class="twelve columns">
				
				<!-- BEGIN .postarea full -->
			    <div class="postarea full">
		
					<?php get_template_part( 'content/loop', 'portfolio' ); ?>
				
				<!-- END .postarea full -->
				</div>
			
			<!-- END .twelve columns -->
			</div>
		
		<!-- END .row -->
		</div>
	
	<!-- END .post class -->
	</div>

<!-- END .container -->
</div>

<?php get_footer(); ?>
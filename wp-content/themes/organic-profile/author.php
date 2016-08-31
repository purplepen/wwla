<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">

	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .eight columns -->
		<div class="eight columns">
		
			<!-- BEGIN .postarea -->
			<div class="postarea">
        
				<?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
		
				<h1 class="headline"><?php echo $curauth->display_name; ?></h1>
		        
		        <div class="author-avatar">
		       		<?php if(function_exists('get_avatar')) { echo get_avatar($author, '120'); } ?>
		       	</div>
		        
				<!-- BEGIN .author_column -->
		        <div class="author-column">
		        	
		            <h6><?php _e("Website:", 'organic-profile'); ?></h6>
		            <p><a href="<?php echo $curauth->user_url; ?>" rel="bookmark" title="<?php esc_attr_e("Link to author page", 'organic-profile'); ?>" target="_blank"><?php echo $curauth->user_url; ?></a></p>
		            
		            <h6><?php _e("Profile:", 'organic-profile'); ?></h6>
		            <p><?php echo $curauth->user_description; ?></p>
		            
		            <h6><?php _e("Posts by", 'organic-profile'); ?> <?php echo $curauth->display_name; ?>:</h6>
		            
		            <ul>
		                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		                <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organic-profile' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></li>
		                <?php endwhile; else: ?>
		                <p><?php _e("No posts by this author.", 'organic-profile'); ?></p>
		                <?php endif; ?>
		            </ul>
		        
		        </div><!-- END author column -->
	        
	        </div><!-- END .postarea -->
	        
	    </div><!-- END eight columns -->
	    
	    <div class="four columns">
	    	<?php get_sidebar( 'right-sidebar' ); ?>
	    </div><!-- END .four columns -->
        
	</div><!-- END .row -->

</div><!-- END .container -->

<?php get_footer(); ?>
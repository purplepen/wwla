<div class="clear"></div>

<!-- BEGIN #footer -->
<div id="footer">

	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">
	
		    <div class="footer">
		        <p><?php _e("Copyright", 'organic-profile'); ?> &copy; <?php echo date(__("Y", 'organic-profile')); ?> &middot; <?php _e("All Rights Reserved", 'organic-profile'); ?> &middot; <?php bloginfo('name'); ?></p>
		        
		        <p><a href="http://www.organicthemes.com/themes/profile-theme/" target="_blank"><?php _e("Profile Theme", 'organic-profile'); ?></a> <?php _e("by", 'organic-profile'); ?> <a href="http://www.organicthemes.com" target="_blank"><?php _e("Organic Themes", 'organic-profile'); ?></a> &middot; <a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><?php _e("RSS Feed", 'organic-profile'); ?></a> &middot; <?php wp_loginout(); ?></p>
		    </div>
	    
	    <!-- END .twelve columns -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END #footer -->
</div>

<!-- END #wrap -->
</div>

<?php wp_footer(); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=246727095428680";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
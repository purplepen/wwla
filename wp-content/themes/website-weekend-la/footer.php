<div class="clear"></div>

<!-- BEGIN #footer -->
<div id="footer">

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">

			<?php if ( has_nav_menu( 'social-menu' ) ) { ?>

				<?php wp_nav_menu( array(
					'theme_location' => 'social-menu',
					'title_li' => '',
					'depth' => 1,
					'container_class' => 'social-menu',
					'menu_class'      => 'social-icons',
					'link_before'     => '<span>',
					'link_after'      => '</span>',
					)
				); ?>

			<?php } ?>


		    <div class="footer">
		        <p><?php _e("Copyright", 'organic-profile'); ?> &copy; <?php echo date(__("Y", 'organic-profile')); ?> &middot; <?php _e("All Rights Reserved", 'organic-profile'); ?> &middot; <?php bloginfo('name'); ?></p>

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
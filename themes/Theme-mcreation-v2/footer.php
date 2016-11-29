	<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->


		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
  var owl1 = $("#owl-techn");
  var owl2 = $("#owl-graph");
  var owl3 = $("#owl-home");
 
  owl1.owlCarousel({
     
      itemsCustom : [
        [0, 2],
        [450, 4],
        [600, 5],
        [700, 7],
        [1000, 8],
        [1200, 9],
        [1400, 10],
        [1600, 12]
      ],
      navigation : true
 
  });
 
  owl2.owlCarousel({
     
      itemsCustom : [
        [0, 2],
        [450, 4],
        [600, 5],
        [700, 7],
        [1000, 8],
        [1200, 9],
        [1400, 10],
        [1600, 12]
      ],
      navigation : true
 
  });
	
	owl3.owlCarousel({
     
      itemsCustom : [
        [0, 2],
        [450, 2],
        [600, 3],
        [700, 3],
        [1000, 4],
        [1200, 4],
        [1400, 4],
        [1600, 4]
      ],
      navigation : true
 
  });	
	
});
</script>
	</body>
</html>

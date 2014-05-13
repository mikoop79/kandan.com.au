
<!-- FOOTER GOES HERE -->
<div id="footer">

	<div id="social-media-icons" class="">
			<a data-bypass="true" href="https://twitter.com/kandanmedia" class="twitter first" target="_blank"></a>
			<a data-bypass="true" href="http://instagram.com/kandanmedia#" class="instagram" target="_blank"></a>
			<a data-bypass="true" href="http://au.linkedin.com/company/kandan?trk=ppro_cprof" class="linkedin" target="_blank"></a>
			<a data-bypass="true" href="https://www.facebook.com/kandanmedia" class="facebook last" target="_blank"></a>
		</div>
<?php
	// pho script to do its magic for the appropriate  title on each page menu.
	// show the connect with us button on every page exept the connect with us page.
	
	
	$isItConnect= stripos($url, 'connect-with-us');

	if ($isItConnect != '1'): ?>
	<div class="row centered connect-btn">
		<a href="/connect-with-us/"class="btn btn-default btn-lg kandan">Connect with Us</a>
	</div>
	
<?php endif ?>

</div> <!-- END OF FOOTER -->


</div> <!-- END OF WRAPPER -->

<?php wp_footer(); ?>


<script type="text/javascript">
	// <!-- GOOD OLD GOOGLE ANALYTICS -->
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18439226-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

	$(".wp-caption a").click(function(e) {
    		e.preventDefault();
   	});

</script>

</body>

</html>
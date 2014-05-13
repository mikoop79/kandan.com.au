<div id="footer">
	<div class="content-section">
		<h2>Connect with us</h2>
		<div class="arrow"></div>
		<div class="invisible-button"></div>
		
		<script type="text/javascript">
		/* SETS COOKIE FOR CLOSED CONTACTS AREA */
		$(document).ready(function(){
		var closeContacts = $.cookie("closedContactsCookie");

		if (closeContacts == 'yes'){
				//console.log("yes");
				$("#footer-logo").fadeOut();
		} else {
				//console.log("no");
				$("#footer-logo").fadeIn();
		}

	    });

		$('#footer .content-section .invisible-button').click(function(){

			closeContacts = $.cookie("closedContactsCookie");

			if (closeContacts == 'yes'){
				var setClosedContacts = 'no';
				$(this).siblings('.arrow').removeClass('closed');
				$('#footer_address').slideDown();
				$("#footer-logo").fadeIn();
				/* $('#services-products-clients-people').slideDown(); */
				$.cookie("closedContactsCookie", setClosedContacts, { path: '/' })
			}

			if (closeContacts != 'yes'){
				var setClosedContacts = 'yes';
				$("#footer-logo").fadeOut();
				$(this).siblings('.arrow').addClass('closed');
				$('#footer_address').slideUp();
				/* $('#services-products-clients-people').slideUp(); */
				$.cookie("closedContactsCookie", setClosedContacts, { path: '/' })
			}
			
			
		});


	//click links bacame disabled with rollover links for main nav bar
	$("#primary_nav li").each(function(){
		if ($(this).hasClass("current_page_item")){
			$(this).children('a').removeAttr("href");
		}	
	});
		</script>	
	</div>

	<div id="footer_address">
		<h4>Contact details</h4>
		<p>Kandan Media Pty Ltd<br />
		31 Ross St, South Melbourne<br />
		Victoria Australia 3205<br /><br />
		PO Box 27 Port Melbourne<br />
		Victoria Australia 3207<br /><br />
		Phone 03 9676 7100</p>
		<div id="social-media-icons" class="">
			<a href="https://twitter.com/kandanmedia" class="twitter" target="_blank"></a>
			<a href="http://instagram.com/kandanmedia#" class="instagram" target="_blank"></a>
			<a href="http://au.linkedin.com/company/kandan?trk=ppro_cprof" class="linkedin" target="_blank"></a>
			<a href="https://www.facebook.com/kandanmedia" class="facebook" target="_blank"></a>
		</div> 	
	</div>

</div>


</div> <!-- WRAPPER -->


<div id="services-products-clients-people">

	<div id="services-products-clients-people-content" class="">

	<div class="column services">
		<!-- SERVICES -->	
		<span><?php echo get_cat_name(2);?></span>
		<ul><?php 
		make_custom_link_for_cat('#', 2, 9);
		//wp_list_categories('orderby=count&use_desc_for_title=0&number=9&child_of=2&title_li='); 

		?></ul>
	</div>
	<div class="column">
		<!-- PRODUCTS -->		
		<span><?php echo get_cat_name(6);?></span>
		<ul><?php wp_list_categories('orderby=count&use_desc_for_title=0&number=9&child_of=6&title_li='); ?></ul>
	</div>
	<div class="column clients">
		<!-- CLIENTS -->	
		<span><?php echo get_cat_name(4);?></span>
	
		<ul id="the-clients">
		<?php 
		the_clients('#', 4, 19);
		//wp_list_categories('orderby=count&use_desc_for_title=0&number=9&child_of=2&title_li=');

		?>


		</ul>		
	</div>

	<div class="column people">
		<!-- PEOPLE -->		
		<span>People</span>
		<ul>
			<?php
			global $post;
			$args = array( 'posts_per_page' => 18, 'post_type' =>'the_people', 'orderby' => 'title', 'order' => 'ASC' );
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>				
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>	
			
		</ul>
	</div>
</div>

</div>

<?php wp_footer(); ?>

<!-- GOOGLE ANALYTICS -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18439226-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>      

</body>

</html>
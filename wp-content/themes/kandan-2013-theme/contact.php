<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<div id="contact_page">

	<div id="content">	 
		
		<div class="page-image"><?php echo get_the_post_thumbnail(); ?></div>      

		<?php the_post(); ?>        

		<?php the_content(); ?>   
	
		<div class="column first">
			<p>Kandan Media Pty Ltd<br />
			31 Ross Street South Melbourne<br />
			Victoria Australia 3205</p>
	
			<p>PO Box 27 Port Melbourne<br />
			Victoria Australia 3207</p>

			<p>Phone: +61 3 9676 7100</p>
			<br>
		<?php
		// add the social icons
		if (function_exists(get_social_media_icons))

			{
				get_social_media_icons();
			
			}

		?>	
</div>

		<div class="column">
			<p><strong>Kane Gray</strong></p>
			<span class="contact-title">Operations Director</span>
			
			<p>Phone: +61 3 9676 7101<br />

			<a href="mailto:kane.gray@kandan.com.au">kane.gray@kandan.com.au</a></p>

			<p class="endp"><strong>Frank Longo</strong></p>
			<span class="contact-title">Account Manager</span>
			<p>Phone: +61 3 9676 7104<br />

			<a href="mailto:frank.longo@kandan.com.au">frank.longo@kandan.com.au</a></p>
		</div>
		<div class="column">
			<p><strong>Daniel Boi</strong></p>
			<span class="contact-title">Creative Director</span>
			
			<p>Phone: +61 3 9676 7102<br />

			<a href="mailto:daniel.boi@kandan.com.au">daniel.boi@kandan.com.au</a></p>

			<p class="endp"><strong>Etienne Rizzo</strong></p>
			<span class="contact-title">Account Manager</span>
			<p>Phone: +61 3 9676 7114<br />

			<a href="mailto:etienne.rizzo@kandan.com.au">etienne.rizzo@kandan.com.au</a></p>
		</div>

		<div class="column last">
			<p><strong>Accounts</strong><br />
			<a href="mailto:accounts@kandan.com.au">accounts@kandan.com.au</a></p>

			<p><strong>Careers</strong><br />
			<a href="mailto:careers@kandan.com.au">careers@kandan.com.au</a></p>
		</div>
	</div>
 
</div>

<?php get_footer(); ?>

<!-- REMOVES CONTACT DETAILS COMPLETELY FOR THIS PAGE ONLY -->

<script>

$(document).ready(function(){
	$('#footer_address').remove();
	$('.content-section').remove();
});

/* REMOVES ADDS THE LINE UNDER THE NAV MENU */
$('#header-line').css({'border-bottom':'solid 0px #B2B2B2'});

$(window).scroll(function () {
    $('#content').each(function () {
        if (($(this).offset().top - $(window).scrollTop()) < 0) {
            $('#header-line').stop().css({'border-bottom':'solid 1px #B2B2B2'});
        } else {
            $('#header-line').stop().css({'border-bottom':'solid 0px #B2B2B2'});
        }
    });
});

</script>
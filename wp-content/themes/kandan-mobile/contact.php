<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 
<div id="contact_page">

	<div id="content">	 
		
		<div class="page-image contact" style=""></div>      

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
		</div>
		<div class="column">
			<p class="name">Kane Gray</p>
			<span class="contact-title">Operations Director</span>
			<p>Phone: +61 3 9676 7101<br />
			<a href="mailto:kane.gray@kandan.com.au">kane.gray@kandan.com.au</a></p>
			<p class="endp name">Frank Longo</p>
			<span class="contact-title">Account Manager</span>
			<p>Phone: +61 3 9676 7104<br />
			<a href="mailto:frank.longo@kandan.com.au">frank.longo@kandan.com.au</a></p>
			
		</div>

		<div class="column">
			<p class="name">Daniel Boi</p>
			<span class="contact-title">Creative Director</span>
			
			<p>Phone: +61 3 9676 7102<br />

			<a href="mailto:daniel.boi@kandan.com.au">daniel.boi@kandan.com.au</a></p>

			<p class="name endp">Etienne Rizzo</p>
			<span class="contact-title">Account Manager</span>
			<p>Phone: +61 3 9676 7114<br />

			<a href="mailto:etienne.rizzo@kandan.com.au">etienne.rizzo@kandan.com.au</a></p>
		</div>

		<div class="column last">
			<p>Accounts<br />
			<a href="mailto:accounts@kandan.com.au">accounts@kandan.com.au</a></p>

			<p>Careers<br />
			<a href="mailto:careers@kandan.com.au">careers@kandan.com.au</a></p>
		</div>
	</div>
 
</div>

<?php get_footer(); ?>

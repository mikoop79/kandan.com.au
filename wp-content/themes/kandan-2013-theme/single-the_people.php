<?php get_header(); ?>

<div id="people_page">

	<div id="content"> 

		<ul id="faces">
		<li>
			<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people2'); endif; ?>		
		</li>

		<li>
			<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people4'); endif; ?>
		</li>		
		</ul>

		<div class="page-content">

			<?php the_post(); ?>  

			<div class="people-name">
				<?php echo get_post_meta($post->ID, '_peoplename', true) ?>
			</div>

			<div class="people-title">
				<?php echo get_post_meta($post->ID, '_peopletitle', true) ?>
			</div>  

			<div class="the-line"></div>
			
			<?php the_content(); ?>   		

		</div>		

		<!-- PAGINATION -->
		
		<!-- <div id="post_pagination">
			<?php //previous_post_link('%link', '<span class="prev-posts"></span>', 'yes'); ?> 
			<?php //next_post_link('%link', '<span class="next-posts"></span>', 'yes'); ?> 
		</div> -->
		
	</div>
 
</div>

<script>

/* ACTIVATE SLIDERS */

$('#faces').innerFade({
	speed: 'slow',
	timeout: 4000,
	type: 'sequence',
	containerheight: 'auto',
	nextLink: '#next',
	prevLink: '#prev'
});

$(document).ready(function(){

	/* INJECTS THE CSS VIA JS (keeps the document W3C compliant) */
	var newCSS = '<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/black.css" media="screen" />';
	$('head').append(newCSS);

	/* SHOWS THE BACK BUTTON */
	$('#the_work-close-button').fadeIn();

});

</script>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?>

<div class="ajax-content">


<!-- PAGE CONTENT2 -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<div class="people_page-img">
<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people2', NULL,  'post-the_people2-thumbnail'); endif; ?>
</div>

<div id="people_page">
		
	<?php the_post(); ?>  

	<h2><?php echo get_post_meta($post->ID, '_peoplename', true) ?></h2>
			
	<h3><?php echo get_post_meta($post->ID, '_peopletitle', true) ?></h3>
			
	<?php the_content(); ?>   			
 
</div>

</div>

<?php get_footer(); ?>


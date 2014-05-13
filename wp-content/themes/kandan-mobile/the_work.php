<?php
/*
Template Name: The Work
*/
?>
<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">

<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<ul id="landing-the_work">
	<?php
		global $post;
		$args = array( 'posts_per_page' => -1, 'post_type' =>'the_work' , 'orderby' => 'ASC');
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
		<li class="<?php foreach((get_the_category()) as $childcat) { if (cat_is_ancestor_of(2, $childcat)) {echo $childcat->slug;echo" ";  } } ?>">
			<a href="<?php the_permalink() ?>">
				<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
				
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
				<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>

				<?php //the_excerpt(); ?>	
							
			</a>

		</li>
	
		<?php endforeach; ?>	
		</ul>		
		




</div>

<?php get_footer(); ?>

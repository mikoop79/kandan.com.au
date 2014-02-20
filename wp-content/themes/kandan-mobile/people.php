<?php
/*
Template Name: People & Culture
*/
?>

<?php
/*
Template Name: The Work
*/
?>

<!-- ONLY LOAD HEADER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>
<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">

<?php }?>

<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<div id="people-listing_page">
	<ul>
	<?php
		global $post;
		$args = array( 'posts_per_page' => 100, 'post_type' =>'the_people' , 'orderby' => 'rand');
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
		<li>
			<a href="<?php the_permalink() ?>">
					
			
			<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people1'); endif; ?>			
			
			<h2><?php echo get_post_meta($post->ID, '_peoplename', true) ?></h2>
			<h3><?php echo get_post_meta($post->ID, '_peopletitle', true) ?></h3>
				
			</a>
		</li>
		<?php endforeach; ?>	
	</ul>	
</div>
		
<!-- ONLY LOAD FOOTER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>

</div>

<?php get_footer(); ?>
<?php }?>
		
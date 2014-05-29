<?php
/*
Template Name: People & Culture
*/
?>

<?php get_header(); ?>

<div id="people-listing_page">

	<div id="content">

		<div class="left-column">	

		<ul>
		<?php
			global $post;
			$args = array( 'posts_per_page' => 100, 'post_type' =>'the_people' , 'orderby' => 'ASC');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
				<a href="<?php the_permalink() ?>">

					<div class="funny-face">
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people3'); endif; ?>
					</div>
					<div class="serious-face">
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people1'); endif; ?>			
					</div>

					
				
				</a>
			</li>
		<?php endforeach; ?>	
		</ul>	

		</div>

		<div class="right-column">	
			<?php the_post(); ?>  
			<?php the_content(); ?>
			<div class="the-line"></div>
			<?php the_secondary_content(); ?> 
		</div>	
	</div>
 
</div>

<script>

/* INJECTS THE CSS VIA JS (keeps the document W3C compliant) */

$(document).ready(function(){
	var newCSS = '<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/black.css" media="screen" />';
	$('head').append(newCSS);
});

</script>

<?php get_footer(); ?>
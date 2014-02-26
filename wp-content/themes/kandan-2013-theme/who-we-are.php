<?php
/*
Template Name: Who We Are
*/
?>

<?php get_header(); ?>

<div id="who-we-are_page">

	<div id="content">

		<div class="left-column min-h-355">		

			<?php the_post(); ?>  
			<?php the_content(); ?>  

		</div>

		<div class="right-column">
			<?php the_post_thumbnail( 'full' ); ?> 
		</div>

		<div class="left-column">
			<?php the_secondary_content(); ?> 
		</div>
		
		<div class="right-column">

		<h6>Our team</h6>

		<ul class="people-culture">
		
		<?php
			global $post;
			$args = array( 'posts_per_page' => 3, 'post_type' =>'the_people' , 'levels' => 'sticky', 'orderby' => 'rand');
			$myposts = get_posts( $args );
			$i = 1;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>

<li class="<?php if($i == 3) echo "last";  ?>" >
				<a href="<?php the_permalink() ?>">
					<div class="hover-arrows"></div>
					<div class="hover-arrows-hover"></div>
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people1'); endif; ?>
				
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_peoplename', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_peopletitle', true) ?>
				</div>
				</a>
			</li>
			
			<?php if($i == 3){$i = 1;} else {$i++;} ?>
		<?php endforeach; ?>	

			
		</ul>	
		<a class="see-all" href="/people-culture" >View the team <span class="kandan-blue"> >> </span></a>
		</div>
	
	</div>
 
</div>


<?php get_footer(); ?>
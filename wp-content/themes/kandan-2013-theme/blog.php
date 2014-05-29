<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<div id="blog_page">

	<div id="content">			
	
	<?php
	
	$current_year = date('Y');
	$postyearbegan = 2011;
	$endallthings = date('Y') +1;

	while ( $postyearbegan < $endallthings ):

		echo '<div class="year-wrapper ';
		echo $postyearbegan;
		echo '"> <!-- START OF YEAR --> ';
		
 		$args=array('post_type' =>'post', 'year'=> $postyearbegan);
		query_posts($args);

		// POSTS FOR THIS YEAR
		while ( have_posts() ) : the_post();				
			echo '<div class="post-wrapper">';				
			echo '<span class="date_field">';
			echo the_time('M j');
			echo '</span>';			
			echo '<h2>';
			the_title(); 
			echo '</h2>';	
			echo '<p>';
			echo get_excerpt(245);			 	 	
			echo '</p>';
			echo '<a href=" ',the_permalink(),' " class="link">Read more <span class="kandan-blue"> >> </span></a>';				
			echo '</div>';		
			echo '<div class="end_of_line"></div>';
		endwhile;

		// Reset Query
		wp_reset_query();

		echo '</div> <!-- END OF YEAR --> ';

		$postyearbegan++;

		if ( $postyearbegan == $endallthings ):   
    			break;                
		endif;
	endwhile;  

	?>

	</div>		

</div>	

<script>

$(document).ready(function(){
	/* REMOVES MARGIN RIGHT ON EVERY SECOND POST */
	$(".post-wrapper:odd").each(function() {
    		$(this).css({'margin-right':'0'});
	});
});

</script>

<?php get_footer(); ?>
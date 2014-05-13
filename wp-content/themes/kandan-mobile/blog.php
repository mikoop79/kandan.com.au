<?php
/*
Template Name: Blog
*/
?>


<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">

<div id="post_page">

<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

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
			echo '<h2>';
			the_title(); 
			echo '</h2>';	
			echo '<span class="date_field">';
			echo the_time('M j');
			echo '</span>';	
			echo '<p>';
			the_content();			 	 	
			echo '</p>';
			echo '<a href=" ',the_permalink(),' " class="btn btn-default kandan ">Read more</a>';				
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

<?php get_footer(); ?>
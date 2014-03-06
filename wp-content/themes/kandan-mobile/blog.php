<?php
/*
Template Name: Blog
*/
?>

<!-- ONLY LOAD HEADER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>
<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">

<div id="post_page">

<?php }?>

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
			echo get_excerpt();			 	 	
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
		
<!-- ONLY LOAD FOOTER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>

</div>

<?php get_footer(); ?>
<?php }?>
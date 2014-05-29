<?php
/*
Template Name: Filter
*/
?>

<?php get_header(); ?>

<div id="blog_page">

	<div id="content">			
	
	<?php
	
	$current_year = date('Y');
	$postyearbegan = 2007;
	$endallthings = date('Y') +1;

	while ( $postyearbegan < $endallthings ):

		echo '<div class="year-wrapper ';
		echo $postyearbegan;
		echo '"> <!-- START OF YEAR --> ';
		
 		$args=array('post_type' =>'the_people', 'year'=> $postyearbegan);
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

<div id="years">

	<?php
   	
    		$years = $wpdb->get_results( "SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'news' AND post_status = 'publish' GROUP BY year DESC" );
   
    		foreach ( $years as $year ) {      
		$posts_this_year = $wpdb->get_results( "SELECT ID, post_title FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = '" . $year->year . "'" );
    
        	echo '<h2>' . $year->year . '</h2>';
    		}
	?>

</div>





<style>

#sticky{
	background: red;
	width: 100%;
	height: 50px; 
	bottom: 0;
	opacity: 0.3;
}

#years,
#services-products-clients-people{
	display: none;
}

.year-wrapper{
	position: absolute;
	top: 300px;
	left: 300px;
display: none;
	
}

</style>


<script>

$(document).ready(function(){
	$('#years h2').click(function(){
		$('.year-wrapper').fadeOut().delay(100);
		var theYear = $(this).text();
		var theYearReady = '.' + theYear ;
		$(theYearReady).fadeIn(); 
	});	
});

/* sticky footer */

positionFooter(); 
function positionFooter() {
    if($(document.body).height() < $(window).height()){
        $('#sticky').css({
            position: 'absolute',
            top:  ( $(window).scrollTop() + $(window).height()
                  - $("#sticky").height() ) + "px",
            width: "100%"
        });
    } else {
        $('#sticky').css({
            position: 'static'
        });
    }    
}
$(window).bind('scroll resize click', positionFooter);




</script>


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
<div id="sticky">

</div>
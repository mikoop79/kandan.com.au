<?php
/*
Template Name: Content
*/
?>

<div id="content">

<div id="content_page">

	<div id="content">

		<?php the_post(); ?>        

		<?php the_content(); ?>    		
	</div>
 
</div>

</div>

<?php get_footer(); ?>
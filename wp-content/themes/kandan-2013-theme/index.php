<?php get_header(); ?>

<div id="standard_page">

	<div id="content">

		<h2><?php the_title(); ?></h2>         

		<?php the_post(); ?>        

		<?php the_content(); ?>    		
	</div>
 
</div>

<?php get_footer(); ?>
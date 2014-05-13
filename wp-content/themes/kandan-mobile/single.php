
<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">



<!-- PAGE CONTENT -->

<div id="post_page"> 

		<h2><?php the_title(); ?></h2>
		<h4><?php echo the_time('M j'); ?></h4>
		<div class="the-line"></div>
	
		<?php the_post(); ?>  
		<?php the_content(); ?> 
		
		<?php the_secondary_content(); ?>	 
			
		<!-- PAGINATION -->
					
		<h6>More Posts</h6>

		<div id="post_pagination">				
			<div class="prev"><?php previous_post_link('%link', 'Next post: "%title"', true ); ?></div>
			<div class="more"><?php next_post_link('%link', 'Previous post: "%title"', true ); ?></div>
		</div>	
		
</div> 

</div>

<?php get_footer(); ?>

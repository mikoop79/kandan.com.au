<?php get_header(); ?>

<div id="post_page">

	<div id="content">     

		<div class="left-column">		

			<div class="the_work-images">
				<?php the_secondary_content(); ?> 
			</div>   
		</div>	

		<div class="right-column">

			<?php the_post(); ?>  

			<h2><?php the_title(); ?></h2>
			<h4><?php echo the_time('M j'); ?></h4>
			<div class="the-line"></div>

			<?php the_content(); ?> 

			<!-- PAGINATION -->
		
			
			<h6>More Posts</h6>
			<div id="post_pagination">
				
		<div class="prev"><?php previous_post_link('%link', 'Previous post: "%title"', true ); ?></div>
		<div class="more"><?php next_post_link('%link', 'Next post: "%title"', true ); ?></div>

			</div>
	
		</div>

		
		
	</div>
 
</div>

<?php get_footer(); ?>
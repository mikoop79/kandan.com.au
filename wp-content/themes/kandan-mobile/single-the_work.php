
<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">

<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<div id="the_work_page">

	<div id="content"> 

			<?php the_post(); ?> 			
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>			
				<h4><?php echo get_post_meta($post->ID, '_h2', true) ?></h4>

			<div class="service-title">
				
			<!-- GETS CATEGORY (retail, finance etc) -->		
			<h5>Category:</h5>
			<span>
			<?php
				$i = 0;
				$comma = "";
				foreach((get_the_category()) as $childcat) {
					
					
				if (cat_is_ancestor_of(6, $childcat)) {

					if ($i > 0){
						$comma = ", ";
					}
					echo  $comma . $childcat->cat_name;
					$i++;
				}

					
			}
			?>
			</span>
			<br>
			<!-- GETS SERVICE (brand, digital etc) -->
			<h5>Service:</h5>
			<span>
			<?php
				$i = 0;
				$seperator = "";
				foreach((get_the_category()) as $childcat) {
				if (cat_is_ancestor_of(2, $childcat)) {
					// check if the service is a 'main' service
							if (is_main_service($childcat->term_id)){
								if ($i > 0){ 
									$seperator = ", ";
								} 
								echo $seperator . $childcat->cat_name;
								$i++;
							}
				}}
			?>
			</span>

			</div>
			
			<?php the_content(); ?>   			
			
			<?php the_secondary_content(); ?> 

		</div>

		<!-- PAGINATION -->
		
		<div id="post_pagination">
			<?php previous_post_link('%link', '<span class="prev-posts"></span>', 'yes'); ?> 
			<?php next_post_link('%link', '<span class="next-posts"></span>', 'yes'); ?> 
		</div>
		
	
	
 
</div>

</div>

<?php get_footer(); ?>

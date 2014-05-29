<?php get_header(); ?>

<div id="the_work">

	<div id="content">
		
		<h2><?php single_cat_title(''); ?></h2>


		<!-- GETS THE CURRENT CATEGORY SLUG SO WE CAN SHOW THE ASSOCIATED POSTS -->

		<?php 

		if (is_category( )) {
  			$cat = get_query_var('cat');
  			$thiscat = get_category ($cat);
		}
		
		?>

		<ul id="landing-the_work">		

		<!-- DOES THE LOOP WITH THE NEW CAT SLUG -->

		<?php 

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'the_work', 'posts_per_page' => 100, 'category_name' =>  $thiscat->slug );
			$wp_query = new WP_Query($args);
			
			$i = 1;
			while ( have_posts() ) : the_post(); ?>

			<!-- LOOP CONTENT -->
    				

			<li class="<?php if($i == 3) echo "last";  ?>" >
				<a href="<?php the_permalink() ?>">
					<div class="hover-arrows"></div>
					<div class="hover-arrows-hover"></div>
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
				
				<div class="the_work-wrapper">
				
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
				<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>		
				
				<div class="service-title">

				<!-- GETS CATEGORY (retail, finance etc) -->		
				<h5>Category:</h5>
				<span>
				<?php
					foreach((get_the_category()) as $childcat) {
					if (cat_is_ancestor_of(6, $childcat)) {
						echo $childcat->cat_name; 
					}}
				?>
				</span>

				<!-- GETS SERVICE (brand, digital etc) -->
				<h5>Service:</h5>
				<span>
				<?php
					$si=0;
					$seperator = '';
					foreach((get_the_category()) as $childcat) {
					if (cat_is_ancestor_of(2, $childcat)) {
						// check if the service is a 'main' service
							if (is_main_service($childcat->term_id)){
								if ($si > 0){ 
									$seperator = ", ";
								} 
								echo $seperator . $childcat->cat_name;
								$si++;
							}
					}} 
				?>
				
				</span>

				</div>

				</a>

			</li>	

		<?php if($i == 3){$i = 1;} else {$i++;} ?>
		<?php endwhile; ?>

		</ul>

	</div>

</div>

<?php get_footer(); ?>
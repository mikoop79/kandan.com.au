<?php
/*
Template Name: The Work
*/
?>

<?php get_header(); ?>

<div id="the_work">

	<div id="content">
	
	<div id="filter-categories">
		<ul>
			<li class="all"><a href="#all">All</a></li>	
			<?php the_category_unlinked(''); ?>
		</ul>
	</div>

	<ul id="landing-the_work">
		<?php
			global $post;
			$args = array( 'posts_per_page' => -1, 'post_type' =>'the_work' , 'orderby' => 'ASC');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li class="<?php foreach((get_the_category()) as $childcat) { if (cat_is_ancestor_of(2, $childcat)) {echo $childcat->slug;echo" ";  } } ?>">
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
					$i = 0;
					$seperator = "";
					foreach((get_the_category()) as $childcat) {
					
					if (cat_is_ancestor_of(6, $childcat)) {
						if ($i > 0){ 
							$seperator = ", ";
						} 
						echo $seperator . $childcat->cat_name;
						
						$i++;
						
					}}
				?>
				</span>

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

				</a>

			</li>
	
		<?php endforeach; ?>	
		</ul>		
	</div>


</div>

<script type="text/javascript">

/* THIS MAKES THE FILTERS WORK */

$(document).ready(function(){

	/* MAKES 'ALL' ACTIVE */	
	var hash = document.URL.substr(document.URL.indexOf('#')+1);
	// console.log(hash);

	var startsWithHash = (/#/).test(document.URL.substr(document.URL));
	if (hash != '' && startsWithHash){
		hash = "." + hash;
		// form the query selector for the correct filter
		var selector_for_link =  "#filter-categories li"+hash + " a";
		
		setTimeout(function() {
	       $(""+selector_for_link+"").trigger('click');
	    },100);
	}  else {
		$('#filter-categories li:first a').addClass('active');
	}
	
	/* the click events for footer and for filter tabs along top of page */
	$("#filter-categories li a, #services-products-clients-people-content .services li a" ).click(function(){

		// disable the show and hide if category is already showing
		if ($(this).hasClass('active')){
			//console.log('already active!');
			event.preventDefault();
			return false;
			
		}
		// local variables
		/* GETS THE NAME AND ASSIGN IT */
			var whatCategory = $(this).parent().attr('class');
			var hitwhatCategory =  whatCategory.replace('cat-item cat-item-', '');

		/* RESETS FOR ALL */

		

		/* ADDS ACTIVE CLASS TO LI */
		$('#filter-categories li a').removeClass('active');
		$("#filter-categories li."+hitwhatCategory + " a").addClass('active');

		if (whatCategory == 'all'){
			$('#landing-the_work li').fadeOut(0);			
			$('#landing-the_work li').fadeIn(1000);
			//return false;
		} else {

			$("body").scrollTop(0);
			var iterator = 0;
	 		
			/*SHOW ALL ITEMS FOR THAT CATEGORY */
		    $('#landing-the_work li').each(function() {
		            //console.log(hitwhatCategory);
		    		if ( $(this).css('display') == 'none' && $(this).hasClass(hitwhatCategory))
						{
							iterator++;
						   // show the projects which are hidden one by one. delay added per items so not all at same time 
						   $(this).fadeIn(1000).delay(100*iterator);
						   //$(this).slideDown().delay(100*iterator);
						} else if ( $(this).hasClass(hitwhatCategory) && $(this).css('display') == 'list-item' ) {
							// do nothing if already showing
							
						} else {
							// hide the projects not needed
							$(this).fadeOut(0);
							// $(this).hide();	
							
						}
		    });

		}
		
			
		//return false;
	});
	
});

</script>

<?php get_footer(); ?>
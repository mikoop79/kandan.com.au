<?php get_header(); ?>

<div id="the_work_page">

	<div id="content"> 
		
		<div class="left-column">
			<div class="the_work-images">
				<?php the_secondary_content(); ?> 
			</div>
		</div>	

		<!-- <div class="right-column-wrapper"> -->

		<div class="right-column">

			<?php the_post(); ?> 			
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>			
				<h4><?php echo get_post_meta($post->ID, '_h2', true) ?></h4>
				<!--  adds the url to the site if there is one. -->
				<?php if (get_post_meta($post->ID, '_web_url', true)) : ?>
					<p class="web_url"><a  href="http://<?php echo get_post_meta($post->ID, '_web_url', true) ?>" target="_blank">Go to View Website</a></p>
				<?php endif; ?>
				

			<div class="the-line"></div>

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
			<h5 class="back-to-top">Back to the top <div class="arrow"></div></h5>
		</div>

		<!-- PAGINATION -->
		
		<div id="post_pagination">
			<?php previous_post_link('%link', '<span class="prev-posts"></span>', 'yes'); ?> 
			<?php next_post_link('%link', '<span class="next-posts"></span>', 'yes'); ?> 
		</div>
		
	<!-- </div> -->
	</div>
 
</div>

<script>

$(document).ready(function(){

	/* DISABLE LINK FOR IMAGES */
	$(".the_work-images a").click(function(e) {
    		e.preventDefault();
   	});

	/* SHOWS THE BACK BUTTON */
	$('#the_work-close-button').fadeIn();

	/* MOVES TO THE TOP OF PAGE */
	$(".back-to-top").click(function(){
		$( "body, html" ).scrollTop( 0 );
	})


	/* STICKY SIDE PANEL*/

// time before the delay starts
var delay = 150;
var timeout = null;
var rightSidePosY = 0;

		$(window).bind('scroll',function(){
		    clearTimeout(timeout);
		    rightSidePosY = $(".right-column").css("top");
		    timeout = setTimeout(function(){
		        moveRightColumn();
		         
		         
		         
		    },delay);
		});

		function makeRelative(){
				$(".right-column").css({"position": 'relative'});
		}
		function moveRightColumn(){


			/*POSITION THE RIGHT COLUMN IN WORK when user scrolls*/
			var posY = 0;

			if (document.body.scrollTop){
				// console.log("body"+document.body.scrollTop);
				posY = document.body.scrollTop;

			} else{
				 //console.log("element"+document.documentElement.scrollTop);
				posY = document.documentElement.scrollTop;
			}

   			// var posY = document.body.scrollTop || document.documentElement.scrollTop;
   			var frameHeight = $(".right-column").height();
   			var contentHeight = $(".left-column").height();
   			var bottomSpace = 640;
   			
   			console.log("posY"+posY);
   			console.log("frameHeight"+frameHeight);
   			console.log("rightSidePosY " +  rightSidePosY);

   			var bottomScrollLimit = contentHeight-bottomSpace;
   			if (posY > frameHeight){
	   				if (posY > rightSidePosY && posY < (rightSidePosY + frameHeight)  ){
	   					console.log("right side larger fool!"); 
					return false;
					} else {
						console.log("right side smaler fool!" + rightSidePosY); 
					}


   				makeRelative();
   				//console.log("posY"+posY);
   				// console.log("bottomScrollLimit:"+bottomScrollLimit);
   					if (posY  > frameHeight && posY > bottomScrollLimit ) {

   						var difference = frameHeight - bottomSpace;
   						$(".right-column").animate({"top":(bottomScrollLimit)-difference});
   						 console.log("too big");
		   			} else {

		   				if ( posY > contentHeight - frameHeight ) {
   							return false;
   						}

		   				$(".right-column").animate({"top":posY});
		   				console.log('not big enough');
		   			}
   			} else{
   				console.log('else');
   				$(".right-column").animate({"top":-7});
   			}
   			
   			
		}
		

});



</script>

<?php get_footer(); ?>
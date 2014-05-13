<?php
/*
Template Name: What We Do
*/
?>

<?php get_header(); ?>

			<?php	
					/* GET PROCESS ROLLOVER PAGE CONTENT */
					$post_id = 1254;
					$process = get_post($post_id);
					$title = $process->post_title;
					$content = $process->post_content;
			?>

			<style type="text/css">
	#process-chart{
		background: url('<?php echo $url = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); ?>');
		height: 0;
		width: 360px;
	}

</style>

<div id="what-we-do_page">

	<div id="content">
			
			<div id="rollover-content">
				<div id="process-content" class="">
				<h1 class="title">
					<?php echo $title; ?>
				</h1>

				<?php echo apply_filters('the_content', $content); ?>
				</div>

				<div id="process-chart" class="">
					<!-- THIS BACKGROUND FOR THE THUMB WILL BE PULLED INTO HERE VIA CSS ABOVE-->
					
				</div>
			</div>

		<div class="left-column first-page">		

			<?php the_post(); ?>  
			<?php the_content(); ?>   

		</div>

		<div id="process-thumb" class="right-column">
			<?php the_post_thumbnail( 'full' ); ?> 
		</div>


		<div class="left-column first-page">
			<?php the_secondary_content(); ?> 
		</div>
		
		<div class="right-column">

		<div class="related-work">		
	
			<h6 id="idea-generation">View related work</h6>

			<ul class="related-work-thumbs">
			
				<?php
					global $post;
					//idea Generation
					$include_ids = array(
										'Drapac'=>1118,
										'Infiniti_Cirq'=>398,
										'Mercedes_benz_dm' => 418,
										'Shoreditch_Cut'=>413
										);
					

					$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => $include_ids);
					$myposts = get_posts( $args );
					$count = 0;
					foreach( $myposts as $post ) :	setup_postdata($post); ?>	
						<li>
							<?php echo show_all_thumbs($post->ID); ?>
						</li>
				<?php endforeach; ?>
				<div class="client-name"></div>
				<div class="client-title"></div>
		
			</ul>	
		</div>

		<div class="related-work">

		<h6 id="implementation">View related work</h6>

		<ul class="related-work-thumbs">
			<?php
			global $post;
			//Activation
			$include_ids = array(
				'Freightliner'=>420,
				'Kinetic_Activation'=>1062,
				'Infiniti_GP'=>402,
				'Infiniti_MotorShow'=>399
				);
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => $include_ids);
			$myposts = get_posts( $args );
			
				foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

					<li>
						<?php echo show_all_thumbs($post->ID); ?>
					</li>
				
			<?php endforeach; ?>
				<div class="client-name"></div>
				<div class="client-title"></div>
		</ul>	
		</div>

		<div class="related-work">

		<h6 id="branding">View related work</h6>

		<ul class="related-work-thumbs">
		<?php
			global $post;
			//Branding
			$include_ids = array(
				'pickawall'=>425,
				'magnifymedia'=>426,
				'CheekyChinos' => 394,
				'feelinghealthy'=>1011,
				);
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => $include_ids);
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				<?php echo show_all_thumbs($post->ID); ?>		
			</li>
			
		<?php endforeach; ?>
			<div class="client-name"></div>
			<div class="client-title"></div>
		</ul>	
		</div>

		
	
		<div class="related-work">

		<h6 id="activation">View related work</h6>

		<ul class="related-work-thumbs">
		
		
		<?php
			global $post;
			
			//Implementation
			$include_ids = array(
				'ANZ_Implementation'=>989,
				'Telstra'=>1054,
				'AllSaints'=>416,
				'Medibank'=>1037
				);
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => $include_ids);
			$myposts = get_posts( $args );	
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				<?php echo show_all_thumbs($post->ID); ?>
			</li>
			
		<?php endforeach; ?>	
				<div class="client-name"></div>
				<div class="client-title"></div>
		</ul>	
		</div>

		
	
		<div class="related-work">

		<h6 id="digital">View related work</h6>		

		<ul class="related-work-thumbs">		
		
		<?php
			global $post;
			//Digital 
			$include_ids = array(
				'pickawall'=>425,
				'medibankpaperjam'=>1121,
				'Infinit_DriveDay'=>401,
				'ANZ_BusinessPlanCD'=>407
				);
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => $include_ids);
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				<?php echo show_all_thumbs($post->ID); ?>
			</li>
			
		<?php endforeach; ?>
				<div class="client-name"></div>
				<div class="client-title"></div>
			
		</ul>	
		</div>

		
	
		<div class="related-work">


		<h6 id="social">View related work</h6>

		<ul class="related-work-thumbs">
		
		
		<?php
			global $post;
			// Social Media 
			$Social_include_ids = array(
				'FairtradeApp'=> 998,
				'FarmersUnion' => 1006,
				'KandanKrisKringle_App' => 422,
				'Cheeky' =>394
				);
			
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => $Social_include_ids);
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <?php echo show_all_thumbs($post->ID); ?>
			</li>
			
		<?php 
		
		endforeach; ?>
				<div class="client-name"></div>
				<div class="client-title"></div>
			
		</ul>	
		</div>
	</div>
 
</div>

<script>

/* SCROLLS IF THERE IS AN ANCHOR IN THE URL */

$(document).ready(function(){
	// $(".client-name").text("Rollover thumbs");
	var theURL = document.URL.substr(document.URL.indexOf('#'));

	if (theURL != '/'){
		$('html,body').animate({scrollTop: ($(theURL).offset().top-180)+'px'}, 	'slow');
	}

	$("#process-thumb").click( function(){
		//console.log("process clicked");
		$("#rollover-content").fadeIn('slow');
		$(".related-work, .related-work-thumbs, .first-page, #process-thumb").fadeOut('slow');
		/* SHOWS THE BACK BUTTON */
		$('#the_work-close-button').fadeIn();

		showBanner("#process-chart");
	});

	$('#the_work-close-button, #process-chart').click(function() {
		$('#the_work-close-button').fadeOut();
		$("#rollover-content").fadeOut('fast');
		$(".related-work, .related-work-thumbs, .first-page, #process-thumb").fadeIn('slow');
		$("#process-chart").animate({"height":"0"});

	});

	$('#the_work-close-button').click(function(e){
		e.preventDefault();
	});



	// small thumbs for rollover
	$(".related-work-thumbs li a").hover(function(){
		
		var heading1 = $(this).data('heading1');
		var heading2 = $(this).data('heading2');

		$(this).parent().parent().children(".client-name").text(heading1);
		$(this).parent().parent().children(".client-title").text(heading2);
		$(this).css({"background-color":"#FFF"});
		$(this).children("img").animate({"opacity" : "1"}, 'fast');


	}, function(){
		$(this).css("background,#000");
		$(this).children("img").animate({"opacity": "0.8"}, 'fast');
		$(this).parent().parent().children(".client-name, .client-title").text("");
		
	})
	
	
});

function showBanner(_Selector){
	var Selector = _Selector;
	var animateTime = 800;
	var pauseTime = pauseTime;
	$(""+Selector+"").animate({"height":"310px"},animateTime).delay(pauseTime).animate({"height":"685px"}, animateTime).delay(pauseTime).animate({"height":"1040px"},animateTime);
}



</script>

<?php get_footer(); ?>
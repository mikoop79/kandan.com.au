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

			<style>
	#process-chart{
		background: url('<?php echo $url = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); ?>');
		height: 0;
		width: 360px
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
					// 1118 = Drapac for idea Generation
					$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => '1118');
					$myposts = get_posts( $args );
					$count = 0;
					foreach( $myposts as $post ) :	setup_postdata($post); ?>	
						<li>
							<a href="<?php the_permalink() ?>" class="block-link">

							<?php echo show_all_thumbs(); ?>
							<div class="people-name">
								<?php //echo get_post_meta($post->ID, '_h1', true) ?>
							</div>
							<div class="people-title">
								<?php //echo get_post_meta($post->ID, '_h2', true) ?>
							</div>
							</a>
						</li>
				<?php endforeach; ?>
		
			</ul>	
		</div>

		<div class="related-work">

		<h6 id="implementation">View related work</h6>

		<ul class="related-work-thumbs">
			<?php
			global $post;
			// 1054 = Telstra for Implementation
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => '415');
			$myposts = get_posts( $args );
			
				foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

					<li>
						<a href="<?php the_permalink() ?>" class="block-link">

						<?php echo show_all_thumbs(); ?>
						<div class="people-name">
							<?php //echo get_post_meta($post->ID, '_h1', true) ?>
						</div>
						<div class="people-title">
							<?php //echo get_post_meta($post->ID, '_h2', true) ?>
						</div>
						</a>
					</li>
				
			<?php endforeach; ?>	
		</ul>	
		</div>

		<div class="related-work">

		<h6 id="branding">View related work</h6>

		<ul class="related-work-thumbs">
		<?php
			global $post;
			// 425 = Pickawall for Branding
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => '425');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				<a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php //echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php //echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
				</a>
			</li>
			
		<?php endforeach; ?>	
		</ul>	
		</div>

		
	
		<div class="related-work">

		<h6 id="activation">View related work</h6>

		<ul class="related-work-thumbs">
		
		
		<?php
			global $post;
			// 402 = Infiniti for Activation
			$args = array( 'posts_per_page' => 4, 'post_type' =>'the_work', 'include' => '402,410,402,402');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php //echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php //echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
				</a>
			</li>
			
		<?php endforeach; ?>	
			
		</ul>	
		</div>

		
	
		<div class="related-work">

		<h6 id="digital">View related work</h6>		

		<ul class="related-work-thumbs">		
		
		<?php
			global $post;
			//410  = Medibank IPAD APP for Digital 
			$include_ids = array(
				'pickawall'=>425,
				'medibankpaperjam' => 1121,
				'mtbow' => 945,
				'feelinghealthy'=>1011,



				);
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => $include_ids);
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs($include_ids); ?>
				
				</a>
			</li>
			
		<?php endforeach; ?>
		<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
			
		</ul>	
		</div>

		
	
		<div class="related-work">


		<h6 id="social">View related work</h6>

		<ul class="related-work-thumbs">
		
		
		<?php
			global $post;
			//410  = Fairtrade Facebook for Social Media 
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '998');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>

				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>		

				<div class="people-name">
					<?php //echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php //echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
				</a>
			</li>
			
		<?php endforeach; ?>	

			
		</ul>	
		</div>

	
	
	
	</div>
 
</div>

<script>

/* SCROLLS IF THERE IS AN ANCHOR IN THE URL */

$(document).ready(function(){

	var theURL = document.URL.substr(document.URL.indexOf('#'));
	console.log(theURL);
	//$("#process-content, #process-chart").slideUp(0);

	if (theURL != '/'){
		$('html,body').animate({scrollTop: ($(theURL).offset().top-180)+'px'}, 	'slow');
	}

	$("#process-thumb").click( function(){
		console.log("process clicked");
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

	$('#the_work-close-button').click( function(e){
		e.preventDefault();
	});




	
	
	
});

function showBanner(_Selector){
	var Selector = _Selector;
	var animateTime = 800;
	var pauseTime = pauseTime;
	$(""+Selector+"").animate({"height":"310px"},animateTime).delay(pauseTime).animate({"height":"685px"}, animateTime).delay(pauseTime).animate({"height":"1040px"},animateTime);
}

</script>

<?php get_footer(); ?>
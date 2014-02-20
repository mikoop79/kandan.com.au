<?php
/*
Template Name: What We Do
*/
?>

<?php get_header(); ?>

<style>
	
#rollover-content{
	display: none;
	z-index: 15000;
	position: relative;
	min-height: 450px;
	margin-bottom: 15px;
	float: left !important;
	background-color: #ffffff;
}

#process-content{
	float: left;
	width: 540px;
	margin-bottom: 40px;
	padding-right: 30px;
	font-size: 15px;
	line-height: 20px;
	color: #808080;
	color: #191919;
	color: #4F4F4F;
	font-weight: lighter;
}

#process-content h2{
	margin-top: 60px;
	margin-bottom: 35px;
}

#process-content h2:nth-child(1){
	margin-top: 0px;
}


#process-content h3{
	margin-top: 18px;
	margin-bottom: 15px;
}

#process-content p{
	min-height: 230px;
}

#rollover-content #process-chart{
	float: right;
}

#process-thumb{
	cursor: default;
}


</style>

<div id="what-we-do_page">

	<div id="content">
			<?php	
					$post_id = 1218;
					$process = get_post(1218);
					$content = $process->post_content;
					//$thumbnail = $process['post_thumbnail'];
					// echo '<pre>';
					// var_dump($process);
					// echo '</pre>';
					
			?>
			<div id="rollover-content">
				<div id="process-content" class="">
				<?php echo $content; ?>
			</div>

			<div id="process-chart" class="">
				<?php echo get_the_post_thumbnail( $post_id, $size, $attr ); ?> 
			</div>
			</div>
			
			<?php //endforeach; ?>
		
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
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '1118');
			$myposts = get_posts( $args );
			$count = 0;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 
			

			
			<li>
				<a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
				</a>
			</li>
			<?php 
			
			
			endforeach; 	
				
			
			

				
		?>	
	
		</ul>	
		</div>

		

		<div class="related-work">

		<h6 id="implementation">View related work</h6>

		<ul class="related-work-thumbs">
		
		
		<?php
			global $post;
			// 1054 = Telstra for Implementation
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '415');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				<a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
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
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '425');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
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
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '402');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
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
			$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work', 'include' => '410');
			$myposts = get_posts( $args );
			
			foreach( $myposts as $post ) :	setup_postdata($post); ?>			 

			<li>
				 <a href="<?php the_permalink() ?>" class="block-link">

				<?php echo show_all_thumbs(); ?>
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
				</div>
				</a>
			</li>
			
		<?php endforeach; ?>	
			
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
					<?php echo get_post_meta($post->ID, '_h1', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_h2', true) ?>
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
	});

	$('html').click(function() {
		
		$(".related-work, .related-work-thumbs, .first-page, #process-thumb").fadeIn('slow');
		$("#rollover-content").fadeOut('slow');

	});


	
	
	
});

</script>

<?php get_footer(); ?>
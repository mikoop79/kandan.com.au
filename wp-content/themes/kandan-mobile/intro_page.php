<?php
/*
Template Name: Intro
*/
?>

<?php get_header(); ?>

<div class="home-slider">

	<ul class="bxslider">
		<?php
			global $post;
			$args = array( 'posts_per_page' => 6, 'post_type' =>'home_slides');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li data-type="home-slider">
				<div class="home-slider-content">	
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
				
                <a class="cta" href="<?php echo  get_site_url().'/'. get_post_meta($post->ID, '_link_the_url', true) ?>"><?php echo get_post_meta($post->ID, '_link_text', true) ?></a>
				
				</div>


				<div class="home-slider-image">

				<?php  if (class_exists('MultiPostThumbnails') ){ 

				$url =  MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'the_slider2');

				} ?>
				<img src="<?php echo $url; ?>"  alt="" class="" /></div>
			</li>
		<?php endforeach; ?>	
		</ul>		
	</div>

	<!-- SERVICES -->
<div id="home-services" class="home-slider reversed" >
<h1>Our Services</h1>
	<ul class="bxslider services-icons">
		
				<li>
					<a href="what-we-do/#idea-generation">
						<div class="idea-generation">	
							<div class="kd-symbol"></div>
							<div class="service-title">Idea generation</div>
						</div>
					</a>
				</li>
				<li>
					<a href="what-we-do/#implementation">
						<div class="implementation">
							<div class="kd-symbol"></div>
							<div class="service-title">Implementation</div>
						</div>
					</a>
				</li>
				<li>
					<a href="what-we-do/#activation">
						<div class="activation">
							<div class="kd-symbol"></div>
							<div class="service-title">Activation</div>
						</div>
					</a>
				</li>
				<li>
					<a href="what-we-do/#digital">
						<div class="digital">
							<div class="kd-symbol"></div>
							<div class="service-title">Digital</div>
						</div>
					</a>
				</li>
				<li>
					<a href="what-we-do/#brand">
						<div class="brand">
							<div class="kd-symbol"></div>
							<div class="service-title">Brand</div>
						</div>
					</a>
				</li>
				<li>			
					<a href="what-we-do/#social-media">
						<div class="social-media">
							<div class="kd-symbol"></div>
							<div class="service-title">Social Media</div>
						</div>
					</a>
				</li>
		</ul>		
	</div>
	<!-- THE WORK -->
	<div id="the-work" class="home-slider">
	<h1>The Work</h1>
	<ul class="bxslider">
		<?php
			global $post;
			$args = array( 'posts_per_page' => 7, 'post_type' =>'the_work');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
				<span class="<?php foreach((get_the_category()) as $childcat) { if (cat_is_ancestor_of(2, $childcat)) {echo $childcat->slug;echo" ";  } } ?>">				
				<a href="<?php the_permalink() ?>">					
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
				</a>
				</span>
			</li>
		<?php endforeach; ?>
		</ul>		
	</div>

	<!-- CLIENTS -->
	<div id="home-clients" class="home-slider">
	<h1>Our Clients</h1>
	<ul class="bxslider">
		<?php
			global $post;
			$args = array( 'posts_per_page' => 12, 'post_type' =>'the_client','meta_key' => '_logo_order', 'orderby' => 'meta_value', 'order' => "ASC");
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
				<a class="client-logos" href="<?php echo get_post_meta($post->ID, '_logo_link', true) ?>">
									
						<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_client1'); endif; ?>
				</a>
			</li>
		<?php endforeach; ?>	
		</ul>		
	</div>
	

	<!-- PEOPLE -->
	<div id="home-people" class="home-slider">
	<h1>People and Culture</h1>
	<ul class="bxslider">
		<?php
			global $post;
			$args = array( 'posts_per_page' => 15, 'post_type' =>'the_people');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
			<a href="<?php the_permalink() ?>">
				<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people2'); endif; ?>
			</a>
			</li>
		<?php endforeach; ?>	

		
		</ul>		
	</div>

<?php get_footer(); ?>
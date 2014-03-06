<?php
/*
Template Name: Intro
*/
?>

<?php get_header(); ?>

<div id="home-slider">
	<ul class="bxslider">
		<?php
			global $post;
			$args = array( 'posts_per_page' => 6, 'post_type' =>'home_slides');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
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

	<!-- HARD CODED MENU TO OVERCOME AJAX MADNESS -->

	<div id="primary_nav">		
		
		<ul>
			<!-- WHO WE ARE -->
			<li>
			<a><?php echo get_the_title(190); ?></a>
			<div class="page-accordion">
			<?php 
				$id = 190;
				$p = get_page($id);
				echo apply_filters('the_content', $p->post_content);
			?>
			</div>
			<!-- WHAT WE DO -->
			</li>
			<li>
			<a><?php echo get_the_title(192); ?></a>
			<div class="page-accordion what_we_do">
			<div class="what_we_do-wrapper">
			<?php 
				$id = 192;
				$p = get_page($id);
				echo apply_filters('the_content', $p->post_content);
			?>

			<?php echo get_the_post_thumbnail( $id, array(290,290)); ?> 
			</div>

			<div class="services-icons">

				<?php the_secondary_content(); ?>
				<div class="idea-generation"><div class="icon"></div>Idea generation
						<div class="dropdown"></div>
					<div class="services-page-accordion">The measure of your advertising is its effectiveness. And effective communication requires planning and, ultimately, simple yet great ideas. We listen to you and understood your objectives then create communication that connects to your audience and gets the results you need.</div>
				</div>
				
				<div class="implementation"><div class="icon"></div>Implementation
						<div class="dropdown"></div>
					<div class="services-page-accordion">The role of implementation is to completely understand the DNA of an idea and to be able to transform a creative platform into any form of media suitable for any particular market. We pride ourselves on being able to analyse the requirements, create and then deliver the right solution. On time, on budget, every time.</div>
				</div>
				<div class="activation"><div class="icon"></div>Activation
						<div class="dropdown"></div>
					<div class="services-page-accordion">People love brands that love them back. Brand activation should generate excitement, energy and empathy for the brand. We believe that a great experience affects not only how customers think about your brand, but also how your brand thinks about its customers.</div>
				</div>
				<div class="digital"><div class="icon"></div>Digital
						<div class="dropdown"></div>
					<div class="services-page-accordion">We’re passionate about everything digital. Digital is the way we go through life. By connecting to people on their terms, on their devices and in ways they choose to interact with a brand, we create experiences that inspire, inform and effectively communicate your message to your audience.</div>
				</div>
				<div class="brand"><div class="icon"></div>Brand
						<div class="dropdown"></div>
					<div class="services-page-accordion">Creating a brand is much more than just producing a logo. Great branding is a blend of art and science and emotion. We make it our business to find out about your company, people, values and what makes you tick. A brand is the sum of all parts and our part is to elevate your brand into something unique.</div>
				</div>					
				<div class="social-media"><div class="icon"></div>Social Media
						<div class="dropdown"></div>
					<div class="services-page-accordion">Social media doesn’t make successful brands, people do. When people feel connected to a brand, they converse, cultivate and circulate. Whether it’s Facebook Apps or Tweeting Instagrams we can help make your social media truly social.</div>
				</div>
			</div> 
			</div>
			</li>
			<!-- THE WORK -->
			<li>
			<a><?php echo get_the_title(194); ?></a>
			<div class="page-accordion the_work">
			
			<!-- IMPORTS ONE WORK POST AT RANDOM -->
			
			<?php
				global $post;
				$args = array( 'posts_per_page' => 1, 'post_type' =>'the_work' , 'orderby' => 'rand');
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>

				<span class="<?php foreach((get_the_category()) as $childcat) { if (cat_is_ancestor_of(2, $childcat)) {echo $childcat->slug;echo" ";  } } ?>">				
				<a href="<?php the_permalink() ?>">					
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
					<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
					<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>	
					<p><?php the_excerpt(); ?></p>		

				</a>
				
				<a href="<?php the_permalink() ?>" class="read_more">Read more about this</a>
				<a href="index.php?page_id=194" class="see_more">See more Projects</a>

				</span>
	
			<?php endforeach; ?>				

			<?php ?>
			</div>
			</li>
			<!-- BLOG -->	
			<li>
			<a><?php echo get_the_title(196); ?></a>
			<div class="page-accordion the_blog">			

			<!-- IMPORTS LATEST BLOG POST -->
			
			<?php
				global $post;
				$args = array( 'posts_per_page' => 1, 'post_type' =>'post' , 'orderby' => 'ASC');
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>

				<span class="">				
				<a href="<?php the_permalink() ?>">					
					<?php echo get_the_post_thumbnail($post_id, 'medium'); ?> 
					<h2><?php the_title(); ?></h2>
					<h4><?php echo the_time('M j Y'); ?></h4>
					<p><?php the_excerpt(); ?></p>	
				</a>
				
				<a href="<?php the_permalink() ?>" class="read_more">Read more about this</a>
				<a href="index.php?page_id=196" class="see_more">See more Projects</a>

				</span>
	
			<?php endforeach; ?>	
				<div id="back-to-top">
					<h5 class="back-to-top">Back to the top <div class="arrow"></div></h5>
				</div>
			</div>
			</li>
			</li>
			<!-- THE PEOPLE -->
			<li class="thepeople">
			<a><?php echo get_the_title(198); ?></a>
			<div class="page-accordion the_people">
			<?php $thepeople = get_post(198);
			echo $thepeople->post_content;
			?> 

			<!-- IMPORTS ONE WORK POST AT RANDOM -->
			
			<?php
				global $post;
				$args = array( 'posts_per_page' => 1, 'post_type' =>'page' , 'orderby' => 'rand', 'include' => '198');
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<?php the_secondary_content(); ?>
	
			<?php endforeach; ?>
			<ul class="people-thumbs-list">
			<?php
				global $post;
				$args = array( 'posts_per_page' => 2, 'post_type' =>'the_people' , 'orderby' => 'rand', 'include' => '303,304');
				$myposts = get_posts( $args );
				$numItems = count($myposts);
				$lastClass = "";
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<?php 
				if(++$i === $numItems) {
    				$lastClass = " last";
 					 }	?>
				<li class="person<?php foreach((get_the_category()) as $childcat) { if (cat_is_ancestor_of(2, $childcat)) {echo $childcat->slug;echo" ";  } } echo $lastClass ?>">				
				<a class="readmore-cta" href="<?php the_permalink() ?>">	</a>

				<?php 
				add_image_size( 'mycustomsize', 145, auto, true );


				if (class_exists('MultiPostThumbnails')) : $the_person_img = MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people2', NULL,  'mycustomsize'); endif; ?>
					
					<h2 class="people-name"><?php echo get_post_meta($post->ID, '_peoplename', true) ?></h2>
					<h3 class="people-title"><?php echo get_post_meta($post->ID, '_peopletitle', true) ?></h3>
				</li>
			
			<?php endforeach; ?>
				<li >
					<a href="index.php?page_id=198" class="see_more">Meet the rest of the team.</a>
				</li>
			</ul>
			<?php ?>
					
			</div>
			</li>
			
			
		</ul>

<?php get_footer(); ?>
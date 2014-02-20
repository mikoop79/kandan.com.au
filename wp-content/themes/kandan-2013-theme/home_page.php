<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<div id="landing_page">

	<div id="home-slider">
	<ul>
		<?php
			global $post;
			$args = array( 'posts_per_page' => 6, 'post_type' =>'home_slides');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
				<div class="home-slider-content">	
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>	
				<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>	
				<a href="<?php echo get_post_meta($post->ID, '_link_the_url', true) ?>">
					<?php echo get_post_meta($post->ID, '_link_text', true) ?>
				</a>
				</div>
				<div class="home-slider-image"><?php echo get_the_post_thumbnail(); ?></div>			
			</li>
		<?php endforeach; ?>	
		</ul>		
	</div>

	<div class="content-section landing-our-services">
		<h2>Our Services</h2>
		<div class="services-icons">
			<a href="/what-we-do#idea-generation" class="idea-generation"><span></span>Idea Generation</a>
			<a href="/what-we-do#implementation" class="implementation"><span></span>Implementation</a>
			<a href="/what-we-do#activation" class="activation"><span></span>Activation</a>
			<a href="/what-we-do#digital" class="digital"><span></span>Digital</a>
			<a href="/what-we-do#brand" class="brand"><span></span>Brand</a>
			<a href="/what-we-do#social" class="social-media"><span></span>Social Media</a>	
		</div> 
	</div>

	<div class="content-section landing-blog">
		<h2>Blog</h2>
		
		<?php
			global $post;
			$args = array( 'posts_per_page' => 2, 'post_type' =>'post' , 'orderby' => 'ASC');
			$myposts = get_posts( $args );
			$count = 1;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>

			<div class="landing-blog-post-wrapper">
				<a class="post-title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
				<div class="post-date"><?php the_date('M d'); ?></div>
				<div class="post-excerpt post<?php echo $count; ?>">
					<?php echo get_excerpt(155)  ?>
				</div>
			</div>
		<?php 
		$count++;
		endforeach; ?>	
		
		<a class="see-all-posts" href="/blog">See all <span class="kandan-blue"> >> </span></a>

		<div id="social-media-icons">
			<a href="https://twitter.com/kandanmedia" class="twitter"></a>
			<a href="http://instagram.com/kandanmedia#" class="instagram"></a>
			<a href="http://au.linkedin.com/company/kandan?trk=ppro_cprof" class="linkedin"></a>
			<a href="https://www.facebook.com/kandanmedia" class="facebook"></a>
		</div>
	</div>

	<div class="content-section the-work">
		<h2>The Work</h2>
		
		<div id="landing-the_work-controller">
			<div class="first active" ></div>
			<div class="second"></div>
		</div>

		<div id="landing-the_work-wrapper">

		<ul id="landing-the_work">

		<li class="slider01">
			<ul>
				<?php
			global $post;
			
			/* POST IDs BY PROJECT */
			
			$projects = array(
				'drapac' => '1118',
				'target' => '985',
				'kinetic' => '1062',
				'fairtrade' => '998',
				'pickawall' => '425',
				'anz_gem' => '406'
			);
			// include specific posts by id , there should be 6
			$args = array('posts_per_page' => 6, 'include' => $projects, 'post_type' =>'the_work' , 'orderby' => 'ASC');
			$myposts = get_posts( $args );
			$i = 1;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			
			<li class="<?php if($i == 3) echo "last";  ?>" >
				
					<div class="hover-arrows"></div>
					<div class="hover-arrows-hover"></div>
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
				
				<div class="the_work-wrapper">
				<a href="<?php the_permalink() ?>">
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
				<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>
				
				<div class="service-title">

				<!-- GETS CATEGORY (retail, finance etc) -->		
				<h5>Category:</h5>
				<span>
				<?php
					$ci = 0;
					$seperator = "";
					foreach((get_the_category()) as $childcat) {
					if (cat_is_ancestor_of(6, $childcat)) {
						
						if ($ci > 0){ 
							$seperator = ", ";
						} 
						echo $seperator . $childcat->cat_name;
						
						$ci++;
					}}
				?>
				</span>

				<!-- GETS SERVICE (brand, digital etc) -->
				<h5>Service:</h5>
				<span>
				<?php
					$si = 0;
					$seperator = "";
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
				</div>

			</li>

		
		<?php if($i == 3){$i = 1;} else {$i++;} ?>

		<?php endforeach; ?>	
			</ul>
		</li>

			<li class="slider02">
			<ul>

<?php
			global $post;
			
			$projects2 = array(
				'medibank_implementation' => '1037',
				'shoreditch_heist' => '415',
				'mercedes_truck_show' => '420',
				'anz_travel_pack' => '403',
				'infiniti_motor_show' => '399',
				'mercedes_dm' => '418'
			);
			// include specific posts by project_array above , there should be 6
			$args = array('posts_per_page' => 6, 'include' => $projects2, 'post_type' =>'the_work', 'order_by' => 'ASC' );
			$myposts = get_posts( $args );
			$i = 1;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			
			<li class="<?php if($i == 3) echo "last";  ?>" >
				
					<div class="hover-arrows"></div>
					<div class="hover-arrows-hover"></div>
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_work2'); endif; ?>
				
				<div class="the_work-wrapper">
				<a href="<?php the_permalink() ?>">
				<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>
				<h3><?php echo get_post_meta($post->ID, '_h2', true) ?></h3>
				
				<div class="service-title">

				<!-- GETS CATEGORY (retail, finance etc) -->		
				<h5>Category:</h5>
				<span>
				<?php
					foreach((get_the_category()) as $childcat) {
					if (cat_is_ancestor_of(3, $childcat)) {
						echo $childcat->cat_name;
					}}
				?>
				</span>

				<!-- GETS SERVICE (brand, digital etc) -->
				<h5>Service:</h5>
				<span>
				<?php
					foreach((get_the_category()) as $childcat) {
					if (cat_is_ancestor_of(2, $childcat)) {
						echo $childcat->cat_name;
						break;
					}} 
				?>

				
				</span>
				
				</div>
				</a>
				</div>

			</li>

		
		<?php if($i == 3){$i = 1;} else {$i++;} ?>

		<?php endforeach; ?>	


			</ul>
		</li>
		
		</ul>		
	</div>

	</div>

	<a class="see-all" href="/the-work">See all <span class="kandan-blue"> >> </span></a>

	<div class="content-section">
		<h2>Our Clients</h2>

		<div id="landing-our_clients-controller">
			<div class="first active" ></div>
			<div class="second"></div>
		</div>

		<div id="landing-our_clients-wrapper">

		<ul id="landing-our_clients">
			<li class="set01">
				<ul>
					<?php
			global $post;
			$args = array( 'posts_per_page' => 12, 'post_type' =>'the_client' ,'meta_key' => '_logo_order', 'orderby' => 'meta_value', 'order' => "ASC");
			$myposts = get_posts( $args );
			$count = 1;
			$i=1;
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<?php if($i%7 == 0): ?>
				<li class="set0<?php echo $count ?>">
				<ul>
			<?php  endif; ?>
				<li class="<?php if($i % 3 == 0 ) echo "last";  ?>" >

					<a href="<?php echo get_post_meta($post->ID, '_logo_link', true) ?>">
									
						<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_client1'); endif; ?>
					</a>
					<!-- <div class="hover-veil"></div> -->
				</li>
			<?php $i++; ?>

			<?php if($i%7 == 0): ?>
				</ul>
				</li>
			<?php $count++; endif; ?>

		<?php endforeach; ?>	
				
			
		</ul>		
	</div>

	</div>

	<a class="see-all" href="/the-work">See all <span class="kandan-blue"> >> </span></a>

	<div class="content-section people-culture">
		<h2>People & Culture</h2>
		<ul>
		<?php
			global $post;
			$args = array( 'posts_per_page' => 7, 'post_type' =>'the_people' , 'orderby' => 'rand');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li>
				<a href="<?php the_permalink() ?>">
					<div class="hover-arrows"></div>
					<div class="hover-arrows-hover"></div>
					<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'the_people1'); endif; ?>
				
				<div class="people-name">
					<?php echo get_post_meta($post->ID, '_peoplename', true) ?>
				</div>
				<div class="people-title">
					<?php echo get_post_meta($post->ID, '_peopletitle', true) ?>
				</div>	
				</a>
			</li>
		<?php endforeach; ?>	
		</ul>		
	</div>

	

	<a class="see-all" href="/people-culture" style="margin-top: 15px;">See all <span class="kandan-blue"> >> </span></a>

</div>



<script>


$(document).ready(function(){
	$('.content-section .arrow').remove();
	$('.content-section .invisible-button').remove();
	$('#footer_address').css({'display':'block'});
});

/* REMOVES ADDS THE LINE UNDER THE NAV MENU */
$('#header-line').css({'border-bottom':'solid 0px #B2B2B2'});

$(window).scroll(function () {
    $('#home-slider').each(function () {
        if (($(this).offset().top - $(window).scrollTop()) < 100) {
            $('#header-line').stop().css({'border-bottom':'solid 1px #B2B2B2'});
        } else {
            $('#header-line').stop().css({'border-bottom':'solid 0px #B2B2B2'});
        }
    });
});

/* CONTROLS WORK SLIDER */
$(document).ready(function(){
	$('#landing-the_work-controller .second').click(function(){
			$('#landing-the_work').animate({'margin-left':'-960px'});
			$(this).addClass('active');
			$(this).removeClass('ready');
			$(this).siblings().addClass('ready');
			$(this).siblings().removeClass('active');
	});

	$('#landing-the_work-controller .first').click(function(){
			$('#landing-the_work').animate({'margin-left':'0px'});
			$(this).addClass('active');
			$(this).removeClass('ready');
			$(this).siblings().addClass('ready');
			$(this).siblings().removeClass('active');
	});
});

/* CONTROLS CLIENT LOGO SLIDER */

$(document).ready(function(){

	/* ALIGNS ALL IMAGES VERTICALLY */
	
	$('#landing-our_clients li a img').each(function(){
		var theImageHeight = $(this).height();
		var setTheImageMargin = 105 - (theImageHeight / 2) /* the height of the li box */ ;
		$(this).css({'margin-top': setTheImageMargin });	
	});

	/* HOVERS */
	
	$('#landing-our_clients li').hover(
		function(){
			$(this).children('.hover-veil').fadeIn({queue: false});			
		},
		function(){
			$(this).children('.hover-veil').fadeOut({queue: false});
		}
	);

	/* THE SLIDER */
	
	$('#landing-our_clients-controller .second').click(function(){
		$('#landing-our_clients').animate({'margin-left':'-960px'});
		$(this).addClass('active');
		$(this).removeClass('ready');
		$(this).siblings().addClass('ready');
		$(this).siblings().removeClass('active');
	});

	$('#landing-our_clients-controller .first').click(function(){
		$('#landing-our_clients').animate({'margin-left':'0px'});
		$(this).addClass('active');
		$(this).removeClass('ready');
		$(this).siblings().addClass('ready');
		$(this).siblings().removeClass('active');
	});
});

</script>

<?php get_footer(); ?>
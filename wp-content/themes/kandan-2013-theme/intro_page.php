<?php
/*
Template Name: Intro
*/
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title><?php echo get_post_meta($post->ID, '_page_title', true) ?></title>

<meta name="keywords" content="<?php echo get_post_meta($post->ID, "_meta_tags", true) ?>" />
<meta name="description" content="<?php echo get_post_meta($post->ID, "_meta_des", true) ?>" />
<!-- <meta http-equiv="refresh" content="5;URL=/home"> -->

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" media="print" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts.php"></script>

<?php wp_head(); ?>
 
</head> 

<body>  

<div id="intro_page">

	<div id="intro-slider">
	
		<?php
			global $post;
			$args = array( 'posts_per_page' => 1, 'post_type' =>'intro_slides', 'orderby' => 'rand');
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>

			<a id="intro-link" href="<?php echo get_post_meta($post->ID, '_link_the_url', true) ?>"></a>
			
				<div class="intro-content">	
				<span>
					<span class="slide-colon">:</span>
					<span class="slide-number"><?php echo get_post_meta($post->ID, '_slide_number', true) ?></span>
				</span>
					<h2><?php echo get_post_meta($post->ID, '_h1', true) ?></h2>	
					<h3><?php echo get_post_meta($post->ID, '_quoted', true) ?></h3>
					<a class="cta" href="home/">Enter website</a>					
				</div>



				<div class="intro-image"><?php echo get_the_post_thumbnail(); ?></div>

				<script>					
					$(document).ready(function(){
						var thebackimage = $('.intro-image img').attr('src');
						var theRealbackimage = 'url( ' + thebackimage + ' )';
						$('html').css({'background-image': theRealbackimage }); 
						$('html').css({'background-color': '#000' }); 

						introLink();
					}); 

					$(window).resize(function(){
						introLink()
					});

					function introLink(){
						var introLinkWidth = $(window).width();
						var introLinkHeight = $(window).height();
						
						$('#intro-link').css({'width': introLinkWidth, 'height' : introLinkHeight});
						$('#intro-slider').css({'width': introLinkWidth, 'height' : introLinkHeight});
					}
				</script>		
			
		<?php endforeach; ?>	
				
	</div>

</div>

<!-- GOOGLE ANALYTICS -->

</body>

</html>
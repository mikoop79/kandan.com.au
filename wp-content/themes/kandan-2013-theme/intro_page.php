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
<meta name="viewport" content="initial-scale=0.5">
<?php wp_head(); ?>
 
</head> 

<body>  

<div id="intro_page">

<div id="intro-slider">


	<?php
	/* THIS IS THE REDIRECT TO SHOW DURING LAUNCH DATES */ 


	// if page has url show this page, if not show the normal intro page. 

	if (isset($_GET['kandan']) && $_GET['kandan'] == 'new' ) : ?>

			
<style type="text/css">
	/*#intro-slider{background: none;}*/
	#intro_page #intro-slider .intro-content h3{
		font-family: 'helv-light';
		font-size: 22px;
		line-height: 25px;
		font-style: normal;

	}

	.intro-content{
		max-width: 780px;
		padding-left: 25px;
	}

	html{
		min-width: 1400px;
		min-height: 1100px;
	}

		/* Smartphones (portrait) ----------- */
		@media only screen and (max-width : 321px) {
			.intro-content{
				left:20px !important;
				width: 80%!important;
			}
		/* Styles */`
		}


</style>

	
		<!-- NEW WEBSITE PAGE -->

		
			<a id="intro-link" href="/home/" style="width: 1168px; height: 953px;"></a>
			
				<div class="intro-content">	
				
					<h2 style="letter-spacing: -0.4px;">We’ve launched our new website.</h2>	
					<h3>After seven years, Kandan has grown and outgrown it’s old website.<br>
					Okay, we might be showing off a bit, but we’re proud of where we’ve come from and where we’re heading.</h3>
					<a class="cta" href="home/">Enter website</a>				
				</div>

				<div class="intro-image"><img width="1024" height="768" src="http://kandan.com.au/wp-content/themes/kandan-2013-theme/images/new-website.jpg" class="attachment-post-thumbnail wp-post-image" alt="quote-07"></div>				
			
		
		<!--  NEW WEBSITE PAGE -->

	
				
	

	<?php else : ?>


<style type="text/css">

	html{
		min-width: 1400px;
	}
</style>
		<!-- NORMAL PAGE -->

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
			
		<?php endforeach; ?>

		<!--  END OF NORMAL PAGE -->
			

	<?php endif; ?>

				
	</div>

</div>
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
<!-- GOOGLE ANALYTICS -->

</body>

</html>
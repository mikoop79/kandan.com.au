<?php ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title><?php echo get_post_meta($post->ID, '_page_title', true) ?> | Creative Design Studio | South Melbourne</title>

<meta name="keywords" content="<?php echo get_post_meta($post->ID, "_meta_tags", true) ?>" />
<meta name="description" content="<?php echo get_post_meta($post->ID, "_meta_des", true) ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/custom-styles/navigation.css" />
    <!--[if gt IE 9 ]><!-->
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/custom-styles/navigation-ie.css" />
    <!--[endif]-->

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" media="print" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts.php"></script>

<?php wp_head(); ?>
 
</head> 

<body>  

<div id="page-loader"></div>

<div id="wrapper">   

	<div id="header">   

		<!-- BACK BUTTON FOR WORK AND PEOPLE -->
		<a href="javascript:history.go(-1)" id="the_work-close-button">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/people-close.png" alt="click here to go back" />
		</a>

		<div id="logo">
			<a href="/home">
			<img id="white-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/kandan_logo.gif" alt="" />
			<img id="black-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/kandan_logo-black.gif" alt="" />
			</a>
		</div>  

		<div id="primary_nav">
			<?php wp_nav_menu('exclude=186,188,1218,1254'); ?>
		</div>	
        	<div id="header-line"></div>
    	</div>
		
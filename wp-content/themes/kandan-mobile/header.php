<?php ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title><?php echo get_post_meta($post->ID, '_page_title', true) ?></title>

<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable=true;">

<meta name="keywords" content="<?php echo get_post_meta($post->ID, "_meta_tags", true) ?>" />
<meta name="description" content="<?php echo get_post_meta($post->ID, "_meta_des", true) ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" media="print" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts.php"></script>

<?php wp_head(); ?>

</head> 

<body>  

<div id="portrait_mode">

	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/kandan_logo.gif" alt="" />

	<h2>Do yourself a favour<br />and go back to Portrait mode!</h2>

</div>

<div id="wrapper">   

	<div id="logo">
		<a href="/">
			<img id="white-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/kandan_logo.gif" alt="" />
		</a>
	</div>  
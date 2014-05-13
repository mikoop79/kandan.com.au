<?php ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title><?php echo get_post_meta($post->ID, '_page_title', true) ?></title>

<meta name="viewport" content="width=device-width initial-scale = 1.0">

<meta name="keywords" content="<?php echo get_post_meta($post->ID, "_meta_tags", true) ?>" />
<meta name="description" content="<?php echo get_post_meta($post->ID, "_meta_des", true) ?>" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" media="print" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/javascripts/common.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/javascripts/bootstrap.min.js"></script>
<?php wp_head(); ?>

</head> 

<body>  

<div class="loader">
    <div class="" >Loading</div>
</div>
<div id="portrait_mode">

	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/kandan_logo.gif" alt="" />

	<h2>Do yourself a favour<br />and go back to Portrait mode!</h2>

</div>

<div id="wrapper" class="container-fluid">  
	<div id="jp-nav" class="navbar navbar-default kd-nav-bar" role="navigation">
        <div id="logo">
				<a href="/">
					<img id="white-logo" width="118" src="<?php bloginfo('stylesheet_directory'); ?>/images/mobile-logo.jpg" alt="" />
				</a>
		</div>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul id="myTab" class="nav nav-tabs">
                        <li data-number="1"><a href="/who-we-are/">Who we are</a></li>
                        <li data-number="2"><a href="/what-we-do/">What we do</a></li>
                        <li data-number="3"><a href="/the-work/">The Work</a></li>
                        <li data-number="4"><a href="/blog/">Blog</a></li>
                        <li data-number="5"><a href="/people-culture/">People &amp; Culture</a></li>
                        <li data-number="6"><a href="/connect-with-us/">Connect with us</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->      
            </div>
            <!-- END OF NAV BAR -->	 
		</div>

		


	  
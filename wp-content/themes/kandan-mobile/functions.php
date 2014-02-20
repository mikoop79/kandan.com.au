<?php
//
//
//
// HANDLE EMAIL FROM 
//
function res_fromemail($email) {
    $wpfrom = get_option('admin_email');
    return $wpfrom;
} 
function res_fromname($email){
    $wpfrom = get_option('blogname');
    return $wpfrom;
}
add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');
// GET THE PAGE NUMBER
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
}
//
//
//
// EXCERPTS WITHOUT 'more...'
//
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'...';
  return $excerpt;
}
//
// SUPPORT THUMBNAILS 
add_theme_support( 'post-thumbnails' );
//
//
//
// LOGIN LOGO
//
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/kandan_logo-login.gif) !important; 
	height: 125px!important; background-size: 200px 131px!important;}
	body, html { background-color: #0078ae!important; }
	body.login {color: #0078ae!important;}
	#backtoblog {display: none;}
	.login #nav{ margin-left:-5px;}
	.login #nav a{color: #21759B!important; }
	.login #nav a:hover{color: #BE5B00!important;}
	.login form .input, .login input[type="text"]{border: 1px solid #ccc;}
	#nav{ text-shadow:none;}
	form { -moz-border-radius: 0; -moz-box-shadow: none; border: 0!important;}
	.login form {box-shadow: none!important; padding: 23px 8px 20px; margin-left:3px!important;}
	#login{ background-color: #ffffff;
    		border:0;
		color: #777!important;
    		margin: 7em auto;
    		padding: 25px 30px 25px 25px;
    		width: 320px;
		border-radius: 10px;
		-moz-box-shadow: 0 0 10px #555;
		-webkit-box-shadow: 0 0 10px #555;
		box-shadow: 0 0 10px #555;
		}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');
//
//
//
// CHANGE LOGIN LOGO URL 
//
function change_wp_login_url() {
        echo bloginfo('/index.php');
}
add_filter('login_headerurl', 'change_wp_login_url');
//
//
//
//
//
//
//
//SECONDARY FEATURED IMAGE
//
if (class_exists('MultiPostThumbnails')) {
	// SETS FOR EACH SIGNIFICANT IMAGES ON THE WORK
	new MultiPostThumbnails(
		array(
			'label' => 'Client Logo',
			'id' => 'the_client1',
			'post_type' => 'the_client'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Project Thumbnail',
			'id' => 'the_work2',
			'post_type' => 'the_work'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Services Thumbnail',
			'id' => 'the_work3',
			'post_type' => 'the_work'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Their Thumbnail',
			'id' => 'the_people1',
			'post_type' => 'the_people'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Their Pro Face',
			'id' => 'the_people2',
			'post_type' => 'the_people'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Their Crazy Thumbnail',
			'id' => 'the_people3',
			'post_type' => 'the_people'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Their Crazy Face',
			'id' => 'the_people4',
			'post_type' => 'the_people'
		)
	);

}
//
add_image_size('post-the_people2-thumbnail', 350, 283);
//
//
// CREATE ADMIN MENU SEPARATOR
// REGISTER
add_action('admin_menu','admin_menu_separator');
// ADD
function add_admin_menu_separator($position) {
	global $menu;
	$index = 0;
	foreach($menu as $offset => $section) {
		if (substr($section[2],0,9)=='separator')
		    $index++;
		if ($offset>=$position) {
			$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
			break;
	    }
	}
	ksort( $menu );
}
// INSERT
function admin_menu_separator() {
	// ADDS CURRENTLY AFTER THE WORK (position 5)
	add_admin_menu_separator(6); 
	add_admin_menu_separator(10); 
add_admin_menu_separator(12); 
}
//
//
//
// REMOVES CERTAIN MENU ITEMS FOR ANYONE LESS THAN AN EDITOR
//
add_action( 'admin_init', 'my_remove_menu_pages' ); 
function my_remove_menu_pages() {
	// If the user does not have access to publish posts
	if(!current_user_can('activate_plugins')) {
		// Remove the "Tools" menu
		remove_menu_page('tools.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('upload.php');
		remove_menu_page('profile.php');
	}
}
//
//
//
// INTRO SLIDES - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_intro_slides' );
function my_custom_post_intro_slides() {
	$labels = array(
		'name'               => _x( 'Intro Slides', 'post type general name' ),
		'singular_name'      => _x( 'Intro Slides', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Slide' ),
		'add_new_item'       => __( 'Add New Slide' ),
		'edit_item'          => __( 'Edit Slide' ),
		'new_item'           => __( 'New Slide' ),
		'all_items'          => __( 'All Slides' ),
		'view_item'          => __( 'View Slides' ),
		'search_items'       => __( 'Search Slides' ),
		'not_found'          => __( 'No slides found' ),
		'not_found_in_trash' => __( 'Empty' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Intro Slides'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the initial slides when you first come to the site.',
		'public'        => true,
		'menu_position' => 7,
		// Not adding thumbnails removes 'featured image' this means we just have 'team photo' - nice
		'supports'      => array( 'title', 'thumbnail'),
		'has_archive'   => true
	);
	register_post_type( 'intro_slides', $args );	
}
add_action( 'init', 'my_custom_post_intro_slides' );
//
//
//
// CUSTOM META BOX FOR INTRO SLIDES
//
// ADD IT!
add_action( 'admin_init', 'add_intro_slides_metaboxes' );

function add_intro_slides_metaboxes() {
	add_meta_box('intro_slides_metabox', 'Slide Details', 'intro_slides_metabox_id', 'intro_slides', 'normal', 'high');
}
// ADDS CONTENT!
function intro_slides_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$slide_number = get_post_meta($post->ID, '_slide_number', true);
	$h1 = get_post_meta($post->ID, '_h1', true);
	$quoted = get_post_meta($post->ID, '_quoted', true);
	$link_text = get_post_meta($post->ID, '_link_text', true);
	$link_the_url = get_post_meta($post->ID, '_link_the_url', true);
	
	// OUT INPUTS & LABELS	
	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Slide number (no colon) </label>';
	echo '<input type="textarea" name="_slide_number" value="' . $slide_number  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px">This is not the actual order number!</em>';
	echo '<label>Insert Slide title </label>';
	echo '<input type="textarea" name="_h1" value="' . $h1  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide quote </label>';
	echo '<input type="textarea" name="_quoted" value="' . $quoted  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide Link Text </label>';
	echo '<input type="textarea" name="_link_text" value="' . $link_text  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide Link URL </label>';
	echo '<input type="textarea" name="_link_the_url" value="' . $link_the_url  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '</div>';
}

// SAVE IT!

function save_add_intro_slides_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$events_meta['_slide_number'] = $_POST['_slide_number'];
	$events_meta['_h1'] = $_POST['_h1'];
	$events_meta['_quoted'] = $_POST['_quoted'];
	$events_meta['_link_text'] = $_POST['_link_text'];
	$events_meta['_link_the_url'] = $_POST['_link_the_url'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_intro_slides_metaboxes', 1, 2); // save the custom fields
//
//
//
// HONE PAGE SLIDES - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_home_slides' );
function my_custom_post_home_slides() {
	$labels = array(
		'name'               => _x( 'Home Slides', 'post type general name' ),
		'singular_name'      => _x( 'Home Slides', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Slide' ),
		'add_new_item'       => __( 'Add New Slide' ),
		'edit_item'          => __( 'Edit Slide' ),
		'new_item'           => __( 'New Slide' ),
		'all_items'          => __( 'All Slides' ),
		'view_item'          => __( 'View Slides' ),
		'search_items'       => __( 'Search Slides' ),
		'not_found'          => __( 'No slides found' ),
		'not_found_in_trash' => __( 'No slides found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Home Slider'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the initial slides when you first come to the site.',
		'public'        => true,
		'menu_position' => 8,
		// Not adding thumbnails removes 'featured image' this means we just have 'team photo' - nice
		'supports'      => array( 'title', 'thumbnail'),
		'has_archive'   => true
	);
	register_post_type( 'home_slides', $args );	
}
add_action( 'init', 'my_custom_post_home_slides' );
//
//
//
// CUSTOM META BOX FOR HOME SLIDES
//
// ADD IT!
add_action( 'admin_init', 'add_home_slides_metaboxes' );

function add_home_slides_metaboxes() {
	add_meta_box('home_slides_metabox', 'Slide Details', 'home_slides_metabox_id', 'home_slides', 'normal', 'high');
}
// ADDS CONTENT!
function home_slides_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$h1 = get_post_meta($post->ID, '_h1', true);
	$h2 = get_post_meta($post->ID, '_h2', true);
	$link_text = get_post_meta($post->ID, '_link_text', true);
	$link_the_url = get_post_meta($post->ID, '_link_the_url', true);
	
	// OUT INPUTS & LABELS	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Insert Slide title </label>';
	echo '<input type="textarea" name="_h1" value="' . $h1  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide subtitle </label>';
	echo '<input type="textarea" name="_h2" value="' . $h2  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide Link Text </label>';
	echo '<input type="textarea" name="_link_text" value="' . $link_text  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '<label>Insert Slide Link URL </label>';
	echo '<input type="textarea" name="_link_the_url" value="' . $link_the_url  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '</div>';
}

// SAVE IT!

function save_add_home_slides_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$events_meta['_h1'] = $_POST['_h1'];
	$events_meta['_h2'] = $_POST['_h2'];
	$events_meta['_link_text'] = $_POST['_link_text'];
	$events_meta['_link_the_url'] = $_POST['_link_the_url'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_home_slides_metaboxes', 1, 2); // save the custom fields
//
//
//
// THE WORK - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_the_work' );
function my_custom_post_the_work() {
	$labels = array(
		'name'               => _x( 'The Work', 'post type general name' ),
		'singular_name'      => _x( 'The Work', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Project' ),
		'add_new_item'       => __( 'Add New Project' ),
		'edit_item'          => __( 'Edit Project' ),
		'new_item'           => __( 'New Project' ),
		'all_items'          => __( 'All Projects' ),
		'view_item'          => __( 'View Project' ),
		'search_items'       => __( 'Search Work' ),
		'not_found'          => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'The Work'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds all our projects filtered by Client names, Categories and Services.',
		'public'        => true,
		'menu_position' => 9,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => true,
		'taxonomies' => array('category')
	);
	register_post_type( 'the_work', $args );	
}
add_action( 'init', 'my_custom_post_the_work' );
?>
<?php
//
//
//
// CUSTOM META BOX FOR THE WORK
//
// ADD IT!
add_action( 'admin_init', 'add_the_work_metaboxes' );

function add_the_work_metaboxes() {
	add_meta_box('the_work_metabox', 'Project Details', 'the_work_metabox_id', 'the_work', 'normal', 'high');
}
// ADDS CONTENT!
function the_work_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$h1 = get_post_meta($post->ID, '_h1', true);
	$h2 = get_post_meta($post->ID, '_h2', true);
	
	
	// OUT INPUTS & LABELS	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Insert Project title (H1)</label>';
	echo '<input type="textarea" name="_h1" value="' . $h1  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"> This will also be the H1 for SEO!</em>';
	echo '<label>Insert Project subtitle (H2)</label>';
	echo '<input type="textarea" name="_h2" value="' . $h2  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"> This will also be the H2 for SEO!</em>';
	echo '</div>';
}

// SAVE IT!

function save_add_the_work_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$events_meta['_h1'] = $_POST['_h1'];
	$events_meta['_h2'] = $_POST['_h2'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_the_work_metaboxes', 1, 2); // save the custom fields
//
//
//
// CUSTOM SEO META BOX FOR THE WORK
//
// ADD IT!
add_action( 'add_meta_boxes', 'seo_add_the_work_metaboxes' );
// ADDS THE ACTUAL BOX (this does it for all posts and pages delayed below)
function seo_add_the_work_metaboxes() {
 	foreach (array('post','page','the_work','the_people') as $both_pages_posts) 
    	{
		add_meta_box('seo_the_work_metabox', 'SEO Details', 'seo_the_work_metabox_id', $both_pages_posts, 'side', 'high' );
	}
}
// ADDS CONTENT!
function seo_the_work_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$page_title = get_post_meta($post->ID, '_page_title', true);
	$meta_des = get_post_meta($post->ID, '_meta_des', true);
	$meta_tags = get_post_meta($post->ID, '_meta_tags', true);
	
	
	// OUT INPUTS & LABELS	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Insert Page Title</label>';
	echo '<input type="textarea" name="_page_title" value="' . $page_title  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px">The words at the very top of your browser</em>';
	echo '<label>Insert META Description</label>';
	echo '<input type="textarea" name="_meta_des" value="' . $meta_des  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px">Describe this page using keywords and content</em>';
	echo '<label>Insert META Tags</label>';
	echo '<input type="textarea" name="_meta_tags" value="' . $meta_tags  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px">A handful of keywords - Seperate by comma and no spaces</em>';
	echo '</div>';
}

// SAVE IT!

function save_seo_add_the_work_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$SEO_meta['_page_title'] = $_POST['_page_title'];
	$SEO_meta['_meta_des'] = $_POST['_meta_des'];
	$SEO_meta['_meta_tags'] = $_POST['_meta_tags'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($SEO_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_seo_add_the_work_metaboxes', 1, 2); // save the custom fields
//
//
//
// MODIFY FOOTER
//
function modify_footer_admin () {
  echo 'Custom Integration by <a href="http://www.kandan.com.au">Kandan</a>. ';
  echo 'Powered by <a href="http://WordPress.org">WordPress</a>.';
}
add_filter('admin_footer_text', 'modify_footer_admin');
//
//
//
// THE PEOPLE - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_the_people' );
function my_custom_post_the_people() {
	$labels = array(
		'name'               => _x( 'People', 'post type general name' ),
		'singular_name'      => _x( 'People', 'post type singular name' ),
		'add_new'            => _x( 'Add a Person', 'Person' ),
		'add_new_item'       => __( 'Add a Person' ),
		'edit_item'          => __( 'Edit Person' ),
		'new_item'           => __( 'New Person' ),
		'all_items'          => __( 'All The People' ),
		'view_item'          => __( 'View People' ),
		'search_items'       => __( 'Search People' ),
		'not_found'          => __( 'No people found' ),
		'not_found_in_trash' => __( 'No people found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'People'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds all staff bios and pics.',
		'public'        => true,
		'menu_position' => 10,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => true
	);
	register_post_type( 'the_people', $args );	
}
add_action( 'init', 'my_custom_post_the_people' );
?>
<?php
//
//
//
// CUSTOM META BOX FOR THE PEOPLE
//
// ADD IT!
add_action( 'admin_init', 'add_the_people_metaboxes' );

function add_the_people_metaboxes() {
	add_meta_box('the_people_metabox', 'Project Details', 'the_people_metabox_id', 'the_people', 'normal', 'high');
}
// ADDS CONTENT!
function the_people_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$peoplename = get_post_meta($post->ID, '_peoplename', true);
	$peopletitle = get_post_meta($post->ID, '_peopletitle', true);
	
	
	// OUT INPUTS & LABELS	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Insert the Persons full name</label>';
	echo '<input type="textarea" name="_peoplename" value="' . $peoplename  . '" class="widefat" />';
	
	echo '<label>Insert their position / title</label>';
	echo '<input type="textarea" name="_peopletitle" value="' . $peopletitle  . '" class="widefat" />';
	
	echo '</div>';
}

// SAVE IT!

function save_add_the_people_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$events_meta['_peoplename'] = $_POST['_peoplename'];
	$events_meta['_peopletitle'] = $_POST['_peopletitle'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_the_people_metaboxes', 1, 2); // save the custom fields
////
//
//
// CUSTOM TAXONOMY FOR PEOPLE
//
function add_custom_taxonomies() {
	register_taxonomy('levels', 'the_people', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Levels', 'taxonomy general name' ),
			'singular_name' => _x( 'Level', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Levels' ),
			'all_items' => __( 'All Levels' ),
			'parent_item' => __( 'Parent Levels' ),
			'parent_item_colon' => __( 'Parent Level:' ),
			'edit_item' => __( 'Edit Level' ),
			'update_item' => __( 'Update Level' ),
			'add_new_item' => __( 'Add New Level' ),
			'new_item_name' => __( 'New Level Name' ),
			'menu_name' => __( 'Levels' ),
		),
		'rewrite' => array(
			'slug' => 'levels', 
			'with_front' => false, 
			'hierarchical' => true 
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );
//
//
//
//
//
//
// THE CLIENT LOGO - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_the_client' );
function my_custom_post_the_client() {
	$labels = array(
		'name'               => _x( 'Client Logo', 'post type general name' ),
		'singular_name'      => _x( 'Client Logo', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Client Logo' ),
		'add_new_item'       => __( 'Add New Client Logo' ),
		'edit_item'          => __( 'Edit Client Logo' ),
		'new_item'           => __( 'New Client Logo' ),
		'all_items'          => __( 'All Client Logos' ),
		'view_item'          => __( 'View Client Logo' ),
		'search_items'       => __( 'Search Client Logos' ),
		'not_found'          => __( 'No Client Logos found' ),
		'not_found_in_trash' => __( 'No Client Logos found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Client Logos'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds all our projects filtered by Client names, Categories and Services.',
		'public'        => true,
		'supports'      => array( 'title'),
		'has_archive'   => true
	);
	register_post_type( 'the_client', $args );	
}
add_action( 'init', 'my_custom_post_the_client' );
//
//
//
// CUSTOM META BOX FOR THE CLIENT LOGO
//
// ADD IT!
add_action( 'admin_init', 'add_the_client_metaboxes' );

function add_the_client_metaboxes() {
	add_meta_box('the_client_metabox', 'Logo Details', 'the_client_metabox_id', 'the_client', 'normal', 'high');
}
// ADDS CONTENT!
function the_client_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$logo_link = get_post_meta($post->ID, '_logo_link', true);

	$logo_order = get_post_meta($post->ID, '_logo_order', true);
	
	
	// OUT INPUTS & LABELS	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Insert Logo Link</label>';
	echo '<input type="textarea" name="_logo_link" value="' . $logo_link  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"> This is the category slug, typically /category/clients/anz-bank </em>';

	echo '<label>Insert Logo order </label>';
	echo '<input type="textarea" name="_logo_order" value="' . $logo_order  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"> Enter a number from 01-12. All Single numbers must start with a zero.  eg 04, 05 etc. </em>';

	echo '</div>';
}

// SAVE IT!

function save_add_the_client_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS	
	$events_meta['_logo_link'] = $_POST['_logo_link'];
	$events_meta['_logo_order'] = $_POST['_logo_order'];

	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_the_client_metaboxes', 1, 2); // save the custom fields
//
//
//
// SHOWS ALL THUMBNAILS FOR WHAT WE DO PAGE 
//
//
function show_all_thumbs() {
    global $post;
    $post = get_post($post);

/* image code */
$images =& get_children( 'post_type=attachment&post_mime_type=image&output=ARRAY_N&posts_per_page=5&orderby=menu_order&order=ASC&post_parent='.$post->ID);
if($images){
	$count = 0;
foreach( $images as $imageID => $imagePost ){
if ($count > 0 ){ 
	unset($the_b_img);
	$the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
	$thumblist .= '<a class="'.$count . '"" href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';
	}
$count ++;
	}
}
return $thumblist;
}
//
//
//
//
// ADDS SLUG TO wp_list_categories() 
add_filter('wp_list_categories', 'add_slug_css_list_categories');
function add_slug_css_list_categories($list) {

$cats = get_categories();
	foreach($cats as $cat) {
	$find = '' . $cat->term_id . '"';
	$replace = '' . $cat->slug . '"';
	$list = str_replace( $find, $replace, $list );
	$find = '' . $cat->term_id . ' ';
	$replace = '' . $cat->slug . ' ';
	$list = str_replace($find, $replace, $list );
	}

return $list;
}
//
//
//
//

?>
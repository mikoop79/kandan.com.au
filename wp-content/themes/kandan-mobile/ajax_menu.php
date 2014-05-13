<?php
/*
Template Name: AJAX Menu
*/
$url = $_SERVER["REQUEST_URI"];

$isItPeople = strpos($url, 'the_people');
$isItPeopleAll = strpos($url, 'people-culture');
$isItWork = strpos($url, 'the-work');
$isItWho= strpos($url, 'who-we-are');
$isItWhat= strpos($url, 'what-we-do');
$isItSingleWork = strpos($url, 'the_work');
$isItBlog= strpos($url, 'blog');
$isItConnect= strpos($url, 'connect-with-us');
$added = false;

	if ($isItPeople!==false )
	{
	    //url contains 'blog'
		$breadcrumb = ' <a href="index.php?page_id=198">People &amp; Culture</a>';
		$added = true;

	}

	  elseif ($isItPeopleAll!==false)

	{
	    //url contains 'blog'
		$breadcrumb = ' <p>People &amp; Culture</p>';
		$added = true;

	} elseif ($isItWork!==false) {

		$breadcrumb = ' <p>The Work</p>';
		$added = true;

	} elseif ($isItSingleWork!==false) {

		$breadcrumb = ' <a href="index.php?page_id=194">The Work</a>';
		$added = true;

	} elseif ($isItWho!==false) {

		$breadcrumb = ' <p>Who we are</p>';
		$added = true;

	} elseif ($isItWhat!==false) {

		$breadcrumb = ' <p>What we do</p>';
		$added = true;

	} elseif ($isItConnect!==false) {

		$breadcrumb = ' <p>Connect with us </p>';
		$added = true;

	} elseif($added!== true) {

		$breadcrumb = ' <p>The Blog</p>';
		
	} 



?>

<div class="ajax-menu">
	<?php echo $breadcrumb ?>

	<a class="close-cross-btn" data-bypass="true" href="javascript:history.go(-1)" ></a>
</div>


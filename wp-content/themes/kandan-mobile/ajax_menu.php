<?php
/*
Template Name: AJAX Menu
*/

$url = $_SERVER["REQUEST_URI"];

$isItPeople = strpos($url, 'the_people');
$isItWork = strpos($url, 'the_work');

if ($isItPeople!==false)
{
    //url contains 'blog'
	$breadcrumb = '> <a href="index.php?page_id=198">the people</a>';

} elseif ($isItWork!==false) {

	$breadcrumb = '> <a href="index.php?page_id=194">the work</a>';
	
} else {
	$breadcrumb = '';
}


?>

<div class="ajax-menu">
	<a href="/index.php" title="Touch here to go home">home</a> <?php echo $breadcrumb ?>
</div>


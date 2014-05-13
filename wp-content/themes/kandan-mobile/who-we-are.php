<?php
/*
Template Name: Who We Are
*/
?>

<!-- ONLY LOAD HEADER WHEN NO AJAX CALL OCCURS -->


<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">



<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<div id="content" class="who-we-are">
	<div class="content-img">
		<?php echo get_the_post_thumbnail( $id, array(290,290)); ?> 
	</div>
	
	
	<?php the_post(); ?>        
	<?php the_content(); ?>    
</div>		
		
<!-- ONLY LOAD FOOTER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>

</div>

<?php get_footer(); ?>
<?php }?>
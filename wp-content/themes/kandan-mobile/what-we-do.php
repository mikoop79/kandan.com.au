<?php
/*
Template Name: What We Do
*/
?>

<!-- ONLY LOAD HEADER WHEN NO AJAX CALL OCCURS -->


<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/ajax_menu.php'); ?> 

<div class="ajax-content">



<!-- PAGE CONTENT -->
<!-- so this part is only loaded by AJAX and the footer and header if a call is made directly to the page -->

<div id="content">
	   		
	<div class="what_we_do-wrapper">
			<?php 
				$id = 192;
				$p = get_page($id);
				echo apply_filters('the_content', $p->post_content);
			?>

			<?php echo get_the_post_thumbnail( $id, array(290,290)); ?> 
			</div>

			<div class="services-icons">

				<?php the_secondary_content(); ?>

				<?php get_post_thumbnail_id(1254); ?>

				<?php	
					/* GET PROCESS ROLLOVER PAGE CONTENT */
					$post_id = 1254;
					$process = get_post($post_id);
					$title = $process->post_title;
					$content = $process->post_content;
				?>

			<!-- PROCESS CHART SHOWS HERE -->
			<div id="process-chart">
				
			</div>
				
			</div>
<style type="text/css">
	

	#process-chart{
		background: url('<?php echo $url = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); ?>');
		height: 850px;
		width: 100%;
		background-size: cover;
	}
</style>
			    

			</div>

</div>
		
<!-- ONLY LOAD FOOTER WHEN NO AJAX CALL OCCURS -->

<?php if($_SERVER['HTTP_X_REQUESTED_WITH']==''){?>

</div>

<?php get_footer(); ?>
<?php }?>

<script type="text/javascript">
	$(document).ready(function(){
		$('h3').each( function(){
			var className = "anchor-" + $(this).text();
			className = className.toLowerCase().replace(" ",'-');
			$(this).addClass(className);
		})

	$(".wp-post-image").click(function(){
		$('html,body').animate({scrollTop: ($("#process-chart").offset().top-10)+'px'}, 	'slow');
	})


	// $(".client-name").text("Rollover thumbs");
	var theURL = document.URL.substr(document.URL.indexOf('#'));
	var classAnchor = theURL.split('#');
	
		if (theURL != '/'){
			$('html,body').animate({scrollTop: ($(".anchor-"+classAnchor[1]).offset().top-25)+'px'}, 	'slow');
		}
	});
</script>
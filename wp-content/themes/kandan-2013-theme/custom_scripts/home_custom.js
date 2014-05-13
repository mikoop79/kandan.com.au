$(document).ready(function($){
	$('.content-section .arrow').remove();
	$('.content-section .invisible-button').remove();
	$('#footer_address').css({'display':'block'});
});

/* REMOVES ADDS THE LINE UNDER THE NAV MENU */
$('#header-line').css({'border-bottom':'solid 0px #B2B2B2'});

$(window).scroll(function () {
    $('#home-slider').each(function () {
        if (($(this).offset().top - $(window).scrollTop()) < 100) {
            $('#header-line').stop().css({'border-bottom':'solid 1px #B2B2B2'});
        } else {
            $('#header-line').stop().css({'border-bottom':'solid 0px #B2B2B2'});
        }
    });
});

/* CONTROLS WORK SLIDER */
$(document).ready(function($){
	$('#landing-the_work-controller .second').click(function(){
			$('#landing-the_work').animate({'margin-left':'-964px'});
			$(this).addClass('active');
			$(this).removeClass('ready');
			$(this).siblings().addClass('ready');
			$(this).siblings().removeClass('active');
	});

	$('#landing-the_work-controller .first').click(function(){
			$('#landing-the_work').animate({'margin-left':'0px'});
			$(this).addClass('active');
			$(this).removeClass('ready');
			$(this).siblings().addClass('ready');
			$(this).siblings().removeClass('active');
	});
});

/* CONTROLS CLIENT LOGO SLIDER */

$(document).ready(function(){

	/* ALIGNS ALL IMAGES VERTICALLY */
	
	$('#landing-our_clients li a img').each(function(){
		var theImageHeight = $(this).height();
		var setTheImageMargin = 105 - (theImageHeight / 2) /* the height of the li box */ ;
		$(this).css({'margin-top': setTheImageMargin });	
	});

	/* HOVERS */
	
	$('#landing-our_clients li').hover(
		function(){
			$(this).children('.hover-veil').fadeIn({queue: false});			
		},
		function(){
			$(this).children('.hover-veil').fadeOut({queue: false});
		}
	);

	/* THE SLIDER */
	
	$('#landing-our_clients-controller .second').click(function(){
		$('#landing-our_clients').animate({'margin-left':'-960px'});
		$(this).addClass('active');
		$(this).removeClass('ready');
		$(this).siblings().addClass('ready');
		$(this).siblings().removeClass('active');
	});

	$('#landing-our_clients-controller .first').click(function(){
		$('#landing-our_clients').animate({'margin-left':'0px'});
		$(this).addClass('active');
		$(this).removeClass('ready');
		$(this).siblings().addClass('ready');
		$(this).siblings().removeClass('active');
	});
});
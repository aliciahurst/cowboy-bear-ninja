jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*	Responsive Menu
/*-----------------------------------------------------------------------------------*/

	$(".mob-btn").click(function(){
		$("#mobile-menu").slideToggle("fast");
		return false;
	});

/*--------------------------------------------------------------------------------------*/
/*	FlexSlider
/*--------------------------------------------------------------------------------------*/

	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "fade",
			slideshow: true,
			smoothHeight: true,
			slideshowSpeed: 7000,
			animationSpeed: 600,
			controlNav: false,
			directionNav: true,
			prevText: "<i class='fa-chevron-left'></i>",
			nextText: "<i class='fa-chevron-right'></i>"
		});
	});
	
/*--------------------------------------------------------------------------------------*/
/*	Portfolio Filter
/*--------------------------------------------------------------------------------------*/

	$(window).load(function(){  
		$('#portfolio .portfolio-inner, #gallery .gallery-inner').isotope({
			itemSelector : '.hentry',
			layoutMode : 'fitRows'
		});
		$('#filter a.active').trigger("click");
	});

	$('#filter a').click(function(e){
		e.preventDefault();
		var selector = $(this).attr('value');
		$('#portfolio .portfolio-inner, #gallery .gallery-inner').isotope({filter: selector});
		$(this).parents().find('a').removeClass('active');
		$(this).addClass('active');
	});
	
/*-----------------------------------------------------------------------------------*/
/*	Magnific Popup
/*-----------------------------------------------------------------------------------*/

	$('#gallery').each(function(){
		$(this).magnificPopup({
			delegate: 'a',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]
			},
			type: 'image'
		});
	});

/*--------------------------------------------------------------------------------------*/
/*	Contact form validation
/*--------------------------------------------------------------------------------------*/

	$("#contact-form").validate();

/*--------------------------------------------------------------------------------------*/
/*	Tabs
/*--------------------------------------------------------------------------------------*/

	var $tabsNav    = $('.tabs-nav'),
		$tabsNavLis = $tabsNav.children('li'),
		$tabContent = $('.tab-content');

	$tabsNav.each(function(){
		var $this = $(this);

		$this.next().children('.tab-content').stop(true,true).hide().first().show();
		$this.children('li').first().addClass('active').stop(true,true).show();
	});

	$tabsNavLis.on('click', function(e){
		var $this = $(this);

		$this.siblings().removeClass('active').end().addClass('active');
		$this.parent().next().children('.tab-content').stop(true,true).hide().siblings($this.find('a').attr('href')).fadeIn();

		e.preventDefault();
	});

/*--------------------------------------------------------------------------------------*/
/*	Toggle
/*--------------------------------------------------------------------------------------*/

	$(".toggle-content").hide();
	$(".toggle-title").toggle(function(){
		$(this).addClass("active");
	}, function(){
		$(this).removeClass("active");
	});
	$(".toggle-title").click(function(){
		$(this).next(".toggle-content").slideToggle();
	});

	$(".toggle-title.opened").toggle(function(){
		$(this).removeClass("active");
	}, function(){
		$(this).addClass("active");
	});
	$(".toggle-title.opened").addClass("active").next(".toggle-content").show();

});
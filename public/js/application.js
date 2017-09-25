// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or vendor/assets/javascripts of plugins, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/sstephenson/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require jquery
//= require jquery_ujs
// require turbolinks
//= require konzerte
// require setlists
//= require bootstrap-sprockets
//= require jquery.turbolinks
//= require bootstrap-wysihtml5
//= require abcjs_editor_2.0-min.js
//= require moment
//= require bootstrap-datetimepicker
//= require pickers
//= require ckeditor/init
// require abcjs-rails
// assets/javascripts/documents.js
//= require plugins-min.js
// require app-min.js

(function($, document, window){

	$(document).ready(function(){

		$("[data-background]").each(function(){
			var retina = window.devicePixelRatio > 1;
			var bg = $(this).data("background");
			if( retina ){
				var retinabg = bg.replace(".jpg",".jpg");
				$(this).css("background-image","url("+retinabg+")");	
			} else{
				$(this).css("background-image","url("+bg+")");
			}
			
		});

		$("[data-bg-color]").each(function(){
			var bg = $(this).data("bg-color");
			$(this).css("background-color",bg);
		});

		$(".slider").flexslider({
			directionNav: false,
			controlNav: true,
		});

		$(".quote-slider").flexslider({
			directionNav: true,
			controlNav: false,
			prevText: "<i class='fa fa-caret-left'></i>",
			nextText: "<i class='fa fa-caret-right'></i>",
		});

		var eventCarousel = $(".event-carousel");
		eventCarousel.owlCarousel({
 
			autoPlay: 3000, //Set AutoPlay to 3 seconds
			rewindNav: false,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]

		});
		// Custom Navigation Events
		$("#event-next").click(function(e){
			e.preventDefault();
			eventCarousel.trigger('owl.next');
		});
		$("#event-prev").click(function(e){
			e.preventDefault();
			eventCarousel.trigger('owl.prev');
		});

		var $container = $('.filterable-items');

		$container.imagesLoaded(function(){
		    $container.isotope({
		        filter: '*',
		        layoutMode: 'fitRows',
		        animationOptions: {
		            duration: 750,
		            easing: 'linear',
		            queue: false
		        }
		    });
		});
		$('.filterable-nav a').click(function(e){
	    	e.preventDefault();
	        $('.filterable-nav .current').removeClass('current');
	        $(this).addClass('current');

	        var selector = $(this).attr('data-filter');
	        $container.isotope({
	            filter: selector,
	            animationOptions: {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	         });
	         return false;
	    });
	    $('.mobile-filter').change(function(){

	        var selector = $(this).val();
	        $container.isotope({
	            filter: selector,
	            animationOptions: {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	         });
	         return false;
	    });

	    initLightbox({
	    	selector : '.filterable-item a',
	    	overlay: true,
	    	closeButton: true,
	    	arrow: true
	    });

	    $(".mobile-menu").append($(".main-navigation .menu").clone());
	    $(".toggle-menu").click(function(){
	    	$(".mobile-menu").slideToggle();
	    });

	    if( $(".map").length ){
			$('.map').gmap3({
				map: {
					options: {
						maxZoom: 14,
						scrollwheel: false
					}  
				},
				marker:{
					address: "40 Sibley St, Detroit",
				}
			},
			"autofit" );
	    }

	});

	$(window).ready(function(){

	});

})(jQuery, document, window);

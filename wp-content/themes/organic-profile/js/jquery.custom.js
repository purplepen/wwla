( function( $ ) {

	function removeNoJsClass() {
		$( 'html:first' ).removeClass( 'no-js' );
	}

	/* Superfish the menu drops ---------------------*/
	function superfishSetup() {
		$('.menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
		});
	}
	    
	/* Flexslider ---------------------*/
	function flexSliderSetup() {
		if( ($).flexslider) {
			var slider = $('.flexslider');
			slider.fitVids().flexslider({
				slideshowSpeed		: slider.attr('data-speed'),
				animationDuration	: 800,
				animation			: 'fade',
				video				: false,
				useCSS				: false,
				prevText			: '<i class="fa fa-angle-left"></i>',
				nextText			: '<i class="fa fa-angle-right"></i>',
				touch				: false,
				controlNav			: false,
				animationLoop		: true,
				smoothHeight		: true,
				pauseOnAction		: true,
				pauseOnHover		: false,

				start: function(slider) {
					slider.removeClass('loading');
					$( ".preloader" ).hide();
				}
			});
		}
	}
	    
   /* Portfolio Filter ---------------------*/
   function isotopeSetup() {
	   	var mycontainer = $('#portfolio-list');
	   	mycontainer.isotope({
	   		itemSelector: '.portfolio-item'
	   	});
   
	   	// filter items when filter link is clicked
	   	$('#portfolio-filter a').click(function(){
	   		var selector = $(this).attr('data-filter');
	   		mycontainer.isotope({ filter: selector });
	   		return false;
	   	});
    }
	    
	function modifyPosts() {
	
		/* Insert Line Break Before More Links ---------------------*/
		$('<br />').insertBefore('a.more-link');
	
		/* Share Modal Box ---------------------*/
		$('.btn-share').click(function(event) {
			event.preventDefault();
			$('#social').modal();
			try {
				FB.XFBML.parse();
			}catch(ex){}
		});
		
		/* Wrap DIV Around Home More ---------------------*/
		$( "#homepage .more-link" ).wrap( "<div class='align-center text-center'></div>" );
		
		/* Fit Vids ---------------------*/
		$('.container').fitVids();
	}
	
	$( document )
	.ready( removeNoJsClass )
	.ready( superfishSetup )
	.ready( modifyPosts )
	.on( 'post-load', modifyPosts );
	
	$( window )
	.load( flexSliderSetup )
	.load( isotopeSetup )
	.resize( isotopeSetup );
    
})( jQuery );
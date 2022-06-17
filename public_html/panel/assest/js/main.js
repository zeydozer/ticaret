    $(window).load(function() {
	
        $('.slider').bxSlider({
		  mode: 'horizontal',
		  auto: true
		});
		
		$(".firsatBox").slick({
			autoplay:true,
			dots: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			speed: 500
		});
		
		$(".group1").colorbox({rel:'group1'});
		$(".inline").colorbox({inline:true, width:"80%"});
		
		$("#firstpane p.menu_head").click(function() { $(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("fast"); });
		
		var $left = $('.left-div');
		var $right = $('.right-div');
		var $bottom = $('.bottom-div');
		var $top = $('.top-div');


		
		var $window = $(window);

		function check_if_in_view() {
			
		  var window_height = $window.height();
		  var window_top_position = $window.scrollTop();
		  var window_bottom_position = (window_top_position + window_height);
		 
		  $.each($left, function() {
				var $element = $(this);
				var element_height = $element.outerHeight();
				var element_top_position = $element.offset().top;
				var element_bottom_position = (element_top_position + element_height);
			 
				//check to see if this current container is within viewport
				if ((element_bottom_position >= window_top_position) &&
					(element_top_position <= window_bottom_position)) {
				  $element.addClass('animated fadeInLeft');
				} else {}
		  });

		  $.each($right, function() {
				var $element = $(this);
				var element_height = $element.outerHeight();
				var element_top_position = $element.offset().top;
				var element_bottom_position = (element_top_position + element_height);
			 
				//check to see if this current container is within viewport
				if ((element_bottom_position >= window_top_position) &&
					(element_top_position <= window_bottom_position)) {
				  $element.addClass('animated fadeInRight');
				} else {}
		  });
		  
		  $.each($bottom, function() {
				var $element = $(this);
				var element_height = $element.outerHeight();
				var element_top_position = $element.offset().top;
				var element_bottom_position = (element_top_position + element_height);
			 
				//check to see if this current container is within viewport
				if ((element_bottom_position >= window_top_position) &&
					(element_top_position <= window_bottom_position)) {
				  $element.addClass('animated fadeInUp');
				} else {}
		  });
		  
		  $.each($top, function() {
				var $element = $(this);
				var element_height = $element.outerHeight();
				var element_top_position = $element.offset().top;
				var element_bottom_position = (element_top_position + element_height);
			 
				//check to see if this current container is within viewport
				if ((element_bottom_position >= window_top_position) &&
					(element_top_position <= window_bottom_position)) {
				  $element.addClass('animated fadeInDown');
				} else {}
		  });
		}

		$window.on('scroll resize', check_if_in_view);
		$window.trigger('scroll');
		
		
		
    });
	
	$(function(){
		$('.icerik a').bind('click',function(event){
		$('.ust a').removeClass('active');
		var link = $(this);
		$(this).addClass('active');
		$('html, body').stop().animate({
		scrollTop: $(link.attr('href')).offset().top
		}, 1000);
		event.preventDefault();			
		});
		
	});
	
	function googleTranslateElementInit() {
	  new google.translate.TranslateElement({
		pageLanguage: 'en'
	  }, 'google_translate_element');
	}

	
	/*

	$(function() {
        var message = "Tekrar Bekleriz...";
        var original;

        $(window).focus(function() {
            if (original) {
                document.title = original;
            }
        }).blur(function() {
            var title = $('title').text();
            if (title != message) {
                original = title;
            }
            document.title = message;
        });
	}); */

     $(document).ready(function() {
          $(window).scroll(function () {
								var ustKisim = $('.ustKisim').height();
										altKisim = $('.footer').offset().top;
										scrollBottom = $(window).scrollTop() + $(window).height();

          if ($(document).scrollTop() < ustKisim) {
               $('.firmaBilgi').removeClass('pf');
           } else {
               $('.firmaBilgi').addClass('pf');
					 }
					 
					 if (scrollBottom >= altKisim)
					 {
						$('.firmaBilgi').removeClass('pf');
					 }
       });
     });
	


	
	
			
	
	
	
	
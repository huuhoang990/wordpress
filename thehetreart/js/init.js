(function ($) {
  $(function(){
	subMenu();
	mainSlider();
	slideFooter();
	if($("#h_slider").length > 0) {
		hSlider();
	}
	if($(".left_about").length > 0){
		heightMenuAbout();
	}
  });
})(jQuery);
var slideFooter = function(){
	$(document).ready(function(){
		var SlideAuto = "";
		var slider = $("#footer_slider > ul");
		var length_column_slide = $("#footer_slider > ul > li").length;
		var w_column_slide= $("#footer_slider > ul > li").width();
		var w_container_slide = length_column_slide*w_column_slide;
		var first_elem = "";
		var last_elem = "";
		var offset = ""; 
		var pos = ""; 
				
		slider.width(w_container_slide);
		$("#footerSlider_prev").bind("click", function(){
			last_elem = $("#footer_slider > ul > li").last();
			offset = slider.position();
			if (offset.left == 0) {
				last_elem.prependTo(slider);
				slider.css({'left': -(offset.left + w_column_slide) + 'px' });
			}
			offset = slider.position();
			pos = offset.left + w_column_slide;
			slider.filter(':not(:animated)').animate({
				'left': pos + 'px'
			}, {queue: false, duration: 500});
		})
		
		$("#footerSlider_next").bind("click",function(){
			first_elem = $("#footer_slider > ul > li").first();
			offset = slider.position();
			if (offset.left <= -(w_container_slide - w_column_slide)){
				 first_elem.appendTo(slider);
				slider.css({
					'left': (offset.left + w_column_slide) + 'px'
				});
			}
			offset = slider.position();
			pos = offset.left - w_column_slide;
			slider.filter(':not(:animated)').stop( true, true ).animate({
				'left': pos + 'px'
			}, 500);
			
		});

		SlideAuto = setInterval(function(){
						$("#footerSlider_next").trigger("click");
					},3000);

		$("#footer_slider").hover(
			function(){
				 clearInterval(SlideAuto);
			},
			function(){
				SlideAuto = setInterval(function(){
						$("#footerSlider_next").trigger("click");
					},3000);
			}
		);
		
	});
}

var mainSlider = function(){
	 $('#slider').nivoSlider();
}

var hSlider = function() {
	$(document).ready(function(){
	
		var SlideAuto = "";
		var slider = $("#h_slider > ul");
		var length_column_slide = $("#h_slider > ul > li").length;
		var h_column_slide= $("#h_slider > ul > li").height();
		var h_container_slide = length_column_slide*h_column_slide;

		var first_elem = "";
		var last_elem = "";
		var offset = ""; 
		var pos = ""; 
		
		function slideDown(){		
			slider.height(h_container_slide);
			first_elem = $("#h_slider > ul > li").last();
			offset = slider.position();
			if (offset.top == 0) {
				first_elem.prependTo(slider);
				slider.css({'top': -(offset.top + h_column_slide) + 'px' });
			}
			offset = slider.position();
			pos = offset.top + h_column_slide;
			slider.filter(':not(:animated)').stop( true, true ).animate({
				'top': pos + 'px'
			}, {queue: false, duration: 500});
		
		}

		setInterval(function(){
			slideDown();
		},3000)
	})
	
}

var subMenu = function(){
		$(".right_submenu > li").bind("mouseenter",function() {
			var index = $(this).index();
			var parent = $(this).parent().parent();
			$(".right_submenu > li",parent).removeClass("current");
			$(".right_submenu > li:eq(" + index + ")",parent).addClass("current");
			$(".left_submenu > li", parent).hide();
			$(".left_submenu > li:eq(" + index + ")", parent).show();
		})

		$("#top_nav > ul > li").bind("mouseenter",function(e) {
			$(".submenu, .submenu2", this).fadeIn("fast");
			$(".right_submenu > li",this).removeClass("current");
			$(".left_submenu > li", this).hide();
			$(".right_submenu > li:first",this).addClass("current");
			$(".left_submenu > li:first",this).show();
		})
		
		$("ul.right_submenu > li > a, .submenu2 > ul > li > a").hover(
			function() {
				$(this).stop( true, true ).animate({ "padding-left": "+=20px" }, "fast" );
			}, 
			function() {
				$(this).stop( true, true ).animate({ "padding-left": "10px" }, "fast" );
			}
		);
		
		$("#top_nav > ul > li").bind("mouseleave",function(e) {
			$(".submenu, .submenu2", this).stop( true, true ).fadeOut("fast");
		});
}

var heightMenuAbout = function(){
	var countInterval = 0;
	var count;
	var interval = setInterval(function() {
		var h_content = $("#info").height();
		$("#info").height(h_content);
		count++;
		if(count == 4) {
			clearInterval(interval);
		}
	}, 500);
}
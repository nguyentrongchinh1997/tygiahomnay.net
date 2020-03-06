$(function(){
	$('.menu-mobile-item').click(function(){
		$(this).children('ul').toggle();
	})
	$('.menu-icon').click(function(){
		$('.menu-mobile-list').css({"left":"0px"})
	})
	$('.menu-mobile-list .exit').click(function(){
		$('.menu-mobile-list').css({"left":"-100%"})
	})
})
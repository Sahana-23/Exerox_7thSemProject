(function($) {
	$(document).ready(function(){

	$(".navscroll").hide();

	$(function (){
		$(window).scroll(function(){

			if($(this).scrollTop()>100){
				$('.navscroll').fadeIn();
				$(' .navscroll').css({"background-color": "black", "font-size": "13px","margin-top":"0","height":"65px"});
			}
			else{
				$('.navscroll').fadeOut();
			}
		});
	});
	

	});
}(jQuery));
// JavaScript Document

// character_animation
$(function(){
	$('.thumb #arrow').click(function(){
		var class_name = $(this).attr("class"); 
		var num = class_name.slice(5);
		$('.main li').hide();
		$('.item' + num).fadeIn();
	});
});

//ハンバーガーメニュー
$(document).ready(function() {
  $(".drawer").drawer();
});



// colorbox_jquery
$(document).ready(function(){
		//Examples of how to assign the ColorBox event to elements
		$(".group1").colorbox({maxWidth:"100%",rel:'group1'});
		$(".group2").colorbox({rel:'group2'});
		$(".group3").colorbox({maxWidth:"100%",rel:'group3'});
		//$(".group3").click();
		$(".group4").colorbox({rel:'group4'});
		$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:360});
		$(".youtube2").colorbox({iframe:true, innerWidth:640, innerHeight:360});
		//$(".youtube2").click();
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#fff", "color":"#000", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	
	




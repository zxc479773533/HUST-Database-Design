// JavaScript Document
 $(function () {
	 
	 $(".banner_btn ul li").hover(function () {
		 $(this).addClass("one").siblings().removeClass("one");
		 index = $(this).index();
		 i = index;
		 $(".banner_pic a").eq(index + 1).stop().fadeIn(500).show().siblings().stop().fadeIn(500).hide();
	 });
	 
	 var i = 0;
	 $(".banner_btn ul li").eq(i).addClass("one").siblings().removeClass("one");
	 $(".banner_pic a").eq(i + 1).stop().fadeIn(500).show().siblings().stop().fadeIn(500).hide();
	 var t = setInterval(autoplay, 3000);
	 
	 function autoplay() {
		 if (i > 2) i = 0;
		 $(".banner_btn ul li").eq(i).addClass("one").siblings().removeClass("one");
		 $(".banner_pic a").eq(i + 1).stop().fadeIn(500).show().siblings().stop().fadeIn(500).hide();
		 i++;
	 }
	 
	 $(".banner").hover(function () {
		 clearInterval(t);
	 }, function () {
		 t = setInterval(autoplay, 3000);
	 });
 });
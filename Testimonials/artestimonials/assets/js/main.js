"use strict";
 ;(function( $ ){
 $(document).ready(function(){
	//var abc = myScript.ajaxurl;
 $(".owl-carousel").owlCarousel({
  loop:true,
 margin:10,
 nav:true,
 navText:  [],
   // autoplay: true,
 items: myScript.columns,
 autoplayTimeout:3500,
 });
 
 $("a.nav-tab").click(function(e){
	 e.preventDefault();
	 alert();
});
 
 }); 
}) ;


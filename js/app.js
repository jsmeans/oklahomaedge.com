jQuery(document).ready(function($) {

	$(document).foundation();
	
	$( ".nav-toggle" ).click(function() {
	  $(this).toggleClass("open");
	  $("nav").fadeToggle(100);

	  return false;
	});

	 $(document).ready(function(){
      $(".footer-button").click(function(){
        $(".footer-slider").slideToggle(500);
        
      });
    });

});


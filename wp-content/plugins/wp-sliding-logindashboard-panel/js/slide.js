jQuery(document).ready(function() {
	
	// Expand Panel
	jQuery(".open").click(function(){
		jQuery("div#panel").slideDown("fast");
			jQuery("#top ul").css("z-index", "1000");
		
	});	
	
	// Collapse Panel
	jQuery(".close").click(function(){
		jQuery("div#panel").slideUp("fast", function(){
			jQuery("#top ul").css("z-index", "6000");
		});
		
	});		
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	jQuery("#toggle a").click(function () {
		jQuery("#toggle a").toggle();
		
	});		
		
});

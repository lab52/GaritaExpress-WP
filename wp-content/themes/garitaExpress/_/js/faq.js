jQuery(function(){
	
	 jQuery("dd.answer")
			.hide();				
	// 	jQuery(".answer-tab")
	// 		.click(function(){
	// 			jQuery(this)
	// 				.parent().parent()
	// 				.find("dd.answer")
	// 				.slideToggle();
	// 				console.log("hello")
	//             return false;
	// 		});
	jQuery('dt').live('click',function(){
				var dd = jQuery(this).next();

				// If the title is clicked and the dd is not currently animated,
				// start an animation with the slideToggle() method.

				if(!dd.is(':animated')){
					dd.slideToggle('fast');
					jQuery(this).toggleClass('opened');
				}

			});

			jQuery('a.button').click(function(){

				// To expand/collapse all of the FAQs simultaneously,
				// just trigger the click event on the DTs

				if(jQuery(this).hasClass('collapse')){
					jQuery('dt.opened').click();
				}
				else jQuery('dt:not(.opened)').click();

				jQuery(this).toggleClass('expand collapse');

				return false;
			});
});

/**
 * Custom Code
 */
jQuery( document ).ready( function( $ ) {
	
	$('.knob').each(function( index, elm ) {
		var max = $(elm).data('maxvalue');
		$(elm).val('0');
		$({value: 0}).delay(1000).animate({value: max}, {
		    duration: 1000,
		    easing:'swing',
		    step: function() {
		    	//console.log(this.value);
		    	$(elm).val( Math.ceil( this.value ) ).trigger('change');
		    }
		})
		
	}).knob({
	 	'min' : 0,
	 	'max' : 1000,
	 	'cursor' : false,
	 	'dynamicDraw': true,
	});
  		 
	handle_register_login();
	
	fix_newsletter_forms();
	
	
	//sticky menu
	/*var nav_container = jQuery(".scrollingNav");
	  var nav = jQuery(".scrollingDiv");
	  nav_container.waypoint({
	    handler: function(event, direction) {
	        nav.toggleClass('sticky', direction==direction);
	        if (direction == 'down')
	        	  nav_container.css({ 'height':nav.outerHeight() });
	        	else
	        	  nav_container.css({ 'height':'auto' });
	    }
	  
	  });*/
	
	
	jQuery.waypoints.settings.scrollThrottle = 30;
	jQuery('.scrollingDiv').waypoint(function(event, direction) { console.log(direction);
		jQuery(this).toggleClass('sticky', direction === "down");
		event.stopPropagation();
	});

	
});




/**
 * This function handles register and login popups.
 */
function handle_register_login(){
	
	
	jQuery('.first_container').click(function(){ console.log('estou aqui detectei coisas');
		jQuery('.courtain').show();
		jQuery('.popup_page').show();
		
	});
	
	jQuery('#go-to-login').click(function(){
		
		
		jQuery('.register_form').hide();
		jQuery('.login_form').show();
		
	});
	
	jQuery('#go-to-register').click(function(){
		
		jQuery('.login_form').hide();
		jQuery('.register_form').show();
		
		
	});
	
	jQuery('.close_popup').click(function(){
		
		jQuery('.courtain').hide();
		jQuery('.popup_page').hide();
	});
	
	
	// top page register or logout link
	jQuery('.register').click(function(){
		
		jQuery('.courtain').show();
		jQuery('.popup_page').show();
		
	});
	
}

/**
 * We are using phplist plugin. In order to keep the plugin as it is
 * we need to add placeholder or change buttons names by jquery
 */
function fix_newsletter_forms(){

	jQuery('.footer-left #contactsubmit').val('newsletter');
	jQuery('.subscribe_home #contactsubmit').val('Subscreva');
	
	
	if(jQuery('.phplist #email').val() == "")
		jQuery('.phplist #email').attr('placeholder','e-mail...');
	
	
	jQuery('.footer-left .phplist #email').focus(function(){   
		if(jQuery('.footer-left .phplist #email').val() == "")
			jQuery('.footer-left .phplist #email').attr('placeholder','e-mail...');
	});
	
}
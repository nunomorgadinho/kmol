/**
 * Custom Code
 */
jQuery( document ).ready( function( $ ) {
	
	var i_twitter = 0;
	var i_facebook = 0;
	var i_rss = 0;
			
	  	var twitter = jQuery('.numbers #twitter').val()*0.1;
  		var facebook = jQuery('.numbers #facebook').val()*0.1;
  		var rss = jQuery('.numbers #rss').val()*0.1;
  			
  		
  		var max = Math.max(twitter,facebook,rss);
  		
  		
  		
  		var myVar=setInterval(function(){myTimer()},10);

  		function myTimer()
  		{
  			jQuery('.twitter').val(i_twitter).trigger('change');
  			jQuery('.facebook').val(i_facebook).trigger('change');
  			jQuery('.rss').val(i_rss).trigger('change');
  			
  			if (i_twitter < twitter)
  				i_twitter++;
  			if (i_facebook < facebook) 
  				i_facebook++;
  			if (i_rss < rss)
  				i_rss++;
  			
  			else
  			{
  				if((i_twitter > twitter && i_twitter > max) && (i_facebook > facebook && i_facebook > max) && (i_rss > rss && i_rss > max) )
  				clearInterval(myVar);
  			}
  		}
	
  		//init knob for social feedback on homepage
  		 jQuery(".knob").knob({
             
         });
  		 
	handle_register_login();
	
	fix_newsletter_forms();
	
});




/**
 * This function handles register and login popups.
 */
function handle_register_login(){
	
	
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
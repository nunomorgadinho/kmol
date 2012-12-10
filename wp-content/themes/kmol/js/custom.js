/**
 * Custom Code
 */
jQuery( document ).ready( function( $ ) {
	
	var i_twitter = 0;
	var i_facebook = 0;
	var i_rss = 0;
	var twitter = 44;
	var facebook = 64;
	var rss = 80;
		
	var myVar=setInterval(function(){myTimer()},10);

	function myTimer()
	{
		$('.twitter').val(i_twitter).trigger('change');
		$('.facebook').val(i_facebook).trigger('change');
		$('.rss').val(i_rss).trigger('change');
		
		if (i_twitter < twitter)
			i_twitter++;
		if (i_facebook < facebook)
			i_facebook++;
		if (i_rss < rss)
			i_rss++;
		else
			clearInterval(myVar);
	}
	

	handle_register_login();
	
});

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
	
}
jQuery(document).ready(function() {

	jQuery('#upload_image_button').click(function() {
		formfield = jQuery('#banner1').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src'); 
		jQuery('#banner1').val(imgurl);
		tb_remove();
	}
	
	
	jQuery('#upload_image_button2').click(function() {
		formfield = jQuery('#banner2').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src'); 
		jQuery('#banner2').val(imgurl);
		tb_remove();
	}

});
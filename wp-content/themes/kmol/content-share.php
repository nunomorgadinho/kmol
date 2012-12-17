<div class="sharing_post alignright">
	
	
	<?php 
		$url = get_permalink();
		if(function_exists('tu_tiny_url')){
			$url = tu_tiny_url(get_permalink($post->ID));
		}
	?>
	
	
	<!-- Email -->
	<?php if(function_exists('instaemail_show_link')){echo instaemail_show_link();} ?>
		<!-- <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_share.png"/> -->
	
	
	<!-- Twitter -->
	<a href="http://twitter.com/home?status=<?php echo the_title();?> <?php echo $url?>" target="_blank" class="t" title="<?php _e('Partilhar no Twitter','kmol');?>">
		<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_share.png"/>
	</a>
	
	<!-- Facebook -->
	<a href="http://facebook.com/share.php?u=<?php echo $url;?>" target="_blank" class="f" title="Partilhar no Facebook">
		<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/facebook_share.png"/>
	</a>

	<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url;?>" class="linkd" count-layout="horizontal">
		<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_share.png"/>
	</a>
	
	
	<!-- Comments section -->
	<a href="#comments"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/comment_share.png"/></a>
</div>



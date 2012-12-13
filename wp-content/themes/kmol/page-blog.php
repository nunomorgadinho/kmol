<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package kmol
 * @since kmol 1.0
 * @Template Name: Blog
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<div class="container_12 aplha">

					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php get_template_part( 'content', 'blog' ); ?>
	
					<?php endwhile; // end of the loop. ?>
					
					<div class="topics">
						<div class="grid_3 omega image_blog">
							<div class="image_blog_title">
								Ana Neves
							</div>
							<div class="blog_share">
								<a href="mailto:ana.neves@knowman.pt"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_blog.png"/></a>
								<a href="<?php echo "http://twitter.com/".get_option('twitter');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_blog.png"/></a>
								<a href="<?php echo "http://pt.linkedin.com/in/".get_option('twitter');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_blog.png"/></a>
							</div>
						</div>
					</div> <!-- .topics -->
					
					<?php get_sidebar();?>
		
		
	        		<div class="grid_9 alpha banner4">
		                <?php 
		        			$img_url = get_option('banner4'); echo $img_url;
		            		if(isset($img_url)  && $img_url!=''){
		        		?>
	    				<img src="<?php echo $img_url;?>" width="700" height="100"/>
						<?php } else {echo "Banner 4//";}?>
            	    </div>

             	   <div class="grid_3 omega banner3">
	               	 <?php 
	        			$img_url = get_option('banner3'); echo $img_url;
	           			 if(isset($img_url) && $img_url!=''){
	       			 ?>
		    				<img src="<?php echo $img_url;?>" width="220" height="100"/>
					<?php } else {echo "Banner 3//";}?>
              	  </div>
				
				
				    <?php get_template_part( 'content', 'markers' ); ?>
        
        
				</div> <!-- .container_12 -->
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	
	<?php get_footer(); ?>
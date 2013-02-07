<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			<div class="container_12 aplha">
			

			<?php if ( have_posts() ) : ?>
			<div class="grid_9 aplha">
				<div class="default_page blog_page">
			

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
				</div>
			</div>
			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>
				
			<?php endif; ?>

			
				<div class="grid_3 omega">
						<?php get_sidebar();?>
					</div>
		
	        		<div class="grid_9 alpha banner4">
		                <?php 
		        			$img_url = get_option('banner4'); echo $img_url;
		            		if(isset($img_url)  && $img_url!=''){
		            			$banner_url = get_option('banner4_url');
		            			if($banner_url)
		            				echo '<a href="'.$banner_url.'" target="_blank">';
		        		?>
	    				<img src="<?php echo $img_url;?>" width="700" height="100"/>
						<?php 
		            			if($banner_url)
		            				echo '</a>';
		            		} else {echo "Banner 4//";}?>
            	    </div>

             	   <div class="grid_3 omega banner3">
	               	 <?php 
	        			$img_url = get_option('banner3'); echo $img_url;
	           			 if(isset($img_url) && $img_url!=''){
	           			 	
	           			 	$banner_url = get_option('banner3_url');
	           			 	if($banner_url)
	           			 		echo '<a href="'.$banner_url.'" target="_blank">';
	           			 	
	       			 ?>
		    				<img src="<?php echo $img_url;?>" width="220" height="100"/>
					<?php
							if($banner_url)
								echo "</a>";
	           			 } else {echo "Banner 3//";}?>
              	  </div>
				
				
				    <?php get_template_part( 'content', 'markers' ); ?>
			
			</div><!-- .container_12 -->
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>
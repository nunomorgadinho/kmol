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
 * @Template Name: Articles
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<div class="container_12">
				<div class="grid_9 alpha">
					<?php while ( have_posts() ) : the_post(); global $cat; $cat = get_option('articles'); ?>
	
						<?php get_template_part( 'content', 'articles' ); ?>
	
					<?php endwhile; // end of the loop. ?>
			
					<div class="grid_9 alpha omega banner4">
			    	<?php 
			        	$img_url = get_option('banner4'); echo $img_url;
			            if(isset($img_url)  && $img_url!=''){
			        ?>
				    		<img src="<?php echo $img_url;?>" width="700" height="100"/>
					<?php } else {echo "Banner 4//";}?>
			    </div>


			</div>
					
				<div class="grid_3 omega">
					<?php get_sidebar(); ?>
		
				<div class="banner3">
			    	<?php 
			        	$img_url = get_option('banner3'); echo $img_url;
			            if(isset($img_url) && $img_url!=''){
			        ?>
				    		<img src="<?php echo $img_url;?>" width="220" height="100"/>
					<?php } else {echo "Banner 3//";}?>
			    </div> <!-- banner 3 -->
		    </div>
			
			
			    <?php get_template_part( 'content', 'markers' ); ?>
		    
		    	</div><!-- .container_12 -->
			</div><!-- .content -->
	
	</div> <!-- #primary -->
		
	<?php get_footer(); ?>
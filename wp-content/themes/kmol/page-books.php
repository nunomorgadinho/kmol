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
 * @Template Name: Books
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'books' ); ?>
					
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

		
		<div class="container_12">
			<!-- Banner -->
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
                

        	<!-- Marcadores -->
       		<?php get_template_part( 'content', 'markers' ); ?>

        </div> <!-- .container_12 -->

	
	<?php get_footer(); ?>
	
    
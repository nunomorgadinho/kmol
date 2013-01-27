<?php
/**
 * The Template for displaying all single posts.
 *
 * @package kmol
 * @since kmol 1.0
 * 
 */

get_header(); global $local; ?>
	<div class="container_12">
		<div class="grid_9 alpha">
		<div id="primary" class="content-area default_page">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php global $post; $local = $post;?>
				<?php // kmol_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php // kmol_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				
					$show_blog_sidebar = false;
					if(in_category(get_option('blog')))
						$show_blog_sidebar = true;
					?>

				
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		</div>
	
		<?php 
		if($show_blog_sidebar) :
		?>	
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
		<?php endif;?>
	
		
	
		
		<div class="grid_3 omega">
		
		
			<?php  global $post; 
			if(has_post_thumbnail($post->ID))
               	 the_post_thumbnail('medium');?>
	
       <?php get_sidebar();?>
       
   		</div>
	
       <div class="grid_3 omega banner3">
	   <?php 
			$img_url = get_option('banner3'); echo $img_url;
			if(isset($img_url) && $img_url!=''){
			?>
				<img src="<?php echo $img_url;?>" width="220" height="100"/>
			<?php } else {echo "Banner 3//";}?>
		</div> <!-- banner 3 -->
		    
		<div class="grid_9 alpha omega banner4">
		<?php 
			$img_url = get_option('banner4'); echo $img_url;
			if(isset($img_url)  && $img_url!=''){
				        ?>
				<img src="<?php echo $img_url;?>" width="700" height="100"/>
		<?php } else {echo "Banner 4//";}?>
		</div> <!-- banner 4 -->

		


        <?php get_template_part( 'content', 'markers' ); ?>


	</div> <!-- .container_12 -->


<?php get_footer(); ?>
<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>

<div class="container_12">
	<div class="grid_12 alpha">
		<div id="primary" class="content-area default_page">


			<section id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
	
				<?php if ( have_posts() ) : ?>
	
					<header class="page-header">
						<h1 class="news_title page-title"><?php printf( __( 'Resultados da Pesquisa por: %s', 'kmol' ), '<span class="search_word">' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->
	
					
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php get_template_part( 'content', 'search' ); ?>
	
					<?php endwhile; ?>
	
				
	
				<?php else : ?>
	
					<?php get_template_part( 'no-results', 'search' ); ?>
	
				<?php endif; ?>
	
				</div><!-- #content .site-content -->
			</section><!-- #primary .content-area -->
		</div>
	</div>
</div>

<div class="container_12">
	<!-- Banner -->
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
	           				echo '</a>';
	           		} else {echo "Banner 3//";}?>
       	</div>           

        <!-- Marcadores -->
         <?php get_template_part( 'content', 'markers' ); ?>

</div>

<?php get_footer(); ?>
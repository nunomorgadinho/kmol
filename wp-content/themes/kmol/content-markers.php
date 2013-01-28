
<div class="grid_12 alpha omega marcadores">
	
	<!-- INTERVIEWS -->
	<?php 
    	$interviews_cat =  get_option('interviews'); 
        
    	$page = get_page_by_title(__('Entrevistas'));
    	
        $args = array(
              		'posts_per_page' => 1,
               		'post_status' => 'publish',
               		'cat' => $interviews_cat
               );
        /* query posts array */
        
        
        $query = new WP_Query( $args  );
        if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
               ?>
		<div class="grid_4 alpha marcador">
			<a href="<?php echo $page->guid;?>"><h1 class="marcador_title"><?php _e('Entrevistas','kmol'); ?></h1></a>
			<div class="marcador_short">
				<div class="marcador_subtitle_container">
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ',''); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div></div>
				 <?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
			</div>
		</div> <!-- .marcador -->
	<?php endwhile; endif;?>
	
	<!-- CASES -->
	<?php 
    	$cat =  get_option('cases'); 
    	$page = get_page_by_title(__('Casos'));
	    $args = array(
	    		'posts_per_page' => 1,
	            'post_status' => 'publish',
	            'cat' => $cat
	            );
              	 	/* query posts array */
        $query = new WP_Query( $args  );
        if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
    ?>
		<div class="grid_4 marcador">
			<a href="<?php echo $page->guid;?>"><h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1></a>
			<div class="marcador_short">
				<div class="marcador_subtitle_container">
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div></div>
				 <?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
			</div>
		</div><!-- .marcador -->
	<?php endwhile; endif;?>
	
	<!-- BOOKS -->
	<?php 
    	$cat =  get_option('books'); 
    	$page = get_page_by_title(__('Livros'));
	    $args = array(
	             'posts_per_page' => 1,
	             'post_status' => 'publish',
	             'cat' => $cat
	             );
         /* query posts array */
          $query = new WP_Query( $args  );
          if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
     ?>
		<div class="grid_4 marcador omega">
			<a href="<?php echo $page->guid;?>"><h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1></a>
			<div class="marcador_short">
				<div class="marcador_subtitle_container">
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div></div>
			 	<?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
			</div>
		</div><!-- .marcador -->
	<?php endwhile; endif;?>
	
</div> <!-- .grid_12 alpha omega marcadores -->
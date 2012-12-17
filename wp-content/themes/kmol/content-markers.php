
<div class="grid_12 alpha omega marcadores">
	
	<!-- INTERVIEWS -->
	<?php 
    	$interviews_cat =  get_option('interviews'); 
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
			<h1 class="marcador_title"><?php _e('Entrevistas','kmol'); ?></h1>
			<div class="marcador_short">
				 <?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore');?></div>
				<span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span>
			</div>
		</div> <!-- .marcador -->
	<?php endwhile; endif;?>
	
	<!-- CASES -->
	<?php 
    	$cat =  get_option('cases'); 
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
			<h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1>
			<div class="marcador_short">
				 <?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore');?></div>
				<span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span>
			</div>
		</div><!-- .marcador -->
	<?php endwhile; endif;?>
	
	<!-- BOOKS -->
	<?php 
    	$cat =  get_option('books'); 
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
			<h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1>
			<div class="marcador_short">
			 	<?php if(has_post_thumbnail()){?> <div class="marcador_img"><?php the_post_thumbnail('thumbnail');?> </div> <?php }?>
				<h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
				<div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore');?></div>
				<span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span>
			</div>
		</div><!-- .marcador -->
	<?php endwhile; endif;?>
	
</div> <!-- .grid_12 alpha omega marcadores -->
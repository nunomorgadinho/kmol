<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>
<div class="container_12">
	<div class="grid_12 alpha">
		<div class="default_page book_page">
			
			
			<!-- TODO unavailable by now -->
			<!-- <select class="filter alignright"  name="filter">
				<option value="Autor"><?php _e('filtrar por autor','kmol'); ?></option>
				<option value="Data" selected><?php _e('filtrar por data','kmol'); ?></option>
			</select> -->
			
			
			<!-- Page Title -->
			<div class="general_title alignleft"><?php the_title(); ?></div>
			<span class="clear"></span>
            
            
            
            <!-- Featured Book -->
            
            <?php 
				//get first post
			
				$cat =  get_option('books');
				$args = array(
						'posts_per_page' => 1,
						'cat' => $cat,
						'post_status' => 'publish',
						'gdsr_sort' => 'rating',
						'nopaging' => 0,
						'gdsr_order' => 'desc'
				);
				/* query posts array */
				$query_first = new WP_Query( $args  );
			
				
				if($query_first->have_posts()): while ($query_first->have_posts()) : $query_first->the_post();
				
					$comments = get_comment_count($post->ID);
			?>
                <div class="book_big_marcador">
	                    <div class="grid_4 alpha">
	                   	 	<?php if(has_post_thumbnail()){?> <div class="marcador_img"> <?php the_post_thumbnail('medium');?></div><?php }?>
	                        <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	                    </div>
	                    <div class="grid_6 omega book_description">
	                       <?php wpe_excerpt('wpe_excerptlength_teaser', 'new_excerpt_more');?>
	                     
	                    </div>
	                    <span class="clear"></span>
	
	              		<!-- TAGS -->
	                    <div class="grid_7 alpha tag_marcador">
		                    <?php 
		                 	   $tag_list = get_the_tag_list( '', ' ' );
		                 	   printf($tag_list);
		                    ?>
		                    </div>
	
						<!-- COMENTS -->
	                    <div class="grid_3 omega">
	                        <h1 class="alignright comments"><a href="<?php the_permalink();?>"><?php echo $comments['approved'];  _e(' Comentários','kmol');?></a></h1>
	                    </div>
	
	            </div><!-- book_big_marcador -->
			<?php endwhile; endif; ?>
            <span class="clear"></span>

            
            
            
            <!-- 4 MORE BOOKS -->
            <?php 
			//get remaining post
		
			$cat =  get_option('books');
			
			$args = array(
					'posts_per_page' =>5,
					'cat' => $cat,
					'post_status' => 'publish',
					'gdsr_sort' => 'rating',
					'nopaging' => 0,
					'gdsr_order' => 'desc',
					'paged' =>	(get_query_var('paged')) ? get_query_var('paged') : 1
					
			);
			/* query posts array */
			$query = new WP_Query( $args  );
		
			$i=1;
			if($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
				<?php 
				$comments = get_comment_count($post->ID);
				if($i==1) {$i++; continue;}
				?>
				
				
				<div class="marcador_container book_row <?php if ($i % 2 != 0) echo "last";?>">
                        <div class="book_small_marcador">
                      	  	
                      	  	<?php if(has_post_thumbnail()) {?> 
					 			<div class="marcador_img"><?php the_post_thumbnail('thumbnail');?></div>
					 		<?php }?>
                            
                                <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            
                                <div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_index', 'new_excerpt_more');?></div>
                           
	                            <span class="clear"></span>
	                                <div class="tag_marcador">
	                                	<?php 
		                 	 			  $tag_list = get_the_tag_list( '', ' ' );
		                 				  printf($tag_list);
		                    			?>
	                                </div>
	                            <span class="clear"></span>
	                            
                            <h1 class="alignright comments"><a href="<?php the_permalink();?>"><?php echo $comments['approved'];  _e(' Comentários','kmol');?></a></h1>
                        </div>
                    </div>
				
			<?php 
				$i++;
			endwhile;
			endif;
		 
		?>
            
       
                <span class="clear"></span>
                
                <div class="more_single">
	                <?php next_posts_link(__('Livros mais antigos ','kmol'),$query->max_num_pages); ?>
						<div class="alignright">
						<?php previous_posts_link(__('Livros mais recentes ','kmol')); ?>
					</div>
                </div>

                <span class="clear"></span>

            <div class="recommend_title">
                Recomendações do KMOL
            </div>

<div class="book_row">
                    <div class="marcador_container">
                        <div class="book_small_marcador">
                                <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                                <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                                <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                            <span class="clear"></span>
                                <div class="tag_marcador">
                                <p><a href="/">gestão_de_conhecimento</a></p>
                                <p><a href="/">ferramentas_sociais</a></p>
                                <p><a href="/">tecnologia web2.0</a></p>
                                </div>
                            <span class="clear"></span>
                            <h1 class="alignright comments"><a href="#">18 Comentários</a></h1>
                        </div>
                    </div>
                        <div class="marcador_container last">
                        <div class="book_small_marcador">
                                <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                                <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                                <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                            <span class="clear"></span>
                                <div class="tag_marcador">
                                <p><a href="/">gestão_de_conhecimento</a></p>
                                <p><a href="/">ferramentas_sociais</a></p>
                                <p><a href="/">tecnologia web2.0</a></p>
                                </div>
                            <span class="clear"></span>
                            <h1 class="alignright comments"><a href="#">18 Comentários</a></h1>
                        </div>
                        </div>
                </div>

                 <span class="clear"></span>
                <div class=" more_single alignright">
                        <a href="#"><?php _e ('Recomendaçõs mais antigas','kmol'); ?></a>  
                </div>



              
    	</div><!-- .default_page book_page -->

	</div><!-- grid_12 alpha -->

</div><!-- .container_12 -->
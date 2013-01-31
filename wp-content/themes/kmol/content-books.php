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
			$paged = get_query_var('paged');
			$per_page = 5;
			if($paged>0)
				$per_page = 6;
			$args = array(
					'posts_per_page' =>$per_page,
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
				if($i==1 && $paged==0) {?>
						<div class="book_big_marcador">
		                    <div class="grid_4 alpha">
		                   	 	<?php if(has_post_thumbnail()){?> <div class="marcador_img"> <?php the_post_thumbnail('medium');?></div><?php }?>
		                        <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

		                    <div class="book_moretag">
							<?php
								if(get_post_meta($post->ID,'bookauthor',true))
									echo '<span class="black">'; echo '</span>'.c2c_get_custom('bookauthor', '', '', '', ', ', ' e '); echo ". ";
								if(get_post_meta($post->ID,'bookref',true))
									echo '<span class="black">';  echo '</span>'.get_post_meta($post->ID,'bookref',true); echo ", ";
								if(get_post_meta($post->ID,'bookyear',true))
									echo '<span class="black">'; echo '</span>'.get_post_meta($post->ID,'bookyear',true);
								
							?>
							</div><!-- .book_moretag-->
		                    
		                    
		                        
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
					<span class="clear"></span>
				<?php
					$i++;
				} else{
					
					if($paged > 0){
						if($i % 2 != 0)
							$side = "";
						else
							$side = "last";
					}
					else{
						if($i % 2 != 0)
							$side = "last";
						else
							$side = "";
					}
				?>
				
				<div class="marcador_container book_row <?php echo $side;?>">
                        <div class="book_small_marcador">
                      	  	
                      	  	<?php if(has_post_thumbnail()) {?> 
					 			<div class="marcador_img"><?php the_post_thumbnail('thumbnail');?></div>
					 		<?php }?>
                            
                                <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            		<div class="book_moretag">
									<?php
										if(get_post_meta($post->ID,'bookauthor',true))
											echo '<span class="black">'; echo '</span>'.c2c_get_custom('bookauthor', '', '', '', ', ', ' e '); echo ". ";
										if(get_post_meta($post->ID,'bookref',true))
											echo '<span class="black">';  echo '</span>'.get_post_meta($post->ID,'bookref',true); echo ", ";
										if(get_post_meta($post->ID,'bookyear',true))
											echo '<span class="black">'; echo '</span>'.get_post_meta($post->ID,'bookyear',true);
									?>
									</div><!-- .book_moretag-->
                            	
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
				}
			endwhile;
			endif;
		 
		?>
            
       
                <span class="clear"></span>
                
                <div class="more_single">
                	<span class="left_mark">
	                <?php next_posts_link(__('Livros mais antigos ','kmol'),$query->max_num_pages); ?>
	                </span>
						<div class="alignright right_mark">
						<?php previous_posts_link(__('Livros mais recentes ','kmol')); ?>
					</div>
                </div>

                <span class="clear"></span>

               <!-- WE RECOMMEND -->
            <div class="recommend_title">
                <?php _e('Algumas Recomendações KMOL','kmol');?>
            </div>

            <div class="book_row">
             <?php 
				//get first post
			
				$cat =  get_option('books');
				$category = get_category($cat);
				$args = array(
						'posts_per_page' => $per_page,
						'cat' => $cat,
						'post_status' => 'publish',
						'gdsr_sort' => 'rating',
						'nopaging' => 0,
						'orderby' => 'rand',
						'gdsr_order' => 'desc'
				);
				/* query posts array */
				$query_first = new WP_Query( $args  );
			
				$i =1;
				if($query_first->have_posts()): while ($query_first->have_posts()) : $query_first->the_post();
				
				$rec = get_post_meta($post->ID, "recommended", false);
				echo "<!-- recommended = ".$rec[0]." -->";
				if ($rec[0]) { 
					$comments = get_comment_count($post->ID);
			?>
			
                    <div class="marcador_container_recommend <?php if ($i % 2 != 0) echo "last";?>">
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
				}
                	$i++; 
                	endwhile; endif;?>
                 </div> <!-- book_row recomend -->
                 
             <!--    <div class="more_single">
                	<span class="alignright right_mark">
	                	<a href="<?php echo get_bloginfo('siteurl')?>/category/<?php echo $category->category_nicename; ?>"><?php _e('Outras Recomendações','kmol');?></a>	   
	                </span>
                </div> -->

                 <span class="clear"></span>
                


              
    	</div><!-- .default_page book_page -->

	</div><!-- grid_12 alpha -->

</div><!-- .container_12 -->
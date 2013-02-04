<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

<div class="grid_9 alpha">
	<div class="default_page blog_page">
		
		<!-- TODO unavailable by now -->
			<!-- <select class="filter alignright"  name="filter">
				<option value="Autor"><?php _e ('filtrar por autor','kmol'); ?></option>
				<option value="Data" selected><?php _e ('filtrar por data','kmol'); ?></option>
			</select>
			 -->
			
			<div class="general_title alignleft"><?php the_title(); ?></div>
				
			<div id="container_blog">
			
				<?php 
				//get remaining post
			
				
				$cat = get_option('blog');
				
				$args = array(
						'posts_per_page' =>4,
						'cat' => $cat,
						'post_status' => 'publish',
						'gdsr_sort' => 'rating',
						'nopaging' => 0,
						'gdsr_order' => 'desc',
						'paged' =>	(get_query_var('paged')) ? get_query_var('paged') : 1
						
				);
				/* query posts array */
				$query = new WP_Query( $args  );
			
				
				if($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
				
			
				
				  <div class="sublayer grid_8 alpha sublayer_single">
					  <?php if(has_post_thumbnail()) :?><div class="image_sublayer"><?php the_post_thumbnail('thumbnail');?></div> <?php endif;?>
	                    <div class="sublayer_title">
	                    	<a href="<?php the_permalink();?>"><?php the_title();?></a>
	                    	<span class="news_meta">
							<?php kmol_posted_on(); ?>
							</span><!-- .entry-meta -->
	                    </div>
	                   
						

									<div class="tag_marcador alignleft"><?php /* translators: used between list items, there is a space after the comma */
									$tag_list = get_the_tag_list( '', ' ' );
									printf($tag_list);
									?></div>

						
						
						
						<span class="clear"></span>

	                    <div class="news_excerpt excerpt_single">
	                    	<?php wpe_excerpt('wpe_excerptlength_teaser');?>
	                    </div> 
	                    
	                    <?php if(get_comments_number() > 0){ $comments = get_comment_count($post->ID);?>
                      <h1 class="alignright comments"><a href="<?php the_permalink();?>/#comments"><?php echo $comments['approved'];  _e(' Comentários','kmol');?></a></h1>
	                    		
						<?php }?>
	              </div>
                         <?php endwhile; endif; ?>
                
			</div> <!-- container_blog -->
                

			<div class="grid_8 alpha more_single">
				<span class="left_mark">
					<?php next_posts_link(__('Artigos mais antigos ','kmol'),$query->max_num_pages); ?>
				</span>
				<div class="alignright right_mark">
					<?php previous_posts_link(__('Artigos mais recentes ','kmol')); ?>
				</div>  
			</div> <!-- grid_8 nav -->

	</div> <!-- default_page -->
</div> <!-- grid_9 -->

	

		




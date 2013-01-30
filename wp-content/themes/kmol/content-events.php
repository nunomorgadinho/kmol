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
		
			<div class="general_title alignleft"><?php the_title(); ?></div>
				
			<div id="container_blog">
			
				<?php 
				//get remaining post
			
				
				$cat = get_option('events');
				
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
				
			
				
				  <div id="<?php the_ID();?>" class="sublayer grid_8 alpha sublayer_single">
					  <?php if(has_post_thumbnail()) :?><div class="image_sublayer"><?php the_post_thumbnail('thumbnail');?></div> <?php endif;?>
	                    <div class="sublayer_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
	                
	                   <div class="news_meta">
							<div class="tag_marcador alignleft"><?php /* translators: used between list items, there is a space after the comma */
								$tag_list = get_the_tag_list( '', ' ' );
								printf($tag_list);
						?></div>
						</div><!-- .entry-meta -->
						
						
						<ul class="event-meta">
						<?php 
						
							//get Tipo
							$value = get_post_meta($post->ID,'event_type',true);
							if(isset($value) && $value != '')
							{
								echo '<li class="event-detail">';
								echo '<span class="event-subtitle">'; _e('Tipo de Evento: ','kmol'); echo '</span>';
								echo '<span class="event-value">'.$value.'</span>';
								echo '</li>';
							}
						
							// get price
							$value = get_post_meta($post->ID,'event_free',true);
							if(isset($value) && $value == 1)
							{
								$value = __('Grátis','kmol');
								
								echo '<li class="event-detail">';
								echo '<span class="event-value">'.$value.'</span>';
								echo '</li>';
								
							}
							
							//get date
							$value = get_post_meta($post->ID,'event_dates',true);
							if(isset($value) && $value != '')
							{
								echo '<li class="event-detail">';
								echo '<span class="event-subtitle">'; _e('Datas: ','kmol'); echo '</span>';
								echo '<span class="event-value">'.$value.'</span>';
								echo '</li>';
							}
							
							//get local
							$value = get_post_meta($post->ID,'event_city',true);
							if(isset($value) && $value != '')
							{
								$country = get_post_meta($post->ID,'event_country',true);
								if(isset($country))
									$value = $value.', '.$country;
							
								echo '<li class="event-detail">';
								echo '<span class="event-subtitle">'; _e('Local: ','kmol'); echo '</span>';
								echo '<span class="event-value">'.$value.'</span>';
								echo '</li>';
							}
							
						?>	
						 
						</ul>
						
						
						<span class="clear"></span>

	                    <div class="news_excerpt excerpt_single">
	                    	<?php the_content();?>
	                    </div> 
	                    
	                   <?php 
							$url = get_post_meta($post->ID,'event_url',true);
	                   		if(isset($url) && $url !='') {?>
	                   			<div class="more_single">
	                   				<a class=" alignright button" href="<?php echo get_post_meta($post->ID,'event_url',true); ?>" target="_blank"><?php _e('Saber mais sobre este evento','kmol');?></a>
	                 			</div>
	                 	<?php }?>
	                   
	              </div>
                         <?php endwhile; endif; ?>
                
			</div> <!-- container_blog -->
                

			<div class="grid_8 alpha more_single">
				<span class="left_mark">
					<?php next_posts_link(__('Eventos anteriores ','kmol'),$query->max_num_pages); ?>
				</span>
				<div class="alignright right_mark">
					<?php previous_posts_link(__('Eventos mais recentes ','kmol')); ?>
				</div>  
			</div> <!-- grid_8 nav -->

	</div> <!-- default_page -->
</div> <!-- grid_9 -->

	

		




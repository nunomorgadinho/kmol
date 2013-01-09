<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

	<div class="grid_9 alpha">
		<div class="default_page">
		OLA
			<!-- TODO unavailable by now -->
			<!-- 	<select class="filter alignright"  name="filter">
					<option value="Autor"><?php _e('filtrar por autor','kmol'); ?></option>
					<option value="Data" selected><?php _e('filtrar por data','kmol'); ?></option>
				</select> -->
			
			<div class="general_title alignleft"><?php the_title(); ?></div>

			<?php 
			//get remaining post
		
			
			global $cat;
			
			$args = array(
					'posts_per_page' =>7,
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

				<?php if($i==1) {?>
					
					
					<div class="news_title title_single"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
					<?php if(has_post_thumbnail()){?> <div class="image_principal image_single"> <?php the_post_thumbnail('medium');?></div><?php }?>
			        <div class="news_excerpt excerpt_single"><?php the_excerpt();?></div>
			       	<div class="news_meta meta_single"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?><span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span></div>
			        <span class="clear"></span>
					
					
					
				<div class="grid_8 alpha">		
				<?php $i++; }
					else{
				?>
					 <div class="sublayer grid_4 <?php if ($i % 2 == 0) echo "alpha"; else echo "omega";?> sublayer_single">
					 	<?php if(has_post_thumbnail()) {?> 
					 		<div class="image_sublayer"><?php the_post_thumbnail('thumbnail');?></div>
					 	<?php }?>
			         	<div class="sublayer_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
			             <div class="sublayer_meta news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
			                <a class="moretag" href="<?php get_permalink($post->ID) ?>"><?php _e('Ler artigo completo &rarr;','kmol')?></a>
			         </div>
				
			<?php 
				$i++;}
			endwhile;
			endif;
		 
		?>
		   </div>  <!-- grid_8 alpha -->    

		    <!-- Previous and Next articles -->
			<div class="grid_8 alpha more_single">
			<span class="left_mark">
				<?php next_posts_link(__('Artigos mais antigos ','kmol'),$query->max_num_pages); ?>
			</span>
			<div class="alignright right_mark">
				<?php previous_posts_link(__('Artigos mais recentes ','kmol')); ?>
			</div>
				     
			</div>

			
		</div><!-- default_page -->
	</div> <!-- grid_9 -->

	



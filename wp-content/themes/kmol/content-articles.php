<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

<!-- 	<div class="grid_9 alpha">  -->
		<div class="default_page">
			<!-- TODO unavailable by now -->
			<!-- 	<select class="filter alignright"  name="filter">
					<option value="Autor"><?php _e('filtrar por autor','kmol'); ?></option>
					<option value="Data" selected><?php _e('filtrar por data','kmol'); ?></option>
				</select> -->
			
			<div class="general_title alignleft"><?php the_title(); ?></div>

			<?php 
			//get remaining post
			global $cat;
			$paged = get_query_var('paged'); 
			$per_page = 7;
			if($paged>0)
				$per_page = 8;
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

			<?php if($i==1 && $paged==0) {?>
					
					
					<div class="news_title title_single"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
					<?php if(has_post_thumbnail()){?> <div class="image_principal image_single"> <?php the_post_thumbnail('medium');?></div><?php }?>
			        <div class="news_excerpt excerpt_single"><?php the_excerpt();?></div>
			       	<div class="news_meta meta_single"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div>
			        <span class="clear"></span>
					
					
					
				<div class="grid_8 alpha">		
				<?php $i++; }
					else{
						
						if($paged > 0 && $i == 1){
							echo '<div class="grid_8 alpha">';
							
						}
						
						
						if($paged > 0){
							if($i % 2 == 0)
								$side = "omega";
							else
								$side = "alpha";
						}
						else{
							if($i % 2 == 0)
								$side = "alpha";
							else
								$side = "omega";	
						}
						
						
						
						
						
				?>
					 <div class="sublayer grid_4 <?php echo $side;?> sublayer_single">
					 	<?php if(has_post_thumbnail()) {?> 
					 		<div class="image_sublayer"><?php the_post_thumbnail('thumbnail');?></div>
					 	<?php }?>
			         	<div class="sublayer_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
			             <div class="sublayer_meta news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div>
			                <a class="moretag" href="<?php get_permalink($post->ID) ?>"><?php _e('Ler artigo &rarr;','kmol')?></a>
			         </div>
				
			<?php 
				$i++;}
			endwhile;
			endif;
		 
		?>
		<?php if($query->have_posts()):?>
			   </div>  <!-- grid_8 alpha -->    
		<?php endif;?>
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
		
		
<!-- 	</div> -->  <!-- grid_9 -->

	



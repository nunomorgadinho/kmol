<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

<div class="container_12">
	<div class="grid_9 alpha">
		<div class="default_page">
		
		<!-- unavailable by now -->
	<!-- 	<select class="filter alignright"  name="filter">
				<option value="Autor"><?php _e('filtrar por autor','kmol'); ?></option>
				<option value="Data" selected><?php _e('filtrar por data','kmol'); ?></option>
			</select> -->
			
		<div class="general_title alignleft"><?php the_title(); ?></div>

<?php 
	//get first post

	$cat =  get_option('articles');
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
?>
		<div class="news_title title_single"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
			<?php if(has_post_thumbnail()){?> <div class="image_principal image_single"> <?php the_post_thumbnail('medium');?></div><?php }?>
            <div class="news_excerpt excerpt_single"><?php the_excerpt();?></div>
            <div class="news_meta meta_single"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?><span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span></div>
            <span class="clear"></span>
<?php
	endwhile;
	endif;
?>

	<div class="grid_8 alpha">
	<?php 
	//get remaining post

	$cat =  get_option('articles');
	
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
		<?php if($i==1) {$i++; continue;}?>
			 <div class="sublayer grid_4 <?php if ($i % 2 == 0) echo "alpha"; else echo "omega";?> sublayer_single">
			 	<?php if(has_post_thumbnail()) {?> 
			 		<div class="image_sublayer"><?php the_post_thumbnail('thumbnail');?></div>
			 	<?php }?>
	         	<div class="sublayer_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
	             <div class="sublayer_meta news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
	                 <span class="readmore_single"><a href="<?php the_permalink();?>"><?php _e ('Ler Mais...','kmol'); ?></a></span>
	         </div>
		
	<?php 
		$i++;
	endwhile;
	endif;
 
?>

    </div>  <!-- grid_8 alpha -->    

    
	<div class="grid_8 alpha more_single">
	
	<?php next_posts_link(__('Artigos mais antigos ','kmol'),$query->max_num_pages); ?>
	<div class="alignright">
	<?php previous_posts_link(__('Artigos mais recentes ','kmol')); ?>
	</div>
		     
	</div>

			
		</div><!-- default_page -->
	</div> <!-- grid_9 -->

	<div class="topics">
		<div class="grid_3 omega">
			<div class="marcador_title">
				<?php _e ('Tópicos mais usados','kmol'); ?>
			</div>
			<div class="sidebar_description">
				<p><a href="/">gestão_de_conhecimento</a></p>
				<p><a href="/">ferramentas_sociais</a></p>
				<p><a href="/">tecnologia web2.0</a></p>
				<p><a href="/">cultura_organizacional</a></p>
				<p><a href="/">Brasil caso</a></p>
				<p><a href="/">actores_do_conhecimento</a></p>
			</div>
		</div>

		<div class="grid_3 omega">
			<div class="marcador_title">
				<?php _e ('Últimos comentários','kmol'); ?>
			</div>
			<div class="sidebar_description">
				<p><a href="/">gestão_de_conhecimento</a></p>
				<p><a href="/">ferramentas_sociais</a></p>
				<p><a href="/">tecnologia web2.0</a></p>
				<p><a href="/">cultura_organizacional</a></p>
				<p><a href="/">Brasil caso</a></p>
				<p><a href="/">actores_do_conhecimento</a></p>
			</div>
		</div>
	</div> <!-- .topics -->

		<div class="grid_3 omega banner3">
			Banner3 //
		</div>
		<div class="grid_3 omega banner3">
			Banner3 //
		</div>

		<div class="grid_9 alpha omega banner4">
                Banner4 //
        </div>


        <div class="grid_12 alpha omega marcadores">
                <div class="grid_4 alpha marcador">
                    <h1 class="marcador_title"><?php _e ('Entrevistas','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador">
                    <h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador omega">
                    <h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
        </div>

</div> <!-- container_12 -->
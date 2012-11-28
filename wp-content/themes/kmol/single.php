8<?php
/**
 * The Template for displaying all single posts.
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>
	<div class="container_12">
		<div class="grid_9 alpha">
		<div id="primary" class="content-area default_page">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php kmol_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php kmol_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		</div>
	
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
	</div>

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


	</div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>
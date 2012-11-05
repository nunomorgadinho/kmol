<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>
<div class="container_12">
		<div class="grid_12 alpha">
		<div id="primary" class="content-area default_page">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
	</div>

						<div class="grid_9 alpha banner4">
                        Banner4 //
                        </div>

                        <div class="grid_3 omega banner3">
                        Banner 3//
                        </div>


        <div class="grid_12 alpha omega marcadores">
                <div class="grid_4 alpha marcador">
                    <h1 class="marcador_title">Entrevistas</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador">
                    <h1 class="marcador_title">Casos</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador omega">
                    <h1 class="marcador_title">Livros</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
        </div>


</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
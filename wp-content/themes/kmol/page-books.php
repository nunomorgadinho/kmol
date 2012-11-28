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
 * @Template Name: Books
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'books' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<div class="container_12">
		<!-- Banner -->
                        <div class="grid_9 alpha banner4">
                        Banner4 //
                        </div>

                        <div class="grid_3 omega banner3">
                        Banner 3//
                        </div>

        <!-- Marcadores -->
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
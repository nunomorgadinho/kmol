<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>

<div class="container_12">
		<div class="grid_12 alpha">
		<div id="primary" class="content-area default_page">


		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="news_title page-title"><?php printf( __( 'Search Results for: %s', 'kmol' ), '<span class="search_word">' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php //kmol_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php //kmol_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->
</div>
</div>
</div>

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
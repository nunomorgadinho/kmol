<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>

	<div class="container_12">
	<div class="grid_12 alpha">
		<div id="primary" class="content-area default_page">
			<div id="content" class="site-content" role="main">



			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title news_title"><?php _e( 'Página não encontrada.', 'kmol' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Esta página não existe. Tente pesquisar pelo seu assunto de interesse.', 'kmol' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
</div>
</div>
<?php get_footer(); ?>
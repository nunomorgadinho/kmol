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
					<h1 class="entry-title news_title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'kmol' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try the search field?', 'kmol' ); ?></p>

					<?php get_search_form(); ?>

					<?php //the_widget( 'WP_Widget_Recent_Posts' ); ?>

			 		<div class="widget">
						<h2 class="widgettitle"><?php // _e( 'Most Used Categories', 'kmol' ); ?></h2>
						<ul>
						<?php // wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div><!-- .widget --> 

					<?php
					/* translators: %1$s: smilie */
					//$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'kmol' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php // the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
</div>
</div>
<?php get_footer(); ?>
<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title news_title title_single alignleft"><a href="#"><?php the_title(); ?></a></h1>
		<div class="general_title alignright">Subtítulo</div>

	</header><!-- .entry-header -->
<span class="clear"></span>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kmol' ), 'after' => '</div>' ) ); ?>
		<?php //edit_post_link( __( 'Edit', 'kmol' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->


                

</article><!-- #post-<?php the_ID(); ?> -->

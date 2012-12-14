<?php
/**
 * @package kmol
 * @since kmol 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title alignleft"><a class="news_title" href="#"><?php the_title(); ?></a></h1>
		

		<div class="entry-meta news_meta">
			<?php kmol_posted_on(); ?></div><!-- .entry-meta -->
			<span class="clear"></span>

			<div class="tag_marcador alignleft"><?php /* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! kmol_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'kmol' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'kmol' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'kmol' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'kmol' );
				}

			} // end check for categories on this blog

			printf(
				//$meta_text,
				//$category_list,
				$tag_list
				//get_permalink(),
				//the_title_attribute( 'echo=0' )
			);
		?></div>
		
		<div class="sharing_post alignright">
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/facebook_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/comment_share.png"/>
		</div>
	</header><!-- .entry-header -->

	<span class="clear"></span>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kmol' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">


		<!-- <?php edit_post_link( __( 'Edit', 'kmol' ), '<span class="edit-link">', '</span>' ); ?> -->

	<div class="sharing_post alignright">
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/facebook_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_share.png"/>
			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/comment_share.png"/>
		</div>

<span class="clear"></span>
		<div class="author_container">

			<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/ivo_granja.png"/>
			<div class="author_title">Ivo Granja</div>
			<div class="author_description">Licenciado em Economia, a concluir o Mestrado em Inteligência Competitiva; 
				LinkedIn: http://pt.linkedin.com/in/ivogranja</div>
				<div class="autor_tags tag_marcador">
						<a href="/">gestão_de_conhecimento</a>
                        <a href="/">ferramentas_sociais</a>
                        <a href="/">tecnologia web2.0</a>
                        <a href="/">cultura_organizacional</a>
				</div>

		</div>

	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

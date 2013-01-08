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
				$tag_list = get_the_tag_list( '', ' ' );
				printf($tag_list);
		?></div>
		
		<?php get_template_part( 'content', 'share' ); ?>
		
	</header><!-- .entry-header -->

	<span class="clear"></span>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kmol' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">


		<!-- <?php edit_post_link( __( 'Edit', 'kmol' ), '<span class="edit-link">', '</span>' ); ?> -->

		<?php get_template_part( 'content', 'share' ); ?>

<span class="clear"></span>
		<div class="author_container">
		
			<?php 
			if(function_exists('get_cimyFieldValue')){
				$value = get_cimyFieldValue(get_the_author_meta('ID'), 'PHOTO-URL');
				echo '<img src="'.get_bloginfo('siteurl').$value.'"/>';
			}
			?>
			<div class="author_title"><?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name');?></div>
			<div class="author_description">
				<?php echo get_the_author_meta('description');?>
				
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'Ver todos os artigos de %s <span class="meta-nav">&rarr;</span>', 'kmol' ), get_the_author_meta('first_name').' '.get_the_author_meta('last_name') ); ?>
					</a>
				</div><!-- #author-link	-->
				
			</div> <!-- .author_description -->
				<div class="autor_tags tag_marcador">
					<?php 
					if(function_exists('get_cimyFieldValue')){
					
						$value = get_cimyFieldValue(get_the_author_meta('ID'), 'AREAS');
						$avalue = explode(',',$value);
						foreach ($avalue as $area)
						{
							echo '<span>'.$area.'</span>';
						}
					}
					?>
						
				</div>

		</div> <!-- author_container -->

	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

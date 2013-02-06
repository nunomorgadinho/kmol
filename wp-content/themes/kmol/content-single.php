<?php
/**
 * @package kmol
 * @since kmol 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
	<!-- <div class="book-image">   -->
	<?php  
		$cat=  get_option('books');
	/*	if(has_category($cat) && has_post_thumbnail())
               	 	the_post_thumbnail('medium');*/
     ?>
	<!--  </div> -->
	
	
	<header class="entry-header">
	
	<div class="entry-thumb">
		<?php  global $post; 
			if(has_post_thumbnail($post->ID))
               	 the_post_thumbnail('medium');?>
	</div>
		<div class="entry-title news_title"><?php  the_title(); ?><span class="entry-meta news_meta">
			<?php
				
				if(has_category($cat) && !empty($cat)){
					
					if(get_post_meta($post->ID,'bookauthor',true))
						echo '<br/><span class="black">'; echo '</span>'.c2c_get_custom('bookauthor', '', '', '', ', ', ' e '); echo ". ";
					if(get_post_meta($post->ID,'bookref',true))
						echo '<span class="black">';  echo '</span>'.get_post_meta($post->ID,'bookref',true); echo ", ";
					if(get_post_meta($post->ID,'bookyear',true))
						echo '<span class="black">'; echo '</span>'.get_post_meta($post->ID,'bookyear',true);
					echo "<br/>";
					kmol_review_posted_on();
				}
				else{
					kmol_posted_on(); 
				}
			?>
		</span><!-- .entry-meta --></div>
		
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
				
				if(!is_array($value))
					echo '<img src="'.$value.'"/>';
			}
			?>
			<div class="author_title"><?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name');?></div>
			<div class="author_description">
				<?php echo get_the_author_meta('description');?>
				
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>" rel="author">
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

<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmol
 * @since kmol 1.0
 */

get_header(); ?>


<?php 

	$author_has_comments = false;
	if(is_author())
	{
		$author =  get_query_var('author_name');
		echo "author_name = ".$author;
		
		$uid=  get_user_by('slug', $author); 
		echo "uid = ".$uid;
		
		$user_id =  $uid->ID;
				
		global $wpdb;
					
		$myrows = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "comments
					WHERE user_id =  %s AND comment_approved = 1 ORDER BY comment_ID DESC
					", $user_id));
		
		if(count($myrows) >0) $author_has_comments = true;
	}
?>

	<section id="primary" class="content-area ">
		<div id="content" class="site-content" role="main">
			<div class="container_12">
				<div class="grid_9 alpha">
				<div class="default_page ">
				<?php if ( have_posts() ) :  ?>
	
					<header class="page-header">
						<h1 class="page-title">
							<?php
								if ( is_category() ) {
									printf( __( 'Arquivos da Categoria: %s', 'kmol' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	
								} elseif ( is_tag() ) {
									printf( __( 'Artigos com Tag: %s', 'kmol' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	
								} elseif ( is_author() ) {
									/* Queue the first post, that way we know
									 * what author we're dealing with (if that is the case).
									*/
									the_post();
									
								
									
									printf( __( 'Arquivos do autor: %s', 'kmol' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
									/* Since we called the_post() above, we need to
									 * rewind the loop back to the beginning that way
									 * we can run the loop properly, in full.
									 */
									rewind_posts();
	
								
								
								} elseif ( is_day() ) {
									printf( __( 'Arquivos Diários: %s', 'kmol' ), '<span>' . get_the_date() . '</span>' );
	
								} elseif ( is_month() ) {
									printf( __( 'Arquivos Mensais: %s', 'kmol' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
	
								} elseif ( is_year() ) {
									printf( __( 'Arquivos Anuais: %s', 'kmol' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
	
								} else {
									_e( 'Arquivos', 'kmol' );
	
								}
							?>
						</h1>
						<?php
							if ( is_category() ) {
								// show an optional category description
								$category_description = category_description();
								if ( ! empty( $category_description ) )
									echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
	
							} elseif ( is_tag() ) {
								// show an optional tag description
								$tag_description = tag_description();
								if ( ! empty( $tag_description ) )
									echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
							}
						?>
					</header><!-- .page-header -->
	
					<div class="grid_8 alpha more_single">
					<?php kmol_content_nav( 'nav-above' ); ?>
					</div>
	
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>
	
					<?php endwhile; ?>
				<div class="grid_8 alpha more_single">
					<?php kmol_content_nav( 'nav-below' ); ?>
				</div>
				
				
				<?php else : 
				
					if($author_has_comments)
					{
				?>		
						<header class="page-header">
							<h1 class="page-title">
							<?php printf( __( 'Contribuições do utilizador: %s', 'kmol' ), '<span class="vcard">'.$uid->user_nicename.'</span>' );
					?>
						</h1>
						</header>
					<?php 	
					}			
					else
						 get_template_part( 'no-results', 'archive' );
				?>
	
				<?php endif; ?>
				
				<?php
				if($author_has_comments) 
				{
				?>
					
					<?php foreach ($myrows as $comment): //print_r($comment);
							?>
							
					<div id="container_blog">		
						 <div class="sublayer grid_8 alpha sublayer_single author_comments">
	
				
						<div class="news_excerpt excerpt_single">
						<img src="<?php echo get_bloginfo('stylesheet_directory').'/images/quote.png'?>" width="50" height="28"/>
		                    	<?php echo $comment->comment_content;?> 
		                    	<a class="moretag" href="<?php echo get_bloginfo('url') ."/?p=".$comment->comment_post_ID;?>"><?php _e('... ler artigo &rarr;','kmol')?></a>
		                </div>
	
					     <div class="">em <a href="<?php echo get_bloginfo('url') ."/?p=".$comment->comment_post_ID;?>"><?php echo  get_post_field('post_title', $comment->comment_post_ID);?></a></div>
	
		                   <div class="news_meta">
							<?php echo mysql2date(get_option('date_format'), $comment->comment_date); ?>
							<div class="tag_marcador alignleft"><?php /* translators: used between list items, there is a space after the comma */
										$tag_list = get_the_tag_list( '', ' ','',$comment->comment_post_ID );
										printf($tag_list);
										?></div>
							
							</div><!-- .entry-meta -->
							
							<span class="clear"></span>
	 
		              </div>
		              </div>
					<?php endforeach; ?>
					
			<?php }?>
				
				
				</div> <!-- .default page -->
		      </div><!-- .grid_9 -->
		      
		      
		      
		      	<?php 
		if(is_author()) :
		?>	
		
		
			<?php 
			if(isset($uid) && $uid->user_email == 'editor@kmol.online.pt') {
			?><div class="topics">
				<div class="grid_3 omega image_blog">
					<div class="image_blog_title">
						Ana Neves
					</div>
					<div class="blog_share">
						<a href="mailto:ana.neves@knowman.pt"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_blog.png"/></a>
						<a href="<?php echo "http://twitter.com/".get_option('twitter');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_blog.png"/></a>
						<a href="<?php echo "http://pt.linkedin.com/in/".get_option('twitter');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_blog.png"/></a>
					</div>
				</div>
			</div> <!-- .topics -->
			<?php } else {?>
		
			<div class="topics">
				<div class="grid_3 omega ">
					<div class="image_blog_title author_avatar ">
						<?php if(isset($uid)) echo $uid->display_name;?>
					</div>
					<div class="blog_share">
					
						<?php
							echo get_avatar($uid->user_email,220);
						?>
					
					</div>
				</div>
			</div> <!-- .topics -->
			<?php }?>
		<?php endif;?>
		      
		      
		      <div class="grid_3 omega">
					<?php get_sidebar();?>
				</div>
		      
		</div> <!-- .container_12 -->	
		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->



<?php get_footer(); ?>
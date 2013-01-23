<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package kmol
 * @since kmol 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'kmol' ), max( $paged, $page ) );

	?></title>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container_12" role="banner">
		<div class="grid_12 alpha ">
			<a  class="logo alignleft" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/kmol_logo.png"/>
			</a>
			<a  class="logo alignleft text_logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php _e('Gestão de Conhecimento e<br/> Aprendizagem Organizacional');?>
			</a>
	
			<div class="language_select alignright"><?php do_action('icl_language_selector'); ?></div>
			<div class="register alignright">
			
			<p><?php if(!is_user_logged_in()) _e('Registar-se', 'kmol'); else  wp_loginout(true); ?></p>
			
			</div>
			<div class="social alignright"><?php dynamic_sidebar('Social_Widget'); ?></div>
			<div class="scrollingNav">
				<nav role="navigation" class="site-navigation main-navigation scrollingDiv">
					<h1 class="assistive-text"><?php _e( 'Menu', 'kmol' ); ?></h1>
					<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class'=>'menu-primary-container','menu_id'=>'menu-primary') ); ?>
					<div class="search alignright"><?php dynamic_sidebar('Search'); ?></div>
					<div class="sticky_social">
						<a href="<?php echo 'http://www.twitter.com/'. get_option('twitter');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_sticky.png"/></a>
						<a href="<?php echo 'http://www.facebook.com/'. get_option('facebook');?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/facebook_sticky.png"/></a>
					</div>
				</nav><!-- .site-navigation .main-navigation -->
			</div>
		</div> <!-- .grid_12 alpha -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
	
	<?php 
	// no need to show register form if user is logged in
	if(!is_user_logged_in())
		get_template_part( 'content', 'popup' ); 	
	?>
<?php
/**
 * kmol functions and definitions
 *
 * @package kmol
 * @since kmol 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since kmol 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'kmol_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since kmol 1.0
 */
function kmol_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on kmol, use a find and replace
	 * to change 'kmol' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kmol', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kmol' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // kmol_setup
add_action( 'after_setup_theme', 'kmol_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since kmol 1.0
 */
function kmol_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'kmol' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Social_Widget', 'kmol' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
	) );

	register_sidebar (array (
		'name' => __( 'Search', 'kmol'),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		));
}
add_action( 'widgets_init', 'kmol_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function kmol_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style('960_12_col', get_template_directory_uri().'/layouts/960_12_col.css');

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}




	wp_deregister_script( 'jquery' );
	  wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.8.2.js');
	 
	wp_enqueue_script( 'jquery' );

	wp_deregister_script( 'jquery-ui' );
wp_register_script( 'jquery-ui', 'http://code.jquery.com/ui/1.9.0/jquery-ui.js');
	wp_enqueue_script( 'jquery-ui' );



	//wp_enqueue_script ('jquery-ui-tabs');
	 // wp_enqueue_style ('jquery-ui-style' , "http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" );

}



add_action( 'wp_enqueue_scripts', 'kmol_scripts' );

function my_stylesheets_method(){ 
	wp_register_style('myStyleSheets','http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css');
	wp_enqueue_style( 'myStyleSheets'); 
} 

add_action('wp_print_styles','my_stylesheets_method');



//add scripts to the header
function my_scripts() { 
?>
<script type="text/javascript">
   jQuery(document).ready(function () {
        jQuery( "#tabs" ).tabs();
    });
    </script>

<?php }
add_action('wp_head','my_scripts');


/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

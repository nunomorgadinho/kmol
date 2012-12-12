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
	 * Custom Theme options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

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
	
	//wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

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


	wp_register_script( 'slideshow_cycle', get_template_directory_uri() . '/js/jquery.cycle.all.js');
	wp_enqueue_script( 'slideshow_cycle' );


	wp_register_script ('knob', get_template_directory_uri(). '/js/jquery.knob.js');
	wp_enqueue_script('knob');

	wp_register_script ('custom', get_template_directory_uri(). '/js/custom.js');
	wp_enqueue_script('custom');
	
	wp_register_script('my-upload', get_template_directory_uri() . '/js/kmol.js', array('jquery'));
	wp_enqueue_script('kmol');

	//wp_enqueue_script ('jquery-ui-tabs');
	
	
	
}



add_action( 'wp_enqueue_scripts', 'kmol_scripts' );

function kmol_stylesheets_method(){ 
	//wp_register_style('myStyleSheets','http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css');
	//wp_enqueue_style( 'myStyleSheets'); 
	
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style('960_12_col', get_template_directory_uri().'/layouts/960_12_col.css');
	
	
} 

add_action('wp_print_styles','kmol_stylesheets_method');




function my_admin_scripts() {
	
	// for media upload
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri() . '/js/my-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

function my_admin_styles() {
	//for media upload
	wp_enqueue_style('thickbox');
}


if (isset($_GET['page']) && ($_GET['page'] == 'kmol_options_page')) {  
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}

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


function my_scripts2() { 
?>
<script type="text/javascript">
   jQuery(document).ready(function () {
        jQuery('#s2').cycle({ 
    		fx: 'scrollLeft',
    		speed:    300,
    		easing: 'easeOutQuad' 
});
    });
    </script>

<?php }
add_action('wp_head','my_scripts2');


function knob_script() { 
?>
<script type="text/javascript">
   jQuery(document).ready(function () {
                jQuery(".knob").knob({
                    /*change : function (value) {
                        //console.log("change : " + value);
                    },
                    release : function (value) {
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : " + this.value);
                    },*/
                    /*draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.3)
                                && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.3)
                                    && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    } */
                });

    });
    </script>

<?php }
add_action('wp_head','knob_script');


/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


/**
 * Excerpt Read More
 * @param unknown_type $more
 */
function new_excerpt_more($more) {
       global $post;
		return '<a class="moretag" href="'. get_permalink($post->ID) . '">'.__(' ler mais &rarr;','kmol').'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wpe_excerptlength_teaser( $length ) {

	return 45;
}
function wpe_excerptlength_index( $length ) {

	return 40;
}
function wpe_excerptmore( $more ) {

	return '...';
}

function wpe_excerpt( $length_callback = '', $more_callback = '' ) {

	if ( function_exists( $length_callback ) )
		add_filter( 'excerpt_length', $length_callback );

	if ( function_exists( $more_callback ) )
		add_filter( 'excerpt_more', $more_callback );

	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p>' . $output . '</p>'; // maybe wpautop( $foo, $br )
	echo $output;
}



add_action('wp_head','define_ajaxurl');
function define_ajaxurl() {
	?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
	<?php
}

/**
 * For the facebook page we defined on the kmol option page
 * get it's number of folowwers
 * @return number
 */
function count_facebook_followers(){
	$count_facebook = 0;
	
	// If Facebook is enabled...
	$facebook = get_option('facebook');
	if ( isset( $facebook  ) ) {
		// ...get Facebook data
		$url = 'https://graph.facebook.com/' .$facebook . '?fields=likes';
		$get_facebook = wp_remote_get( $url );
	
		
		$count_facebook = 0;
		// Check for errors. If none proceed...
		if ( ! is_wp_error( $get_facebook ) ) {
			// Decode JSON response and cast the number of likes as integer
			$facebook_data = json_decode( $get_facebook['body'] );
			$count_facebook = (int) $facebook_data->likes;
			
		}
	}
	
	return $count_facebook;
}


/**
 * For the twitter account we defined on the kmol option page
 * get it's number of folowwers
 * @return number
 */
function count_twitter_followers(){
	$count_twitter = 0;

		// If Twitter is enabled...
		$twitter = get_option('twitter');
		if ( isset( $twitter ) ) {
			// ...get Twitter data
			$url = 'https://api.twitter.com/1/users/lookup.json?screen_name=' . $twitter;
			$get_twitter = wp_remote_get( $url );

			// Check for errors. If none proceed...
			if ( ! is_wp_error( $get_twitter ) ) { 
				// Decode the JSON response and cast the number of followers as integer
				$twitter_data = json_decode( $get_twitter['body'] );
				if ( is_array( $twitter_data ) ) {
					$count_twitter = (int) $twitter_data[0]->followers_count;
				}
			}
		}
	error_log('teiiter '.$count_twitter);
	return $count_twitter;
}

/**
 * get it's number of rss folowwers
 * @return number
 */
function count_rss_followers(){
	$count_facebook = 0;

	// If Facebook is enabled...
	$facebook = get_option('facebook');
	if ( isset( $facebook  ) ) {
		// ...get Facebook data
		$url = 'https://graph.facebook.com/' .$facebook . '?fields=likes';
		$get_facebook = wp_remote_get( $url );


		$count_facebook = 0;
		// Check for errors. If none proceed...
		if ( ! is_wp_error( $get_facebook ) ) {
			// Decode JSON response and cast the number of likes as integer
			$facebook_data = json_decode( $get_facebook['body'] );
			$count_facebook = (int) $facebook_data->likes;

		}
	}

	return $count_facebook;
}
?>

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



/**
 * POPULAR POSTS
 */
 /*
// prints popular posts
function get_popular_posts_list($instance, $return = false) {

	// set default values
	$defaults = array(
			'title' => __('Popular Posts', 'wordpress-popular-posts'),
			'limit' => 10,
			'range' => 'daily',
			'order_by' => 'comments',
			'post_type' => 'post,page',
			'author' => '',
			'cat' => '',
			'shorten_title' => array(
					'active' => false,
					'length' => 25,
					'keep_format' => false
			),
			'post-excerpt' => array(
					'active' => false,
					'length' => 55
			),
			'thumbnail' => array(
					'active' => false,
					'width' => 15,
					'height' => 15
			),
			'rating' => false,
			'stats_tag' => array(
					'comment_count' => true,
					'views' => false,
					'author' => false,
					'date' => array(
							'active' => false,
							'format' => 'F j, Y'
					)
			),
			'markup' => array(
					'custom_html' => false,
					'wpp-start' => '&lt;ul&gt;',
					'wpp-end' => '&lt;/ul&gt;',
					'post-start' => '&lt;li&gt;',
					'post-end' => '&lt;/li&gt;',
					'title-start' => '&lt;h2&gt;',
					'title-end' => '&lt;/h2&gt;',
					'pattern' => array(
							'active' => false,
							'form' => '{image} {title}: {summary} {stats}'
					)
			)
	);

	// update instance's default options
	$instance = wp_parse_args( (array) $instance, $defaults );

	global $wpdb;
	$table = $wpdb->prefix . "popularpostsdata";

	$fields = "";
	$join = "";
	$where = "";
	$having = "";
	$orderby = "";
	$cat = (is_category()) ? get_query_var('cat') : '';
	$content = "";

	if ($instance['range'] == "all") { // data - all

		// views
		if ($instance['order_by'] == "views" || $instance['order_by'] == "avg" || $instance['stats_tag']['views']) {
			$join .= " LEFT JOIN {$table} v ON p.ID = v.postid ";

			if ( $instance['order_by'] == "avg" ) {
				$fields .= ", ( IFNULL(v.pageviews, 0)/(IF ( DATEDIFF('".$this->now()."', MIN(v.day)) > 0, DATEDIFF('".$this->now()."', MIN(v.day)), 1) )) AS 'avg_views' ";
			} else {
				$fields .= ", IFNULL(v.pageviews, 0) AS 'pageviews' ";
			}
		}

		// comments
		if ($instance['order_by'] == "comments" || $instance['stats_tag']['comment_count']) {
			$fields .= ", p.comment_count AS 'comment_count' ";
		}

	} else if ($instance['range'] == "yesterday" || $instance['range'] == "daily") { // data - last 24 hours

		// views
		if ($instance['order_by'] == "views" || $instance['order_by'] == "avg" || $instance['stats_tag']['views']) {
			$join .= " LEFT JOIN (SELECT id, SUM(pageviews) AS 'pageviews', day FROM (SELECT id, pageviews, day FROM {$table}cache WHERE day > DATE_SUB('".$this->now()."', INTERVAL 1 DAY) ORDER BY day) sv GROUP BY id) v ON p.ID = v.id ";

			$fields .= ", IFNULL(v.pageviews, 0) AS 'pageviews' ";
		}

		// comments
		if ($instance['order_by'] == "comments" || $instance['stats_tag']['comment_count']) {
			$fields .= ", IFNULL(c.comment_count, 0) AS 'comment_count' ";
			$join .= " LEFT JOIN (SELECT comment_post_ID, COUNT(comment_post_ID) AS 'comment_count' FROM $wpdb->comments WHERE comment_approved = 1 AND comment_date > DATE_SUB('".$this->now()."', INTERVAL 1 DAY) GROUP BY comment_post_ID ORDER BY comment_date DESC) c ON p.ID = c.comment_post_ID ";
		}

	} else if ($instance['range'] == "weekly") { // data - last 7 days

		// views
		if ($instance['order_by'] == "views" || $instance['order_by'] == "avg" || $instance['stats_tag']['views']) {
			$join .= " LEFT JOIN (SELECT id, SUM(pageviews) AS 'pageviews', day FROM (SELECT id, pageviews, day FROM {$table}cache WHERE day > DATE_SUB('".$this->now()."', INTERVAL 1 WEEK) ORDER BY day) sv GROUP BY id) v ON p.ID = v.id ";

			if ( $instance['order_by'] == "avg" ) {
				$fields .= ", ( IFNULL(v.pageviews, 0)/(IF ( DATEDIFF('".$this->now()."', MIN(v.day)) > 0, DATEDIFF('".$this->now()."', MIN(v.day)), 1) )) AS 'avg_views' ";
			} else {
				$fields .= ", IFNULL(v.pageviews, 0) AS 'pageviews' ";
			}
		}

		// comments
		if ($instance['order_by'] == "comments" || $instance['stats_tag']['comment_count']) {
			$fields .= ", IFNULL(c.comment_count, 0) AS 'comment_count' ";
			$join .= " LEFT JOIN (SELECT comment_post_ID, COUNT(comment_post_ID) AS 'comment_count' FROM $wpdb->comments WHERE comment_approved = 1 AND comment_date > DATE_SUB('".$this->now()."', INTERVAL 1 WEEK) GROUP BY comment_post_ID ORDER BY comment_date DESC) c ON p.ID = c.comment_post_ID ";
		}

	} else if ($instance['range'] == "monthly") { // data - last 30 days

		// views
		if ($instance['order_by'] == "views" || $instance['order_by'] == "avg" || $instance['stats_tag']['views']) {
			$join .= " LEFT JOIN (SELECT id, SUM(pageviews) AS 'pageviews', day FROM (SELECT id, pageviews, day FROM {$table}cache WHERE day > DATE_SUB('".$this->now()."', INTERVAL 1 MONTH) ORDER BY day) sv GROUP BY id) v ON p.ID = v.id ";

			if ( $instance['order_by'] == "avg" ) {
				$fields .= ", ( IFNULL(v.pageviews, 0)/(IF ( DATEDIFF('".$this->now()."', MIN(v.day)) > 0, DATEDIFF('".$this->now()."', MIN(v.day)), 1) )) AS 'avg_views' ";
			} else {
				$fields .= ", IFNULL(v.pageviews, 0) AS 'pageviews' ";
			}
		}

		// comments
		if ($instance['order_by'] == "comments" || $instance['stats_tag']['comment_count']) {
			$fields .= ", IFNULL(c.comment_count, 0) AS 'comment_count' ";
			$join .= " LEFT JOIN (SELECT comment_post_ID, COUNT(comment_post_ID) AS 'comment_count' FROM $wpdb->comments WHERE comment_approved = 1 AND comment_date > DATE_SUB('".$this->now()."', INTERVAL 1 MONTH) GROUP BY comment_post_ID ORDER BY comment_date DESC) c ON p.ID = c.comment_post_ID ";
		}

	}

	// sorting options
	switch( $instance['order_by'] ) {
		case 'comments':
			if ($instance['range'] == "all") {
				$where .= " AND p.comment_count > 0 ";
				$orderby = 'p.comment_count';
			} else {
				$where .= " AND c.comment_count > 0 ";
				$orderby = 'c.comment_count';
			}
			break;

		case 'views':
			$where .= " AND v.pageviews > 0 ";
			$orderby = 'v.pageviews';
			break;

		case 'avg':
			if ($instance['range'] == "yesterday" || $instance['range'] == "daily") {
				$where .= " AND v.pageviews > 0 ";
				$orderby = 'v.pageviews';
			} else {
				$having = " HAVING avg_views > 0.0000 ";
				$orderby = 'avg_views';
			}

			break;

		default:
			$orderby = 'comment_count';
		break;
	}

	// post filters
	// * post types - based on code seen at https://github.com/williamsba/WordPress-Popular-Posts-with-Custom-Post-Type-Support
	$post_types = explode(",", $instance['post_type']);
	$i = 0;
	$len = count($post_types);
	$sql_post_types = "";

	if ($len > 1) { // we are getting posts from more that one ctp
		foreach ( $post_types as $post_type ) {
			$sql_post_types .= "'" .$post_type. "'";

			if ($i != $len - 1) $sql_post_types .= ",";

			$i++;
		}

		$where .= " AND p.post_type IN({$sql_post_types}) ";
	} else if ($len == 1) { // post from one ctp only
		$where .= " AND p.post_type = '".$instance['post_type']."' ";
	}

	// * categories
	if ( !empty($instance['cat']) ) {
		$cat_ids = explode(",", $instance['cat']);
		$in = array();
		$out = array();
		$not_in = "";

		usort($cat_ids, array(&$this, 'sorter'));

		for ($i=0; $i < count($cat_ids); $i++) {
			if ($cat_ids[$i] >= 0) $in[] = $cat_ids[$i];
			if ($cat_ids[$i] < 0) $out[] = $cat_ids[$i];
		}

		$in_cats = implode(",", $in);
		$out_cats = implode(",", $out);
		$out_cats = preg_replace( '|[^0-9,]|', '', $out_cats );

		if ($in_cats != "" && $out_cats == "") { // get posts from from given cats only
			$where .= " AND p.ID IN (
			SELECT object_id
			FROM $wpdb->term_relationships AS r
			JOIN $wpdb->term_taxonomy AS x ON x.term_taxonomy_id = r.term_taxonomy_id
			JOIN $wpdb->terms AS t ON t.term_id = x.term_id
			WHERE x.taxonomy = 'category' AND t.term_id IN($in_cats)
			) ";
	} else if ($in_cats == "" && $out_cats != "") { // exclude posts from given cats only
	$where .= " AND p.ID NOT IN (
	SELECT object_id
	FROM $wpdb->term_relationships AS r
	JOIN $wpdb->term_taxonomy AS x ON x.term_taxonomy_id = r.term_taxonomy_id
	JOIN $wpdb->terms AS t ON t.term_id = x.term_id
	WHERE x.taxonomy = 'category' AND t.term_id IN($out_cats)
		) ";
	} else { // mixed, and possibly a heavy load on the DB
	$where .= " AND p.ID IN (
	SELECT object_id
	FROM $wpdb->term_relationships AS r
	JOIN $wpdb->term_taxonomy AS x ON x.term_taxonomy_id = r.term_taxonomy_id
	JOIN $wpdb->terms AS t ON t.term_id = x.term_id
	WHERE x.taxonomy = 'category' AND t.term_id IN($in_cats)
	) AND p.ID NOT IN (
	SELECT object_id
	FROM $wpdb->term_relationships AS r
	JOIN $wpdb->term_taxonomy AS x ON x.term_taxonomy_id = r.term_taxonomy_id
	JOIN $wpdb->terms AS t ON t.term_id = x.term_id
	WHERE x.taxonomy = 'category' AND t.term_id IN($out_cats)
	) ";
}
}

// * authors
if ( !empty($instance['author']) ) {
$authors = explode(",", $instance['author']);
$len = count($authors);

	if ($len > 1) { // we are getting posts from more that one author
	$where .= " AND p.post_author IN(".$instance['author'].") ";
} else if ($len == 1) { // post from one author only
	$where .= " AND p.post_author = '".$instance['author']."' ";
}
}

$query = "SELECT p.ID AS 'id', p.post_title AS 'title', p.post_date AS 'date', p.post_author AS 'uid' {$fields} FROM {$wpdb->posts} p {$join} WHERE p.post_status = 'publish' AND p.post_password = '' {$where} GROUP BY p.ID {$having} ORDER BY {$orderby} DESC LIMIT " . $instance['limit'] . ";";

//echo $query;
//return $content;



$mostpopular = $wpdb->get_results($query);*/
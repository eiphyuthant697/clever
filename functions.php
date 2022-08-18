<?php
/**
 * Real Home functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Real_Home
 */

/**
 * Real Home only works in WordPress 5.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Define Constants
 */
if ( ! defined( 'REAL_HOME_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'REAL_HOME_THEME_VERSION', '1.0.0' );
}
if ( ! defined( 'REAL_HOME_THEME_DIR' ) ) {
	define( 'REAL_HOME_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'REAL_HOME_THEME_URI' ) ) {
	define( 'REAL_HOME_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
}

if ( ! function_exists( 'real_home_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function real_home_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Real Home, use a find and replace
		 * to change 'real-home' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'real-home', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu'  => esc_html__( 'Primary Menu', 'real-home' ),
				'mobile-menu'   => esc_html__( 'Mobile Menu', 'real-home' ),
				'footer-menu'   => esc_html__( 'Footer Menu', 'real-home' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'real_home_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function real_home_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'real_home_content_width', 640 );
}
add_action( 'after_setup_theme', 'real_home_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function real_home_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'real-home' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'real-home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Subscribe Form
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Subscribe Form', 'real-home' ),
			'id'            => 'subscribe-form',
			'description'   => esc_html__( 'Add widgets here.', 'real-home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $sidebar = 1; $sidebar <= 6; $sidebar++ ) {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'Footer Sidebar %d ', 'real-home' ), absint($sidebar) ),
				'id'            => 'footer-sidebar-' . absint($sidebar),
				'description'   => esc_html__( 'Display widgets footer section of the site.', 'real-home' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'real_home_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function real_home_scripts() {

	// Font Awesome Style
	wp_enqueue_style( 'font-awesome', REAL_HOME_THEME_URI .'assets/css/font-awesome.css', array(), '4.7.0' );

	// MeanMenu Style
	wp_enqueue_style( 'meanmenu', REAL_HOME_THEME_URI .'assets/css/meanmenu.css', array(), '2.0.7' );

	// Slick Style
	wp_enqueue_style( 'slick-theme', REAL_HOME_THEME_URI .'assets/css/slick-theme.css', null, '1.8.0' );
	wp_enqueue_style( 'slick', REAL_HOME_THEME_URI .'assets/css/slick.css', null, '1.8.0' );

	// Theme Style
	wp_enqueue_style( 'real-home-style', get_stylesheet_uri(), array(), REAL_HOME_THEME_VERSION );

	// Main Style
	wp_enqueue_style( 'real-home-main-style', REAL_HOME_THEME_URI . 'assets/css/main.css', null, REAL_HOME_THEME_VERSION, 'all' );

	// Responsive Style
	wp_enqueue_style( 'real-home-responsive', REAL_HOME_THEME_URI . 'assets/css/responsive.css', null, REAL_HOME_THEME_VERSION, 'all' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'real-home-main-style', Real_Home_Customizer_Inline_Style::css_output( 'front-end' ) );

	// Enqueue Slick Js
	wp_enqueue_script( 'slick', REAL_HOME_THEME_URI . 'assets/js/slick.js', [ 'jquery' ], '1.8.0', true );

	// Enqueue MeanMenu Js
	wp_enqueue_script( 'meanmenu', REAL_HOME_THEME_URI . 'assets/js/jquery.meanmenu.js', [ 'jquery' ], '2.0.7', true );

	// Enqueue Isotope Js
	wp_enqueue_script( 'isotope', REAL_HOME_THEME_URI . 'assets/js/isotope.pkgd.js', [ 'jquery' ], '3.0.6', true );

	// Enqueue Images Loaded Js
	wp_enqueue_script( 'imagesloaded', REAL_HOME_THEME_URI . 'assets/js/imagesloaded.pkgd.js', [ 'jquery' ], '3.2.0', true );

	// Enqueue theia-sticky-sidebar Js
	$sticky_sidebar = get_theme_mod( 'real_home_sidebar_sticky', '' );
	if ( $sticky_sidebar ) {
		wp_enqueue_script( 'theia-sticky-sidebar', REAL_HOME_THEME_URI . 'assets/js/theia-sticky-sidebar.js', [ 'jquery' ], '1.7.0', true );
	}

	// Main scripts.
	wp_enqueue_script( 'real-home', REAL_HOME_THEME_URI . 'assets/js/real-home.js', array( 'jquery' ), REAL_HOME_THEME_VERSION, true );

	// Localized Scripts for the load more posts.
	$locale = [
		'sticky_sidebar' => $sticky_sidebar ? true : false,
	];
	$locale = apply_filters( 'real_home_localize_var', $locale );
	wp_localize_script( 'real-home','REAL_HOME', $locale );

	// Comment Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'real_home_scripts' );

/**
 * Custom template tags for this theme.
 */
require REAL_HOME_THEME_DIR . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require REAL_HOME_THEME_DIR . 'inc/template-functions.php';

/**
 * Google fonts utilities
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Google_Fonts.php';

/**
 * Font Awesome Icon
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Font_Awesome_Icons.php';

/**
 * Breadcrumb
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Breadcrumb.php';

/**
 * Helper Functions
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Helper.php';

/**
 * Customizer additions.
 */
require REAL_HOME_THEME_DIR . 'inc/customizer/Real_Home_Customizer.php';

// Builder
require REAL_HOME_THEME_DIR . 'inc/customizer/builder/Real_Home_Customizer_Builder.php';
require REAL_HOME_THEME_DIR. 'inc/customizer/builder/header/Real_Home_Customizer_Header_Builder.php';
require REAL_HOME_THEME_DIR. 'inc/customizer/builder/footer/Real_Home_Customizer_Footer_Builder.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require REAL_HOME_THEME_DIR . 'inc/compatibility/jetpack/jetpack.php';
}

/**
 * Load hooks file.
 */
require REAL_HOME_THEME_DIR . 'inc/hooks/hooks.php';
require REAL_HOME_THEME_DIR . 'inc/hooks/functions.php';

/**
 * Load plugin recommendations.
 */
require REAL_HOME_THEME_DIR . 'inc/tgm/tgm.php';

function advanced_search_query( $query ) {
	// set up execution conditions to only run when its submitted from our Advanced Search form
	if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'advanced' && !is_admin() && $query->is_search && $query->is_main_query() ) {

		// limit queery for custom post type
		$query->set( 'post_type', 'property' );

		// Get query strings from URL and store the min a variable
		$_region = $_GET['location'] != '' ? $_GET['location'] : '';
		$_category = $_GET['category'] != '' ? $_GET['category'] : '';
		$_location_tsp = $_GET['location_tsp'] != '' ? $_GET['location_tsp'] : '';
		$_feature = $_GET['feature'] != '' ? $_GET['feature'] : '';
		$_min_price = $_GET['min_price'] != '' ? $_GET['min_price'] : '';
		$_max_price = $_GET['max_price'] != '' ? $_GET['max_price'] : '';
		$_max_price = $_GET['max_price'] != '' ? $_GET['max_price'] : '';
		$_keyword_search = $_GET['keyword_search'] != '' ? $_GET['keyword_search'] : '';

		if($_keyword_search){
			$query->set('s', $_keyword_search);	
		}
		// Min & Max Price
		if( $_min_price != '' || $_max_price != '') {
			if($_min_price != '' && $_max_price != ''){
				$meta_query = array(
					array(
						'key' => 'cre_property_price',
						'value' => array( $_min_price, $_max_price ),
						'type' => 'numeric',
						'compare' => 'BETWEEN'
					)
				);
				$query->set('meta_query', $meta_query );
			}
			elseif($_min_price != '' && $_max_price == ''){
				$meta_query = array(
					array(
						'key' => 'cre_property_price',
						'value' => $_min_price,
						'type' => 'numeric',
						'compare' => '>='
					)
				);
				$query->set('meta_query', $meta_query );
			}
			elseif($_max_price != '' && $_min_price == ''){
				$meta_query = array(
					array(
						'key' => 'cre_property_price',
						'value' => $_max_price,
						'type' => 'numeric',
						'compare' => '<='
					)
				);
				$query->set('meta_query', $meta_query );
			}
			
		}

		// if Region is not empty limit the taxonomy to the specified
		if( $_region != '' && $_location_tsp != '') {
			$taxquery = array(
				array(
					'taxonomy' => 'property-location',
					'field' => 'slug',
					'terms' => $_location_tsp,
					'operator'=> 'AND'
				)
			);
			$query->set( 'tax_query', $taxquery );
		}

		// // if Category is not empty limit the taxonomy to the specified
		if( $_category != '' ) {
			$taxquery = array(
				array(
					'taxonomy' => 'property-type',
					'field' => 'slug',
					'terms' => $_category,
					'operator'=> 'AND'
				)
			);
			$query->set( 'tax_query', $taxquery );
		}
		
		if( $_feature != '' ) {
			$taxquery = array(
				array(
					'taxonomy' => 'property-feature',
					'field' => 'slug',
					'terms' => $_feature,
					'operator'=> 'AND'
				)
			);
			$query->set( 'tax_query', $taxquery );
		}	    

		

		return; // always return
	}
}

add_action( 'pre_get_posts', 'advanced_search_query' );


// THIS FUNCTION RETURS NUMBER OF VIEWS FOR A POST
function getPostViewCount(){
	$postID = get_the_ID();
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		  delete_post_meta($postID, $count_key);
		  add_post_meta($postID, $count_key, '1');
		  return 1;
	}
	if(intval($count) > 1000){
		 return number_format($count/1000,1).'K';
	}elseif(intval($count) > 1000000){
		 return number_format($count/1000000,1).'M';
	}else{
		 return $count;
	}
}

// THIS FUNCTION COUNTS POST VIEWS
function setPostViewCount() {
	$postID = get_the_ID();
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

function custom_polylang_langswitcher() {
	$output = '';
	if ( function_exists( 'pll_the_languages' ) ) {
		$args   = [
			'show_flags' => 1,
			'show_names' => 0,
			'echo'       => 0,
		];
		$output = '<ul class="polylang_langswitcher d-flex justify-content-center justify-content-md-end justify-content-lg-end">'.pll_the_languages( $args ). '</ul>';
	}

	return $output;
}

add_shortcode( 'polylang_langswitcher', 'custom_polylang_langswitcher' );

function add_role_to_admin_body($classes) {
	
	global $current_user;
	$user_role = array_shift($current_user->roles);
	
	$classes .= 'role-'. $user_role;
	return $classes;
}
add_filter('admin_body_class', 'add_role_to_admin_body');

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
echo '<style>
#toplevel_page_crucial-real-estate li:nth-child(4), #toplevel_page_crucial-real-estate li:nth-child(5), #toplevel_page_crucial-real-estate li:nth-child(18), #toplevel_page_crucial-real-estate li:nth-child(19), #toplevel_page_crucial-real-estate li:nth-child(20) {
    display: none;
} 

  </style>';
}
// , .role-contributor #toplevel_page_crucial-real-estate
add_action( 'admin_init', 'mathiregister_allow_uploads' );

function mathiregister_allow_uploads() {
    $contributor = get_role( 'contributor' );
     $contributor->add_cap('upload_files');

}
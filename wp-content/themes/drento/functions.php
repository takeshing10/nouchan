<?php
/**
 * drento functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package drento
 */

if ( ! function_exists( 'drento_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function drento_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on drento, use a find and replace
	 * to change 'drento' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'drento', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/* Support for wide images on Gutenberg */
	add_theme_support( 'align-wide' );
	
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'drento-normal-post', 840, 9999);
	add_image_size( 'drento-little-post', 840, 300, true);
	add_image_size( 'drento-related-box', 1000, 300, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'drento' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'video', 'gallery',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'drento_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Adds support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'drento' ),
			'shortName' => __( 'S', 'drento' ),
			'size'      => 12,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Regular', 'drento' ),
			'shortName' => __( 'M', 'drento' ),
			'size'      => 14,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'Large', 'drento' ),
			'shortName' => __( 'L', 'drento' ),
			'size'      => 18,
			'slug'      => 'large'
		),
		array(
			'name'      => __( 'Larger', 'drento' ),
			'shortName' => __( 'XL', 'drento' ),
			'size'      => 20,
			'slug'      => 'larger'
		)
	) );
}
endif; // drento_setup
add_action( 'after_setup_theme', 'drento_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function drento_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'drento_content_width', 740 );
}
add_action( 'after_setup_theme', 'drento_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function drento_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'drento' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widgetTop"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'drento_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function drento_scripts() {
	wp_enqueue_style( 'drento-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), '4.7.0');
	$query_args = array(
		'family' => 'Montserrat:400,700%7CRoboto+Slab:300,400,700',
		'display' => 'swap'
	);
	wp_enqueue_style( 'drento-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

	wp_enqueue_script( 'drento-custom', get_template_directory_uri() . '/js/jquery.drento.min.js', array('jquery'), wp_get_theme()->get('Version'), true );
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'jquery-nanoscroller', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array('jquery'), '0.8.7', true );
	}
	wp_enqueue_script( 'drento-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'drento_scripts' );

/**
* Fix skip link focus in IE11.
*
* This does not enqueue the script because it is tiny and because it is only for IE11,
* thus it does not warrant having an entire dedicated blocking script being loaded.
*
* @link https://git.io/vWdr2
*/
function drento_skip_link_focus_fix() {
    // The unminified version of this code is in /js/skip-link-focus-fix.js
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'drento_skip_link_focus_fix' );

function drento_gutenberg_scripts() {
	wp_enqueue_style( 'drento-gutenberg-css', get_theme_file_uri( '/css/gutenberg-editor-style.css' ), array(), wp_get_theme()->get('Version') );
}
add_action( 'enqueue_block_editor_assets', 'drento_gutenberg_scripts' );

/**
 * Register all Elementor locations
 */
function drento_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'drento_register_elementor_locations' );

/**
 * Replace Excerpt More
 */
if ( ! function_exists( 'drento_new_excerpt_more' ) ) {
	function drento_new_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
		return '&hellip;';
	}
}
add_filter('excerpt_more', 'drento_new_excerpt_more');

 /**
 * Delete font size style from tag cloud widget
 */
if ( ! function_exists( 'drento_fix_tag_cloud' ) ) {
	function drento_fix_tag_cloud($tag_string){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$tag_string);
	}
}
add_filter('wp_generate_tag_cloud', 'drento_fix_tag_cloud',10,1);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/drento-admin-page.php';
}

/**
 * Load PRO Button in the customizer
 */
require get_template_directory() . '/inc/pro-button/class-customize.php';

<?php
/**
 * Evan Works functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package evn
 */

if ( ! defined( 'PTY_GDNVERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PTY_GDNVERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function evn_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Funky Shrimp, use a find and replace
		* to change 'evn' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'evn', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	//add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'evn' ),
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

	// Set up the WordPress core custom background feature.
	/*add_theme_support(
		'custom-background',
		apply_filters(
			'evn_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);*/

	// Add theme support for selective refresh for widgets.
	//add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	/*add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);*/
}
add_action( 'after_setup_theme', 'evn_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function evn_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'evn_content_width', 640 );
}
add_action( 'after_setup_theme', 'evn_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function evn_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'evn' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'evn' ),
			'before_widget' => '',
			'after_widget'  => '',
		)
	);
}
add_action( 'widgets_init', 'evn_widgets_init' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVGS
 */
require get_template_directory() . '/inc/svg.php';

/**
 * Block Styles
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * Enqueue
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Password Protect
 */
require get_template_directory() . '/inc/password-protect.php';

/**
 * Homepage Hero
 */
require get_template_directory() . '/inc/homepage-hero.php';

/**
 * Bookings
 */
require get_template_directory() . '/inc/bookings.php';

/**
 * Services Icons
 */
require get_template_directory() . '/inc/services.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

//Remove all default block patterns
add_action('init', function() {
	remove_theme_support('core-block-patterns');
});
add_filter( 'should_load_remote_block_patterns', '__return_false' );

add_image_size( 'medium_semilarge', 512, 512, false );

function evn_custom_image_sizes( $sizes ) {
return array_merge( $sizes, array(
	'medium_semilarge' => __( 'Medium Semilarge' ),
	'medium_large' => __('Medium Large'),
	) );
}
add_filter( 'image_size_names_choose','evn_custom_image_sizes' );
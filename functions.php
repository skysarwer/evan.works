<?php
/**
 * Evan Works functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package evn
 */

if ( ! defined( 'EVN_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'EVN_VERSION', '1.0.0' );
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
 * Bookings
 */
//require get_template_directory() . '/inc/bookings.php';

/**
 * Navigation
 */
require get_template_directory() . '/inc/navigation.php';

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

// Add the second editor to the post editor
add_action( 'add_meta_boxes', 'add_title_banner_editor' );
function add_title_banner_editor() {
    add_meta_box( 'title-banner-editor', 'Title Banner', 'title_banner_editor_html', 'post', 'normal', 'high' );
}

function title_banner_editor_html( $post ) {
    wp_nonce_field( 'title_banner_editor_nonce', 'title_banner_editor' );
    $content = get_post_meta( $post->ID, 'title_banner', true );
    echo '<div class="title-banner-editor">';
    if ( !empty( $content ) ) {
        echo render_block( json_decode( $content, true ) );
    }
    echo '<button id="add-title-banner-blocks" class="button">Add Blocks</button>';
    echo '</div>';
    echo '<script>bindButton();</script>';
}



// Enqueue the script that opens the block editor modal
add_action( 'admin_enqueue_scripts', 'my_theme_enqueue_scripts' );
function my_theme_enqueue_scripts() {
    wp_enqueue_script( 'my-theme-script', get_template_directory_uri() . '/js/my-theme-script.js', array( 'wp-blocks', 'wp-i18n', 'wp-element' ) );
    wp_localize_script( 'my-theme-script', 'my_theme_data', array(
        'title_banner_nonce' => wp_create_nonce( 'title_banner_editor_nonce' ),
        'title_banner_post_id' => get_the_ID(),
    ) );
}


// Save the second editor's content to the "title_banner" meta key when the post is saved
add_action( 'save_post', 'save_title_banner_editor' );
function save_title_banner_editor( $post_id ) {
    if ( ! isset( $_POST['title_banner_editor'] ) || ! wp_verify_nonce( $_POST['title_banner_editor'], 'title_banner_editor_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['blocks'] ) ) {
        update_post_meta( $post_id, 'title_banner', wp_slash( wp_json_encode( $_POST['blocks'] ) ) );
    }
}

add_action( 'wp_ajax_save_title_banner', 'save_title_banner_callback' );
function save_title_banner_callback() {
    check_ajax_referer( 'title_banner_editor_nonce', 'nonce' );
    $post_id = intval( $_POST['post_id'] );
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        wp_send_json_error();
    }
    update_post_meta( $post_id, 'title_banner', $_POST['title_banner'] );
    wp_send_json_success();
}

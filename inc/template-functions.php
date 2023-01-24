<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package evn
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function evn_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'evn_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function evn_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'evn_pingback_header' );

function evn_add_hide_title_metabox() {
    add_meta_box(
        'hide_title_metabox', // Metabox ID
        'Hide Title', // Metabox title
        'evn_render_hide_title_metabox', // Callback function to render the metabox
        'page', // Post type
        'side', // Context (normal, advanced, or side)
        'default' // Priority (high, core, default, or low)
    );
}
add_action( 'add_meta_boxes', 'evn_add_hide_title_metabox' );

function evn_render_hide_title_metabox( $post ) {
    $hide_title = get_post_meta( $post->ID, 'hide_title', true );

    ?>
    <label for="hide_title">
        <input type="checkbox" name="hide_title" id="hide_title" value="1" <?php checked( $hide_title, 1 ); ?>>
        Hide Title
    </label>
    <?php
}

function evn_save_hide_title_metabox( $post_id ) {
    if ( isset( $_POST['hide_title'] ) ) {
        update_post_meta( $post_id, 'hide_title', 1 );
    } else {
        update_post_meta( $post_id, 'hide_title', 0 );
    }
}
add_action( 'save_post', 'evn_save_hide_title_metabox' );
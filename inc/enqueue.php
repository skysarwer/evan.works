<?php

function enqueue_editor_css() {

    wp_register_style(
		'editor-styles', 
		get_stylesheet_directory_uri() . '/css/editor.css',
		'',
		'',
		''
	);

	wp_enqueue_script(
		'evn-editor', 
		get_stylesheet_directory_uri() . '/js/editor.js', 
		array( 'wp-blocks', 'wp-dom' ), 
		filemtime( get_stylesheet_directory() . '/js/editor.js' ),
		true
	);

	//wp_enqueue_style( 'editor-styles', get_stylesheet_directory_uri() . '/css/editor.css' );
	wp_enqueue_style( 'gutenberg-css', get_stylesheet_directory_uri() . '/css/editor/gutenberg.css' );

}
add_action( 'enqueue_block_editor_assets', 'enqueue_editor_css' );

/**
 * Enqueue scripts and styles.
 */
function evn_scripts() {
	
	wp_enqueue_style( 'evn-style', get_stylesheet_uri(), array(), EVN_VERSION );

	//wp_enqueue_style( 'evn-datepicker-style', get_template_directory_uri() . '/css/datepicker.min.css', array(), EVN_VERSION );

	wp_enqueue_script( 'evn-navigation', get_template_directory_uri() . '/js/navigation.js', array(), EVN_VERSION, true );

	wp_enqueue_script('evn_datepicker', get_template_directory_uri() . '/js/datepicker.min.js', array('jquery'), EVN_VERSION, true);

	wp_enqueue_script('evn_datepicker_i18n', get_template_directory_uri() . '/js/i18n/datepicker.en.js', array('evn_datepicker', 'jquery'), EVN_VERSION, true);

	wp_enqueue_script( 'evn-bookings', get_template_directory_uri() . '/js/bookings.js', array('evn_datepicker_i18n', 'evn_datepicker', 'jquery'), EVN_VERSION, true );

	wp_enqueue_script( 'evn-cta-sidebar', get_template_directory_uri() . '/js/cta-sidebar.js', array('evn_datepicker', 'jquery'), EVN_VERSION, true );

	wp_enqueue_script('evn_parvus_src', get_template_directory_uri() . '/js/parvus.min.js', array('jquery'), EVN_VERSION, true );
	
	wp_enqueue_script('evn_parvus_init', get_template_directory_uri() . '/js/parvus-init.js', array('evn_parvus_src', 'jquery'), EVN_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'evn_scripts' );
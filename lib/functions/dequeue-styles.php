<?php
/**
 * Dequeue unneeded scripts and styles.
 */

function great_outdoors_deregister_plugin_assets_header() {
	wp_dequeue_style( 'yarppWidgetCss' );
	wp_deregister_style( 'yarppRelatedCss' );
}
add_action( 'wp_print_styles', 'great_outdoors_deregister_plugin_assets_header', 100 );

function great_outdoors_deregister_plugin_assets_footer() {
	wp_dequeue_style(' yarppRelatedCss' );
}
add_action( 'wp_footer', 'great_outdoors_deregister_plugin_assets_footer' );

function great_outdoors_remove_jetpack_css(){
	return false;
}
add_action( 'jetpack_implode_frontend_css', 'great_outdoors_remove_jetpack_css' );

function great_outdoors_remove_devicepx() {
	wp_deregister_script( 'devicepx' );
	wp_dequeue_script( 'devicepx' );
}
add_action( 'jetpack_implode_frontend_css', 'great_outdoors_remove_devicepx' );

// Unregister unneeded Contact Form 7 plugin CSS and JS
add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );


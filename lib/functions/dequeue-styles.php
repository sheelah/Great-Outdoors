<?php
/**
 * Dequeue unneeded scripts and styles.
 */

function great_outdoors_deregister_plugin_assets_header() {
	wp_dequeue_style('yarppWidgetCss');
	wp_deregister_style('yarppRelatedCss');
}
add_action( 'wp_print_styles', 'great_outdoors_deregister_plugin_assets_header', 100 );

function great_outdoors_deregister_plugin_assets_footer() {
	wp_dequeue_style('yarppRelatedCss');
}
add_action( 'wp_footer', 'great_outdoors_deregister_plugin_assets_footer' );



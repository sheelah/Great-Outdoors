<?php
/**
 * Add SVG support in media uploader.
 */

function great_outdoors_enable_svg_upload( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'great_outdoors_enable_svg_upload' );

/**
 * Display images on media uploader (list view only) and featured images
 */
function great_outdoors_display_svg() {
	echo '';
}
add_action('admin_head', 'great_outdoors_display_svg');
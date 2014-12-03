<?php
/**
 * Add SVG support in media uploader.
 */

if ( ! function_exists( 'great_outdoors_enable_svg_upload' ) ) :
	function great_outdoors_enable_svg_upload( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
endif;
add_filter( 'upload_mimes', 'great_outdoors_enable_svg_upload' );

/**
 * Display images on media uploader (list view only) and featured images
 */
if ( ! function_exists( 'great_outdoors_display_svg' ) ) :
	function great_outdoors_display_svg() {
		echo '';
}
endif;
add_action('admin_head', 'great_outdoors_display_svg');
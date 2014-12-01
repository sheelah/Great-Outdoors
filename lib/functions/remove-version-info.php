<?php
/**
 * Remove version information from page header and RSS feeds.
 */
if ( ! function_exists( 'great_outdoors_remove_version_info' ) ) :
	function great_outdoors_remove_version_info() {
		return '';
	}
endif;
add_filter('the_generator', 'great_outdoors_remove_version_info');


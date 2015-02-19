<?php
/**
 * Remove version information from page head and RSS feeds.
 */
function great_outdoors_remove_version_info() {
	return '';
}
add_filter('the_generator', 'great_outdoors_remove_version_info');


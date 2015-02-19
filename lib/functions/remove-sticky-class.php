<?php
/**
 * Remove "sticky" CSS class from WordPress
 * http://garethcooper.com/2014/01/zurb-foundation-5-and-wordpress-menus/
 */

function great_outdoors_remove_sticky_class($classes) {
	$classes = array_diff($classes, array("sticky"));
	$classes[] = 'wordpress-sticky';
	return $classes;
}
add_filter( 'post_class','great_outdoors_remove_sticky_class' );

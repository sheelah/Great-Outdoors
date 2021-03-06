<?php
/**
 * Great Outdoors functions and definitions
 *
 * @package Great Outdoors
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1450; /* pixels */
}

// Register sidebar widgets
require_once( 'lib/functions/register-sidebars.php' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Add theme support
require_once( 'lib/functions/theme-support.php' );

// Add SVG support
require_once( 'lib/functions/svg-support.php' );

// Remove version number from page head and RSS feeds
require_once( 'lib/functions/remove-version-info.php' );

// Add responsive images functionality
require_once( 'lib/functions/responsive-images.php' );

// Remove dupe sticky class in WordPress and let Foundation use it
require_once( 'lib/functions/remove-sticky-class.php' );

// Enqueue scripts and styles
require_once( 'lib/functions/enqueue-scripts.php' );

// Dequeue unneeded styles
require_once( 'lib/functions/dequeue-styles.php' );

// Register all navigation menus
require_once( 'lib/functions/foundation-topbar-menu.php' );

// Add menu walker
require_once( 'lib/functions/foundation-menu-walker.php' );

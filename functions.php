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
	$content_width = 640; /* pixels */
}


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function great_outdoors_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'great-outdoors' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'great_outdoors_widgets_init' );

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
require_once('lib/functions/theme-support.php');

// Enqueue scripts and styles
require_once('lib/functions/enqueue-scripts.php');

// Register all navigation menus
require_once('lib/functions/foundation-topbar-menu.php');

// Add menu walker
require_once('lib/functions/foundation-menu-walker.php');
<?php
if ( ! function_exists( 'great_outdoors_theme_support' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
* Note: the after_setup_theme hook runs at every page load.
*/
function great_outdoors_theme_support() {

/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on Great Outdoors, use a find and replace
* to change 'great-outdoors' to the name of your theme in all the template files
*/
load_theme_textdomain( 'great-outdoors', get_template_directory() . '/languages' );

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*
* Enable support for Post Thumbnails on posts and pages.
*
* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
*/
add_theme_support( 'post-thumbnails' );
add_image_size( 'small-thumb', 500, 9999 );

/*
* Switch default core markup for search form, comment form, and comments
* to output valid HTML5.
*/
add_theme_support( 'html5', array(
'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
) );

/*
* Enable support for Post Formats.
* See http://codex.wordpress.org/Post_Formats
*/
add_theme_support( 'post-formats', array( 'aside' ) );

// Setup the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'great_outdoors_custom_background_args', array(
'default-color' => 'ffffff',
'default-image' => '',
) ) );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );
}
endif; // great_outdoors_theme_support
add_action( 'after_setup_theme', 'great_outdoors_theme_support' );

if ( ! function_exists( 'great_outdoors_enforce_image_size_options' ) ) :
/**
 * Sets up theme defaults for image sizes using the switch_theme hook.
 *
 * Note: The switch_theme hook runs only after a theme is activated.
 */
function great_outdoors_enforce_image_size_options() {
	$image_sizes = array(
		'thumb_size_w' => 250,  // tiniest thumbnail; for post index listings
		'thumb_size_h' => 350,
		'medium_size_w' => 800, // bigger screens and tablets
		'medium_size_h' => 9999,
		'large_size_w' => 1450, // desktop screens; for post featured image on largest screens
		'large_size_h' => 600,
	);

	update_option( 'thumbnail_size_w', $image_sizes['thumb_size_w'] );
	update_option( 'thumbnail_size_h', $image_sizes['thumb_size_h'] );
	update_option( 'thumbnail_crop', 1 );
	update_option( 'medium_size_w', $image_sizes['medium_size_w'] );
	update_option( 'medium_size_h', $image_sizes['medium_size_h'] );
	update_option( 'large_size_w', $image_sizes['large_size_w'] );
	update_option( 'large_size_h', $image_sizes['large_size_h'] );
	update_option( 'large_crop', 1 );
}
endif;
add_action( 'switch_theme', 'great_outdoors_enforce_image_size_options' );



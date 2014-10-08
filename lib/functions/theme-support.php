<?php
if ( ! function_exists( 'great_outdoors_theme_support' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
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
//add_theme_support( 'post-thumbnails' );

// This theme uses wp_nav_menu() in one location.
//register_nav_menus( array(
//	'primary' => __( 'Primary Menu', 'great-outdoors' ),
//) );

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
add_theme_support( 'post-formats', array(
'aside', 'image', 'video', 'quote', 'link',
) );

// Setup the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'great_outdoors_custom_background_args', array(
'default-color' => 'ffffff',
'default-image' => '',
) ) );
}
endif; // great_outdoors_setup
add_action( 'after_setup_theme', 'great_outdoors_theme_support' );
?>
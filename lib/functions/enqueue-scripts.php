<?php
/**
* Enqueue scripts and styles.
*/

if ( ! function_exists( 'great_outdoors_scripts' ) ) :
	function great_outdoors_scripts() {
        wp_enqueue_style('great-outdoors-style', get_stylesheet_uri());

		$font_base_url = '//fonts.googleapis.com/css';
		$font_query = '?family=Lato:400,700|PT+Serif:400,700,400italic,700italic|Roboto+Slab:400';
		wp_enqueue_style('great-outdoors-google-fonts', $font_base_url . $font_query);

		wp_enqueue_style('great-outdoors-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

        // Don't use the jQuery shipped with WordPress
        if (!is_admin()) {
            wp_deregister_script('jquery');

            wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null);
        }
        // Enqueue concatenated and minified JS
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), null);

        wp_enqueue_script('foundation', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array('jquery'), null, true);

        wp_enqueue_script('great-outdoors-js', get_template_directory_uri() . '/js/dist/greatoutdoors.min.js', array('jquery'), null, true);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
endif; // great_outdoor_scripts
add_action( 'wp_enqueue_scripts', 'great_outdoors_scripts' );

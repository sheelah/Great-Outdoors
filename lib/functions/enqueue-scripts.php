<?php
/**
* Enqueue scripts and styles.
*/

function great_outdoors_scripts() {
	// Don't use the jQuery shipped with WordPress
	if( !is_admin() ) {
		wp_deregister_script( 'jquery' );

		// Enqueue jQuery from Google CDN
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), null, true );
		add_filter('script_loader_src', 'great_outdoors_jquery_local_fallback', 10, 2);
	}

	wp_enqueue_script('jquery');
	wp_enqueue_style( 'great-outdoors-style', get_stylesheet_uri(), array(), null );

	$font_base_url = '//fonts.googleapis.com/css';
	$font_query     = '?family=Open+Sans:400,700,800,400italic,700italic,800italic|PT+Serif:400,700,400italic,700italic|Roboto+Slab:400';
	wp_enqueue_style( 'great-outdoors-google-fonts', $font_base_url . $font_query, array(), null );

	wp_enqueue_style( 'great-outdoors-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), null );

	// Enqueue concatenated and minified JS
	wp_enqueue_script( 'picturefill', '//cdnjs.cloudflare.com/ajax/libs/picturefill/2.3.1/picturefill.min.js', array(), null );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), null, true );

	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'great-outdoors-js', get_template_directory_uri() . '/js/greatoutdoors.min.js', array( 'jquery' ), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'great_outdoors_scripts' );

// http://wordpress.stackexchange.com/a/12450
function great_outdoors_jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;

	if ( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . $add_jquery_fallback .'"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}
	if ( $handle === 'jquery' ) {
		$add_jquery_fallback = apply_filters( 'script_loader_src', get_template_directory_uri() . '/js/lib/jquery-2.1.3.min.js', 'jquery-fallback');
	}

	return $src;
}
add_action('wp_head', 'great_outdoors_jquery_local_fallback');

function great_outdoors_enqueue_editor_styles() {
	// This theme styles the visual editor to resemble the theme style.
	$font_base_url = '//fonts.googleapis.com/css';
	$font_query    = '?family=Open+Sans:400,700,800,400italic,700italic,800italic|PT+Serif:400,700,400italic,700italic|Roboto+Slab:400';
	$font_url      = $font_base_url . $font_query;
	add_editor_style( array( 'editor-style.css', str_replace( ',', '%2C', $font_url ) ) );
}
add_action( 'after_setup_theme', 'great_outdoors_enqueue_editor_styles' );


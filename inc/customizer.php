<?php
/**
 * Great Outdoors Theme Customizer
 *
 * @package Great Outdoors
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function great_outdoors_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'great_outdoors_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function great_outdoors_customize_preview_js() {
	wp_enqueue_script( 'great_outdoors_customizer', get_template_directory_uri() . '/js/dist/customizer.min.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'great_outdoors_customize_preview_js' );

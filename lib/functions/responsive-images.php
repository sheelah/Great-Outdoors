<?php
/**
 * Get image sizes for use with Picturefill within posts
 * http://www.elegantthemes.com/blog/tips-tricks/integrate-picturefill-with-wordpress-and-make-images-responsive
 */

if ( ! function_exists( 'great_outdoors_get_image_sizes' ) ) :
	function great_outdoors_get_image_sizes( $attachment_id ) {
		$sizes = array( 'small-thumb', 'medium', 'large' );
		$arr = array();
		$get_sizes = wp_get_attachment_metadata( $attachment_id );

		foreach( $sizes as $size ) {
			$image_src = wp_get_attachment_image_src( $attachment_id, $size );

			if ( array_key_exists( $size, $get_sizes['sizes'] ) ) {
				$image_width = $get_sizes['sizes'][$size]['width'];
				$arr[] = $image_src[0] . ' ' . $image_width . 'w';
			}
		}

		return implode(', ', $arr);
	}
endif;

if ( ! function_exists( 'great_outdoors_image_alt' ) ) :
	function great_outdoors_get_img_alt( $attachment_id ) {
		$alt_text = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
		if ( ! $alt_text ) {
			// Use image title instead if image alt isn't set for an image
			$alt_text = esc_html( get_the_title($attachment_id) );
		}
		return $alt_text;
	}
endif;


if ( ! function_exists( 'great_outdoors_responsive_insert_header_image' ) ) :
	function great_outdoors_responsive_insert_header_image( $post_id ) {
		$attachment_id = get_post_thumbnail_id( $post_id );
		$srcsets = great_outdoors_get_image_sizes( $attachment_id );

		return
		'<div class="featured-image">'
		. '<div class="gradient-overlay">'
    	. '<img sizes="100vw" srcset="'
		. $srcsets . '" alt="'
		. great_outdoors_get_img_alt( $attachment_id )
		. '"></div></div>';
	}
endif;

if ( ! function_exists( 'great_outdoors_responsive_insert_image' ) ) :
	/**
	 * Use responsive images to display an image in a post or page.
	 *
	 * @param $atts
	 * @return string
	 */
	function great_outdoors_responsive_insert_image( $atts ) {
		extract( shortcode_atts( array(
			'id'    => 1,
			'caption' => ''
		), $atts ) );

		$srcsets = great_outdoors_get_image_sizes( $id );

		return '<figure>
    	<img sizes="(min-width: 1200px) 70vw, 100vw" srcset="'
		. $srcsets . '" alt="'
		. great_outdoors_get_img_alt( $id ) . '">
    	<figcaption class="et_pb_text et_pb_text_align_center">' . $caption . '</figcaption></figure>';

	}
endif;
add_shortcode( 'resp_image', 'great_outdoors_responsive_insert_image' );

if ( ! function_exists( 'great_outdoors_responsive_editor_filter' ) ) :
	/**
	 * Filter out the media editor output to insert our created shortcode instead. This
	 * will also get the media editor to include the image ID.
	 *
	 * @param $html
	 * @param $id
	 * @param $caption
	 * @param $title
	 * @param $align
	 * @param $url
	 * @return string
	 */
	function great_outdoors_responsive_editor_filter($html, $id, $caption, $title, $align, $url) {
		return "[resp_image id='$id' caption='" . $caption . "' ]";
	}
endif;
add_filter('image_send_to_editor', 'great_outdoors_responsive_editor_filter', 10, 9);

if ( ! function_exists( 'great_outdoors_add_featured_image_body_class' ) ) :
	/**
	 * Add body class for featured images if a post thumbnail is available for a post.
	 *
	 * @param $classes
	 * @return array
	 */
function great_outdoors_add_featured_image_body_class( $classes ) {
	global $post;
	if ( isset ( $post->ID ) ) {
		if ( is_singular( array( 'post', 'page' ) ) || ( !is_paged() && is_home() ) ) {
			if ( has_post_thumbnail( $post->ID ) ) {
				$classes[] = 'has-featured-image';
			}
		}
	}
	return $classes;
}
endif;
add_filter( 'body_class', 'great_outdoors_add_featured_image_body_class' );


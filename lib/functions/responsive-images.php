<?php
/**
 * Get image sizes for use with Picturefill within posts
 * http://www.elegantthemes.com/blog/tips-tricks/integrate-picturefill-with-wordpress-and-make-images-responsive
 */

if ( ! function_exists( 'great_outdoors_get_image_sizes' ) ) :
	function great_outdoors_get_image_sizes( $attachment_id ) {
		$sizes = array( 'small-thumb', 'medium', 'large', 'full' );
		$image_sizes = array();
		$get_sizes = wp_get_attachment_metadata( $attachment_id );
		$full_size_image_width = $get_sizes['width'];

		foreach( $sizes as $size ) {
			$image_src = wp_get_attachment_image_src( $attachment_id, $size );

			if ( array_key_exists( $size, $get_sizes['sizes'] ) ) {
				$image_width = $get_sizes['sizes'][$size]['width'];
				$image_sizes[$size] = $image_src[0] . ' ' . $image_width . 'w';
			}
		}
		// Add full-size image data to array as well
		$full_size_image_src = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
		$image_sizes['full'] = $full_size_image_src . ' ' . $full_size_image_width . 'w';
		return $image_sizes;
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

if ( ! function_exists( 'great_outdoors_set_image_transient' ) ) :
/**
 * Create image transient to avoid looping through multiple image queries every time a post loads.
 * Called any time a post is saved or updated right after existing transient is flushed.
 * Also called when no transient is set.
 *
 * - Builds an array containing the alt text and image sizes for a given image
 * - Sets a transient with the label "featured_image_[post_id] that expires in 12 months
 */
	function great_outdoors_set_image_transient($post_id, $srcsets, $alt_text) {
		$thumbnails['image_sizes'] = $srcsets;
		$thumbnails['alt_text'] = $alt_text;
		set_transient( 'featured_image_' . $post_id, $thumbnails, 52 * WEEK_IN_SECONDS );
	}
endif;

if ( ! function_exists( 'great_outdoors_reset_thumb_data_transient' ) ) :
/**
 * Reset featured image transient when the post is updated
 */
	function great_outdoors_reset_thumb_data_transient( $post_id ) {
		delete_transient( 'featured_image_' . $post_id );
		if ( has_post_thumbnail( $post_id ) ) {
			$attachment_id = get_post_thumbnail_id( $post_id );
			$srcsets = great_outdoors_get_image_sizes( $attachment_id );
			$alt_text = great_outdoors_get_img_alt( $attachment_id );
			great_outdoors_set_image_transient( $post_id, $srcsets, $alt_text );
		}
	}
endif;
add_action('save_post', 'great_outdoors_reset_thumb_data_transient');


if ( ! function_exists( 'great_outdoors_responsive_insert_header_image' ) ) :
	function great_outdoors_responsive_insert_header_image( $post_id ) {
		// Check to see if there is a transient available. If there is, use it.
		if ( false === ( $thumb_data = get_transient( 'featured_image_' . $post_id ) ) ) {
			$attachment_id = get_post_thumbnail_id( $post_id );
			$srcsets = great_outdoors_get_image_sizes( $attachment_id );
			$alt_text = great_outdoors_get_img_alt( $attachment_id );
			great_outdoors_set_image_transient( $post_id, $srcsets, $alt_text );
		}
		$thumbnail_data = get_transient( 'featured_image_' . $post_id );
		// Remove full size image since it's only for use inside posts
		unset($thumbnail_data['image_sizes']['full']);
		$thumbs = implode(', ', $thumbnail_data['image_sizes']);

		return
		'<div class="featured-image">'
		. '<div class="gradient-overlay">'
    	. '<img sizes="100vw" srcset="'
		. $thumbs . '" alt="'
		. $thumbnail_data['alt_text']
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
			'caption' => '',
			'align' => 'none'
		), $atts ) );

		$srcsets = great_outdoors_get_image_sizes( $id );
		// Remove largest thumb since it's reserved for featured images
		unset($srcsets['large']);
		$thumbs = implode(', ', $srcsets);
		$alignment = 'align'.$align;

		return '<figure class=' . '"' . 'wp-caption ' . $alignment . '"' . '>'
    	. '<img class="wp-image" sizes="(min-width: 1000px) 60vw, 100vw"'
		. 'srcset="'
		. $thumbs . '" alt="'
		. great_outdoors_get_img_alt( $id ) . '">
    	<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';

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
		return "[resp_image id='$id' align='$align' caption='" . $caption . "' ]";
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


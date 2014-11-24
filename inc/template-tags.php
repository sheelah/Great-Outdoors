<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Great Outdoors
 */

if ( ! function_exists( 'great_outdoors_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function great_outdoors_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
	$pagenum_link = html_entity_decode(get_pagenum_link());
	$query_args = array();
	$url_parts = explode('?', $pagenum_link);

	if (isset($url_parts[1])) {
		wp_parse_str($url_parts[1], $query_args);
	}

	$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
	$pagenum_link = trailingslashit($pagenum_link) . '%_%';

	$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links(array(
		'base' => $pagenum_link,
		'format' => $format,
		'total' => $GLOBALS['wp_query']->max_num_pages,
		'current' => $paged,
		'mid_size' => 2,
		'add_args' => array_map('urlencode', $query_args),
		'prev_text' => __('&larr; Previous', 'great-outdoors'),
		'next_text' => __('Next &rarr;', 'great-outdoors'),
		'type' => 'list',
	));


	if ($links) :
?>
		<nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Posts navigation', 'great-outdoors'); ?></h1>
			<?php echo $links; ?>
		</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'great_outdoors_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function great_outdoors_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'great-outdoors' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . __('Previous Post:', 'great-outdoors') . '</div>%link</div>', '%title');;
				next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . __('Next Post:', 'great-outdoors') . '</div>%link</div>', '%title');
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'great_outdoors_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function great_outdoors_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'great-outdoors' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'great-outdoors' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'great_outdoors_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function great_outdoors_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'great-outdoors' ) );
		if ( $categories_list && great_outdoors_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'great-outdoors' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'great-outdoors' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'great-outdoors' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'great-outdoors' ), __( '1 Comment', 'great-outdoors' ), __( '% Comments', 'great-outdoors' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'great-outdoors' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'great_outdoors_custom_entry_footer' ) ) :
/**
 * Prints HTML with meta information and icons for the categories and tags.
 */
function great_outdoors_custom_entry_footer() {
	$category_list = get_the_category_list(__(', ', 'great-outdoors'));
	// Print categories
	if (great_outdoors_categorized_blog() && $category_list ) {
		echo '<div class="category-list">' . '<i class="fa fa-folder-open"></i>' . $category_list . '</div>';
	}

    // Print tags
	echo '<div class="tag-list">';
	echo get_the_tag_list('<i class="fa fa-tag"></i>', ', ', '');
	echo '</div><!-- .tag-list -->';

	edit_post_link( __( 'Edit', 'great-outdoors' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function great_outdoors_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'great_outdoors_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'great_outdoors_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so great_outdoors_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so great_outdoors_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'great_outdoors_create_primary_column' ) ) :
/**
 * Create the main column in foundation, with width depending on whether the sidebar is active.
 *
 */
function great_outdoors_create_primary_column() {
	$column = '<div class="medium-8 columns" data-equalizer-watch>';
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$column = '<div class="small-12 columns">';
	}
	return $column;
	}
endif;

/**
 * Flush out the transients used in great_outdoors_categorized_blog.
 */
function great_outdoors_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'great_outdoors_categories' );
}
add_action( 'edit_category', 'great_outdoors_category_transient_flusher' );
add_action( 'save_post',     'great_outdoors_category_transient_flusher' );

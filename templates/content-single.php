<?php
/**
 * @package Great Outdoors
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ):
		echo great_outdoors_responsive_insert_header_image( get_post_thumbnail_id ($post->ID ) );
	endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php great_outdoors_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'great-outdoors' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list(__(', ', 'great-outdoors'));

		if (great_outdoors_categorized_blog()) {
			echo '<div class="category-list">' . '<i class="fa fa-folder-open"></i>' . $category_list . '</div>';
		}
		?>

		<div class="tag-list">
		<?php
		echo get_the_tag_list('<i class="fa fa-tag"></i>', ', ', '');
		?>
		</div><!-- .tag-list -->
		<?php edit_post_link( __( 'Edit', 'great-outdoors' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

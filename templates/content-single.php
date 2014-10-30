<?php
/**
 * @package Great Outdoors
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php great_outdoors_posted_on(); ?>
			<?php
			if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) {
				echo '<span class="comments-link">';
				comments_popup_link(
					__('Leave a comment', 'great-outdoors'),
					__('1 Comment', 'great-outdoors'),
					__('% Comments', 'great-outdoors'));
				echo '</span>';
			}
			?>
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
		if (great_outdoors_categorized_blog()) {
			echo '<div class="category-list">';

			echo great_outdoors_custom_category_list();
		}
		?>
		</div><!-- .category-list -->
		<div class="tag-list">
		<?php
		echo get_the_tag_list('<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>');
		?>
		</div><!-- .tag-list -->
		<?php edit_post_link( __( 'Edit', 'great-outdoors' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
/**
 * @package Great Outdoors
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// Display a thumb tack in the top right hand corner if this post is sticky
		if (is_sticky()) {
			echo '<i class="fa fa-thumb-tack sticky-post"></i>';
		}
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list(__(', ', 'great-outdoors'));

		if (great_outdoors_categorized_blog() && !is_front_page() ) {
			echo '<div class="category-list">' . $category_list . '</div>';
		}
		?>

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php great_outdoors_posted_on(); ?>
				<?php
				if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) {
					echo '<span class="comments-link">';
					comments_popup_link(
						__('Leave a comment', 'great-outdoors'), __('1 Comment', 'great-outdoors'), __('% Comments', 'great-outdoors'));
					echo '</span>';
				}
				?>
				<?php edit_post_link(__('Edit', 'great-outdoors'), '<span class="edit-link">', '</span>'); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	if ( $wp_query->current_post == 0 && !is_paged() && is_front_page() ) {
		echo '<div class="entry-content">';
		the_content( __('', 'great-outdoors') );
		echo '</div>';
		echo '<footer class="entry-footer continue-reading">';
		echo '<a href="' . get_permalink() . '" title="' . _x('Read ', 'First part of "Read *article title* in title tag of Read more link', 'great-outdoors') . get_the_title() . '" rel="bookmark">' . __('Read <span aria-hidden="true">the article</span>', 'great-outdoors') . '<i class="fa fa-arrow-circle-o-right"></i><span class="screen-reader-text"> ' . get_the_title() . '<span></a>';
		echo '</footer><!-- .entry-footer -->';
	}
	else {
		?>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
		<footer class="entry-footer continue-reading">
			<?php echo '<a href="' . get_permalink() . '" title="'
				. __('Continue Reading ', 'great-outdoors') . get_the_title()
				. '" rel="bookmark">'
				. __('Continue Reading', 'great-outdoors')
				. '<i class="fa fa-arrow-circle-o-right"></i>'
				.'<span class="screen-reader-text"> '
				. get_the_title() . '<span></a>'; ?>
		</footer><!-- .entry-footer -->
	<?php } ?>

</article><!-- #post-## -->

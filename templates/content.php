<?php
/**
 * @package Great Outdoors
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-post-listing'); ?>>

	<div class="hide-for-small-only medium-4 large-3 large-push-1 columns">
	<?php if ( has_post_thumbnail() ) {
		echo '<a href="' . get_permalink() . '" title="'.  __('Click to read ', 'great-outdoors') . get_the_title()
			. '" rel="bookmark">';
		echo the_post_thumbnail( 'thumbnail', 'class=index-thumbnail-image' );
		echo '</a>';
	}
	?>
	</div><!-- .columns -->

	<div class="medium-8 columns">
		<header class="entry-header">
		<?php
		// Display a thumb tack in the top right hand corner if this post is sticky
		if (is_sticky()) {
			echo '<i class="fa fa-thumb-tack sticky-post"></i>';
		}
		?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

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
		if ( $wp_query->current_post == 0 && !is_paged() && is_home() ) {
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

	</div><!-- .columns -->
</article><!-- #post-## -->

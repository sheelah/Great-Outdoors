<?php
/**
 * @package Great Outdoors
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="hide-for-small-only medium-4 large-3 large-push-1 columns">
	</div><!-- .columns -->

	<div class="medium-8 columns">
		<header class="entry-header">

		<?php
		// Display a thumb tack in the top right hand corner if this post is sticky
		if (is_sticky()) {
			echo '<i class="fa fa-thumb-tack sticky-post"></i>';
		}
		?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php great_outdoors_posted_on(); ?>
				<?php edit_post_link(__('Edit', 'great-outdoors'), '<span class="edit-link">', '</span>'); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

		</footer><!-- .entry-footer -->
	</div><!-- .columns -->
</article><!-- #post-## -->

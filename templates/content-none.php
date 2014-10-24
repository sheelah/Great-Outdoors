<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Great Outdoors
 */
?>

<section class="<?php if (is_404()) {
	echo 'error-404';
} else {
	echo 'no-results';
} ?> not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			if ( is_404() ) {
				_e( 'Page not available', 'great-outdoors' );
			} else if ( is_search() ) {
				/* translators: %s = search query */
				printf( __( 'Nothing found for %s', 'great-outdoors' ), '<em>' . get_search_query() . '</em>' );
			} else {
				_e( 'Nothing Found', 'great-outdoors' );
			}
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'great-outdoors' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_404() ) : ?>

			<p><?php _e(' You seem to be lost. To find what you are looking for check out the most recent articles below or try a search:', 'great-outdoors' ); ?></p>
			<?php get_search_form(); ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'great-outdoors' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'great-outdoors' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->

	<?php
	if ( is_404() || is_search() ) {
		?>
		<header class="page-header"><h1 class="page-title">
				<?php _e( 'Most Recent Posts', 'great-outdoors' ); ?></h1></header>
		<?php
		// Get the 6 latest posts
		$args = array(
			'posts_per_page' => 6
		);

		$latest_posts_query = new WP_Query($args);

		// The Loop
		if ($latest_posts_query->have_posts()) {
			while ($latest_posts_query->have_posts()) {

				$latest_posts_query->the_post();
				// Get the standard index page content
				get_template_part('templates/content', get_post_format());
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	?>

</section><!-- .no-results -->

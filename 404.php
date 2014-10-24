<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Great Outdoors
 */

get_header(); ?>

	<div class="row" data-equalizer>
		<div class="large-9 medium-8 columns" data-equalizer-watch>
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php get_template_part('templates/content', 'none'); ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .columns -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

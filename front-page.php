<?php
/**
 * Template Name: Foo Page
 *
 * @package Great Outdoors
 */

get_header(); ?>

<div class="row" data-equalizer>
	<div class="small-12 columns" data-equalizer-watch>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .columns -->

	<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages.
 *
 * @package Great Outdoors
 */

get_header(); ?>

	<div class="row" data-equalizer>
		<?php echo great_outdoors_create_primary_column(); ?>
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'great-outdoors' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->

						<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'templates/content', 'search' );
								?>

							<?php endwhile; ?>

						<?php great_outdoors_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'templates/content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</section><!-- #primary -->
		</div><!-- .columns -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

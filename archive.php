<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
							<h1 class="page-title">
								<?php
									if ( is_category() ) :
										/* translators: %s = single category title */
										printf(__('Posts in the %s category:', 'great-outdoors'), '<em>' . single_cat_title('', false) . '</em>');

									elseif ( is_tag() ) :
										/* translators: %s = single tag title */
										printf(__('Posts with the %s tag', 'great-outdoors'), '<em>' . single_tag_title('', false) . '</em>');

									elseif ( is_author() ) :
										printf( __( 'Author: %s', 'great-outdoors' ), '<span class="vcard">' . get_the_author() . '</span>' );

									/* Prepending string for day, month and year needs context in order to be individually translatable. */
									elseif (is_day()) :
										printf(_x('Posts from %s', 'archive for a day', 'great-outdoors'), '<span>' . get_the_date(_x('F j, Y', 'Daily archives date format', 'great-outdoors')) . '</span>');

									elseif (is_month()) :
										printf(_x('Posts from %s', 'archive for a month', 'great-outdoors'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'great-outdoors')) . '</span>');

									elseif (is_year()) :
										printf(_x('Posts from %s', 'archive for a year', 'great-outdoors'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'great-outdoors')) . '</span>');

									elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
										_e( 'Asides', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
										_e( 'Galleries', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
										_e( 'Images', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
										_e( 'Videos', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
										_e( 'Quotes', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
										_e( 'Links', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
										_e( 'Statuses', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
										_e( 'Audios', 'great-outdoors' );

									elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
										_e( 'Chats', 'great-outdoors' );

									else :
										_e( 'Archives', 'great-outdoors' );

									endif;
								?>
							</h1>
							<?php
								// Show an optional term description.
								$term_description = term_description();
								if ( ! empty( $term_description ) ) :
									printf( '<div class="taxonomy-description">%s</div>', $term_description );
								endif;
							?>
						</header><!-- .page-header -->

							<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>

									<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'templates/content', get_post_format() );
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

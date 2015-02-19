<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Great Outdoors
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'great-outdoors' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
		 <div class="top-bar-container contain-to-grid">
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						<h1>
							<a href="<?php echo esc_url( home_url( '/ ') ); ?>">
								<img class="logo" src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.svg' ); ?>">
							</a>
						</h1>
					</li>
					<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				</ul>
			 	<section class="top-bar-section">
					<?php foundation_top_bar_l(); ?>

					<?php foundation_top_bar_r(); ?>
				</section>
			</nav>
		</div><!-- .top-bar-container -->
		<div id="search-container" class="search-box-wrapper clearfix">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div><!-- .search-box -->
		</div><!-- #search-container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

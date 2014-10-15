<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Great Outdoors
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area large-3 medium-4 columns sidebar" data-equalizer-watch role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->

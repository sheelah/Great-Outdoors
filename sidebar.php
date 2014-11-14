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

<div id="secondary" class="widget-area sidebar medium-3 medium-offset-1 columns" role="complementary" data-equalizer-watch>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->

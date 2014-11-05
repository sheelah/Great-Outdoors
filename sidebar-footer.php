<?php
/*
 * Footer widgets.
 */

if (! is_active_sidebar('sidebar-2')) {
	return;  /* Exit if user hasn't chosen any widgets for the footer. */
}
?>

<div class="row">
	<ul id="footer-widgets" class="footer-widgets widget-area small-block-grid-1 medium-block-grid-2 large-block-grid-3" role="complementary">
		<?php dynamic_sidebar('sidebar-2'); ?>
	</ul>
</div><!-- .row -->

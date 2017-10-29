<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Great Outdoors
 */
?>

	</div><!-- .row -->
</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar('footer'); ?>
		<div class="row">
			<div class="small-12 columns">
				<p class="text-center">
					&copy; <?php echo date('Y'); ?> <a href="https://sheelahb.com">Sheelah Brennan</a>. All rights reserved.
				</p>
			</div><!-- .columns -->
		</div><!-- .row -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

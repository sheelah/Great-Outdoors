/*
 * Toggles header search on and off.
 */

jQuery(document).ready(function($) {
	var searchToggle = $(".search-toggle");
	searchToggle.on('click', function() {
		$("#search-container").slideToggle('medium', function() {
			searchToggle.toggleClass('active');
			$(".search-box .search-field").focus();
		});
	});
});


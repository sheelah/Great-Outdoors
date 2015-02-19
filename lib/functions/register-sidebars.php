<?php
/**
* Register widget area.
*
* @link http://codex.wordpress.org/Function_Reference/register_sidebar
*/

function great_outdoors_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'great-outdoors' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'great-outdoors' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Footer widgets area appearing in the site footer.', 'great-outdoors' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'great_outdoors_widgets_init' );
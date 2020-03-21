<?php

/* Add menus and menu positions */
add_theme_support('menus');
function bc_register_custom_nav_menus() {
	register_nav_menus( array(
        'top' => 'Top Menu',
        'main' => 'Main Menu',
        'sidebar' => 'Sidebar Menu',
		'footer' => 'Footer Menu'
	) );
}

add_action('init', 'bc_register_custom_nav_menus');
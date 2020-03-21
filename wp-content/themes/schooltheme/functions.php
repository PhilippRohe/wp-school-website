<?php
// Add theme supports
add_theme_support( 'custom-header' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support( 'custom-logo', array(
    'height'      => 250,
    'width'       => 250,
    'flex-width'  => true,
    'flex-height' => true,
) );


/* Load including parts here */

// Load the scripts
require get_template_directory() . '/inc/scripts.php';

// Load the breadcrumbs
require get_template_directory() . '/inc/breadcrumbs.php';

// Load the theme menus
require get_template_directory() . '/inc/theme-menu.php';

// Load the walker menu
require get_template_directory() . '/inc/walker.php';

// Load the elementor widgets
require get_template_directory() . '/inc/elementor-widgets/load-elementor-widgets.php';

// Load the custom functions
require get_template_directory() . '/inc/custom.php';
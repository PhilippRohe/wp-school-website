<?php

/* Do not allow direct access to this file */
if ( !(defined('ABSPATH')) ) exit('No direct access allowed');

/* Greetings message */
function theme_start_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Herzlich Willkommen! Viel Spaß mit dem School-Theme. Dieses Theme eigent sich optimal für Schulen und Bildungseinrichtungen!', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'theme_start_notice' );


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

// Load the wodrpess widgets
require get_template_directory() . '/inc/wp-widgets/wp-widgets.php';

// Load the custom functions
require get_template_directory() . '/inc/custom.php';

// Load the sidebars
require get_template_directory() . '/inc/sidebar.php';

// Load the custom post types
require get_template_directory() . '/inc/cpt.php';

// Load the custom meta
require get_template_directory() . '/inc/meta.php';

// Load the custom column
require get_template_directory() . '/inc/custom-column.php';

// Load the admin pages
require get_template_directory() . '/inc/admin.php';

// Load the system functions
require get_template_directory() . '/system/load.php';
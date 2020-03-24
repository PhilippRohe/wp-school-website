<?php

// Create new custom admin menu
function school_add_admin_page() {
    add_menu_page(
        'Schule', // page title
        'Theme Settings', // menu title
        'manage_options', // capability
        'school_main_settings', // url the menu leads
        'school_settings', // callable function name
        'dashicons-heart', // icon url
        59
    );
    add_submenu_page(
        'school_main_settings', // parent slug
        'main settings', // page title
        'Allgemein', // menu title
        'manage_options', // capability
        'school_main_settings', // menu slug
        'school_settings' // callable function
    );
    add_submenu_page(
        'school_main_settings', // parent slug
        'Style Settings', // page title
        'Styles', // menu title
        'manage_options', // capability
        'school_style_settings', // menu slug
        'style_settings_page' // callable function
    );
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action('admin_menu', 'school_add_admin_page');
}



/* Load the main settings page */
require get_template_directory() . '/inc/admin-page/page-main.php';

/* Load the style settings page */
require get_template_directory() . '/inc/admin-page/page-style.php';
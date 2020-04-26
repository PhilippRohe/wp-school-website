<?php

/* Initialize admin JavaScript files here */
function load_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'script-admin', get_template_directory_uri() . '/src/js/admin.js', array('wp-color-picker'), 'all', 'true');
}

/* Initialize admin css files here */
function load_admin_styles() {
    wp_enqueue_style('style-admin', get_template_directory_uri() . '/src/css/admin.css', array(), 'all');
    wp_enqueue_style( 'wp-color-picker' );
}

/* Add the styles and script */
add_action('admin_enqueue_scripts', 'load_admin_scripts');
add_action('admin_enqueue_scripts', 'load_admin_styles');
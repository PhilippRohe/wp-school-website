<?php

/* Load all styles here, including bootstrap */
function bc_load_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/src/css/vendor/bootstrap/bootstrap.min.css' );
    wp_enqueue_style('bootstrap', get_stylesheet_uri(), array('bootstrap'), 'all');
    if (file_exists( get_template_directory() . '/.dev')) {
        // Dev
        wp_enqueue_style('style', get_template_directory_uri() . '/src/css/main.css', array(), 'all');
    } else {
        // Live
        wp_enqueue_style('style', get_template_directory_uri() . '/dist/css/main-combined-min.css', array(), 'all');
    }
}

/* Load all scripts here, including jquery and bootstrap */
function bc_load_scripts() {
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/src/js/vendor/bootstrap/bootstrap.min.js', array(), 'all', 'true');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/src/js/vendor/jquery/jquery-3.4.1.min.js', array('jquery'), 'all', 'true');
    if (file_exists( get_template_directory() . '/.dev')) {
        // Dev
        wp_enqueue_script('script', get_template_directory_uri() . '/dist/js/main-combined.js', array(), 'all', 'true');
    } else {
        // Live
        wp_enqueue_script('script', get_template_directory_uri() . '/dist/js/main-combined-min.js', array(), 'all', 'true');
    }
}


/* Add the styles and script */
add_action('wp_enqueue_scripts', 'bc_load_styles');
add_action('wp_enqueue_scripts', 'bc_load_scripts');
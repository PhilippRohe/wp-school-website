<?php

/* Initialize admin JavaScript files here */
function load_slick_scripts() {
    wp_enqueue_script( 'script-slick', get_template_directory_uri() . '/inc/vendor/slick-slider/slick.min.js', array(), 'all', 'true');
}

/* Initialize admin css files here */
function load_slick_styles() {
    wp_enqueue_style('style-slick', get_template_directory_uri() . '/inc/vendor/slick-slider/slick-theme.css', array(), 'all');
}

/* Add the styles and script */
add_action('wp_enqueue_scripts', 'load_slick_scripts');
add_action('wp_enqueue_scripts', 'load_slick_styles');
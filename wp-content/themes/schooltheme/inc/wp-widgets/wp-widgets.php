<?php

// Register and load the widgets
function wpb_load_widget() {
    register_widget( 'bc_last_posts' );
    register_widget( 'bc_company' );
}

add_action( 'widgets_init', 'wpb_load_widget' );

// Require all wordpress custom widget files
require 'bc-last-posts.php';
require 'bc-company.php';
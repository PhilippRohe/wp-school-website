<?php

/* Remove some basic customization options */
function remove_customizer_sections() {     
    global $wp_customize;
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'colors' );
} 

add_action( 'customize_register', 'remove_customizer_sections', 11 );
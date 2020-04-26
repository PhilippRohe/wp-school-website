<?php

function schooltheme_customize_register_main( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'main_font' , array(
        'default'   => 'baloo2-regular',
        'transport' => 'refresh',
    ));

    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_main' , array(
        'title'      => __( 'Schooltheme', 'schooltheme' ),
        'priority'   => 1,
    ));
    

    /* Add the controls here */
    $wp_customize->add_control( 'font_main',
    array(
       'label' => __( 'Schriftart' ),
       'description' => esc_html__( 'Die Schrift auf der Webseite auswählen' ),
       'section'    => $prefix . 'schooltheme_section_main',
       'priority' => 10,
       'type' => 'select',
       'settings'   => $prefix . 'main_font',
       'capability' => 'edit_theme_options',
       'choices' => bc_get_all_fonts(),
       'input_attrs' => array (
          'class' => '',
          'style' => '',
          'placeholder' => '',
       ),
    ));
}

add_action( 'customize_register', 'schooltheme_customize_register_main' );


function customizer_output_main() {
    /* The prefix */
    $prefix = 'bc_';
    /* The custom CSS */
    ?>
         <style type="text/css">
             body { font-family: <?php echo bc_get_all_fonts()[get_theme_mod( $prefix . 'main_font', 'baloo2-regular')]; ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_main');
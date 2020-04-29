<?php
function schooltheme_customize_register_highlight( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'highlight_background' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'highlight_contrast' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_highlight' , array(
        'title'      => __( 'Schooltheme Highlight', 'schooltheme' ),
        'priority'   => 30,
    ));
    

    /* Add the controls here */
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_navigation', array(
        'label'      => __( 'Highlight-Farbe Hintergrund', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_highlight',
        'settings'   => $prefix . 'highlight_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_contrast', array(
        'label'      => __( 'Highlight-Farbe Kontrastfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_highlight',
        'settings'   => $prefix . 'highlight_contrast',
    )));
}

add_action( 'customize_register', 'schooltheme_customize_register_highlight' );


function customizer_output_highlight() {
    /* The prefix */
    $prefix = 'bc_';

    /* The custom CSS */
    ?>
         <style type="text/css">
             .bc--header .bc--navigation .right .navigation .big-navigation .menu-hauptmenue-container .main-menu li .subitem-link { color: <?php echo get_theme_mod( $prefix . 'navigation_color', '#fff'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_highlight');
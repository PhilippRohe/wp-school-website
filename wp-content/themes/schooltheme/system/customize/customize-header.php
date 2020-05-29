<?php
function schooltheme_customize_register_header( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'navigation_color' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'navigation_color_arrow' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'navigation_background_submenu' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'navigation_box_background' , array(
        'default'   => 'rgba(0,0,0,0.5)',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'navigation_box_color' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'border_bottom_color' , array(
        'default'   => 'rgb(61, 61, 61)',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'post_header_background' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    /*
    $wp_customize->add_setting( $prefix . 'navigation_box_transparency' , array(
        'default'   => '75',
        'transport' => 'refresh',
    ));
    */

    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_header' , array(
        'title'      => __( 'Schooltheme Header', 'schooltheme' ),
        'priority'   => 30,
    ));
    

    /* Add the controls here */
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_navigation', array(
        'label'      => __( 'Navigation Schritfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'navigation_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_navigation_arrow', array(
        'label'      => __( 'Dropdown Icon Farbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'navigation_color_arrow',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_navigation_submenu', array(
        'label'      => __( 'Navigation Hintergrund', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'navigation_background_submenu',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_navigation_box', array(
        'label'      => __( 'Box Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'navigation_box_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_navigation_box', array(
        'label'      => __( 'Box Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'navigation_box_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_border_bottom', array(
        'label'      => __( 'Rahmenfarbe unten', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'border_bottom_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_post_background', array(
        'label'      => __( 'Header Beitragsseiten Hintergrund', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_header',
        'settings'   => $prefix . 'post_header_background',
    )));

    /*
    $wp_customize->add_control( 'transparency_navigation_box',
    array(
       'label' => __( 'Transparenz Box' ),
       'description' => esc_html__( 'Die Transparenz der Box, angegeben von 0 bis 100 in Prozent (z.B. 75)' ),
       'section'    => $prefix . 'schooltheme_section_header',
       'priority' => 10,
       'type' => 'text',
       'settings'   => $prefix . 'navigation_box_transparency',
       'capability' => 'edit_theme_options',
       'input_attrs' => array (
          'class' => '',
          'style' => '',
          'placeholder' => '75',
       ),
    ));
    */
}

add_action( 'customize_register', 'schooltheme_customize_register_header' );


function customizer_output_header() {
    /* The prefix */
    $prefix = 'bc_';

    /* The custom CSS */
    ?>
         <style type="text/css">
             .bc--header .bc--navigation .right .navigation .big-navigation .menu-hauptmenue-container .main-menu li .subitem-link { color: <?php echo get_theme_mod( $prefix . 'navigation_color', '#fff'); ?>; }
             .bc--header .bc--navigation .right .navigation .big-navigation .menu-hauptmenue-container .main-menu li:hover .sub-menu-container .sub-menu li a { color: <?php echo get_theme_mod( $prefix . 'navigation_color', '#fff'); ?>; }

             .bc--header .bc--navigation .right .navigation .big-navigation .menu-hauptmenue-container .main-menu li .subitem-link span  { color: <?php echo get_theme_mod( $prefix . 'navigation_color_arrow', '#fff'); ?>; }

             .bc--header .bc--navigation .right .navigation .big-navigation .menu-hauptmenue-container .main-menu li:hover .sub-menu-container  { background: <?php echo get_theme_mod( $prefix . 'navigation_background_submenu', '#3d3d3d'); ?>; }
             
             .bc--header .bc--navigation .action-boxes .row .box  { background: <?php echo get_theme_mod( $prefix . 'navigation_box_background', '#3d3d3d'); ?>80; }
             .bc--header .bc--navigation .action-boxes .row .box:hover  { background: <?php echo get_theme_mod( $prefix . 'navigation_box_background', '#3d3d3d'); ?>; }

             .bc--header .bc--navigation .action-boxes .row .box p  { color: <?php echo get_theme_mod( $prefix . 'navigation_box_color', '#fff'); ?>; }
             .bc--header .bc--navigation .action-boxes .row .box span  { color: <?php echo get_theme_mod( $prefix . 'navigation_box_color', '#fff'); ?>; }
             .bc--header .bc--navigation .action-boxes .row .box  { border-color: <?php echo get_theme_mod( $prefix . 'navigation_box_color', '#fff'); ?>; }
         
             .bc--header .bc--navigation { border-color: <?php echo get_theme_mod( $prefix . 'border_bottom_color', 'rgb(61, 61, 61)'); ?>; }
             .bc--header.single-page .bc--navigation { background: <?php echo get_theme_mod( $prefix . 'post_header_background', '#fff'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_header');
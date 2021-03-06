<?php
function schooltheme_customize_register_background_colors( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'body_background' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'body_background_post' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'topbar_background' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'header_background' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_setting( $prefix . 'breadcrumbs_background' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'main_background' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'footer_background' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'mobile_menu_background' , array(
        'default'   => '#3d3d3d',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'post_header_background' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));


    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_backgrounds' , array(
        'title'      => __( 'Schooltheme Hintergrundfarben', 'schooltheme' ),
        'priority'   => 30,
    ));
    
    /* Add the controls here */
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_body', array(
        'label'      => __( 'Body Hintergrundfarbe (Elementor Seite)', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'body_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_body_post', array(
        'label'      => __( 'Body Hintergrundfarbe (Normale Seite)', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'body_background_post',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_topbar', array(
        'label'      => __( 'Topmenü Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'topbar_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_header', array(
        'label'      => __( 'Header Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'header_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_breadcrumbs', array(
        'label'      => __( 'Breadcrumbs Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'breadcrumbs_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_main', array(
        'label'      => __( 'Main Container Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'main_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_footer', array(
        'label'      => __( 'Footer Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'footer_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_mobile_menu', array(
        'label'      => __( 'Mobiles Menü Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'mobile_menu_background',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'background_post_header', array(
        'label'      => __( 'Beitragsseite Header Hintergrundfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_backgrounds',
        'settings'   => $prefix . 'post_header_background',
    )));
}

add_action( 'customize_register', 'schooltheme_customize_register_background_colors' );


function customizer_output_background() {
    /* The prefix */
    $prefix = 'bc_';

    /* The custom CSS */
    ?>
         <style type="text/css">
             body { background: <?php echo get_theme_mod( $prefix . 'body_background', '#fff'); ?>; }
             .bc--header .bc--topmenu { background: <?php echo get_theme_mod( $prefix . 'topbar_background', '#3d3d3d'); ?>; }
             .bc--header { background: <?php echo get_theme_mod( $prefix . 'header_background', '#3d3d3d'); ?>; }
             .bc--breadcrumbs { background: <?php echo get_theme_mod( $prefix . 'breadcrumbs_background', '#3d3d3d'); ?>; }
            body .bc--main { background: <?php echo get_theme_mod( $prefix . 'main_background', '#fff'); ?>; }
            body .top-image-slider { background: <?php echo get_theme_mod( $prefix . 'main_background', '#3d3d3d'); ?>; }
             .footer-main { background: <?php echo get_theme_mod( $prefix . 'footer_background', '#3d3d3d'); ?>; }
             .footer-main .row .footer-content .footer-widgets .footer-col .widget ul li .sub-menu { background: <?php echo get_theme_mod( $prefix . 'footer_background', '#3d3d3d'); ?>; }
             .bc--header.single-page .bc--navigation { background: <?php echo get_theme_mod( $prefix . 'post_header_background', '#fff'); ?> !important; }
            body:not(.elementor-page) { background: <?php echo get_theme_mod( $prefix . 'body_background_post', '#fff'); ?> !important; }
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget ul li .sub-menu { background: <?php echo get_theme_mod( $prefix . 'footer_background', '#3d3d3d'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_background');
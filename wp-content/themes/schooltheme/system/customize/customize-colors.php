<?php
function schooltheme_customize_register_font_colors( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'topbar_color' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'breadcrumbs_color' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'main_color' , array(
        'default'   => 'rgb(33, 37, 41)',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'link_color' , array(
        'default'   => 'unset',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'menu_color' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( $prefix . 'breadcrumbs_link_color' , array(
        'default'   => '#93a603',
        'transport' => 'refresh',
    ));


    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_colors' , array(
        'title'      => __( 'Schooltheme Schriftfarben', 'schooltheme' ),
        'priority'   => 30,
    ));
    
    /* Add the controls here */
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_topbar', array(
        'label'      => __( 'Topmenü Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'topbar_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_breadcrumbs', array(
        'label'      => __( 'Breadcrumbs Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'breadcrumbs_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_main', array(
        'label'      => __( 'Main Container Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'main_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_link', array(
        'label'      => __( 'Link Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'link_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_menu', array(
        'label'      => __( 'Menü Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'menu_color',
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_breadcrumbs_link', array(
        'label'      => __( 'Menü Schriftfarbe', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_colors',
        'settings'   => $prefix . 'breadcrumbs_link_color',
    )));
}

add_action( 'customize_register', 'schooltheme_customize_register_font_colors' );


function customizer_output_colors() {
    /* The prefix */
    $prefix = 'bc_';

    /* The custom CSS */
    ?>
         <style type="text/css">
             .bc--header .bc--topmenu .left .meta-nav .box span { color: <?php echo get_theme_mod( $prefix . 'topbar_color', '#fff'); ?>; }
             .bc--header .bc--topmenu .right .top-menu ul li a { color: <?php echo get_theme_mod( $prefix . 'topbar_color', '#fff'); ?>; }
             .bc--header .bc--topmenu .right .box .search-logo { color: <?php echo get_theme_mod( $prefix . 'topbar_color', '#fff'); ?>; }
             .bc--header .bc--topmenu .right .box .search-logo { color: <?php echo get_theme_mod( $prefix . 'topbar_color', '#fff'); ?>; }

             .bc--breadcrumbs .bc--breadcrumbs-navigation .delimiter { color: <?php echo get_theme_mod( $prefix . 'breadcrumbs_color', '#fff'); ?>; }
             .bc--breadcrumbs .bc--breadcrumbs-navigation .bc--breadcrumbs-page { color: <?php echo get_theme_mod( $prefix . 'breadcrumbs_color', '#fff'); ?>; }

             body .bc--main { color: <?php echo get_theme_mod( $prefix . 'main_color', 'rgb(33, 37, 41)'); ?>; }

             body .bc--main a { color: <?php echo get_theme_mod( $prefix . 'link_color', 'unset'); ?>!important; }

             .bc--header .bc--navigation .right .navigation .big-navigation > div .main-menu li .subitem-link { color: <?php echo get_theme_mod( $prefix . 'menu_color', 'unset'); ?> !important; }

             .bc--breadcrumbs .bc--breadcrumbs-navigation a { color: <?php echo get_theme_mod( $prefix . 'breadcrumbs_link_color', '#93a603'); ?> !important; }
        </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_colors');
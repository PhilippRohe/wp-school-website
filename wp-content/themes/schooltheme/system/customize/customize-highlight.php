<?php
function schooltheme_customize_register_highlight( $wp_customize ) {
    /* Prefix */
    $prefix = 'bc_';


    /* Add the settings here */
    $wp_customize->add_setting( $prefix . 'highlight_background' , array(
        'default'   => '#4dcc82',
        'transport' => 'refresh',
    ));

    /* Add the section here */
    $wp_customize->add_section( $prefix . 'schooltheme_section_highlight' , array(
        'title'      => __( 'Schooltheme Highlight', 'schooltheme' ),
        'priority'   => 30,
    ));
    

    /* Add the controls here */
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . 'color_navigation', array(
        'label'      => __( 'Highlight-Farbe setzen', 'schooltheme' ),
        'section'    => $prefix . 'schooltheme_section_highlight',
        'settings'   => $prefix . 'highlight_background',
    )));
}

add_action( 'customize_register', 'schooltheme_customize_register_highlight' );


function customizer_output_highlight() {
    /* The prefix */
    $prefix = 'bc_';

    /* The custom CSS */
    ?>
         <style type="text/css">
            .bc--header .bc--topmenu .left .meta-nav .box:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--topmenu .right .box:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-search--form .search-button { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-search--form .search-button { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .corner-container { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-phone .icon { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-address .icon { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-mail .icon { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .top-arrow-container:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget ul li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--topmenu .right>div ul li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--last-posts .bc-footer--post:hover .bc--foter-post-right h3 { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--navigation .action-boxes .row .box:hover .right-box i { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--navigation .right .navigation .big-navigation>div .main-menu li:hover .subitem-link { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>;}
            .bc--header .bc--navigation .right .navigation .big-navigation>div .main-menu li:hover .subitem-link span { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--navigation .right .navigation .big-navigation>div .main-menu li:hover .sub-menu-container .sub-menu li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            ::selection { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>;}
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget .calendar_wrap table tfoot tr td a { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>;}
            .footer-main .row .footer-copyright .row .right-copy>div ul li a:hover { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>;}
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget ul li .sub-menu li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget ul li .children li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .small-navigation .meta-nav .box:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .bc--navigation .action-boxes .row .box:hover .left-box p:first-child { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-address:hover address a span:first-child { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-mail:hover a p { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc-footer--company .company-widget--body .company-phone:hover a p { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .small-navigation>div ul li:hover a span { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--breadcrumbs .bc--breadcrumbs-navigation a { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .comment-container .row form p .comment-send-button:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .single-content-area .post-single .post-head .head-right .download-icon { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .single-content-area .teacher-single .content .content-right .subject-list li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .container--search-results .container--search-results-head h1 b { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .archive-container .row .archive--inner h1 b { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .archive-container .row .archive--inner article .post-inner a .view-button { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .bc--header .small-navigation>div ul li.open a span { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .comment-container .row .comments-headline span { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .container--search-results .container--search-results-body .search--results-content .search--results-single .box-body a .post-link-button { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .single-content-area .teacher-single .content .content-right .subject-list li:hover { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .last-news--section .row .articles .single-article .article-body .link div { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .last-news--section .row .articles .single-article .article-head { border-color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .downloads--section .all-downloads .download-box .top .left-side a .download-icon { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            #cookie-law-info-again { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?> !important; }
            .wpcf7 form p input[type~="submit"] { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            body::-webkit-scrollbar-thumb { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            figcaption::-webkit-scrollbar-thumb { background: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .wysiwyg--section .row p a { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .footer-main .row .footer-copyright .row .right-copy a i { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            div.wpcf7-validation-errors { border-color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .single-content-area .post-single .content .post-meta-list .list ul li a:hover { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .downloads--section .all-downloads .download-box .top .right-side .categories-list li a:hover { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
            .footer-main .row .footer-content .footer-widgets .footer-col ul .widget .calendar_wrap table tbody tr td a { color: <?php echo get_theme_mod( $prefix . 'highlight_background', '#4dcc82'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'customizer_output_highlight');
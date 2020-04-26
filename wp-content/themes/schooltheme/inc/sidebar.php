<?php
/* Register sidebars (widget area) */
function bc_register_widget_area() {
    
    register_sidebar( array(
        'name'          => 'Footer Level 1',
        'id'            => 'footer-one',
        'description'   => 'Footer level 1',
        'class'         => 'footer-one',
        'before_widget' => '<li id="%1$s" class="col-12 widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Level 2',
        'id'            => 'footer-two',
        'description'   => 'Footer level 2',
        'class'         => 'footer-two',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Level 3',
        'id'            => 'footer-three',
        'description'   => 'Footer level 3',
        'class'         => 'footer-three',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Level 4',
        'id'            => 'footer-four',
        'description'   => 'Footer level 4',
        'class'         => 'footer-four',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}

add_action('widgets_init', 'bc_register_widget_area');
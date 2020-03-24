<?php

/* Register for style settings page */
function style_custom_theme_settings() {

    /* Options and settings on main settings page */
    register_setting( 'style_settings_group','style_settings_test' );

    /* Sections for main page */
    add_settings_section('style_theme_options', 'Theme Options', 'style_theme_main_options_render', 'school_style_settings' );

    /* Fields for main page */
    add_settings_field('style-settings-test', 'Test Settings', 'style_theme_options_test', 'school_style_settings', 'style_theme_options');
    
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action( 'admin_init', 'style_custom_theme_settings');
}

/* Main settings page */
function style_settings_page() {
    ?>
    <h1>Style Einstellungen im Theme ändern</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'style_settings_group' ); ?>
        <?php do_settings_sections( 'school_style_settings' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

/* All single settings here */
function style_theme_main_options_render() {
    echo 'Ändere verschiedene Einstellunge zum Style hier';
}

function style_theme_options_test() {
    echo 'test';
}
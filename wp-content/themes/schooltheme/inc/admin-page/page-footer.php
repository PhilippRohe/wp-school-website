<?php

/* Register for footer settings page */
function footer_custom_theme_settings() {

    /* Options and settings on contact settings page */
    register_setting( 'footer_settings_group','footer_text_copyright' );

    /* Sections for contact settings page */
    add_settings_section('footer_theme_options_boxes', 'Footer der Webseite', 'footer_theme_boxes_options_render', 'school_footer_settings' );

    /* Fields for contact settings page */
    add_settings_field('footer-settings-box-one', 'Footer Text', 'footer_text_copyright_function', 'school_footer_settings', 'footer_theme_options_boxes');
    
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action( 'admin_init', 'footer_custom_theme_settings');
}

/* Main settings page */
function footer_settings_page() {
    ?>
    <h1>Footer Einstellungen ändern</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'footer_settings_group' ); ?>
        <?php do_settings_sections( 'school_footer_settings' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

/* All single settings here */
function footer_theme_boxes_options_render() {
    ?>
    <p>Einstellungen im Footer durchführen</p>
    <?php
}

function footer_text_copyright_function() {
    $footer_text = esc_attr(get_option( 'footer_text_copyright' )); ?>
    <div class="footer-text-container">
        <input type="text" name="footer_text_copyright" class="footer-text" value="<?php echo $footer_text; ?>">
    </div>
    <?php
}
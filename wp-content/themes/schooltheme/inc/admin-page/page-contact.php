<?php

/* Register for contact settings page */
function contact_custom_theme_settings() {

    /* Options and settings on contact settings page */
    register_setting( 'contact_settings_group','contact_settings_mail' );
    register_setting( 'contact_settings_group','contact_settings_phone' );
    register_setting( 'contact_settings_group','contact_settings_fax' );
    register_setting( 'contact_settings_group','contact_settings_map' );
    register_setting( 'contact_settings_group','contact_settings_geo_lang' );
    register_setting( 'contact_settings_group','contact_settings_geo_lat' );
    register_setting( 'contact_settings_group','contact_settings_facebook' );
    register_setting( 'contact_settings_group','contact_settings_instagram' );

    /* Sections for contact settings page */
    add_settings_section('contact_theme_options_main', 'Einstellungen zu Kontaktdaten', 'contact_theme_main_options_render', 'school_contact_settings' );
    add_settings_section('contact_theme_options_map', 'Mapdaten', 'contact_theme_main_options_render', 'school_contact_settings' );
    add_settings_section('contact_theme_options_social', 'Social Media', 'contact_theme_main_options_render', 'school_contact_settings' );

    /* Fields for contact settings page */
    add_settings_field('contact-settings-mail', 'E-Mail', 'contact_theme_options_mail', 'school_contact_settings', 'contact_theme_options_main');
    add_settings_field('contact-settings-phone', 'Telefon', 'contact_theme_options_phone', 'school_contact_settings', 'contact_theme_options_main');
    add_settings_field('contact-settings-fax', 'Fax', 'contact_theme_options_fax', 'school_contact_settings', 'contact_theme_options_main');
    add_settings_field('contact-settings-map', 'Map', 'contact_theme_options_map', 'school_contact_settings', 'contact_theme_options_map');
    add_settings_field('contact-settings-geo', 'Geolocation', 'contact_theme_options_geo', 'school_contact_settings', 'contact_theme_options_map');
    add_settings_field('contact-settings-facebook', 'Facebook', 'contact_theme_options_facebook', 'school_contact_settings', 'contact_theme_options_social');
    add_settings_field('contact-settings-instagram', 'Instagram', 'contact_theme_options_instagram', 'school_contact_settings', 'contact_theme_options_social');
    
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action( 'admin_init', 'contact_custom_theme_settings');
}

/* Main settings page */
function contact_settings_page() {
    ?>
    <h1>Kontakt Einstellungen ändern</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'contact_settings_group' ); ?>
        <?php do_settings_sections( 'school_contact_settings' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

/* All single settings here */
function contact_theme_main_options_render() {
}

function contact_theme_options_mail() {
    $email = esc_attr(get_option( 'contact_settings_mail' )); ?>
    <div class="admin--contact-mail">
        <input type="email" name="contact_settings_mail" class="admin-input admin-contact-email" value="<?php echo $email; ?>" id="admin_contact_email">
    </div>
    <?php
}
function contact_theme_options_phone() {
    $phone = esc_attr(get_option( 'contact_settings_phone' )); ?>
    <div class="admin--contact-phone">
        <input type="tel" name="contact_settings_phone" class="admin-input admin-contact-phone" value="<?php echo $phone; ?>" id="admin_contact_phone">
    </div>
    <?php
}
function contact_theme_options_fax() {
    $fax = esc_attr(get_option( 'contact_settings_fax' )); ?>
    <div class="admin--contact-fax">
        <input type="tel" name="contact_settings_fax" class="admin-input admin-contact-fax" value="<?php echo $fax; ?>" id="admin_contact_fax">
    </div>
    <?php
}
function contact_theme_options_map() {
    $map = esc_attr(get_option( 'contact_settings_map' )); ?>
    <div class="admin--contact-map">
        <label for="contact_settings_map">Relativer Seitenpfad zur Map eintragen:</label>
        <input type="text" name="contact_settings_map" class="admin-input admin-contact-map" value="<?php echo $map; ?>" id="admin_contact_map">
    </div>
    <?php
}
function contact_theme_options_geo() {
    $geo_lang = esc_attr(get_option( 'contact_settings_geo_lang' ));
    $geo_lat = esc_attr(get_option( 'contact_settings_geo_lat' )); ?>
    <div class="admin--contact-geo">
        <label for="admin_contact_geo_lang">Langitute:</label>
        <input type="text" name="contact_settings_geo_lang" class="admin-input admin-contact-geo-lang" value="<?php echo $geo_lang; ?>" id="admin_contact_geo_lang">
        <label for="admin_contact_geo_lat">Latitute:</label>
        <input type="text" name="contact_settings_geo_lat" class="admin-input admin-contact-geo-lat" value="<?php echo $geo_lat; ?>" id="admin_contact_geo_lat">
    </div>
    <?php
}

function contact_theme_options_facebook() {
    $facebook = esc_attr(get_option( 'contact_settings_facebook' )); ?>
    <div class="admin--contact-facebook">
        <p>Bitte den Link zur Facebookseite angeben:</p>
        <input type="tel" name="contact_settings_facebook" class="admin-input admin-contact-facebook" value="<?php echo $facebook; ?>" id="admin_contact_facebook">
    </div>
    <?php
}
function contact_theme_options_instagram() {
    $instagram = esc_attr(get_option( 'contact_settings_instagram' )); ?>
    <div class="admin--contact-instagram">
        <p>Bitte den Namen auf Instagram angeben:</p>
        <input type="tel" name="contact_settings_instagram" class="admin-input admin-contact-instagram" value="<?php echo $instagram; ?>" id="admin_contact_instagram">
    </div>
    <?php
}
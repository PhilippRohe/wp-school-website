<?php

/* Register for style settings page */
function style_custom_theme_settings() {

    /* Options and settings on main settings page */
    register_setting( 'style_settings_group','style_settings_header_background' );
    register_setting( 'style_settings_group','style_settings_header_slider' );

    register_setting( 'style_settings_group','style_settings_login_color' );
    register_setting( 'style_settings_group','style_settings_login_background' );
    register_setting( 'style_settings_group','style_settings_login_image' );

    /* Sections for main page */
    add_settings_section('style_theme_options', 'Theme Options', 'style_theme_main_options_render', 'school_style_settings' );
    add_settings_section('style_theme_options', 'Login Seite', 'style_theme_main_options_render_login', 'school_style_settings_login' );

    /* Fields for main page */
    add_settings_field('style-settings-header-background', 'Header Container Hintergrund', 'style_theme_options_header_background', 'school_style_settings', 'style_theme_options');
    add_settings_field('style-settings-header-slider', 'Header Slider auswählen', 'style_theme_options_header_slider', 'school_style_settings', 'style_theme_options');

    add_settings_field('style-settings-login-color', 'Login-Seite Farbe auswählen', 'style_theme_options_login_color', 'school_style_settings_login', 'style_theme_options');
    add_settings_field('style-settings-login-background', 'Hintergrundbild Login Seite', 'style_theme_options_login_background', 'school_style_settings_login', 'style_theme_options');
    add_settings_field('style-settings-login-image', 'Logo Login Seite', 'style_theme_options_login_image', 'school_style_settings_login', 'style_theme_options');
    
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
        <?php do_settings_sections( 'school_style_settings_login' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

/* All single settings here */
function style_theme_main_options_render() {
    echo 'Ändere verschiedene allgemeine Einstellunge zum Style hier';
}

function style_theme_main_options_render_login() {
    echo 'Style Einstellungen zur Loginseite';
}


function style_theme_options_header_background() {
    $header_background_image = esc_attr(get_option( 'style_settings_header_background' ));
    if ($header_background_image == '') {
        $header_background_image = get_template_directory_uri() . '/dist/img/placeholder.png';
    }
    ?>
    <div class="admin--style-header-background" style="display: flex; flex-direction: column; max-width:384px;">
        <img style="object-fit: contain;" width="384" height="216" src="<?php echo $header_background_image; ?>">
        <input type="button" class="button-primary admin_upload_menu_logo" value="Upload Background Image" id="admin_upload_menu_logo">
        <input class="bc-menu-logo-input" type="hidden" name="style_settings_header_background" value="<?php echo $header_background_image; ?>" />
    </div>
    <input type="submit" class="button js--delete-admin-image" value="Bild entfernen" />
    <?php
}

function style_theme_options_header_slider() {
    $choosen_slider_id = esc_attr(get_option( 'style_settings_header_slider' ));
    $all_galleries = load_all_cpt_galleries();
    ?>
    <select name="style_settings_header_slider">
        <option value="-1" data-id="-1" <?php if($choosen_slider_id == '-1') {echo 'selected';} ?>>Galerie auswählen</option>
        <?php foreach($all_galleries as $gallery) {
            ?>
            <option <?php if($choosen_slider_id == $gallery[ 'id' ]) {echo 'selected';} ?> value="<?php echo $gallery[ 'id' ]; ?>" data-id="<?php echo $gallery[ 'id' ]; ?>"><?php echo $gallery[ 'title' ]; ?></option>
            <?php
        } ?>
    </select>
    <?php
}




function style_theme_options_login_color() {
    $login_color = esc_attr(get_option( 'style_settings_login_color' ));
    ?>
        <input type="text" name="style_settings_login_color" class="login-color-picker" value="<?php echo $login_color; ?>" />
    <?php
}

function style_theme_options_login_background() {
    $login_background = esc_attr(get_option( 'style_settings_login_background' ));
    if ($login_background == '') {
        $login_background = get_template_directory_uri() . '/dist/img/placeholder.png';
    }
    ?>
    <div class="admin--style-header-background" style="display: flex; flex-direction: column; max-width:384px;">
        <img style="object-fit: contain;" width="384" height="216" src="<?php echo $login_background; ?>">
        <input type="button" class="button-primary admin_upload_menu_logo" value="Upload Background Image" id="admin_upload_menu_logo">
        <input class="bc-menu-logo-input" type="hidden" name="style_settings_login_background" value="<?php echo $login_background; ?>" />
    </div>
    <input type="submit" class="button js--delete-admin-image" value="Bild entfernen" />
    <?php
}

function style_theme_options_login_image() {
    $login_image = esc_attr(get_option( 'style_settings_login_image' ));
    if ($login_image == '') {
        $login_image = get_template_directory_uri() . '/dist/img/placeholder.png';
    }
    ?>
    <div class="admin--style-header-background" style="display: flex; flex-direction: column; max-width:384px;">
        <img style="object-fit: contain;" width="384" height="216" src="<?php echo $login_image; ?>">
        <input type="button" class="button-primary admin_upload_menu_logo" value="Upload Background Image" id="admin_upload_menu_logo">
        <input class="bc-menu-logo-input" type="hidden" name="style_settings_login_image" value="<?php echo $login_image; ?>" />
    </div>
    <input type="submit" class="button js--delete-admin-image" value="Bild entfernen" />
    <?php
}
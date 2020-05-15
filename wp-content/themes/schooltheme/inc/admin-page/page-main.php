<?php 

/* Register for main settings page */
function main_custom_theme_settings_main() {

    /* Options and settings on main settings page */
    register_setting( 'main_settings_group','bc_menu_logo' );
    register_setting( 'main_settings_group','bc_enable_breadcrumbs' );
    register_setting( 'main_settings_group','bc_enable_font_awesome' );
    register_setting( 'main_settings_group','bc_enable_to_top_arrow' );

    /* Sections for main page */
    add_settings_section('main_theme_options', 'Theme Options', 'main_theme_main_options_render', 'school_main_settings' );

    /* Fields for main page */
    add_settings_field('bc-menu-logo', 'Webseiten Logo', 'main_theme_options_render_logo', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-breadcrumbs', 'Breadcrumbs nutzen', 'main_theme_options_enable_breadcrumbs', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-font-awesome', 'Font Awesome KIT Code', 'main_theme_options_render_font_awesome', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-to-top-arrow', 'Pfeil zum Hochscrollen', 'main_theme_options_render_top_arrow', 'school_main_settings', 'main_theme_options');
    
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action( 'admin_init', 'main_custom_theme_settings_main');
}

/* Main settings page */
function school_settings() {
    ?>
    <h1>Allgemeine Einstellungen im Theme ändern</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'main_settings_group' ); ?>
        <?php do_settings_sections( 'school_main_settings' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}


/* All single settings here */
function main_theme_main_options_render() {
    echo 'Wichtige Grundeinstellungen im Theme ändern';
}

function main_theme_options_render_logo() {
    $menu_logo = esc_attr(get_option( 'bc_menu_logo' ));
    if ($menu_logo == '') {
        $menu_logo = get_template_directory_uri() . '/dist/img/placeholder.png';
    }
    echo '<div class="bc-admin--logo-section" style="display: flex; flex-direction: column; max-width:384px;">';
    echo '<img style="object-fit: contain;" width="384" height="216" src="' . $menu_logo . '">';
    echo '<input type="button" class="button-primary admin_upload_menu_logo" value="Upload Menu Image" id="admin_upload_menu_logo">
    <input class="bc-menu-logo-input" type="hidden" name="bc_menu_logo" value="' . $menu_logo . '" />';
    echo '</div>';
}

function main_theme_options_enable_breadcrumbs() {
    $enable_breadcrumbs = esc_attr(get_option( 'bc_enable_breadcrumbs' ));
    ?>
         <select name="bc_enable_breadcrumbs">
            <option value="on" <?php if($enable_breadcrumbs === 'on') {echo 'selected';} ?>>Ja</option>
            <option value="off" <?php if($enable_breadcrumbs === 'off') {echo 'selected';} ?>>Nein</option>
        </select>
    <?php
}

function main_theme_options_render_font_awesome() {
    $font_awesome_code = esc_attr(get_option( 'bc_enable_font_awesome' ));
    ?>
    <input style="width: 100%;" style="width: 500px;" type="text" placeholder="Ihr Font Awesome Code" name="bc_enable_font_awesome" value="<?php echo $font_awesome_code; ?>" />
    <p>Zur Nutzung vieler Icons Registrierung auf fontawesome.com, dann Code hier eintragen (zum Beispiel: https://kit.fontawesome.com/<b style="color: red;"><u>xxxxxxxxxx</u></b>.js | Nur den Teil: xxxxxxxxxx schreiben), um die Icons sehen zu können</p>
    <?php
}

function main_theme_options_render_top_arrow() {
    $enable_top_arrow = esc_attr(get_option( 'bc_enable_to_top_arrow' ));
    ?>
    <select name="bc_enable_to_top_arrow">
        <option value="on" <?php if($enable_top_arrow === 'on') {echo 'selected';} ?>>Ja</option>
        <option value="off" <?php if($enable_top_arrow === 'off') {echo 'selected';} ?>>Nein</option>
    </select>
    <?php
}

function main_theme_options_social_footer() {
    $social_footer = esc_attr(get_option( 'bc_show_social_footer' ));
    ?>
    <select name="bc_show_social_footer">
       <option value="on" <?php if($social_footer === 'on') {echo 'selected';} ?>>Yes</option>
       <option value="off" <?php if($social_footer === 'off') {echo 'selected';} ?>>No</option>
   </select>
    <?php
}
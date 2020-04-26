<?php 

/* Register for main settings page */
function main_custom_theme_settings_main() {

    /* Options and settings on main settings page */
    register_setting( 'main_settings_group','bc_menu_logo' );
    register_setting( 'main_settings_group','bc_menu_logo_type' );
    register_setting( 'main_settings_group','bc_test_field' );
    register_setting( 'main_settings_group','bc_enable_breadcrumbs' );
    register_setting( 'main_settings_group','bc_footer_text_left' );
    register_setting( 'main_settings_group','bc_footer_text_right' );
    register_setting( 'main_settings_group','bc_enable_font_awesome' );
    register_setting( 'main_settings_group','bc_enable_to_top_arrow' );
    register_setting( 'main_settings_group','bc_clean_input' );
    register_setting( 'main_settings_group','bc_show_social_footer' );
    register_setting( 'main_settings_group','bc_choose_slider_header' );

    /* Sections for main page */
    add_settings_section('main_theme_options', 'Theme Options', 'main_theme_main_options_render', 'school_main_settings' );

    /* Fields for main page */
    add_settings_field('bc-menu-logo', 'Menu Logo Image', 'main_theme_options_render_logo', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-menu-logo-type', 'Menu Logo Type', 'main_theme_options_render_logo_type', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-test-field', 'Test Field', 'main_theme_options_render_test', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-breadcrumbs', 'Enable Breadcrumbs', 'main_theme_options_enable_breadcrumbs', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-footer-text-left', 'Footer Text Left', 'main_theme_options_render_footer_left', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-footer-text-right', 'Footer Text Right', 'main_theme_options_render_footer_right', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-font-awesome', 'Font Awesome KIT Code', 'main_theme_options_render_font_awesome', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-enable-to-top-arrow', 'Enable To Top Arrow', 'main_theme_options_render_top_arrow', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-clean-input', 'Clean input search', 'main_theme_options_clean_input', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-show-social-footer', 'Show Social Bar in Footer', 'main_theme_options_social_footer', 'school_main_settings', 'main_theme_options');
    add_settings_field('bc-choose-slider-header', 'Slider im Header auswählen', 'main_theme_options_slider_header', 'school_main_settings', 'main_theme_options');
    
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
    echo 'Change some very important Theme Options for the BananaCoding Theme';
}

function main_theme_options_render_logo() {
    $menu_logo = esc_attr(get_option( 'bc_menu_logo' ));
    echo '<div class="bc-admin--logo-section">';
    echo '<input type="button" class="button-primary" value="Upload Menu Image" id="admin_upload_menu_logo">
    <input class="bc-menu-logo-input" type="hidden" name="bc_menu_logo" value="' . $menu_logo . '" />';
    echo '<img src="' . $menu_logo . '">';
    echo '</div>';
}

function main_theme_options_render_logo_type() {
    $menu_logo_type = esc_attr(get_option( 'bc_menu_logo_type' ));
    ?>
        <select name="bc_menu_logo_type">
            <option value="none" <?php if($menu_logo_type === 'none') {echo 'selected';} ?>>None</option>
            <option value="one" <?php if($menu_logo_type === 'one') {echo 'selected';} ?>>Type 1</option>
            <option value="two" <?php if($menu_logo_type === 'two') {echo 'selected';} ?>>Type 2</option>
            <option value="three" <?php if($menu_logo_type === 'three') {echo 'selected';} ?>>Type 3</option>
        </select>
    <?php 
    echo 'Current value: ' . $menu_logo_type; 
}

function main_theme_options_enable_breadcrumbs() {
    $enable_breadcrumbs = esc_attr(get_option( 'bc_enable_breadcrumbs' ));
    ?>
         <select name="bc_enable_breadcrumbs">
            <option value="on" <?php if($enable_breadcrumbs === 'on') {echo 'selected';} ?>>Yes</option>
            <option value="off" <?php if($enable_breadcrumbs === 'off') {echo 'selected';} ?>>No</option>
        </select>
    <?php
    echo 'Current value: ' . $enable_breadcrumbs; 
}

function main_theme_options_render_test() {
    $test = esc_attr(get_option( 'bc_test_field' ));
    echo '<input type="text" placeholder="Test Field" name="bc_test_field" value="' . $test . '" />';
}

function main_theme_options_render_footer_left() {
    $text_footer_left = esc_attr(get_option( 'bc_footer_text_left' ));
    echo '
    <input style="width: 500px;" type="text" placeholder="Text Footer Left Side" name="bc_footer_text_left" value="' . $text_footer_left . '" />';
}

function main_theme_options_render_footer_right() {
    $text_footer_right = esc_attr(get_option( 'bc_footer_text_right' ));
    echo '
    <input style="width: 500px;" type="text" placeholder="Text Footer Right Side" name="bc_footer_text_right" value="' . $text_footer_right . '" />';
}

function main_theme_options_render_font_awesome() {
    $font_awesome_code = esc_attr(get_option( 'bc_enable_font_awesome' ));
    ?>
    <input style="width: 500px;" type="text" placeholder="Your Font Awesome Code" name="bc_enable_font_awesome" value="<?php echo $font_awesome_code; ?>" />
    <p>Register on Font Awesome and paste your code here (only your personal KIT code, for example: https://kit.fontawesome.com/<b style="color: red;"><u>xxxxxxxxxx</u></b>.jsm write in: xxxxxxxxxx) to make the Font Awesome icons visible</p>
    <?php
}

function main_theme_options_render_top_arrow() {
    $enable_top_arrow = esc_attr(get_option( 'bc_enable_to_top_arrow' ));
    ?>
    <select name="bc_enable_to_top_arrow">
        <option value="on" <?php if($enable_top_arrow === 'on') {echo 'selected';} ?>>Yes</option>
        <option value="off" <?php if($enable_top_arrow === 'off') {echo 'selected';} ?>>No</option>
    </select>
    <?php
    echo 'Current value: ' . $enable_top_arrow; 
}

function main_theme_options_clean_input() {
    $clean_input_enable = esc_attr(get_option( 'bc_clean_input' ));
    ?>
    <select name="bc_clean_input">
        <option value="on" <?php if($clean_input_enable === 'on') {echo 'selected';} ?>>Yes</option>
        <option value="off" <?php if($clean_input_enable === 'off') {echo 'selected';} ?>>No</option>
    </select>
    <?php
    echo 'Current value: ' . $clean_input_enable . ' | In the input search field, the user can only use characters and numbers (for security reasons)';
}

function main_theme_options_social_footer() {
    $social_footer = esc_attr(get_option( 'bc_show_social_footer' ));
    ?>
    <select name="bc_show_social_footer">
       <option value="on" <?php if($social_footer === 'on') {echo 'selected';} ?>>Yes</option>
       <option value="off" <?php if($social_footer === 'off') {echo 'selected';} ?>>No</option>
   </select>
    <?php
    echo 'Current value: ' . $social_footer; 
}

function main_theme_options_slider_header() {
    $slider_id = esc_attr(get_option( 'bc_choose_slider_header' ));
    $all_slider = load_all_cpt_galleries();
    ?>
    <select name="bc_choose_slider_header">
        <option value="-1">Slider auswählen</option>
        <?php foreach($all_slider as $slide) {
            ?>
            <option value="<?php echo $slide['id']; ?>" <?php if($slider_id == $slide['id']) {echo 'selected';} ?>><?php echo $slide['title']; ?></option>
            <?php
        } ?>
   </select>
    <?php
}
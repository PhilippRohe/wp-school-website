<?php

/* Register for header settings page */
function header_custom_theme_settings() {

    /* Options and settings on contact settings page */
    register_setting( 'header_settings_group','header_settings_box_one_text_big' );
    register_setting( 'header_settings_group','header_settings_box_one_text_small' );
    register_setting( 'header_settings_group','header_settings_box_one_link' );
    register_setting( 'header_settings_group','header_settings_box_one_icon' );

    register_setting( 'header_settings_group','header_settings_box_two_text_big' );
    register_setting( 'header_settings_group','header_settings_box_two_text_small' );
    register_setting( 'header_settings_group','header_settings_box_two_link' );
    register_setting( 'header_settings_group','header_settings_box_two_icon' );

    register_setting( 'header_settings_group','header_settings_box_three_text_big' );
    register_setting( 'header_settings_group','header_settings_box_three_text_small' );
    register_setting( 'header_settings_group','header_settings_box_three_link' );
    register_setting( 'header_settings_group','header_settings_box_three_icon' );

    /* Sections for contact settings page */
    add_settings_section('header_theme_options_boxes', 'Header Webseite - Boxen', 'header_theme_boxes_options_render', 'school_header_settings' );

    /* Fields for contact settings page */
    add_settings_field('header-settings-box-one', 'Box Nr. 1', 'header_theme_options_box_one', 'school_header_settings', 'header_theme_options_boxes');
    add_settings_field('header-settings-box-two', 'Box Nr. 2', 'header_theme_options_box_two', 'school_header_settings', 'header_theme_options_boxes');
    add_settings_field('header-settings-box-three', 'Box Nr. 3', 'header_theme_options_box_three', 'school_header_settings', 'header_theme_options_boxes');
    
}

/* Actions and call functions only if is admin */
if ( is_admin() ) {
    add_action( 'admin_init', 'header_custom_theme_settings');
}

/* Main settings page */
function header_settings_page() {
    ?>
    <h1>Header Einstellungen ändern</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'header_settings_group' ); ?>
        <?php do_settings_sections( 'school_header_settings' ); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

/* All single settings here */
function header_theme_boxes_options_render() {
    ?>
    <p>Einstellungen zu den Boxen im Header</p>
    <?php
}

function header_theme_options_box_one() {
    $box_one_text_big = esc_attr(get_option( 'header_settings_box_one_text_big' ));
    $box_one_text_small = esc_attr(get_option( 'header_settings_box_one_text_small' ));
    $box_one_link = esc_attr(get_option( 'header_settings_box_one_link' ));
    $box_one_icon = esc_attr(get_option( 'header_settings_box_one_icon' ));

    $types = array('page', 'post', 'downloads', 'events', 'teacher', 'gallery');
    $all_posts = bc_get_all_posts($types);
    ?>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-one-text-big">Text Headline: </label>
        <input style="width: 100%;" id="box-one-text-big" type="text" name="header_settings_box_one_text_big" value="<?php echo $box_one_text_big; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-one-text-small">Text Subline: </label>
        <input style="width: 100%;" id="box-one-text-small" type="text" name="header_settings_box_one_text_small" value="<?php echo $box_one_text_small; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px; display: flex; flex-direction: column;">
        <label for="box_one_link">Seite zur Verlinkung auswählen: </label>
        <?php echo $box_one_link; ?>
        <select style="width: 100%;" class="admin-input admin-contact-map" name="header_settings_box_one_link">
            <?php foreach($all_posts as $post) {
                $id = $post["id"];
                $link = $post["link"];
                $title = $post["title"];
                if ($box_one_link == $id) {
                    ?>
                    <option selected data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                } else {
                    ?>
                    <option data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                }
                ?>
                <?php
            } ?>
        </select>
    </div>
    <div class="field">
        <label for="box-one-icon">Icon auswählen (bitte Font Awesome Code eingeben, z.B. fas fa-columns):</label>
        <input style="width: 100%;" id="box-one-icon" type="text" name="header_settings_box_one_icon" value="<?php echo $box_one_icon; ?>" />
    </div>
    <?php
}

function header_theme_options_box_two() {
    $box_two_text_big = esc_attr(get_option( 'header_settings_box_two_text_big' ));
    $box_two_text_small = esc_attr(get_option( 'header_settings_box_two_text_small' ));
    $box_two_link = esc_attr(get_option( 'header_settings_box_two_link' ));
    $box_two_icon = esc_attr(get_option( 'header_settings_box_two_icon' ));

    $types = array('page', 'post', 'downloads', 'events', 'teacher', 'gallery');
    $all_posts = bc_get_all_posts($types);
    ?>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-two-text-big">Text Headline: </label>
        <input style="width: 100%;" id="box-two-text-big" type="text" name="header_settings_box_two_text_big" value="<?php echo $box_two_text_big; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-two-text-small">Text Subline: </label>
        <input style="width: 100%;" id="box-two-text-small" type="text" name="header_settings_box_two_text_small" value="<?php echo $box_two_text_small; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px; display: flex; flex-direction: column;">
        <label for="box_two_link">Seite zur Verlinkung auswählen: </label>
        <select style="width: 100%;" class="admin-input admin-contact-map" name="header_settings_box_two_link">
            <?php foreach($all_posts as $post) {
                $id = $post["id"];
                $link = $post["link"];
                $title = $post["title"];
                if ($box_two_link == $id) {
                    ?>
                    <option selected data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                } else {
                    ?>
                    <option data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                }
                ?>
                <?php
            } ?>
        </select>
    </div>
    <div class="field">
        <label for="box-two-icon">Icon auswählen (bitte Font Awesome Code eingeben, z.B. fas fa-columns):</label>
        <input style="width: 100%;" id="box-two-icon" type="text" name="header_settings_box_two_icon" value="<?php echo $box_two_icon; ?>" />
    </div>
    <?php
}

function header_theme_options_box_three() {
    $box_three_text_big = esc_attr(get_option( 'header_settings_box_three_text_big' ));
    $box_three_text_small = esc_attr(get_option( 'header_settings_box_three_text_small' ));
    $box_three_link = esc_attr(get_option( 'header_settings_box_three_link' ));
    $box_three_icon = esc_attr(get_option( 'header_settings_box_three_icon' ));

    $types = array('page', 'post', 'downloads', 'events', 'teacher', 'gallery');
    $all_posts = bc_get_all_posts($types);
    ?>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-three-text-big">Text Headline: </label>
        <input style="width: 100%;" id="box-three-text-big" type="text" name="header_settings_box_three_text_big" value="<?php echo $box_three_text_big; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px;">
        <label for="box-three-text-small">Text Subline: </label>
        <input style="width: 100%;" id="box-three-text-small" type="text" name="header_settings_box_three_text_small" value="<?php echo $box_three_text_small; ?>" />
    </div>
    <div class="field" style="margin-bottom: 15px; display: flex; flex-direction: column;">
        <label for="box_three_link">Seite zur Verlinkung auswählen: </label>
        <select style="width: 100%;" class="admin-input admin-contact-map" name="header_settings_box_three_link">
        <?php foreach($all_posts as $post) {
                var_dump($post);
                $id = $post["id"];
                $link = $post["link"];
                $title = $post["title"];
                if ($box_three_link == $id) {
                    ?>
                    <option selected data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                } else {
                    ?>
                    <option data-link="<?php echo $link; ?>" value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                }
                ?>
                <?php
            } ?>
        </select>
    </div>
    <div class="field">
        <label for="box-three-icon">Icon auswählen (bitte Font Awesome Code eingeben, z.B. fas fa-columns):</label>
        <input style="width: 100%;" id="box-three-icon" type="text" name="header_settings_box_three_icon" value="<?php echo $box_three_icon; ?>" />
    </div>
    <?php
}
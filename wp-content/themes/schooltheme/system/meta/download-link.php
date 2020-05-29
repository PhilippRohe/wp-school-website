<?php

/* Add the meta for a specific post type */

/* Meta box setup function. */
function load_meta_boxes_link() {
    add_action( 'add_meta_boxes', 'add_custom_meta_boxes' );
    add_action( 'save_post', 'save_meta_boxes_fields', 10, 2 );
}

/* Add the meta boxes and fields */
function add_custom_meta_boxes() {
    add_meta_box('download_link', esc_html__( 'Download Link' ), 'download_link_function', 'downloads', 'normal', 'high');
}

/* Save the value from the fields */
function save_meta_boxes_fields( $post_id ) {
    if ( !isset($_POST['download_link_nonce'] )) {
        return;
    }

    if (!wp_verify_nonce($_POST['download_link_nonce'], 'save_meta_boxes_fields')) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }  

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if ( !isset($_POST['download_link_field']) ) {
        return;
    }

    $download_link = sanitize_text_field($_POST['download_link_field']);

    update_post_meta($post_id, '_download_link_value', $download_link);
}

/* Function for download meta field */
function download_link_function( $post ) {
    wp_nonce_field('save_meta_boxes_fields', 'download_link_nonce');
    $value = get_post_meta($post->ID, '_download_link_value', true);
    ?>
    <p>Hier den Link zum Download bzw. zu der Datei einfügen</p>
    <input style="width: 100%;" type="text" name="download_link_field" value="<?php echo esc_attr($value); ?>" />
    <?php
}

add_action( 'load-post.php', 'load_meta_boxes_link' );
add_action( 'load-post-new.php', 'load_meta_boxes_link' );
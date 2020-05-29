<?php

/* Add the meta for a specific post type */

/* Meta box setup function. */
function load_meta_boxes_event_date() {
    add_action( 'add_meta_boxes', 'add_event_meta_boxes' );
    add_action( 'save_post', 'save_meta_boxes_fields_events', 10, 2 );
}

/* Add the meta boxes and fields */
function add_event_meta_boxes() {
    add_meta_box('event_date', esc_html__( 'Datum Event' ), 'event_date_function', 'events', 'normal', 'high');
}

/* Save the value from the fields */
function save_meta_boxes_fields_events( $post_id ) {
    if ( !isset($_POST['event_date_nonce'] )) {
        return;
    }

    if (!wp_verify_nonce($_POST['event_date_nonce'], 'save_meta_boxes_fields_events')) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }  

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if ( !isset($_POST['event_date_field']) ) {
        return;
    }

    $download_link = sanitize_text_field($_POST['event_date_field']);

    update_post_meta($post_id, '_event_date_value', $download_link);
}

/* Function for event meta field */
function event_date_function( $post ) {
    wp_nonce_field('save_meta_boxes_fields_events', 'event_date_nonce');
    $value = get_post_meta($post->ID, '_event_date_value', true);
    ?>
    <p>Hier das Datum zu dem Event einfügen</p>
    <input style="width: 100%;" type="text" name="event_date_field" value="<?php echo esc_attr($value); ?>" />
    <?php
}

add_action( 'load-post.php', 'load_meta_boxes_event_date' );
add_action( 'load-post-new.php', 'load_meta_boxes_event_date' );
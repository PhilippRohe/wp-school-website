<?php

// Only activate messages, if set to true in admin settings
/*
if (    (@get_option('bc_activate_contact') == '1') && (!empty(get_option('bc_activate_contact')))  ) {
    add_action( 'init', 'bc_create_posttype_messages' );
    add_action('add_meta_boxes', 'bc_contact_add_meta_box');
    add_action( 'save_post', 'bc_save_contact_email_data');
}
*/

/* Set the download link in the admin column */
function set_downloads_columns( $columns ) {
    $new_columns = array();
    $new_columns['title'] = "Download Title";
    $new_columns['link'] = "Link";
    $new_columns['categories'] = "Kategorien";
    $new_columns['date'] = "Date";
    return $new_columns;
}

function downloads_custom_column( $column, $post_id ) {
    $value = get_post_meta($post_id, '_download_link_value', true);
    switch($column) {
        case 'link':
            echo $value;
            break;
    }
}

add_filter( 'manage_downloads_posts_columns', 'set_downloads_columns' );
add_action( 'manage_downloads_posts_custom_column', 'downloads_custom_column', 10, 2 );
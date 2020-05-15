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
    $date = $columns['date'];
    $categories = $columns['taxonomy-categories-downloads'];
    unset($columns['date']);
    unset($columns['taxonomy-categories-downloads']);
    $columns['title'] = "Download Title";
    $columns['icon'] = "Download";
    $columns['link'] = "Link";
    $columns['taxonomy-categories-downloads'] = $categories;
    $columns['date'] = $date;
    return $columns;
}

function downloads_custom_column( $column, $post_id ) {
    $value = get_post_meta($post_id, '_download_link_value', true);
    $download_icon = get_template_directory_uri() . '/dist/img/icons/download.svg';
    switch($column) {
        case 'link':
            echo $value;
            break;
        case 'icon':
            echo '<a href="' . $value . '"><img width="25" height="25" src="' . $download_icon . '"></a>';
            break;
    }
}

add_filter( 'manage_downloads_posts_columns', 'set_downloads_columns' );
add_action( 'manage_downloads_posts_custom_column', 'downloads_custom_column', 10, 2 );




/* Set the download link in the admin column */
function set_gallery_columns( $columns ) {
    $date = $columns['date'];
    $categories = $columns['taxonomy-categories-gallery'];
    unset($columns['date']);
    unset($columns['taxonomy-categories-gallery']);
    $columns['title'] = "Download Title";
    $columns['number'] = "Anzahl Bilder";
    $columns['taxonomy-categories-gallery'] = $categories;
    $columns['date'] = $date;
    return $columns;
}

function gallery_custom_column( $column, $post_id ) {
    $number = sizeof(load_images_from_slider( $post_id ));
    switch($column) {
        case 'number':
            echo $number;
            break;
    }
}

add_filter( 'manage_gallery_posts_columns', 'set_gallery_columns' );
add_action( 'manage_gallery_posts_custom_column', 'gallery_custom_column', 10, 2 );






/* Set the teacher link in the admin column */
function set_teacher_columns( $columns ) {
    $subjects = $columns[ 'taxonomy-subject-teacher' ];
    $date = $columns['date'];
    unset($columns['date']);
    unset($columns['taxonomy-subject-teacher']);
    $columns['title'] = "Name Lehrer";
    $columns['image'] = "Bild";
    $columns['taxonomy-subject-teacher'] = $subjects;
    $columns['date'] = $date;
    return $columns;
}

function teacher_custom_column( $column, $post_id ) {
    $image = get_the_post_thumbnail_url( $post_id );
    switch($column) {
        case 'image':
            echo '<img src="' . $image . '" width="75" height="75">';
            break;
    }
}

add_filter( 'manage_teacher_posts_columns', 'set_teacher_columns' );
add_action( 'manage_teacher_posts_custom_column', 'teacher_custom_column', 10, 2 );







/* Set event date in the admin column */
function set_events_columns( $columns ) {
    $date = $columns['date'];
    unset($columns['date']);
    $columns['title'] = "Event Name";
    $columns['date_event'] = "Termin";
    $columns['date'] = $date;
    return $columns;
}

function events_custom_column( $column, $post_id ) {
    $value = get_post_meta($post_id, '_event_date_value', true);
    $value = date('d-m-Y', strtotime($value));
    switch($column) {
        case 'date_event':
            echo $value;
            break;
    }
}


function set_custom_sortable_columns( $columns ) {
  $columns['date_event'] = 'date_event';
  return $columns;
}

function events_order_custom_columns( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get('orderby');
 
    if( 'date_event' == $orderby ) {
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'date_event',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key' => 'date_event',
            ),
        );
        $query->set('meta_query', meta_query);
        $query->set('orderby', 'meta_value');
    }
}

add_filter( 'manage_events_posts_columns', 'set_events_columns' );
add_action( 'manage_events_posts_custom_column', 'events_custom_column', 10, 2 );
add_filter( 'manage_edit-events_sortable_columns', 'set_custom_sortable_columns' );
add_action( 'pre_get_posts', 'events_order_custom_columns' );
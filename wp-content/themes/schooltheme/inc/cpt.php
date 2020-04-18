<?php
/* Register all custom post types with taxonomies here */

function bc_create_posttype_teacher() {
    register_post_type( 'teacher',
        array(
            'labels' => array(
                'name' => __( 'Lehrer' ),
                'singular_name' => __( 'Lehrer' ),
                'add_new' => _x('Lehrer hinzufügen', 'book'),
                'add_new_item' => __('Neuen Lehrer hinzufügen'),
                'edit_item' => __('Lehrer anpassen'),
                'new_item' => __('Neuer Lehrer'),
                'all_items' => __('Alle Lehrer'),
                'view_item' => __('Lehrer ansehen'),
                'search_items' => __('Suche Lehrer'),
                'not_found' =>  __('Keine Lehrer gefunden'),
                'not_found_in_trash' => __('Keine Lehrer im Papierkorb'), 
                'parent_item_colon' => '',
                'menu_name' => __('Lehrer')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'show_in_menu' => true, 
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'teacher'),
            'menu_position' => 7,
            'exclude_from_search' => false,
            'menu_icon' => 'dashicons-media-code',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'post-formats'),
        )
    );
}


// Register Custom Taxonomy
function bc_create_taxonomy_subjects() {

	$labels = array(
		'name'                       => _x( 'Schulfächer', 'Taxonomy General Name', 'bcschool' ),
		'singular_name'              => _x( 'Schulfach', 'Taxonomy Singular Name', 'bcschool' ),
		'menu_name'                  => __( 'Schulfächer', 'bcschool' ),
		'all_items'                  => __( 'Alle Schulfächer', 'bcschool' ),
		'parent_item'                => __( 'Eltern Schulfächer', 'bcschool' ),
		'parent_item_colon'          => __( 'Eltern Schulfächer:', 'bcschool' ),
		'new_item_name'              => __( 'Neues Schulfach Name', 'bcschool' ),
		'add_new_item'               => __( 'Neues Schulfach hinzufügen', 'bcschool' ),
		'edit_item'                  => __( 'Schulfach bearbeiten', 'bcschool' ),
		'update_item'                => __( 'Schulfach aktualisieren', 'bcschool' ),
		'view_item'                  => __( 'Schulfach ansehen', 'bcschool' ),
		'separate_items_with_commas' => __( 'Durch "," miteinander trennen', 'bcschool' ),
		'add_or_remove_items'        => __( 'Schulfach hinzufügen oder entfernen', 'bcschool' ),
		'choose_from_most_used'      => __( 'Aus den beliebtesten auswählen', 'bcschool' ),
		'popular_items'              => __( 'Beliebte Schulfächer', 'bcschool' ),
		'search_items'               => __( 'Suche Schulfächer', 'bcschool' ),
		'not_found'                  => __( 'Keine gefunden', 'bcschool' ),
		'no_terms'                   => __( 'Keine Schulfächer', 'bcschool' ),
		'items_list'                 => __( 'Schulfächer Liste', 'bcschool' ),
		'items_list_navigation'      => __( 'Schulfächer Liste Navigation', 'bcschool' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'subject-teacher', array( 'teacher' ), $args );

}


add_action( 'init', 'bc_create_posttype_teacher' );
add_action( 'init', 'bc_create_taxonomy_subjects' );




/* Downloads cusotm post type */
function bc_create_posttype_downloads() {
    register_post_type( 'downloads',
        array(
            'labels' => array(
                'name' => __( 'Downloads' ),
                'singular_name' => __( 'Download' ),
                'add_new' => _x('Download hinzufügen', 'book'),
                'add_new_item' => __('Neuen Download hinzufügen'),
                'edit_item' => __('Download anpassen'),
                'new_item' => __('Neuer Download'),
                'all_items' => __('Alle Downloads'),
                'view_item' => __('Downloads ansehen'),
                'search_items' => __('Suche Download'),
                'not_found' =>  __('Keine Downloads gefunden'),
                'not_found_in_trash' => __('Keine Downloads im Papierkorb'), 
                'parent_item_colon' => '',
                'menu_name' => __('Downloads')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'show_in_menu' => true, 
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'downloads'),
            'menu_position' => 8,
            'exclude_from_search' => false,
            'menu_icon' => 'dashicons-media-code',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats'),
        )
    );
}


// Register Custom Taxonomy
function bc_create_taxonomy_categories_downloads() {

	$labels = array(
		'name'                       => _x( 'Katgeorien', 'Taxonomy General Name', 'bcschool' ),
		'singular_name'              => _x( 'Katgeorie', 'Taxonomy Singular Name', 'bcschool' ),
		'menu_name'                  => __( 'Katgeorien', 'bcschool' ),
		'all_items'                  => __( 'Alle Katgeorien', 'bcschool' ),
		'parent_item'                => __( 'Eltern Katgeorien', 'bcschool' ),
		'parent_item_colon'          => __( 'Eltern Katgeorien:', 'bcschool' ),
		'new_item_name'              => __( 'Neue Katgeorie Name', 'bcschool' ),
		'add_new_item'               => __( 'Neue Katgeorie hinzufügen', 'bcschool' ),
		'edit_item'                  => __( 'Katgeorie bearbeiten', 'bcschool' ),
		'update_item'                => __( 'Katgeorie aktualisieren', 'bcschool' ),
		'view_item'                  => __( 'Katgeorie ansehen', 'bcschool' ),
		'separate_items_with_commas' => __( 'Durch "," miteinander trennen', 'bcschool' ),
		'add_or_remove_items'        => __( 'Katgeorie hinzufügen oder entfernen', 'bcschool' ),
		'choose_from_most_used'      => __( 'Aus den beliebtesten auswählen', 'bcschool' ),
		'popular_items'              => __( 'Beliebte Katgeorien', 'bcschool' ),
		'search_items'               => __( 'Suche Katgeorien', 'bcschool' ),
		'not_found'                  => __( 'Keine Katgeorie gefunden', 'bcschool' ),
		'no_terms'                   => __( 'Keine Katgeorien', 'bcschool' ),
		'items_list'                 => __( 'Katgeorien Liste', 'bcschool' ),
		'items_list_navigation'      => __( 'Katgeorien Liste Navigation', 'bcschool' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'categories-downloads', array( 'downloads' ), $args );

}


add_action( 'init', 'bc_create_posttype_downloads' );
add_action( 'init', 'bc_create_taxonomy_categories_downloads' );
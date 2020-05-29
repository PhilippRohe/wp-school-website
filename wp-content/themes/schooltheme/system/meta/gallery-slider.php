<?php

/* Meta box setup function. */
function load_meta_boxes_gallery() {
    add_action( 'add_meta_boxes', 'custom_meta_box_gallery' );
}


 
 function custom_meta_box_gallery() {
     add_meta_box(
         'gallery_slider',
         esc_html__( 'Slider mit Bildern einstellen (Reihenfolge per Drag-and-Drop ändern)' ),
         'gallery_slider_call',
         'gallery',
         'normal',
         'high' 
     );
     add_meta_box('gallery_headline_text', esc_html__( 'Gallery Headline' ), 'gallery_headline_function', 'gallery', 'normal', 'high');
 }
  
 /*
  * Meta Box HTML
  */
 function gallery_slider_call( $post ) {
     $meta_key = 'some_custom_gallery';
     echo gallery_slider_function( $meta_key, get_post_meta($post->ID, $meta_key, true) );
 }
  
 /*
  * Save Meta Box data
  */
 add_action('save_post', 'save_data_slider');
  
 function save_data_slider( $post_id ) {
     if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
         return $post_id;
  
     $meta_key = 'some_custom_gallery';
  
     if (isset($_POST[$meta_key])) {
        update_post_meta( $post_id, $meta_key, $_POST[$meta_key] );
     }
  
     return $post_id;
 }

 function gallery_slider_function( $name, $value = '' ) {
 
	$html = '<div><ul class="gallery_slider_list">';
	/* array with image IDs for hidden field */
	$hidden = array();
 
 
	if( $images = get_posts( array(
		'post_type' => 'attachment',
		'orderby' => 'post__in', /* we have to save the order */
		'order' => 'ASC',
		'post__in' => explode(',',$value), /* $value is the image IDs comma separated */
		'numberposts' => -1,
		'post_mime_type' => 'image'
	) ) ) {
 
		foreach( $images as $image ) {
			$hidden[] = $image->ID;
            $image_src = wp_get_attachment_image_src( $image->ID, array( 300, 300 ) );
			$html .= '<li data-id="' . $image->ID .  '"><div class="image-inner" style="background-image:url(' . $image_src[0] . ')"><a href="#" class="remove_from_gallery"><span class="icon-cross">X</span></a></div></li>';
		}
 
	}
 
	$html .= '</ul><div style="clear:both"></div></div>';
	$html .= '<input type="hidden" name="'.$name.'" value="' . join(',',$hidden) . '" /><a href="#" class="button upload_to_slider_button">Bilder hinzufügen</a>';
 
	return $html;
}
 

add_action( 'load-post.php', 'load_meta_boxes_gallery' );
add_action( 'load-post-new.php', 'load_meta_boxes_gallery' );




/* Add the meta for a specific post type */

/* Save the value from the fields */
function save_meta_boxes_field_headline( $post_id ) {
    if ( !isset($_POST['gallery_headline_nonce'] )) {
        return;
    }

    if (!wp_verify_nonce($_POST['gallery_headline_nonce'], 'save_meta_boxes_fields')) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }  

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if ( !isset($_POST['gallery_headline_field']) ) {
        return;
    }

    $download_link = sanitize_text_field($_POST['gallery_headline_field']);

    update_post_meta($post_id, '_gallery_headline_value', $download_link);
}

/* Function for download meta field */
function gallery_headline_function( $post ) {
    wp_nonce_field('save_meta_boxes_fields', 'gallery_headline_nonce');
    $value = get_post_meta($post->ID, '_gallery_headline_value', true);
    ?>
    <p>Hier eine Headline eintragen, die über dem Slider stehen wird, wenn dieser im Header eingebunden wird:</p>
    <input style="width: 100%;" type="text" name="gallery_headline_field" value="<?php echo esc_attr($value); ?>" />
    <?php
}

add_action( 'save_post', 'save_meta_boxes_field_headline', 10, 2 );
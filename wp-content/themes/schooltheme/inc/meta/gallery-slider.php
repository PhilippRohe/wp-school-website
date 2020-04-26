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
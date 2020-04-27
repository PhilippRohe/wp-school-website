<?php

/* Load all galleries from the cpt gallery */
function load_all_cpt_galleries() {
    $gallery_array = [];
    $args = array(
        'post_type' => 'gallery',
        'posts_per_page' => '-1',
        'orderby' => 'date',
        'order' => 'ASC',
    );
       
    $query = new \WP_Query($args); 
       
    if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

        $new_gallery = array();
        $new_gallery[ 'id' ] = get_the_ID();
        $new_gallery[ 'title' ] = get_the_title();

        array_push($gallery_array, $new_gallery);

    endwhile; else : ?>
        <p>Keine Beiträge gefunden</p>
    <?php endif; wp_reset_postdata();

    return $gallery_array;
}


/* Load all images from a specific slider id (cpt) */
function load_images_from_slider($slider_id) {

    /* Image array to return */
    $_image_array = array();

    /* Load all images from slider first */
    $images = get_posts( array(
        'post_type' => 'attachment',
        'orderby' => 'post__in', /* we have to save the order */
        'order' => 'ASC',
        'post__in' => explode(',', get_post_meta($slider_id, 'some_custom_gallery', true)), /* $value is the image IDs comma separated */
        'numberposts' => -1,
        'post_mime_type' => 'image'
    ) );
 
    foreach( $images as $image ) {
        /* Create new image */
        $new_image;

        $new_image[ 'id' ] = $image->ID;
        $new_image[ 'title' ] = $image->post_title;
        $new_image[ 'description' ] = $image->post_content;
        $new_image[ 'alt' ] = get_post_meta( $image->ID, '_wp_attachment_image_alt', true );
        $new_image[ 'src' ] = wp_get_attachment_image_src( $image->ID, array( 300, 300 ) )[0];

        array_push($_image_array, $new_image);
    }

    return $_image_array;
}



/* Load all pages, posts and custom post types */
function bc_get_all_posts($types) {
    $list = array();

    foreach($types as $type) {
        $args = array(
            'post_type'=> $type,
        );              
    
        $query = new WP_Query( $args );
        if($query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            $single = array();
            $single[ 'id' ] = get_the_ID();
            $single[ 'title' ] = get_the_title();
            $single[ 'link' ] = get_post_permalink(get_the_ID());
    
            array_push($list, $single);
        endwhile; else : endif; wp_reset_postdata();
    }

    return $list;
}

/* Load all fonts existing in dist/fonts/*./ */
function bc_get_all_fonts() {
    $all_fonts = [];
    foreach (glob(get_template_directory() . '/dist/fonts/include/*', GLOB_BRACE) as $filename) {
        $font = substr(strrchr($filename, '/'), 1) . '-regular';

        array_push($all_fonts, $font);
    }
    return $all_fonts;
}


/* Pagination function */
function pagination($range = 3, $show_one_pager = true, $show_page_hint = false) {
    global $wp_query;

    $num_of_pages = (int)$wp_query->max_num_pages;

	if($num_of_pages > 1)
	{
		$current_page = get_query_var('paged') === 0 ? 1 : get_query_var('paged');
		$num_of_display_pages = ($range * 2) + 1;			

		$output = '<div class="clearfix"></div><ul class="pagination">';

		if($show_page_hint)
		{
			$output .= '<span>Seite ' . $current_page . ' von ' . $num_of_pages . '</span>';
		}
		
		if($current_page > 2 && $current_page > $range + 1 && $num_of_display_pages < $num_of_pages)
		{
			$output .= '<li><a href="' . get_pagenum_link(1) . '" title="'.__('Seite 1 - Neueste Artikel').'" data-page="1">«</a></li>';
		}
		if($show_one_pager && $current_page > 1)
		{
			$output .= '<li><a href="' . get_pagenum_link($current_page - 1) . '" title="Seite ' . ($current_page - 1) . __('- Neuere Artikel').'" data-page="' . ($current_page - 1) . '">‹</a></li>';
		}

		for($i = 1; $i <= $num_of_pages; $i++)
		{
			if($i < $current_page + $range + 1 && $i > $current_page - $range - 1)
			{
				if($current_page === $i)
				{
					$output .= '<li class="active"><a data-page="' . ($i) . '">' . $i . '</a></li>';
				}
				else
				{
					$output .= '<li><a href="' . get_pagenum_link($i) . '" title="'.__('Seite'). ' '.$i . '" data-page="' . ($i) . '">' . $i . '</a></li>';
				}
			}
		}
		
		if($show_one_pager && $current_page < $num_of_pages)
		{
			$output .= '<li><a href="' . get_pagenum_link($current_page + 1) . '" title="Seite ' . ($current_page + 1) . __('- Ältere Artikel').'" data-page="' . ($current_page + 1) . '">›</i></a></li>';
		}
		if($current_page < $num_of_pages - 1 && $current_page + $range < $num_of_pages && $num_of_display_pages < $num_of_pages)
		{
			$output .= '<li><a href="' . get_pagenum_link($num_of_pages) . '" title="Seite ' . $num_of_pages . __('- Älteste Artikel').'" data-page="' . ($num_of_pages) . '">»</a></li>';
		}

        $output .= '</ul>';
        
		return $output;
	}
}
<?php

/* Disable Gutenberg editor */
add_filter('use_block_editor_for_post', '__return_false', 10);

/* Custom excerpt length */
function my_excerpt_length($length){
    return 25;
}
add_filter('excerpt_length', 'my_excerpt_length');

/* Add this to the beginning of head */
function meta_header() {
  ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
  <?php
}
add_action( 'wp_head', 'meta_header', 0, 1 );
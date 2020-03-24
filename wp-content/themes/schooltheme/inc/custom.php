<?php

/* Disable Gutenberg editor */
add_filter('use_block_editor_for_post', '__return_false', 10);

/* Custom excerpt length */
function my_excerpt_length($length){
    return 25;
}
add_filter('excerpt_length', 'my_excerpt_length');
<?php

/* Add custom footer text to dashboard */
add_filter( 'admin_footer_text', 'custom_admin_footer_text' );

function custom_admin_footer_text( $mein_text ) {
    return 'WordPress Theme made for schools | Copyright &copy; ' . date("Y");
}
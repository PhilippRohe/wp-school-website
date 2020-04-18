<?php

/* Change the custom login logo */
function custom_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/img/apple.png );
            padding-bottom: 30px;
        }
        body.login{
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/img/landscape.jpeg );
            background-repeat: no-repeat;
            background-size: cover;
        }
        body.login #backtoblog, body.login #nav, body.login p {
            margin-top: 20px;
            margin-left: 0;
            padding: 5px;
            font-weight: 400;
            overflow: hidden;
            background: #fff;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );


/* Logo and url */
function custom_login_logo_url() {
	return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );


/* Logo title */
function custom_login_logo_url_title() {
	return 'WordPress Themes for schools';
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );

/* Login custom content */
function custom_login_message( $message ) {
    if ( empty($message) ){
        return "<p id='welcome-message'><strong>Willkommen bei dem Themes für Schulwebseiten</strong></p>";
    } else {
        return $message;
    }
}

add_filter( 'login_message', 'custom_login_message' );
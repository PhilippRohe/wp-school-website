<?php

/* Change the custom login logo */
function custom_login_logo() { ?>
	<style type="text/css">
        @font-face {
            font-family: "bcFont";
            src: url('wp-content/themes/schooltheme/dist/fonts/bcFont.eot');
            src: url('wp-content/themes/schooltheme/dist/fonts/bcFont.eot?#iefix') format('eot'),
                url('wp-content/themes/schooltheme/dist/fonts/bcFont.woff2') format('woff2'),
                url('wp-content/themes/schooltheme/dist/fonts/bcFont.woff') format('woff'),
                url('wp-content/themes/schooltheme/dist/fonts/bcFont.ttf') format('truetype'),
                url('wp-content/themes/schooltheme/dist/fonts/bcFont.svg#bcFont') format('svg');
        }
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
            margin-left: 0;
            padding: 5px;
            font-weight: 400;
            overflow: hidden;
            background: #fff;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
            color: red;
            font-weight: 700;
        }
        body.login #backtoblog, body.login #nav a:hover, body.login #backtoblog a:hover {
            color: red;
        }
        body.login #login form p {
            border: none;
        }
        body.login #login form .user-pass-wrap .wp-pwd .button span{
            color: red;
        }
        body.login #login form .user-pass-wrap .wp-pwd input::selection{
            background: red;
        }
        body.login #login form p input::selection{
            background: red;
        }
        body.login #login form .submit input {
            background: red;
            border-color: red;
            border: 1px solid red;
        }
        body.login #login .message {
            border-left: 4px solid red;
        }
        body.login #login form .submit input, input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 0s;
        }
        body.login #login form .forgetmenot input[type=checkbox]:checked::before {
            margin-top: 7px;
            font-family: "bcFont";
            content: '\E004';
            font-size: 12px;
            margin-left: -3px;
        }
        body.login #login form p button {
            background: red;
        }
        body.login #login form input:focus {
            border-color: red;
            box-shadow: 0 0 0 1px red;
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
add_filter( 'login_headertext', 'custom_login_logo_url_title' );

/* Login custom content */
function custom_login_message( $message ) {
    if ( empty($message) ){
        return "<p id='welcome-message'><strong>Willkommen bei dem Themes für Schulwebseiten</strong></p>";
    } else {
        return $message;
    }
}

add_filter( 'login_message', 'custom_login_message' );
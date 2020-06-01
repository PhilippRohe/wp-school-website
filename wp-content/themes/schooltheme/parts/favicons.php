<?php 
$link_to_path = get_template_directory_uri() . '/dist/img/favicon/';
$favicon_high = esc_attr(get_option( 'style_settings_favicon_high' ));
$favicon_low = esc_attr(get_option( 'style_settings_favicon_low' ));
?>

<!-- Favicon -->
<?php if ( $favicon_high != '' ) {
    echo $favicon_high;
    ?>
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $favicon_high; ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $favicon_high; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $favicon_high; ?>">
    <?php
} else {
    ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $link_to_path; ?>apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $link_to_path; ?>apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $link_to_path; ?>apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $link_to_path; ?>apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $link_to_path; ?>apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $link_to_path; ?>apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $link_to_path; ?>apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $link_to_path; ?>apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $link_to_path; ?>apple-icon-180x180.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $link_to_path; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $link_to_path; ?>android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $link_to_path; ?>favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $link_to_path; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $link_to_path; ?>favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $link_to_path; ?>favicon-16x16.png">
    <link rel="manifest" href="<?php echo $link_to_path; ?>site.webmanifest">
    <link rel="mask-icon" href="<?php echo $link_to_path; ?>safari-pinned-tab.svg" color="#5bbad5">
    
    <!-- Colors and Apple-->
    <meta name="theme-color" content="#ff0000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="<?php echo $link_to_path; ?>ms-icon-144x144.png">
    <?php
}
if ( $favicon_low != '' ) {
    echo 'hallo123';
    ?>
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $favicon_low; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon_low; ?>">
    <?php
} else {
    ?>
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $link_to_path; ?>favicon-96x96.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $link_to_path; ?>favicon.ico">
    <?php
}
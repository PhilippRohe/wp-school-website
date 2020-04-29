<!DOCTYPE html>
<?php
    /* Some variables to use */
    $site_title = get_bloginfo('name');
    $site_url = network_site_url('/');
    $site_description = get_bloginfo('description');
    $site_language = get_bloginfo('language');
?>
<html lang="<?php echo $site_language; ?>">
    <head>
        <!--- WordPress head data --->
        <?php wp_head(); ?>
        <!--- Meta data --->
        <?php get_template_part('parts/meta'); ?>
        <!--- Favicons --->
        <?php get_template_part('parts/favicons'); ?>

        <!-- Include font awesome script here -->
        <?php $font_awesome_code = esc_attr(get_option( 'bc_enable_font_awesome' )); ?>
        <script src="https://kit.fontawesome.com/<?php echo $font_awesome_code; ?>.js" crossorigin="anonymous"></script>
    </head>

    <body <?php body_class(); ?>>
        <!-- Header Menu -->
        <?php get_template_part('parts/head'); ?>
        <!-- Image carousel -->
        <?php if (is_single()) { get_template_part('parts/carousel'); } ?>
        <!-- Breadcrumbs -->
        <?php $enable_breadcrumbs = esc_attr(get_option( 'bc_enable_breadcrumbs' )); ?>
        <?php if ( function_exists('nav_breadcrumb') && (!is_front_page()) && ($enable_breadcrumbs == 'on') ) { nav_breadcrumb(); } ?>

        <?php
        $size = ( (is_single() || is_page()) && (!in_array('elementor-page elementor-page-' . get_the_ID(), get_body_class())) ) ? ' container' : ' container-fluid';
        $border = ( (is_single() || is_page()) && (!in_array('elementor-page elementor-page-' . get_the_ID(), get_body_class())) ) ? ' bordered' : '';
        ?>

        <main class="bc--main<?php echo $size; ?><?php echo $border; ?>">     <!-- START OF MAIN -->
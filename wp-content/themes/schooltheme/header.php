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
        <script src="https://kit.fontawesome.com/c98a339e8c.js" crossorigin="anonymous"></script>
    </head>

    <body <?php body_class(); ?>>
        <!-- Header Menu -->
        <?php get_template_part('parts/head'); ?>
        <!-- Breadcrumbs -->
        <?php if ( function_exists('nav_breadcrumb') && (!is_front_page()) ) { nav_breadcrumb(); } ?>
        <!-- Image carousel -->
        <?php if (is_single()) { get_template_part('parts/carousel'); } ?>

        <main class="bc--main container-fluid">     <!-- START OF MAIN -->
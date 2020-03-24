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
        <!--- Scripts --->

        <!--- Favicons --->
        <?php get_template_part('parts/favicons'); ?>

        <script src="https://kit.fontawesome.com/c98a339e8c.js" crossorigin="anonymous"></script>
    </head>

    <body <?php body_class(); ?>>
        <div class="bc--header">
            <nav class="header-navigation">
                <?php get_template_part('parts/menu'); ?>
            </nav>
        </div>
        <?php get_template_part('parts/head'); ?>
        <?php /* if ( function_exists('nav_breadcrumb') ){ nav_breadcrumb(); } */ ?>

        <main class="bc--main">     <!-- START OF MAIN -->
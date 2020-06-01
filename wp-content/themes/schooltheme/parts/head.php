<?php 
$email = esc_attr(get_option( 'contact_settings_mail' ));
$phone = esc_attr(get_option( 'contact_settings_phone' ));
$map = esc_attr(get_option( 'contact_settings_map' ));
$header_background_image = esc_attr(get_option( 'style_settings_header_background' ));
$menu_logo = esc_attr(get_option( 'bc_menu_logo' )) ? esc_attr(get_option( 'bc_menu_logo' )) : 'https://www.placehold.it/250x75';
$is_single = (is_single()) ? ' single-page' : '';
?>

<header class="bc--header container-fluid<?php echo $is_single; ?>">

    <!-- Mobile toggle -->
    <div class="nav-menu mobile-menu js--mobile-menu">
        <div class="menu--toggle">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="bc--topmenu row">
        <div class="left">
            <div class="meta-nav">
                <a href="tel:<?php echo $phone; ?>" class="box box-phone"><span class="logo phone-logo icon-phone"></span></a>
                <a href="mailto:<?php echo $email; ?>" class="box box-mail"><span class="logo mail-logo icon-mail"></span></a>
                <a href="<?php echo $map; ?>" class="box box-map"><span class="logo map-logo icon-map"></span></a>
            </div>
        </div>
        <div class="right">
            <?php
                $header_menu_array = array(
                    'theme_location' => 'top',
                    'container_class' => 'top-menu',
                    'depth' => 1,
                );
                wp_nav_menu($header_menu_array);
            ?>
            <div class="box box-search js--search-box">
                <span class="logo search-logo icon-search active" aria-hidden="false"></span>
                <span class="logo close-logo icon-close" aria-hidden="true"></span>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

    <div class="bc--navigation row" style="background-image:url('<?php echo $header_background_image; ?>')">
        <div class="left col-6 col-sm-6 col-md-12 col-lg-3 col-xl-3">
            <a href="<?php echo get_home_url(); ?>">
                <img width="300" height="100" class="school-logo" src="<?php echo $menu_logo; ?>" alt="Schule Webseiten Logo">
            </a>
        </div>
        <div class="right col-12 col-lg-9 col-xl-9">
            <nav class="navigation" role="navigation">
                <div class="big-navigation" aria-hidden="false">
                    <?php
                        $header_menu_array = array(
                            'theme_location' => 'main',
                            'menu_class' => 'main-menu',
                            'menu_id' => 'main-menu-big',
                            'depth' => 2,
                            'walker' => new top_walker_menu(),
                        );
                        wp_nav_menu($header_menu_array);
                    ?>
                </div>
            </nav>
        </div>
        <div class="action-boxes container" aria-hidden="true">
            <?php
                $box_one_text_big = esc_attr(get_option( 'header_settings_box_one_text_big' ));
                $box_one_text_small = esc_attr(get_option( 'header_settings_box_one_text_small' ));
                $box_one_link = esc_attr(get_option( 'header_settings_box_one_link' ));
                $box_one_icon = esc_attr(get_option( 'header_settings_box_one_icon' ));
                $link_one = get_permalink( $box_one_link );

                $box_two_text_big = esc_attr(get_option( 'header_settings_box_two_text_big' ));
                $box_two_text_small = esc_attr(get_option( 'header_settings_box_two_text_small' ));
                $box_two_link = esc_attr(get_option( 'header_settings_box_two_link' ));
                $box_two_icon = esc_attr(get_option( 'header_settings_box_two_icon' ));
                $link_two = get_permalink( $box_two_link );

                $box_three_text_big = esc_attr(get_option( 'header_settings_box_three_text_big' ));
                $box_three_text_small = esc_attr(get_option( 'header_settings_box_three_text_small' ));
                $box_three_link = esc_attr(get_option( 'header_settings_box_three_link' ));
                $box_three_icon = esc_attr(get_option( 'header_settings_box_three_icon' ));
                $link_three = get_permalink( $box_three_link );
            ?>
            <div class="row">
                <a href="<?php echo $link_one; ?>" class="box col-4">
                    <div class="left-box">
                        <p><?php echo $box_one_text_big; ?></p>
                        <p class="small"><?php echo $box_one_text_small; ?></p>
                    </div>
                    <div class="right-box">
                        <i class="<?php echo $box_one_icon; ?>"></i>
                    </div>
                </a>
                <a href="<?php echo $link_two; ?>" class="box col-4">
                    <div class="left-box">
                        <p><?php echo $box_two_text_big; ?></p>
                        <p class="small"><?php echo $box_two_text_small; ?></p>
                    </div>
                    <div class="right-box">
                        <i class="<?php echo $box_two_icon; ?>"></i>
                    </div>
                </a>
                <a href="<?php echo $link_three; ?>" class="box col-4">
                    <div class="left-box">
                        <p><?php echo $box_three_text_big; ?></p>
                        <p class="small"><?php echo $box_three_text_small; ?></p>
                    </div>
                    <div class="right-box">
                        <i class="<?php echo $box_three_icon; ?>"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="small-navigation" role="navigation" aria-hidden="true">       
        <?php
            $header_menu_array = array(
                'theme_location' => 'main',
                'menu_class' => 'main-menu',
                'menu_id' => 'main-menu-small',
                'depth' => 2,
                'walker' => new top_walker_menu(),
            );
            wp_nav_menu($header_menu_array);
        ?>
        <div class="meta-nav">
            <a href="tel:<?php echo $phone; ?>" class="box box-phone"><span class="logo phone-logo icon-phone"></span></a>
            <a href="mailto:<?php echo $email; ?>" class="box box-mail"><span class="logo mail-logo icon-mail"></span></a>
            <a href="<?php echo $map; ?>" class="box box-map"><span class="logo map-logo icon-map"></span></a>
        </div>
    </div>

</header>
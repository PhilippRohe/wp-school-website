<?php ?>
<header class="bc--header container-fluid">

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
        <div class="left"></div>
        <div class="right">
            <?php
                $header_menu_array = array(
                    'theme_location' => 'top',
                    'container_class' => 'top-menu',
                    'depth' => 1,
                );
                wp_nav_menu($header_menu_array);
            ?>
        </div>
    </div>

    <div class="bc--navigation row">
        <div class="left col-12 col-md-4">
            <img class="school-logo" src="https://www.placehold.it/250x75" alt="Schule Webseiten Logo">
        </div>
        <div class="right col-12 col-md-8">
            <nav class="navigation" role="navigation">
                <div class="big-navigation" aria-hidden="false">
                    <?php
                        $header_menu_array = array(
                            'theme_location' => 'main',
                            'menu_class' => 'main-menu',
                            'menu_id' => 'main-menu',
                            'depth' => 2,
                            'walker' => new top_walker_menu(),
                        );
                        wp_nav_menu($header_menu_array);
                    ?>
                </div>
                <div class="small-navigation" role="navigation" aria-hidden="true">
                    <?php
                        $header_menu_array = array(
                            'theme_location' => 'main',
                            'menu_class' => 'main-menu',
                            'menu_id' => 'main-menu',
                            'depth' => 2,
                            'walker' => new top_walker_menu(),
                        );
                        wp_nav_menu($header_menu_array);
                    ?>
                    <div class="meta-nav">
                        <a href="#" class="box box-phone"><span class="logo phone-logo icon-phone"></span></a>
                        <a href="#" class="box box-mail"><span class="logo mail-logo icon-mail"></span></a>
                        <a href="#" class="box box-map"><span class="logo map-logo icon-map"></span></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</header>
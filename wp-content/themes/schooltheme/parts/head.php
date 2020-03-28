<?php ?>
<header class="bc--header container-fluid">

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
                <div class="big-navigation" aria-hidden="true">
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
                <div class="nav-menu mobile-menu" role="navigation" aria-hidden="false">
                    <div class="menu--toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</header>
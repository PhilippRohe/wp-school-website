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
        <div class="left col-3">
            <img class="school-logo" src="https://www.placehold.it/250x75" alt="Schule Webseiten Logo">
        </div>
        <div class="right col-9">
            <nav class="navigation" role="navigation">
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
            </nav>
        </div>
    </div>

</header>
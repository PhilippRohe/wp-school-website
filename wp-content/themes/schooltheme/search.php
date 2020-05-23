<?php get_header(); ?>

<div class="container--search-results row">
    <div class="container--search-results-head col-lg-6 col-12">
        <h1>Die Suchergebnisse für Ihre Suche: <br><b><?php echo htmlspecialchars($_GET["s"]); ?></b></h1>
        <div class="bc-search--container">
            <?php get_search_form(); ?>
        </div>
    </div>
    <div class="container--search-results-body col-lg-6 col-12">
        <?php
        $args = array(
            'post_type'=> get_post_types(),
            's'    => $s,
            'paged' => $paged,
        );
        query_posts($args); ?>

        <div class="search--results-content">
        <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="search--results-single">
                <?php
                /* Get all datas */
                $title = get_the_title();
                $excerpt = get_the_excerpt();
                $id = get_the_ID();
                $type = get_post_type();
                $thumbnail = get_the_post_thumbnail_url();
                $post_cats = get_the_category($id, 'name');
                $link = get_post_permalink();
                $subjects = wp_get_post_terms( get_the_ID(), 'subject-teacher', array('fields' => 'names'));
                $download_cats = wp_get_post_terms( get_the_ID(), 'categories-downloads', array('fields' => 'names'));
                $gallery_cats = wp_get_post_terms( get_the_ID(), 'categories-gallery', array('fields' => 'names'));
                $event_cats = wp_get_post_terms( get_the_ID(), 'categories-events', array('fields' => 'names'));
                $event_location = wp_get_post_terms( get_the_ID(), 'locations-events', array('fields' => 'names'));
                $event_date = get_post_meta(get_the_ID(), '_event_date_value', true);
                ?>
                <div class="box-head">
                    <a href="<?php echo $link; ?>">
                        <h3><?php echo $title; ?></h3>
                        <?php if ($type == 'events') {
                            ?>
                            <span>(<?php echo implode($event_location, ', '); ?> - <?php echo $event_date; ?>)</span>
                            <?php
                        } ?>
                    </a>
                    <ul class="categorie-list">
                        <?php
                        if ($type == 'teacher') {
                            $list = $subjects;
                        } else if ($type == 'downloads') {
                            $list = $download_cats;
                        } else if ($type == 'gallery') {
                            $list = $gallery_cats;
                        } else if ($type == 'events') {
                            $list = $event_cats;
                        } else {
                            $list = array();
                            foreach($post_cats as $cat) {
                                array_push($list, $cat->name);
                            };
                        }
                        foreach($list as $item) {
                            ?>
                            <a href="#"><li><?php echo $item; ?></li></a>
                            <?php
                        }
                        if (sizeof($list) < 1) {
                            ?>
                            <li>Keine Kategorien</li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="box-body">
                    <?php 
                    if ($excerpt == '') {
                        ?><p>Keinen Inhalt</p><?php
                    } else {
                        ?><p><?php echo $excerpt; ?></p><?php
                    }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <button class="post-link-button btn">Ansehen</button>
                    </a>
                </div>
            </div>
            <?php endwhile; else : ?> 
            <h2>Keine Einträge gefunden</h2>
        <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
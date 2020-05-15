<?php get_header(); ?>

<div class="archive-container container">
    <div class="row">
        <div class="archive--inner">
            <h1>
                <?php
                    $term = get_queried_object();
                    $word = $term->label;
                    if ($word == '') {
                        $word = $term->name;
                    }
                    if ($word == '') {
                        $word = $term->label;
                    }
                    if ($word == '') {
                        $word = $term->cat_name;
                    }
                    if ( is_day() ) :
                        printf( __( 'Tagesarchiv: %s' ), get_the_date() );
                    elseif ( is_month() ) :
                        printf( __( 'Monatsarchiv: %s' ), get_the_date( _x( 'F Y', 'monatliches datum format' ) ) );
                    elseif ( is_year() ) :
                        printf( __( 'Jahresarchiv: %s' ), get_the_date( _x( 'Y', 'jaehrliches datum format' ) ) );
                    else :
                        _e( 'Archiv: <b>' . $word . '</b>' );
                    endif;
                ?>
            </h1>
            <?php
            $type = get_post_type();
            $post_cats = get_categories();
            $post_tags = wp_get_post_terms( get_the_ID(), 'post_tag', array('fields' => 'all'));
            $subjects = wp_get_post_terms( get_the_ID(), 'subject-teacher', array('fields' => 'all'));
            $download_cats = wp_get_post_terms( get_the_ID(), 'categories-downloads', array('fields' => 'all'));
            $gallery_cats = wp_get_post_terms( get_the_ID(), 'categories-gallery', array('fields' => 'all'));
            $event_cats = wp_get_post_terms( get_the_ID(), 'categories-events', array('fields' => 'all'));
            $event_location = wp_get_post_terms( get_the_ID(), 'locations-events', array('fields' => 'all'));
            $event_date = get_post_meta(get_the_ID(), '_event_date_value', true);
            ?>
            <nav class="archive-navigation" role="navigation">
                <h2>Navigation Kategorien und Schlagworte</h2>
                <?php
                switch ($type) {
                    case 'post':
                        ?>
                        <ul class="<?php echo $type; ?>-navigation categories" role="navigation">
                            <?php foreach($post_cats as $post) { ?>
                                <?php $link = get_category_link($post); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $post->name; ?></li></a>
                            <?php } ?>
                        </ul>
                        <ul class="<?php echo $type; ?>-navigation tags" role="navigation">
                            <?php foreach($post_tags as $tag) { ?>
                                <?php $link = get_category_link($tag); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $tag->name; ?></li></a>
                            <?php } ?>
                        </ul>
                        <?php
                        break;
                    case 'events':
                        ?>
                        <ul class="<?php echo $type; ?>-navigation" role="navigation">
                            <p>Alle Kategorien:</p>
                            <?php foreach($event_cats as $eventcat) { ?>
                                <?php $link = get_category_link($eventcat); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $eventcat->name; ?></li></a>
                            <?php } ?>
                        </ul>
                        <ul class="<?php echo $type; ?>-navigation" role="navigation">
                            <p>Alle Orte:</p>
                            <?php foreach($event_location as $location) { ?>
                                <?php $link = get_category_link($location); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $location->name; ?></li></a>
                            <?php } ?>
                        </ul> <?php
                        break;
                    case 'teacher':
                        ?>
                        <ul class="<?php echo $type; ?>-navigation" role="navigation">
                            <?php foreach($subjects as $subject) { ?>
                                <?php $link = get_category_link($subject); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $subject->name; ?></li></a>
                            <?php } ?>
                        </ul> <?php
                        break;
                    case 'downloads':
                        ?>
                        <ul class="<?php echo $type; ?>-navigation" role="navigation">
                            <?php foreach($download_cats as $download) { ?>
                                <?php $link = get_category_link($download); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $download->name; ?></li></a>
                            <?php } ?>
                        </ul> <?php
                        break;
                    case 'gallery':
                        ?>
                        <ul class="<?php echo $type; ?>-navigation" role="navigation">
                            <?php foreach($gallery_cats as $gallery) { ?>
                                <?php $link = get_category_link($gallery); ?>
                                <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $gallery->name; ?></li></a>
                            <?php } ?>
                        </ul> <?php
                        break;
                    default:
                        echo 'Keinen Post Type angegeben';
                        break;
                } ?>
            </nav>
            <h2>Alle Einträge</h2>
            <?php
            if (have_posts()) : while (have_posts()) : the_post();
                $thumbnail = get_the_post_thumbnail_url();
                $type = get_post_type();
                ?>
                <article>
                    <div class="post-inner">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img class="w-100 article-image" src="<?php echo $thumbnail; ?>">
                        </a>

                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                                <?php if ($type == 'events') {
                                    ?>
                                    <p>(<?php foreach($event_location as $key => $location) {
                                        if ( $key == sizeof($event_location) - 1 ) {
                                            echo $location->name;
                                        } else {
                                            echo $location->name . ', ';
                                        }
                                    } ?> - <?php echo $event_date; ?>)</p>
                                    <?php
                                } ?>
                            </a>
                        </h2>

                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" target="_self"><button type="button" class="btn view-button">Ansehen</button></a>
                    </div>
                </article>
                <?php
            endwhile; endif;

            echo pagination(3);
            
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
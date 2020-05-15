<?php ?>

<div class="single-content-area single-events content-inner row">
    <?php
        /* Get all datas */
        $article = [];
        $article[ 'id' ] = get_the_ID();
        $article[ 'name' ] = get_the_title();
        $article[ 'excerpt' ] = get_the_excerpt();
        $article[ 'author' ] = get_the_author();
        $article[ 'date' ] = get_the_date();
        $article[ 'content' ] = get_the_content();
        $article[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
        $article[ 'link' ] = get_permalink();
        $article[ 'alt' ] = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
        $article[ 'location' ] = wp_get_post_terms( get_the_ID(), 'locations-events', array('fields' => 'all'));
        $article[ 'date' ] = get_post_meta(get_the_ID(), '_event_date_value', true);
    ?>
    
    <article class="post-single container-fluid">
        <div class="post-head row">
            <div class="head-left col-12 col-lg-6">
                <h1 class="article-headline"><?php echo $article[ 'name' ];?></h1>
                <div class="post-meta-data">
                    <p class="date">Erstellt am <b><?php echo $article[ 'date' ]; ?></b></p>
                    <p class="author">von <b><?php echo $article[ 'author' ]; ?></b></p>
                </div>
                <div class="post-meta-list">
                    <div class="list">
                        <p>Orte:</p>
                        <ul class="categorie-list">
                        <?php 
                            if ( ($article[ 'location' ]) ) {
                                foreach($article[ 'location' ] as $location) {
                                    $link = get_home_url() . '/' . $location->taxonomy . '/' . $location->slug;
                                    ?>
                                    <a href="<?php echo $link;?>" target="_self"><li class="item-location"><?php echo $location->name; ?></li></a>
                                    <?php
                                }
                            } else {
                                ?>
                                <span>Keine Kategorien eingetragen</span>
                                <?php
                            }?>
                        </ul>
                    </div>
                    <div class="list">
                        <p>Datum der Veranstaltung:</p>
                        <span><?php echo $article[ 'date' ]; ?></span>
                    </div>
                </div>
            </div>
            <div class="head-right col-12 col-lg-6">
                <img class="post-image w-100" src="<?php echo $article[ 'thumbnail' ]; ?>" alt="<?php echo $article[ 'alt' ]; ?>">
            </div>
        </div>
        <div class="content row">
            <div class="content-right col-12">
                <p class="content-text"><?php echo $article[ 'content' ]; ?></p>
            </div>
        </div>
        <?php the_content(); ?>
    </article>
</div>
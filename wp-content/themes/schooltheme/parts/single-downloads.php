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
        $article[ 'categories' ] = wp_get_post_terms( get_the_ID(), 'categories-downloads', array('fields' => 'all'));
    ?>
    
    <article class="post-single container-fluid">
        <div class="post-head row">
            <div class="head-left col-8">
                <h1 class="article-headline"><?php echo $article[ 'name' ];?></h1>
                <div class="post-meta-data">
                    <p class="date">Erstellt am <b><?php echo $article[ 'date' ]; ?></b></p>
                    <p class="author">von <b><?php echo $article[ 'author' ]; ?></b></p>
                </div>
                <div class="post-meta-list">
                    <div class="list">
                        <p>Geeignet für:</p>
                        <ul class="categorie-list">
                        <?php 
                            if ( ($article[ 'categories' ]) ) {
                                foreach($article[ 'categories' ] as $categorie) {
                                    $link = get_home_url() . '/' . $categorie->taxonomy . '/' . $categorie->slug;
                                    ?>
                                    <a href="<?php echo $link;?>" target="_self"><li class="item-categorie"><?php echo $categorie->name; ?></li></a>
                                    <?php
                                }
                            } else {
                                ?>
                                <span>Keine Kategorien eingetragen</span>
                                <?php
                            }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="head-right col-4">
                <span class="download-icon icon-download"></span>
            </div>
        </div>
        <div class="content row">
            <div class="content-right col-12">
                <p class="content-text"><?php echo $article[ 'content' ]; ?></p>
            </div>
        </div>
    </article>
</div>
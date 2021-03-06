<?php ?>

<div class="single-content-area single-post content-inner row">
    <?php
        /* Get all datas */
        $article = [];
        $article[ 'id' ] = get_the_ID();
        $article[ 'name' ] = get_the_title();
        $article[ 'excerpt' ] = get_the_excerpt();
        $article[ 'author' ] = get_the_author();
        $article[ 'date' ] = get_the_date();
        $article[ 'content' ] = get_the_content();
        $article[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/1100x200';
        $article[ 'link' ] = get_permalink();
        $article[ 'categories' ] = get_the_category($id, 'name');
        $article[ 'tags' ] = get_the_tags($id, 'name');
        $article[ 'alt' ] = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
    ?>
    
    <article class="post-single container-fluid">
        <div class="post-head row">
            <div class="head-left col-12 col-lg-12">
                <h1 class="article-headline"><?php echo $article[ 'name' ];?></h1>
                <div class="post-meta-data">
                    <p class="date">Erstellt am <b><?php echo $article[ 'date' ]; ?></b></p>
                    <p class="author">von <b><?php echo $article[ 'author' ]; ?></b></p>
                </div>
            </div>
            <div class="head-right col-12 col-lg-12">
                <img class="post-image w-100" src="<?php echo $article[ 'thumbnail' ]; ?>" alt="<?php echo $article[ 'alt' ]; ?>">
            </div>
        </div>
        <div class="content row">
            <div class="post-meta-list col-12">
                <div class="list">
                    <p>Katgeorien:</p>
                    <ul class="categorie-list">
                    <?php 
                        if ( ($article[ 'categories' ]) ) {
                            foreach($article[ 'categories' ] as $categorie) {
                                $link = get_home_url() . '/' . $categorie->taxonomy . '/' . $categorie->slug;
                                ?>
                                <li class="item-categorie"><a href="<?php echo $link;?>" target="_self"><?php echo $categorie->name; ?></a></li>
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
                    <p>Tags:</p>
                    <ul class="tag-list">
                        <?php 
                        if ( ($article[ 'tags' ]) ) {
                            foreach($article[ 'tags' ] as $tag) {
                                $link = get_home_url() . '/' . $tag->taxonomy . '/' . $tag->slug;
                                ?>
                                <li class="item-tag"><a href="<?php echo $link;?>" target="_self"><?php echo $tag->name; ?></a></li>
                                <?php
                            }
                        } else {
                            ?>
                            <span>Keine Tags eingetragen</span>
                            <?php
                        }?>
                    </ul>
                </div>
            </div>
            <div class="content-right col-12">
                <p class="content-text"><?php echo $article[ 'content' ]; ?></p>
            </div>
        </div>
    </article>
</div>
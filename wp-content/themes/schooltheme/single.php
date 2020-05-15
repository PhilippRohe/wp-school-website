<?php get_header(); ?>

<?php while ( have_posts() ) :
    
    /* The post */
    the_post();

    /* The content */
    get_template_part('parts/single', get_post_type());

    /* Post navigation */
    ?>
    <div class="article-navigation container-fluid">
        <div class="row">
            <?php the_post_navigation(); ?>
        </div>
    </div>
    <?php

    /* Comment area */
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

endwhile; ?>

<?php get_footer(); ?>
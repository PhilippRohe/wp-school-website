<?php get_header(); ?>

<div class="index-container container">
    <?php
    if (have_posts()) : while (have_posts()) : the_post();
        ?>
        <article class="index-content main--article row">
            <?php the_content(); ?>
        </article>
        <?php

    endwhile; endif; ?>
</div>

<?php get_footer(); ?>
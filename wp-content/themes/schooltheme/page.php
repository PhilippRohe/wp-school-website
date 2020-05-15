<?php get_header(); ?>

<div class="row">
    <div class="page-container container-fluid">
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <article class="page-content main--article row">
                <h1><?php the_title(); ?></h1>
                <div class="content w-100">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php

        endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
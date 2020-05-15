<?php get_header(); ?>

<div class="row">
    <div class="page-container front-page container-fluid">
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <article class="page-content main--article row">
                <div class="content w-100">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php

        endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
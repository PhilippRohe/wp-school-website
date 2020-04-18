<?php get_header(); ?>

<div class="bc--main-container">
    <div class="bc-container--search-results col-12">
        <div class="bc-container--search-results-head">
            <h1>Your search results for: <b><?php echo htmlspecialchars($_GET["s"]); ?></b></h1>
            <div class="bc-search--container">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="bc-container--search-results-body">
            <?php
            $args = array(
                'post_type'=> get_all_post_types(),
                's'    => $s,
                'paged' => $paged,
            );
            query_posts($args); ?>

            <div class="bc-search--results-content">
            <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
                <div class="bc-search--results-single">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p> 
                </div>
                <?php endwhile; else : ?> 
                <h2>No results found</h2>
            <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
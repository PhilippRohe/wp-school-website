<?php ?>

<div class="single-content-area content-inner row">
    <?php
        /* Get all datas */
        $subjects_slug = 'subject-teacher';
        $subjects = wp_get_post_terms( get_the_ID(), $subjects_slug, array( 'fields' => 'all' ) );
        $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );

        /* Save teacher data here */
        $teacher = [];
        $teacher[ 'id' ] = get_the_ID();
        $teacher[ 'name' ] = get_the_title();
        $teacher[ 'excerpt' ] = get_the_excerpt();
        $teacher[ 'content' ] = get_the_content();
        $teacher[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
        $teacher[ 'link' ] = get_permalink();
        $teacher[ 'subjects' ] = $subjects;
        $teacher[ 'alt' ] = $image_alt;
    ?>
    
    <article class="teacher-single container-fluid">
        <h1 class="article-headline row"><?php echo $teacher[ 'name' ];?></h1>
        <div class="content row">
            <div class="content-left col-12 col-lg-5">
                <img class="teacher-image w-100" src="<?php echo $teacher[ 'thumbnail' ]; ?>" alt="<?php echo $teacher[ 'alt' ]; ?>">
            </div>
            <div class="content-right col-12 col-lg-12">
                <h2 class="teacher-name">Das ist <?php echo $teacher[ 'name' ]; ?></h2>
                <ul class="subject-list">
                    <?php foreach($teacher[ 'subjects' ] as $subject) {
                        $link = get_category_link($subject);
                        ?>
                        <a href="<?php echo $link; ?>"><li><?php echo $subject->name; ?></li></a>
                        <?php
                    } ?>
                </ul>
                <p class="content-text"><?php echo $teacher[ 'content' ]; ?></p>
            </div>
        </div>
    </article>
</div>
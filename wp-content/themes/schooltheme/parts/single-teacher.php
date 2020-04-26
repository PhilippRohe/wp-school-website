<?php ?>

<div class="single-content-area">
        <?php
            /* Get all datas */
            $subjects_slug = 'subject-teacher';
            $subjects = wp_get_post_terms( get_the_ID(), $subjects_slug, array( 'fields' => 'names' ) );
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
        
        <article class="teacher-single container">
            <h1 class="article-headline row"><?php echo $teacher[ 'name' ];?> - Lehrer Überblick</h1>
            <div class="content row">
                <div class="content-left col-5">
                    <img class="teacher-image" src="<?php echo $teacher[ 'thumbnail' ]; ?>" alt="<?php echo $teacher[ 'alt' ]; ?>">
                    <h2 class="teacher-name"><?php echo $teacher[ 'name' ]; ?></h2>
                    <ul class="subject-list">
                    <?php foreach($teacher[ 'subjects' ] as $subject) {
                        ?>
                        <li><?php echo $subject; ?></li>
                        <?php
                    } ?>
                    </ul>
                </div>
                <div class="content-right col-7">
                    <p class="content-text"><?php echo $teacher[ 'content' ]; ?></p>
                </div>
            </div>
        </article>
</div>
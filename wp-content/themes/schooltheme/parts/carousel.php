<?php
$slider_id = esc_attr(get_option( 'style_settings_header_slider' ));
$images = load_images_from_slider($slider_id);
?>
<!-- Top image carousel -->
<div class="top-image-slider">
    <div id="topcarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($images as $key => $image) {
                ?>
                <div class="carousel-item<?php if ($key === 0) { echo ' active'; } ?>">
                    <img class="d-block w-100" src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
                <?php
            } ?>
        </div>
        <a class="carousel-control-prev" href="#topcarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Vorheriges Bild</span>
        </a>
        <a class="carousel-control-next" href="#topcarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Nächstes Bild</span>
        </a>
    </div>
</div>
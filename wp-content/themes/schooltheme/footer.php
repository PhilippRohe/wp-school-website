<?php wp_footer(); ?>

<?php
// Check if there are footer widgets.
$count_footer = 0;
if ( is_active_sidebar( 'bc-footer-one' ) ) {
    $count_footer += 1;
}
if ( is_active_sidebar( 'bc-footer-two' ) ) {
    $count_footer += 1;
}
if ( is_active_sidebar( 'bc-footer-three' ) ) {
    $count_footer += 1;
}
if (is_active_sidebar( 'bc-footer-four' ) ) {
    $count_footer += 1;
}

// Get column width for activated footers
$col_number = 12;
if ( $count_footer > 0 ) {
    $col_number = $col_number / $count_footer;
} else {
    $col_number = $col_number / 1;
}
$column_size = "col-md-" . $col_number;
?>

</main> <!-- END OF MAIN -->

<?php
if ( is_active_sidebar( 'bc-footer-one' ) or is_active_sidebar( 'bc-footer-two' ) or is_active_sidebar( 'bc-footer-three' ) or is_active_sidebar( 'bc-footer-four' ) ) : ?>
	<footer class="bc-footer-main footer-widgets-wrap"> <!-- START OF FOOTER -->

        <div class="container">
            <div class="bc-footer-widgets row"  role="complementary">
                <!-- Check for Footer Widgets 1 -->
                <?php if ( is_active_sidebar( 'bc-footer-one' ) ) : ?>
                    <aside class="bc-footer-level-one footer-widget-column widget-area <?php echo $column_size; ?>">
                        <?php dynamic_sidebar( 'bc-footer-one' ); ?>
                    </aside>
                <?php endif; ?>
                
                <!-- Check for Footer Widgets 2 -->
                <?php if ( is_active_sidebar( 'bc-footer-two' ) ) : ?>
                    <aside class="bc-footer-level-two footer-widget-column widget-area <?php echo $column_size; ?>">
                        <?php dynamic_sidebar( 'bc-footer-two' ); ?>
                    </aside>
                <?php endif; ?>
                
                <!-- Check for Footer Widgets 3 -->
                <?php if ( is_active_sidebar( 'bc-footer-three' ) ) : ?>
                    <aside class="bc-footer-level-three footer-widget-column widget-area <?php echo $column_size; ?>">
                        <?php dynamic_sidebar( 'bc-footer-three' ); ?>
                    </aside>
                <?php endif; ?>
                
                <!-- Check for Footer Widgets 4 -->
                <?php if ( is_active_sidebar( 'bc-footer-four' ) ) : ?>
                    <aside class="bc-footer-level-four footer-widget-column widget-area <?php echo $column_size; ?>">
                        <?php dynamic_sidebar( 'bc-footer-four' ); ?>
                    </aside>
                <?php endif; ?>
            </div>
        </div>

        <div class="bc-footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="footer-bar-left col-md-8 col-lg-8">
                        <?php $text_footer_left = esc_attr(get_option( 'bc_footer_text_left' )); ?>
                        <p><?php echo $text_footer_left; ?></p>
                        <span class="icon-hearth"></span>
                    </div>
                    <div class="footer-bar-right col-md-4 col-lg-4">
                        <?php $text_footer_right = esc_attr(get_option( 'bc_footer_text_right' )); ?>
                        <p><?php echo $text_footer_right; ?> &copy;</p>

                        <?php $social_footer = esc_attr(get_option( 'bc_show_social_footer' )); ?>
                        <?php if ($social_footer === 'on') {
                            ?>
                            <div class="footer-social-media">
                            <?php $all_socials = bc_get_social_media();
                                foreach ($all_socials as $social) {
                                ?>
                                    <a href="<?php echo $social['link']['url']; ?>" target="_blank">
                                        <div class="footer-social-box">
                                            <img src="<?php echo $social['image']['url']; ?>" alt="">
                                        </div>
                                    </a>
                                <?php
                                }
                            ?>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>

    </footer> <!-- END OF FOOTER -->

<?php endif; ?>

    <?php get_template_part('parts/free'); ?>

    </body>
</html>
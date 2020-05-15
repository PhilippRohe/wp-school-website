<?php wp_footer(); ?>

<?php $footer_text = esc_attr(get_option( 'footer_text_copyright' )); ?>

<?php
// Check if there are footer widgets.
$count_footer = 0;
if ( is_active_sidebar( 'footer-one' ) ) {
    $count_footer += 1;
}
if ( is_active_sidebar( 'footer-two' ) ) {
    $count_footer += 1;
}
if ( is_active_sidebar( 'footer-three' ) ) {
    $count_footer += 1;
}
if (is_active_sidebar( 'footer-four' ) ) {
    $count_footer += 1;
}

// Get column width for activated footers
$col_number = 12;
if ( $count_footer > 0 ) {
    $col_number = $col_number / $count_footer;
} else {
    $col_number = $col_number / 1;
}
$column_size = "col-lg-" . $col_number;
?>

        </main> <!-- END OF MAIN -->

    <?php
    if ( is_active_sidebar( 'footer-one' ) or is_active_sidebar( 'footer-two' ) or is_active_sidebar( 'footer-three' ) or is_active_sidebar( 'footer-four' ) ) : ?>
        <footer class="footer-main footer-widgets-wrap container-fluid"> <!-- START OF FOOTER -->
            <div class="row">
                <div class="footer-content container">
                    <div class="footer-widgets row"  role="complementary">
                        <!-- Check for Footer Widgets 1 -->
                        <?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
                            <aside class="footer-col footer-level-one footer-widget-column widget-area col-12 col-md-6 <?php echo $column_size; ?> ">
                                <ul class="footer-one-list">
                                    <?php dynamic_sidebar( 'footer-one' ); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                        
                        <!-- Check for Footer Widgets 2 -->
                        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
                            <aside class="footer-col footer-level-two footer-widget-column widget-area col-12 col-md-6 <?php echo $column_size; ?>">
                                <ul class="footer-two-list">
                                    <?php dynamic_sidebar( 'footer-two' ); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                        
                        <!-- Check for Footer Widgets 3 -->
                        <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
                            <aside class="footer-col footer-level-three footer-widget-column widget-area col-12 col-md-6 <?php echo $column_size; ?>">
                            <ul class="footer-three-list">
                                    <?php dynamic_sidebar( 'footer-three' ); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                        
                        <!-- Check for Footer Widgets 4 -->
                        <?php if ( is_active_sidebar( 'footer-four' ) ) : ?>
                            <aside class="footer-col footer-level-four footer-widget-column widget-area col-12 col-md-6 <?php echo $column_size; ?>">
                                <ul class="footer-four-list">
                                    <?php dynamic_sidebar( 'footer-four' ); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="footer-copyright container">
                    <div class="row">
                        <div class="left-copy col-12 col-lg-6"><?php echo $footer_text; ?> - Theme made for Schools | <?php echo date("Y"); ?> &copy;</div>
                        <div class="right-copy col-12 col-lg-6">
                        <?php
                            wp_nav_menu( array(
                                'theme_location'  => 'footer',
                                'container'       => 'div',
                                'container_class' => 'footer-menu',
                            ));
                        ?>
                        </div>
                    </div>
                </div>
            </div>          
        </footer> <!-- END OF FOOTER -->

<?php endif; ?>
    <?php get_template_part('parts/container'); ?>                       
    </body>
</html>
<?php

/* Enable elementor for every custom post type by default */
function elementor_add_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support', [ 'page', 'post', 'downloads', 'teacher' ] );

    foreach ( $cpt_support as $cpt_slug ) {
        add_post_type_support( $cpt_slug, 'elementor' );
    }
}
add_action( 'after_switch_theme', 'elementor_add_cpt_support' );

/* Disable all elementor widgets, that are not own widgets */
global $elementor_widget_blacklist;

$elementor_widget_blacklist = [
  'heading'
  ,'image'
  ,'text-editor'
  //,'video'
  ,'button'
  //,'divider'
  ,'spacer'
  ,'image-box'
  ,'google-maps'
  ,'icon'
  ,'icon-box'
  ,'image-gallery'
  //,'image-carousel'
  ,'icon-list'
  ,'counter'
  ,'progress'
  ,'testimonial'
  //,'tabs'
  ,'accordion'
  ,'toggle'
  ,'social-icons'
  ,'alert'
  ,'audio'
  ,'shortcode'
  ,'html'
  ,'menu-anchor'
  ,'sidebar'
  ,'star-rating'
  ,'read-more'

  // pro ----------------- //
  ,'posts'
  ,'portfolio'
  ,'slides'
  ,'form'
  ,'login'
  ,'media-carousel'
  ,'testimonial-carousel'
  ,'nav-menu'
  ,'pricing'
  ,'facebook-comment'
  ,'nav-menu'
  ,'animated-headline'
  ,'price-list'
  ,'price-table'
  ,'facebook-button'
  ,'facebook-comments'
  ,'facebook-embed'
  ,'facebook-page'
  ,'add-to-cart'
  ,'categories'
  ,'elements'
  ,'products'
  ,'flip-box'
  ,'carousel'
  ,'countdown'
  ,'share-buttons'
  ,'author-box'
  ,'breadcrumbs'
  ,'search-form'
  ,'post-navigation'
  ,'post-comments'
  ,'theme-elements'
  ,'blockquote'
  ,'template'
  ,'wp-widget-audio'
  ,'woocommerce'
  ,'social'
  ,'library'

  // wp widgets ----------------- //
  ,'wp-widget-pages'
  ,'wp-widget-archives'
  ,'wp-widget-media_audio'
  ,'wp-widget-media_image'
  ,'wp-widget-media_gallery'
  ,'wp-widget-media_video'
  ,'wp-widget-meta'
  ,'wp-widget-search'
  ,'wp-widget-text'
  ,'wp-widget-categories'
  ,'wp-widget-recent-posts'
  ,'wp-widget-recent-comments'
  ,'wp-widget-rss'
  ,'wp-widget-tag_cloud'
  ,'wp-widget-nav_menu'
  ,'wp-widget-custom_html'
  ,'wp-widget-polylang'
  ,'wp-widget-calendar'
  ,'wp-widget-elementor-library'
];

function remove_elementor_widgets($widgets_manager) {
    global $elementor_widget_blacklist;

    foreach($elementor_widget_blacklist as $widget_name){
      $widgets_manager->unregister_widget_type($widget_name);
    }
}

add_action('elementor/widgets/widgets_registered', 'remove_elementor_widgets', 15, 2);
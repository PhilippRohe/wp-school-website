<?php

$pluginList = get_option( 'active_plugins' );
/* The elementor plugin */
$plugin = 'elementor/elementor.php'; 
if ( in_array( $plugin , $pluginList ) ) {

    class My_Elementor_Widgets {

        protected static $instance = null;
    
        public static function get_instance() {
            if ( ! isset( static::$instance ) ) {
                static::$instance = new static;
            }
    
            return static::$instance;
        }
    
        protected function __construct() {
            require_once('elementor-last.php');
            require_once('elementor-testimonials.php');
            require_once('elementor-query.php');
            require_once('elementor-downloads.php');
            require_once('elementor-wysiwyg.php');
            require_once('elementor-slider.php');
            require_once('elementor-long-image.php');
            require_once('elementor-map.php');
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
        }
    
        public function register_widgets() {
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Long_Image() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Testimonials() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Latest_Widget() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Query() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Downloads() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Wysiwyg() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Slider() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Map() );
        }
    
    }
    
    add_action( 'init', 'my_elementor_init' );
    function my_elementor_init() {
        My_Elementor_Widgets::get_instance();
    }
    
    /* Create own elementor categorie */
    function add_elementor_widget_categories( $elements_manager ) {
    
        $elements_manager->add_category(
            'Schulplugins',
            [
                'title' => __( 'School', 'plugin-name' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }
    add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );
} else {
    function elementor_miss_notice() {
        ?>
        <div class="notice notice-warning">
            <p><?php _e( 'Elementor Hinweis: Um alle Funktionen des Themes nutzen zu können, bitte das Plugin Elementor installieren oder aktivieren!', 'my_plugin_textdomain' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'elementor_miss_notice' );
}
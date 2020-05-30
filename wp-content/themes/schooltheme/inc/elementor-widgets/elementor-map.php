<?php
namespace Elementor;

class Elementor_Map extends Widget_Base {
	
	public function get_name() {
		return 'elementor-map-widget';
	}
	
	public function get_title() {
		return '[School] Map';
	}
	
	public function get_icon() {
		return 'fas fa-map-marker';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }
	
	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'elementor' ),
			]
        );
        
        $this->add_control(
			'headline',
			[
				'label' => __( 'Überschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Überschrift',
				'placeholder' => '',
			]
        );

		$this->add_control(
			'address',
			[
				'label' => __( 'Adresse', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'plugin-domain' ),
				'placeholder' => __( '', 'plugin-domain' ),
			]
        );
        
		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 30,
					],
				],
				'separator' => 'before',
			]
        );
        
        $this->add_control(
			'min-height',
			[
				'label' => __( 'Mindesthöhe Container', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 300,
				'max' => 600,
				'step' => 5,
				'default' => 350,
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $zoom = $settings['zoom'];
        $address = $settings['address'];
        $min_height = $settings['min-height'];
        ?>


        <section class="section map--section w-100 container-fluid">
            <div class="row">
                <h1 class="widget-headline col-12"><?php echo $headline; ?></h1>
            </div>
            <div class="row">
                <div class="map-container js--map-container col-12">
                <?php
                printf(
                    '<div class="map-embed" style="min-height: ' . $min_height . 'px;"><iframe src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
                    rawurlencode( $address ),
                    absint( $zoom['size'] ),
                    esc_attr( $address )
                );
                ?>
                </div>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
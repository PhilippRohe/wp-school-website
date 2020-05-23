<?php
namespace Elementor;

class Elementor_Start_Image extends Widget_Base {
	
	public function get_name() {
		return 'elementor-start-image-widget';
	}
	
	public function get_title() {
		return '[School] Start Bild';
	}
	
	public function get_icon() {
		return 'fas fa-image';
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
			'title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
                'label_block' => true,
                'rows' => 3,
			]
		);

        $this->add_control(
			'image',
			[
				'label' => __( 'Bild auswählen', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
			]
        );
        
        $this->add_control(
			'height',
			[
				'label' => __( 'Höhe', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 50,
				'max' => 500,
				'step' => 5,
				'default' => 250,
			]
        );
        
        $this->add_control(
			'font_color',
			[
				'label' => __( 'Schriftfarbe', 'plugin-domain' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $title = $settings[ 'title' ];
        $height = $settings[ 'height' ];
        $font_color = $settings[ 'font_color' ];
        $image = $settings[ 'image' ];
        $image_alt = get_post_meta( $image[ 'id' ], '_wp_attachment_image_alt', true );
        $font_margin = ($height - 70) / 2;

        ?>

        <section class="section image-start--section w-100 container-fluid">
            <p style="margin-top: <?php echo $font_margin; ?>px; color: <?php echo $font_color; ?>" class="start-image-title"><?php echo $title; ?></p>
            <img style="max-height: <?php echo $height; ?>px;" class="start-image w-100" src="<?php echo $image[ 'url' ]; ?>" alt="<?php echo $image_alt; ?>">
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
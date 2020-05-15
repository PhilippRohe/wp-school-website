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
		return 'fas fa-quote-right';
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


		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $image_text = $settings[ 'image_text' ];
        $image = $settings[ 'image' ];
        $image_alt = get_post_meta( $image[ 'id' ], '_wp_attachment_image_alt', true );

        ?>

        <section class="section image-start--section w-100 container-fluid">
            <img class="start-image w-100" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
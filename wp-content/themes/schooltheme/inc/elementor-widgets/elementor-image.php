<?php
namespace Elementor;

class Elementor_Image extends Widget_Base {
	
	public function get_name() {
		return 'elementor-image-widget';
	}
	
	public function get_title() {
		return '[School] Image';
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
        
        $repeater = new Repeater();

		$this->add_control(
			'image',
			[
				'label' => __( 'Bitte Bild wählen', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $image = $settings['image'];

        ?>

        <section class="section image--section w-100">
            <img src="<?php echo $image["url"]; ?>" alt="">
            <p>test</p>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
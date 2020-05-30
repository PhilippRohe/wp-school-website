<?php
namespace Elementor;

class Elementor_Wysiwyg extends Widget_Base {
	
	public function get_name() {
		return 'elementor-wysiwyg-widget';
	}
	
	public function get_title() {
		return '[School] WYSIWYG';
	}
	
	public function get_icon() {
		return 'fas fa-spell-check';
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
				'placeholder' => 'Überschrift',
			]
        );

        $this->add_control(
			'headline_type',
			[
				'label' => __( 'Überschrift Typ', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'plugin-domain' ),
					'h2'  => __( 'H2', 'plugin-domain' ),
					'h3'  => __( 'H3', 'plugin-domain' ),
					'h4'  => __( 'H4', 'plugin-domain' ),
					'h5'  => __( 'H5', 'plugin-domain' ),
					'h6'  => __( 'H6', 'plugin-domain' ),
				],
			]
		);

        $this->add_control(
			'editor',
			[
				'label' => __( 'Inhalt', 'plugin-domain' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( '', 'plugin-domain' ),
				'placeholder' => __( '', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $headline_type = $settings['headline_type'];
        $editor = $settings['editor'];
        ?>

        <section class="section wysiwyg--section w-100 container-fluid">
            <div class="row">
                <<?php echo $headline_type; ?> class="section-headline col-12"><?php echo $headline; ?></<?php echo $headline_type; ?>>
            </div>
            <div class="row">
                <?php echo $editor; ?>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
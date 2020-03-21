<?php
namespace Elementor;

class Elementor_Intro extends Widget_Base {
	
	public function get_name() {
		return 'elementor-intro-widget';
	}
	
	public function get_title() {
		return '[School] Intro';
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
			'headline',
			[
				'label' => __( 'Überschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Testimonial Headline',
				'placeholder' => 'Überschrift',
			]
        );

        $this->add_control(
			'subline',
			[
				'label' => __( 'Unterüberschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Testimonial Headline',
				'placeholder' => 'Unterüberschrift',
			]
        );

        $this->add_control(
			'background',
			[
				'label' => __( 'Wähle das Hintergrundbild', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        
        $this->add_control(
			'vertical_alignment',
			[
				'label' => __( 'Vertikale Ausrichtung', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center'  => __( 'Zentriert', 'plugin-domain' ),
					'top' => __( 'Oben', 'plugin-domain' ),
					'bottom' => __( 'Unten', 'plugin-domain' ),
				],
			]
        );
        
        $this->add_control(
			'horizontal_alignment',
			[
				'label' => __( 'Horizontale Ausrichtung', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center'  => __( 'Zentriert', 'plugin-domain' ),
					'left' => __( 'Links', 'plugin-domain' ),
					'right' => __( 'Rechts', 'plugin-domain' ),
				],
			]
        );
        
        $this->add_control(
			'enable_actions',
			[
				'label' => __( 'Aktionsboxen anzeigen', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Ja', 'your-plugin' ),
				'label_off' => __( 'Nein', 'your-plugin' ),
				'return_value' => TRUE,
				'default' => TRUE,
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $subline = $settings['subline'];
        $background = $settings['background'];
        $vertical = $settings['vertical_alignment'];
        $horizontal = $settings['horizontal_alignment'];
        $actionbox = $settings['enable_actions'];

        $position = 'object-position: ' . $vertical . ' ' . $horizontal . ';';

        $image_alt = get_post_meta( $background['id'], '_wp_attachment_image_alt', true );

        ?>

        <section class="section intro--section w-100">
            <img class="intro--background-image" src="<?php echo $background['url']; ?>" alt="<?php echo $image_alt; ?>" style="<?php echo $position; ?>">
            <div class="headline-box">
                <h1><?php echo $headline; ?></h1>
                <h2><?php echo $subline; ?></h2>
            </div>
            <?php if ($actionbox) {
                ?>
                <div class="action-box container">
                    <div class="row">
                        <div class="action col-3">
                            <img class="action-icon" src="" alt="">
                            <p class="action-text">Textfeld 1</p>
                        </div>
                        <div class="action col-3">

                            <p class="action-text">Textfeld 1</p>
                        </div>
                            <div class="action col-3">
                                
                        <p class="action-text">Textfeld 1</p>
                    </div>
                    </div>
                </div>
                <?php
            }?>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
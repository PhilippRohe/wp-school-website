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

        $repeater->add_control(
			'box_title', [
				'label' => __( 'Box Title', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Titel der Box' , 'plugin-domain' ),
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'box_icon',
			[
				'label' => __( 'Box Icon', 'text-domain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
        );

        $repeater->add_control(
			'box_color',
			[
				'label' => __( 'Box Farbe', 'plugin-domain' ),
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
        
        $repeater->add_control(
			'box_link',
			[
				'label' => __( 'Box Link', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
        
        $this->add_control(
			'headline',
			[
				'label' => __( 'Überschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Headline',
				'placeholder' => 'Überschrift',
			]
        );

        $this->add_control(
			'subline',
			[
				'label' => __( 'Unterüberschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Headline',
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
        
        $this->add_control(
			'boxes',
			[
				'label' => __( 'Boxen erstellen', 'plugin-domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'box_title' => __( 'Box Title', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ box_title }}}',
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
        $boxes = $settings['boxes'];

        $box_size = (12 / sizeof($boxes)) - 1;


        $position = 'object-position: ' . $vertical . ' ' . $horizontal . ';';

        $image_alt = get_post_meta( $background['id'], '_wp_attachment_image_alt', true );

        ?>

        <section class="section intro--section w-100">
            <img class="intro--background-image" src="<?php echo $background['url']; ?>" alt="<?php echo $image_alt; ?>" style="<?php echo $position; ?>">
            <div class="headline-box container">
                <div class="row">
                    <h1><?php echo $headline; ?></h1>
                    <h2><?php echo $subline; ?></h2>
                </div>
            </div>
            <?php if ($actionbox) {
                ?>
                <div class="action-box container">
                    <div class="row">
                        <?php foreach($boxes as $box) {
                            $box_link = $box['box_link'] ? $box['box_link'] : '';
                            ?>
                            <a href="<?php echo $box_link; ?>" class="action col-<?php echo $box_size; ?>" style="background: <?php echo $box['box_color'].'cc'; ?>;">
                                <i class="action-icon <?php echo($box['box_icon']['value']); ?>"></i>
                                <p class="action-text"><?php echo $box['box_title']; ?></p>
                            </a>
                            <?php
                        }?>
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
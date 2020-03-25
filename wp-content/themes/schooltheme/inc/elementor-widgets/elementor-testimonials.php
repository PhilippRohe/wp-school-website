<?php
namespace Elementor;

class Elementor_Testimonials extends Widget_Base {
	
	public function get_name() {
		return 'elementor-testimonials';
	}
	
	public function get_title() {
		return '[School] Testimonials';
	}
	
	public function get_icon() {
		return 'fas fa-quote-right';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }
    
	
	public function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'elementor' ),
			]
        );
        
        $repeater = new Repeater();

        $repeater->add_control(
			'name', [
				'label' => __( 'Name', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Name' , 'plugin-domain' ),
				'label_block' => true,
			]
        );

        $repeater->add_control(
			'details', [
				'label' => __( 'Details', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Details' , 'plugin-domain' ),
				'label_block' => true,
			]
        );

        $repeater->add_control(
			'content',
			[
				'label' => __( 'Inhalt', 'plugin-domain' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Inhalt', 'plugin-domain' ),
				'placeholder' => __( 'Inhalt des Testimonials', 'plugin-domain' ),
			]
        );

        $repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
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
        
        $repeater->add_control(
			'image',
			[
				'label' => __( 'Bild', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $this->add_control(
			'headline',
			[
				'label' => __( 'Überschrift', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
				'placeholder' => 'Überschrift',
			]
        );

        $this->add_control(
			'color_bg',
			[
				'label' => __( 'Hintergrund Farbe', 'plugin-domain' ),
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

        $this->add_control(
			'color_font',
			[
				'label' => __( 'Text Farbe', 'plugin-domain' ),
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
        
        $this->add_control(
			'testimonials',
			[
				'label' => __( 'Testimonials erstellen', 'plugin-domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Name', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonials = $settings['testimonials'];
        $headline = $settings['headline'];
        $color_bg = $settings['color_bg'] ? 'background: ' . $settings['color_bg'] . '; ' : '';
        $color_font = $settings['color_font'] ? 'color: ' . $settings['color_font'] . '; ' : '';

        ?>

        <section class="section testimonials--section w-100 container-fluid" style="<?php echo $color_bg; echo $color_font; ?>">
            <div class="row">
                <h2 class="headline col-12"><?php echo $headline; ?></h2>
            </div>
            <div class="row">
                <?php foreach($testimonials as $testimonial) {
                    $link_open = $testimonial['link']['url'] ? '<div class="head">' : '<a class="head" href="' . $testimonial['link'] . '">';
                    $link_close = $testimonial['link']['url'] ? '</div>' : '</a>';
                    ?>
                    <div class="testimonial col-4">
                        <?php echo $link_open; ?>
                            <div class="left">
                                <img src="<?php echo $testimonial['image']['url']; ?>" alt="Testimonial profile logo">
                            </div>
                            <div class="right">
                                <p class="name"><?php echo $testimonial['name']; ?></p>
                                <p class="details"><?php echo $testimonial['details']; ?></p>
                            </div>
                        <?php echo $link_close; ?>
                        <q class="body" cite="<?php echo $testimonial['link']['url']; ?>">
                            <i class="icon icon-quote"></i>
                            <?php echo $testimonial['content']; ?>
                        </q>
                    </div>
                    <?php
                } ?>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
<?php
namespace Elementor;

class Elementor_Slider extends Widget_Base {
	
	public function get_name() {
		return 'elementor-slider';
	}
	
	public function get_title() {
		return '[School] Slider';
	}
	
	public function get_icon() {
		return 'fas fa-images';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }
    

    protected function load_all_sliders() {

        $slider_array = [];
        $args = array(
            'post_type' => 'gallery',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
        );
           
        $query = new \WP_Query($args); 
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            $slider_array[get_the_ID()] = get_the_title();

        endwhile; else : ?>
            <p>Keine Beiträge gefunden</p>
        <?php endif; wp_reset_postdata();

        $slider_array[-1] = 'Slider auswählen';

        return $slider_array;
    }
	
	public function _register_controls() {

        $all_slides = $this->load_all_sliders();

        $this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Daten zur Abfrage', 'elementor' ),
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
			'slider',
			[
				'label' => __( 'Slider wählen', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $all_slides,
			]
        );

        $this->add_control(
			'show_text',
			[
				'label' => __( 'Beschreibungstext anzeigen?', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Ja', 'your-plugin' ),
				'label_off' => __( 'Nein', 'your-plugin' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
        
        $this->add_control(
			'zoom',
			[
				'label' => __( 'Detailansicht erlauben', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Ja', 'your-plugin' ),
				'label_off' => __( 'Nein', 'your-plugin' ),
				'return_value' => 'true',
                'default' => 'true',
                'condition' => [
					'show_text' => 'true'
                ],
			]
        );
        
        $this->add_control(
			'show_dots',
			[
				'label' => __( 'Punkte anzeigen?', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Ja', 'your-plugin' ),
				'label_off' => __( 'Nein', 'your-plugin' ),
				'return_value' => 'true',
				'default' => 'true',
			]
        );

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $slider_id = ($settings['slider'] === -1) ? 'Bitte Slider auswählen' : $settings['slider'];
        $gallery = load_images_from_slider($slider_id);
        $zoom = ($settings['zoom'] == 'true') ? ' js--image-title' : '';
        $dots = ($settings['show_dots'] == 'true') ? '' : ' no-dots';
        $show_text = ($settings['show_text'] == 'true') ? '' : ' no-text';

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        ?>

        <div slider-id="<?php echo $randomString; ?>" class="image-slider-modal js--modal">
            <div class="window">
                <img class="modal-image js--modal-image" src="https://www.placehold.it/800x800" alt="Empty image">
            </div>
        </div>

        <section class="section slider--section w-100 container-fluid">
            <div class="row">
                <h2 class="widget-headline"><?php echo $headline; ?></h2>
            </div>
            <div class="row">
                <div class="slider-container col-12">
                <?php if ($slider_id == -1) {
                    ?>
                    <p class="empty-slider">Bitte wählen Sie einen Slider aus</p>
                    <?php
                }  else { ?>
                    <div class="image-slider js--image-slider<?php echo $dots; ?><?php echo $show_text; ?>">
                    <?php foreach($gallery as $key => $image) {
                        ?>
                        <div slider-id="<?php echo $randomString; ?>" data-id="<?php echo $image[ 'id' ]; ?>" class="carousel-item">
                            <img class="d-block w-100 js--slider-image" src="<?php echo $image[ 'src' ]; ?>" alt="<?php echo $image[ 'alt' ]; ?>">
                            <div class="carousel-caption" aria-hidden="true">
                                <h3 class="image-title<?php echo $zoom; ?>"><?php echo $image[ 'title' ]; ?></h3>
                                <p><?php echo $image[ 'description' ]; ?></p>
                            </div>
                        </div>
                        <?php
                    } ?>
                    </div>
                <?php } ?>

                </div>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
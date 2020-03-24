<?php
namespace Elementor;

class Elementor_Latest_News extends Widget_Base {
	
	public function get_name() {
		return 'elementor-latest-news-widget';
	}
	
	public function get_title() {
		return '[School] Letzte Blogbeiträge';
	}
	
	public function get_icon() {
		return 'fas fa-quote-right';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }
    

    protected function load_last_articles($number) {

        if ($number < 1 || $number > 4) {
            $number = 3;
        }

        $all_arcticles = [];
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'orderby' => 'title',
            'order' => 'ASC'
        );
           
        $query = new \WP_Query($args); 
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            $article = [];
            $article['title'] = get_the_title();
            $article['excerpt'] = get_the_excerpt();
            $article['thumbnail'] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
            $article['link'] = get_permalink();

            array_push($all_arcticles, $article);

        endwhile; else : ?>
            <p>Keine Beiträge gefunden</p>
        <?php endif; wp_reset_postdata();

        return $all_arcticles;
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

        $number = 3;
        if ($number < 1 || $number > 4) {
            $number = 3;
        }
        $all_arcticles = $this->load_last_articles($number);

        ?>

        <section class="section last-news--section w-100 container-fluid">
            <div class="row">
                <div class="articles d-flex flex-row container">
                    <div class="row">
                        <?php foreach($all_arcticles as $article) {
                            ?>
                            <div class="single-article col-<?php echo (12 / $number); ?> align-self-center">
                                <div class="article-head">
                                    <img src="<?php echo $article['thumbnail']; ?>" alt="">
                                </div>
                                <div class="article-body">
                                    <a href="<?php echo $article['link']; ?>"><h2 class="title"><?php echo $article['title']; ?></h2></a>
                                    <p class="excerpt"><?php echo $article['excerpt']; ?></p>
                                    <a href="<?php echo $article['link']; ?>" class="link"><button class="btn">Beitrag ansehen</button></a>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
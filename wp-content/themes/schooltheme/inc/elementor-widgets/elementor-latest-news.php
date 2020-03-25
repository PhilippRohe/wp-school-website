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
    

    protected function load_last_articles($post_type, $number, $order, $sort) {

        $all_arcticles = [];
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number,
            'orderby' => $order,
            'order' => $sort,
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
			'post_type',
			[
				'label' => __( 'Post Type wählen', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => [
					'post'  => __( 'Beiträge', 'plugin-domain' ),
					'page' => __( 'Seiten', 'plugin-domain' ),
				],
			]
		);

        $this->add_control(
			'order',
			[
				'label' => __( 'Sortierung', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
                    'date'  => __( 'Datum', 'plugin-domain' ),
					'title'  => __( 'Title', 'plugin-domain' ),
					'rand' => __( 'Zufall', 'plugin-domain' ),
				],
			]
        );
        
        $this->add_control(
			'sort',
			[
				'label' => __( 'Sortierung', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => __( 'Aufsteigend', 'plugin-domain' ),
					'DESC'  => __( 'Absteigend', 'plugin-domain' ),
				],
			]
        );
        
        $this->add_control(
			'number',
			[
				'label' => __( 'Anzahl', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];

        $number = $settings['number'];
        $post_type = $settings['post_type'];
        $order = $settings['order'];
        $sort = $settings['sort'];

        $all_arcticles = $this->load_last_articles($post_type, $number, $order, $sort);

        ?>

        <section class="section last-news--section w-100 container-fluid">
            <div class="row">
                <h2 class="headline"><?php echo $headline; ?></h2>
            </div>
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
<?php
namespace Elementor;

class Elementor_Latest_Widget extends Widget_Base {
	
	public function get_name() {
		return 'elementor-latest-widget';
	}
	
	public function get_title() {
		return '[School] Letzte Einträge';
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
            $article['id'] = get_the_ID();
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
					'teacher' => __( 'Lehrer', 'plugin-domain' ),
					'events' => __( 'Events', 'plugin-domain' ),
					'downloads' => __( 'Downloads', 'plugin-domain' ),
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
				'max' => 50,
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
                <div class="articles d-flex flex-row container-fluid">
                    <div class="row">
                        <?php foreach($all_arcticles as $article) {
                            ?>
                            <div class="single-article col-sm-12 col-lg-<?php echo (12 / $number); ?> align-self-center">
                                <div class="article-head">
                                    <img src="<?php echo $article['thumbnail']; ?>" alt="">
                                </div>
                                <div class="article-body">
                                    <a href="<?php echo $article['link']; ?>"><h2 class="title"><?php echo $article['title']; ?></h2></a>


                                    <?php
                                    $type = $post_type;
                                    ?>
                                    <nav class="categories-navigation" role="navigation">
                                        <?php
                                        switch ($type) {
                                            case 'post':
                                                $post_cats = get_categories();
                                                $post_tags = wp_get_post_terms( $article[ 'id' ], 'post_tag', array('fields' => 'all'));
                                                ?>
                                                <ul class="<?php echo $type; ?>-navigation categories" role="navigation">
                                                    <?php foreach($post_cats as $post) { ?>
                                                        <?php $link = get_category_link($post); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $post->name; ?></li></a>
                                                    <?php } ?>
                                                </ul>
                                                <ul class="<?php echo $type; ?>-navigation tags" role="navigation">
                                                    <?php foreach($post_tags as $tag) { ?>
                                                        <?php $link = get_category_link($tag); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $tag->name; ?></li></a>
                                                    <?php } ?>
                                                </ul>
                                                <?php
                                                break;
                                            case 'events':
                                                $event_cats = wp_get_post_terms( $article[ 'id' ], 'categories-events', array('fields' => 'all'));
                                                $event_location = wp_get_post_terms( $article[ 'id' ], 'locations-events', array('fields' => 'all'));
                                                $event_date = get_post_meta( $article[ 'id' ], '_event_date_value', true);
                                                ?>
                                                <ul class="<?php echo $type; ?>-navigation" role="navigation">
                                                    <p>Alle Kategorien:</p>
                                                    <?php foreach($event_cats as $eventcat) { ?>
                                                        <?php $link = get_category_link($eventcat); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $eventcat->name; ?></li></a>
                                                    <?php } ?>
                                                </ul>
                                                <ul class="<?php echo $type; ?>-navigation" role="navigation">
                                                    <p>Alle Orte:</p>
                                                    <?php foreach($event_location as $location) { ?>
                                                        <?php $link = get_category_link($location); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $location->name; ?></li></a>
                                                    <?php } ?>
                                                </ul> <?php
                                                break;
                                            case 'teacher':
                                                $subjects = wp_get_post_terms( $article[ 'id' ], 'subject-teacher', array('fields' => 'all'));
                                                ?>
                                                <ul class="<?php echo $type; ?>-navigation" role="navigation">
                                                    <?php foreach($subjects as $subject) { ?>
                                                        <?php $link = get_category_link($subject); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $subject->name; ?></li></a>
                                                    <?php } ?>
                                                </ul> <?php
                                                break;
                                            case 'downloads':
                                                $download_cats = wp_get_post_terms( $article[ 'id' ], 'categories-downloads', array('fields' => 'all'));
                                                ?>
                                                <ul class="<?php echo $type; ?>-navigation" role="navigation">
                                                    <?php foreach($download_cats as $download) { ?>
                                                        <?php $link = get_category_link($download); ?>
                                                        <a rel="follow" href="<?php echo $link; ?>" target="_self"><li class="item"><?php echo $download->name; ?></li></a>
                                                    <?php } ?>
                                                </ul> <?php
                                                break;
                                            default:
                                                echo 'Keinen Post Type angegeben';
                                                break;
                                        } ?>
                                    </nav>


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
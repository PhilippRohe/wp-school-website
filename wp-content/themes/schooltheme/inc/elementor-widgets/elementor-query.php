<?php
namespace Elementor;

class Elementor_Query extends Widget_Base {
	
	public function get_name() {
		return 'elementor-query';
	}
	
	public function get_title() {
		return '[School] Einträge Box';
	}
	
	public function get_icon() {
		return 'fas fa-list-ul';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }
    

    protected function load_last_entries($post_type, $number, $order, $sort) {

        $all_entries = [];
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number,
            'orderby' => $order,
            'order' => $sort,
        );

        $subject_slug = 'subject-teacher';
           
        $query = new \WP_Query($args); 
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            $entry = [];
            $entry[ 'id' ] = get_the_ID();
            $entry[ 'title' ] = get_the_title();
            $entry[ 'excerpt' ] = get_the_excerpt();
            $entry[ 'content' ] = get_the_content();
            $entry[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
            $entry[ 'link' ] = get_permalink();
            if ($post_type === 'teacher') {
                /* Load teachers subjects */
                $subjects = wp_get_post_terms( get_the_ID(), 'subject-teacher', array('fields' => 'all'));
                $entry[ 'categories' ] = $subjects;
            }
            if ($post_type === 'events') {
                /* Load teachers subjects */
                $event_cats = wp_get_post_terms( get_the_ID(), 'categories-events', array('fields' => 'all'));
                $entry[ 'categories' ] = $event_cats;
            }
            if ($post_type === 'downloads') {
                /* Load teachers subjects */
                $download_cats = wp_get_post_terms( get_the_ID(), 'categories-downloads', array('fields' => 'all'));
                $entry[ 'categories' ] = $download_cats;
            }
            if ($post_type === 'post') {
                /* Load teachers subjects */
                $post_cats = get_categories();
                $post_tags = wp_get_post_terms( get_the_ID(), 'post_tag', array('fields' => 'all'));
                $entry[ 'categories' ] = $post_cats;
            }

            array_push($all_entries, $entry);

        endwhile; else : ?>
            <p>Keine Beiträge gefunden</p>
        <?php endif; wp_reset_postdata();

        return $all_entries;
    }
	
	public function _register_controls() {

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
			'style',
			[
				'label' => __( 'Style auswählen', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boxed',
				'options' => [
                    'boxed'  => __( 'Box', 'plugin-domain' ),
				],
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
					'gallery' => __( 'Galerien', 'plugin-domain' ),
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
        
        $this->add_control(
			'min-height',
			[
				'label' => __( 'Mindesthöhe', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 250,
				'max' => 800,
				'step' => 10,
				'default' => 350,
			]
        );
        
        $this->add_control(
			'max-height',
			[
				'label' => __( 'Maximalhöhe', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 250,
				'max' => 800,
				'step' => 10,
				'default' => 800,
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $style = $settings['style'];

        /* Date for the database query */
        $number = $settings['number'];
        $post_type = $settings['post_type'];
        $order = $settings['order'];
        $sort = $settings['sort'];

        $min_height = $settings['min-height'] ? $settings['min-height'] : 350;
        $max_height = $settings['max-height'] ? $settings['max-height'] : 800;

        $all_entries = $this->load_last_entries($post_type, $number, $order, $sort);

        ?>

        <section class="section query--section w-100 container-fluid <?php echo $style; ?>">
            <div class="row">
                <h2 class="section-headline"><?php echo $headline; ?></h2>
            </div>
            <div class="row all-entries">
                <?php foreach($all_entries as $entry) {
                    ?>
                    <a href="<?php echo $entry[ 'link' ]; ?>" class="entry-box col-12 col-sm-12 col-md-4" target="_self" style="min-height: <?php echo $min_height; ?>px; max-height: <?php echo $max_height; ?>px;">
                        <img class="entry-image" src="<?php echo $entry[ 'thumbnail' ]; ?>" alt="<?php $entry[ 'content' ];?> - Bild des <?php echo $post_type; ?>s">
                        <div class="meta-box" aria-hidden="false">
                            <h2 class="title"><?php echo $entry[ 'title' ]; ?></h2>
                            <div class="content">
                            <?php foreach($entry[ 'categories' ] as $categorie) {
                                ?>
                                    <p class="content-single"><?php echo $categorie->name; ?></p>
                                <?php
                            } ?>
                            </div>
                        </div>
                    </a>
                    <?php
                } ?>
            </div>
        </section>

        <?php 
	}
	

	protected function _content_template() {

    }
	
	
}
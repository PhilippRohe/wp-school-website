<?php
namespace Elementor;

class Elementor_Query extends Widget_Base {
	
	public function get_name() {
		return 'elementor-query';
	}
	
	public function get_title() {
		return '[School] Einträge';
	}
	
	public function get_icon() {
		return 'fas fa-quote-right';
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

            /* Load teachers subjects */
            $subjects = wp_get_post_terms( get_the_ID(), $subject_slug, array( 'fields' => 'names' ) );

            $entry = [];
            $entry[ 'id' ] = get_the_ID();
            $entry[ 'title' ] = get_the_title();
            $entry[ 'excerpt' ] = get_the_excerpt();
            $entry[ 'content' ] = get_the_content();
            $entry[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
            $entry[ 'link' ] = get_permalink();
            if ($post_type === 'teacher') {
                $entry[ 'subjects' ] = $subjects;
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
        $style = $settings['style'];

        /* Date for the database query */
        $number = $settings['number'];
        $post_type = $settings['post_type'];
        $order = $settings['order'];
        $sort = $settings['sort'];

        $all_entries = $this->load_last_entries($post_type, $number, $order, $sort);

        ?>

        <section class="section query--section w-100 container-fluid <?php echo $style; ?>">
            <div class="row">
                <h1 class="section-headline"><?php echo $headline; ?></h1>
            </div>
            <div class="row all-entries">
                <?php foreach($all_entries as $entry) {
                    ?>
                    <a href="<?php echo $entry[ 'link' ]; ?>" class="entry-box col-12 col-sm-6 col-md-4" target="_self">
                        <img class="entry-image" src="<?php echo $entry[ 'thumbnail' ]; ?>" alt="<?php echo $entry[ 'content' ];?> - Bild des <?php echo $post_type; ?>s">
                        <div class="meta-box" aria-hidden="false">
                            <h2 class="title"><?php echo $entry[ 'title' ]; ?></h2>
                            <div class="content">
                            <?php foreach($entry[ 'subjects' ] as $subject) {
                                ?>
                                    <p class="content-single"><?php echo $subject; ?></p>
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
<?php
namespace Elementor;

class Elementor_Downloads extends Widget_Base {
	
	public function get_name() {
		return 'elementor-downloads-widget';
	}
	
	public function get_title() {
		return '[School] Downloads';
	}
	
	public function get_icon() {
		return 'fas fa-download';
	}
	
	public function get_categories() {
		return [ 'Schulplugins' ];
    }

    protected function load_download_list() {

        $all_downloads = [];
        $args = array(
            'post_type' => 'downloads',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
        );


        $query = new \WP_Query($args); 
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            $all_downloads[get_the_ID()] = get_the_title();

        endwhile; else : ?>
        <?php endif; wp_reset_postdata();

        return $all_downloads;
    }


    protected function load_download_by_id( $id ) {
        $all_downloads = [];
        $args = array(
            'p' => $id,
            'post_type' => 'downloads',
        );

        $query = new \WP_Query($args); 

        $categories_slug = 'categories-downloads';
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            /* Load teachers subjects */
            $link = get_post_meta(get_the_ID(), '_download_link_value', true);
            $categories = wp_get_post_terms( get_the_ID(), $categories_slug, array( 'fields' => 'all' ) );

            $download = [];
            $download[ 'id' ] = get_the_ID();
            $download[ 'title' ] = get_the_title();
            $download[ 'excerpt' ] = get_the_excerpt();
            $download[ 'content' ] = get_the_content();
            $download[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
            $download[ 'link' ] = get_permalink();
            $download[ 'download' ] = $link;
            $download[ 'categories' ] = $categories;

            array_push($all_downloads, $download);

        endwhile; else : ?>
        <?php endif; wp_reset_postdata();

        return $all_downloads;
    }
    
    protected function load_downloads() {

        $all_downloads = [];
        $args = array(
            'post_type' => 'downloads',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $categories_slug = 'categories-downloads';

        $query = new \WP_Query($args); 
           
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

            /* Load teachers subjects */
            $link = get_post_meta(get_the_ID(), '_download_link_value', true);
            $categories = wp_get_post_terms( get_the_ID(), $categories_slug, array( 'fields' => 'all' ) );

            $download = [];
            $download[ 'id' ] = get_the_ID();
            $download[ 'title' ] = get_the_title();
            $download[ 'excerpt' ] = get_the_excerpt();
            $download[ 'content' ] = get_the_content();
            $download[ 'thumbnail' ] = strlen(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : 'https://placehold.it/360x200';
            $download[ 'link' ] = get_permalink();
            $download[ 'download' ] = $link;
            $download[ 'categories' ] = $categories;

            array_push($all_downloads, $download);

        endwhile; else : ?>
        <?php endif; wp_reset_postdata();

        return $all_downloads;
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
                'label_block' => true,
			]
        );

        $this->add_control(
			'choose_one',
			[
				'label' => __( 'Nur bestimmten Download auswählen', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Ja', 'your-plugin' ),
				'label_off' => __( 'Nein', 'your-plugin' ),
				'return_value' => 'true',
                'default' => 'false',
                'label_block' => true,
			]
        );
        
        $this->add_control(
			'single_download',
			[
				'label' => __( 'Spezifischer Download', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
                'options' => $this->load_download_list(),
                'condition' => [
					'choose_one' => 'true'
                ],
                'label_block' => true,
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $headline = $settings['headline'];
        $choose_one = $settings['choose_one'];
        $single_download = $settings['single_download'];
        $downloads = ($choose_one == 'true') ? $this->load_download_by_id($single_download) : $this->load_downloads();
        ?>

        <section class="section downloads--section w-100 container-fluid">
            <h2 class="widget-headline row"><?php echo $headline; ?></h2>
            <div class="all-downloads row">
                <?php foreach($downloads as $download) {
                    $size = ($choose_one == 'true') ? ' col-12' : ' col-12 col-md-12 col-lg-6';
                    ?>
                    <div class="download-box<?php echo $size; ?>">
                        <div class="top">
                            <div class="left-side">
                                <a href="<?php echo $download[ 'download' ]; ?>">
                                    <span class="download-icon icon-download"></span>
                                </a>
                            </div>
                            <div class="right-side">
                                <h2><?php echo $download[ 'title' ]; ?></h2>
                                <ul class="categories-list">
                                <?php foreach($download[ 'categories' ] as $categorie) {
                                    $link = get_category_link($categorie);
                                    ?>
                                    <li><a href="<?php echo $link; ?>"><?php echo $categorie->name; ?></a></li>
                                    <?php
                                } ?>
                                </ul>
                                <p class="content"><?php echo $download[ 'excerpt' ]; ?></p>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="download-container" href="<?php echo $download[ 'download' ]; ?>" target="_blank">
                                <div class="btn download-button">Jetzt downloaden</div>
                            </a>
                        </div>
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
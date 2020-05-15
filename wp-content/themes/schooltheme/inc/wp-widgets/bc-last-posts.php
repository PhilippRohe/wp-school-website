<?php

// Creating the widget 
class bc_last_posts extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'bc-last-posts', 
            // Widget name will appear in UI
            'BC | Last Posts', 
            // Widget description
            array ( 
                'description' => 'Last Posts Widget by BananaCoding', 
            ) 
        );
    }

    public function get_all_post_types() {
        $all_types = get_post_types();

        return $all_types;
    }

    public function get_all_posts_from_post_type($type, $number, $sort) {

        $result = array();

        $args = array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'orderby' => $sort,
            'order' => 'ASC'
        );

        $custom_query = new \WP_Query($args); 

        if ($custom_query->have_posts()) : while($custom_query->have_posts()) : $custom_query->the_post(); ?> 
            <?php
            $post;
            $post['id'] = get_the_ID();
            $post['title'] = get_the_title(get_the_ID());
            $post['excerpt'] = get_the_excerpt(get_the_ID());
            $post['image'] = get_the_post_thumbnail(get_the_ID());
            $post['link'] = get_the_permalink(get_the_ID());
            $post['date'] = get_the_date('d-m-Y', get_the_ID());
            $post['type'] = $type;
            if ($type == 'teacher') {
                $post['subject'] = wp_get_post_terms( get_the_ID(), 'subject-teacher', array('fields' => 'names') );
            } else if ($type == 'downloads') {
                $post['download_link'] = get_post_meta( get_the_ID(), '_download_link_value', true );
            } else if ($type == 'events') {
                $post['event_date'] = get_post_meta( get_the_ID(), '_event_date_value', true );
            }

            array_push($result, $post);

            endwhile; else : ?> 
        <?php endif; wp_reset_postdata();

        return $result;

    }
    
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $post_type = apply_filters( 'widget_post_type', $instance['post_type'] );
        $number = apply_filters( 'widget_number', $instance['number'] );
        $sort = apply_filters( 'widget_number', $instance['sort'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        // This is where you run the code and display the output
        $posts = $this->get_all_posts_from_post_type($post_type, $number, $sort);
        ?>
        <section class="bc-footer--last-posts">
            <?php if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title']; ?>
            <?php foreach($posts as $single) {
                ?>
                <a class="bc-footer--post" href="<?php echo $single['link']; ?>">
                    <div class="bc--foter-post-left">
                        <?php 
                        if ($single['image']) {
                            echo $single['image'];
                        } else {
                            ?> <div class="image-placeholder"></div> <?php
                        } ?>   
                    </div>
                    <div class="bc--foter-post-right">
                        <h3><?php echo $single['title']; ?></h3>
                        <?php if ($single['type'] != 'downloads') {
                            echo $single['excerpt'];
                        } ?>
                        <?php if ($single['type'] == 'teacher') {
                            ?><p class="small"><?php echo implode($single['subject'], ', '); ?></p><?php
                        } else if ( $single['type'] == 'events') {
                            ?><p class="small"><?php echo $single['event_date']; ?></p><?php
                        } else {
                            ?><p class="small"><?php echo $single['date']; ?></p><?php
                        } ?>
                    </div>
                    <span class="icon-arrowsingle icon"></span>
                </a>
                <?php
            } ?>
        </section>
        <?php
        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {

        // Set widget title
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titel hier einfügen' );
        }

        // Set post type
        if ( isset( $instance[ 'post_type' ] ) ) {
            $post_type = $instance[ 'post_type' ];
        }
        else {
            $post_type = 'post';
        }

        // Set number
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }
        else {
            $number = 5;
        }

        // Set sort
        if ( isset( $instance[ 'sort' ] ) ) {
            $sort = $instance[ 'sort' ];
        }
        else {
            $sort = __( 'Sortierung wählen' );
        }

        $post_types = $this->get_all_post_types();
        $sort_list = array(
            'title' => 'Titel',
            'date' => 'Datum',
            'rand' => 'Zufall',
        );
        // Widget admin form output
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>


        <p>
            <label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type wählen:' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'post_type' ); ?>" id="<?php echo $this->get_field_id( 'post_type' ); ?>"> <?php
            foreach ($post_types as $type) {
                ?>
                <?php if ($type === $post_type) {
                    ?> <option selected value="<?php echo $type; ?>"><?php echo $type; ?></option> <?php
                } else {
                    ?> <option value="<?php echo $type; ?>"><?php echo $type; ?></option> <?php
                } ?>
                <?php
            } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number:' ); ?></label>
            <input min="1" max="10" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'sort' ); ?>"><?php _e( 'Sortierung wählen:' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'sort' ); ?>" id="<?php echo $this->get_field_id( 'sort' ); ?>"> <?php
            foreach ($sort_list as $key => $sorting) {
                ?>
                <?php if ($key === $sort) {
                    ?> <option selected value="<?php echo $key; ?>"><?php echo $sorting; ?></option> <?php
                } else {
                    ?> <option value="<?php echo $key; ?>"><?php echo $sorting; ?></option> <?php
                } ?>
                <?php
            } ?>
            </select>
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['sort'] = ( ! empty( $new_instance['sort'] ) ) ? strip_tags( $new_instance['sort'] ) : '';
        return $instance;
    }
}
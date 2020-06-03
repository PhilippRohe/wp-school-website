<?php

// Creating the widget 
class bc_company extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'bc-company', 
            // Widget name will appear in UI
            'School | Einrichtung', 
            // Widget description
            array ( 
                'description' => 'Informationen über das Unternehmen bzw. die Schule', 
            ) 
        );
    }
    
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $company_description = apply_filters( 'widget_description', $instance['company_description'] );
        $company_name = apply_filters( 'widget_name', $instance['company_name'] );
        $company_street = apply_filters( 'widget_street', $instance['company_street'] );
        $company_city = apply_filters( 'widget_city', $instance['company_city'] );
        $image = esc_attr(get_option( 'bc_menu_logo' ));

        $email = esc_attr(get_option( 'contact_settings_mail' ));
        $phone = esc_attr(get_option( 'contact_settings_phone' ));
        $map = esc_attr(get_option( 'contact_settings_map' ));
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        // This is where you run the code and display the output
        ?>
        <section class="bc-footer--company container-fluid">
            <?php if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title']; ?>
            <div class="company-widget--body row">
                <div class="company-content col-12">
                    <p><?php echo $company_description; ?></p>
                </div>
                <div class="company-phone col-12">
                    <div class="container-fluid">
                        <div class="row flex-row">
                            <span class="icon-phone icon col-4"></span>
                            <a href="tel:<?php echo $email; ?>" class="col-8">
                                <p><?php echo $phone; ?></p>
                                <span>Deutschland</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="company-address col-12">
                    <div class="container-fluid">
                        <div class="row flex-row">
                            <span class="icon-map icon col-4"></span>
                            <address class="col-8">
                                <a href="<?php echo $map; ?>">
                                    <span><?php echo $company_name; ?></span>
                                    <span><?php echo $company_street; ?></span>
                                    <span><?php echo $company_city; ?></span>
                                </a>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="company-mail col-12">
                    <div class="container-fluid">
                        <div class="row flex-row">
                            <span class="icon-mail icon col-4"></span>
                            <a href="mailto:<?php echo $email; ?>" class="col-8">
                                <p><?php echo $email; ?></p>
                                <span>Jetzt kontaktieren!</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        echo $args['after_widget'];
    }
            
    /* Widget Backend */
    public function form( $instance ) {

        /* Set widget title */
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Title hier einfügen', 'wpb_widget_domain' );
        }

        /* Set widget description */
        if ( isset( $instance[ 'company_description' ] ) ) {
            $company_description = $instance[ 'company_description' ];
        }
        else {
            $company_description = __( 'Beschreibung hier einfügen', 'wpb_widget_domain' );
        }

        /* Set widget company name */
        if ( isset( $instance[ 'company_name' ] ) ) {
            $company_name = $instance[ 'company_name' ];
        }
        else {
            $company_name = __( 'Name', 'wpb_widget_domain' );
        }

        /* Set widget company street */
        if ( isset( $instance[ 'company_street' ] ) ) {
            $company_street = $instance[ 'company_street' ];
        }
        else {
            $company_street = __( 'Straße', 'wpb_widget_domain' );
        }

        /* Set widget company street */
        if ( isset( $instance[ 'company_city' ] ) ) {
            $company_city = $instance[ 'company_city' ];
        }
        else {
            $company_city = __( 'Stadt', 'wpb_widget_domain' );
        }


        /* Widget admin form output */
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'company_description' ); ?>"><?php _e( 'Beschreibung:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'company_description' ); ?>" name="<?php echo $this->get_field_name( 'company_description' ); ?>" value="<?php echo esc_attr( $company_description ); ?>"><?php echo esc_attr( $company_description ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'company_name' ); ?>"><?php _e( 'Name:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'company_name' ); ?>" name="<?php echo $this->get_field_name( 'company_name' ); ?>" type="text" value="<?php echo esc_attr( $company_name ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'company_street' ); ?>"><?php _e( 'Straße:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'company_street' ); ?>" name="<?php echo $this->get_field_name( 'company_street' ); ?>" type="text" value="<?php echo esc_attr( $company_street ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'company_city' ); ?>"><?php _e( 'Stadt mit PLZ:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'company_city' ); ?>" name="<?php echo $this->get_field_name( 'company_city' ); ?>" type="text" value="<?php echo esc_attr( $company_city ); ?>" />
        </p>


        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['company_description'] = ( ! empty( $new_instance['company_description'] ) ) ? strip_tags( $new_instance['company_description'] ) : '';
        $instance['company_name'] = ( ! empty( $new_instance['company_name'] ) ) ? strip_tags( $new_instance['company_name'] ) : '';
        $instance['company_street'] = ( ! empty( $new_instance['company_street'] ) ) ? strip_tags( $new_instance['company_street'] ) : '';
        $instance['company_city'] = ( ! empty( $new_instance['company_city'] ) ) ? strip_tags( $new_instance['company_city'] ) : '';
        return $instance;
    }
}
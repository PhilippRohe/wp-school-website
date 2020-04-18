<?php

/* Remove dashboard widgets */
function remove_dashboard_widgets() {
    	/* remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); */
		/* remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); */
        /* remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); */
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		/* remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); */
		/* remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); */
		/* remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); */
		/* remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); */
        /* remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); */
        remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
}
add_action( 'admin_init', 'remove_dashboard_widgets' ); 


/* Add custom dashboard widget to dashboard */
function custom_dashboard_widgets() {
    global $wp_meta_boxes;
    /* Add custom widget */
    wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_theme');
}
add_action('wp_dashboard_setup', 'custom_dashboard_widgets');
 
function custom_dashboard_theme() {
    echo '<p>Herzlich Willkommen bei dem WordPress Themes für Schulen.<br><br>Dieses Theme wurde im Rahmen einer Projektarbeit an der Universität des Saarlandes programmiert.
    Dieses Theme eignet sich vor allem für Schul- und Bildungswebseiten.<br><br>Haben Sie Fragen? Wenden sich gerne per E-Mail mir Ihrer Frage an <a href="mailto:philrohe94@web.de">philrohe94@web.de</a></p>';
}
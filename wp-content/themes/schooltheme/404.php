<?php get_header(); ?>

<div class="notfound-container container">
    <div class="row">
        <div class="container--inner">
            <h1><?php _e( 'Seite wurde nicht gefunden' ); ?></h1>
            <p><?php _e( 'Es scheint so, als würde die Seite nicht existieren. Vielleicht hilft Ihnen die Suche?' ); ?></p>
            
            <?php get_search_form(); ?>
            
            <?php if(is_user_logged_in()) { ?>
                <div class="alert alert-info notice-container">
                    <p class="h4"><?php _e('Hinweis für Administrator (Sie sind eingeloggt)'); ?></p>
                    <p><?php _e('Sollten Sie vermehrt 404-Fehler bekommen, hilft es die Permalinks unter <strong>Einstellungen</strong> - <strong>Permalinks</strong> neu zu speichern. Sie sehen diese Nachricht nur, weil Sie eingeloggt sind.'); ?></p>
                </div>
            <?php } else {
                ?>
                <div class="alert alert-info notice-container">
                    <p class="h4"><?php _e('Hinweis zur Suche'); ?></p>
                    <p><?php _e('Nutzen Sie das <strong>Suchfeld</strong>, um viele weiteren Artikel und Seiten auf unserer Webseite zu finden'); ?></p>
                </div>
                <?php
            } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

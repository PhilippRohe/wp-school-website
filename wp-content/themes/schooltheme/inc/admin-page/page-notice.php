<?php

/* Notice settings page */
function notice_settings_page() {
    ?>
    <h1>Allgemeine Hinweise zum Theme</h1>
    <ul class="notice-list">
        <li>
            <h2>Hinweise zu Fonts und Schriften</h2>
            <p>Das Schooltheme nutzt lizenufreie Google-Fonts, die unter der OFL Lizenz frei zu verwenden sind.</p>
        </li>
        <li>
            <h2>Hinweise Font Awesome / Icons</h2>
            <p>Die in diesem Theme verwendeten Icons stammen von Font Awesome. Diese dürfen ebenfalls unter der GPL Lizenz und der CC 4.0 Lizenz
                frei verwendet werden. Ein Code zur Nutzung muss in den <a href="<?php echo admin_url() . 'admin.php?page=school_main_settings'; ?>">Einstellungen</a> dieses Themes eingetragen werden.
            </p>
        </li>
        <li>
            <h2>Updates und Git Respository</h2>
            <p>Alle Updates und alle Dateien, sowie die aktuelleste Version dieses Themes sind in folgendem Git Respository zu finden:
                <a href="https://github.com/PhilippRohe/wp-school-website">https://github.com/PhilippRohe/wp-school-website</a>
            </p>
        </li>
        <li>
            <h2>Hinweise zur Erstellung</h2>
            <p>Dieses Theme wurde im Rahmen einer Projektarbeit an der Universität des Saarlandes erstellt.</p>
        </li>
    </ul>
    <?php
}
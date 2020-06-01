<?php

/* Notice settings page */
function notice_settings_page() {
    ?>
    <h1>Allgemeine Hinweise zum Theme</h1>
    <ul class="notice-list">
        <li>
            <h2>Hinweise zu Fonts und Schriften</h2>
            <p>Das Schooltheme nutzt lizenufreie Google-Fonts, die unter der <a rel="nofollow" target="_blank" href="https://de.wikipedia.org/wiki/SIL_Open_Font_License">OFL Lizenz</a> frei zu verwenden sind.</p>
        </li>
        <li>
            <h2>Hinweise Font Awesome / Icons</h2>
            <p>Die in diesem Theme verwendeten Icons (sowohl die, die fester Teil des Themes sind, also auch die, die nachträglich abgeändert werden können) stammen von Font Awesome. Diese dürfen ebenfalls unter der GPL Lizenz und der CC 4.0 Lizenz
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
            <p>Dieses WordPress Theme wurde im Rahmen einer Projektarbeit an der Universität des Saarlandes erstellt.</p>
        </li>
        <li>
            <h2>Theme Lizenz</h2>
            <p>Lizenz: GNU General Public License v2 or later. Schooltheme is free software: you can redistribute it and/or modify it under 
                the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or 
                any later version. <a href="https://www.gnu.org/licenses/gpl-3.0.en.html">https://www.gnu.org/licenses/gpl-3.0.en.html</a></p>
        </li>
        <li>
            <h2>Kontakt</h2>
            <p><a href="mailto:philrohe94@web.de">Philipp Rohe</a></p>
        </li>
    </ul>
    <?php
}
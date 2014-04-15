<?php
/*
Plugin Name: Change backend language
Version: 0.5
Plugin URI: http://forum.wordpress-deutschland.org/konfiguration/32642-frontend-soll-englisch-sein-adminbereich-deutsch-engl-od-deut-download-nehmen.html
Description: Changes the backend language
Author: Oliver Schlöbe
Author URI: http://www.schloebe.de/
*/
 
function os_setAdminLang($locale) {
    if( WP_ADMIN === true ) {
        $locale = 'en_GB';
        return $locale;
    }
    return $locale;
}
 
add_filter('locale', 'os_setAdminLang', 1, 1);

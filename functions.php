<?php

require_once('lib/helpers.php');
require_once('lib/enqueue-assets.php');
require_once('lib/sidebars.php');
require_once('lib/theme-support.php');
require_once('lib/navigation.php');
// require_once('lib/columns.php');

function _themename_load_textdomain() {
    load_theme_textdomain('_themename', get_template_directory() . '/languages');
}
add_action('after_setup_theme', '_themename_load_textdomain');

?>
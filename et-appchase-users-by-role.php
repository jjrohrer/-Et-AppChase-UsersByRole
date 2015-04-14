<?php
/*
Plugin Name: -ET-AppChase-Users-UsersByRole
Plugin URI:
Description: This plugin shows Users by Role with ability to skip some.
Version: 0.80
Author: Evgen "EvgenDob" Dobrzhanskiy & JJ Rohrer
Plugin URI: https://github.com/jjrohrer/Et-AppChase-Users-by-Role
Author URI: http://www.ascendly.com/about/
GitHub Plugin URI: https://github.com/jjrohrer/-Et-AppChase-UsersByRole
Requires:
*/
$capability_needed_to_view_menu = 'etac_operator';// Hint: user also needs 'list_users' capability;
$capability_needed_to_view_settings_menu = 'etac_dynadev_devconfigurer';

#include('modules/functions.php');
#include('modules/shortcodes.php');
include('modules/settings.php');
#include('modules/meta_box.php');
#include('modules/widgets.php');
include('modules/hooks.php');
#include('modules/cpt.php');
include('modules/scripts.php');
#include('modules/ajax.php');
require_once(ABSPATH . 'wp-settings.php');

//error_reporting(0);

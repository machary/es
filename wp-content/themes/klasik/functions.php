<?php

/********** KLASIK DEFINITION *************/
global $themeoptionsvalue,  $meta_boxes;

if ( ! isset( $content_width ) ) $content_width = 1140;
$child_path			= get_stylesheet_directory() . '/';
$admin_path 		= get_template_directory() . '/admin/';
$includes_path 		= get_template_directory() . '/includes/';
$meta_boxes 		= array(); 

define('KLASIK_THEMENAME', 'Klasik');
define('KLASIK_PARENTMENU_SLUG', 'klasiktheme-settings');

/********** END KLASIK DEFINITION *************/

//Theme Options
require_once $admin_path . 'options.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Loading Style Css
require_once $includes_path . 'theme-metaboxes.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Header function
require_once $includes_path . 'header-function.php';

//Footer function
require_once $includes_path . 'footer-function.php';

//Shortcode
require_once $includes_path . 'theme-shortcode.php';


//Loading jQuery
require_once $includes_path . 'theme-scripts.php';

//Loading Style Css
require_once $includes_path . 'theme-styles.php';

//Theme Configuration
require_once $child_path . 'config.php';

if(file_exists($child_path . 'includes/child-functions.php')){
	require_once $child_path . 'includes/child-functions.php';
}

if(file_exists($child_path . 'includes/child-metaboxes.php')){
	require_once $child_path . 'includes/child-metaboxes.php';
}

if(file_exists($child_path . 'includes/child-shortcodes.php')){
	require_once $child_path . 'includes/child-shortcodes.php';
}


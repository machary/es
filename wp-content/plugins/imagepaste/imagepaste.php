<?php
/*
 Plugin Name: Image Paste
 Plugin URI: http://www.zingiri.com
 Description: Image Paste allows you to copy and paste images from your desktop to the Wordpress editor
 Author: Zingiri
 Version: 1.0.1
 Author URI: http://www.zingiri.com/
 */

if (!defined("IMAGEPASTE_PLUGIN")) {
	$imagepaste_plugin=str_replace(realpath(dirname(__FILE__).'/..'),"",dirname(__FILE__));
	$imagepaste_plugin=substr($imagepaste_plugin,1);
	define("IMAGEPASTE_PLUGIN", $imagepaste_plugin);
}

if (file_exists(dirname(__FILE__).'/source.inc.php')) require(dirname(__FILE__).'/source.inc.php');
define("IMAGEPASTE_URL", WP_CONTENT_URL . "/plugins/".IMAGEPASTE_PLUGIN."/");
if (!defined("IMAGEPASTE_JSDIR")) define("IMAGEPASTE_JSDIR","");

add_action("init","imagepaste_init");
add_action('admin_head','imagepaste_admin_header');
add_action('admin_notices', 'imagepaste_admin_notices');

function imagepaste_admin_notices() {
	$errors=array();

	$upload=wp_upload_dir();
	if ($upload['error']) $errors[]=$upload['error'];
	if (count($errors) > 0) {
		echo "<div id='zing-warning' style='background-color:pink' class='updated fade'><p><strong>";
		foreach ($errors as $message) echo 'Image Paste: '.$message.'<br />';
		echo "</strong></p></div>";
	}
}

function imagepaste_admin_header() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;
	echo '<script type="text/javascript" src="'.IMAGEPASTE_URL.'js/'.IMAGEPASTE_JSDIR.'jquery.paste_image_reader.js" ></script>';
}

function imagepaste_init() {
	if (is_admin()) wp_enqueue_script('jquery');
}

function imagepaste_addbuttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
	return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_imagepaste_tinymce_plugin");
		add_filter('mce_buttons', 'register_imagepaste_button');
	}
}


function register_imagepaste_button($buttons) {
	array_push($buttons, "separator", "tinyimagepaste");
	return $buttons;
}


// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_imagepaste_tinymce_plugin($plugin_array) {
	$plugin_array['tinyimagepaste'] = plugins_url().'/'.IMAGEPASTE_PLUGIN.'/tinymce/'.IMAGEPASTE_JSDIR.'editor_plugin.js';
	return $plugin_array;
}

// init process for button control
add_action('init', 'imagepaste_addbuttons');

add_action('wp_ajax_imagepaste_action', 'imagepaste_action_callback');

function imagepaste_action_callback() {
	$result=array('error'=>'');
	$upload = wp_upload_dir();
	$uploadUrl=$upload['url'];
	$uploadDir=$upload['path'];

	list($data,$image)=explode(';',$_REQUEST['dataurl']);
	list($field,$type)=explode(':',$data);
	list($encoding,$content)=explode(',',$image);
	if ($type=='image/png') $extension='png';

	$name=md5($_REQUEST['dataurl']);
	if (!$extension) {
		$result['error']="Could not determine image extension type";
	} else {
		$file=$uploadDir.'/'.$name.'.'.$extension;
		$fileUrl=$uploadUrl.'/'.$name.'.'.$extension;
		file_put_contents($file,base64_decode($content));
		$result['url']=$fileUrl;
		$result['elementid']=$_REQUEST['elementid'];
	}
	echo json_encode($result);
	die(); // this is required to return a proper result
}

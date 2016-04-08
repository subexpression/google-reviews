<?php 
/**
* Plugin Name: Google Reviews by Fusionfarm
* Plugin URI: http://www.fusionfarm.com/
* Description: Plugin for manually adding Google Reviews | <a href="http://fusionfarm.com/wp-content/uploads/2016/03/Google-Reviews-Plugin-Training-Docs.pdf" target="_blank">View Documentation</a>
* Version: 1.0.0
* Author: Greg Apel
* Author URI: http://www.fusionfarm.com/
* License: GPL12
*/
defined('ABSPATH') or die('No script kiddies please!');
define('FFT_URL', plugins_url('ff-google-reviews', dirname(__FILE__)));
include(WP_PLUGIN_DIR . '/ff-google-reviews/inc/cpt.php');
include(WP_PLUGIN_DIR . '/ff-google-reviews/inc/meta.php');
include(WP_PLUGIN_DIR . '/ff-google-reviews/inc/reviews.php');
include(WP_PLUGIN_DIR . '/ff-google-reviews/inc/actions.php');
$this_file = __FILE__;
$update_check = 'http://iplusplus.dev.fusionfarm.com/plugins/ff-google-reviews.chk';
/*
add_action('init', 'wptuts_activate_au');
function wptuts_activate_au(){
    include(WP_PLUGIN_DIR . '/ff-google-reviews/auto-update.php');
    $wptuts_plugin_current_version = '1.0.0';
    $wptuts_plugin_remote_path = 'http://iplusplus.dev.fusionfarm.com/plugins/';
    $wptuts_plugin_slug = plugin_basename(__FILE__);
    new wp_auto_update($wptuts_plugin_current_version, $wptuts_plugin_remote_path, $wptuts_plugin_slug);
}*/

/*add_action( 'init', 'check_for_updates' );
function check_for_updates()
{*/
	require_once ( 'auto-update.php' );
	$plugin_current_version = '1.0';
	$plugin_remote_path = 'http://iplusplus.dev.fusionfarm.com/plugins/update.php';
	$plugin_slug = plugin_basename( __FILE__ );
	/*$license_user = 'user';
	$license_key = 'abcd';*/
	new WP_AutoUpdate ( $plugin_current_version, $plugin_remote_path, $plugin_slug, $license_user, $license_key );
/*}*/
?>
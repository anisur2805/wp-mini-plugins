<?php
/*
 * Plugin Name: Myplugin
 * Plugin URI: https://github.com/anisur2805/myplugin
 * Description: Myplugin is a standard WordPress plugin.
 * Version: 1.0.0
 * Author: Anisur Rahman
 * Author URI: https://github.com/anisur2805
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: myplugin
 * Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function myplugin_load_textdomain(){
	load_plugin_textdomain( 'myplugin', false, plugin_dir_path( __FILE__ ). 'languages/' );
}
add_action('plugins_loaded', 'myplugin_load_textdomain');

if(is_admin()){

	require_once plugin_dir_path( __FILE__ ). 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ). 'admin/setting-page.php';
	require_once plugin_dir_path( __FILE__ ). 'admin/register-settings.php';
	require_once plugin_dir_path( __FILE__ ). 'admin/settings-callback.php';
	require_once plugin_dir_path( __FILE__ ). 'admin/settings-validate.php';

}

// comment goes here

	require_once plugin_dir_path( __FILE__ ). 'includes/core-functions.php';


// Default plugin options
function myplugin_options_default(){
	return array(
		'custom_url'		=> 'https://wordpress.org',
		'custom_title'		=> esc_html__('Powered by WordpPess', 'myplugin'),
		'custom_style'		=> 'disable',
		'custom_message'	=> '<p class="custom-message">'.esc_html__('My custom message', 'myplugin').'</p>',
		'custom_footer'		=> esc_html__('Special Message for users', 'myplugin'),
		'custom_toolbar'	=> false,
		'custom_scheme'		=> 'default',
	);
}


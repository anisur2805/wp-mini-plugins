<?php
/**
*
*@package Anisur
*
*/
/*
Plugin Name:  Anisur
Plugin URI:   #
Description:  Basic WordPress Plugin 
Version:      20181101
Author:       Anisur Rahman
Author URI:   https://github.com/anisur2805/
License:      GPL2
License URI:  #
Text Domain:  ar
*/

if(!defined('ABSPATH')){
	die();
}

if( !class_exists( 'AnisurPlugin' )) {
class AnisurPlugin {

	// function __construct(){
	// 	add_action('init', array($this, 'custom_post_type'));
	// }

	public $plugin;

	function __construct(){
		$this->plugin = plugin_basename( __FILE__ );
	}

	function register(){
		add_action('admin_enqueue_scripts', array( $this, 'enqueue'));

		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) ) ;
	}

	public function settings_link( $links ){
		$settings_link = '<a href="admin.php?page=anisur_plugin">Setting</a>';
		array_push( $links, $settings_link );
		return $links;
	}

	public function add_admin_pages(){
		add_menu_page( 'Anisur Plugin', 'Anisur', 'manage_options', 'anisur_plugin', array( $this, 'admin_index'), 'dashicons-store', 110 );
	}

	function admin_index(){
		require_once plugin_dir_path( __FILE__ ). 'templates/admin.php';
	}

	protected function create_post_type() {
		add_action( 'init', array( $this, 'custom_post_type'));
	}

	function custom_post_type(){
		register_post_type( 'mybook', ['public'=>true, 'label'=> 'Books'] );
	}

	function enqueue(){
		wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
		wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
	}

	function activate(){
		require_once plugin_dir_path( __FILE__ ). 'inc/anisur-activate.php';
		AnisurPluginActivate::activate();
	}

}	

	$anisurPlugin = new AnisurPlugin();
	$anisurPlugin->register();

// activation
register_activation_hook( __FILE__, array($AnisurPlugin, 'activate') );

// deactivation
	require_once plugin_dir_path( __FILE__ ). 'inc/anisur-deactivate.php';
	register_deactivation_hook( __FILE__, array('AnisurPluginDeactivate', 'deactivate') );

}
<?php
/**
 * @package AlecadddPlugin
 * /
 * /*
 * Plugin Name: Alecaddd Plugin
 * Plugin URI: https://github.com/anisur2805/alecaddd-plugin
 * Description: Something
 * Version: 1.0.0
 * Author: Ale
 * Author URI: https://github.com/anisur2805
 * Text Domain: alecaddd-plugin
 */

use Inc\Activate;
use Inc\Deactivate;

defined( 'ABSPATH' ) or die( 'Hey, stop access this file' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


if ( ! class_exists( 'AlecadddPlugin' ) ) {
	class AlecadddPlugin {

		public $plugin;

		function __construct() {
			add_action( 'init', array( $this, 'custom_post_type' ) );
			$this->plugin = plugin_basename( __FILE__ );
			add_action( 'plugins_loaded', array( $this, 'alecad_load_textdomain' ) );
		}

		public function alecad_load_textdomain() {
			load_textdomain( 'alecaddd-plugin', false, dirname( __FILE__ ) . '/languages' );
		}

		function register() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu_pages' ) );
			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
		}

		// enqueue
		function enqueue() {

			wp_enqueue_style( 'mystyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
			wp_enqueue_style( 'select2', plugins_url( '/vendor/select2/select2/dist/css/select2.css', __FILE__ ) );

			wp_enqueue_script( 'select2', plugins_url( '/vendor/select2/select2/dist/js/select2.js', __FILE__ ), array( 'jquery' ), time(), true );
			wp_enqueue_script( 'myscript', plugins_url( '/assets/myscript.js', __FILE__ ), array( 'jquery' ), time(), true );

		}

		public function admin_menu_pages() {
			add_menu_page( 'Alecaddd Plugin', 'Alecaddd', 'manage_options', 'alecaddd_plugin', array(
				$this,
				'admin_index'
			), 'dashicons-store', 110 );
		}

		public function admin_index() {
			echo '<h2>Custom Plugin Page</h2>'; ?>
            <select class="js-example-basic-single" name="state">
                <option value="BD">Bangladesh</option>
                <option value="WY">Wyoming</option>
                <option value="WY">Wyoming</option>
            </select>
			<?php

		}

		public function settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=alecaddd_plugin">Settings</a>';
			array_push( $links, $settings_link );

			return $links;
		}

		function custom_post_type() {
			register_post_type( 'book', [ 'public' => true, 'label' => 'Books' ] );
		}

		// activate
		function activate() {
			Activate::activate();
		}


		// deactivate
		function Deactivate() {
			Deactivate::deactivate();
		}


	}
}

$alecadplugin = new AlecadddPlugin();
$alecadplugin->register();


// activation
register_activation_hook( __FILE__, array( $alecadplugin, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $alecadplugin, 'deactivate' ) );
<?php
/**
 * @package oopwpplugin
 */

namespace Inc\Pages;


class Admin {

	public function register() {

		add_action( 'admin_menu', array( $this, 'add_admin_page') );

	}

	public function add_admin_page() {
		add_menu_page( 'OOP WP Plugin', 'OOP WP Plugin', 'manage_options', 'oop-wpp', array( $this, 'admin_menu_render' ), 'dashicons-store', 110 );
	}

	function admin_menu_render() {
		require_once OOP_PLUGIN_PATH . 'templates/admin.php';
	}
}
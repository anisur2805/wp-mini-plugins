<?php
/**
 * @package oopwpplugin
 */

namespace Inc\Base;


class Enqueue {

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() {
		wp_enqueue_style( 'mystyle', OOP_PLUGIN_URL . 'assets/mystyle.css' );
wp_enqueue_script( 'myscript', OOP_PLUGIN_URL . 'assets/myscript.js' );
	}

}
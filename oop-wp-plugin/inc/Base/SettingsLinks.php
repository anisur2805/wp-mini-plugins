<?php
/**
 * @package oopwpplugin
 */

namespace Inc\Base;

defined('ABSPATH') or die('Hey you can\'n access this file, you silly human!');

class SettingsLinks {

	protected $plugin;
	public function __construct() {
		$this->plugin = OOP_PLUGIN;
	}
	public function register() {
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=oop-wpp">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}

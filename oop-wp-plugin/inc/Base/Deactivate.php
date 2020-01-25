<?php
/**
 * @package OopWpPlugin
 */

namespace Inc\Base;

defined('ABSPATH') or die('Hey you can\'n access this file, you silly human!');

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}

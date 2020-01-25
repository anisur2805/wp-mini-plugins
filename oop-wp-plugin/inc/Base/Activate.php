<?php
/**
 * @package oopwpplugin
 */

namespace Inc\Base;


defined('ABSPATH') or die('Hey you can\'n access this file, you silly human!');

class Activate {
	public static function activate() {
		flush_rewrite_rules();
	}
}

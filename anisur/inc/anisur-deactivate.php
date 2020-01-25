<?php
/**
*
*@package Anisur
*
*/

class AnisurPluginDeactivate{
	public static function deactivate(){
		flush_rewrite_rules();
	}
}
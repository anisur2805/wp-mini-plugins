<?php
/**
*
*@package Anisur
*
*/

class AnisurPluginActivate{
	public static function activate(){
		echo 'test';
		flush_rewrite_rules();
	}
}
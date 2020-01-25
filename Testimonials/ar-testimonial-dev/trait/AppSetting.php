<?php
// namespace MyApp;
trait AppSetting {

	public static function appType() {

		$type = 'testimonial';
		
		$data['type'] = $type;
    	$data['slug'] = $type.'s';
    	$data['name'] = ucwords($data['slug']);
    	$data['singular_name'] = ucwords($type);
		return $data;
	}
}
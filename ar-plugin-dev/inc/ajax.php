<?php
defined('ABSPATH') || die('Nice Try!');

add_action('wp_ajax_ardev_ajax_action', 'ardev_ajax_action');

add_action('wp_ajax_ardev_front_ajax_action', 'ardev_front_ajax_action');
add_action('wp_ajax_nopriv_ardev_front_ajax_action', 'ardev_front_ajax_action');

function ardev_ajax_action(){
	if(isset($_POST['action']) && isset($_POST['option1'])){
		update_option('ardev_option_1', sanitize_text_field($_POST['option1']));
		echo "Successfully Updated!";
	} else {
		echo "Error Updating Field!";
	}
	wp_die();
}

function ardev_front_ajax_action(){
	if(isset($_POST['action']) && isset($_POST['value'])){
		echo absint( $_POST['value'] ) + 10;
	} else {
		echo "Error Updating Field!";
	}
	wp_die();
}
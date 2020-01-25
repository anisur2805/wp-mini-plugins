<?php
defined('ABSPATH') || die('Nice Try!');

/*
 * Register activation and 
 * deactivation hook
 */
register_activation_hook(PLUGIN_FILE, function(){

	global $wpdb;
	$prefix = $wpdb->prefix;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE {$prefix}likesdislikes (
	id int(9) NOT NULL AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	post_id int(11) NOT NULL,
	liked int(11) NOT NULL,
	disliked int(11) NOT NULL,
	date_added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

});




/*
 * Insert data automatically after activate the plugin
 */
register_activation_hook(PLUGIN_FILE, function(){

	global $wpdb;
	$prefix = $wpdb->prefix;
	$table = $prefix."likesdislikes";
	$data = array(
		'user_id'	=> 1,
		'post_id'	=> 1,
		'liked'	=> 1,
		'disliked'	=> 0,
		'date_added'	=> current_time( 'mysql' ),
	);

	$wpdb->insert($table, $data);

});

/*
 * Removed data automatically after deactivate the plugin
 */
register_deactivation_hook( PLUGIN_FILE, function() {

	global $wpdb;
	$prefix = $wpdb->prefix;
	$table = $prefix."likesdislikes";
	$sql = "TRUNCATE TABLE $table";
	$wpdb->query($sql);

});
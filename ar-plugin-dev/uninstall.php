<?php
defined('ABSPATH') || die('Nice Try!');

	/*
	 *  Unregister News post type
	 */
	unregister_post_type( 'news' );
	/*
	 * Delete/ Trash Likes Dislikes table
	 */
	global $wpdb;
	$prefix = $wpdb->prefix;
	$sql = "DROP TABLE IF EXISTS {$prefix}likesdislikes";
	$wpdb->query($sql);

<?php

/**
* Trigger This File on Plugin Uninstall 
*
* @package Anisur
*
*/

if(!define('WP_UNINSTALL_PLUGIN')){
	die();
}

// Clear DB Stored Data
// Default Delete DB
$books = get_posts( array( 'post_type' => 'mybook', 'numberposts' => -1 ) );
foreach ( $books as $book ){
	wp_delete_post( $book->ID, true );
}

// Using SQL Delete DB
global $wpdb;
$wpdb->query( " DELETE FROM wp_posts WHERE post_type='mybook' " );
$wpdb->query( " DELETE FROM wp_postmeta WHERE post_id NOT IN ( SELECT id FROM wp_posts) " );
$wpdb->query( " DELETE FROM wp_term_relationships WHERE object_id NOT IN ( SELECT id FROM wp_posts ) " );
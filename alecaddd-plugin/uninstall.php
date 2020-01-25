<?php
/*
* Trigger this file on Plugin Uninstall
*
* @package AlecadddPlugin
 */

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// clear database store data
$books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

foreach ( $books as $book ) {
	wp_delete_post( $book->ID, true );
}
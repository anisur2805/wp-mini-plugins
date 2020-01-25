<?php
function art_tag_init() {

	$labels = array(
		'name'              => _x( 'Art Categories', 'art' ),
		'singular_name'     => _x( 'Art  Category', 'art' ),
		'search_items'      => __( 'Search Art  Categories', 'art' ),
		'all_items'         => __( 'All Art  Categories', 'art' ),
		'parent_item'       => __( 'Parent Art  Category', 'art' ),
		'parent_item_colon' => __( 'Parent Art  Category:', 'art' ),
		'edit_item'         => __( 'Edit Art  Category', 'art' ),
		'update_item'       => __( 'Update Art  Category', 'art' ),
		'add_new_item'      => __( 'Add New Art  Category', 'art' ),
		'new_item_name'     => __( 'New Art  Category', 'art' ),
		'menu_name'         => __( 'ART  Categories', 'art' ),
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'art_cat' ),
	);
	register_taxonomy( 'art_cat', array('art', ), $args );

	$labels = array(
		'name'              => _x( 'Art Tags', 'art' ),
		'singular_name'     => _x( 'Art Tag', 'art' ),
		'search_items'      => __( 'Search Art Tags', 'art' ),
		'all_items'         => __( 'All Art Tags', 'art' ),
		'parent_item'       => __( 'Parent Art Tag', 'art' ),
		'parent_item_colon' => __( 'Parent Art Tag:', 'art' ),
		'edit_item'         => __( 'Edit Art Tag', 'art' ),
		'update_item'       => __( 'Update Art Tag', 'art' ),
		'add_new_item'      => __( 'Add New Art Tag', 'art' ),
		'new_item_name'     => __( 'New Art Tag', 'art' ),
		'menu_name'         => __( 'ART Tags', 'art' ),
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'art_tag' ),
	);
	register_taxonomy( 'art_tags', array('art', ), $args );

}
add_action( 'init', 'art_tag_init' );
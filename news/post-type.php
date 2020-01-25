<?php
// Register Custom Post Type
function news_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'News Post Types', 'Post Type General Name', 'arnews' ),
		'singular_name'         => _x( 'news', 'Post Type Singular Name', 'arnews' ),
		'menu_name'             => __( 'News', 'arnews' ),
		'name_admin_bar'        => __( 'News', 'arnews' ),
		'archives'              => __( 'News Archives', 'arnews' ),
		'attributes'            => __( 'News Attributes', 'arnews' ),
		'parent_item_colon'     => __( 'Parent News', 'arnews' ),
		'all_items'             => __( 'All News', 'arnews' ),
		'add_new_item'          => __( 'Add New News', 'arnews' ),
		'add_new'               => __( 'Add News', 'arnews' ),
		'new_item'              => __( 'New News', 'arnews' ),
		'edit_item'             => __( 'Edit News', 'arnews' ),
		'update_item'           => __( 'Update News', 'arnews' ),
		'view_item'             => __( 'View News', 'arnews' ),
		'view_items'            => __( 'View Newss', 'arnews' ),
		'search_items'          => __( 'Search News', 'arnews' ),
		'not_found'             => __( 'Not found', 'arnews' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'arnews' ),
		'featured_image'        => __( 'Featured Image', 'arnews' ),
		'set_featured_image'    => __( 'Set featured image', 'arnews' ),
		'remove_featured_image' => __( 'Remove featured image', 'arnews' ),
		'use_featured_image'    => __( 'Use as featured image', 'arnews' ),
		'insert_into_item'      => __( 'Insert into News', 'arnews' ),
		'uploaded_to_this_item' => __( 'Uploaded to this News', 'arnews' ),
		'items_list'            => __( 'News list', 'arnews' ),
		'items_list_navigation' => __( 'News list navigation', 'arnews' ),
		'filter_items_list'     => __( 'Filter News list', 'arnews' ),
	);
	// $rewrite = array(
	// 	'slug'                  => 'article/news/',
	// 	'with_front'            => true,
	// 	'pages'                 => true,
	// 	'feeds'                 => true,
	// );
	$args = array(
		'label'                 => __( 'news', 'arnews' ),
		'description'           => __( 'News Post Type Description', 'arnews' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-paperclip',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'news',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'query_news',
		// 'rewrite'               => false,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'arnews', $args );

}
add_action( 'init', 'news_custom_post_type', 0 );
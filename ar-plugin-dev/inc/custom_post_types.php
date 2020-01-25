<?php
defined('ABSPATH') || die('Nice Try!');

add_action( 'init', 'ardev_news' );

	/**
	 * Registers a new post type
	 * @uses $wp_post_types Inserts new post type object into the list
	 *
	 * @param string  Post type key, must not exceed 20 characters
	 * @param array|string  See optional args description above.
	 * @return object|WP_Error the registered post type object, or an error object
	 */
	function ardev_news() {

		$labels = array(
			'name'               => __( 'Gloabl News', 'ardev' ),
			'singular_name'      => __( 'News', 'ardev' ),
			'add_new'            => _x( 'Add New News', 'ardev', 'ardev' ),
			'add_new_item'       => __( 'Add New News', 'ardev' ),
			'edit_item'          => __( 'Edit News', 'ardev' ),
			'new_item'           => __( 'New News', 'ardev' ),
			'view_item'          => __( 'View News', 'ardev' ),
			'search_items'       => __( 'Search News', 'ardev' ),
			'not_found'          => __( 'No News found', 'ardev' ),
			'not_found_in_trash' => __( 'No News found in Trash', 'ardev' ),
			'parent_item_colon'  => __( 'Parent News:', 'ardev' ),
			'menu_name'          => __( 'Global News', 'ardev' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'description'         => 'description',
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => null,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'trackbacks',
				'comments',
				'revisions',
				'page-attributes',
				'post-formats',
			),
		);

		register_post_type( 'news', $args );



		/*
		 * Register Custom Taxonomy
		 * for news post type
		 */
		register_taxonomy( 'news-categories', ['news'], array(
			'labels'					=> array(
				'name'                       => _x( 'News Categories', 'taxonomy general name' ),
				'singular_name'              => _x( 'News Category', 'taxonomy singular name' ),
				'search_items'               => __( 'Search News Categories' ),
				'popular_items'              => null ,
				'all_items'                  => __( 'All News Categories' ),
				'parent_item'                => __( 'Parent News Category' ),
				'parent_item_colon'          => __( 'Parent News Category:' ),
				'edit_item'                  => __( 'Edit News Category' ),
				'view_item'                  => __( 'View News Category' ),
				'update_item'                => __( 'Update News Category' ),
				'add_new_item'               => __( 'Add New News Category' ),
				'new_item_name'              => __( 'New News Category Name' ),
				'separate_items_with_commas' => null,
				'add_or_remove_items'        => null,
				'choose_from_most_used'      => null,
				'not_found'                  => __( 'No News Categories found.' ),
				'no_terms'                   => __( 'No News Categories' ),
				'items_list_navigation'      => __( 'News Categories list navigation' ),
				'items_list'                 => __( 'News Categories list' ),
				/* translators: Tab heading when selecting from the most used terms */
				'most_used'                  => _x( 'Most Used', 'News Categories' ),
				'back_to_items'              => __( '&larr; Back to News Categories' ),
			),

			'hierarchical' 					=> true,
			'public'						=> true,
		));


		add_filter('template_include', 'ardev_news_template');
		function ardev_news_template($template){
			global $post;
			if(is_single() && $post->post_type == 'news'){
				$template = PLUGIN_PATH . 'templates/ardev-news.php';
			}
			return $template;
		}
	}
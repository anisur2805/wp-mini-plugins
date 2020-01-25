<?php
// Testimonials post type
add_action( 'init', 'ar_testimonial_init' );
if(!function_exists('ar_testimonial_init')){
	function ar_testimonial_init() {
		$labels = array(
			'name'               => __( 'Testimonials', 'art' ),
			'singular_name'      => __( 'Testimonial', 'art' ),
			'menu_name'          => __( 'Testimonials', 'art' ),
			'name_admin_bar'     => __( 'Testimonial', 'art' ),
			'add_new'            => __( 'Add New ART', 'art' ),
			'add_new_item'       => __( 'Add New Testimonial', 'art' ),
			'new_item'           => __( 'New Testimonial', 'art' ),
			'edit_item'          => __( 'Edit Testimonial', 'art' ),
			'view_item'          => __( 'View Testimonial', 'art' ),
			'all_items'          => __( 'All Testimonials', 'art' ),
			'search_items'       => __( 'Search Testimonials', 'art' ),
			'parent_item_colon'  => __( 'Parent Testimonials:', 'art' ),
			'not_found'          => __( 'Not Found.', 'art' ),
			'not_found_in_trash' => __( 'Not Found in Trash.', 'art' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'art' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'art' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			// 'taxonomies'		 => array('art-category', 'post_tag'), 
			'menu_icon'			 => 'dashicons-testimonial',
			'hierarchical' 		 => true, 
			'exclude_from_search'	=> false
		);

		register_post_type( 'art', $args );

	}
}
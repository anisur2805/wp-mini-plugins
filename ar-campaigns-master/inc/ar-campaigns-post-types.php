<?php
defined( 'ABSPATH' ) or die( 'No Cheating!' );

function ar_campaigns_post_type() {
	$labels = array(
		"name" => __( "Campaigns", "custom-post-type-ui" ),
		"singular_name" => __( "Campaign", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Campaigns", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		//"delete_with_user" => false,
		//"show_in_rest" => true,
		//"rest_base" => "",
	//	"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		//"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ar_campaign", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
        "taxonomies" => array( "post_tag" ),
	);

	register_post_type( "ar_campaign", $args );
}

add_action( 'init', 'ar_campaigns_post_type' );

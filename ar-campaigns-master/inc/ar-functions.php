<?php
defined( 'ABSPATH' ) or die( 'No Cheating!' );

    function ar_campaigns_excerpt_more( $more ) {
        return '<a href="'.get_the_permalink().'" rel="nofollow"> Read More...</a>';
    }
    add_filter( 'excerpt_more', 'ar_campaigns_excerpt_more' );

    function ar_campaigns_custom_excerpt_length( $length ) {
        return 15;
    }
    add_filter( 'excerpt_length', 'ar_campaigns_custom_excerpt_length', 999 );

    function ar_campaigns_scripts() {
        wp_enqueue_style( 'ar-campaigns-style', plugins_url( 'style.css', __FILE__ ) );
    }
    add_action( 'wp_enqueue_scripts', 'ar_campaigns_scripts' );
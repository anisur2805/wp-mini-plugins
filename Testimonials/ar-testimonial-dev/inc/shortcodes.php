<?php
defined('ABSPATH') || die('Nice Try!');
/*
 * Create News Shortcode
 */
add_action( 'init', 'ardev_shortcode_init');
function ardev_shortcode_init(){
	add_shortcode('test', 'ardev_test_shortcode');
	add_shortcode('news', 'ardev_news_shortcode');
}

function ardev_test_shortcode($atts, $content='') {
	$atts = shortcode_atts(array(
		'message' => 'Hello, there',
	), $atts, 'test');
	return $content;
}

function ardev_news_shortcode($atts, $content='') {
	$atts = shortcode_atts(array(
		'posts_per_page'	=> -1,
	), $atts, 'news');

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'post_type'			=> 'news',
		'post_status'		=> 'publish',
		'posts_per_page'	=> $atts['posts_per_page'],
		'paged'				=> $paged,
	);

	$nquery = new WP_Query($args);
	if($nquery->have_posts()):
		while ($nquery->have_posts()):
			$nquery->the_post();
			$content .= "<article id='news-".get_The_ID()."'>";
			$content .= "<h3><a href='".get_the_permalink()."'>". get_the_title(). "</a></h3>";
			$content .= "<p>". get_the_content() . "</p>";
			$content .= "</article>";
		endwhile;

		if($atts['posts_per_page'] > 0) {
			$content .= "<nav class='next_previous'>";
			$content .= get_next_post_link('Next Post', $nquery->max_num_pages);
			$content .= get_previous_post_link('Previous Post');
			$content .= '</nav>';
		}
		wp_reset_postdata();
	else:
		$content .= '<h3>No news found!</p>';
	endif;

	return $content;
}
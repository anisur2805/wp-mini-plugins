<?php
    defined('ABSPATH') or die('No Cheating!');

    get_header();


    echo '<div class="et_pb_row our-campaign-row">';

    // The Loop
    if(have_posts()) {
        while (have_posts()) {
           the_post();

            echo ' <div class="et_pb_column et_pb_css_mix_blend_mode_passthrough">';

            if(has_post_thumbnail()) : ?>

                <div class="et_pb_module et_pb_image">
            <span class="et_pb_image_wrap ">
                <?php
                    echo '<a href=" ' . get_permalink() . ' ">' . the_post_thumbnail() . '</a>'; ?>
            </span>
                </div>

            <?php endif; ?>
            <div class="et_pb_module et_pb_text et_pb_bg_layout_light  et_pb_text_align_left et_had_animation"
                 style="">
                <div class="et_pb_text_inner"><?php echo '<h3 style="text-align: center;">' . get_the_title() . '</h3>'; ?>
                </div>
            </div> <!-- .et_pb_text -->

            <div class="et_pb_module et_pb_text et_pb_bg_layout_light  et_pb_text_align_left et_had_animation"
                 style="">
                <div class="et_pb_text_inner"><?php the_content(); ?></div>
            </div> <!-- .et_pb_text -->

            <div class="et_pb_button_module_wrapper  et_pb_module ">
                <a class="et_pb_button et_pb_custom_button_icon et_pb_bg_layout_light" href="/donate"
                   data-icon=""><?php echo __('Donate', 'ar-campaigns'); ?></a>
            </div>

            <?php echo '</div>';

        }
    } else {
        echo 'Sorry No Campaigns Found!';
    }

    // Restore original Post Data
    wp_reset_postdata();

    echo '</div>';

global $post;
    //for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        echo 'Related Posts';
        $first_tag = $tags[0]->term_id;
        error_log(print_r( $first_tag, true));
        $args=array(
            'tag__in' => array($first_tag),
            'post__not_in' => array($post->ID),
            'posts_per_page'=>3,
            'post_type' => 'ar_campaign'
        );
        $my_query = new WP_Query($args);
        error_log(print_r( $my_query, true));
        if( $my_query->have_posts() ) {
            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>

            <?php
            endwhile;
        }
        wp_reset_query();
    }

    get_footer();
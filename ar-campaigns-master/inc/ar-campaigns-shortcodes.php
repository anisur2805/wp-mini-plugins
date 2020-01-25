<?php
    defined('ABSPATH') or die('No Cheating!');


    // Add Shortcode
    function ar_campaigns_shortcode () {

        // WP_Query arguments
        $args = array('post_type' => 'ar_campaign', 'posts_per_page' => -1,
            'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'post_date',);

        // The Query
        $services = new WP_Query($args);

        echo '<div class="et_pb_row our-campaign-row">';

        // The Loop
        if($services->have_posts()) {
            while ($services->have_posts()) {
                $services->the_post();

                echo ' <div class="et_pb_column et_pb_column_1_3  et_pb_css_mix_blend_mode_passthrough">';

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
                    <div class="et_pb_text_inner"><?php echo '<h3 style="text-align: center;"><a href=" ' . get_permalink() . ' ">' . get_the_title() . '</a></h3>'; ?>
                    </div>
                </div> <!-- .et_pb_text -->

                <div class="et_pb_module et_pb_text et_pb_bg_layout_light  et_pb_text_align_left et_had_animation"
                     style="">
                    <div class="et_pb_text_inner"><?php the_excerpt(); ?></div>
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

    }

    add_shortcode('ar_campaign', 'ar_campaigns_shortcode');
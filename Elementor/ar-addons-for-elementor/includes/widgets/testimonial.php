<?php

namespace Pluginever\EverAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Widget_Base;


class Testimonial extends Widget_Base {
    public function get_name() {
        return 'ever-addons-testimonial';
    }

    public function get_title() {
        return esc_html__('Ever - Testimonial', 'ever-addons-for-elementor');
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['ever-addons'];
    }


    protected function _register_controls() {
        $this->start_controls_section('section_testimonial', ['label' => __('Testimonial', 'ever-addons-for-elementor'),]);

        $this->add_control('photo', ['label' => __('Photo', 'ever-addons-for-elementor'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => Utils::get_placeholder_image_src(),],]);

        $this->add_control('photo_shape', ['label' => __('Photo Shape', 'ever-addons-for-elementor'), 'type' => Controls_Manager::SELECT, 'default' => 'circle', 'options' => ['square' => __('Square', 'ever-addons-for-elementor'), 'circle' => __('Circle', 'ever-addons-for-elementor'), 'rounded' => __('Rounded', 'ever-addons-for-elementor'), 'triangular' => __('Triangular', 'ever-addons-for-elementor'),],]);


        $this->add_control('eael_testimonial_alignment', ['label' => esc_html__('Alignment', 'ever-addons-for-elementor'), 'type' => Controls_Manager::CHOOSE, 'label_block' => true, 'options' => ['default' => ['title' => __('Default', 'ever-addons-for-elementor'), 'icon' => 'fa fa-ban',], 'left' => ['title' => esc_html__('Left', 'ever-addons-for-elementor'), 'icon' => 'fa fa-align-left',], 'center' => ['title' => esc_html__('Center', 'ever-addons-for-elementor'), 'icon' => 'fa fa-align-center',], 'right' => ['title' => esc_html__('Right', 'ever-addons-for-elementor'), 'icon' => 'fa fa-align-right',],], 'default' => 'default', 'selectors' => ['{{WRAPPER}} .eafe-testimonial-content' => 'text-align: {{VALUE}};', '{{WRAPPER}} .eafe-testimonial-image' => 'text-align: {{VALUE}};',],]);


        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();
    }

    protected function _content_template() {
        ?>
        <#
        console.log(settings);
        console.log(settings);
        #>
        <div>
            test
        </div>

        <?php
    }
}

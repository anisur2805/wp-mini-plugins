<?php

namespace Pluginever\EverAddons\Widgets;

use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;


class InfoBox extends Widget_Base {
    public function get_name() {
        return 'ar-addons-info-box';
    }

    public function get_title() {
        return esc_html__( 'AR Info Box', 'ar-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'ar-addons' ];
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'ea_infobox_content',
            [
                'label' => __( 'InfoBox', 'ar-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( 'eaib_title', [
            'label'       => __( 'Infobox Title', 'ar-addons-for-elementor' ),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
            'default'     => __( 'Infobox title', 'ar-addons-for-elementor' ),
            'dynamic'     => [
                'active' => true,
            ],
        ] );

        $this->add_control( 'icon_type', [
            'label'   => __( 'Icon Type', 'ar-addons-for-elementor' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'icon',
            'options' => [
                'none'       => __( 'None', 'ar-addons-for-elementor' ),
                'icon'       => __( 'Icon', 'ar-addons-for-elementor' ),
                'icon_image' => __( 'Image', 'ar-addons-for-elementor' ),
            ],
        ] );

        $this->add_control( 'infobox_icon', [
            'label'       => __( 'Infobox Icon', 'ar-addons-for-elementor' ),
            'type'        => Controls_Manager::ICON,
            'label_block' => true,
            'default'     => 'fa fa-bell-o',
            'condition'   => [
                'icon_type' => 'icon',
            ],
        ] );

        $this->add_control( 'icon_image', [
            'label'       => __( 'Infobox Image', 'ar-addons-for-elementor' ),
            'type'        => Controls_Manager::MEDIA,
            'default'     => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'label_block' => true,
            'condition'   => [
                'icon_type' => 'icon_image',
            ],
            'dynamic'     => [
                'active' => true,
            ],
        ] );

        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'        => 'thumbnail',
            'label'       => __( 'Image Size', 'ar-addons-for-elementor' ),
            'description' => __( 'Size of image', 'ar-addons-for-elementor' ),
            'default'     => 'large',
            'type'        => 'image',
            'condition'   => [
                'icon_type' => 'icon_image',
            ],
        ] );

        $this->add_control(
            'ea_infobox_align',
            [
                'label'     => __( 'Alignment', 'ar-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'ar-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ar-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'ar-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .ea-info-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );


        $this->add_control( 'infobox_more_text', [
                'label'       => __( 'Link Text', 'ar-addons-for-elementor' ),
                'description' => __( 'Link text here.', 'ar-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Read More', 'ar-addons-for-elementor' ),
            ]
        );


        $this->add_control( 'infobox_link', [
                'label'       => __( 'Link URL', 'ar-addons-for-elementor' ),
                'description' => __( 'The link for the page describing the infobox.', 'ar-addons-for-elementor' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '',
                    'is_external' => 'true',
                ],
                'placeholder' => __( 'http://attach-link.com', 'ar-addons-for-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );


        $this->add_control( 'widget_animation', [
                "type"    => Controls_Manager::SELECT,
                "label"   => __( "Animation Type", "ar-addons-for-elementor" ),
                'default' => 'none',
            ]
        );

        $this->add_control( 'infobox_excerpt', [
            'label'       => __( 'Infobox title description', 'ar-addons-for-elementor' ),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => __( 'Infobox title description goes here', 'ar-addons-for-elementor' ),
            'label_block' => true,
            'dynamic'     => [
                'active' => true,
            ],
        ] );


        $this->end_controls_section();

        $this->start_controls_section(
            'ea_style_section',
            [
                'label' => esc_html__( 'Style', 'ar-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    }


    protected function render() {
		?>
	        <div class="eaddons-info-box">
		        <div class="eaddons-info-box__top">
			        <div class="eaddons-info-box__top_icon_wrap">
				        <i class="fa fa-facebook"></i>
			        </div>
		        </div>
		        <div class="eaddons-info-box__bottom">
			        <h4>Tittle</h4>
			        <p class="eaddons-info-box__bottom_desc">
				        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus minima officia quidem saepe similique tempore.
			        </p>

			        <a href="#" class="eaddons-info-box__bottom_btn">Button</a>

		        </div>
	        </div>

		<?php
    }
}

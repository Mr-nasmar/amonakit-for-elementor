<?php
namespace Elementor;

// Elementor Classes

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Service extends Widget_Base {

    public function get_name() {
        return 'amokit-service-addons';
    }
    
    public function get_title() {
        return __( 'Service', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-clone';
    }
    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }
    public function get_keywords() {
        return ['service box','info box','content box','icon box','image box','amokit', 'Amona Kit'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/services-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'service_content',
            [
                'label' => __( 'Service', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'amokit_service_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'amokit-addons' ),
                        '2'   => __( 'Style Two', 'amokit-addons' ),
                        '3'   => __( 'Style Three', 'amokit-addons' ),
                        '4'   => __( 'Style Four', 'amokit-addons' ),
                        '5'   => __( 'Style Five', 'amokit-addons' ),
                        '6'   => __( 'Style Six', 'amokit-addons' ),
                        '7'   => __( 'Style Seven', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'amokit_service_title',
                [
                    'label' => __( 'Service Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Services Title', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'amokit_service_icon_type',
                [
                    'label' => __('Service Icon Type','amokit-addons'),
                    'type' =>Controls_Manager::CHOOSE,
                    'options' =>[
                        'img' =>[
                            'title' =>__('Image','amokit-addons'),
                            'icon' =>'eicon-image-bold',
                        ],
                        'icon' =>[
                            'title' =>__('Icon','amokit-addons'),
                            'icon' =>'eicon-info-circle',
                        ]
                    ],
                    'default' => 'img',
                ]
            );

            $this->add_control(
                'service_image',
                [
                    'label' => __('Image','amokit-addons'),
                    'type'=>Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'amokit_service_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'service_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'amokit_service_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_control(
                'service_icon',
                [
                    'label' =>esc_html__('Icon','amokit-addons'),
                    'type'=>Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fas fa-pencil-alt',
                        'library'=>'solid',
                    ],
                    'condition' => [
                        'amokit_service_icon_type' => 'icon',
                    ]
                ]
            );

            $this->add_control(
                'amokit_service_description',
                [
                    'label' => __( 'Service description', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'There are many variations of passages Lorem Ipsum available, but majority have ama suffered altratio. the lorem.', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'amokit_service_button_text',
                [
                    'label' => __( 'Service Button text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Read More', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'service_link',
                [
                    'label' => __( 'Service Link', 'amokit-addons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

        $this->end_controls_section();

        // Service Style tab section
        $this->start_controls_section(
            'amokit_service_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_tabs_normal_style'
        );
            // Normal Style Tab
            $this->start_controls_tab(
                'box_tab_normal_style',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );

            $this->add_responsive_control(
                'service_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'service_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-service',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'service_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service',
                ]
            );

            $this->add_responsive_control(
                'service_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'service_box_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service',
                ]
            );
            $this->add_responsive_control(
                'service_text_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'separator' =>'before',
                ]
            );

            $this->end_controls_tab();

            // Hover Style Tab
            $this->start_controls_tab(
                'box_tabs_hover_style',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'service_background_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-service:hover',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'service_border_hover',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service:hover',
                ]
            );

            $this->add_responsive_control(
                'service_border_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'service_box_boxshadow_hover',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service:hover',
                ]
            );
            $this->add_control(
                'service_hover_content_color',
                [
                    'label' => __( 'All Content Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service:hover .service-title a,{{WRAPPER}} .amo-service:hover .service-title, {{WRAPPER}} .amo-service:hover .content p,{{WRAPPER}} .amo-service-style-7:hover .content h4,{{WRAPPER}} .amo-service-style-7:hover .content p,{{WRAPPER}} .amo-service-style-7:hover .icon i' => 'color: {{VALUE}}!important;',
                        '{{WRAPPER}} .amo-service-style-7:hover .icon svg path' => 'fill: {{VALUE}}!important;',

                    ],
                    'separator' =>'before'

                ]
            );
            $this->add_control(
                'service_hover_button_btn',
                [
                    'label' => __( 'Read More Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service:hover a.readmore_btn' => 'color: {{VALUE}};',

                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'service_hover_button_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-service:hover a.readmore_btn',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'service_hover_button_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service:hover a.readmore_btn',

                ]
            );            
            $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section(); // Service section style end

        // Service Service Title Style tab section
        $this->start_controls_section(
            'amokit_service_title_style',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_service_title!' => '',
                ],
            ]
        );
            
            $this->add_control(
                'service_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5b5b5b',
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .service-title' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-service .service-title a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'service_title_hover_color',
                [
                    'label' => __( 'Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .service-title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'service_title_typography',
                    'selector' => '{{WRAPPER}} .amo-service .service-title',
                ]
            );

            $this->add_responsive_control(
                'service_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .service-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_title_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .service-title' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'service_title_after_border_color',
                [
                    'label' => __( 'Title Border Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition'=>[
                        'amokit_service_style' => '3',
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-3 .content h4::before' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Service title style end

        // Service Service description Style tab section
        $this->start_controls_section(
            'amokit_service_description_style',
            [
                'label' => __( 'Description', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_service_description!' => '',
                ],
            ]
        );
            
            $this->add_control(
                'service_description_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#8f8f8f',
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .content p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'service_description_typography',
                    'selector' => '{{WRAPPER}} .amo-service .content p',
                ]
            );

            $this->add_responsive_control(
                'service_description_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_description_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_description_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .content p' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Service description style end

        // Service icon Style tab section
        $this->start_controls_section(
            'amokit_service_icon_style',
            [
                'label' => __( 'Icon', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_service_icon_type' => 'icon',
                    'service_icon[value]!' => '',
                ],
            ]
        );
            
            $this->add_control(
                'service_icon_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-6 .icon' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-service-style-3 .icon' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-service-style-7 .icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'service_icon_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-6 .icon' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-service-style-3 .icon' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-service-style-7 .icon' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'icon_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'service_icon_size',
                        [
                            'label' => __( 'Icon Size', 'amokit-addons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'size' => 40,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .amo-service .icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'service_icon_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ed552d',
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-service .icon svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'service_icon_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .amo-service .icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_icon_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'service_icon_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-service .icon i, {{WRAPPER}} .amo-service .amo-svg-icon-box',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'service_icon_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service .icon',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_icon_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon, {{WRAPPER}} .amo-svg-icon-box,{{WRAPPER}} .amo-service-style-3 .icon i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'service_icon_boxshadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service .icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'service_icon_align',
                        [
                            'label' => __( 'Alignment', 'amokit-addons' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service .icon' => 'text-align: {{VALUE}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal Style tab end

                // Hover Style tab Start
                $this->start_controls_tab(
                    'icon_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'service_icon_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-service:hover .icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-service:hover .icon svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'service_icon_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-service:hover .icon i,{{WRAPPER}} .amo-service:hover .amo-svg-icon-box',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'service_icon_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service:hover .icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'service_icon_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-service:hover .icon,{{WRAPPER}} .amo-service:hover .amo-svg-icon-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'service_icon_boxshadow_hover',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service:hover .icon',
                        ]
                    );
                $this->end_controls_tab(); // Hover Style tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Service Icon style end
        // Service images Style tab section
        $this->start_controls_section(
            'amokit_service_line_border_style',
            [
                'label' => __( 'Border Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'amokit_service_style!' => array( '2','5','6','7' ),
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'service_line_border_color',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-service-style-3 .content h4::before,{{WRAPPER}} .amo-service-style-1 .content p::before,{{WRAPPER}} .amo-service-style-1 .content p::after,{{WRAPPER}} .amo-service-style-4 .thumb::after,{{WRAPPER}} .amo-service-style-4 .thumb::before',
                ]
            );
            $this->add_control(
                'service_line_border_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-3 .content h4::before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'amokit_service_style' => '3',
                    ],
                ]
            );

            $this->add_control(
                'service_line_border_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],

                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-3 .content h4::before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'amokit_service_style' => '3',
                    ],
                ]
            );
            $this->add_control(
                'service_verticle_line_border_color',
                [
                    'label' => __( 'Vertical line Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service.amo-service-style-3:hover:after,{{WRAPPER}} .amo-service.amo-service-style-3:hover:before' => 'background: {{VALUE}};',
                    ],
                    'condition'=>[
                        'amokit_service_style' => '3',
                    ],
                ]
            );
        $this->end_controls_section(); // border style end
        // Service images Style tab section
        $this->start_controls_section(
            'amokit_service_image_style',
            [
                'label' => __( 'Image', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_service_icon_type' => 'img',
                ],
            ]
        );
            
            $this->add_control(
                'service_image_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-6 .thumb,{{WRAPPER}} .amo-service .thumb' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'service_image_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service-style-6 .thumb,{{WRAPPER}} .amo-service .thumb' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'service_image_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'service_image_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'service_image_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-service .thumb',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'service_image_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service .thumb',
                ]
            );

            $this->add_responsive_control(
                'service_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .thumb' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'service_image_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-service .thumb',
                ]
            );
            $this->add_responsive_control(
                'service_image_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-service .thumb' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Service Images style end

        // Service Button Style tab section
        $this->start_controls_section(
            'amokit_service_button_style',
            [
                'label' => __( 'Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_service_button_text!' => '',
                ],
            ]
        );
            $this->start_controls_tabs('amokit_button_style_tabs');
                
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'service_button_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0056ff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'service_button_typography',
                            'selector' => '{{WRAPPER}} .amo-service a.readmore_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'service_button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-service a.readmore_btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'service_button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service a.readmore_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab section end

                // Hover tab section Start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'service_button_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'service_button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-service a.readmore_btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'service_button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-service a.readmore_btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'service_button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-service a.readmore_btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();// Hover tab section end



            $this->end_controls_tabs();// Service Button tabs end

        $this->end_controls_section(); // Service Button style end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'amokit_service_attr', 'class', 'amokit-service' );
        $this->add_render_attribute( 'amokit_service_attr', 'class', 'amokit-service-style-'. esc_attr( $settings['amokit_service_style'] ) );

        $service_image = '';

        // Link Generate
        if ( !empty( $settings['service_link']['url'] ) ) {

            $this->add_link_attributes( 'url', $settings['service_link'] );

            $this->add_render_attribute( 'url', 'class', 'readmore_btn');

            if( !empty( $settings['service_image']['url'] ) ){
                $service_image = '<a href="'.esc_url( $settings['service_link']['url'] ).'">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'service_imagesize', 'service_image' ).'</a>';
            }

        }else{
            if( !empty( $settings['service_image']['url'] ) ){
                $service_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'service_imagesize', 'service_image' );
            }
        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_service_attr' ); ?> >
                <?php
                    if( $settings['amokit_service_icon_type'] == 'img' && $service_image !='' ){
                        echo '<div class="thumb">'.amo_kses_desc( $service_image ).'</div>';
                    }else{
                        if( !empty( $settings['service_link']['url'] ) ){

                            if( 'svg' == $settings['service_icon']['library']){

                            echo '<a href="'.esc_url($settings['service_link']['url']).'"><div class="icon"> <div class="amo-svg-icon-box">'.amo_Icon_manager::render_icon( $settings['service_icon'], [ 'aria-hidden' => 'true' ] ).'</div></div></a>';
                             } else{
                                echo '<a href="'.esc_url($settings['service_link']['url']).'"><div class="icon">'.amo_Icon_manager::render_icon( $settings['service_icon'], [ 'aria-hidden' => 'true' ] ).'</div></a>';
                            }

                        }else{
                            if( 'svg' == $settings['service_icon']['library']){
                            echo '<div class="icon"><div class="amo-svg-icon-box">'.amo_Icon_manager::render_icon( $settings['service_icon'], [ 'aria-hidden' => 'true' ] ).'</div></div>';
                            } else {
                                echo '<div class="icon">'.amo_Icon_manager::render_icon( $settings['service_icon'], [ 'aria-hidden' => 'true' ] ).'</div>';
                            }
                        }
                    }
                ?>
                <div class="content">
                    <?php
                        if( !empty( $settings['amokit_service_title'] ) && !empty( $settings['service_link']['url'] ) ){
                            echo '<h4 class="service-title"><a href=" '.esc_url($settings['service_link']['url']).' ">'.amo_kses_title( $settings['amokit_service_title'] ).'</a></h4>';
                        }else{
                            if( !empty( $settings['amokit_service_title'] ) ){
                                echo '<h4 class="service-title">'.amo_kses_title( $settings['amokit_service_title'] ).'</h4>';
                            }
                        }      
                        if( !empty( $settings['amokit_service_description'] ) ){
                            echo '<p>'.amo_kses_desc( $settings['amokit_service_description'] ).'</p>';
                        }
                        if( !empty($settings['amokit_service_button_text']) && !empty( $settings['service_link']['url'] ) ){
                            echo sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), amokit_kses_desc( $settings['amokit_service_button_text'] ) );
                        }
                    ?>
                </div>
            </div>

        <?php

    }

}


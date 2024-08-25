<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Add_Banner extends Widget_Base {

    public function get_name() {
        return 'amokit-addbanner-addons';
    }
    
    public function get_title() {
        return __( 'Add Banner', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-image';
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
        return ['banner', 'product banner', 'adds', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/banner-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'add_banner_content',
            [
                'label' => __( 'Banner', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'banner_layout',
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
                    ],
                ]
            );

            $this->add_control(
                'banner_content_pos',
                [
                    'label' => __( 'Content Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'center',
                    'options' => [
                        'top'   => __( 'Top', 'amokit-addons' ),
                        'center'   => __( 'Center', 'amokit-addons' ),
                        'bottom'   => __( 'Bottom', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'banner_image',
                [
                    'label' => __( 'Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'banner_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'banner_title',
                [
                    'label' => __( 'Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Banner Title', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'banner_sub_title',
                [
                    'label' => __( 'Sub Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Banner Sub Title', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'banner_description',
                [
                    'label' => __( 'Description', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Banner Description', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'banner_link',
                [
                    'label' => __( 'Banner Link', 'amokit-addons' ),
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

            $this->add_control(
                'banner_button_txt',
                [
                    'label' => __( 'Button Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Button Text', 'amokit-addons' ),
                ]
            );
            
        $this->end_controls_section();

        // Banner Style tab section
        $this->start_controls_section(
            'add_banner_box_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('add_banner_box_style_tabs');

                // Normal tab Start
                $this->start_controls_tab(
                    'add_banner_box_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'add_banner_box_section_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'add_banner_box_section_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'add_banner_box_section_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-banner',
                        ]
                    );
                $this->end_controls_tab(); // Normal tab End

                // Hover tab Start
                $this->start_controls_tab(
                    'add_banner_box_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'add_banner_box_hvr_background',
                            'label' => __( 'Hover Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-banner .banner-thumb a::after',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'add_banner_box_section_hvr_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-banner',
                        ]
                    );

                $this->end_controls_tab(); // Active tab End

            $this->end_controls_tabs();
            
        $this->end_controls_section();

        // Banner 5 Style after tab section
        $this->start_controls_section(
            'add_banner_after_box_section',
            [
                'label' => __( 'Border Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'banner_layout' => array( '5','6' ),
                ],
            ]
        );

        $this->start_controls_tabs('add_banner_brdr_box_style_tabs');

            // Normal tab Start
            $this->start_controls_tab(
                'add_banner_brdr_box_style_normal_tab',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );
                $this->add_responsive_control(
                    'add_banner_after_box_section_margin',
                    [
                        'label' => __( 'Margin', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner-style-5 .banner-thumb a::before, .amo-banner-style-6 .banner-thumb a::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'add_banner_after_box_section_padding',
                    [
                        'label' => __( 'Padding', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner-style-5 .banner-thumb a::before, .amo-banner-style-6 .banner-thumb a::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'add_banner_after_box_section_border',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-banner-style-5 .banner-thumb a::before, .amo-banner-style-6 .banner-thumb a::before',
                    ]
                );

                $this->add_responsive_control(
                    'add_banner_box_after_section_border_radius',
                    [
                        'label' => __( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner-style-5 .banner-thumb a::before, .amo-banner-style-6 .banner-thumb a::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );

                $this->end_controls_tab(); // Normal tab End

                // Hover tab Start
                $this->start_controls_tab(
                    'add_banner_box_brdr_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                $this->add_responsive_control(
                    'add_banner_after_hvr_box_section_margin',
                    [
                        'label' => __( 'Margin', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner:hover .banner-thumb a::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'add_banner_after_hvr_box_section_padding',
                    [
                        'label' => __( 'Padding', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner:hover .banner-thumb a::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'add_banner_after_hvr_box_section_border',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-banner:hover .banner-thumb a::before',
                    ]
                );

                $this->add_responsive_control(
                    'add_banner_hvr_box_after_section_border_radius',
                    [
                        'label' => __( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .amo-banner:hover .banner-thumb a::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );

                $this->end_controls_tab(); // Active tab End

            $this->end_controls_tabs();

        $this->end_controls_section(); // Title style tab end

        // Style Content tab section
        $this->start_controls_section(
            'add_banner_style_section',
            [
                'label' => __( 'Content', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'add_banner_section_align',
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
                        '{{WRAPPER}} .amo-banner .banner-content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'add_banner_content_box_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-banner .banner-content',
                ]
            );

            $this->add_responsive_control(
                'add_banner_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'add_banner_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'banner_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h2' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-banner .banner-content h2',
                ]
            );

            $this->add_responsive_control(
                'banner_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Sub Title tab section
        $this->start_controls_section(
            'banner_sub_title_style_section',
            [
                'label' => __( 'Sub Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_sub_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_sub_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h6' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_sub_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-banner .banner-content h6',
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Description tab section
        $this->start_controls_section(
            'banner_description_style_section',
            [
                'label' => __( 'Description', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_description!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_description_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content p' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_description_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-banner .banner-content p',
                ]
            );

            $this->add_responsive_control(
                'banner_description_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_description_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-banner .banner-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'banner_button_style_section',
            [
                'label' => __( 'Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_button_txt!'=>'',
                ]
            ]
        );

            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#383838',
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-banner .banner-content a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-banner .banner-content a',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-banner .banner-content a',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_hover_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#383838',
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-banner .banner-content a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-banner .banner-content a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-banner .banner-content a:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'amokit_banner', 'class', 'amokit-banner amokit-banner-content-pos-'. esc_attr( $settings['banner_content_pos'] ) );
        $this->add_render_attribute( 'amokit_banner', 'class', 'amokit-banner-style-'. esc_attr( $settings['banner_layout'] ) );

        // URL Generate
        if ( ! empty( $settings['banner_link']['url'] ) ) {
            
            $this->add_link_attributes( 'url', $settings['banner_link'] );

        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_banner' ); ?>>
                <div class="banner-thumb">
                    <a <?php echo $this->get_render_attribute_string( 'url' ); ?>>
                        <?php
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'banner_image_size', 'banner_image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </a>
                </div>
                <div class="banner-content">
                    <?php
                        if( !empty( $settings['banner_sub_title'] ) ){
                            echo '<h6>'.amo_kses_title( $settings['banner_sub_title'] ).'</h6>';
                        }
                        if( !empty( $settings['banner_title'] ) ){
                            echo '<h2>'.amo_kses_title( $settings['banner_title'] ).'</h2>';
                        }
                        if( !empty( $settings['banner_description'] ) ){
                            echo '<p>'.amo_kses_desc( $settings['banner_description'] ).'</p>';
                        }

                        if( !empty( $settings['banner_button_txt'] ) ){
                            echo '<a '.$this->get_render_attribute_string( 'url' ).'>'.esc_html( $settings['banner_button_txt'] ).'</a>';
                        }
                    ?>
                </div>
            </div>

        <?php

    }

}
<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKitMenu_Inline_Menu extends Widget_Base {

    public function get_name() {
        return 'amokit-menu-inline-menu';
    }

    public function get_title() {
        return __( 'Inline Mega Menu', 'amokit-addons' );
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return array( 'amokitmenu-addons' );
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_menu_options',
            array(
                'label' => __( 'Menu', 'amokit-addons' ),
            )
        );

            $this->add_control(
                'menu',
                array(
                    'label'   => __( 'Select Menu', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => amokit_get_all_create_menus(),
                )
            );

            $this->add_control(
                'dropdown_icon',
                array(
                    'label'       => __( 'Dropdown Icon', 'amokit-addons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default'     => [
                        'value' => 'fa fa-angle-down',
                        'library' => 'solid',
                    ],
                )
            );
            if ( is_plugin_active('amokit-pro/amokit_pro.php') ) {

                $this->add_responsive_control(
                    'menu_badge',
                    [
                        'label' => esc_html__( 'Hide Menu Badge', 'amokit-addons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'none',
                        'default' => 'block',
                        'selectors'  => array(
                            '{{WRAPPER}} .amomenu-menu-tag' => 'display: {{VALUE}}',
                        ),
                    ]
                );
                $this->add_responsive_control(
                    'menu_badge_arrow',
                    [
                        'label' => esc_html__( 'Hide Menu Badge Arrow', 'amokit-addons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'none',
                        'default' => 'block',
                        'selectors'  => array(
                            '{{WRAPPER}} .amo-arrow-down-icon' => 'display: {{VALUE}}',
                        ),
                        'condition' => [
                            'menu_badge!' => 'none',
                        ]
                    ]
                );
            } else {
                $this->add_control(
                    'menu_badge_free',
                    [
                        'label' => esc_html__( 'Show Menu Badge ', 'amokit-addons' ) . ' <i class="eicon-pro-icon"></i>',
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'ture',
                        'default' => 'false',
                        'classes' => 'amokit-disable-control',
                    ]
                );
            }
        $this->end_controls_section();

        // Menu Style
        $this->start_controls_section(
            'section_main_menu_style',
            array(
                'label'      => __( 'Menu Area', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_responsive_control(
                'menu_wrap_width',
                array(
                    'label' => __( 'Main Menu Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => array(
                        '%', 'px',
                    ),
                    'range' => array(
                        '%' => array(
                            'min' => 10,
                            'max' => 100,
                        ),
                        'px' => array(
                            'min' => 10,
                            'max' => 1500,
                        ),
                    ),
                    'default' => array(
                        'unit' => '%',
                        'size' => 100,
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area' => 'width: {{SIZE}}{{UNIT}}',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                array(
                    'name'     => 'main_menu_background',
                    'selector' => '{{WRAPPER}} .amo-menu-area',
                )
            );

            $this->add_responsive_control(
                'main_menu_margin',
                array(
                    'label'      => __( 'Margin', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%', 'em' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area'=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_responsive_control(
                'main_menu_padding',
                array(
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_responsive_control(
                'main_menu_border_radius',
                array(
                    'label'      => __( 'Border Radius', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                array(
                    'name'        => 'main_menu_border',
                    'label'       => __( 'Border', 'amokit-addons' ),
                    'placeholder' => '1px',
                    'default'     => '1px',
                    'selector'    => '{{WRAPPER}} .amo-menu-area',
                )
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                array(
                    'name'     => 'main_menu_box_shadow',
                    'selector' => '{{WRAPPER}} .amo-menu-area',
                )
            );

            $this->add_responsive_control(
                'main_menu_alignment',
                array(
                    'label'   => __( 'Alignment', 'amokit-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => array(
                        'left'    => array(
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-left',
                        ),
                        'center' => array(
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-center',
                        ),
                        'right' => array(
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-right',
                        ),
                    ),
                    'selectors_dictionary' => array(
                        'left'   => 'justify-content: start;',
                        'center' => 'justify-content: center;',
                        'right'  => 'justify-content: end;',
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-container ul' => '{{VALUE}}',
                    ),
                )
            );

        $this->end_controls_section();

        // Sub Menu Style
        $this->start_controls_section(
            'section_sub_menu_style',
            array(
                'label'      => __( 'Sub Menu', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_responsive_control(
                'sub_menu_width',
                array(
                    'label' => __( 'Sub Menu Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => array(
                        '%', 'px',
                    ),
                    'range' => array(
                        '%' => array(
                            'min' => 10,
                            'max' => 100,
                        ),
                        'px' => array(
                            'min' => 100,
                            'max' => 1500,
                        ),
                    ),
                    'default' => array(
                        'unit' => 'px',
                        'size' => 250,
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .sub-menu' => 'min-width: {{SIZE}}{{UNIT}}',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                array(
                    'name'     => 'sub_menu_background',
                    'selector' => '{{WRAPPER}} .amo-menu-area .sub-menu',
                )
            );

            $this->add_responsive_control(
                'sub_menu_padding',
                array(
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_responsive_control(
                'sub_menu_border_radius',
                array(
                    'label'      => __( 'Border Radius', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                array(
                    'name'        => 'sub_menu_border',
                    'label'       => __( 'Border', 'amokit-addons' ),
                    'selector'    => '{{WRAPPER}} .amo-menu-area .sub-menu',
                )
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                array(
                    'name'     => 'sub_menu_box_shadow',
                    'selector' => '{{WRAPPER}} .amo-menu-area .sub-menu',
                )
            );

            $this->add_responsive_control(
                'sub_menu_items_padding',
                array(
                    'label'      => __( 'Item Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area ul > li > ul.sub-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_control(
                'sub_menu_items_color',
                array(
                    'label'     => __( 'Text Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .amo-menu-area ul > li > ul.sub-menu li a' => 'color: {{VALUE}}',
                    ),
                    'separator' =>'before'
                )
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'     => 'sub_menu_items_typography',
                    'selector' => '{{WRAPPER}} .amo-menu-area ul > li > ul.sub-menu li a',
                )
            );

            $this->add_control(
                'sub_menu_items_hover_color',
                array(
                    'label'     => __( 'Hover Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .amo-menu-area ul > li > ul.sub-menu li a:hover' => 'color: {{VALUE}}',
                    ),
                )
            );

        $this->end_controls_section();

        // Mega Menu Style
        $this->start_controls_section(
            'section_mega_menu_style',
            array(
                'label'      => __( 'Mega Menu', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_responsive_control(
                'mega_menu_width_op',
                [
                    'label' => esc_html__( 'Mega Menu Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'inherit' => esc_html__( 'Default', 'amokit-addons' ),
                        'fullwidth' => esc_html__( 'Full Width', 'amokit-addons' ) . ' (100%)',
                        'custom' => esc_html__( 'Custom', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'menu_full_width_hidden',
                [
                    'label' => esc_html__( 'Full Width', 'amokit-addons' ),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => 'traditional',
                    'condition' => [
                        'mega_menu_width_op' => 'fullwidth',
                    ],
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-megamenu li.amo_mega_menu' => 'position:static;',
                        '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper' => 'min-width: 100vw;left:50%!important;transform:translateX(-50%);',
                    ),
                ]
            );
            $this->add_responsive_control(
                'mega_menu_width',
                array(
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => array(
                        '%', 'px',
                    ),
                    'range' => array(
                        '%' => array(
                            'min' => 10,
                            'max' => 100,
                        ),
                        'px' => array(
                            'min' => 100,
                            'max' => 1500,
                        ),
                    ),
                    'default' => array(
                        'unit' => 'px',
                        'size' => 750,
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper' => 'min-width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}}',
                    ),
                    'condition' => array(
                        'mega_menu_width_op' => 'custom',
                    )
                )
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                array(
                    'name'     => 'mega_menu_background',
                    'selector' => '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper',
                )
            );

            $this->add_responsive_control(
                'mega_menu_padding',
                array(
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_responsive_control(
                'mega_menu_border_radius',
                array(
                    'label'      => __( 'Border Radius', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                array(
                    'name'        => 'mega_menu_border',
                    'label'       => __( 'Border', 'amokit-addons' ),
                    'selector'    => '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper',
                )
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                array(
                    'name'     => 'mega_menu_box_shadow',
                    'selector' => '{{WRAPPER}} .amo-menu-area .amomenu-content-wrapper',
                )
            );

        $this->end_controls_section();

        // Main Menu Items Style
        $this->start_controls_section(
            'section_main_menu_items_style',
            array(
                'label'      => __( 'Main Menu Items', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );

            $this->start_controls_tabs( 'main_menu_item_style_tabs' );
                
                // Items Normal Tabs
                $this->start_controls_tab(
                    'main_menu_item_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'main_menu_items_color',
                        array(
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => array(
                                '{{WRAPPER}} .amo-menu-area ul > li > a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon' => 'color: {{VALUE}}',
                            ),
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        array(
                            'name'     => 'main_menu_items_typography',
                            'selector' => '{{WRAPPER}}  .amo-menu-area ul.amo-megamenu > li > a',
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'main_menu_items_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-menu-area ul > li',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        array(
                            'name'     => 'main_menu_items_bg',
                            'selector' => '{{WRAPPER}} .amo-menu-area ul > li > a',
                            'fields_options' => array(
                                'background' => array(
                                    'default' => 'classic',
                                )
                            ),
                            'exclude' => array(
                                'image',
                                'position',
                                'attachment',
                                'attachment_alert',
                                'repeat',
                                'size',
                            ),
                        )
                    );

                    $this->add_responsive_control(
                        'main_menu_items_padding',
                        array(
                            'label'      => __( 'Padding', 'amokit-addons' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => array( 'px', '%' ),
                            'selectors'  => array(
                                '{{WRAPPER}} .amo-menu-area ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                        )
                    );

                $this->end_controls_tab();
                
                // Items Hover Tabs
                $this->start_controls_tab(
                    'main_menu_item_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'main_menu_items_hover_color',
                        array(
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => array(
                                '{{WRAPPER}} .amo-menu-area ul > li > a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .amo-menu-area ul > li > a:hover > span.amomenu-icon' => 'color: {{VALUE}}',
                            ),
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'main_menu_items_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-menu-area ul > li:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        array(
                            'name'     => 'main_menu_items_hover_bg',
                            'selector' => '{{WRAPPER}} .amo-menu-area ul > li > a:hover',
                            'fields_options' => array(
                                'background' => array(
                                    'default' => 'classic',
                                )
                            ),
                            'exclude' => array(
                                'image',
                                'position',
                                'attachment',
                                'attachment_alert',
                                'repeat',
                                'size',
                            ),
                        )
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        //Dropdown Icon Style
        $this->start_controls_section(
            'dorpdown_icon_style',
            array(
                'label'      => __( 'Dropdown Icon', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'dropdown_icon[value]!' => '',
                ]
            )
        );                    
        $this->add_control(
            'dropdown_icon_color',
            array(
                'label'     => __( 'Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon svg path' => 'fill: {{VALUE}}',
                ),
            )
        );
        $this->add_responsive_control(
            'dropdown_icon_fontsize',
            [
                'label' => __( 'Icon Size', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_inner_space',
            [
                'label' => esc_html__( 'Inner Sapce', 'amokit-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors' => [
                    '{{WRAPPER}} .amo-menu-area ul > li > a > span.amomenu-icon' => 'margin-left:{{VALUE}}px',
                ],
            ]
        );
        $this->end_controls_section();

        if ( is_plugin_active('amokit-pro/amokit_pro.php') ) {
        //Badge Style
            $this->start_controls_section(
                'menu_badge_style',
                array(
                    'label'      => __( 'Menu Badge', 'amokit-addons' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'condition'  => [
                        'menu_badge!' => 'none',
                    ]
                )
            ); 
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'     => 'menu_badge_typography',
                    'selector' => '{{WRAPPER}} .amomenu-menu-tag',
                    'condition' => [
                        'menu_badge!' => 'none',
                    ]
                )
            );
            $this->add_responsive_control(
                'menu_badge_position_v',
                [
                    'label' => __( 'Vertical Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amomenu-menu-tag' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menu_badge_position_h',
                [
                    'label' => __( 'Horizontal Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amomenu-menu-tag' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menu_badge_padding',
                array(
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'selectors'  => array(
                        '{{WRAPPER}} .amomenu-menu-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );
            $this->add_responsive_control(
                'menu_badge_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amomenu-menu-tag' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->end_controls_section();
        }
        // Button Icon style tab start
        $this->start_controls_section(
            'toggle_button_section',
            [
                'label'     => __( 'Toggle Button', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'toggle_button_alignment',
                array(
                    'label'   => __( 'Alignment', 'amokit-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => array(
                        'left'    => array(
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-left',
                        ),
                        'right' => array(
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-right',
                        ),
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .amo-menu-area .amomobile-aside-button' => 'float:{{VALUE}}',
                    ),
                )
            );

            $this->add_control(
                'toggle_button_fontsize',
                [
                    'label' => __( 'Icon Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 14,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-menu-area .amomobile-aside-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-menu-area .amomobile-aside-button svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'toggle_button_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-menu-area .amomobile-aside-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; line-height:0;',
                    ],

                ]
            );

            // Button Icon style tabs start
            $this->start_controls_tabs( 'toggle_button_style_tabs' );

                // Button Icon style normal tab start
                $this->start_controls_tab(
                    'buttonicon_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_toggle_button_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-menu-area .amomobile-aside-button i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-menu-area .amomobile-aside-button svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'toggle_button_background',
                            'label' => __( 'Icon Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-menu-area .amomobile-aside-button',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'toggle_button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-menu-area .amomobile-aside-button',
                        ]
                    );

                    $this->add_control(
                        'toggle_button_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-menu-area .amomobile-aside-button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'toggle_button_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-menu-area .amomobile-aside-button',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'toggle_button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'toggle_button_hover_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-menu-area .amomobile-aside-button:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-menu-area .amomobile-aside-button:hover svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'toggle_button_border_hover',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-menu-area .amomobile-aside-button:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'toggle_button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-menu-area .amomobile-aside-button:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end
        // Button Icon style tab start
        $this->start_controls_section(
            'toggle_button_close_section',
            [
                'label'     => __( 'Toggle Close Button', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'amokit_toggle_close_button_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amomobile-menu-wrap .amomobile-aside-close i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amomobile-menu-wrap .amomobile-aside-close svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'toggle_close_button_background',
                    'label' => __( 'Icon Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amomobile-menu-wrap .amomobile-aside-close',
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section(); // Button Icon style tab end
        // Mobile Menu Style
        $this->start_controls_section(
            'section_mobile_menu_items_style',
            array(
                'label'      => __( 'Mobile Menu', 'amokit-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'mobile_menu_items_color',
                array(
                    'label'     => __( 'Text Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .amo-megamenu > li > a,
                        {{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .sub-menu > li > a' => 'color: {{VALUE}}',
                    ),
                )
            );
            $this->add_control(
                'mobile_menu_items_hover_color',
                array(
                    'label'     => __( 'Text Hover Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .amo-megamenu > li:hover > a,
                        {{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .sub-menu > li:hover > a' => 'color: {{VALUE}}',
                    ),
                )
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'     => 'mobile_menu_items_typography',
                    'selector' => '{{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .amo-megamenu > li > a,
                    {{WRAPPER}} .amomobile-menu-wrap .amomobile-navigation .sub-menu > li > a',
                )
            );

            $this->add_control(
                'mobile_expand_color',
                array(
                    'label'     => __( 'Expand Icon Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .amomobile-menu-wrap .menu-expand i'=>'color: {{VALUE}}',
                    ),
                )
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'samomobile_menu_wrap_bg',
                    'label' => __( 'Icon Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amomobile-menu-wrap',
                ]
            );
        $this->end_controls_section();
    }
    
    protected function render( $instance = [] ) {

        $settings  = $this->get_settings_for_display();

        $wrapper_class = 'amokit-menu-container';
        
        if( isset( $settings['mega_menu_width']['unit'] ) && '%' ==  $settings['mega_menu_width']['unit'] ){
            $wrapper_class .= ' amo-parent-list-static';
        }
        
        if ( ! $settings['menu'] ) {
            return;
        }

        $amokit_on_mobile = '<a href="#" class="amomobile-aside-button"><i class="fa fa-bars"></i></a>';
            $amokit_on_mobile_menu = '<div class="amomobile-menu-wrap"><a class="amomobile-aside-close"><i class="fa fa-times"></i></a><div class="amomobile-navigation"><ul id="%1$s" class="%2$s">%3$s</ul></div></div>';

        $items_wrap = '<div class="amo-menu-area"><ul id="%1$s" class="%2$s">%3$s</ul>'.$amokit_on_mobile.'</div>'.$amokit_on_mobile_menu;

        $args = array(
            'menu'            => $settings['menu'],
            'fallback_cb'     => '',
            'container'       => 'div',
            'container_class' => $wrapper_class,
            'menu_class'      => 'amokit-megamenu',
            'items_wrap'      => $items_wrap,
            'walker'          => new \AmoKit_Menu_Nav_Walker(),
            'extra_menu_settings' => array(
                'dropdown_icon' => amokit_Icon_manager::render_icon( $settings['dropdown_icon'] ),
           ),
        );

        wp_nav_menu( $args );

    }

}

amokit_widget_register_manager( new AmoKitMenu_Inline_Menu() );

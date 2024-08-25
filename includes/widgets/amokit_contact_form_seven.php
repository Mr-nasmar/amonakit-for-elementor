<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Contact_Form_Seven extends Widget_Base {

    public function get_name() {
        return 'amokit-contactform-addons';
    }
    
    public function get_title() {
        return __( 'Contact form 7', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-mail';
    }

    public function get_keywords() {
        return [ 'form', 'contact', 'cf7', 'contact form','contact form 7','amokit' ];
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_help_url() {
		return 'https://nasdesigns.rf.gd/docs/forms-widgets/contact-form-widget/';
	}

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'amokit_contact_form_seven',
            [
                'label' => __( 'Contact Form', 'amokit-addons' ),
            ]
        );
        
            $this->add_control(
                'amokit_form_layout_style',
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
                'amokit_contact_form_id',
                [
                    'label' => __( 'Contact Form', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => amokit_contact_form_seven(),
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_form_section_style',
            [
                'label' => __( 'Form Wrapper Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'ct_form_max_width',
            [
                'label' => __( 'Max Width', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '100',
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-form-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'amokit_form_section_align',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-form-wrapper' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'amokit_form_section_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-form-wrapper',
                ]
            );
            $this->add_responsive_control(
                'amokit_form_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_form_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Input Field style tab start
        $this->start_controls_section(
            'amokit_contactform_input_style',
            [
                'label'     => __( 'Input', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_input_tabs'
            );
                // Normal Style Tab
                $this->start_controls_tab(
                    'style_input_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_input_box_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],

                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap select[multiple="multiple"]'  => 'min-height: {{SIZE}}{{UNIT}}; height: auto!important; max-height: 130px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_input_box_background',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'amokit_input_box_typography',
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
                        ]
                    );

                    $this->add_control(
                        'amokit_input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_input_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'amokit_input_box_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_box_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_box_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_box_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'amokit_input_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}}.wpcf7-form .wpcf7-form-control-wrap select',
                        ]
                    );

                    $this->end_controls_tab();

                    // Hover Style Tab
                    $this->start_controls_tab(
                        'style_input_foucs_tab',
                        [
                            'label' => __( 'Focus', 'amokit-addons' ),
                        ]
                    );
                    $this->add_control(
                        'amokit_input_box_background_focus',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:focus'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:focus'  => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:focus'    => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:focus' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:focus'    => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:focus'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select:focus'         => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_input_box_text_color_focus',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:focus'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:focus'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:focus'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:focus' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:focus'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:focus'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select:focus'         => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'radio_checkbox_color_accent',
                        [
                            'label'     => __( 'Radio & Checkbox Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="checkbox"]:checked,{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="checkbox"]:hover:checked,{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="checkbox"]:focus:checked,{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="radio"]:checked,{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="radio"]:hover:checked,{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type="radio"]:focus:checked'   => 'accent-color: {{VALUE}} !important;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'amokit_input_box_border_focus',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:focus, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select:focus',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_box_border_radius_focus',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'amokit_input_box_shadow_focus',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}}.wpcf7-form .wpcf7-form-control-wrap select:focus',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section(); // Input Field style tab end

         // Textarea style tab start
        $this->start_controls_section(
            'amokit_contactform_textarea_style',
            [
                'label'     => __( 'Textarea', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_textarea_tabs'
            );
                // Normal Style Tab
                $this->start_controls_tab(
                    'style_textarea_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_textarea_box_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 500,
                                ],
                            ],
                            'default' => [
                                'size' => 175,
                            ],

                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'height: {{SIZE}}{{UNIT}};min-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_textarea_box_background',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'amokit_textarea_box_typography',
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
                        ]
                    );

                    $this->add_control(
                        'amokit_textarea_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_textarea_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'amokit_textarea_box_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_textarea_box_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_textarea_box_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_textarea_box_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'amokit_textarea_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
                        ]
                    );
                    $this->end_controls_tab();
                    // Hover Style Tab
                    $this->start_controls_tab(
                        'style_textarea_focus_tab',
                        [
                            'label' => __( 'Focus', 'amokit-addons' ),
                        ]
                    );

                        $this->add_control(
                            'amokit_textarea_box_background_focus',
                            [
                                'label'     => __( 'Background Color', 'amokit-addons' ),
                                'type'      => Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:focus'   => 'background-color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_control(
                            'amokit_textarea_box_text_color_focus',
                            [
                                'label'     => __( 'Text Color', 'amokit-addons' ),
                                'type'      => Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:focus'   => 'color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'amokit_textarea_box_border_focus',
                                'label' => __( 'Border', 'amokit-addons' ),
                                'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:focus',
                            ]
                        );

                        $this->add_responsive_control(
                            'amokit_textarea_box_border_radius_focus',
                            [
                                'label' => __( 'Border Radius', 'amokit-addons' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                                'separator' =>'before',
                            ]
                        );
                        $this->add_group_control(
                            Group_Control_Box_Shadow::get_type(),
                            [
                                'name' => 'amokit_textarea_box_shadow_focus',
                                'label' => __( 'Box Shadow', 'amokit-addons' ),
                                'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:focus',
                            ]
                        );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section(); // Textarea style tab end

        // Label style tab start
        $this->start_controls_section(
            'amokit_contactform_label_style',
            [
                'label'     => __( 'Labels', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'amokit_label_background',
                [
                    'label'     => __( 'Background Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label'   => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'amokit_label_text_color',
                [
                    'label'     => __( 'Text Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label,
                        {{WRAPPER}} .wpcf7 input[type="file"]'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_label_typography',
                    'selector' => '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label,{{WRAPPER}} .wpcf7 input[type="file"]',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_label_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label',
                ]
            );

            $this->add_responsive_control(
                'amokit_label_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_label_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_label_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $this->add_responsive_control(
                'amokit_label_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1170,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-form-wrapper form.wpcf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section(); // // Label style tab end


        // Input submit button style tab start
        $this->start_controls_section(
            'amokit_contactform_inputsubmit_style',
            [
                'label'     => __( 'Button', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('amokit_submit_style_tabs');

                // Button Normal tab start
                $this->start_controls_tab(
                    'amokit_submit_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_input_submit_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'amokit_input_submit_width',
                        [
                            'label' => __( 'Width', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'amokit_input_submit_typography',
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                    $this->add_control(
                        'amokit_input_submit_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_input_submit_background_color',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_submit_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_submit_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'amokit_input_submit_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                    $this->add_responsive_control(
                        'amokit_input_submit_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'amokit_input_submit_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'amokit_submit_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_input_submithover_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'amokit_input_submithover_background_color',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'amokit_input_submithover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Input submit button style tab end
        // Input error style tab start
        $this->start_controls_section(
            'amokit_input_error_style',
            [
                'label'     => __( 'Errors and Feedback Style', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'amokit_error_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-not-valid-tip'  => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_error_text_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-not-valid-tip',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_error_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .wpcf7-not-valid',
                ]
            );
            // Feedback style
            $this->add_control(
                'amokit_error_submit_feedback_style',
                [
                    'label' => __( 'Feedback Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'amokit_feedback_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-response-output,{{WRAPPER}} .wpcf7-mail-sent-ng,{{WRAPPER}} .wpcf7-mail-sent-ok'  => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_feedback_text_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-response-output,{{WRAPPER}} .wpcf7-mail-sent-ng,{{WRAPPER}} .wpcf7-mail-sent-ok',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_feedback_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .wpcf7-response-output,{{WRAPPER}} .wpcf7-mail-sent-ng,{{WRAPPER}} .wpcf7-mail-sent-ok',
                ]
            );
            $this->add_responsive_control(
                'amokit_feedback_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-response-output,{{WRAPPER}} .wpcf7-mail-sent-ng,{{WRAPPER}} .wpcf7-mail-sent-ok' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );            
        $this->end_controls_section(); // Input error style tab end
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'amokit_form_area_attr', 'class', 'amokit-form-wrapper' );
        $this->add_render_attribute( 'amokit_form_area_attr', 'class', 'amokit-form-style-'. esc_attr( $settings['amokit_form_layout_style'] ) );
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_form_area_attr' ); ?> >
                <?php
                    if( !empty($settings['amokit_contact_form_id']) ){
                        echo do_shortcode( '[contact-form-7  id="'. esc_attr( $settings['amokit_contact_form_id'] ) .'"]' ); 
                    }else{
                        echo '<div class="form_no_select">' .esc_html__('Please Select contact form.','amokit-addons'). '</div>';
                    }
                ?>
            </div>

        <?php
    }

}


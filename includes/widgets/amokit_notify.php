<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Notify extends Widget_Base {

    public function get_name() {
        return 'amokit-notify-addons';
    }
    
    public function get_title() {
        return __( 'Notify', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-alert';
    }

    public function get_keywords() {
        return ['notification','notice','remark', 'Amona Kit', 'amokit', 'notify'];
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/creative-widgets/notification-widget/';
    }

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }

    public function get_script_depends() {
        return [
            'amokit-notify',
            'amokit-widgets-scripts',
        ];
    }

    protected function register_controls() {

        // Notification Button
        $this->start_controls_section(
            'notify_button',
            [
                'label' => __( 'Button', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'notification_button_txt',
                [
                    'label' => __( 'Button Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Show Info', 'amokit-addons' ),
                ]
            );

        $this->end_controls_section();


        // Notification Content
        $this->start_controls_section(
            'notify_content',
            [
                'label' => __( 'Notification Content', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'notification_content',
                [
                    'label' => __( 'Notification Message', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( '<strong>Welcome,</strong>to Notification.', 'amokit-addons' ),
                ]
            );

        $this->end_controls_section();

        // Notification Option
        $this->start_controls_section(
            'notification_option',
            [
                'label' => __( 'Notification Option', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'notification_element_container',
                [
                    'label'   => __( 'Element Container', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'self',
                    'options' => [
                        'body'   => __( 'Body', 'amokit-addons' ),
                        'self'   => __( 'Self', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'notification_position',
                [
                    'label'   => __( 'Notification Position', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'topcenter',
                    'options' => [
                        'topleft'           => __( 'Top Left', 'amokit-addons' ),
                        'topcenter'         => __( 'Top Center', 'amokit-addons' ),
                        'topright'          => __( 'Top Right', 'amokit-addons' ),
                        'bottomleft'        => __( 'Bottom Left', 'amokit-addons' ),
                        'bottomcenter'      => __( 'Bottom Center', 'amokit-addons' ),
                        'bottomright'       => __( 'Bottom Right', 'amokit-addons' ),
                        'topfullwidth'      => __( 'Top Fullwidth', 'amokit-addons' ),
                        'bottomfullwidth'   => __( 'Bottom Fullwidth', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'notification_type',
                [
                    'label'   => __( 'Notification Type', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'info',
                    'options' => [
                        'info'   => __( 'Info', 'amokit-addons' ),
                        'danger'   => __( 'Danger', 'amokit-addons' ),
                        'success'   => __( 'Success', 'amokit-addons' ),
                        'warning'   => __( 'Warning', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'notification_enter_animation',
                [
                    'label'   => __( 'Show Animation', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'fadeInUp',
                    'options' => [
                        'none'           => __('None','amokit-addons'),
                        'bounceOut'      => __('bounceOut','amokit-addons'),
                        'bounceOutDown'  => __('bounceOutDown','amokit-addons'),
                        'bounceOutLeft'  => __('bounceOutLeft','amokit-addons'),
                        'bounceOutRight' => __('bounceOutRight','amokit-addons'),
                        'bounceOutUp'    => __('bounceOutUp','amokit-addons'),
                        'fadeIn'         => __('fadeIn','amokit-addons'),
                        'fadeInDown'     => __('fadeInDown','amokit-addons'),
                        'fadeInDownBig'  => __('fadeInDownBig','amokit-addons'),
                        'fadeInLeft'     => __('fadeInLeft','amokit-addons'),
                        'fadeInLeftBig'  => __('fadeInLeftBig','amokit-addons'),
                        'fadeInRight'    => __('fadeInRight','amokit-addons'),
                        'fadeInRightBig' => __('fadeInRightBig','amokit-addons'),
                        'fadeOutRight'   => __('fadeOutRight','amokit-addons'),
                        'fadeOutLeft'    => __('fadeOutLeft','amokit-addons'),
                        'fadeInUp'       => __('fadeInUp','amokit-addons'),
                        'fadeOutUp'      => __('fadeOutUp','amokit-addons'),
                        'fadeOutDown'    => __('fadeOutDown','amokit-addons'),
                        'fadeInUpBig'    => __('fadeInUpBig','amokit-addons'),
                        'bounceIn'       => __('bounceIn','amokit-addons'),
                        'bounceInDown'   => __('bounceInDown','amokit-addons'),
                        'bounceInLeft'   => __('bounceInLeft','amokit-addons'),
                        'bounceInRight'  => __('bounceInRight','amokit-addons'),
                        'bounceInUp'     => __('bounceInUp','amokit-addons'),
                    ],
                ]
            );

            $this->add_control(
                'notification_exit_animation',
                [
                    'label'   => __( 'Exit Animation', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'fadeOutDown',
                    'options' => [
                        'none'           => __('None','amokit-addons'),
                        'bounceOut'      => __('bounceOut','amokit-addons'),
                        'bounceOutDown'  => __('bounceOutDown','amokit-addons'),
                        'bounceOutLeft'  => __('bounceOutLeft','amokit-addons'),
                        'bounceOutRight' => __('bounceOutRight','amokit-addons'),
                        'bounceOutUp'    => __('bounceOutUp','amokit-addons'),
                        'fadeIn'         => __('fadeIn','amokit-addons'),
                        'fadeInDown'     => __('fadeInDown','amokit-addons'),
                        'fadeInDownBig'  => __('fadeInDownBig','amokit-addons'),
                        'fadeInLeft'     => __('fadeInLeft','amokit-addons'),
                        'fadeInLeftBig'  => __('fadeInLeftBig','amokit-addons'),
                        'fadeInRight'    => __('fadeInRight','amokit-addons'),
                        'fadeInRightBig' => __('fadeInRightBig','amokit-addons'),
                        'fadeOutRight'   => __('fadeOutRight','amokit-addons'),
                        'fadeOutLeft'    => __('fadeOutLeft','amokit-addons'),
                        'fadeInUp'       => __('fadeInUp','amokit-addons'),
                        'fadeOutUp'      => __('fadeOutUp','amokit-addons'),
                        'fadeOutDown'    => __('fadeOutDown','amokit-addons'),
                        'fadeInUpBig'    => __('fadeInUpBig','amokit-addons'),
                        'bounceIn'       => __('bounceIn','amokit-addons'),
                        'bounceInDown'   => __('bounceInDown','amokit-addons'),
                        'bounceInLeft'   => __('bounceInLeft','amokit-addons'),
                        'bounceInRight'  => __('bounceInRight','amokit-addons'),
                        'bounceInUp'     => __('bounceInUp','amokit-addons'),
                    ],
                ]
            );

            $this->add_control(
                'notification_offset',
                [
                    'label' => __('Offset', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 80,
                ]
            );

            $this->add_control(
                'notification_delay',
                [
                    'label' => __('Delay', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5000,
                ]
            );

            $this->add_control(
                'notification_width',
                [
                    'label'   => __( 'Bootstrap Column Width', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'auto',
                    'options' => [
                        'auto'   => __( 'Auto', 'amokit-addons' ),
                        'htb-col-md-12'  => __( 'col-md-12', 'amokit-addons' ),
                        'htb-col-md-11'  => __( 'col-md-11', 'amokit-addons' ),
                        'htb-col-md-10'  => __( 'col-md-10', 'amokit-addons' ),
                        'htb-col-md-9'   => __( 'col-md-9', 'amokit-addons' ),
                        'htb-col-md-8'   => __( 'col-md-8', 'amokit-addons' ),
                        'htb-col-md-7'   => __( 'col-md-7', 'amokit-addons' ),
                        'htb-col-md-6'   => __( 'col-md-6', 'amokit-addons' ),
                        'htb-col-md-5'   => __( 'col-md-5', 'amokit-addons' ),
                        'htb-col-md-4'   => __( 'col-md-4', 'amokit-addons' ),
                        'htb-col-md-3'   => __( 'col-md-3', 'amokit-addons' ),
                        'htb-col-md-2'   => __( 'col-md-2', 'amokit-addons' ),
                        'htb-col-md-1'   => __( 'col-md-1', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'notification_icon',
                [
                    'label' => __('Icon', 'amokit-addons'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fas fa-info-circle',
                        'library' => 'solid',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'notify_style_section',
            [
                'label' => __( 'Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'buttonalign',
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
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .amo_notify_area' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'notify_button_style',
            [
                'label' => __( 'Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('notify_button_style_tabs');
                
                // Button Normal Style
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} button.amo-notify-button' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} button.amo-notify-button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} button.amo-notify-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} button.amo-notify-button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} button.amo-notify-button',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} button.amo-notify-button',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} button.amo-notify-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} button.amo-notify-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal Button style end

                // Button Hover Style
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} button.amo-notify-button:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} button.amo-notify-button:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} button.amo-notify-button:hover',
                        ]
                    );

                $this->end_controls_tab(); // Hover Button style end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Content tab section
        $this->start_controls_section(
            'notify_notifycontent_style',
            [
                'label' => __( 'Notify Content', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('notify_content_style_tabs');
                
                // Notify Content Normal Style
                $this->start_controls_tab(
                    'notify_content_style_tab',
                    [
                        'label' => __( 'Content', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'notify_content_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#ffffff',
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert strong' => 'color: {{VALUE}} !important',
                                '.amo-alert-wrap-{{ID}}.alert' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'notify_content_typography',
                            'label' => __( 'Hello Typography', 'amokit-addons' ),
                            'selector' => '.amo-alert-wrap-{{ID}}.alert',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'notify_content_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '.amo-alert-wrap-{{ID}}.alert',
                        ]
                    );

                    $this->add_responsive_control(
                        'notify_content_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'notify_content_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '.amo-alert-wrap-{{ID}}.alert',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'notify_content_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'notify_content_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert span.notify-message-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'notify_content_align',
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
                            'default' => 'center',
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );   
                    
                    $this->add_responsive_control(
                        'notify_content_position',
                        [
                            'label' => __( 'Top', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert span.notify-message-content' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );                                      

                $this->end_controls_tab();
                
                // Notify Content Normal Style
                $this->start_controls_tab(
                    'close_button_style_tab',
                    [
                        'label' => __( 'Close Button', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'close_button_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#ffffff',
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert span.amo-close' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Notify Content Normal Style
                $this->start_controls_tab(
                    'info_icon_button_style_tab',
                    [
                        'label' => __( 'Info Icon', 'amokit-addons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'info_icon_typography',
                        [
                            'label' => __( 'Icon Size', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'selectors' => [
                                '{{WRAPPER}} .amo-alert-wrap-{{ID}}.alert > i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .amo-alert-wrap-{{ID}}.alert > svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );                    
                    $this->add_control(
                        'info_button_color',
                        [
                            'label' => __( 'Icon Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#ffffff',
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i' => 'color: {{VALUE}} !important',
                                '.amo-alert-wrap-{{ID}}.alert > svg path' => 'fill: {{VALUE}} !important',
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'info_icon_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg',
                        ]
                    );  

                    $this->add_responsive_control(
                        'info_icon_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'info_icon_line_height',
                        [
                            'label' => __( 'Line Height', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'info_icon_width',
                        [
                            'label' => __( 'Width', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );        
                    
                    $this->add_responsive_control(
                        'info_icon_position',
                        [
                            'label' => __( 'Top', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );               

                    $this->add_responsive_control(
                        'info_icon_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i, .amo-alert-wrap-{{ID}}.alert > svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'info_icon_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i , .amo-alert-wrap-{{ID}}.alert > svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'info_icon_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i, .amo-alert-wrap-{{ID}}.alert > svg' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'info_icon_align',
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
                            'default' => 'center',
                            'selectors' => [
                                '.amo-alert-wrap-{{ID}}.alert > i' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );     

                $this->end_controls_tab();

            $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $id = $this->get_id();
        $notify_options = array();
        $notify_options['notify_btn_class'] = '.show-info-'.esc_attr( $id );
        $notify_options['notify_class'] = '.amo-notify-alert-'.esc_attr( $id );
        $notify_options['type'] = esc_attr( $settings['notification_type'] );
        $notify_options['notifymessage'] = wp_kses_post( $settings['notification_content'] );
        $notify_options['offset'] = absint( $settings['notification_offset'] );
        $notify_options['delay'] = absint( $settings['notification_delay'] );
        $notify_options['enter'] = esc_attr( $settings['notification_enter_animation'] );
        $notify_options['exit'] = esc_attr( $settings['notification_exit_animation'] );
        $notify_options['width'] = esc_attr( $settings['notification_width'] );
        $notify_options['icon'] = AmoKit_Icon_manager::render_icon( $settings['notification_icon'], [ 'aria-hidden' => 'true' ] );
        $notify_options['wrapid'] = esc_attr( $id );

        if( $settings['notification_element_container'] == 'body' ){
            $notify_options['notify_class'] = 'body';
        }

        if( $settings['notification_position'] == 'topleft' ){
            $notify_options['from'] = 'top';
            $notify_options['align'] = 'left';
        }elseif( $settings['notification_position'] == 'topright' ){
            $notify_options['from'] = 'top';
            $notify_options['align'] = 'right';
        }elseif( $settings['notification_position'] == 'bottomleft' ){
            $notify_options['from'] = 'bottom';
            $notify_options['align'] = 'left';
        }elseif( $settings['notification_position'] == 'bottomright' ){
            $notify_options['from'] = 'bottom';
            $notify_options['align'] = 'right';
        }elseif( $settings['notification_position'] == 'bottomcenter' ){
            $notify_options['from'] = 'bottom';
            $notify_options['align'] = 'center';
        }elseif( $settings['notification_position'] == 'bottomfullwidth' ){
            $notify_options['from'] = 'bottom';
            $notify_options['align'] = 'center';
        }else{
            $notify_options['from'] = 'top';
            $notify_options['align'] = 'center';
        }

        $this->add_render_attribute( 'notify_attr', 'class', 'amokit_notify_area' );
        $this->add_render_attribute( 'notify_attr', 'data-notifyopt', wp_json_encode( $notify_options ) );

        ?>
            <div <?php echo $this->get_render_attribute_string('notify_attr'); ?> >

                <div class="amo-notify-alert-<?php echo esc_attr( $id );?>">
                    <button class="amo-notify-button show-info-<?php echo esc_attr( $id );?> alert-<?php echo esc_attr( $notify_options['type'] ); ?>"><?php echo esc_html( $settings['notification_button_txt'] );?></button>
                </div>
                
            </div>
        <?php
    }
}
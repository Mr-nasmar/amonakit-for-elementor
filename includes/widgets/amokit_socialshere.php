<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_SocialShere extends Widget_Base {

    public function get_name() {
        return 'amokit-social-shere-addons';
    }
    
    public function get_title() {
        return __( 'Social Share', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-share';
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
        return ['social share', 'elementor social share','share button', 'social', 'share', 'facebook', 'twitter', 'instagram', 'linkedin'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/social-widgets/social-share-widget/';
    }

    public function get_script_depends() {
        return [
            'amokit-goodshare',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'social_media_sheres',
            [
                'label' => __( 'Social Share', 'amokit-addons' ),
            ]
        );
        
            $repeater = new Repeater();

            $repeater->add_control(
                'amokit_social_media',
                [
                    'label' => __( 'Social Media', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'facebook',
                    'options' => [
                        'facebook'      => __( 'Facebook', 'amokit-addons' ),
                        'twitter'       => __( 'Twitter', 'amokit-addons' ),
                        'googleplus'    => __( 'Google+', 'amokit-addons' ),
                        'pinterest'     => __( 'Pinterest', 'amokit-addons' ),
                        'linkedin'      => __( 'Linkedin', 'amokit-addons' ),
                        'tumblr'        => __( 'tumblr', 'amokit-addons' ),
                        'vkontakte'     => __( 'Vkontakte', 'amokit-addons' ),
                        'odnoklassniki' => __( 'Odnoklassniki', 'amokit-addons' ),
                        'moimir'        => __( 'Moimir', 'amokit-addons' ),
                        'livejournal'   => __( 'Live journal', 'amokit-addons' ),
                        'blogger'       => __( 'Blogger', 'amokit-addons' ),
                        'digg'          => __( 'Digg', 'amokit-addons' ),
                        'evernote'      => __( 'Evernote', 'amokit-addons' ),
                        'reddit'        => __( 'Reddit', 'amokit-addons' ),
                        'delicious'     => __( 'Delicious', 'amokit-addons' ),
                        'stumbleupon'   => __( 'Stumbleupon', 'amokit-addons' ),
                        'pocket'        => __( 'Pocket', 'amokit-addons' ),
                        'surfingbird'   => __( 'Surfingbird', 'amokit-addons' ),
                        'liveinternet'  => __( 'Liveinternet', 'amokit-addons' ),
                        'buffer'        => __( 'Buffer', 'amokit-addons' ),
                        'instapaper'    => __( 'Instapaper', 'amokit-addons' ),
                        'xing'          => __( 'Xing', 'amokit-addons' ),
                        'wordpress'     => __( 'WordPress', 'amokit-addons' ),
                        'baidu'         => __( 'Baidu', 'amokit-addons' ),
                        'renren'        => __( 'Renren', 'amokit-addons' ),
                        'weibo'         => __( 'Weibo', 'amokit-addons' ),
                        'skype'         => __( 'Skype', 'amokit-addons' ),
                        'telegram'      => __( 'Telegram', 'amokit-addons' ),
                        'viber'         => __( 'Viber', 'amokit-addons' ),
                        'whatsapp'      => __( 'Whatsapp', 'amokit-addons' ),
                        'line'          => __( 'Line', 'amokit-addons' ),
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_social_title',
                [
                    'label'   => esc_html__( 'Title', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Facebook', 'amokit-addons' ),
                ]
            );

            $repeater->add_control(
                'amokit_social_icon',
                [
                    'label'   => esc_html__( 'Icon', 'amokit-addons' ),
                    'type'    => Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fab fa-facebook-square',
                        'library'=>'brands',
                    ],
                ]
            );
            
            $repeater->add_control(
                'normal_style_area_heading',
                [
                    'label' => __( 'Normal Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $repeater->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_rep_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}',
                ]
            );

            $repeater->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_rep_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}',
                ]
            );

            $repeater->add_control(
                'hover_style_area_heading',
                [
                    'label' => __( 'Hover Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $repeater->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_rep_hover_background',
                    'label' => __( 'Hover Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover',
                ]
            );

            $repeater->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_rep_hover_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover',
                ]
            );

            $repeater->start_controls_tabs('social_content_area_tabs');

                $repeater->start_controls_tab(
                    'social_rep_style',
                    [
                        'label' => __( 'Title', 'amokit-addons' ),
                    ]
                );

                    $repeater->add_control(
                        'social_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#000000',
                            'selectors' => [
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'social_text_hover_color',
                        [
                            'label'     => __( 'Hover color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();// End Style tab

                // Start Icon tab
                $repeater->start_controls_tab(
                    'social_rep_icon_style',
                    [
                        'label' => __( 'Icon', 'amokit-addons' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'normal_style_icon_heading',
                        [
                            'label' => __( 'Normal Style', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'social_icon_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_responsive_control(
                        'social_rep_icon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}} i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator'=>'after',
                        ]
                    );

                    $repeater->add_control(
                        'hover_style_icon_heading',
                        [
                            'label' => __( 'Hover Style', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );


                    $repeater->add_control(
                        'social_icon_hover_color',
                        [
                            'label'     => __( 'Hover color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                $repeater->end_controls_tab();// End icon Style tab

            $repeater->end_controls_tabs();// Repeater Tabs end

            $this->add_control(
                'amokit_socialmedia_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'prevent_empty' => false,
                    'default' => [
                        [
                            'amokit_social_media' => 'facebook',
                            'amokit_social_title' => __( 'Facebook', 'amokit-addons' ),
                            'amokit_social_icon' => 'fab fa-facebook-square',
                        ],
                        [
                            'amokit_social_media' => 'twitter',
                            'amokit_social_title' => __( 'Twitter', 'amokit-addons' ),
                            'amokit_social_icon' => 'fab fa-twitter',
                        ],
                        [
                            'amokit_social_media' => 'googleplus',
                            'amokit_social_title' => __( 'Google Plus', 'amokit-addons' ),
                            'amokit_social_icon' => 'fab fa-google-plus-g',
                        ],
                    ],
                    'title_field' => '{{{ amokit_social_title }}}',
                ]
            );
            
            $this->add_control(
                'social_view',
                [
                    'label' => esc_html__( 'View', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options' => [
                        'icon'       => 'Icon',
                        'title'      => 'Title',
                        'icon-title' => 'Icon & Title',
                    ],
                    'default'      => 'icon',
                ]
            );

            $this->add_control(
                'show_counter',
                [
                    'label'        => esc_html__( 'Count', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'amokit-addons' ),
                    'label_off'    => esc_html__( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'condition'    => [
                        'social_view!' => 'icon',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'social_icon_alignment',
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
                        '{{WRAPPER}} .amo-social-share ul' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_socialshere_style_section',
            [
                'label' => __( 'Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'social_shere_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_shere_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_shere_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%',],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_shere_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-share li',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'social_shere_margin_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-share ul li',
                ]
            );

            $this->add_control(
                'icon_control_offset_toggle',
                [
                    'label' => __( 'Icon Settings', 'amokit-addons' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'None', 'amokit-addons' ),
                    'label_on' => __( 'Custom', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'condition'    => [
                        'social_view!' => 'title',
                    ],
                ]
            );

            $this->start_popover();

            $this->add_control(
                'icon_fontsize',
                [
                    'label' => __( 'Icon Font Size', 'amokit-addons' ),
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
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-social-share ul li > svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'icon_height',
                [
                    'label' => __( 'Icon Height', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-social-share ul li svg' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_line_height',
                [
                    'label' => __( 'Line Height', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li i' => 'line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-social-share ul li svg' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_width',
                [
                    'label' => __( 'Icon Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-social-share ul li svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_icon_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-share li i,{{WRAPPER}} .amo-social-share li svg',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_icon_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-social-share li i,{{WRAPPER}} .amo-social-share li svg',
                ]
            );

            $this->add_responsive_control(
                'social_icon_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share li i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-social-share li svg' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->end_popover();

            $this->add_control(
                'share_button_line_height',
                [
                    'label' => __( 'Button Line Height', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'    => [
                        'social_view!' => 'icon',
                    ],
                ]
            );
            
            $this->add_control(
                'normal_style_title_heading',
                [
                    'label' => __( 'Title Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'social_view!' =>'icon',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_shere_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-share ul li span.amo-share-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'social_view!' =>'icon',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .amo-social-share ul li span',
                    'condition' => [
                        'social_view!' =>'icon',
                    ],
                ]
            );

            $this->start_controls_tabs('social_share_style_tabs');

            // Start Icon tab
            $this->start_controls_tab(
                'social_share_normal_style',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );


                $this->add_control(
                    'social_shere_color',
                    [
                        'label'     => __( 'color', 'amokit-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .amo-social-share ul li' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .amo-social-style-1 ul li svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'social_shere_background',
                        'label' => __( 'Background', 'amokit-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .amo-social-share li',
                    ]
                );

            $this->end_controls_tab();// End Style tab

            // Start Icon tab
            $this->start_controls_tab(
                'social_share_hover_style',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                ]
            );

                $this->add_control(
                    'social_shere_hover_color',
                    [
                        'label'     => __( 'color', 'amokit-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .amo-social-share ul li:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'social_shere_hover_background',
                        'label' => __( 'Background', 'amokit-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .amo-social-share li:hover',
                    ]
                );

            $this->end_controls_tab();// End Style tab

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'amokit_socialshere', 'class', 'amokit-social-share amokit-social-style-1' );
        if( $settings['social_view'] == 'icon-title' || $settings['social_view'] == 'title' ){
            $this->add_render_attribute( 'amokit_socialshere', 'class', 'amokit-social-view-' . esc_attr( $settings['social_view'] ) );
        }
             
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_socialshere' ); ?> >
                <ul>
                    <?php foreach ( $settings['amokit_socialmedia_list'] as $socialmedia ) :?>
                        <li class="elementor-repeater-item-<?php echo esc_attr( $socialmedia['_id']); ?>" data-social="<?php echo esc_attr( $socialmedia['amokit_social_media'] ); ?>" > 
                            <?php
                                if( $settings['social_view'] == 'icon' ){
                                    echo AmoKit_Icon_manager::render_icon( $socialmedia['amokit_social_icon'], [ 'aria-hidden' => 'true' ] );
                                }elseif( $settings['social_view'] == 'title' ){
                                    echo sprintf('<span class="amo-share-title">%1$s</span>', amokit_kses_title( $socialmedia['amokit_social_title'] ));
                                }else{
                                    echo sprintf('%1$s<span class="amo-share-title">%2$s</span>', AmoKit_Icon_manager::render_icon( $socialmedia['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ), amokit_kses_title(  $socialmedia['amokit_social_title'] ));
                                }
                                if( $settings['show_counter'] == 'yes' ){
                                    echo '<span class="amo-share-counter" data-counter="'.esc_attr( $socialmedia['amokit_social_media'] ).'"></span>';
                                }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php

    }

}


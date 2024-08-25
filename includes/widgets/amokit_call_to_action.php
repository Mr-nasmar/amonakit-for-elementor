<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Call_To_Action extends Widget_Base {

    public function get_name() {
        return 'amokit-calltoaction-addons';
    }
    
    public function get_title() {
        return __( 'Call To Action', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-call-to-action';
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
        return ['call to action', 'call to', 'contact us', 'amokit', 'Amona Kit', 'addons'];
    }
    
    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'callto_action_content',
            [
                'label' => __( 'Call To Action', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'callto_action_style',
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
                'callto_action_sub_title',
                [
                    'label' => __( 'Sub Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Type your sub title here...', 'amokit-addons' ),
                    'condition'=>[
                        'callto_action_style'=>array('4','5','6'),
                    ]
                ]
            );

            $this->add_control(
                'callto_action_sub_title_tag',
                [
                    'label' => __( 'Sub Title Tag', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => amokit_html_tag_lists(),
                    'default' => 'h4',
                    'condition'=>[
                        'callto_action_sub_title!'=>'',
                    ]
                ]
            );

            $this->add_control(
                'callto_action_title',
                [
                    'label' => __( 'Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Type your title here...', 'amokit-addons' ),
                    'default' =>  __( 'Call to Action Title', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'callto_action_title_tag',
                [
                    'label' => __( 'Title Tag', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => amokit_html_tag_lists(),
                    'default' => 'h2',
                    'condition'=>[
                        'callto_action_title!'=>'',
                    ]
                ]
            );

            $this->add_control(
                'callto_action_description',
                [
                    'label' => __( 'Description', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Type your description here...', 'amokit-addons' ),
                    'default' =>  __( 'Amona Kit Addons', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'callto_action_description_tag',
                [
                    'label' => __( 'Description Tag', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => amokit_html_tag_lists(),
                    'default' => 'p',
                    'condition'=>[
                        'callto_action_description!'=>'',
                    ]
                ]
            );

        $this->end_controls_section();

        // Call To Action Primary Button
        $this->start_controls_section(
            'call_action_button_one_content',
            [
                'label' => __( 'Primary Button', 'amokit-addons' ),
            ]
        );

        $this->add_control(
            'callto_action_buttontxt',
            [
                'label' => __( 'Primary Button Text', 'amokit-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'amokit-addons' ),
                'default' =>  __( 'Contact Us', 'amokit-addons' ),
            ]
        );

        $this->add_control(
            'callto_action_button_link',
            [
                'label' => __( 'Primary Button Link', 'amokit-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition'=>[
                    'callto_action_buttontxt!'=>'',
                ]
            ]
        );
        
        $this->add_control(
            'call_to_action_button_one_icon',
            [
                'label' => __( 'Icon', 'amokit-addons' ),
                'type' => Controls_Manager::ICONS,
                'condition'=>[
                    'callto_action_buttontxt!'=>'',
                ]
            ]
        );

        $this->add_control(
            'amokit_call_action_icon_one_specing',
            [
                'label' => __( 'Icon Spacing', 'amokit-addons' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'call_to_action_button_one_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn .call_to_action_button_one_icon_progression'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.amo-call-to-action-button-icon1-position-right .amo-call-to-action .amo-content a.call_btn .call_to_action_button_one_icon_progression'  => 'margin-right: 0; margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'amokit_call_to_action_button_icon_one_position',
            [
                'label' => __( 'Icon Position', 'amokit-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'amokit-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'amokit-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => [
                    'call_to_action_button_one_icon[value]!' => '',
                ],
                'prefix_class' => 'amokit-call-to-action-button-icon1-position-'
            ]
        );

        $this->end_controls_section();

        // Call To Action Secondary Button
        $this->start_controls_section(
            'call_action_button_two_content',
            [
                'label' => __( 'Secondary Button', 'amokit-addons' ),
            ]
        );

        $this->add_control(
            'callto_action_buttontxt_second',
            [
                'label' => __( 'Secondary Button Text', 'amokit-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'amokit-addons' ),
            ]
        );

        $this->add_control(
            'callto_action_button_link_second',
            [
                'label' => __( 'Button Link', 'amokit-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition'=>[
                    'callto_action_buttontxt_second!'=>'',
                ]
            ]
        );

        $this->add_control(
            'call_to_action_button_two_icon',
            [
                'label' => __( 'Icon', 'amokit-addons' ),
                'type' => Controls_Manager::ICONS,
                'condition'=>[
                    'callto_action_buttontxt_second!'=>'',
                ]
            ]
        );

        $this->add_control(
            'amokit_call_action_icon_two_specing',
            [
                'label' => __( 'Icon Spacing', 'amokit-addons' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'call_to_action_button_two_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .amo-call-to-action .amo-content a.call_btn .call_to_action_button_two_icon_progression'  => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.amo-call-to-action-button-icon2-position-left .amo-call-to-action .amo-content a.call_btn .call_to_action_button_two_icon_progression'  => 'margin-left: 0; margin-right: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'amokit_call_to_action_button_icon_two_position',
            [
                'label' => __( 'Icon Position', 'amokit-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'amokit-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'amokit-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => false,
                'condition' => [
                    'call_to_action_button_two_icon[value]!' => '',
                ],
                'prefix_class' => 'amokit-call-to-action-button-icon2-position-'
            ]
        );

        $this->end_controls_section();


        // Style tab section
        $this->start_controls_section(
            'callto_action_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'callto_section_align',
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
                        '{{WRAPPER}} .amo-call-to-action' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'amokit-align%s-',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'callto_section_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-call-to-action',
                ]
            );

            $this->add_responsive_control(
                'callto_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'callto_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'callto_section_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-call-to-action',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'callto_section_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-call-to-action',
                ]
            );

            $this->add_responsive_control(
                'callto_section_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Inner Box Style tab section
        $this->start_controls_section(
            'callto_action_inner_style_section',
            [
                'label' => __( 'Inner Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_style'=>'7',
                ]
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'callto_inner_section_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner',
                ]
            );

            $this->add_responsive_control(
                'callto_inner_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'callto_inner_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'callto_inner_section_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'callto_inner_section_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner',
                ]
            );

            $this->add_responsive_control(
                'callto_inner_section_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .callto-action-style-7 .call-to-action-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Style Sub Title tab section
        $this->start_controls_section(
            'callto_action_sub_title_style_section',
            [
                'label' => __( 'Sub Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_sub_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'callto_action_sub_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f7ca18',
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-sub-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'callto_action_sub_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-sub-title',
                ]
            );

            $this->add_responsive_control(
                'callto_action_sub_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'callto_action_sub_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'callto_action_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'callto_action_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f7ca18',
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'callto_action_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-title',
                ]
            );

            $this->add_responsive_control(
                'callto_action_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'callto_action_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'title_border',
                [
                    'label'         => __( 'Title Border', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'amokit-addons' ),
                    'label_off'     => __( 'Off', 'amokit-addons' ),
                    'return_value'  => 'yes',
                    'default'       => 'no',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'title_top_border_color',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-callto-action-title:after,{{WRAPPER}} .amo-callto-action-title:before',
                    'condition' =>[
                        'title_border' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'title_top_border_width',
                [
                    'label' => __( 'Border Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-callto-action-title:after,{{WRAPPER}} .amo-callto-action-title:before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'title_border' => 'yes',
                    ]
                ]
            ); 
            $this->add_control(
                'title_top_border_height',
                [
                    'label' => __( 'Border Height', 'amokit-addons' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .amo-callto-action-title:after,{{WRAPPER}} .amo-callto-action-title:before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'title_border' => 'yes',
                    ]
                ]
            ); 
            $this->add_control(
                'title_bottom_top',
                [
                    'label'         => __( 'Border On Top', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'amokit-addons' ),
                    'label_off'     => __( 'Off', 'amokit-addons' ),
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition' =>[
                        'title_border' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-callto-action-title:before' => 'display: block;',
                    ],
                ]
            );
            $this->add_control(
                'title_bottom_border',
                [
                    'label'         => __( 'Border On Bottom', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'amokit-addons' ),
                    'label_off'     => __( 'Off', 'amokit-addons' ),
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition' =>[
                        'title_border' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-callto-action-title:after' => 'display: block;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Description tab section
        $this->start_controls_section(
            'callto_action_description_style_section',
            [
                'label' => __( 'Description', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_description!'=>'',
                ]
            ]
        );

            $this->add_control(
                'callto_action_description_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5D532BE6',
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-description' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'callto_action_description_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-description',
                ]
            );

            $this->add_responsive_control(
                'callto_action_description_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'callto_action_description_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-call-to-action .amo-content .amo-callto-action-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'callto_action_button_style_section',
            [
                'label' => __( 'Primary Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_buttontxt!'=>'',
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

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn',
                        ]
                    );

                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn',
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
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn',
                        ]
                    );

                    $this->add_control(
                        'call_to_action_btn_extra_size_opt',
                        [
                            'label' => __( 'Icon Size', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn .call_to_action_button_one_icon_progression' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                            ],
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
                            'default'   =>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_hover_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Seconddary Button tab section
        $this->start_controls_section(
            'callto_action_button_secondary_style_section',
            [
                'label' => __( 'Secondary Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'callto_action_buttontxt_second!'=>'',
                ]
            ]
        );

            $this->start_controls_tabs('secondary_button_style_tabs');

                $this->start_controls_tab(
                    'secondary_button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'secondary_button_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn',
                        ]
                    );

                    $this->add_control(
                        'secondary_button_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'secondary_button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'secondary_button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'secondary_button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'secondary_button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'secondary_button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'secondary_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn',
                        ]
                    );

                    $this->add_control(
                        'call_to_action_btn_secnd_extra_size_opt',
                        [
                            'label' => __( 'Icon Size', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn .call_to_action_button_two_icon_progression' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn svg' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'secondary_button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'secondary_button_hover_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'secondary_button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'secondary_button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'secondary_button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'secondary_button_hover_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-call-to-action .amo-content a.call_btn.secondary_btn:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'amokit_callto_action_attr', 'class', 'amokit-call-to-action callto-action-style-'. esc_attr( $settings['callto_action_style'] ) );

        $this->add_render_attribute( 'callto_title_sub_attr', 'class', 'amokit-callto-action-sub-title' );
        $this->add_render_attribute( 'callto_title_attr', 'class', 'amokit-callto-action-title' );
        $this->add_render_attribute( 'callto_description_attr', 'class', 'amokit-callto-action-description' );

        // Call To Action Button One
        $call_to_action_button_one_text  = !empty( $settings['callto_action_buttontxt'] ) ? "<span class='call_to_action_button_one_text_progression'>" . wp_kses_post( $settings['callto_action_buttontxt'] ) . '</span>' : '';
        $call_to_action_button_one_icon  = !empty( $settings['call_to_action_button_one_icon']['value'] ) ? "<span class='call_to_action_button_one_icon_progression' >".amo_Icon_manager::render_icon( $settings['call_to_action_button_one_icon'], [ 'aria-hidden' => 'true' ] ).'</span>' : '';


        // Call To Action Button Two
        $call_to_action_button_two_text  = !empty( $settings['callto_action_buttontxt_second'] ) ? "<span class='call_to_action_button_two_text_progression'>" . wp_kses_post( $settings['callto_action_buttontxt_second'] ) . '</span>' : '';
        $call_to_action_button_two_icon  = !empty( $settings['call_to_action_button_two_icon']['value'] ) ? "<span class='call_to_action_button_two_icon_progression' >".amo_Icon_manager::render_icon( $settings['call_to_action_button_two_icon'], [ 'aria-hidden' => 'true' ] ).'</span>' : '';

        // URL Generate
        if ( ! empty( $settings['callto_action_button_link']['url'] ) ) {

            $this->add_render_attribute( 'url', 'class', 'call_btn' );
            $this->add_link_attributes( 'url', $settings['callto_action_button_link'] );

        }

        // URL Generate Secondary Button
        if ( ! empty( $settings['callto_action_button_link_second']['url'] ) ) {
            
            $this->add_render_attribute( 'urlscnd', 'class', 'call_btn secondary_btn' );
            $this->add_link_attributes( 'urlscnd', $settings['callto_action_button_link_second'] );

        }

        $sub_title_tag = amokit_validate_html_tag( $settings['callto_action_sub_title_tag'] );
        $title_tag = amokit_validate_html_tag( $settings['callto_action_title_tag'] );
        $description_tag = amokit_validate_html_tag( $settings['callto_action_description_tag'] );

        $allow_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
        );

        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_callto_action_attr' ); ?>>
                <div class="amo-content">

                    <?php if( $settings['callto_action_style'] == 2 ): ?>
                        <div class="htb-row htb-align-items-center">
                            <div class="htb-col-lg-9">
                                <div class="ht-call-to-action">
                                    <div class="content">
                                        <?php
                                            if( !empty( $settings['callto_action_title'] ) ){
                                                echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string( 'callto_title_attr' ), wp_kses_post( $settings['callto_action_title'] ) );
                                            }
                                            if( !empty( $settings['callto_action_description'] ) ){
                                                echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $description_tag, $this->get_render_attribute_string( 'callto_description_attr' ), wp_kses_post( $settings['callto_action_description'] ) );
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="htb-col-lg-3">
                                <div class="text-right">
                                    <?php
                                        if( !empty( $settings['callto_action_buttontxt'] ) ){
                                            echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url' ), $call_to_action_button_one_icon, $call_to_action_button_one_text, wp_kses_post( $settings['callto_action_buttontxt'] ) );
                                        }if( !empty( $settings['callto_action_buttontxt_second'] ) ){
                                            echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'urlscnd' ), $call_to_action_button_two_icon, $call_to_action_button_two_text, wp_kses_post( $settings['callto_action_buttontxt_second'] ) );
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                    <?php elseif( $settings['callto_action_style'] == 3 ): ?>
                        <div class="content">
                            <?php
                                if( !empty( $settings['callto_action_description'] ) ){
                                    echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $description_tag, $this->get_render_attribute_string( 'callto_description_attr' ), wp_kses_post( $settings['callto_action_description'] ) );
                                }
                                if( !empty( $settings['callto_action_title'] ) ){
                                    echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string( 'callto_title_attr' ), wp_kses_post( $settings['callto_action_title'] ) );
                                }
                            ?>
                        </div>
                        <div class="action-btn">
                            <?php
                                if( !empty( $settings['callto_action_buttontxt'] ) ){
                                    echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url' ), $call_to_action_button_one_icon, $call_to_action_button_one_text, wp_kses_post( $settings['callto_action_buttontxt'] ) );
                                }if( !empty( $settings['callto_action_buttontxt_second'] ) ){
                                    echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'urlscnd' ), $call_to_action_button_two_icon, $call_to_action_button_two_text, wp_kses_post( $settings['callto_action_buttontxt_second'] ) );
                                }
                            ?>
                        </div>

                    <?php elseif( $settings['callto_action_style'] == 4 || $settings['callto_action_style'] == 5 || $settings['callto_action_style'] == 6 ): ?>
                        <div class="content">
                            <?php
                                if( !empty( $settings['callto_action_sub_title'] ) ){
                                    echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $sub_title_tag, $this->get_render_attribute_string( 'callto_title_sub_attr' ), wp_kses_post( $settings['callto_action_sub_title'] ) );
                                }
                                if( !empty( $settings['callto_action_title'] ) ){
                                    echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string( 'callto_title_attr' ), wp_kses_post( $settings['callto_action_title'] ) );
                                }
                                if( !empty( $settings['callto_action_description'] ) ){
                                    echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $description_tag, $this->get_render_attribute_string( 'callto_description_attr' ), wp_kses_post( $settings['callto_action_description'] ) );
                                }
                            ?>
                        </div>
                        <div class="action-btn">
                            <?php
                                if( !empty( $settings['callto_action_buttontxt'] ) ){
                                    echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url' ), $call_to_action_button_one_icon, $call_to_action_button_one_text, wp_kses_post( $settings['callto_action_buttontxt'] ) );
                                }if( !empty( $settings['callto_action_buttontxt_second'] ) ){
                                    echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'urlscnd' ), $call_to_action_button_two_icon, $call_to_action_button_two_text, wp_kses_post( $settings['callto_action_buttontxt_second'] ) );
                                }
                            ?>
                        </div>
                        
                    <?php elseif( $settings['callto_action_style'] == 7 ):?>
                        <div class="call-to-action-inner">
                            <div class="content">
                                <?php
                                    if( !empty( $settings['callto_action_title'] ) ){
                                        echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string( 'callto_title_attr' ), wp_kses_post( $settings['callto_action_title'] ) );
                                    }
                                    if( !empty( $settings['callto_action_description'] ) ){
                                        echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $description_tag, $this->get_render_attribute_string( 'callto_description_attr' ), wp_kses_post( $settings['callto_action_description'] ) );
                                    }
                                ?>
                            </div>
                            <div class="action-btn">
                                <?php
                                    if( !empty( $settings['callto_action_buttontxt'] ) ){
                                        echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url' ), $call_to_action_button_one_icon, $call_to_action_button_one_text, wp_kses_post( $settings['callto_action_buttontxt'] ) );
                                    }if( !empty( $settings['callto_action_buttontxt_second'] ) ){
                                        echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'urlscnd' ), $call_to_action_button_two_icon, $call_to_action_button_two_text, wp_kses_post( $settings['callto_action_buttontxt_second'] ) );
                                    }
                                ?>
                            </div>
                        </div>

                    <?php else:?>
                        <?php
                            if( !empty( $settings['callto_action_description'] ) ){
                                echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $description_tag, $this->get_render_attribute_string( 'callto_description_attr' ), wp_kses_post( $settings['callto_action_description'] ) );
                            }
                            if( !empty( $settings['callto_action_title'] ) ){
                                echo sprintf( '<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string( 'callto_title_attr' ), wp_kses_post( $settings['callto_action_title'] ) );
                            }
                            if( !empty( $settings['callto_action_buttontxt'] ) ){
                                echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url' ), $call_to_action_button_one_icon, $call_to_action_button_one_text, wp_kses_post( $settings['callto_action_buttontxt'] ) );
                            }
                            if( !empty( $settings['callto_action_buttontxt_second'] ) ){
                                echo sprintf('<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'urlscnd' ), $call_to_action_button_two_icon, $call_to_action_button_two_text, wp_kses_post( $settings['callto_action_buttontxt_second'] ) );
                            }
                        ?>
                    <?php endif;?>

                </div>
            </div>

        <?php
    }

}
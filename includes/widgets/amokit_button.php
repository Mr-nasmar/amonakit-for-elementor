<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Button extends Widget_Base {

    public function get_name() {
        return 'amokit-button-addons';
    }
    
    public function get_title() {
        return __( 'Button', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-button';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }

    public function get_script_depends() {
        return ['counterup', 'amokit-admin'];
    }
    public function get_keywords() {
        return ['button', 'buttons', 'button animation','creative button', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/button-widget/';
    }
    protected function register_controls() {
        
        $this->start_controls_section(
            'button_content',
            [
                'label' => __( 'Button', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'button_style',
                [
                    'label'   => __( 'Button Style', 'amokit-addons' ),
                    'type'    => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'amokit-addons' ),
                        '2'   => __( 'Style Two', 'amokit-addons' ),
                        '3'   => __( 'Style Three', 'amokit-addons' ),
                        '4'   => __( 'Style Four', 'amokit-addons' ),
                    ]
                ]
            );


            $this->add_control(
                'button_text',
                [
                    'label' => __( 'Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter your Text', 'amokit-addons' ),
                    'default' => __( 'Click Me', 'amokit-addons' ),
                    'title' => __( 'Enter your Text', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'button_link',
                [
                    'label' => __( 'Link', 'amokit-addons' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'button_size',
                [
                    'label'   => __( 'Button Size', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'md',
                    'options' => [
                        'sm' => __( 'Small', 'amokit-addons' ),
                        'md' => __( 'Medium', 'amokit-addons' ),
                        'lg' => __( 'Large', 'amokit-addons' ),
                        'xl' => __( 'Extra Large', 'amokit-addons' ),
                        'xs' => __( 'Extra Small', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label'       => __( 'Icon', 'amokit-addons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_icon_align',
                [
                    'label'   => __( 'Icon Position', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => __( 'Left', 'amokit-addons' ),
                        'right'  => __( 'Right', 'amokit-addons' ),
                        'top'    => __( 'Top', 'amokit-addons' ),
                        'bottom' => __( 'Bottom', 'amokit-addons' ),
                    ],
                    'condition' => [
                        'button_icon!' => '',
                    ],
                ]
            );

            $this->add_control(
                'icon_specing',
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
                        'button_icon!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .button-align-icon-right .amo_button_icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-left .amo_button_icon'   => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-top .amo_button_icon'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-bottom .amo_button_icon' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_button_style_section',
            [
                'label' => __( 'Button Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'amokit_button_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn, {{WRAPPER}} .amo-button .htb-btn::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'fields_options'=>[
                                'background'=>[
                                    'default'=>'classic',
                                ],
                                'color'=>[
                                    'default'=>'#000000',
                                ],
                            ],
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'button_second_background_heading',
                        [
                            'label' => __( 'Second Background', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before'
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_second_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'fields_options'=>[
                                'background'=>[
                                    'default'=>'classic',
                                ]
                            ],
                            'selector' => '{{WRAPPER}} .amo-btn-style-2 .htb-btn::after',
                            'condition' => array(
                                'button_style'  => '2'
                            )
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn',
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
                                '{{WRAPPER}} .amo-button .htb-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .amo-button .htb-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'amokit_buttonhover_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn:hover, {{WRAPPER}} .amo-button .htb-btn:hover:before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn:hover,{{WRAPPER}} .amo-button .htb-btn:hover:before',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'buttonhover_second_background_heading',
                        [
                            'label' => __( 'Second Background', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before'
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_second_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'fields_options'=>[
                                'background'=>[
                                    'default'=>'classic',
                                ]
                            ],
                            'selector' => '{{WRAPPER}} .amo-btn-style-1 .htb-btn:hover::after',
                            'condition' => array(
                                'button_style'  => '2'
                            )
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'boxhover_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn:hover',
                        ]
                    );

                    $this->add_control(
                        'button_effect',
                        [
                            'label'   => __( 'Button Hover Effect', 'amokit-addons' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '0' => __( 'None', 'amokit-addons' ),
                                '1' => __( 'Effect 1', 'amokit-addons' ),
                                '2' => __( 'Effect 2', 'amokit-addons' ),
                                '3' => __( 'Effect 3', 'amokit-addons' ),
                                '4' => __( 'Effect 4', 'amokit-addons' ),
                                '5' => __( 'Effect 5', 'amokit-addons' ),
                                '6' => __( 'Effect 6', 'amokit-addons' ),
                                '7' => __( 'Effect 7', 'amokit-addons' ),
                                '8' => __( 'Effect 8', 'amokit-addons' ),
                                '9' => __( 'Effect 9', 'amokit-addons' ),
                                '10' => __( 'Effect 10', 'amokit-addons' ),
                                '11' => __( 'Effect 11', 'amokit-addons' ),
                                '12' => __( 'Effect 12', 'amokit-addons' ),
                                '13' => __( 'Effect 13', 'amokit-addons' ),
                                '14' => __( 'Effect 14', 'amokit-addons' ),
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_effect_hover_before_color_heading',
                        [
                            'label' => __( 'Effect Before Color', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before'
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_effect_hover_before_color',
                            'label' => __( 'Effect Before Color', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} [class*="amokit-btn-effect-"]::before',
                        ]
                    );

                    $this->add_control(
                        'button_effect_hover_after_color_heading',
                        [
                            'label' => __( 'Effect After Color', 'amokit-addons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_effect_hover_after_color',
                            'label' => __( 'Effect Before Color', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} [class*="amokit-btn-effect-"]::after',
                        ]
                    );                    

                    $this->add_control(
                        'button_shadow',
                        [
                            'label'   => __( 'Button Hover Shadow', 'amokit-addons' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '0',
                            'options' => [
                                '0' => __( 'None', 'amokit-addons' ),
                                '1' => __( 'Shadow 1', 'amokit-addons' ),
                                '2' => __( 'Shadow 2', 'amokit-addons' ),
                            ],
                            'separator' => 'before'
                        ]
                    );

                    $this->add_control(
                        'button_hover_animation',
                        [
                            'label' => __( 'Hover Animation', 'amokit-addons' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button Icon style tab start
        $this->start_controls_section(
            'amokit_button_icon_style_section',
            [
                'label'     => __( 'Icon Style', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_icon!' => '',
                ],
            ]
        );

            // Button Icon style tabs start
            $this->start_controls_tabs( 'button_icon_style_tabs' );

                // Button Icon style normal tab start
                $this->start_controls_tab(
                    'buttonicon_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_button_icon_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_icon_background',
                            'label' => __( 'Icon Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonicon_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_bordericon_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_icon_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_icon_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_box_shadow',
                            'label' => __( 'Box Shadow', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn .amo_button_icon',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'buttonicon_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'amokit_button_iconhover_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-button .htb-btn:hover .amo_button_icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_iconhover_background',
                            'label' => __( 'Icon Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-button .htb-btn:hover .amo_button_icon',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'amokit_button', 'class', 'amokit-button' );
        $this->add_render_attribute( 'amokit_button', 'class', 'amokit-btn-style-'. esc_attr( $settings['button_style'] ) );
        $this->add_render_attribute( 'amokit_button', 'class', 'amokit-btn-shadow-'. esc_attr( $settings['button_shadow'] ) );
        
        if( !empty( $settings['button_icon']['value'] ) ){
            $this->add_render_attribute( 'amokit_button', 'class', 'button-align-icon-'. esc_attr( $settings['button_icon_align'] ) );
        }

        $button_text  = ! empty( $settings['button_text'] ) ? wp_kses_post( $settings['button_text'] ) : '';
        $button_icon  = ! empty( $settings['button_icon']['value'] ) ? AmoKit_Icon_manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ) : '';

        // URL Generate
        if ( ! empty( $settings['button_link']['url'] ) ) {
            
            $this->add_link_attributes( 'url', $settings['button_link'] );

            $this->add_render_attribute( 'url', 'class', 'htb-btn' );
            $this->add_render_attribute( 'url', 'class', 'amokit-btn-size-'. esc_attr( $settings['button_size'] ) );
            $this->add_render_attribute( 'url', 'class', 'amokit-btn-effect-'. esc_attr( $settings['button_effect'] ) );

            if ( $settings['button_hover_animation'] ) {
                $this->add_render_attribute( 'url', 'class', 'elementor-animation-' . esc_attr( $settings['button_hover_animation'] ) );
            }

            $button_text = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $button_text );
        }

        if( !empty( $settings['button_icon']['value'] ) ){
            $button_text = sprintf( '<a %1$s><span class="amo_button_txt">%2$s</span><span class="amo_button_icon">%3$s</span></a>', $this->get_render_attribute_string( 'url' ), amokit_kses_desc( $settings['button_text'] ), $button_icon );
        }
        if( !empty( $button_text ) ){
            printf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'amokit_button' ), $button_text ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}

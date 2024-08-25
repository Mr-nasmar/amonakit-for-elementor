<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Progress_Bar extends Widget_Base {

    public function get_name() {
        return 'amokit-progressbar-addons';
    }
    
    public function get_title() {
        return __( 'Progress Bar', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-skill-bar';
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
        return ['progress bar','skill bar','bar', 'chart', 'Amona Kit', 'amokit'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/progress-bar-widget/';
    }

    public function get_script_depends() {
        return [
            'easy-pie-chart',
            'amokit-widgets-scripts',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'progressbar_content',
            [
                'label' => __( 'Progress Bar', 'amokit-addons' ),
            ]
        );
        
            $this->add_control(
                'amokit_progress_bar_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'options' => [
                        'horizontal' => __( 'Horizontal', 'amokit-addons' ),
                        'vertical'   => __( 'Vertical', 'amokit-addons' ),
                        'circle'     => __( 'Circle', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'amokit_progress_bar_type',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'normal',
                    'options' => [
                        'striped' => __( 'Striped', 'amokit-addons' ),
                        'normal'   => __( 'Normal', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'amokit_progress_bar_style!'=>'circle',
                    ]
                ]
            );

            $this->add_control(
                'striped_animated',
                [
                    'label' => __( 'Striped Animated', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' =>[
                        'amokit_progress_bar_type' =>'striped',
                    ],
                ]
            );

            // Accordion One Repeater

            $repeater = new Repeater();

            $repeater->add_control(
                'amokit_progressbar_title', 
                [
                    'label'       => __( 'Title', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'WordPress' , 'amokit-addons' ),
                ]
            );

            $repeater->add_control(
                'amokit_progressbar_value', 
                [
                    'label' => __( 'Progress Bar Value', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ]
                ]
            );

            $repeater->add_control(
                'amokit_progressbar_color', 
                [
                    'label'     => __( 'Progress bar color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .htb-progress-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_progressbar_value_color', 
                [
                    'label'     => __( 'Progress bar value color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .percent-label' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $repeater->add_control(
                'amokit_progressbar_value_bg_color', 
                [
                    'label'     => __( 'Progress bar value background color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .percent-label' => 'background-color: {{VALUE}};',
                    ],
                ]
            ); //

            $repeater->add_control(
                'amokit_progressbar_indicator_color', 
                [
                    'label'     => __( 'Progress Indicator', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amokit-progress-indicator .htb-progress .htb-progress-bar::after' => 'background-color: {{VALUE}};border-color: {{VALUE}};'
                    ],
                ]
            );

            $repeater->add_control(
                'progressbar_before_after', 
                [
                    'label'         => __( 'Value Indicator', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                ]
            );
            $repeater->add_control(
                'progressbar_value_before_after_color', 
                [
                    'label'     => __( 'Indicator color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amokit-progressbar-value-bottom .htb-progress span.percent-label::after' => 'border-top: 5px solid {{VALUE}};',
                    ],
                    'condition' => [
                        'progressbar_before_after' =>'yes',
                    ],
                    'separator' => 'before',
                ]
            );      


            $this->add_control(
            'amokit_progressbar_list',
            [
                'label'     => __( 'Progress Bar', 'amokit-addons' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'prevent_empty'=>false,
                'condition' => [
                    'amokit_progress_bar_style!' =>'circle',
                ],
                'default' => [
                    [
                        'amokit_progressbar_title'         => __('WordPress','amokit-addons'),
                        'amokit_progressbar_color'         => '#18012c',
                        'amokit_progressbar_value_color'   => '#000000',
                        
                    ],
                    [
                        'amokit_progressbar_title'         => __('Joomla','amokit-addons'),
                        'amokit_progressbar_color'         => '#18012c',
                        'amokit_progressbar_value_color'   => '#000000',
                    ],
                    [
                        'amokit_progressbar_title'         => __('Photoshop','amokit-addons'),
                        'amokit_progressbar_color'         => '#18012c',
                        'amokit_progressbar_value_color'   => '#000000',
                    ],
                ],
                'title_field' => '{{{ amokit_progressbar_title }}}',
            ]
        );


            // Accordion Two Repeater

            $repeater_two = new Repeater();

            $repeater_two->add_control(
                'amokit_progressbar_title', 
                [
                    'label'       => __( 'Title', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'WordPress' , 'amokit-addons' ),
                ]
            );

            $repeater_two->add_control(
                'amokit_progressbar_value', 
                [
                    'label' => __( 'Progress Bar Value', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ]
                ]
            );

            $repeater_two->add_control(
                'amokit_progressbar_lineweight', 
                [
                    'label'     => __( 'Progress Bar Width', 'amokit-addons' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px'    => [
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
                        'size' => 10,
                    ],
                ]
            );

            $repeater_two->add_control(
                'amokit_progressbar_size', 
                [
                'label' => __( 'Progress Bar Size', 'amokit-addons' ),
                'type'  => Controls_Manager::SLIDER,
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
                    'size' => 130,
                ],
                ]
            );

            $repeater_two->add_control(
                'amokit_progressbar_two_color', 
                [
                'label'     => __( 'Progress bar Background', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   =>'#1cb9da',
                ]
            );
            $repeater_two->add_control(
                'amokit_progressbar_track_color', 
                [
                'label'     => __( 'Progress bar track color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   =>'#dcd9d9',
                ]
            );


            $repeater_two->add_control(
                'amokit_progressbar_two_value_color', 
                [
                    'label'     => __( 'Progress bar value color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .radial-progress span' => 'color: {{VALUE}};',
                    ]
                ]
            );
            $repeater_two->add_control(
                'amokit_progressbar_two_value_bg_color', 
                [
                    'label'     => __( 'Progress bar value background color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amokit-progress-value-inner .radial-progress span' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $repeater_two->add_control(
                'progressbar_single_items_padding', 
                [
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .radial-progressbg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $repeater_two->add_control(
                'progressbar_single_items_border', 
                [
                    'label'      => __( 'Border', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .radial-progressbg' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style:solid;',
                    ],
                    'separator' => 'before',
                ]
            );
            $repeater_two->add_control(
                'progressbar_single_items_border_color', 
                [
                    
                'label'     => __( 'Border color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .radial-progressbg' => 'border-color: {{VALUE}};',
                ],
                ]
            );

            $repeater_two->add_control(
                'progressbar_single_items_border_radius', 
                [
                    'label' => esc_html__( 'Border Radius aaa', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .radial-progressbg , {{WRAPPER}} {{CURRENT_ITEM}}.amokit-progress-value-inner .radial-progress span' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
            'amokit_progressbar_list_two',
            [
                'label'     => __( 'Progress Bar', 'amokit-addons' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater_two->get_controls(),
                'prevent_empty'=>false,
                'condition' => [
                    'amokit_progress_bar_style' =>'circle',
                ],
                'default' => [
                    [
                        'amokit_progressbar_title'         => __('WordPress','amokit-addons'),
                        
                    ],
                ],
                'title_field' => '{{{ amokit_progressbar_title }}}',
            ]
        );

        $this->end_controls_section();

        // Progress Bar value style tab start
        $this->start_controls_section(
            'amokit_progressbar_items_style',
            [
                'label'     => __( 'Items Style', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'amokit_progress_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
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
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-skill .htb-progress' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'amokit_progress_bar_style' =>'horizontal',
                    ],

                ]
            );

            $this->add_responsive_control(
                'amokit_progress_position',
                [
                    'label' => __( 'Progress Position Top-Bottom', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-skill .htb-progress-bar' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'amokit_progress_bar_style' =>'horizontal',
                    ],

                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'progressbarbackground',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-single-skill .htb-progress',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'progressbar_items_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-skill .htb-progress', 
                ]
            );

            $this->add_responsive_control(
                'progressbar_items_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-skill .htb-progress' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-single-skill .htb-progress-bar' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .radial-progress-single' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'progressbar_items_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-skill .htb-progress',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'progressbar_items_padding',
                [
                    'label' => __( 'Item Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .radial-progress-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-single-skill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'progressbar_items_inner_padding',
                [
                    'label' => __( 'Item Inner Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-skill .htb-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'progress_bar_indicator',
                [
                    'label' => __( 'Progress Indicator', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' =>[
                        'amokit_progress_bar_style!' => 'circle',
                    ],
                    'separator' => 'before',
                ]
            );


            $this->add_control(
                'indicatordimention',
                [
                    'label' => __( 'Indicator Size', 'amokit-addons' ),
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 24,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-progress-indicator .htb-progress .htb-progress-bar::after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'progress_bar_indicator' =>'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'indicatorbackground',
                    'label' => __( 'Indicator Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amokit-progress-indicator .htb-progress .htb-progress-bar::after',
                    'condition' => [
                        'progress_bar_indicator' =>'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'progressbar_indicator_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-progress-indicator .htb-progress .htb-progress-bar::after',
                    'condition' => [
                        'progress_bar_indicator' =>'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progressbar_indicator_border_radius',
                [
                    'label' => esc_html__( 'Indicator Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-progress-indicator .htb-progress .htb-progress-bar::after' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition' => [
                        'progress_bar_indicator' =>'yes',
                    ],
                ]
            );            
            

        $this->end_controls_section(); // Progress Bar value style tab end        

        // Style tab Title section
        $this->start_controls_section(
            'amokit_progressbar_title_style',
            [
                'label' => __( 'Title Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'progress_text_postion',
                [
                    'label' => __( 'Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Inner', 'amokit-addons' ),
                    'label_off' => __( 'Outer', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'     => [
                        'amokit_progress_bar_style!' => 'circle',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'titlebackground',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} p.amokit_progress_title',
                ]
            );

            $this->add_responsive_control(
                'progressbar_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} p.amokit_progress_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .radial-progress-single h5.radial-amokit-' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'progressbar_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} p.amokit_progress_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .radial-progress-single h5.radial-amokit-' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'progressbar_title_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} p.amokit_progress_title',
                ]
            );

            $this->add_responsive_control(
                'progressbar_title_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} p.amokit_progress_title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .radial-progress-single h5.radial-amokit-' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'progressbar_title_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} p.amokit_progress_title',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'progressbar_progressbar_title_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} p.amokit_progress_title' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .radial-progress-single h5.radial-amokit-' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'progressbar_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} p.amokit_progress_title, {{WRAPPER}} .radial-progress-single h5.radial-amokit-',
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section(); // Progress Bar title style tab end

        // Progress Bar value style tab start
        $this->start_controls_section(
            'amokit_progressbar_value_style',
            [
                'label'     => __( 'Value', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'progress_value_postion',
                [
                    'label' => __( 'Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Inner', 'amokit-addons' ),
                    'label_off' => __( 'Outer', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'progressbar_value_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htb-progress span.percent-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .radial-progress-single .radial-progress span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'progressbar_value_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .htb-progress span.percent-label',
                ]
            );

            $this->add_responsive_control(
                'progressbar_value_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htb-progress span.percent-label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .radial-progress-single .radial-progress span' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'progressbar_value_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .htb-progress span.percent-label',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'progressbar_value_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-skill .htb-progress span.percent-label,{{WRAPPER}} .radial-progress-single .radial-progressbg .radial-progress span',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'progressbar_value_position',
                [
                    'label' => __( 'Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-skill .htb-progress span.percent-label' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'amokit_progress_bar_style' =>'horizontal',
                        'progress_value_postion!' => 'yes'
                    ],

                ]
            );

        $this->end_controls_section(); // Progress Bar value style tab end


    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $progressbar_list = $settings['amokit_progressbar_list'];

        $progressbar_list_two = $settings['amokit_progressbar_list_two'];
        $progress_type_class = '';

        if( $settings['progress_value_postion'] == 'yes' ){
            $this->add_render_attribute( 'amokit_progress_circle', 'class', 'amokit-progress-value-inner' );
        }

        if( $settings['progress_text_postion'] == 'yes' ){
            $this->add_render_attribute( 'amokit_progress_circle', 'class', 'amokit-progress-text-inner' );
        }

        if( $settings['amokit_progress_bar_type'] == 'striped' ){
            $progress_type_class = 'htb-progress-bar-striped ';
        }

        if( $settings['striped_animated'] == 'yes' ){
            $progress_type_class .= 'htb-progress-bar-animated';
        }


        if( $settings['amokit_progress_bar_style'] == 'circle' ){
            if( $progressbar_list_two ){
                $this->add_render_attribute( 'amokit_progress_circle', 'class', 'radial-progress-single' );
                foreach ( $progressbar_list_two as $item ) {
                    $this->add_render_attribute( 'amokit_progress_circle', 'class', 'elementor-repeater-item-'. esc_attr( $item['_id'] ) );

                    $items_value_size = absint( $item['amokit_progressbar_size']['size'] ) - ( absint( $item['amokit_progressbar_lineweight']['size'] ) +8 );
                    ?>  
                    <div <?php echo $this->get_render_attribute_string( 'amokit_progress_circle' ); ?>>
                        <div class="radial-progressbg">
                            <div class="radial-progress" data-percent="<?php echo esc_attr( $item['amokit_progressbar_value']['size'] );?>" data-bar-color="<?php echo esc_attr($item['amokit_progressbar_two_color']);?>" data-track-color="<?php echo esc_attr($item['amokit_progressbar_track_color'] );?>" data-line-width="<?php echo esc_attr($item['amokit_progressbar_lineweight']['size'] );?>" data-size="<?php echo esc_attr($item['amokit_progressbar_size']['size'] );?>">
                                <span style="<?php echo 'line-height:'. absint( $items_value_size ).'px;'; echo 'width:'. absint( $items_value_size ).'px;'; echo 'height:'. absint( $items_value_size ).'px;';?>"><?php echo esc_html( $item['amokit_progressbar_value']['size'] ).'%';?></span>
                            </div>
                        </div>
                        <h5 class="radial-amokit-"><?php echo wp_kses_post( $item['amokit_progressbar_title'] );?></h5>
                    </div>
                    <?php
                }
            }
        }else{
            if( $settings['amokit_progressbar_list'] ){
              
                foreach ( $settings['amokit_progressbar_list'] as $key => $item ) {

                    $column_repeater_key = $this->get_repeater_setting_key( 'amokit_progressbar_title', 'amokit_progressbar_list', $key );
                    $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-single-skill' );
                    $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-progress-bar-'. esc_attr( $settings['amokit_progress_bar_style'] ) );

                    if( $settings['progress_value_postion'] == 'yes' ){
                        $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-progress-value-inner' );
                    }
                    if( $settings['progress_text_postion'] == 'yes' ){
                        $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-progress-text-inner' );
                    }

                    $this->add_render_attribute( $column_repeater_key, 'class', 'elementor-repeater-item-'. esc_attr( $item['_id'] ) );
                    if( $item['progressbar_before_after'] == 'yes' ){
                        $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-progressbar-value-bottom' );
                    }
                    if( $settings['progress_bar_indicator'] == 'yes' ){
                        $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-progress-indicator' );
                    }
                    ?>
                    <div <?php echo $this->get_render_attribute_string( $column_repeater_key ); ?> >
                        <p class="amokit_progress_title"><?php echo wp_kses_post( $item['amokit_progressbar_title'] );?></p>
                        <div class="htb-progress">
                            <div class="htb-progress-bar wow <?php echo esc_attr( $progress_type_class ).' '; if( $settings['amokit_progress_bar_style'] == 'vertical' ){ echo 'fadeInUp'; }else{ echo 'fadeInLeft'; } ?>" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar"
                                style="<?php if( $settings['amokit_progress_bar_style'] == 'vertical' ){ echo 'height:'.esc_attr( $item['amokit_progressbar_value']['size'] ).'%';} else{ echo 'width:'.esc_attr( $item['amokit_progressbar_value']['size'] ).'%'; }?>;" aria-valuenow="<?php echo esc_attr( $item['amokit_progressbar_value']['size'] );?>" aria-valuemin="0" aria-valuemax="100">
                                <span class="percent-label">
                                    <?php echo esc_attr( $item['amokit_progressbar_value']['size'] ).'%';?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                } // End foreach
            }
        }
    }
}
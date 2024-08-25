<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Counter extends Widget_Base {

    public function get_name() {
        return 'amokit-counter-addons';
    }
    
    public function get_title() {
        return __( 'Counter', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-counter';
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
        return [
            // 'counterup',
            'waypoints',
            'jquery-numerator',
            'amokit-widgets-scripts',
        ];
    }
    public function get_keywords() {
        return ['funfact', 'counter', 'fun fact', 'countdown', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/counter-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'counter_content',
            [
                'label' => __( 'Counter', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'counter_layout_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default'=>'1',
                    'options' => [
                        '1' => __( 'Style One', 'amokit-addons' ),
                        '2' => __( 'Style Two', 'amokit-addons' ),
                        '3' => __( 'Style Three', 'amokit-addons' ),
                        '4' => __( 'Style Four', 'amokit-addons' ),
                        '5' => __( 'Style Five', 'amokit-addons' ),
                        '6' => __( 'Style Six', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'counter_layout_align',
                [
                    'label'   => __( 'Alignment', 'amokit-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Start', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'End', 'amokit-addons' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'default'     => is_rtl() ? 'right' : 'left',
                    'toggle'      => false,
                    'label_block' => false,
                    'condition' => [
                        'counter_layout_style' => '2',
                    ]
                ]
            );

            $this->add_control(
                'counter_icon_type',
                [
                    'label'   => __( 'Icon Type', 'amokit-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'label_block'=>false,
                    'options' => [
                        'none' => [
                            'title' => __( 'None', 'amokit-addons' ),
                            'icon'  => 'eicon-ban',
                        ],
                        'image' => [
                            'title' => __( 'Image', 'amokit-addons' ),
                            'icon'  => 'eicon-image-bold',
                        ],
                        'icon' => [
                            'title' => __( 'Icon', 'amokit-addons' ),
                            'icon'  => 'eicon-info-circle',
                        ],
                    ],
                    'default' => 'image',
                ]
            );

            $this->add_control(
                'counter_icon',
                [
                    'label' => __( 'Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'condition'=>[
                        'counter_icon_type'=>'icon',
                    ],
                ]
            );

            $this->add_control(
                'counter_image',
                [
                    'label' => __('Image','amokit-addons'),
                    'type'=>Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'counter_icon_type' => 'image',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'counter_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'counter_icon_type' => 'image',
                    ]
                ]
            );

            $this->add_control(
                'counter_title',
                [
                    'label' => __( 'Counter Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Happy Clients', 'amokit-addons' ),
                    'placeholder' => __( 'Type your title here', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'terget_number',
                [
                    'label' => __( 'Target Number', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 100,
                ]
            );

            $this->add_control(
                'counter_number_prefix',
                [
                    'label' => __( 'Number Prefix', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( '$', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'counter_number_suffix',
                [
                    'label' => __( 'Number Suffix', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( '+', 'amokit-addons' ),
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'counter_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_area_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area',
                ]
            );

            $this->add_control(
                'counter_area_background_overlay',
                [
                    'label'     => __( 'Background Overlay', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area::before' => 'background-color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                    'default'=>'#52b6bc',
                    'condition' => [
                        'counter_area_background_image[id]!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'counter_area_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_area_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_area_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area',
                ]
            );

            $this->add_responsive_control(
                'counter_area_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-counter-area::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'title_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'counter_area_align',
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
                        '{{WRAPPER}} .amo-counter-area' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'condition'=>[
                        'counter_layout_style!'=>'2',
                    ]
                ]
            );

            $this->add_responsive_control(
                'counter_area_align_justify',
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
                        '{{WRAPPER}} .amo-counter-area.amo-counter-style-2' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'condition'=>[
                        'counter_layout_style'=>'2',
                    ]
                ]
            );

            $this->add_control(
                'counter_area_width',
                [
                    'label' => __( 'Box  Width', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-counter-area.amo-counter-style-3' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_layout_style'=>'3',
                    ]
                ]
            );

            $this->add_control(
                'counter_area_height',
                [
                    'label' => __( 'Box Height', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-counter-area.amo-counter-style-3' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_layout_style'=>'3',
                    ]
                ]
            );

        $this->end_controls_section();

        // Style Number tab section
        $this->start_controls_section(
            'counter_number_style_section',
            [
                'label' => __( 'Number', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'terget_number!'=>'',
                ]
            ]
        );
            $this->add_responsive_control(
                'counter_number_align',
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
                        '{{WRAPPER}} .amo-counter-style-2 .amo-counter-content' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'condition'=>[
                        'counter_layout_style'=>'2',
                    ]
                ]
            );

            $this->add_control(
                'counter_number_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#696969',
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_number_typography',
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number,{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_number_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number,{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number',
                ]
            );

            $this->add_responsive_control(
                'counter_number_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_number_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_number_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number,{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number',
                ]
            );

            $this->add_responsive_control(
                'counter_number_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-number' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon .amo-counter-number' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'counter_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_title!'=>'',
                ]
            ]
        );

            $this->add_responsive_control(
                'counter_title_align',
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
                        '{{WRAPPER}} .amo-counter-style-2 .amo-counter-content h2' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'condition'=>[
                        'counter_layout_style'=>'2',
                    ]
                ]
            );

            $this->add_control(
                'counter_title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#898989',
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_title_typography',
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_title_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title',
                ]
            );

            $this->add_responsive_control(
                'counter_title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_title_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title',
                ]
            );

            $this->add_responsive_control(
                'counter_title_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-counter-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'counter_title_after_color',
                [
                    'label' => __( 'Title After Border Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-content h2::before' => 'background-color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'counter_layout_style!'=>array('2','3','6'),
                    ]
                ]
            );

            $this->add_control(
                'counter_title_brdr_width',
                [
                    'label' => __( 'After Border Width', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-counter-content h2::before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_layout_style!'=>array('2','3','6'),
                    ]
                ]
            );

            $this->add_control(
                'counter_title_brdr_height',
                [
                    'label' => __( 'After Border Height', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-content h2::before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_layout_style!'=>array('2','3','6'),
                    ]
                ]
            );

            $this->add_control(
                'counter_title_brdr_position',
                [
                    'label' => __( 'After Border Position', 'amokit-addons' ),
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
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-content h2::before' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_layout_style!'=>array('2','3','6'),
                    ]
                ]
            );

        $this->end_controls_section();

        // Style Title After Border Control
        $this->start_controls_section(
            'counter_title_border_section',
            [
                'label' => __( 'Border After Color', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_layout_style'=>'6',
                ]
            ]
        );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_title_brdr_clr',
                    'label' => __( 'After Border Color', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-style-6 .amo-counter-content::after',
                ]
            );

            $this->add_control(
                'counter_title_after_brdr_width',
                [
                    'label' => __( 'Border Width', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-counter-style-6 .amo-counter-content::after' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Icon tab section
        $this->start_controls_section(
            'counter_icon_style_section',
            [
                'label' => __( 'Icon/Image', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'counter_icon_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ed552d',
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition'=>[
                        'counter_icon_type'=>'icon',
                    ],
                ]
            );

            $this->add_control(
                'counter_icon_size',
                [
                    'label' => __( 'Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 36,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_icon_type'=>'icon',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_icon_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-icon span,{{WRAPPER}} .amo-counter-area .amo-counter-img',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-area .amo-counter-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_icon_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-icon span,{{WRAPPER}} .amo-counter-area .amo-counter-img',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-icon span, {{WRAPPER}} .amo-counter-area .amo-counter-img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'counter_icon_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-icon span, {{WRAPPER}} .amo-counter-area .amo-counter-img',
                ]
            );
        $this->end_controls_section();

        // Style Prefix tab section
        $this->start_controls_section(
            'counter_prefix_style_section',
            [
                'label' => __( 'Prefix', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_number_prefix!'=>'',
                ]
            ]
        );
            $this->add_control(
                'counter_prefix_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#696969',
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_prefix_typography',
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_prefix_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix',
                ]
            );

            $this->add_responsive_control(
                'counter_prefix_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_prefix_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_prefix_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix',
                ]
            );

            $this->add_responsive_control(
                'counter_prefix_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-prefix' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Suffix tab section
        $this->start_controls_section(
            'counter_suffix_style_section',
            [
                'label' => __( 'Suffix', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_number_suffix!'=>'',
                ]
            ]
        );
            $this->add_control(
                'counter_suffix_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#696969',
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-counter-style-6 .amo-counter-icon span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_suffix_typography',
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix,.amo-counter-style-6 .amo-counter-icon .amo-suffix',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_suffix_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix',
                ]
            );

            $this->add_responsive_control(
                'counter_suffix_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-counter-style-6 .amo-counter-icon .amo-suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_suffix_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix,.amo-counter-style-6 .amo-counter-icon .amo-suffix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'counter_suffix_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix,.amo-counter-style-6 .amo-counter-icon .amo-suffix',
                ]
            );

            $this->add_responsive_control(
                'counter_suffix_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-counter-area .amo-counter-content .amo-suffix,.amo-counter-style-6 .amo-counter-icon .amo-suffix' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'amokit_counter_attr', 'class', 'amokit-counter-area amokit-counter-style-'. esc_attr( $settings['counter_layout_style'] ) );

        $this->add_render_attribute( 'amokit_counter_attr', 'class', 'amokit-countericon-align-'. esc_attr( $settings['counter_layout_align'] ) );
        $this->add_render_attribute( 'counter_active_attr', 'class', 'amokit-counter-number');
        $this->add_render_attribute( 'counter_active_attr', 'data-to-value', esc_attr( $settings['terget_number'] ));
        
        $prefix = $suffix = '';
        if( !empty($settings['counter_number_prefix']) ){
            $prefix = '<span class="amo-prefix">'.$settings['counter_number_prefix'].'</span>';
        }
        if( !empty($settings['counter_number_suffix']) ){ 
            $suffix = '<span class="amo-suffix">'.$settings['counter_number_suffix'].'</span>';
        }
    
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_counter_attr' ); ?>>

            
                <?php
                    if( $settings['counter_layout_style'] == 6 ){
                        echo '<div class="amo-counter-icon">';
                            if( isset( $settings['counter_icon']['value'] ) ){
                                echo '<span>'.amo_Icon_manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] ).'</span>';
                            }
                            if( isset( $settings['counter_image']['url'] ) ){
                                echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'counter_image_size', 'counter_image' );
                            }
                            if( !empty( $settings['terget_number'] ) ){
                                echo amokit_kses_title( $prefix ).'<span '. $this->get_render_attribute_string( 'counter_active_attr' ).'>0</span>'.amo_kses_title( $suffix );
                            }
                        echo '</div>';
                    }else{
                        if( isset( $settings['counter_icon']['value'] ) ){
                            echo '<div class="amo-counter-icon"><span>'.amo_Icon_manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] ).'</span></div>';
                        }
                        if( isset( $settings['counter_image']['url'] ) ){
                            echo '<div class="amo-counter-img">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'counter_image_size', 'counter_image' ).'</div>';
                        }
                    }                    
                ?>
                <div class="amo-counter-content">
                    <?php
                        if($settings['counter_layout_style'] == 4 ){
                            if( !empty( $settings['counter_title'] ) ){
                                echo '<h2 class="amo-counter-title">'.esc_html( $settings['counter_title'] ).'</h2>';
                            }
                            if( !empty( $settings['terget_number'] ) ){
                                echo amokit_kses_title( $prefix ).'<span '. $this->get_render_attribute_string( 'counter_active_attr' ).'>0</span>'.amo_kses_title( $suffix );
                            }
                        }elseif($settings['counter_layout_style'] == 6 ){
                            if( !empty( $settings['counter_title'] ) ){
                                echo '<h2 class="amo-counter-title">'.esc_html( $settings['counter_title'] ).'</h2>';
                            }
                        }else{
                            if( !empty( $settings['terget_number'] ) ){
                                echo amokit_kses_title( $prefix ).'<span '. $this->get_render_attribute_string( 'counter_active_attr' ).'>0</span>'.amo_kses_title( $suffix );
                            }
                            if( !empty( $settings['counter_title'] ) ){
                                echo '<h2 class="amo-counter-title">'.esc_html( $settings['counter_title'] ).'</h2>';
                            }
                        }
                    ?>
                </div>
            </div>
        <?php
    }
}
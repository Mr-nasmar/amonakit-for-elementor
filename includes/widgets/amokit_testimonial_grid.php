<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Testimonial_Grid extends Widget_Base {

    public function get_name() {
        return 'amokit-testimonialgrid-addons';
    }
    
    public function get_title() {
        return __( 'Testimonial Grid', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-testimonial';
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
        return ['amokit', 'Amona Kit', 'testimonial', 'review', 'feedback', 'grid', 'column', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/testimonial-grid-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'testimonial_content',
            [
                'label' => __( 'Testimonial Grid', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'testimonial_style',
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
                    ],
                ]
            );
            $this->add_control(
                'testimonial_column_controll',
                [
                    'label' => __( 'Column ', 'amokit-addons' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'None', 'amokit-addons' ),
                    'label_on' => __( 'Custom', 'amokit-addons' ),
                    'return_value' => 'yes',
                ]
            );

            $this->start_popover();

            $this->add_control(
                'testimonial_column',
                [
                    'label' => __( 'Desktop', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1'   => __( 'One', 'amokit-addons' ),
                        '2'   => __( 'Two', 'amokit-addons' ),
                        '3'   => __( 'Three', 'amokit-addons' ),
                        '4'   => __( 'Four', 'amokit-addons' ),
                        '5'   => __( 'Five', 'amokit-addons' ),
                        '6'   => __( 'Six', 'amokit-addons' ),
                    ],
                ]
            );
            $this->add_control(
                'testimonial_column_tablet',
                [
                    'label' => __( 'Tablet', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '12'   => __( 'One', 'amokit-addons' ),
                        '6'   => __( 'Two', 'amokit-addons' ),
                        '4'   => __( 'Three', 'amokit-addons' ),
                        '3'   => __( 'Four', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'testimonial_column[value]!'=>'5'
                    ]
                ]
            );
            $this->add_control(
                'testimonial_column_Large_mobile',
                [
                    'label' => __( 'Large Mobile', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '6',
                    'options' => [
                        '12'   => __( 'One', 'amokit-addons' ),
                        '6'   => __( 'Two', 'amokit-addons' ),
                        '4'   => __( 'Three', 'amokit-addons' ),
                        '3'   => __( 'Four', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'testimonial_column[value]!'=>'5'
                    ]
                ]
            );
            $this->add_responsive_control(
                'custom_column_width',
                [
                    'label' => __( 'Other\' Devices Width(%)', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => '20',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .custom-col-5' => ' flex: 0 0 {{SIZE}}%;
                        max-width: {{SIZE}}%;',
                    ],
                    'condition' =>[
                        'testimonial_column[value]'=>'5'
                    ]
                ]
            );
            $this->end_popover();


            $this->add_responsive_control(
                'column_gap',
                [
                    'label' => esc_html__( 'Column Gap', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'description' => esc_html__( 'Add Column gap Ex. 15px', 'amokit-addons' ),
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htb-row' => 'margin: 0 -{{SIZE}}px',
                        '{{WRAPPER}} .htb-row [class*="htb-col-"],{{WRAPPER}} .htb-row [class*="custom-col-"]' => 'padding: 0 {{SIZE}}px',
                    ],
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'client_name',
                [
                    'label'   => __( 'Name', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __('Carolina Monntoya','amokit-addons'),
                ]
            );

            $repeater->add_control(
                'client_designation',
                [
                    'label'   => __( 'Designation', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __('Managing Director','amokit-addons'),
                ]
            );

            $repeater->add_control(
                'client_rating',
                [
                    'label' => __( 'Client Rating', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ]
            );

            $repeater->add_control(
                'client_image',
                [
                    'label' => __( 'Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'client_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

            $repeater->add_control(
                'client_say',
                [
                    'label'   => __( 'Client Say', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => __('Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','amokit-addons'),
                ]
            );

            $this->add_control(
                'amokit_testimonial_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [

                        [
                            'client_name'           => __('Carolina Monntoya','amokit-addons'),
                            'client_designation'    => __( 'Managing Director','amokit-addons' ),
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'amokit-addons' ),
                        ],

                        [
                            'client_name'           => __('Peter Rose','amokit-addons'),
                            'client_designation'    => __( 'Manager','amokit-addons' ),
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'amokit-addons' ),
                        ],

                        [
                            'client_name'           => __('Gerald Gilbert','amokit-addons'),
                            'client_designation'    => __( 'Developer','amokit-addons' ),
                            'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'amokit-addons' ),
                        ],
                    ],
                    'title_field' => '{{{ client_name }}}',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'testimonial_style_section',
            [
                'label' => __( 'Item Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
            // Normal Style Tab
            $this->start_controls_tab(
                'box_tab_normal_style',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );

            $this->add_responsive_control(
                'box_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .testimonal',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .testimonal',
                ]
            );

            $this->add_responsive_control(
                'box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .testimonal,.testimonal:before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .testimonal',
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
                    'name' => 'box_background_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .testimonal:before',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_border_hover',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .testimonal:hover',
                ]
            );
            $this->add_control(
                'box_hover_content_color',
                [
                    'label' => __( 'All Content Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal:hover .clint-info h4,
                        {{WRAPPER}} .amo-testimonialgrid-area .testimonal:hover p,
                        {{WRAPPER}} .amo-testimonialgrid-area .testimonal:hover .content p,
                        {{WRAPPER}} .amo-testimonialgrid-area .testimonal:hover .clint-info span' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-style-2 .testimonal:hover .content .clint-info::before' => 'background: {{VALUE}};',
                    ],

                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow_hover',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .testimonal:hover',
                ]
            );

            $this->end_controls_tab();
        $this->end_controls_tabs();            
        $this->end_controls_section();

        // Style Testimonial image style start
        $this->start_controls_section(
            'amokit_testimonial_image_style',
            [
                'label'     => __( 'Image', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_testimonial_image_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-area .testimonal img',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section(); // Style Testimonial image style end

        // Style Testimonial name style start
        $this->start_controls_section(
            'amokit_testimonial_name_style',
            [
                'label'     => __( 'Name', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'amokit_testimonial_name_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#383838',
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content h4' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info h4' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-style-2 .testimonal .content .clint-info::before' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_testimonial_name_typography',
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content h4, {{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info h4',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_name_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} {{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_name_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} {{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial name style end

        // Style Testimonial designation style start
        $this->start_controls_section(
            'amokit_testimonial_designation_style',
            [
                'label'     => __( 'Designation', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'amokit_testimonial_designation_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1834a6',
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content span' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_testimonial_designation_typography',
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content span, {{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info span',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_designation_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_designation_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .clint-info span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end


        // Style Testimonial designation style start
        $this->start_controls_section(
            'amokit_testimonial_clientsay_style',
            [
                'label'     => __( 'Client say', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'amokit_testimonial_clientsay_align',
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
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content p' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal p' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'amokit_testimonial_clientsay_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5b5b5b',
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal p' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_testimonial_clientsay_typography',
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content p, {{WRAPPER}} .amo-testimonialgrid-area .testimonal p',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_clientsay_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content p,{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_testimonial_clientsay_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .testimonal p,{{WRAPPER}} .amo-testimonialgrid-area .testimonal .content p,{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                    'separator' =>'before',
                ]
            );
            
            $this->add_responsive_control(
                'box_border_content_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition'=>[
                        'testimonial_style' =>'4', 
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'client_say_bg_color',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content',
                    'condition'=>[
                        'testimonial_style' =>'4', 
                    ]
                ]
            );
            $this->add_control(
                'client_say_arrow_color',
                [
                    'label' => __( 'Arrow Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content .triangle' => 'border-color: {{VALUE}} transparent transparent;',
                    ],
                    'condition'=>[
                        'testimonial_style' =>'4', 
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-testimonialgrid-style-4 .testimonal .content',
                    'condition'=>[
                        'testimonial_style' =>'4', 
                    ]
                ]
            );
        $this->end_controls_section(); // Style Testimonial designation style end

        // Style Testimonial designation style start
        $this->start_controls_section(
            'amokit_testimonial_clientrating_style',
            [
                'label'     => __( 'Rating', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'rating_position',
            [
                'label' => esc_html__( 'Rating On Right', 'amokit-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
                'condition' =>[
                    'testimonial_style' => '5',
                ]
            ]
        );
            $this->add_control(
                'amokit_testimonial_clientrating_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffcf0e',
                    'selectors' => [
                        '{{WRAPPER}} .amo-testimonialgrid-area .clint-info .rating' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $sectionid = "sid". $this-> get_id();
        $this->add_render_attribute( 'testimonial_grid_attr', 'class', 'amokit-testimonialgrid-area amokit-testimonialgrid-style-' . esc_attr( $settings['testimonial_style'].' '.$sectionid ) );

        $columns = !empty( $settings['testimonial_column']) ? $settings['testimonial_column'] : 3 ;

        $collumval = 'htb-col-md-4 htb-col-sm-6 htb-col-12';


        if( $columns != 5 ){
            $colwidth = round(12/$columns);

            $columns_tablet = !empty( $settings['testimonial_column_tablet']) ? $settings['testimonial_column_tablet'] : $colwidth ;
            $columns_large_mobile = !empty( $settings['testimonial_column_Large_mobile']) ? $settings['testimonial_column_Large_mobile'] : 6 ;
    
            $collumval = 'htb-col-lg-'.$colwidth.' htb-col-md-'.$columns_tablet.' htb-col-sm-'.$columns_large_mobile.' htb-col-12';
        }else{
            $collumval = 'custom-col-5';
        }

       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'testimonial_grid_attr' ); ?>>

                <div class="htb-row">
                    <?php foreach ( $settings['amokit_testimonial_list'] as $testimonial ): ?>

                        <div class="<?php echo esc_attr( $collumval ); ?>">

                        <?php if( $settings['testimonial_style'] == 2 || $settings['testimonial_style'] == 3 ): ?>
                            <div class="testimonal">
                                <?php
                                    echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                                ?>
                                <div class="content">
                                    <?php
                                        if( !empty($testimonial['client_say']) ){
                                            echo '<p>'.amo_kses_desc( $testimonial['client_say'] ).'</p>';
                                        }
                                    ?>
                                    <div class="clint-info">
                                        <?php
                                            if( !empty($testimonial['client_name']) ){
                                                echo '<h4>'.amo_kses_title( $testimonial['client_name'] ).'</h4>';
                                            }
                                            if( !empty($testimonial['client_designation']) ){
                                                echo '<span>'.esc_html( $testimonial['client_designation'] ).'</span>';
                                            }

                                            // Rating
                                            if( !empty( $testimonial['client_rating'] ) ){
                                                $rating = floatval( $testimonial['client_rating'] );
                                                $rating_whole = floor( $testimonial['client_rating'] );
                                                $rating_fraction = $rating - $rating_whole;
                                                echo '<ul class="rating">';
                                                    for($i = 1; $i <= 5; $i++){
                                                        if( $i <= $rating_whole ){
                                                            echo '<li><i class="fa fa-star"></i></li>';
                                                        } else {
                                                            if( $rating_fraction != 0 ){
                                                                echo '<li><i class="fa fa-star-half-o"></i></li>';
                                                                $rating_fraction = 0;
                                                            } else {
                                                                echo '<li><i class="fa fa-star-o"></i></li>';
                                                            }
                                                        }
                                                    }
                                                echo '</ul>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( $settings['testimonial_style'] == 4 ): ?>
                            <div class="testimonal">
                                <div class="content">
                                    <?php
                                        if( !empty($testimonial['client_say']) ){
                                            echo '<p>'.amo_kses_desc( $testimonial['client_say'] ).'</p>';
                                        }
                                    ?>
                                    <div class="triangle"></div>
                                </div>
                                <div class="clint-info">
                                    <?php
                                        echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                                        if( !empty($testimonial['client_name']) ){
                                            echo '<h4>'.amo_kses_title( $testimonial['client_name'] ).'</h4>';
                                        }
                                        if( !empty($testimonial['client_designation']) ){
                                            echo '<span>'.esc_html( $testimonial['client_designation'] ).'</span>';
                                        }

                                        // Rating
                                        if( !empty( $testimonial['client_rating'] ) ){
                                            $rating = floatval( $testimonial['client_rating'] );
                                            $rating_whole = floor( $testimonial['client_rating'] );
                                            $rating_fraction = $rating - $rating_whole;
                                            echo '<ul class="rating">';
                                                for($i = 1; $i <= 5; $i++){
                                                    if( $i <= $rating_whole ){
                                                        echo '<li><i class="fa fa-star"></i></li>';
                                                    } else {
                                                        if( $rating_fraction != 0 ){
                                                            echo '<li><i class="fa fa-star-half-o"></i></li>';
                                                            $rating_fraction = 0;
                                                        } else {
                                                            echo '<li><i class="fa fa-star-o"></i></li>';
                                                        }
                                                    }
                                                }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>
                            </div>

                        <?php elseif( $settings['testimonial_style'] == 5 ): ?>
                            <div class="testimonal">
                                <div class="content">
                                    <?php
                                        echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                                    ?>
                                    <div class="clint-info">
                                        <?php
                                            if( !empty($testimonial['client_name']) ){
                                                echo '<h4>'.amo_kses_title( $testimonial['client_name'] ).'</h4>';
                                            }
                                            if( !empty($testimonial['client_designation']) ){
                                                echo '<span>'.esc_html( $testimonial['client_designation'] ).'</span>';
                                            }
                                            
                                            // Rating
                                            if( !empty( $testimonial['client_rating'] ) ){
                                                $rating = floatval( $testimonial['client_rating'] );
                                                $rating_whole = floor( $testimonial['client_rating'] );
                                                $rating_fraction = $rating - $rating_whole;
                                                echo '<ul class="rating">';
                                                    for($i = 1; $i <= 5; $i++){
                                                        if( $i <= $rating_whole ){
                                                            echo '<li><i class="fa fa-star"></i></li>';
                                                        } else {
                                                            if( $rating_fraction != 0 ){
                                                                echo '<li><i class="fa fa-star-half-o"></i></li>';
                                                                $rating_fraction = 0;
                                                            } else {
                                                                echo '<li><i class="fa fa-star-o"></i></li>';
                                                            }
                                                        }
                                                    }
                                                echo '</ul>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    if( !empty($testimonial['client_say'] ) ){
                                        echo '<p>'.amo_kses_desc( $testimonial['client_say'] ).'</p>';
                                    }
                                ?>
                            </div>

                        <?php else:?>
                            <div class="testimonal">
                                <div class="content">
                                    <?php
                                        echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                                    ?>
                                    <div class="clint-info">
                                        <?php
                                            if( !empty($testimonial['client_name']) ){
                                                echo '<h4>'.amo_kses_title( $testimonial['client_name'] ).'</h4>';
                                            }
                                            if( !empty($testimonial['client_designation'] ) ){
                                                echo '<span>'.esc_html( $testimonial['client_designation'] ).'</span>';
                                            }
                                            
                                            // Rating
                                            if( !empty( $testimonial['client_rating'] ) ){
                                                $rating = floatval( $testimonial['client_rating'] );
                                                $rating_whole = floor( $testimonial['client_rating'] );
                                                $rating_fraction = $rating - $rating_whole;
                                                echo '<ul class="rating">';
                                                    for($i = 1; $i <= 5; $i++){
                                                        if( $i <= $rating_whole ){
                                                            echo '<li><i class="fa fa-star"></i></li>';
                                                        } else {
                                                            if( $rating_fraction != 0 ){
                                                                echo '<li><i class="fa fa-star-half-o"></i></li>';
                                                                $rating_fraction = 0;
                                                            } else {
                                                                echo '<li><i class="fa fa-star-o"></i></li>';
                                                            }
                                                        }
                                                    }
                                                echo '</ul>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    if( !empty($testimonial['client_say']) ){
                                        echo '<p>'.amo_kses_desc( $testimonial['client_say'] ).'</p>';
                                    }
                                ?>
                            </div>
                        <?php endif;?>

                        </div>

                    <?php endforeach; ?>
                </div>

            </div>
            <?php if( 'yes'== $settings['rating_position'] ){
                 $amokit_print_css = "
                    .{$sectionid} .clint-info {
                        position:relative;
                    }
                    .{$sectionid} .clint-info .rating {
                        padding: 0;
                        position: absolute;
                        top: 10px;
                        right: 0;
                    }";
                    if( '' != $amokit_print_css ){ ?>
                        <style>
                            <?php echo esc_html( $amokit_print_css ); ?>
                        </style>
                    <?php } 
                    ?>
                <?php } ?>
        <?php
        
    }

}


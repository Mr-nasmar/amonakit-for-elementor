<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Working_Process extends Widget_Base {

    public function get_name() {
        return 'amokit-working-process-addons';
    }
    
    public function get_title() {
        return __( 'Working Process', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-import-export';
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
        return ['amokit', 'Amona Kit', 'working process', 'process', 'progress', 'button', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/woocommerce-widgets/woocommerce-add-to-cart-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'process_content',
            [
                'label' => __( 'Working Process', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'process_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1' => __( 'Style One', 'amokit-addons' ),
                        '2' => __( 'Style Two', 'amokit-addons' ),
                        '3' => __( 'Style Three', 'amokit-addons' ),
                        '4' => __( 'Style Four', 'amokit-addons' ),
                        '5' => __( 'Style Five', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'process_column',
                [
                    'label' => __( 'Column', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '4',
                    'options' => [
                        '1' => __( 'Column One', 'amokit-addons' ),
                        '2' => __( 'Column Two', 'amokit-addons' ),
                        '3' => __( 'Column Three', 'amokit-addons' ),
                        '4' => __( 'Column Four', 'amokit-addons' ),
                        '5' => __( 'Column Five', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'process_style'=> array(  '1','2' ),
                    ]
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'process_title',
                [
                    'label'   => esc_html__( 'Title', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Process #1', 'amokit-addons' ),
                ]
            );

            $repeater->add_control(
                'process_number',
                [
                    'label'   => esc_html__( 'Process Number', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $repeater->add_control(
                'process_description',
                [
                    'label'   => esc_html__( 'Description', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.', 'amokit-addons' ),
                ]
            );

            $repeater->add_control(
                'process_icon_type',
                [
                    'label' => esc_html__('Icon Type','amokit-addons'),
                    'type' =>Controls_Manager::CHOOSE,
                    'options' =>[
                        'img' =>[
                            'title' =>__('Image','amokit-addons'),
                            'icon' =>'eicon-image-bold',
                        ],
                        'icon' =>[
                            'title' =>__('Icon','amokit-addons'),
                            'icon' =>'eicon-info-circle',
                        ]
                    ],
                    'default' =>'img',
                ]
            );

            $repeater->add_control(
                'process_image',
                [
                    'label' => __('Image','amokit-addons'),
                    'type'=>Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'process_icon_type' => 'img',
                    ]
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'process_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'process_icon_type' => 'img',
                    ]
                ]
            );

            $repeater->add_control(
                'process_icon',
                [
                    'label' =>__('Icon','amokit-addons'),
                    'type'=>Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fa fa-pencil-alt',
                        'library'=>'solid',
                    ],
                    'condition' => [
                        'process_icon_type' => 'icon',
                    ]
                ]
            );

            $this->add_control(
                'amokit_process_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'process_title' => esc_html__( 'Process #1', 'amokit-addons' ),
                            'process_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incid idunt ut labore','amokit-addons' ),
                        ],
                        [
                            'process_title' => esc_html__( 'Process #2', 'amokit-addons' ),
                            'process_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incid idunt ut labore.','amokit-addons' ),
                        ],
                        [
                            'process_title' => esc_html__( 'Process #3', 'amokit-addons' ),
                            'process_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incid idunt ut labore.','amokit-addons' ),
                        ],
                    ],
                    'title_field' => '{{{ process_title }}}',
                ]
            );
            
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'process_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'working_area_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amokit-process-area',
                ]
            );

            $this->add_responsive_control(
                'working_area_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'working_area_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'vertical_line_color',
                [
                    'label' => __( 'Vertical Line Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e51515',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3::before' => 'background: {{VALUE}}',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );
            $this->add_control(
                'vertical_border_width',
                [
                    'label' => __( 'Border Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3::before' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process.process-reverse .icon::before' => 'left: {{SIZE}}px; margin-left:-1px;',
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process .icon::after' => 'width: {{SIZE}}px;',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );
            $this->add_control(
                'vertical_border_hieght',
                [
                    'label' => __( 'Arrow Border Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],


                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process .icon::after' => 'height: {{SIZE}}px;',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );
            $this->add_control(
                'arrow_left_color',
                [
                    'label' => __( 'Arrow Left Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e51515',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process:not(.process-reverse) .icon::before' => 'border-right-color: {{VALUE}}',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );

            $this->add_control(
                'arrow_right_color',
                [
                    'label' => __( 'Arrow Right Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e51515',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process.process-reverse .icon::before' => 'border-left-color: {{VALUE}}',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );
            $this->add_control(
                'arrow_hover_color',
                [
                    'label' => __( 'Arrow Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process.process-reverse:hover .icon::before' => 'border-left-color: {{VALUE}};border-right-color: transparent',
                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process:hover .icon::before' => 'border-right-color: {{VALUE}}',

                        '{{WRAPPER}} .amokit-process-style-3 .amo-single-process .icon::after' => 'background: {{VALUE}}',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );

        $this->end_controls_section();

        // Process Item tab section
        $this->start_controls_section(
            'process_item_style_section',
            [
                'label' => __( 'Item style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_iteam_tabs'
        );
            // Normal item Style Tab
            $this->start_controls_tab(
                'iteam_style_normal_tab',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );
            $this->add_responsive_control(
                'item_width',
                [
                    'label' => __( 'Item Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => '%',
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area' => 'width: {{SIZE}}%;',
                    ],
                    'condition' => array(
                        'process_style' => '5' 
                    )
                ]
            ); 
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'working_item_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-single-process',
                    'separator'=> 'before',
                    'condition'=>[
                        'process_style!' =>'4',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'working_item_4_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-single-process-area',
                    'separator'=> 'before',
                    'condition'=>[
                        'process_style' =>'4',
                    ]
                ]
            );

            $this->add_responsive_control(
                'working_item_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'working_item_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'working_item_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-process',
                ]
            );

            $this->add_responsive_control(
                'working_item_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process,{{WRAPPER}} .amokit-process-style-4 .amo-single-process-area:before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'item_seperator_style',
                [
                    'label' => __( 'Items Seperator Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition'=>[
                        'process_style' =>array( '2','5'),
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'number_shape_background',
                    'label' => __( 'Item Number Shape', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-number::before,{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:after',
                    'condition'=>[
                        'process_style' =>array( '2','5'),
                    ]
                ]
            );
            $this->add_responsive_control(
                'seperator_height',
                [
                    'label' => __( 'Seperator Height', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-number::before,{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:after' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'process_style' =>array( '2','5'),
                    ]
                ]
            );
            $this->add_responsive_control(
                'seperator_width',
                [
                    'label' => __( 'Seperator Width', 'amokit-addons' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .amo-number::before,{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:after' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'process_style' =>array( '2','5'),
                    ]
                ]
            ); 
            $this->add_responsive_control(
                'seperator_position',
                [
                    'label' => __( 'Position', 'amokit-addons' ),
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
                        ''
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-number::before,{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:after' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'process_style' =>array('5'),
                    ]
                ]
            ); 


            $this->end_controls_tab(); //end normal tab

            // Item Hover Style Tab
            $this->start_controls_tab(
                'iteam_style_hover_tab',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                    'condition'=>[
                        'process_style' =>array( '4','5'),
                    ]
                ]
            );
                $this->add_responsive_control(
                'item_width_hover',
                [
                    'label' => __( 'Item Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' =>'%',
                    'range' => [
                        
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:hover' => 'width: {{SIZE}}%;',
                    ],
                    'condition' => [
                        'process_style' => '5' 
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'working_item_background_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amokit-process-style-5  .amo-single-process2:before,{{WRAPPER}} .amokit-process-style-4 .amo-single-process-area:before',
                    'separator'=> 'before',
                    // 'condition'=>[
                    //     'process_style!' =>'5',
                    // ]
                ]
            );
            $this->add_control(
                'hover_all_content_color',
                [
                    'label' => __( 'All Content Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process-area:hover .amo-content h4, {{WRAPPER}} .amo-single-process-area:hover .amo-content p,{{WRAPPER}} .amo-single-process-area:hover .amo-number span,{{WRAPPER}} .amo-single-process-area:hover .amo-single-process .icon i,{{WRAPPER}} .amokit-process-style-4 .amo-single-process-area:hover .amo-single-process .amo-content h4' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amo-single-process-area:hover .amo-single-process .icon svg path' => 'fill: {{VALUE}}',
                    ],
                    'condition'=>[
                        'process_style' =>array( '5','4'),
                    ]
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();


        // Process Title tab section
        $this->start_controls_section(
            'process_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#555555',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content h4' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'title_color_hover',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .amo-content h4' => 'color: {{VALUE}}',
                    ],
                    'condition' => array(
                        'process_style' => '3' 
                    )
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-content h4',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'title_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-content h4',
                ]
            );

            $this->add_responsive_control(
                'title_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content h4' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Process Description tab section
        $this->start_controls_section(
            'process_content_style_section',
            [
                'label' => __( 'Description', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#494849',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-content p,{{WRAPPER}} .amokit-process-style-5 .amo-single-process-area:hover .amo-single-process .amo-content p',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-content p',
                ]
            );

            $this->add_responsive_control(
                'content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-content p' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Process Description tab section
        $this->start_controls_section(
            'process_number_style_section',
            [
                'label' => __( 'Number', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

           

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'number_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-number span',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'number_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-number span',
                ]
            );

            $this->add_control(
                'number_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5a5a5a',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'number_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-number span',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'number_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'number_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'number_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-number span',
                ]
            );

            $this->add_responsive_control(
                'number_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_control(
                'number_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'number_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-number span' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                
                    ],
                ]
            );
        $this->end_controls_section();

        // Process Icon Style tab section
        $this->start_controls_section(
            'process_icon_style_section',
            [
                'label' => __( 'Icon', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
            // Normal Style Tab
            $this->start_controls_tab(
                'icon_style_normal_tab',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );
            $this->add_control(
                'icon_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#555555',
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'icon_font_size',
                [
                    'label' => __( 'Font Size', 'amokit-addons' ),
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
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-single-process .icon,{{WRAPPER}} .amokit-process-style-4 .amo-single-process .icon img',
                ]
            );

            $this->add_responsive_control(
                'icon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-single-process .icon,{{WRAPPER}} .amokit-process-style-4 .amo-single-process .icon img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'icon_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-single-process .icon',
                ]
            );
            $this->add_control(
                'icon_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process .icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'process_style!' =>'3',
                    ]
                ]
            );

            $this->add_control(
                'icon_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-process .icon' => 'height: {{SIZE}}{{UNIT}};',
                
                    ],
                    'condition'=>[
                        'process_style!' =>'3',
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'icon_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amokit-process-area .amo-single-process .icon',
                ]
            );

            $this->end_controls_tab(); //end normal tab

            // Hover Style Tab
            $this->start_controls_tab(
                'icon_style_hover_tab',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                ]
            );
            $this->add_control(
                'icon_color_hover',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .icon' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .icon i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .icon svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'icon_background_hover',
                        'label' => __( 'Background', 'amokit-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .icon',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border_hover',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amokit-process-area .amo-single-process:hover .icon',
                    ]
                );
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $sectionid = "sid". $this-> get_id();
        if( '5'== $settings['process_style'] ){
            $this->add_render_attribute( 'amokit_process_attr', 'class', 'amokit-process-area  amokit-process-style-2  amokit-process-style-' . esc_attr( $settings['process_style'] ) );
        } else{
            $this->add_render_attribute( 'amokit_process_attr', 'class', 'amokit-process-area amokit-process-style-' . esc_attr( $settings['process_style'] ) );
        }

        if( isset( $settings['process_column'] ) ){
            $this->add_render_attribute( 'amokit_process_attr', 'class', 'amokit-column amokit-process-column-' . esc_attr( $settings['process_column'] ) );
        }

        $active_process_class = '';
        ?>
        <div <?php echo $this->get_render_attribute_string( 'amokit_process_attr' ); ?>>

            <?php 
                $i = 0; 
                foreach ( $settings['amokit_process_list'] as $item ) : 
                    $i++;
                    if( $settings['process_style'] == 4 && $i == 1 ){
                        $active_process_class = 'open';
                    }else {
                        $active_process_class = '';
                    }
            ?>
                <div class="amo-single-process-area">
                <?php 
                if( '5'== $settings['process_style'] ){ ?>

                    <div class="amo-single-process <?php echo esc_attr( $active_process_class ); if( $i%2 == 0 ){ echo esc_attr( 'process-reverse' ); }?>">
                        <?php
                            if( $item['process_icon_type'] == 'img' && !empty( $item['process_image']['url'] ) ) {
                                echo '<div class="icon">'.Group_Control_Image_Size::get_attachment_image_html( $item, 'process_imagesize', 'process_image' ).'</div>';
                            }else{
                                if( $item['process_icon_type'] == 'icon' && !empty( $item['process_icon']['value'] ) ){
                                    echo '<div class="icon">'.amo_Icon_manager::render_icon( $item['process_icon'], [ 'aria-hidden' => 'true' ] ).'</div>';
                                }
                            }
                        ?>
                        <?php 
                            if( !empty( $item['process_number'] ) ){
                                echo '<div class="amo-number"><span>'.esc_html( $item['process_number'] ).'</span></div>';
                            }
                        ?>
                        <div class="amo-content">
                            <?php
                                if( !empty( $item['process_title'] ) ){
                                    echo '<h4>'.amo_kses_title( $item['process_title'] ).'</h4>';
                                }
                            ?>
                        </div>
                    </div>  
                    <div class="amo-single-process amokit-single-process2 <?php echo esc_attr( $active_process_class ); if( $i%2 == 0 ){ echo esc_attr( 'process-reverse' ); } ?>">
                        <?php
                            if( $item['process_icon_type'] == 'img' && !empty( $item['process_image']['url'] ) ) {
                                echo '<div class="icon">'.Group_Control_Image_Size::get_attachment_image_html( $item, 'process_imagesize', 'process_image' ).'</div>';
                            }else{
                                if( $item['process_icon_type'] == 'icon' && !empty( $item['process_icon']['value'] ) ){
                                    echo '<div class="icon">'.amo_Icon_manager::render_icon( $item['process_icon'], [ 'aria-hidden' => 'true' ] ).'</div>';
                                }
                            }
                        ?>
                        <?php 
                            if( !empty( $item['process_number'] ) ){
                                echo '<div class="amo-number"><span>'.esc_html( $item['process_number'] ).'</span></div>';
                            }
                        ?>
                        <div class="amo-content">
                            <?php
                                if( !empty( $item['process_title'] ) ){
                                    echo '<h4>'.amo_kses_title( $item['process_title'] ).'</h4>';
                                }
                                if( !empty( $item['process_description'] ) ){
                                    echo '<p>'.amo_kses_desc( $item['process_description'] ).'</p>';
                                }
                            ?>
                        </div>
                    </div>                      
                    <?php }else{ ?>

                        <div class="amo-single-process <?php echo esc_attr( $active_process_class ); if( $i%2 == 0 ){ echo esc_attr( 'process-reverse' ); }?>">
                        <?php
                            if( $item['process_icon_type'] == 'img' && !empty( $item['process_image']['url'] ) ) {
                                echo '<div class="icon">'.Group_Control_Image_Size::get_attachment_image_html( $item, 'process_imagesize', 'process_image' ).'</div>';
                            }else{
                                if( $item['process_icon_type'] == 'icon' && !empty( $item['process_icon']['value'] ) ){
                                    echo '<div class="icon">'.amo_Icon_manager::render_icon( $item['process_icon'], [ 'aria-hidden' => 'true' ] ).'</div>';
                                }
                            }
                        ?>
                        <?php 
                            if( !empty( $item['process_number'] ) ){
                                echo '<div class="amo-number"><span>'.esc_html( $item['process_number'] ).'</span></div>';
                            }
                        ?>
                        <div class="amo-content">
                            <?php
                                if( !empty( $item['process_title'] ) ){
                                    echo '<h4>'.amo_kses_title( $item['process_title'] ).'</h4>';
                                }
                                if( !empty( $item['process_description'] ) ){
                                    echo '<p>'.amo_kses_desc( $item['process_description'] ).'</p>';
                                }
                            ?>
                        </div>
                    </div>  
                    <?php } ?>

                </div>
            <?php endforeach;?>

        </div>

        <?php
    }

}


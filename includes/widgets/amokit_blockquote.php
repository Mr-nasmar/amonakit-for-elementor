<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Blockquote extends Widget_Base {

    public function get_name() {
        return 'amokit-blockquote-addons';
    }
    
    public function get_title() {
        return __( 'Blockquote', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-blockquote';
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
        return ['blockquote', 'quote', 'quote content', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/blockquote-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'blockquote_content',
            [
                'label' => __( 'Blockquote', 'amokit-addons' ),
            ]
        );
        
            $this->add_control(
                'content_source',
                [
                    'label'   => __( 'Select Content Source', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'    => __( 'Custom', 'amokit-addons' ),
                        "elementor" => __( 'Elementor Template', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'template_id',
                [
                    'label'       => __( 'Content', 'amokit-addons' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => '0',
                    'options'     => amokit_elementor_template(),
                    'condition'   => [
                        'content_source' => "elementor"
                    ],
                ]
            );

            $this->add_control(
                'custom_content',
                [
                    'label' => __( 'Content', 'amokit-addons' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'title' => __( 'Blockquote Content', 'amokit-addons' ),
                    'condition' => [
                        'content_source' =>'custom',
                    ],
                ]
            );

            $this->add_control(
                'blockquote_by',
                [
                    'label' => __( 'Blockquote By', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Jon Doy', 'amokit-addons' ),
                    'placeholder' => __( 'Jon Doy', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'blockquote_type',
                [
                    'label' => __('Blockquote Type','amokit-addons'),
                    'type' =>Controls_Manager::CHOOSE,
                    'options' =>[
                        'img' =>[
                            'title' =>__('Image','amokit-addons'),
                            'icon' =>'eicon-image',
                        ],
                        'icon' =>[
                            'title' =>__('Icon','amokit-addons'),
                            'icon' =>'eicon-info-circle',
                        ]
                    ],
                    'default' =>'img',
                ]
            );

            $this->add_control(
                'blockquote_image',
                [
                    'label' => __('Image','amokit-addons'),
                    'type'=>Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'blockquote_type' => 'img',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'blockquote_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'blockquote_type' => 'img',
                    ]
                ]
            );

            $this->add_control(
                'blockquote_icon',
                [
                    'label' =>__('Icon','amokit-addons'),
                    'type'=>Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-pencil',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'blockquote_type' => 'icon',
                    ]
                ]
            );

            $this->add_control(
                'blockquote_position',
                [
                    'label' => __( 'Blockquote Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'righttop',
                    'options' => [
                        'lefttop'      => __( 'Left Top', 'amokit-addons' ),
                        'leftcenter'   => __( 'Left Center', 'amokit-addons' ),
                        'leftbottom'   => __( 'Left Bottom', 'amokit-addons' ),
                        'centertop'    => __( 'Center Top', 'amokit-addons' ),
                        'center'       => __( 'Center Center', 'amokit-addons' ),
                        'centerbottom' => __( 'Center Bottom', 'amokit-addons' ),
                        'righttop'     => __( 'Right Top', 'amokit-addons' ),
                        'rightcenter'  => __( 'Right Center', 'amokit-addons' ),
                        'rightbottom'  => __( 'Right Bottom', 'amokit-addons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_blockquote_style_section',
            [
                'label' => __( 'Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'amokit_blockquote_align',
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
                        '{{WRAPPER}} .amo-blockquote blockquote' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'amokit_blockquote_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquote_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquote_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_blockquote_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquote_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'amokit_blockquote_content_style_section',
            [
                'label' => __( 'Content', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'amokit_blockquote_content_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5b5b5b',
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_content' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_content p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_blockquote_content_typography',
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote .blockquote_content,{{WRAPPER}} .amo-blockquote blockquote .blockquote_content p',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquote_content_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquote_content_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'amokit_blockquoteby_style_section',
            [
                'label' => __( 'Quote By', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'amokit_blockquoteby_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#0056ff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'amokit_blockquotenby_typography',
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote cite',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquoteby_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquoteby_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'amokit_blockquoteby_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote cite',
                ]
            );

            $this->add_responsive_control(
                'amokit_blockquoteby_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteby_before_position',
                [
                    'label' => __( 'Separator Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'before' => __( 'Before', 'amokit-addons' ),
                        'after'  => __( 'After', 'amokit-addons' ),
                        'none'   => __( 'None', 'amokit-addons' ),
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'blockquoteby_before_color',
                [
                    'label' => __( 'Separator Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#0056ff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite::before' => 'background-color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ]
                ]
            );

            $this->add_control(
                'blockquoteby_before_width',
                [
                    'label' => __( 'Separator Width', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-blockquote blockquote cite::before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ]
                ]
            );

            $this->add_control(
                'blockquoteby_before_height',
                [
                    'label' => __( 'Separator Height', 'amokit-addons' ),
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
                        'size' => 2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote cite::before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ]
                ]
            );

        $this->end_controls_section();


        // blockquote icon style start
        $this->start_controls_section(
            'amokit_blockquoteicon_style_section',
            [
                'label' => __( 'Quote Icon', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'blockquote_type' =>'icon',
                    'blockquote_icon!' =>'',
                ],
            ]
        );

            $this->add_control(
                'blockquoteicon_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'blockquoteicon_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'blockquoteicon_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteicon_fontsize',
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
                        'size' => 18,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'blockquoteicon_line_height',
                [
                    'label' => __( 'Line Height', 'amokit-addons' ),
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
                        'size' => 45,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteicon_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
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
                        'size' => 45,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'blockquoteicon_height',
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
                        'size' => 45,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote .blockquote_icon' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        

        // blockquote image style start
        $this->start_controls_section(
            'amokit_blockquoteimage_style_section',
            [
                'label' => __( 'Quote Image', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blockquote_type' => 'img',
                ],
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'blockquoteimage_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote img',
                ]
            );

            $this->add_responsive_control(
                'blockquoteimage_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquoteimage_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'blockquoteimage_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-blockquote blockquote img',
                ]
            );

            $this->add_responsive_control(
                'blockquoteimage_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-blockquote blockquote img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteimage_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-blockquote blockquote img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'amokit_blockquote_attr', 'class', 'amokit-blockquote' );
        $this->add_render_attribute( 'amokit_blockquote_attr', 'class', 'amokit-blockquote-position-'. esc_attr( $settings['blockquote_position'] ) );
        $this->add_render_attribute( 'amokit_blockquote_attr', 'class', 'amokit-citeseparator-position-'. esc_attr( $settings['blockquoteby_before_position'] ) );
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_blockquote_attr' ); ?>>
                <blockquote>
                    <?php 
                        if ( $settings['content_source'] == 'custom' && !empty( $settings['custom_content'] ) ) {
                            echo '<div class="blockquote_content">'.wp_kses_post( $settings['custom_content'] ).'</div>';
                        } elseif ( $settings['content_source'] == "elementor" && !empty( $settings['template_id'] )) {
                            $template_id = absint( $settings['template_id'] );
                            echo Plugin::instance()->frontend->get_builder_content_for_display( $template_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }
                        if( !empty( $settings['blockquote_by'] ) ){
                            echo '<cite class="quote-by"> '.esc_html( $settings['blockquote_by']).' </cite>';
                        }
                        if( !empty( $settings['blockquote_image'] ) && $settings['blockquote_type'] == 'img' ){
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'blockquote_imagesize', 'blockquote_image' );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }else{
                            echo sprintf('<span class="blockquote_icon">%1$s</span>', AmoKit_Icon_manager::render_icon( $settings['blockquote_icon'], [ 'aria-hidden' => 'true' ] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }
                    ?>
                </blockquote>
           </div>

        <?php
    }
}
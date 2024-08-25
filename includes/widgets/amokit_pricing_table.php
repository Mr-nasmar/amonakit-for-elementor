<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Pricing_Table extends Widget_Base
{

    public function get_name()
    {
        return 'amokit-pricing-table-addons';
    }

    public function get_title()
    {
        return __('Pricing Table', 'amokit-addons');
    }

    public function get_icon()
    {
        return 'amokit-icon eicon-price-table';
    }

    public function get_categories()
    {
        return ['amokit-addons'];
    }

    public function get_keywords() {
        return ['price table','table', 'pricing table', 'amokit', 'Amona Kit'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/pricing-list-view-widget/';
    }

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }

    protected function register_controls()
    {

        // Layout Fields tab start
        $this->start_controls_section(
            'amokit_pricing_layout',
            [
                'label' => __('Layout', 'amokit-addons'),
            ]
        );
        $this->add_control(
            'amokit_pricing_style',
            [
                'label' => __('Style', 'amokit-addons'),
                'type' => 'amokit-preset-select',
                'default' => '1',
                'options' => [
                    '1'   => __('Style One', 'amokit-addons'),
                    '2'   => __('Style Two', 'amokit-addons'),
                    '3'   => __('Style Three', 'amokit-addons'),
                    '4'   => __('Style Four', 'amokit-addons'),
                    '5'   => __('Style Five', 'amokit-addons'),
                    '6'   => __('Style Six', 'amokit-addons'),
                    '7'   => __('Style Seven', 'amokit-addons'),
                    '8'   => __('Style Eight', 'amokit-addons'),
                    '9'   => __('Style Nine', 'amokit-addons'),
                ],
            ]
        );

        $this->add_control(
            'amokit_show_badge',
            [
                'label' => __('Show Badge', 'amokit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'amokit-addons'),
                'label_off' => __('Hide', 'amokit-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'amokit_badge_position',
            [
                'label' => __('Position', 'amokit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'amokit-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'amokit-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'condition' => [
                    'amokit_show_badge' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'amokit_badge_position_left',
            [
                'label' => __('Left', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
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
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge-position-left' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_badge_position' => 'left',
                    'amokit_show_badge' => 'yes'
                ],

            ]
        );

        $this->add_responsive_control(
            'amokit_badge_position_right',
            [
                'label' => __('Right', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
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
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge-position-right' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_badge_position' => 'right',
                    'amokit_show_badge' => 'yes'
                ],

            ]
        );

        $this->add_responsive_control(
            'amokit_badge_position_top',
            [
                'label' => __('Top', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
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
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_show_badge' => 'yes'
                ],

            ]
        );

        $this->add_control(
            'pricing_badge_title',
            [
                'label' => __('Badge Text', 'amokit-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('New', 'amokit-addons'),
                'default' => __('New', 'amokit-addons'),
                'title' => __('Enter your service title', 'amokit-addons'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'amokit_show_badge' => 'yes'
                ]
            ]
        );        

        $this->end_controls_section(); // Layout Fields tab end

        // Header Fields tab start
        $this->start_controls_section(
            'amokit_pricing_header',
            [
                'label' => __('Header', 'amokit-addons'),
            ]
        );

        $this->add_control(
            'amokit_pricing_header_top',
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
                'condition' => [
                    'amokit_pricing_style' => '9',
                ]
            ]
        );

        $this->add_control(
            'titleimage',
            [
                'label' => __('Image','amokit-addons'),
                'type'=>Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'amokit_pricing_header_top' => 'img',
                    'amokit_pricing_style' => '9',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'iconimagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'amokit_pricing_header_top' => 'img',
                    'amokit_pricing_style' => '9',
                ]
            ]
        );

        $this->add_control(
            'titleicon',
            [
                'label' =>__('Icon','amokit-addons'),
                'type'=>Controls_Manager::ICONS,
                'default' => [
                    'value'=>'fas fa-pencil-alt',
                    'library'=>'solid',
                ],
                'condition' => [
                    'amokit_pricing_header_top' => 'icon',
                    'amokit_pricing_style' => '9',
                ]
            ]
        );

        $this->add_control(
            'pricing_title',
            [
                'label' => __('Title', 'amokit-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Standard', 'amokit-addons'),
                'default' => __('Standard', 'amokit-addons'),
                'title' => __('Enter your pricing title', 'amokit-addons'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'pricing_plan_title',
            [
                'label' => __('Price Plan Name', 'amokit-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('SIMPLE PLAN', 'amokit-addons'),
                'title' => __('Enter your pricing plan name here', 'amokit-addons'),
                'condition' => [
                    'amokit_pricing_style!' => array('1','7','9'),
                ],
            ]
        );

        $this->add_control(
            'amokit_ribon_pricing_table',
            [
                'label'        => esc_html__('Ribon', 'amokit-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_table_ribon_background',
                'label' => __('Ribon Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-panel',
                'condition' => [
                    'amokit_ribon_pricing_table' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pricing_table_ribon_image',
            [
                'label' => __('Ribon image', 'amokit-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => AMONAKIT_ADDONS_PL_URL . '/assets/images/pricing/pricing-ribon.png',
                ],
                'condition' => [
                    'amokit_ribon_pricing_table' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-ribon::before' => 'content: url( {{URL}} )',
                ]
            ]
        );


        $this->add_control(
            'amokit_header_icon_type',
            [
                'label' => __('Image or Icon', 'amokit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'img' => [
                        'title' => __('Image', 'amokit-addons'),
                        'icon' => 'eicon-image-bold',
                    ],
                    'icon' => [
                        'title' => __('Icon', 'amokit-addons'),
                        'icon' => 'eicon-info-circle',
                    ]
                ],
                'default' => 'img',
                'condition' => [
                    'amokit_pricing_style' => '2'
                ]
            ]
        );

        $this->add_control(
            'headerimage',
            [
                'label' => __('Image', 'amokit-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

                'condition' => [
                    'amokit_pricing_style' => '2',
                    'amokit_header_icon_type' => 'img',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'headerimagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'amokit_pricing_style' => '2',
                    'amokit_header_icon_type' => 'img',
                ]
            ]
        );

        $this->add_control(
            'headericon',
            [
                'label' => esc_html__('Icon', 'amokit-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-pencil',
                    'library' => 'solid',
                ],
                'condition' => [
                    'amokit_pricing_style' => '2',
                    'amokit_header_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_responsive_control(
            'amokit_header_alignment_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .amo-pricing-header-align' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_pricing_style!' => '1',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'amokit_header_alignment',
            [
                'label' => __('Alignment', 'amokit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'amokit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'amokit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'amokit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .amo-pricing-header-align' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'amokit_pricing_style!' => '1',
                ],
            ]
        );

        $this->end_controls_section(); // Header Fields tab end

        // Pricing Fields tab start
        $this->start_controls_section(
            'amokit_pricing_price',
            [
                'label' => __('Pricing', 'amokit-addons'),
            ]
        );
        $this->add_control(
            'amokit_currency_symbol',
            [
                'label'   => __('Currency Symbol', 'amokit-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''             => esc_html__('None', 'amokit-addons'),
                    'dollar'       => '&#36; ' . __('Dollar', 'amokit-addons'),
                    'euro'         => '&#128; ' . __('Euro', 'amokit-addons'),
                    'baht'         => '&#3647; ' . __('Baht', 'amokit-addons'),
                    'franc'        => '&#8355; ' . __('Franc', 'amokit-addons'),
                    'guilder'      => '&fnof; ' . __('Guilder', 'amokit-addons'),
                    'krona'        => 'kr ' . __('Krona', 'amokit-addons'),
                    'lira'         => '&#8356; ' . __('Lira', 'amokit-addons'),
                    'peseta'       => '&#8359 ' . __('Peseta', 'amokit-addons'),
                    'peso'         => '&#8369; ' . __('Peso', 'amokit-addons'),
                    'pound'        => '&#163; ' . __('Pound Sterling', 'amokit-addons'),
                    'real'         => 'R$ ' . __('Real', 'amokit-addons'),
                    'ruble'        => '&#8381; ' . __('Ruble', 'amokit-addons'),
                    'rupee'        => '&#8360; ' . __('Rupee', 'amokit-addons'),
                    'indian_rupee' => '&#8377; ' . __('Rupee (Indian)', 'amokit-addons'),
                    'shekel'       => '&#8362; ' . __('Shekel', 'amokit-addons'),
                    'yen'          => '&#165; ' . __('Yen/Yuan', 'amokit-addons'),
                    'won'          => '&#8361; ' . __('Won', 'amokit-addons'),
                    'custom'       => __('Custom', 'amokit-addons'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'amokit_currency_symbol_custom',
            [
                'label'     => __('Custom Symbol', 'amokit-addons'),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'amokit_currency_symbol' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'amokit_price',
            [
                'label'   => esc_html__('Price', 'amokit-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => '35.50',
            ]
        );

        $this->add_control(
            'amokit_offer_price',
            [
                'label'        => esc_html__('Offer', 'amokit-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'amokit_original_price',
            [
                'label'     => esc_html__('Original Price', 'amokit-addons'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '49',
                'condition' => [
                    'amokit_offer_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'amokit_period',
            [
                'label'   => esc_html__('Period', 'amokit-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Monthly', 'amokit-addons'),
            ]
        );

        $this->add_responsive_control(
            'amokit_price_alignment_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'amokit_pricing_alignment',
            [
                'label' => __('Alignment', 'amokit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'amokit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'amokit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'amokit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-style-1 .amo-pricing-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // Pricing Fields tab end

        // Features tab start
        $this->start_controls_section(
            'amokit_pricing_features',
            [
                'label' => __('Features', 'amokit-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'amokit_features_title',
            [
                'label'   => esc_html__('Title', 'amokit-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Features Tilte', 'amokit-addons'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'amokit_old_features',
            [
                'label'        => esc_html__('Old Features', 'amokit-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'amokit_features_icon',
            [
                'label'   => esc_html__('Icon', 'amokit-addons'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-double-right',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'amokit_features_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'amokit_features_icon[value]!' => '',
                ]
            ]
        );

        $repeater->add_responsive_control(
            'amokit_badge_position_right',
            [
                'label' => __('Icon Size', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 17,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_features_icon[value]!' => '',
                ]

            ]
        );

        $repeater->add_responsive_control(
            'amokit_badge_position_margin',
            [
                'label' => __('Icon Position', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} i , {{WRAPPER}} .amo-pricing-panel {{CURRENT_ITEM}} svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_features_icon[value]!' => '',
                ]

            ]
        );

        $this->add_control(
            'amokit_features_list',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  =>  $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'amokit_features_title' => esc_html__('Features Title One', 'amokit-addons'),
                        'amokit_features_icon' => 'fas fa-angle-double-right',
                    ],

                    [
                        'amokit_features_title' => esc_html__('Features Title Two', 'amokit-addons'),
                        'amokit_features_icon' => 'fas fa-angle-double-right',
                    ],

                    [
                        'amokit_features_title' => esc_html__('Features Title Three', 'amokit-addons'),
                        'amokit_features_icon' => 'fas fa-angle-double-right',
                    ],
                ],
                'title_field' => '{{{ amokit_features_title }}}',
            ]
        );

        $this->add_responsive_control(
            'pricing_features_list_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-body ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'amokit_pricing_feature_alignment',
            [
                'label' => __('Alignment', 'amokit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'amokit-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'amokit-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'amokit-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'amokit-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-body ul' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section(); // Features Fields tab end

        // Footer tab start
        $this->start_controls_section(
            'amokit_pricing_footer',
            [
                'label' => __('Footer', 'amokit-addons'),
            ]
        );

        $this->add_control(
            'amokit_button_text',
            [
                'label'   => esc_html__('Button Text', 'amokit-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Sign Up', 'amokit-addons'),
            ]
        );

        $this->add_control(
            'amokit_button_link',
            [
                'label'       => __('Link', 'amokit-addons'),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section(); // Footer Fields tab end

        // Style tab section start
        $this->start_controls_section(
            'amokit_pricing_style_section',
            [
                'label' => __('Style', 'amokit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'amokit_heighlight_pricing_table',
            [
                'label'        => esc_html__('High Light Pricing Table', 'amokit-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_table_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-panel',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_table_box_shadow',
                'label' => __('Box Shadow', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-panel',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_table_border',
                'label' => __('Border', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-panel',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_margin',
            [
                'label' => __('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section(); // Style tab section end 

        // Header Top style tab start
        $this->start_controls_section(
            'amokit_header_top_style',
            [
                'label'     => __('Header Top', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_pricing_style' => '9'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'amokit_header_top_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .header-top-image',
                'exclude' =>['image']
            ]
        );
        
        $this->add_control(
            'amokit_header_top_icon_color',
            [
                'label'     => __('Icon Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-top-image i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .header-top-image svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'amokit_pricing_header_top' =>'icon'
                ]
            ]
        );
        $this->add_responsive_control(
            'amokit_header_top_icon_fontsize',
            [
                'label' => __( 'Icon Size', 'amokit-addons' ),
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
                    '{{WRAPPER}} .header-top-image i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .header-top-image svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_pricing_header_top' =>'icon'
                ]
            ]
        );
        $this->add_responsive_control(
            'amokit_header_top_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .header-top-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'amokit_header_topborder',
                'label' => __( 'Border', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .header-top-image',
            ]
        );
        $this->add_responsive_control(
            'amokit_header_top_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .header-top-image' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->end_controls_section(); // Header Top Style section end 

        // Header style tab start
        $this->start_controls_section(
            'amokit_header_style',
            [
                'label'     => __('Header', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_header_border_style_toggle',
            [
                'label' => __('Price Border', 'amokit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'amokit-addons'),
                'label_on' => __('Custom', 'amokit-addons'),
                'return_value' => 'yes',
                'condition' => [
                    'amokit_pricing_style' => '4',
                ],
            ]
        );

        $this->start_popover();

            $this->add_control(
                'pricing_header_border_background',
                [
                    'label'     => __('Border Color', 'amokit-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .title h2::before' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_header_border_width',
                [
                    'label' => __('Border Width', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
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
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .title h2::before' => 'width: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'pricing_header_border_height',
                [
                    'label' => __('Border Height', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
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
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .title h2::before' => 'height: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'pricing_header_border_position',
                [
                    'label' => __('Border Position Y', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .title h2::before' => 'top: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

        $this->end_popover();        

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_header_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-heading',
            ]
        );

        $this->add_responsive_control(
            'pricing_header_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_header_margin',
            [
                'label' => __('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pricing_price_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section(); // Header style tab end

        // Header Title style tab start
        $this->start_controls_section(
            'amokit_header_title_style',
            [
                'label'     => __('Header Title', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'pricing_header_heading_title',
            [
                'label'     => __('Title', 'amokit-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_header_title_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_header_title_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-heading .title h2',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_header_title_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-heading .title h2',
                'condition' => [
                    'amokit_pricing_style' => '1',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_title_margin',
            [
                'label' => esc_html__('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .title h2 , {{WRAPPER}} .amo-pricing-style-3 .amo-pricing-heading .title' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_title_padding',
            [
                'label' => esc_html__('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .title h2' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_title_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .title h2' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section(); // Header Price style tab end 

        // Header Price Style tab start
        $this->start_controls_section(
            'amokit_header_price_plan_style',
            [
                'label'     => __('Price Plan', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_plan_title!' => '',
                    'amokit_pricing_style!' => array('1','7','9'),
                ]
            ]
        );

        $this->add_control(
            'pricing_plan_title_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pricing_plan_title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_plan_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_header_plan_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1',
                'condition' => [
                    'amokit_pricing_style' => array('1'),
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_plan_padding',
            [
                'label' => esc_html__('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_plan_margin',
            [
                'label' => esc_html__('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_plan_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .pricing-plan h1' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section(); // Header Price style tab end

        // Header Price Style tab start
        $this->start_controls_section(
            'amokit_header_price_style',
            [
                'label'     => __('Header Price', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_price!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_header_price_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_header_price_border',
                'label' => __('Border', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label',
            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_width',
            [
                'label' => __('Price Label Width', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 70,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_pricing_style' => ['3','8'],
                ],

            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_position',
            [
                'label' => __('Price Label Position ( Left-Right )', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => -30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_pricing_style' => ['8'],
                ],

            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_padding',
            [
                'label' => esc_html__('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_margin',
            [
                'label' => esc_html__('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-heading .price , {{WRAPPER}} .amo-pricing-panel .price-label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_control(
            'pricing_header_heading_price_symbol',
            [
                'label'     => __('Price Symbol', 'amokit-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'amokit_currency_symbol!' => ''
                ]
            ]
        );

        $this->add_control(
            'pricing_header_price_symbol_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 sub , {{WRAPPER}} .amo-pricing-panel .price-label h4 sub' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_header_price_symbol_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 sub , {{WRAPPER}} .amo-pricing-panel .price-label h4 sub',
            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_symbol_position_x',
            [
                'label' => __('Position ( Left-Right )', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 sub , {{WRAPPER}} .amo-pricing-panel .price-label h4 sub' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_pricing_style!' => ['5'],
                ],

            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_symbol_position_y',
            [
                'label' => __('Position ( Top-Bottom )', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 sub , {{WRAPPER}} .amo-pricing-panel .price-label h4 sub' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_pricing_style!' => ['5'],
                ],

            ]
        );

        $this->add_control(
            'pricing_header_heading_price',
            [
                'label'     => __('Price', 'amokit-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_header_price_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.pricing_new , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.pricing_new , {{WRAPPER}} .amo-pricing-panel .price-label h4' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_header_price_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.pricing_new , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.pricing_new',
            ]
        );

        $this->add_control(
            'pricing_header_heading_price_offer',
            [
                'label'     => __('Offer Price', 'amokit-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'amokit_offer_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_header_price_color_offer',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.pricing_old' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'amokit_offer_price' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_header_price_typography_offer',
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.pricing_old',
                'condition' => [
                    'amokit_offer_price' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'pricing_header_price_offer_space',
            [
                'label' => __( 'Inner Space', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px',],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .pricing_old' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_offer_price' => 'yes',
                ],
            ]
        );  
        $this->add_control(
            'pricing_header_heading_prce_period',
            [
                'label'     => __('Price Period', 'amokit-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'amokit_period!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_header_price_separator_toggle',
            [
                'label' => __('Price Separator Settings', 'amokit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'amokit-addons'),
                'label_on' => __('Custom', 'amokit-addons'),
                'return_value' => 'yes',
                'condition' => [
                    'amokit_period!' => '',
                ],
            ]
        );

        $this->start_popover();

        $this->add_control(
            'pricing_header_price_separator_period_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.separator , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.separator' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_period_separator_font_size',
            [
                'label' => __('Separator Size', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.separator , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.separator' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'pricing_header_price_period_separator_position',
            [
                'label' => __('Price Separator Position', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.separator , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.separator' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'pricing_header_price_period_position',
            [
                'label' => __('Separator Position Right', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.period-txt , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.period-txt' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'amokit_period!' => '',
                ]
            ]
        );
        $this->end_popover();

        $this->add_control(
            'pricing_header_price_period_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.period-txt , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.period-txt' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'amokit_period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_header_price_period_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-heading .price h4 span.period-txt , {{WRAPPER}} .amo-pricing-panel .price-label h4 span.period-txt',
                'condition' => [
                    'amokit_period!' => '',
                ]
            ]
        );

        $this->end_controls_section(); // Header Price style tab end


        // Features style tab start
        $this->start_controls_section(
            'amokit_features_style',
            [
                'label'     => __('Features', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_bottom_border_style_toggle',
            [
                'label' => __('Price Border', 'amokit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'amokit-addons'),
                'label_on' => __('Custom', 'amokit-addons'),
                'return_value' => 'yes',
                'condition' => [
                    'amokit_pricing_style' => '4',
                ],
            ]
        );

        $this->start_popover();

            $this->add_control(
                'pricing_bottom_border_background',
                [
                    'label'     => __('Border Color', 'amokit-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-body::before' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_bottom_border_width',
                [
                    'label' => __('Border Width', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
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
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-body::before' => 'width: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'pricing_bottom_border_height',
                [
                    'label' => __('Border Height', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
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
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-body::before' => 'height: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'pricing_bottom_border_position',
                [
                    'label' => __('Border Position Y', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-panel .amo-pricing-body::before' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],

                ]
            );

        $this->end_popover();        

        $this->add_control(
            'pricing_features_area_toggle',
            [
                'label' => __('Price Features Box Area', 'amokit-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'amokit-addons'),
                'label_on' => __('Custom', 'amokit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'pricing_features_area_background',
                    'label' => __('Background', 'amokit-addons'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .amo-pricing-body',
                ]
            );

            $this->add_responsive_control(
                'pricing_features_area_padding',
                [
                    'label' => __('Padding', 'amokit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'pricing_features_area_margin',
                [
                    'label' => __('Margin', 'amokit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
    
            $this->add_responsive_control(
                'pricing_features_area_border_radius',
                [
                    'label' => __('Border Radius', 'amokit-addons'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

        $this->end_popover();

        $this->add_control(
            'pricing_features_item_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-body ul li' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_features_item_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-body ul li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_features_item_border',
                'label' => __('Border', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-body ul li',
            ]
        );

        $this->add_responsive_control(
            'pricing_features_item_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-body ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_features_item_margin',
            [
                'label' => __('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-body ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section(); // Features style tab end


        // Badge style tab start
        $this->start_controls_section(
            'amokit_badge_style',
            [
                'label'     => __('Badge', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'amokit_badge_style_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'amokit_badge_style_typography',
                'selector' => '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'amokit_badge_style_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge',
            ]
        );

        $this->add_responsive_control(
            'amokit_badge_style_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'amokit_badge_style_border_radius',
            [
                'label' => __('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-amokit-pricing-table-addons span.amo-price-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section(); // Badge style tab end

        // Footer style tab start
        $this->start_controls_section(
            'amokit_pricing_footer_style',
            [
                'label'     => __('Footer', 'amokit-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pricing_footer_style_tabs');

        // Pricing Normal tab start
        $this->start_controls_tab(
            'style_pricing_normal_tab',
            [
                'label' => __('Normal', 'amokit-addons'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'style_pricing_normal_box_shadow',
                'label' => __( 'Box Shadow', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_footer_typography',
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn',
            ]
        );

        $this->add_control(
            'pricing_footer_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-body a.price_btn , {{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-style-4 .amo-pricing-footer a.price_btn' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_footer_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-body a.price_btn,{{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn span,{{WRAPPER}} .amo-pricing-style-4 .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_footer_border',
                'label' => __('Border', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn',
            ]
        );

        $this->add_responsive_control(
            'pricing_footer_padding',
            [
                'label' => __('Padding', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn span , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_footer_margin',
            [
                'label' => __('Margin', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn span ,{{WRAPPER}} .amo-pricing-panel .amo-pricing-footer , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_footer_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-panel .amo-pricing-footer a.price_btn , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn span , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Pricing Normal tab end

        // Pricing Hover tab start
        $this->start_controls_tab(
            'style_pricing_hover_tab',
            [
                'label' => __('Hover', 'amokit-addons'),
            ]
        );

        $this->add_control(
            'pricing_footer_hover_color',
            [
                'label'     => __('Color', 'amokit-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-footer a.price_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_footer_hover_background',
                'label' => __('Background', 'amokit-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .amo-pricing-footer a.price_btn:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_footer_hover_border',
                'label' => __('Border', 'amokit-addons'),
                'selector' => '{{WRAPPER}} .amo-pricing-footer a.price_btn:hover , {{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn:hover',
            ]
        );

        $this->add_responsive_control(
            'pricing_footer_hover_radius',
            [
                'label' => esc_html__('Border Radius', 'amokit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-footer a.price_btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    '{{WRAPPER}} .amo-pricing-style-5 .amo-pricing-body a.price_btn span:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Pricing Hover tab end

        $this->end_controls_tabs();

        $this->end_controls_section(); // Footer style tab end

    }

    private function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'dollar'       => '&#36;',
            'baht'         => '&#3647;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'krona'        => 'kr',
            'lira'         => '&#8356;',
            'peseta'       => '&#8359',
            'peso'         => '&#8369;',
            'pound'        => '&#163;',
            'real'         => 'R$',
            'ruble'        => '&#8381;',
            'rupee'        => '&#8360;',
            'shekel'       => '&#8362;',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];
        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render($instance = [])
    {

        $settings   = $this->get_settings_for_display();

        if (!empty($settings['amokit_button_link']['url'])) {

            $this->add_render_attribute('url', 'class', 'price_btn');
            $this->add_link_attributes('url', $settings['amokit_button_link']);
        }

        // Currency symbol
        $currencysymbol = '';
        if (!empty($settings['amokit_currency_symbol'])) {
            if ($settings['amokit_currency_symbol'] != 'custom') {
                $currencysymbol = '<sub>' . $this->get_currency_symbol($settings['amokit_currency_symbol']) . '</sub>';
            } else {
                $currencysymbol = '<sub>' . $settings['amokit_currency_symbol_custom'] . '</sub>';
            }
        }


        $this->add_render_attribute('pricing_area_attr', 'class', 'amokit-pricing-panel');
        $this->add_render_attribute('pricing_badge_attr', 'class', ['amokit-price-badge', 'amokit-price-badge-position-' . $settings['amokit_badge_position']]);
        $this->add_render_attribute('pricing_area_attr', 'class', 'amokit-pricing-style-' . $settings['amokit_pricing_style']);

        if ($settings['amokit_heighlight_pricing_table'] == 'yes') {
            $this->add_render_attribute('pricing_area_attr', 'class', 'amokit-pricing-heighlight');
        }

        if ($settings['amokit_ribon_pricing_table'] == 'yes') {
            $this->add_render_attribute('pricing_area_attr', 'class', 'amokit-pricing-ribon');
        }

?>
        <div <?php echo $this->get_render_attribute_string('pricing_area_attr'); ?>>

            <?php if ('yes' == $settings['amokit_show_badge']) : ?>
                <span <?php $this->print_render_attribute_string('pricing_badge_attr'); ?>><?php echo esc_html($settings['pricing_badge_title']); ?></span>
            <?php endif; ?>

            <?php if ($settings['amokit_pricing_style'] == 2) : ?>
                <div class="amo-pricing-heading">
                    <div class="icon">
                        <?php
                        if ($settings['amokit_header_icon_type'] == 'img') {
                            echo Group_Control_Image_Size::get_attachment_image_html($settings, 'headerimagesize', 'headerimage');
                        } else {
                            echo AmoKit_Icon_manager::render_icon($settings['headericon'], ['aria-hidden' => 'true']);
                        }
                        ?>
                    </div>
                    <?php
                        if (!empty($settings['pricing_title'])) {
                            echo '<div class="title"><h2>' . amokit_kses_title( $settings['pricing_title'] ) . '</h2></div>';
                        }
                        if (!empty($settings['pricing_plan_title'])) {
                            echo '<div class="pricing-plan"><h1>' . amokit_kses_title( $settings['pricing_plan_title'] ) . '</h1></div>';
                        }
                    ?>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title($settings['amokit_original_price']) . '</del></span><span class="pricing_new">' . $currencysymbol . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol . $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>

            <?php elseif ($settings['amokit_pricing_style'] == 3) : ?>
                <div class="amo-pricing-heading">
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title( $settings['amokit_original_price'] ) . '</del></span><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                    <div class="amo-pricing-header-align">
                        <?php
                            if (!empty($settings['pricing_title'])) {
                                echo '<div class="title"><h2>' . amokit_kses_title( $settings['pricing_title'] ) . '</h2></div>';
                            }
                            if (!empty($settings['pricing_plan_title'])) {
                                echo '<div class="pricing-plan"><h1>' . amokit_kses_title( $settings['pricing_plan_title'] ) . '</h1></div>';
                            }
                        ?>
                    </div>

                </div>

                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo amokit_kses_title( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>

            <?php elseif ($settings['amokit_pricing_style'] == 4) : ?>
                <div class="amo-pricing-heading">
                    <?php
                        if (!empty($settings['pricing_title'])) {
                            echo '<div class="title"><h2>' . amokit_kses_title( $settings['pricing_title'] ) . '</h2></div>';
                        }
                        if (!empty($settings['pricing_plan_title'])) {
                            echo '<div class="pricing-plan"><h1>' . amokit_kses_title( $settings['pricing_plan_title'] ) . '</h1></div>';
                        }
                    ?>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title( $settings['amokit_original_price'] ) . '</del></span><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>

            <?php elseif ($settings['amokit_pricing_style'] == 5) : ?>
                <div class="amo-pricing-heading">
                    <?php
                        if (!empty($settings['pricing_title'])) {
                            echo '<div class="title"><h2>' . amokit_kses_title( $settings['pricing_title'] ) . '</h2></div>';
                        }
                        if (!empty($settings['pricing_plan_title'])) {
                            echo '<div class="pricing-plan"><h1>' . amokit_kses_title( $settings['pricing_plan_title'] ) . '</h1></div>';
                        }
                    ?>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title( $settings['amokit_original_price'] ) . '</del></span><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title($settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="amo-pricing-body">
                    <?php if ($settings['amokit_features_list']) : ?>
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif;
                    if (!empty($settings['amokit_button_text'])) {
                        echo sprintf('<a %1$s><span>%2$s</span></a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text']) );
                    }
                    ?>
                </div>

            <?php elseif ($settings['amokit_pricing_style'] == 6) : ?>
                <div class="amo-pricing-heading">
                    <div class="amo-pricing-header-align">
                        <?php
                            if (!empty($settings['pricing_title'])) {
                                echo '<div class="title"><h2>' . amokit_kses_title( $settings['pricing_title'] ) . '</h2></div>';
                            }
                            if (!empty($settings['pricing_plan_title'])) {
                                echo '<div class="pricing-plan"><h1>' . amokit_kses_title( $settings['pricing_plan_title'] ) . '</h1></div>';
                            }
                        ?>
                    </div>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title( $settings['amokit_original_price'] ) . '</del></span><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title( $settings['amokit_period'] ) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title( $settings['amokit_price'] ) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>

            <?php elseif ($settings['amokit_pricing_style'] == 7) : ?>
                <div class="amo-pricing-heading">
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title($settings['amokit_original_price']) . '</del></span><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if (!empty($settings['pricing_title'])) {
                        echo '<div class="title"><h2>' . amokit_kses_title($settings['pricing_title']) . '</h2></div>';
                    }
                    ?>
                </div>
                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>
            <?php elseif ($settings['amokit_pricing_style'] == 8) : ?>

                <div class="amo-pricing-heading">
                    <div class="amo-pricing-header-align">
                        <?php
                            if (!empty($settings['pricing_title'])) {
                                echo '<div class="title"><h2>' . amokit_kses_title($settings['pricing_title']) . '</h2></div>';
                            }
                            if (!empty($settings['pricing_plan_title'])) {
                                echo '<div class="pricing-plan"><h1>' . amokit_kses_title($settings['pricing_plan_title']) . '</h1></div>';
                            }
                        ?>
                    </div>
                    <div class="price-label">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if ( !empty($settings['amokit_price']) ) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title($settings['amokit_original_price']) . '</del></span><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price']) ) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off';} ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>          
            <?php elseif ($settings['amokit_pricing_style'] == 9) : ?>    

                <div class="amo-pricing-heading">
                    <div class="header-top-image">
                        <?php 
                        if( !empty( $settings['titleimage'] ) ){
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'iconimagesize', 'titleimage' );
                        }

                        if( !empty( $settings['titleicon']['value'] ) ){
                            echo AmoKit_Icon_manager::render_icon( $settings['titleicon'], [ 'aria-hidden' => 'true' ] );
                        }
                        ?>
                    </div>
                    <div class="amo-pricing-header-align">
                        <?php
                            if (!empty($settings['pricing_title'])) {
                                echo '<div class="title"><h2>' . amokit_kses_title($settings['pricing_title']) . '</h2></div>';
                            }
                            if (!empty($settings['pricing_plan_title'])) {
                                echo '<div class="pricing-plan"><h1>' . amokit_kses_title($settings['pricing_plan_title']) . '</h1></div>';
                            }
                        ?>
                    </div>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if ( !empty($settings['amokit_price']) ) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title($settings['amokit_original_price']) . '</del></span><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price']) ) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title( $currencysymbol ) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>
            <?php else : ?>
                <div class="amo-pricing-heading">
                    <?php
                    if (!empty($settings['pricing_title'])) {
                        echo '<div class="title"><h2>' . amokit_kses_title($settings['pricing_title']) . '</h2></div>';
                    }
                    ?>
                    <div class="price">
                        <?php
                        if ($settings['amokit_offer_price'] == 'yes' && !empty($settings['amokit_original_price'])) {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_old">' . amokit_kses_title( $currencysymbol ) . '<del>' . amokit_kses_title($settings['amokit_original_price']) . '</del></span><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        } else {
                            if (!empty($settings['amokit_price'])) {
                                echo '<h4><span class="pricing_new">' . amokit_kses_title($currencysymbol) . amokit_kses_title($settings['amokit_price']) . '</span>';
                            }
                            if(!empty($settings['amokit_period'])){
                                echo '<span class="separator">/</span> <span class="period-txt">' . amokit_kses_title($settings['amokit_period']) . '</span>';
                            }
                            if ( !empty($settings['amokit_price'])) {
                                echo '</h4>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if ($settings['amokit_features_list']) : ?>
                    <div class="amo-pricing-body">
                        <ul class="amo-features">
                            <?php foreach ($settings['amokit_features_list'] as $features) : ?>
                                <li class="<?php if ($features['amokit_old_features'] == 'yes') { echo 'off'; } ?> elementor-repeater-item-<?php echo esc_attr($features['_id']); ?>">
                                    <?php
                                    if (!empty($features['amokit_features_icon']['value'])) {
                                        echo AmoKit_Icon_manager::render_icon($features['amokit_features_icon'], ['aria-hidden' => 'true']);
                                    }
                                    echo esc_html( $features['amokit_features_title'] );
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php
                if (!empty($settings['amokit_button_text'])) {
                    echo '<div class="amo-pricing-footer">' . sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), wp_kses_post( $settings['amokit_button_text'] ) ) . '</div>';
                }
                ?>

            <?php endif; ?>
        </div>
<?php
    }
}

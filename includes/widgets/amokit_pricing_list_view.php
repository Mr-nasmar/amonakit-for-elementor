<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Pricing_List_View extends Widget_Base {

    public function get_name() {
        return 'amokit-pricinglistview-addons';
    }
    
    public function get_title() {
        return __( 'Pricing List View', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-table';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_keywords() {
        return ['price list','list view','elementor list view','elementor pricing list','elementor price list', 'pricing list view', 'amokit', 'Amona Kit'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/pricing-list-view-widget-2/';
    }

    public function get_style_depends(){
        return [
            'amokit-widgets',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'datatable_layout',
            [
                'label' => __( 'Layout', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'datatable_style',
                [
                    'label' => __( 'Layout', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Layout One', 'amokit-addons' ),
                        '2'   => __( 'Layout Two', 'amokit-addons' ),
                        '3'   => __( 'Layout Three', 'amokit-addons' ),
                        '4'   => __( 'Layout Four ( No Border )', 'amokit-addons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // List Pricing
        $this->start_controls_section(
            'list_content',
            [
                'label' => __( 'Content', 'amokit-addons' ),
                'condition'=>[
                    'datatable_style'=>'3'
                ]
            ]
        );

            $repeater_two = new Repeater();   

            $repeater_two->add_control(
                'list_name',
                [
                    'label'   => __( 'Name', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'WordPress Plugin', 'amokit-addons' ),
                ]
            );

            $repeater_two->add_control(
                'list_label_price',
                [
                    'label'   => __( 'Before Price Label', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $repeater_two->add_control(
                'list_price',
                [
                    'label'   => __( 'Price', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( '$56', 'amokit-addons' ),
                ]
            );

            $repeater_two->add_control(
                'list_label_month',
                [
                    'label'   => __( 'After Price Label', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $repeater_two->add_control(
                'list_cart_icon',
                [
                    'label'   => __( 'Icon', 'amokit-addons' ),
                    'type'    => Controls_Manager::ICONS,
                    'default' =>[
                        'value'=>'fas fa-shopping-basket',
                        'library'=>'solid',
                    ],
                ]
            );

            $repeater_two->add_control(
                'list_cart_link',
                [
                    'label' => __( 'Link', 'amokit-addons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => false,
                        'nofollow' => false,
                    ]
                ]
            );
            

            $this->add_control(
                'pricing_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater_two->get_controls(),
                    'default' => [
                        [
                            'list_name' => __( 'WordPress Plugin', 'amokit-addons' ),
                            'list_price' => __( '$52', 'amokit-addons' ),
                            'list_cart_icon' => __( 'fas fa-shopping-basket', 'amokit-addons' ),
                        ],

                        [
                            'list_name' => __( 'PSD Template', 'amokit-addons' ),
                            'list_price' => __( '$48', 'amokit-addons' ),
                            'list_cart_icon' => __( 'fas fa-shopping-basket', 'amokit-addons' ),
                        ],

                        [
                            'list_name' => __( 'Joomla Template', 'amokit-addons' ),
                            'list_price' => __( '$46', 'amokit-addons' ),
                            'list_cart_icon' => __( 'fas fa-shopping-basket', 'amokit-addons' ),
                        ],

                        [
                            'list_name' => __( 'Html Template', 'amokit-addons' ),
                            'list_price' => __( '$42', 'amokit-addons' ),
                            'list_cart_icon' => __( 'fas fa-shopping-basket', 'amokit-addons' ),
                        ]

                    ],
                    'title_field' => '{{{ list_name }}}',
                ]
            );

        $this->end_controls_section();

        // Table Header
        $this->start_controls_section(
            'datatable_header',
            [
                'label' => __( 'Table Header', 'amokit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition'=>[
                    'datatable_style!'=>'3'
                ]
            ]
        );

            $repeater = new Repeater();

            $repeater->start_controls_tabs( '_tabs_column_control' );

            $repeater->start_controls_tab(
                '_tab_column_content',
                [
                    'label' => __( 'Content', 'amokit-addons' ),
                ]
            );            

                $repeater->add_control(
                    'column_name',
                    [
                        'label'   => __( 'Column Name', 'amokit-addons' ),
                        'type'    => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'No', 'amokit-addons' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $repeater->add_control(
                    'column_span',
                    [
                        'label' => __( 'Col Span', 'amokit-addons' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 0,
                        'max' => 50,
                        'step' => 1
                    ]
                );

                $repeater->add_control(
                    'th_column_width',
                    [
                        'label' => __( 'TH Width (Table Header Column Width %)', 'amokit-addons' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                );

                $repeater->add_responsive_control(
                    'column_head_media',
                    [
                        'label' => __( 'Media', 'amokit-addons' ),
                        'type' => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'toggle' => false,
                        'default' => 'none',
                        'options' => [
                            'icon' => [
                                'title' => __( 'Icon', 'amokit-addons' ),
                                'icon' => 'eicon-info-circle',
                            ],
                            'image' => [
                                'title' => __( 'Image', 'amokit-addons' ),
                                'icon' => 'eicon-image-bold',
                            ],
                            'none' => [
                                'title' => __( 'None', 'amokit-addons' ),
                                'icon' => 'eicon-editor-close',
                            ],
                        ]
                    ]
                );   
                
                $repeater->add_control(
                    'column_head_icons',
                    [
                        'label' => __( 'Icon', 'amokit-addons' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'column_icon',
                        'label_block' => true,
                        'condition' => [
                            'column_head_media' => 'icon'
                        ],
                    ]
                );
        
                $repeater->add_control(
                    'column_head_image',
                    [
                        'label' => __( 'Image', 'amokit-addons' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'dynamic' => [
                            'active' => true,
                        ],
                        'condition' => [
                            'column_head_media' => 'image'
                        ]
                    ]
                );
        
                $repeater->add_group_control(
                    Group_Control_Image_Size::get_type(),
                    [
                        'name' => 'column_head_thumbnail',
                        'default' => 'thumbnail',
                        'separator' => 'none',
                        'condition' => [
                            'column_head_media' => 'image'
                        ]
                    ]
                );               

            $repeater->end_controls_tab();        


            $repeater->start_controls_tab(
                '_tab_column_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                ]
            );            

            $repeater->add_control(
                'amokit_head_icon_color',
                [
                    'label' => __( 'Icon Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'column_head_media' => 'icon'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-icon i' => 'color: {{VALUE}}',
                    ],
                    'separator' => 'after',
                ]
            );

            $repeater->add_control(
                'amokit_head_icon_heading',
                [
                    'label' => __( 'For Layout 4 only', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $repeater->add_control(
                'amokit_head_icon_bg_color',
                [
                    'label' => __( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_responsive_control(
                'amokit_head_separetor_position',
                [
                    'label' => __( 'Left-Right Position', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater->add_responsive_control(
                'amokit_head_separetor_position_tb',
                [
                    'label' => __( 'Top-Bottom Position', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater->add_responsive_control(
                'amokit_head_separetor_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );    

            $repeater->add_responsive_control(
                'amokit_head_separetor_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater->add_responsive_control(
                'amokit_head_separetor_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-column-cell-area:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );             

            $repeater->end_controls_tab();
            $repeater->end_controls_tabs();

            $this->add_control(
                'header_column_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'title_field' => '{{{ column_name }}}',
                    'prevent_empty'=>false,
                    'default' => [
                        [
                            'column_name' => __( 'No', 'amokit-addons' ),
                        ],

                        [
                            'column_name' => __( 'Name', 'amokit-addons' ),
                        ],

                        [
                            'column_name' => __( 'Designation', 'amokit-addons' ),
                        ],

                        [
                            'column_name' => __( 'Email', 'amokit-addons' ),
                        ]

                    ],
                ]
            );
            
            $this->add_responsive_control(
                'datatable_header_align',
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
                        '{{WRAPPER}} .amo-pricing-list-view thead tr th' => 'text-align: {{VALUE}};',
                    ],
                    'default' => '',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'image_icon_position',
                [
                    'label' => __( 'Image/Icon Position', 'amokit-addons' ),
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
                        'top' => [
                            'title' => __( 'Top', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => false,
                    'prefix_class' => 'amokit-column-position-icon-'
                ]
            );         
            
        $this->end_controls_section();

        // Table Content
        $this->start_controls_section(
            'datatable_content',
            [
                'label' => __( 'Table Content', 'amokit-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition'=>[
                    'datatable_style!'=>'3'
                ]
            ]
        );

            $repeater_one = new Repeater();

            $repeater_one->add_control(
                'field_type',
                [
                    'label' => __( 'Fild Type', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'row',
                    'options' => [
                        'row'   => __( 'Row', 'amokit-addons' ),
                        'col'   => __( 'Column', 'amokit-addons' ),
                    ],
                ]
            );

            $repeater_one->start_controls_tabs( '_tabs_row_control' );

            $repeater_one->start_controls_tab(
                '_tabs_row_content',
                [
                    'label' => __( 'Content', 'amokit-addons' ),
                    'condition' => [
                        'field_type' => 'col'
                    ],
                ]
            );

                $repeater_one->add_control(
                    'content_type',
                    [
                        'label' => esc_html__('Content Type','amokit-addons'),
                        'type' =>Controls_Manager::CHOOSE,
                        'default'=>'text',
                        'condition'=>[
                            'field_type'=>'col',
                        ],
                        'options' =>[
                            'text' =>[
                                'title' =>__('Text','amokit-addons'),
                                'icon' =>'eicon-animation-text',
                            ],
                            'icon' =>[
                                'title' =>__('Icon','amokit-addons'),
                                'icon' =>'eicon-info-circle',
                            ],
                            'both' =>[
                                'title' =>__('Both','amokit-addons'),
                                'icon' =>'eicon-plus',
                            ],
                            'button' =>[
                                'title' =>__('Button','amokit-addons'),
                                'icon' =>'eicon-button',
                            ]
                        ],
                    ]
                );

                $repeater_one->add_control(
                    'cell_text',
                    [
                        'label'   => __( 'Cell Content', 'amokit-addons' ),
                        'type'    => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Louis Hudson', 'amokit-addons' ),
                        'dynamic' => [
                            'active' => true,
                        ],
                        'condition'=>[
                            'field_type'=>'col',
                            'content_type!'=>'icon',
                        ]
                    ]
                );

                $repeater_one->add_control(
                    'cell_label_text',
                    [
                        'label'   => __( 'Cell Label', 'amokit-addons' ),
                        'type'    => Controls_Manager::TEXT,
                        'condition'=>[
                            'field_type'=>'col',
                            'content_type'=>'text',
                        ]
                    ]
                );                

                $repeater_one->add_control(
                    'cell_icon',
                    [
                        'label' => __( 'Icons', 'amokit-addons' ),
                        'type' => Controls_Manager::ICONS,
                        'default'=> [
                            'value'=>'fas fa-facebook',
                            'library'=>'solid',
                        ],
                        'condition'=>[
                            'field_type'=>'col',
                            'content_type!'=>'text',
                            'content_type!'=>array( 'button','text' ),
                        ]
                    ]
                );

                $repeater_one->add_control(
                    'row_colspan',
                    [
                        'label' => __( 'Colspan', 'amokit-addons' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 1,
                        'step' => 1,
                        'default' => 1,
                        'condition'=>[
                            'field_type'=>'col',
                        ]
                    ]
                );

                $repeater_one->add_control(
                    'content_link',
                    [
                        'label' => __( 'Link', 'amokit-addons' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'amokit-addons' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => false,
                            'nofollow' => false,
                        ],
                        'condition'=>[
                            'field_type'=>'col',
                        ]
                    ]
                );


            $repeater_one->end_controls_tab();

            $repeater_one->start_controls_tab(
                '_tabs_row_styles',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'condition' => [
                        'field_type' => 'col'
                    ],
                ]
            );    
            
            $repeater_one->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'row_custom_background_color_typography',
                    'label' => __( 'Table Body Typography', 'amokit-addons' ),
                    'condition' => [
                        'field_type' => 'col',
                        'content_type!' => 'icon'
                    ],
                    'selector' => '
                        {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell .amo-pricing-table__head-row-cell-area span.table-row-title,
                        {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell .amo-pricing-table__head-row-cell-area.amo-button a.htb-btn
                    '
                ]
            );
            
            $repeater_one->add_control(
                'row_custom_background_color',
                [
                    'label' => __( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'field_type' => 'col',
                        'content_type!' => 'button'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_control(
                'row_custom_text_color',
                [
                    'label' => __( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 'content_type!' => 'icon' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-text , {{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn , {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.table-row-title' => 'color: {{VALUE}}',
                    ],
                ]
            );            
            
            // Label Style Start 
            $repeater_one->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'row_custom_label_typography',
                    'label' => __( 'Label Typography', 'amokit-addons' ),
                    'condition' => [
                        'field_type' => 'col',
                        'content_type' => 'text',
                        'cell_label_text!' => ''
                    ],
                    'selector' => '
                        {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label
                    '
                ]
            );

            $repeater_one->add_responsive_control(
                'row_custom_icon_size',
                [
                    'label' => __( 'Icon Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'condition' => [
                        'content_type' => array('icon','both'),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label , {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $repeater_one->add_responsive_control(
                'row_custom_label_position',
                [
                    'label' => __( 'Label Position', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'condition' => [
                        'content_type' => 'text',
                        'cell_label_text!' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => -5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );            

            $repeater_one->add_control(
                'row_custom_label_background_color',
                [
                    'label' => __( 'Label Background', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'content_type' => 'text',
                        'cell_label_text!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_control(
                'row_custom_label_color',
                [
                    'label' => __( 'Label Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 
                        'content_type' => 'text',
                        'cell_label_text!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_responsive_control(
                'row_custom_text_border_radious',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'condition' => [
                        'content_type' => 'text' ,
                        'cell_label_text!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'after',    
                ]
            ); 

            $repeater_one->add_responsive_control(
                'row_custom_text_label_padding',
                [
                    'label' => __( 'Label Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'condition' => [
                        'cell_label_text!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );
            
            $repeater_one->add_responsive_control(
                'row_custom_text_label_margin',
                [
                    'label' => __( 'Label Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'condition' => [
                        'cell_label_text!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell span.ht-data-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]  
                ]
            );              
            // End Label Style 

            // Button Style Start 
            $repeater_one->add_control(
                'row_button_custom_background_color',
                [
                    'label' => __( 'Button Background', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 'content_type' => 'button' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_control(
                'row_button_custom_hover_background',
                [
                    'label' => __( 'Button Hover Background', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 'content_type' => 'button' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_control(
                'row_custom_text_hover_color',
                [
                    'label' => __( 'Text Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 'content_type' => 'button' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $repeater_one->add_control(
                'row_custom_icon_color',
                [
                    'label' => __( 'Icon Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [ 'content_type!' => array('text','button'),],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-icon i , {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-icon svg path, {{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );  

            $repeater_one->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'row_custom_button_border',
                    'label' => esc_html__( 'Border', 'amokit-addons' ),
                    'condition' => [ 'content_type' => 'button' ],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn',
                ]
            );            
            
            $repeater_one->add_responsive_control(
                'row_custom_button_padding',
                [
                    'label' => __( 'Button Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'condition' => ['content_type' => 'button'],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );
            
            $repeater_one->add_responsive_control(
                'row_custom_button_border_radious',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'condition' => ['content_type' => 'button' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-button a.htb-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'after',    
                ]
            );  
            // End Button Styles 
            
            $repeater_one->add_control(
                'amokit_row_icon_heading',
                [
                    'label' => __( 'For Layout 4 only', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $repeater_one->add_control(
                'amokit_row_icon_bg_color',
                [
                    'label' => __( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.amo-pricing-row-cell .amo-pricing-table__head-row-cell-area:before' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater_one->add_responsive_control(
                'amokit_row_separetor_position',
                [
                    'label' => __( 'Left-Right Position', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-area:before' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater_one->add_responsive_control(
                'amokit_row_separetor_position_tb',
                [
                    'label' => __( 'Top-Bottom Position', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-area:before' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater_one->add_responsive_control(
                'amokit_row_separetor_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-area:before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );    

            $repeater_one->add_responsive_control(
                'amokit_row_separetor_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-area:before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $repeater_one->add_responsive_control(
                'amokit_row_separetor_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .amo-pricing-table__head-row-cell-area:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );              

            $repeater_one->end_controls_tab();
            $repeater_one->end_controls_tabs();

            $this->add_control(
                'row_starts',
                [
                    'label' => false,
                    'type' => Controls_Manager::HIDDEN,
                    'default' => __( 'Row Starts', 'amokit-addons' ),
                    'condition' => [
                        'field_type' => 'row'
                    ],
                ]
            );

            $this->add_control(
                'content_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater_one->get_controls(),
                    'title_field' => '<# print( (field_type == "col" ) ? cell_text : ("Row") ) #>',
                    'prevent_empty'=>false,
                    'default' => [
                        [
                            'field_type' => __( 'row', 'amokit-addons' ),
                        ],

                        [
                            'field_type' => __( 'col', 'amokit-addons' ),
                            'cell_text' => __( '1', 'amokit-addons' ),
                            'row_colspan' => __( '1', 'amokit-addons' ),
                        ],

                        [
                            'field_type' => __( 'col', 'amokit-addons' ),
                            'cell_text' => __( 'Louis Hudson', 'amokit-addons' ),
                            'row_colspan' => __( '1', 'amokit-addons' ),
                        ],

                        [
                            'field_type' => __( 'col', 'amokit-addons' ),
                            'cell_text' => __( 'Developer', 'amokit-addons' ),
                            'row_colspan' => __( '1', 'amokit-addons' ),
                        ],


                        [
                            'field_type' => __( 'col', 'amokit-addons' ),
                            'cell_text' => __( 'louishudson@gmail.com', 'amokit-addons' ),
                            'row_colspan' => __( '1', 'amokit-addons' ),
                        ]

                    ],
                    
                ]
            );

            $this->add_responsive_control(
                'datatable_body_align',
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
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr td' => 'text-align: {{VALUE}};',
                    ],
                    'default' => '',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'datatable_body_vertical_align',
                [
                    'label' => __( 'Vertical Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'baseline' => [
                            'title' => __( 'Baseline', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                        'top' => [
                            'title' => __( 'Top', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr td' => 'vertical-align: {{VALUE}};',
                    ],
                    'default' => 'baseline',
                ]
            );

            $this->add_responsive_control(
                'ht_row_icon_position',
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
                        'top' => [
                            'title' => __( 'Top', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'amokit-addons' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => false,
                    'prefix_class' => 'amokit-row-icon-position-'
                ]
            );          
            
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_table_style_section',
            [
                'label' => __( 'Table', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style!'=>'3',
                ]
            ]
        );

            $this->add_control(
                'datatable_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'datatable_padding',
                [
                    'label' => esc_html__( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                            '{{WRAPPER}} .amo-pricing-list-view' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'datatable_margin',
                [
                    'label' => esc_html__( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                            '{{WRAPPER}} .amo-pricing-list-view' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'datatable_border',
                        'label' => esc_html__( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-pricing-list-view table.table',
                    ]
            );

            $this->add_responsive_control(
                'datatable_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Table Header Style tab section
        $this->start_controls_section(
            'amokit_table_header_style_section',
            [
                'label' => __( 'Table Header', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style!'=>'3',
                ]
            ]
        );

            $this->add_control(
                'datatable_header_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view thead tr th' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'datatable_header_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view thead tr th' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'datatable_header_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-pricing-list-view thead tr th',
                ]
            );

            $this->add_responsive_control(
                'datatable_header_padding',
                [
                    'label' => esc_html__( 'Table Header Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                            '{{WRAPPER}} .amo-pricing-list-view thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'datatable_header_border',
                        'label' => esc_html__( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-pricing-list-view thead tr th',
                    ]
            );

            $this->add_responsive_control(
                'datatable_header_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view thead tr th' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Table Body Style tab section
        $this->start_controls_section(
            'amokit_table_body_style_section',
            [
                'label' => __( 'Table Body', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style!'=>'3',
                ]
            ]
        );

            $this->add_control(
                'datatable_body_bg_color',
                [
                    'label' => esc_html__( 'Background Color ( Even )', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr:nth-child(even)' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'datatable_body_odd_bg_color',
                [
                    'label' => esc_html__( 'Background Color ( Odd )', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr:nth-child(odd)' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'datatable_body_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr td' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'datatable_body_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-pricing-list-view tbody tr td',
                ]
            );

            $this->add_responsive_control(
                'datatable_body_padding',
                [
                    'label' => esc_html__( 'Table Body Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                            '{{WRAPPER}} .amo-pricing-list-view tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                    [
                        'name' => 'datatable_body_border',
                        'label' => esc_html__( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-pricing-list-view tbody tr td',
                    ]
            );

            $this->add_responsive_control(
                'datatable_body_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-list-view tbody tr td' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Price List Style tab section
        $this->start_controls_section(
            'price_list_area_style_section',
            [
                'label' => __( 'List Area', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

        $this->add_control(
            'price_list_area_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_list_area_price_border_radius',
            [
                'label' => __( 'Border Radius', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        ); 
            
        $this->add_responsive_control(
            'price_list_area_price_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'price_list_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

            $this->add_control(
                'price_list_title_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-list-text span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_list_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-list-text span',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'price_list_before_price_style_section',
            [
                'label' => __( 'Before Price Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_list_before_price_typography',
                'label' => __( 'Save Typography', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label'
            ]
        );

        $this->add_control(
            'price_list_before_price_color',
            [
                'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_list_before_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_list_before_price_border_radius',
            [
                'label' => __( 'Border Radius', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        ); 
            
        $this->add_responsive_control(
            'price_list_before_price_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
            
        $this->add_responsive_control(
            'price_list_before_price_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li span.before-price-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        // Price List Style tab section
        $this->start_controls_section(
            'price_list_price_style_section',
            [
                'label' => __( 'Price', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

            $this->add_control(
                'price_list_price_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.price' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'price_list_price_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.price' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_list_price_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.price',
                ]
            );
        
            $this->add_responsive_control(
                'price_list_price_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );
                
            $this->add_responsive_control(
                'price_list_price_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );            

        $this->end_controls_section();

        $this->start_controls_section(
            'price_list_after_price_style_section',
            [
                'label' => __( 'After Price Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_list_after_price_typography',
                'label' => __( 'Per Month Typography', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label'
            ]
        );

        $this->add_control(
            'price_list_after_price_color',
            [
                'label' => esc_html__( 'Text Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_list_after_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_list_after_price_border_radius',
            [
                'label' => __( 'Border Radius', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        ); 
            
        $this->add_responsive_control(
            'price_list_after_price_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
            
        $this->add_responsive_control(
            'price_list_after_price_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.after-price-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();        

        // Price List Style tab section
        $this->start_controls_section(
            'price_list_icon_style_section',
            [
                'label' => __( 'Icon', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'datatable_style'=>'3',
                ]
            ]
        );

            $this->add_control(
                'price_list_price_icon_color',
                [
                    'label' => esc_html__( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.basket' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'price_list_price_icon_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.basket' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'price_list_price_icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.basket' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            ); 
                
            $this->add_responsive_control(
                'price_list_price_icon_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.basket' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );
                
            $this->add_responsive_control(
                'price_list_price_icon_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-pricing-table-style-3 ul li a .price-text-right span.basket' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
    
                ]
            );            

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $id = $this->get_id();

        $this->add_render_attribute( 'datatable_attr', 'class', 'table-responsive amokit-pricing-list-view amokit-pricing-table-style-'.$settings['datatable_style'] );

        $table_tr = array();
        $table_td = array();

        if( isset( $settings['content_list'] ) ){
            foreach( $settings['content_list'] as $content_row ) {
                $row_id = wp_rand(10, 1000);
                if( $content_row['field_type'] == 'row' ) {
                    $table_tr[] = [
                        'id' => $row_id,
                        'type' => $content_row['field_type'],
                    ];
                }
                if( $content_row['field_type'] == 'col' ) {

                    $target = $content_row['content_link']['is_external'] ? 'target="_blank"' : '';
                    $nofollow = $content_row['content_link']['nofollow'] ? 'rel="nofollow"' : '';

                    $table_tr_keys = array_keys( $table_tr );
                    $last_key = end( $table_tr_keys );

                    $table_td[] = [
                        'repeater_id' => $content_row['_id'],
                        'row_id' => $table_tr[$last_key]['id'],
                        'title' => $content_row['cell_text'],
                        'celllable' => $content_row['cell_label_text'],
                        'colspan' => $content_row['row_colspan'],
                        'contenttype' => $content_row['content_type'],
                        'icon' => isset( $content_row['cell_icon']['value'] ) ? AmoKit_Icon_manager::render_icon( $content_row['cell_icon'], [ 'aria-hidden' => 'true' ] ) : '',
                        'link_url' => $content_row['content_link']['url'],
                        'link_target' => $target,
                        'nofollow' => $nofollow,
                    ];
                }

            }
        }
       
        ?>
        <div <?php echo $this->get_render_attribute_string( 'datatable_attr' ); ?>>

            <?php if( $settings['datatable_style'] == 3 ): ?>
                <ul>
                    <?php
                    if( isset( $settings['pricing_list'] ) ){ 
                        foreach ( $settings['pricing_list'] as $pricinglist ):
                            $target_one = $pricinglist['list_cart_link']['is_external'] ? 'target="_blank"' : '';
                            $nofollow_one = $pricinglist['list_cart_link']['nofollow'] ? 'rel="nofollow"' : '';
                    ?>
                        <li>
                            <a href="<?php echo esc_url( $pricinglist['list_cart_link']['url'] ); ?>" <?php echo esc_attr( $target_one ); ?> <?php echo esc_attr( $nofollow_one ); ?> >
                                <div class="price-list-text">
                                    <?php 
                                        if( !empty( $pricinglist['list_name'] ) ){
                                            echo '<span>'.esc_html( $pricinglist['list_name'] ).'</span><span class="separator"></span>';
                                        }
                                    ?>
                                </div>
                                <div class="price-text-right">
                                    <?php
                                        if( !empty( $pricinglist['list_label_price'] ) ){
                                            echo '<span class="before-price-label">'.esc_html( $pricinglist['list_label_price'] ).'</span>';
                                        }
                                        if( !empty( $pricinglist['list_price'] ) ){
                                            echo '<span class="price">'.esc_html( $pricinglist['list_price'] ).'</span>';
                                        }
                                        if( !empty( $pricinglist['list_label_month'] ) ){
                                            echo '<span class="after-price-label">'.esc_html( $pricinglist['list_label_month'] ).'</span>';
                                        }
                                        if( !empty( $pricinglist['list_cart_icon']['value'] ) ){
                                            echo '<span class="basket">'.amo_Icon_manager::render_icon( $pricinglist['list_cart_icon'], [ 'aria-hidden' => 'true' ] ).'</span>';
                                        }
                                    ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; } ?>
                </ul>
            <?php else:?>

                <table class="table">
                    <?php if( $settings['header_column_list'] ): ?>
                        <thead>
                            <tr>
                                <?php foreach ( $settings['header_column_list'] as $key => $headeritem ) {

                                    $column_repeater_key = $this->get_repeater_setting_key( 'column_span', 'header_column_list', $key );

                                    $this->add_render_attribute( $column_repeater_key, 'class', 'amokit-pricing-table__head-column-cell' );
                                    $this->add_render_attribute( $column_repeater_key, 'class', 'elementor-repeater-item-' . esc_attr( $headeritem['_id'] ) );

                                    if ( $headeritem['column_span'] ) {
                                        $this->add_render_attribute( $column_repeater_key, 'colspan', esc_attr( $headeritem['column_span'] ) );
                                    }   
                                    
                                    if($headeritem['th_column_width']){
                                        $this->add_render_attribute($column_repeater_key, 'width', esc_attr( $headeritem['th_column_width'] ) .'%' );
                                    }
            
                                    if( $settings['datatable_style'] == 2 && !empty( $headeritem['column_name'] )){ ?>
                                        <th <?php echo $this->get_render_attribute_string( $column_repeater_key ); ?>>
                                            <?php if(!empty($headeritem['column_name']) || !empty($headeritem['column_head_icons'])){ ?>
                                                <div class="amo-pricing-table__head-column-cell-area">
                                                    <?php if(!empty($headeritem['column_name'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-text">
                                                            <?php echo esc_html( $headeritem['column_name'] ); ?>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if( $headeritem['column_head_media'] == 'icon' && !empty($headeritem['column_head_icons']['value'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-icon">
                                                            <?php echo AmoKit_Icon_manager::render_icon( $headeritem['column_head_icons'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if(!empty($headeritem['column_head_image']['url']) || !empty($headeritem['column_head_image']['id'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-icon">
                                                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $headeritem, 'column_head_thumbnail', 'column_head_image' ); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </th>                                        
                                    <?php } else { ?>
                                        <th <?php echo $this->get_render_attribute_string( $column_repeater_key ); ?>>
                                            <?php if(!empty($headeritem['column_name']) || !empty($headeritem['column_head_icons'])){ ?>
                                                <div class="amo-pricing-table__head-column-cell-area">
                                                    <?php if(!empty($headeritem['column_name'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-text">
                                                            <?php echo esc_html( $headeritem['column_name'] ); ?>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if( $headeritem['column_head_media'] == 'icon' && !empty($headeritem['column_head_icons']['value'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-icon">
                                                            <?php echo AmoKit_Icon_manager::render_icon( $headeritem['column_head_icons'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if(!empty($headeritem['column_head_image']['url']) || !empty($headeritem['column_head_image']['id'])){ ?>
                                                        <div class="amo-pricing-table__head-column-cell-icon">
                                                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $headeritem, 'column_head_thumbnail', 'column_head_image' ); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </th>
                                    <?php } } ?>
                            </tr>
                        </thead>
                    <?php endif;?>
                    <tbody>
                        <?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
                            <tr>
                                <?php
                                    for( $j = 0; $j < count( $table_td ); $j++ ):
                                        if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ):
                                            $pricing_table_repeater_key = $this->get_repeater_setting_key( 'row_colspan', 'content_list', $table_td[$j]['row_id'].$i.$j );
                                            $this->add_render_attribute( $pricing_table_repeater_key, 'class', 'amokit-pricing-row-cell' );
                                            $this->add_render_attribute( $pricing_table_repeater_key, 'class', 'elementor-repeater-item-' . esc_attr( $table_td[$j]['repeater_id'] ) );
                                ?>
                                <td <?php echo $this->get_render_attribute_string( $pricing_table_repeater_key ); ?> <?php echo $table_td[$j]['colspan'] > 1 ? ' colspan="'.esc_attr($table_td[$j]['colspan']).'"' : ''; ?>>
                                    <?php
                                        if( $settings['datatable_style'] == 2 ){
                                            if( $table_td[$j]['contenttype'] == 'icon' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">
                                                <?php if( !empty( $table_td[$j]['link_url'] ) ){
                                                        echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'.$table_td[$j]['icon'].'</a>';
                                                    }else{
                                                        echo sprintf( '%1$s', $table_td[$j]['icon']);
                                                    } ?>
                                                </div>
                                            <?php }elseif( $table_td[$j]['contenttype'] == 'text' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">
                                                    <?php if( !empty( $table_td[$j]['link_url'] ) ){
                                                        echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'. wp_kses_post( $table_td[$j]['title'] ) .'</a>'; 
                                                    }else{ ?>
                                                        <span class="table-row-title">
                                                            <?php echo amokit_kses_title($table_td[$j]['title']); ?>
                                                        </span>
                                                        <?php if(!empty($table_td[$j]['celllable'])){ ?>
                                                            <span class="ht-data-label">
                                                                <?php echo amokit_kses_title( $table_td[$j]['celllable'] ); ?>
                                                            </span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php }elseif( $table_td[$j]['contenttype'] == 'both' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">

                                                    <div class="amo-pricing-table__head-row-cell-text">
                                                        <?php
                                                            if( !empty( $table_td[$j]['link_url'] ) ){
                                                                echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'. wp_kses_post( $table_td[$j]['title'] ) .'</a>';
                                                            }else{
                                                                echo amokit_kses_title( $table_td[$j]['title'] );
                                                            }
                                                        ?>
                                                    </div>
                                                    <?php if( $table_td[$j]['contenttype'] == 'both' && isset($table_td[$j]['icon']) ){ ?>
                                                        <div class="amo-pricing-table__head-row-cell-icon">
                                                            <?php echo sprintf( '%1$s', $table_td[$j]['icon']); ?>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            <?php 
                                            }else{
                                                if( !empty( $table_td[$j]['contenttype'] == 'button' && !empty($table_td[$j]['title']) ) ){ ?>
                                                    <div class="amo-pricing-table__head-row-cell-area amokit-button">
                                                        <a class="htb-btn" href="<?php echo esc_url( $table_td[$j]['link_url'] ); ?>" <?php echo esc_attr( $table_td[$j]['link_target'] ); ?> <?php echo esc_attr( $table_td[$j]['nofollow'] ); ?> >
                                                            <?php echo amokit_kses_title( $table_td[$j]['title'] ); ?>
                                                        </a>
                                                    </div> <?php 
                                                }
                                            }
                                        }else{
                                            if( $table_td[$j]['contenttype'] == 'icon' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">
                                                <?php if( !empty( $table_td[$j]['link_url'] ) ){
                                                        echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'.$table_td[$j]['icon'].'</a>';
                                                    }else{
                                                        echo sprintf( '%1$s', $table_td[$j]['icon']);
                                                    } ?>
                                                </div>
                                            <?php }elseif( $table_td[$j]['contenttype'] == 'text' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">
                                                    <?php if( !empty( $table_td[$j]['link_url'] ) ){
                                                        echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'. wp_kses_post( $table_td[$j]['title'] ) .'</a>'; 
                                                    }else{ ?>
                                                        <span class="table-row-title">
                                                            <?php echo amokit_kses_title( $table_td[$j]['title'] ); ?>
                                                        </span>
                                                        <?php if(!empty($table_td[$j]['celllable'])){ ?>
                                                            <span class="ht-data-label">
                                                                <?php echo amokit_kses_title( $table_td[$j]['celllable'] ); ?>
                                                            </span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php }elseif( $table_td[$j]['contenttype'] == 'both' ){ ?>
                                                <div class="amo-pricing-table__head-row-cell-area">

                                                    <div class="amo-pricing-table__head-row-cell-text">
                                                        <?php
                                                            if( !empty( $table_td[$j]['link_url'] ) ){
                                                                echo '<a href="'.esc_url( $table_td[$j]['link_url'] ).'" '.$table_td[$j]['link_target'].$table_td[$j]['nofollow'].'>'. wp_kses_post( $table_td[$j]['title'] ) .'</a>';
                                                            }else{
                                                                echo amokit_kses_title( $table_td[$j]['title'] );
                                                            }
                                                        ?>
                                                    </div>
                                                    <?php if( $table_td[$j]['contenttype'] == 'both' && isset($table_td[$j]['icon']) ){ ?>
                                                        <div class="amo-pricing-table__head-row-cell-icon">
                                                            <?php echo sprintf( '%1$s', $table_td[$j]['icon']); ?>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            <?php 
                                            }else{
                                                if( !empty( $table_td[$j]['contenttype'] == 'button' && !empty($table_td[$j]['title']) ) ){ ?>
                                                    <div class="amo-pricing-table__head-row-cell-area amokit-button">
                                                        <a class="htb-btn" href="<?php echo esc_url( $table_td[$j]['link_url'] ); ?>" <?php echo esc_attr( $table_td[$j]['link_target'] ); ?> <?php echo esc_attr( $table_td[$j]['nofollow'] ); ?> >
                                                            <?php echo amokit_kses_title( $table_td[$j]['title'] ); ?>
                                                        </a>
                                                    </div> <?php 
                                                }
                                            }
                                        } ?>
                                </td>
                                <?php endif; endfor; ?>
                            </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            <?php endif;?>
        </div>

        <?php

    }

}
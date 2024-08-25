<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Switcher extends Widget_Base {

    public function get_name() {
        return 'amokit-switcher-addons';
    }
    
    public function get_title() {
        return __( 'Switcher', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-exchange';
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
        return ['content','switcher', 'toggle', 'switcher content','amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/creative-widgets/switcher-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'amokit_switch_layout',
            [
                'label' => __( 'Switcher Layout', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'amokit_switcher_layout_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => 'layout-1',
                    'options' => [
                        'layout-1' => __( 'Layout One', 'amokit-addons' ),
                        'layout-2'   => __( 'Layout Two', 'amokit-addons' ),
                    ],
                ]
            );
            $this->add_control(
                'amokit_active_switcher',
                [
                    'label' => __( 'Active Item', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'options' => [
                        'active1' => __( 'Item One', 'amokit-addons' ),
                        'active2'   => __( 'Item Two', 'amokit-addons' ),
                    ],
                ]
            );

        $this->end_controls_section(); // Switcher One tab end

        $this->start_controls_section(
            'switch_one_content',
            [
                'label' => __( 'Switcher One', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'switch_one_title',
                [
                    'label'     => __( 'Title', 'amokit-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'Switch One' , 'amokit-addons' ),
                    'title' => __( 'Switcher Title', 'amokit-addons' ),
                    'dynamic'   => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'switcher_one_icon',
                [
                    'label'     => __( 'Icon', 'amokit-addons' ),
                    'type'      => Controls_Manager::ICONS,
                    'title' => __( 'Switcher Title Icon', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'switcher_one_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-btn .amo-switcher-nav .switcher_one_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-btn .amo-switcher-nav .switcher_one_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'switcher_one_content_source',
                [
                    'label'   => esc_html__( 'Select Content Source', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'    => esc_html__( 'Custom', 'amokit-addons' ),
                        "elementor" => esc_html__( 'Elementor Template', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'switcher_one_template_id',
                [
                    'label'       => __( 'Content', 'amokit-addons' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => '0',
                    'options'     => amokit_elementor_template(),
                    'condition'   => [
                        'switcher_one_content_source' => "elementor"
                    ],
                ]
            );

            $this->add_control(
                'switcher_one_custom_content',
                [
                    'label' => __( 'Content', 'amokit-addons' ),
                    'show_label' =>false,
                    'type' => Controls_Manager::WYSIWYG,
                    'title' => __( 'Content', 'amokit-addons' ),
                    'dynamic'    => [ 'active' => true ],
                    'condition' => [
                        'switcher_one_content_source' =>'custom',
                    ],
                    'default' =>__('Switcher Content One', 'amokit-addons'),
                ]
            );

        $this->end_controls_section(); // Switcher One tab end


        // Switcher Two tab start
        $this->start_controls_section(
            'switch_two_content',
            [
                'label' => __( 'Switcher Two', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'switch_two_title',
                [
                    'label'     => __( 'Title', 'amokit-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'Switch Two' , 'amokit-addons' ),
                    'title' => __( 'Switcher Title', 'amokit-addons' ),
                    'dynamic'   => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'switcher_two_icon',
                [
                    'label'     => __( 'Icon', 'amokit-addons' ),
                    'type'      => Controls_Manager::ICONS,
                    'title' => __( 'Switcher Title Icon', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'switcher_two_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-btn .amo-switcher-nav .switcher_two_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-btn .amo-switcher-nav .switcher_two_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            
            $this->add_control(
                'switcher_two_content_source',
                [
                    'label'   => esc_html__( 'Select Content Source', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'    => esc_html__( 'Custom', 'amokit-addons' ),
                        "elementor" => esc_html__( 'Elementor Template', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'switcher_two_template_id',
                [
                    'label'       => __( 'Content', 'amokit-addons' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => '0',
                    'options'     => amokit_elementor_template(),
                    'condition'   => [
                        'switcher_two_content_source' => "elementor"
                    ],
                ]
            );

            $this->add_control(
                'switcher_two_custom_content',
                [
                    'label' => __( 'Content', 'amokit-addons' ),
                    'show_label' =>false,
                    'type' => Controls_Manager::WYSIWYG,
                    'title' => __( 'Content', 'amokit-addons' ),
                    'dynamic'    => [ 'active' => true ],
                    'condition' => [
                        'switcher_two_content_source' =>'custom',
                    ],
                    'default' =>__('Switcher Content Two', 'amokit-addons'),
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_switcher_style_section',
            [
                'label' => __( 'Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'switcher_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-toggle-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],                ]
            );

            $this->add_responsive_control(
                'switcher_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-toggle-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

        $this->end_controls_section();

        // Style switcher button tab section
        $this->start_controls_section(
            'switcher_button_style_section',
            [
                'label' => __( 'Switcher Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'switcher_button_area_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-switcher-nav',
                    'condition'   => [
                        'amokit_switcher_layout_style' => "layout-1"
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'switcher_button_area_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-switcher-nav',
                    'condition'   => [
                        'amokit_switcher_layout_style' => "layout-1"
                    ],
                ]
            );

            $this->add_responsive_control(
                'switcher_button_area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-nav' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition'   => [
                        'amokit_switcher_layout_style' => "layout-1"
                    ],
                ]
            );

            $this->add_control(
                'switcher_toggle_button_title_color',
                [
                    'label' => __( 'Title Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#444444',
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-toggle .amo-switcher-toggle-title' => 'color: {{VALUE}};',
                    ],
                    'condition'   => [
                        'amokit_switcher_layout_style' => "layout-2"
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'switcher_button_toggle_title_typography',
                    'selector' => '{{WRAPPER}} .amo-switcher-toggle .amo-switcher-toggle-title',
                    'condition'   => [
                        'amokit_switcher_layout_style' => "layout-2"
                    ],
                ]
            );

            $this->start_controls_tabs('style_tabs');

                // Button Normal Tab Start
                $this->start_controls_tab(
                    'switcher_button_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'switcher_button_color',
                        [
                            'label' => __( 'Title Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-switcher-nav span svg path' => 'fill: {{VALUE}};',
                            ],
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'switcher_button_typography',
                            'selector' => '{{WRAPPER}} .amo-switcher-nav span',
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'switcher_button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ], 
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],               ]
                    );

                    $this->add_responsive_control(
                        'switcher_button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'after',
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'switcher_button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-switcher-nav span,{{WRAPPER}} input+.amo-switche-toggle-slider',
                        ]
                    );

                    $this->add_control(
                        'switcher_button_toggle_color',
                        [
                            'label' => __( 'Toggle Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-toggle input+.amo-switche-toggle-slider:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-2"
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'switcher_button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-switcher-nav span',
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'switcher_button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Normal Tab End

                // Button Active Tab Start
                $this->start_controls_tab(
                    'switcher_button_active_tab',
                    [
                        'label' => __( 'Active', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'switcher_button_active_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span.htb-active,{{WRAPPER}} .amo-switcher-nav span.htb-active' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-switcher-nav span.htb-active svg path' => 'fill: {{VALUE}};',
                            ],
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'switcher_button_active_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-switcher-nav span.htb-active, {{WRAPPER}} .amo-switcher-nav span.htb-active::before,{{WRAPPER}} input:checked+.amo-switche-toggle-slider',
                        ]
                    );

                    $this->add_control(
                        'switcher_button_toggle_active_color',
                        [
                            'label' => __( 'Toggle Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-toggle input:checked+.amo-switche-toggle-slider:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-2"
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'switcher_button_active_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-switcher-nav span.htb-active',
                            'condition'   => [
                                'amokit_switcher_layout_style' => "layout-1"
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'switcher_button_active_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-switcher-nav span.htb-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .amo-switcher-nav span.htb-active::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ]
                        ]
                    );

                $this->end_controls_tab(); // Button Active Tab End

            $this->end_controls_tabs();

        $this->end_controls_section();
        
        // Style Content tab section
        $this->start_controls_section(
            'amokit_switcher_content_style_section',
            [
                'label' => __( 'Content', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
           
            $this->add_control(
                'switcher_content_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area .amo_switcher_content' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content' => 'color: {{VALUE}};',
                    ],
                    'decsription' =>__( 'Only for custom content.', 'amokit-addons' ),
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'switcher_content_typography',
                    'selector' => '{{WRAPPER}} .amo-switcher-area .amo_switcher_content,{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content',
                    'decsription' =>__( 'Only for custom content.', 'amokit-addons' ),
                ]
            );

            $this->add_responsive_control(
                'switcher_content_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area .amo-single-switch' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],                ]
            );

            $this->add_responsive_control(
                'switcher_content_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area .amo-single-switch' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'switcher_content_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-switcher-area .amo-single-switch,{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'switcher_content_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-switcher-area .amo-single-switch,{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content',
                ]
            );

            $this->add_responsive_control(
                'switcher_content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-switcher-area .amo-single-switch' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-switcher-toggle-area .amo_switcher_content' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $sectionid =  $this-> get_id();
        $active_item = $settings['amokit_active_switcher'];
        if( 'layout-1' == $settings['amokit_switcher_layout_style']):
            $this->add_render_attribute( 'amokit_switcher_attr', 'class', 'amokit-switcher-area' );
            $active_item = ('active2' == $active_item ) ? 'active2' : 'active1';
            ?>
                <div <?php echo $this->get_render_attribute_string( 'amokit_switcher_attr' ); ?>>
                    <!-- Switcher Menu area start  -->
                    <div class="amo-switcher-btn">
                        <div class="amo-switcher-nav htb-nav" role="tablist">
                            <span class="htb-nav-link switcher_one_icon <?php echo ( 'active1' == $active_item ) ? ' htb-active htb-show' : ''; ?>" data-toggle="htbtab" data-target="#switcherone<?php echo esc_attr( $sectionid ); ?>">
                                <?php
                                    if( $settings['switcher_one_icon']['value'] != ''){
                                        echo AmoKit_Icon_manager::render_icon( $settings['switcher_one_icon'], [ 'aria-hidden' => 'true' ] ).esc_html( $settings['switch_one_title'] );
                                    }else{
                                        echo esc_html( $settings['switch_one_title'] );
                                    }
                                ?>
                            </span>
                            <span class="htb-nav-link switcher_two_icon <?php echo ( 'active2' == $active_item ) ? ' htb-active htb-show' : ''; ?>" data-toggle="htbtab" data-target="#switchertwo<?php echo esc_attr( $sectionid ); ?>">
                                <?php
                                    if( $settings['switcher_two_icon']['value'] != ''){
                                        echo AmoKit_Icon_manager::render_icon( $settings['switcher_two_icon'], [ 'aria-hidden' => 'true' ] ).esc_html( $settings['switch_two_title'] );
                                    }else{
                                        echo esc_html( $settings['switch_two_title'] );
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <!-- Switcher Menu area End  -->

                    <!-- Switcher Content area Start  -->
                    <div class="ht-tab-content htb-tab-content htb-sid-<?php echo esc_attr( $sectionid ); ?>">

                        <!-- Start Single Tab -->
                        <div class="amo-single-switch htb-fade htb-tab-pane <?php echo ( 'active1' == $active_item ) ? ' htb-active htb-show' : ''; ?>" id="switcherone<?php echo esc_attr( $sectionid ); ?>" role="tabpanel">
                            <?php
                                if ( $settings['switcher_one_content_source'] == "elementor" && !empty( $settings['switcher_one_template_id'] ) ) {
                                    echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['switcher_one_template_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                                else {
                                    echo '<div class="amo_switcher_content">'.wp_kses_post( $settings['switcher_one_custom_content'] ).'</div>';
                                }
                            ?>
                        </div>
                        <!-- End Tab A Tab -->

                        <!-- Start tab B Single Tab -->
                        <div class="amo-single-switch htb-fade htb-tab-pane <?php echo ( 'active2' == $active_item ) ? ' htb-active htb-show' : ''; ?>" id="switchertwo<?php echo esc_attr( $sectionid ); ?>" role="tabpanel">
                            <?php
                                if ( $settings['switcher_two_content_source'] == "elementor" && !empty( $settings['switcher_two_template_id'] ) ) {
                                    echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['switcher_two_template_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                                else {
                                    echo '<div class="amo_switcher_content">'.wp_kses_post( $settings['switcher_two_custom_content'] ).'</div>';
                                }
                            ?>
                        </div>
                        <!-- End Tab B Tab -->
                    </div>
                    <!-- Switcher Content area End  -->
                </div>
            <?php
        else:
            $this->add_render_attribute( 'amokit_switcher_toggle_attr', 'class', 'amokit-switcher-toggle-area' );

            $active_item = ( 'active1' == $active_item ) ? 'active1' : 'active2';
            ?>
                <div <?php echo $this->get_render_attribute_string( 'amokit_switcher_toggle_attr' ); ?>>
                    <div class="amo-switcher-toggle">
                        <span class="amo-switcher-toggle-title">
                            <?php
                                if( $settings['switcher_one_icon']['value'] != ''){
                                    echo AmoKit_Icon_manager::render_icon( $settings['switcher_one_icon'], [ 'aria-hidden' => 'true' ] ).esc_html( $settings['switch_one_title'] );
                                }else{
                                    echo esc_html( $settings['switch_one_title'] );
                                }
                            ?>
                        </span>
                        <label class="amo-switch-toggle sid-<?php echo esc_attr( $sectionid ); ?>">
                            <input type="checkbox" <?php echo ( 'active2' == $active_item ) ? 'checked="checked"' : ''; ?> >
                            <span class="amo-switche-toggle-slider"></span>
                        </label>
                        <span class="amo-switcher-toggle-title">
                            <?php
                                if( $settings['switcher_two_icon']['value'] != ''){
                                    echo AmoKit_Icon_manager::render_icon( $settings['switcher_two_icon'], [ 'aria-hidden' => 'true' ] ).esc_html( $settings['switch_two_title'] );
                                }else{
                                    echo esc_html( $settings['switch_two_title'] );
                                }
                            ?> 
                        </span>             
                    </div>
                    <div class="amo-switcher-toggle-content htb-sid-<?php echo esc_attr( $sectionid ); ?>">
                        <!-- Start Single Tab -->
                        <div class="amo-single-toggle-switch htb-fade toggle-tab-pane toggl-active" id="switchertglone-<?php echo esc_attr( $sectionid ); ?>" role="tabpanel">
                            <?php
                                if ( $settings['switcher_one_content_source'] == "elementor" && !empty( $settings['switcher_one_template_id'] ) ) {
                                    echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['switcher_one_template_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                                else {
                                    echo '<div class="amo_switcher_content">'.wp_kses_post( $settings['switcher_one_custom_content'] ).'</div>';
                                }
                            ?>
                        </div>
                        <!-- End Tab A Tab -->

                        <!-- Start tab B Single Tab -->
                        <div class="amo-single-toggle-switch htb-fade toggle-tab-pane" id="switchertgltwo-<?php echo esc_attr( $sectionid ); ?>" role="tabpanel">
                            <?php
                                if ( $settings['switcher_two_content_source'] == "elementor" && !empty( $settings['switcher_two_template_id'] ) ) {
                                    echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['switcher_two_template_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                                else {
                                    echo '<div class="amo_switcher_content">'.wp_kses_post( $settings['switcher_two_custom_content'] ).'</div>';
                                }
                            ?>
                        </div>
                        <!-- End Tab B Tab -->
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        var switcherTglOne ='#switchertglone-'+'<?php echo esc_js( $sectionid ); ?>';
                        var switcherTglTwo ='#switchertgltwo-'+'<?php echo esc_js( $sectionid ); ?>';
                        <?php if( 'active2' == $active_item ){ ?>
                        activeSwitcherContent(true);
                        <?php } else { ?>
                            activeSwitcherContent(false);
                        <?php
                        } ?>
                        $('.amo-switch-toggle.sid-<?php echo esc_js( $sectionid ); ?> input').on( 'click', function() {
                            activeSwitcherContent(this.checked);

                            // this option for switcher option two slider refress style option refresh added in widget active js
                            if ($('.htb-sid-<?php echo esc_js( $sectionid ); ?> .slick-slider').length > 0) {
                                $('.htb-sid-<?php echo esc_js( $sectionid ); ?>').find('.slick-slider').slick('refresh');
                            }
                        });

                        function activeSwitcherContent(status){
                            if(status){
                                $(switcherTglOne).removeClass('toggl-active htb-show');
                                $(switcherTglTwo).addClass('toggl-active htb-show');
                            }else{
                                $(switcherTglTwo).removeClass('toggl-active htb-show');
                                $(switcherTglOne).addClass('toggl-active htb-show');
                            } 
                        }

                    });
                </script>
            <?php 
        endif;
    }
}
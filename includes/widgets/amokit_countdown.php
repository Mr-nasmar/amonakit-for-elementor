<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Countdown extends Widget_Base {

    public function get_name() {
        return 'amokit-countdown-addons';
    }
    
    public function get_title() {
        return __( 'Countdown', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-countdown';
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
            'amokit-countdown',
            'amokit-widgets-scripts',
        ];
    }

    public function get_event_list() {

        if( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
            $event_item = get_posts(array(
                'fields'         => 'ids',
                'posts_per_page' => -1,
                'post_type'      => \Tribe__Events__Main::POSTTYPE,
            ));

            $event_items = ['0' => __( 'Select Event', 'amokit-addons' ) ];

            foreach ($event_item as $key => $value) {
                $event_items[$value] = get_the_title($value);
            }

            wp_reset_postdata();
        } else {
            $event_items = ['0' => __( 'Event Calendar Not Installed', 'amokit-addons' ) ];
        }
        return $event_items;
    }
    public function get_keywords() {
        return ['countndown', 'counter', 'event countdown', 'upcomming', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/countdown-widget/';
    }
    protected function register_controls() {

        // Start Date option tab 
        $this->start_controls_section(
            'countdown_content',
            [
                'label' => __( 'Countdown', 'amokit-addons' ),
            ]
        );
        
            $this->add_control(
                'show_event_list',
                [
                    'label'   => __( 'Event Countdown', 'amokit-addons' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'event_id',
                [
                    'label'       => __( 'Event List', 'amokit-addons' ),
                    'type'        => Controls_Manager::SELECT,
                    'options'     => $this->get_event_list(),
                    'default'     => '0',
                    'condition'=>[
                        'show_event_list'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'amokit_count_style',
                [
                    'label'          => __( 'Style', 'amokit-addons' ),
                    'type'           => 'amokit-preset-select',
                    'default'        => '1',
                    'options'        => [
                        '1' => __( 'Style one', 'amokit-addons' ),
                        '2' => __( 'Style Two', 'amokit-addons' ),
                        '3' => __( 'Style Three', 'amokit-addons' ),
                        'flip' => __( 'Style Four (Flip)', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'target_date',
                [
                    'label'       => __( 'Due Date', 'amokit-addons' ),
                    'type'        => Controls_Manager::DATE_TIME,
                    'picker_options'=>array(
                        'dateFormat' =>"Y/m/d",
                    ),
                    'default'     => gmdate( 'Y/m/d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
                    'condition'=>[
                        'show_event_list!'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'counter_timing_heading',
                [
                    'label' => __( 'Time Setting', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'count_down_days',
                [
                    'label'        => __( 'Day', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_hours',
                [
                    'label'        => __( 'Hours', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_miniute',
                [
                    'label'        => __( 'Minutes', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_second',
                [
                    'label'        => __( 'Seconds', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'counter_lavel_heading',
                [
                    'label' => __( 'Label Setting', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'count_down_labels',
                [
                    'label'        => __( 'Hide Label', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'no',
                ]
            );

            $this->add_control(
                'custom_labels',
                [
                    'label'        => __( 'Custom Label', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'condition'   => [
                        'count_down_labels!' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_days',
                [
                    'label'       => __( 'Days', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Days', 'amokit-addons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_days'    => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_hours',
                [
                    'label'       => __( 'Hours', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Hours', 'amokit-addons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_hours'   => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_minutes',
                [
                    'label'       => __( 'Minutes', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Minutes', 'amokit-addons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_miniute' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_seconds',
                [
                    'label'       => __( 'Seconds', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Seconds', 'amokit-addons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_second'  => 'yes',
                    ],
                ]
            );

        $this->end_controls_section(); // Date Optiin end

        // Event Button
        $this->start_controls_section(
            'countdown_event_button',
            [
                'label' => __( 'Event Button', 'amokit-addons' ),
                'condition'=>[
                    'show_event_list'=>'yes',
                ]
            ]
        );
            
            $this->add_control(
                'button_text',
                [
                    'label' => __( 'Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=>__('Details','amokit-addons'),
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );

        $this->end_controls_section(); // Date Optiin end

        // Content Layout
        $this->start_controls_section(
            'countdown_layout',
            [
                'label' => __( 'Count Layout', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            
            $this->add_responsive_control(
                'column_width',
                [
                    'label'   => __( 'Column Width', 'amokit-addons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => 139,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ '%', 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} span.ht-count' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'   => [
                        'amokit_count_style' => ['1', 'flip'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'column_height',
                [
                    'label'   => __( 'Column Height', 'amokit-addons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => 'px',
                        'size' => 185,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ '%', 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} span.ht-count' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner .amo-top' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'   => [
                        'amokit_count_style' => ['1', 'flip'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_down_specing',
                [
                    'label' => __( 'Column Spacing', 'amokit-addons' ),
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
                        'size' => 22,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox .ht-count' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-flash-flip-countdown-timer .ht-countdown-flip .amo-time' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_countdown_style',
            [
                'label' => __( 'Count Area', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} span.ht-count',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'counter_background_daly_heading',
                [
                    'label' => esc_html__( '1. Background Days', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ],
                    'separator' => 'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background_daly_flip',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-flash-flip-countdown-timer .ht-countdown .amo-days .ht-count',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ],
                ]
            );

            $this->add_control(
                'counter_background_hours_heading',
                [
                    'label' => esc_html__( '2. Background Hours', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background_hours_flip',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-flash-flip-countdown-timer .ht-countdown .amo-hours .ht-count',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ],
                ]
            );

            $this->add_control(
                'counter_background_minutes_heading',
                [
                    'label' => esc_html__( '3. Background Minutes', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background_minutes_flip',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-flash-flip-countdown-timer .ht-countdown .amo-mins .ht-count',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ],
                ]
            );

            $this->add_control(
                'counter_background_seconds_heading',
                [
                    'label' => esc_html__( '4. Background Seconds', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background_seconds_flip',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-flash-flip-countdown-timer .ht-countdown .amo-secs .ht-count',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'counter_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} span.ht-count, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'countborder',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} span.ht-count',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'countborder_flip',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner',
                    'condition'=>[
                        'amokit_count_style'=> 'flip',
                    ]
                ]
            );
            

            $this->add_responsive_control(
                'count_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} span.ht-count' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'countpadding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} span.ht-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'countmargin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} span.ht-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'itemaligntitle',
                [
                    'label' => __( 'Item Alignment', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-countbox' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .ht-countdown-flip' => 'justify-content: {{VALUE}};',
                    ],
                    'prefix_class' => 'amokit-item-align%s-',
                    'default' => '',
                ]
            );

            $this->add_responsive_control(
                'aligntitle',
                [
                    'label' => __( 'Content Alignment', 'amokit-addons' ),
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
                        '{{WRAPPER}} span.ht-count' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'amokit-count-align%s-',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'counter_separator',
                [
                    'label'        => __( 'Counter separator', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'count_seperator_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#5e5b60',
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox .ht-count::before' => 'color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'counter_separator'=>'yes',
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'count_seperator_image',
                [
                    'label' => esc_html__( 'Choose Area Seperator Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition'=>[
                        'counter_separator'=>'yes',
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            
            $this->add_responsive_control(
                'count_timer_separator_position',
                [
                    'label' => esc_html__( 'Separator Position', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox .ht-count::before' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'counter_separator' => 'yes',
                        'amokit_count_style'=> ['1', '2', '3'],
                    ],
                ]
            );

        $this->end_controls_section(); // Section style tab end

        // Timer style tab start
        $this->start_controls_section(
            'amokit_countdown_time_style',
            [
                'label'     => __( 'Timer', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'count_timer_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#242424',
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span.time-count' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner .ht-count' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'count_timer_typography',
                    'selector' => '{{WRAPPER}} .amo-countbox span.time-count, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-time-inner .ht-count',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'count_timer_shadow',
                    'label' => __( 'Text Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-countbox span.time-count',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'count_timer_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-countbox span.time-count',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'count_timer_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-countbox span.time-count',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'count_timer_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span.time-count' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'count_timer_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span.time-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_responsive_control(
                'count_timer_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span.time-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'counter_timer_separator',
                [
                    'label'        => __( 'Timer separator', 'amokit-addons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                    'condition'=>[
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
                
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'count_timer_separator_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-countbox span.time-count::before',
                    'condition'=>[
                        'counter_timer_separator' => 'yes',
                        'amokit_count_style'=> ['1', '2', '3'],
                    ]
                ]
            );

            $this->add_control(
                'count_timer_separator_background_width',
                [
                    'label' => esc_html__( 'Separator Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 80,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span.time-count::before' => 'background-size: {{SIZE}}{{UNIT}} auto;',
                    ],
                    'condition'=>[
                        'counter_timer_separator' => 'yes',
                        'amokit_count_style'=> ['1', '2', '3'],
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Timer style tab end

        // Style tab section
        $this->start_controls_section(
            'amokit_countdown_label_style',
            [
                'label' => __( 'Label', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'count_down_labels!' => 'yes',
                ],
            ]
        );
            $this->add_control(
                'count_lavel_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#242424',
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span span.count-inner p' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'count_lavel_typography',
                    'selector' => '{{WRAPPER}} .amo-countbox span span.count-inner p, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'count_lavel_shadow',
                    'label' => __( 'Text Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-countbox span span.count-inner p, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'count_lavel_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-countbox span span.count-inner p, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'count_lavel_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-countbox span span.count-inner p, {{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span span.count-inner p' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span span.count-inner p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-countbox span span.count-inner p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .ht-countdown-flip .amo-time .amo-label p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Label style tab end

        // Style tab section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __( 'Button Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_event_list'=>'yes',
                ]
            ]
        );

            $this->start_controls_tabs( 'button_style_tabs' );
            
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
                            'selector' => '{{WRAPPER}} .amo_event_button a',
                        ]
                    );

                    $this->add_control(
                        'button_text_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'button_background_color',
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .amo_event_button a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'selector' => '{{WRAPPER}} .amo_event_button a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(), [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'placeholder' => '1px',
                            'default' => '1px',
                            'selector' => '{{WRAPPER}} .amo_event_button a',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Button style End

                // Hover Button style End
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'button_hover_text_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'button_hover_background_color',
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .amo_event_button a:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_hover_box_shadow',
                            'selector' => '{{WRAPPER}} .amo_event_button a:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(), [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'placeholder' => '1px',
                            'default' => '1px',
                            'selector' => '{{WRAPPER}} .amo_event_button a:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'button_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo_event_button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $sectionid =  "htmaga-". $this-> get_id();
        $settings   = $this->get_settings_for_display();
        $data_options = [];

        if( $settings['show_event_list'] == 'yes' && function_exists('tribe_get_start_date') ){
            $data_options['amokitdate']  =  tribe_get_start_date ( absint( $settings['event_id'] ), false,  'Y/m/d' );
        }else{ 
            $data_options['amokitdate'] = isset( $settings['target_date'] ) ? esc_attr( $settings['target_date'] ) : gmdate( 'Y/m/d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );
        }

        // Hide Countdownload item
        $data_options['style']      = sanitize_text_field( $settings['amokit_count_style'] );
        $data_options['lavelhide']      = sanitize_text_field( $settings['count_down_labels'] );
        $data_options['amokitday']      = sanitize_text_field( $settings['count_down_days'] );
        $data_options['amokithours']    = sanitize_text_field( $settings['count_down_hours'] );
        $data_options['amokitminiute']  = sanitize_text_field( $settings['count_down_miniute'] );
        $data_options['amokitsecond']   = sanitize_text_field( $settings['count_down_second'] );

        // Custom Label
        $data_options['amokitdaytxt'] = ! empty( $settings['customlabel_days'] ) ? sanitize_text_field( $settings['customlabel_days'] ) : esc_html__( 'Days', 'amokit-addons' );
        $data_options['amokithourtxt'] = ! empty( $settings['customlabel_hours'] ) ? sanitize_text_field( $settings['customlabel_hours'] ) : esc_html__( 'Hours', 'amokit-addons' );
        $data_options['amokitminutestxt'] = ! empty( $settings['customlabel_minutes'] ) ? sanitize_text_field( $settings['customlabel_minutes'] ) : esc_html__( 'Minutes', 'amokit-addons' );
        $data_options['amokitsecondstxt'] = ! empty( $settings['customlabel_seconds'] ) ? sanitize_text_field( $settings['customlabel_seconds'] ) : esc_html__( 'Seconds', 'amokit-addons' );
        
        $this->add_render_attribute( 'countdown_wrapper_attr', 'class', 'amokit-countdown-wrapper ' . esc_attr( $sectionid ) );
        $this->add_render_attribute( 'countdown_wrapper_attr', 'class', 'amokit-countdown-style-'. esc_attr( $settings['amokit_count_style'] ) );

        if( $settings['counter_timer_separator'] != 'yes' ){
            $this->add_render_attribute( 'countdown_wrapper_attr', 'class', 'amokit-timer-separate-no' );
        }
        if( $settings['counter_separator'] != 'yes' ){
            $this->add_render_attribute( 'countdown_wrapper_attr', 'class', 'amokit-separate-no' );
        }
        if( $settings['count_down_labels'] == 'yes' ){
            $this->add_render_attribute( 'countdown_wrapper_attr', 'class', 'amokit-hide-lavel' );
        }

        if(isset($settings['count_seperator_image']['url']) &&  $settings['count_seperator_image']['url'] != ''){
            $count_area_seperator = "url('" . esc_url( $settings['count_seperator_image']['url'] ). "')";
        }else{
            $count_area_seperator =":";
        }

        $countdownClassOne = '';
        $countdownClassTwo = '';
        if($settings['amokit_count_style'] == 'flip'){
            $countdownClassOne = 'amokit-flash-flip-countdown-timer';
            $countdownClassTwo = 'ht-countdown ht-countdown-flip';
        }else{
            $countdownClassOne = 'amokit-countbox';
            $countdownClassTwo = '';
        }

        ?>
            <div <?php echo $this->get_render_attribute_string( 'countdown_wrapper_attr' ); ?> >
                <div class="amo-box-timer">
                    <div class="<?php echo esc_attr( $countdownClassOne ) ?>">
                        <?php
                            echo '<div class="'.esc_attr( $countdownClassTwo ).'"data-countdown=\'' . esc_attr( htmlspecialchars( wp_json_encode( $data_options ) ) ) . '\' ></div>';
                        ?>
                        
                        <?php if( $settings['show_event_list'] == 'yes' && $settings['event_id'] != 0 ):?>
                            <div class="amo_event_button">
                                <a class="elementor-button" href="<?php echo esc_url( get_permalink( $settings['event_id'] ) );?>">
                                    <?php
                                        if( !empty( $settings['button_icon']['value'] ) ){
                                            echo AmoKit_Icon_manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                                        } 
                                        if( !empty( $settings['button_text'] ) ){
                                            echo wp_kses_post( $settings['button_text'] );
                                        }
                                    ?>
                                </a>
                            </div>
                        <?php endif;?>
                    </div>
                </div>

            </div>

            <?php if($settings['counter_separator'] == 'yes'): ?>
                <style><?php echo esc_html( '.'.$sectionid ) ?> .amo-countbox .ht-count::before{ content: <?php echo amokit_kses_desc($count_area_seperator) ?>;}</style>
           <?php endif;
    }

}

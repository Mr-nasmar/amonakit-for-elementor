<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_VideoPlayer extends Widget_Base {

    public function get_name() {
        return 'amokit-videoplayer-addons';
    }
    public function get_title() {
        return __( 'Video Player', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-play';
    }

    public function get_style_depends() {
        return [
            'ytplayer',
            'magnific-popup',
            'amokit-widgets',
        ];
    }
    public function get_script_depends() {
        return [
            'ytplayer',
            'magnific-popup',
            'amokit-widgets-scripts',
        ];
    }
    public function get_categories() {
        return [ 'amokit-addons' ];
    }
    public function get_keywords() {
        return ['amokit', 'Amona Kit', 'video', 'video player', 'button', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/video-player-widget/';
    }
    protected function register_controls() {
        $this->start_controls_section(
            'videoplayer_content',
            [
                'label' => __( 'Video Player', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'videocontainer',
                [
                    'label' => __( 'Video Container', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'self',
                    'options' => [
                        'self'         => __( 'Self', 'amokit-addons' ),
                        'popup'         => __( 'Pop Up', 'amokit-addons' ),
                    ],
                ]
            );
            $this->add_control(
                'video_url',
                [
                    'label'     => __( 'Video Url', 'amokit-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'https://www.youtube.com/watch?v=z_9Z9VWhaEQ', 'amokit-addons' ),
                    'placeholder' => __( 'https://www.youtube.com/watch?v=z_9Z9VWhaEQ', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'buttontext',
                [
                    'label'     => __( 'Button Text', 'amokit-addons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'Pop Up Button', 'amokit-addons' ),
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                ]
            );
            $this->add_control(
                'buttonicon_type',
                [
                    'label' => esc_html__( 'Play Button Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'icon' => esc_html__( 'Icon', 'amokit-addons' ),
                        'image' => esc_html__( 'Image', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],             
                ]
            );

            $this->add_control(
                'buttonicon_image',
                [
                    'label' => __( 'Icon Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'buttonicon_type' => 'image',
                        'videocontainer' =>'popup',
                    ]
                ]
            );
            $this->add_control(
                'buttonicon',
                [
                    'label' => __( 'Button Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'buttonicon_type' => 'icon',
                        'videocontainer' =>'popup',
                    ]
                ]
            );
            $this->add_control(
                'controleranimation',
                [
                    'label' => __( 'Button Infinity Animation', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'yes' => __( 'Yes', 'amokit-addons' ),
                    'no' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                ]
            );
            $this->add_control(
                'video_image',
                [
                    'label' => __( 'Video Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' =>[
                        'videocontainer' =>'self',
                    ],
                ]
            );

        $this->end_controls_section();

        // Video Options
        $this->start_controls_section(
            'videoplayer_options',
            [
                'label' => __( 'Video Options', 'amokit-addons' ),
                'condition' =>[
                    'videocontainer' =>'self',
                ],
            ]
        );
            $this->add_control(
                'autoplay',
                [
                    'label' => __( 'Auto Play', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'soundmute',
                [
                    'label' => __( 'Sound Mute', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'repeatvideo',
                [
                    'label' => __( 'Repeat Video', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'controlerbutton',
                [
                    'label' => __( 'Show Controller Button', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'videosourselogo',
                [
                    'label' => __( 'Show video source Logo', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'videostarttime',
                [
                    'label' => __( 'Video Start Time', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_video_style_section',
            [
                'label' => __( 'Video Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'amokit_video_background',
                'label' => __( 'Background', 'amokit-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .amo-player-container',
            ]
        );
        $this->add_responsive_control(
            'amokit_video_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-player-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'amokit_video_border',
                'label' => __( 'Border', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .amo-player-container',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'amokit_video_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-player-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'amokit_videoshadow',
                'label' => __( 'Box Shadow', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .amo-player-container',
            ]
        );

            $this->add_responsive_control(
                'video_style_align',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'separator' =>'before',
                    'condition'=>[
                        'videocontainer' =>'popup', 
                    ]
                ]
            );

        $this->end_controls_section();

        // Style Button section
        $this->start_controls_section(
            'video_button_style',
            [
                'label' => __( 'Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'videocontainer' =>'popup',
                ],
            ]
        );
            $this->add_responsive_control(
                'video_button_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'height: {{VALUE}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'video_button_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'width: {{VALUE}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'video_button_fontsize',
                [
                    'label' => __( 'Font Size', 'amokit-addons' ),
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
                        'size' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-player-container .magnify-video-active svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'video_button_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-player-container .magnify-video-active svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'video_button_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );


            $this->add_control(
                'color_border_heading',
                [
                    'label' => __( 'Colors and Border', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs('video_button_style_tabs');
                $this->start_controls_tab(
                    'video_button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                $this->add_control(
                    'video_button_color',
                    [
                        'label' => __( 'Color', 'amokit-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#18012c',
                        'selectors' => [
                            '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .amo-player-container .magnify-video-active svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'video_button_background',
                        'label' => __( 'Background', 'amokit-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .amo-player-container .magnify-video-active',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'video_button_border',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-player-container .magnify-video-active',
                    ]
                );
                $this->add_responsive_control(
                    'video_button_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .amo-player-container .magnify-video-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );
                
            $this->end_controls_tab();// Normal Tab

            // Hover Tab
            $this->start_controls_tab(
                'video_button_style_hover_tab',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                ]
            );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'video_button_hover_border',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-player-container .magnify-video-active:hover',
                    ]
                );
                $this->add_responsive_control(
                    'video_button_border_hover_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .amo-player-container .magnify-video-active:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );
                $this->add_control(
                    'video_button_hover_color',
                    [
                        'label' => __( 'Color', 'amokit-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .amo-player-container .magnify-video-active:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .amo-player-container .magnify-video-active:hover svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'video_button_hover_background',
                        'label' => __( 'Background', 'amokit-addons' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .amo-player-container .magnify-video-active:hover',
                    ]
                );

            $this->end_controls_tabs(); // Hover tab end
        $this->end_controls_section();
        // Button animation style
        $this->start_controls_section(
            'video_button_animate_style',
            [
                'label' => __( 'Button Animation', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'videocontainer' =>'popup',
                    'controleranimation' =>'yes',
                ],
            ]
        );
        $this->add_control(
            'video_button_animation_color',
            [
                'label' => __( 'Border Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .amo-video-mark .amo-wave-pulse::after, {{WRAPPER}} .amo-video-mark .amo-wave-pulse::before' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_animate_circle_range',
            [
                'label' => __( 'Circle Range', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-video-mark .amo-wave-pulse::after, 
                    {{WRAPPER}} .amo-video-mark .amo-wave-pulse::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $buttonicon_type =  isset( $settings['buttonicon_type'] ) ? esc_attr( $settings['buttonicon_type'] ) : 'icon';
        $buttonicon_image =  isset( $settings['buttonicon_image']['url'] ) ? esc_url( $settings['buttonicon_image']['url'] ) : '';
        $controleranimation =  !empty( $settings['controleranimation'] ) ? $settings['controleranimation'] : 'no';

        $this->add_render_attribute( 'amokit_button', 'class', 'amokit-button' );

        if( $settings['videocontainer'] == 'self' ){
            $player_options_settings = [
                'videoURL'          => !empty( $settings['video_url'] ) ? esc_url( $settings['video_url'] ) : 'https://www.youtube.com/watch?v=z_9Z9VWhaEQ',
                'coverImage'        => !empty( $settings['video_image']['url'] ) ? esc_url( $settings['video_image']['url'] ) : '',
                'autoPlay'          => ( $settings['autoplay'] == 'yes' ) ? true : false,
                'mute'              => ( $settings['soundmute'] == 'yes' ) ? true : false,
                'loop'              => ( $settings['repeatvideo'] == 'yes' ) ? true : false,
                'showControls'      => ( $settings['controlerbutton'] == 'yes' ) ? true : false,
                'showYTLogo'        => ( $settings['videosourselogo'] == 'yes' ) ? true : false,
                'startAt'           => floatval( $settings['videostarttime'] ),
                'containment'       => 'self',
                'opacity'           => 1,
                'optimizeDisplay'   => true,
                'realfullscreen'    => true,
            ];
        }
        $videocontainer = [
            'videocontainer' => isset( $settings['videocontainer'] ) ? esc_attr( $settings['videocontainer'] ) : '',
        ];
        
        $animation_markup = '';
        if( 'no' == $controleranimation ) {
            $animation_markup = "";
        } else { 
            $animation_markup = '<div class="amo-video-mark">
                <div class="amo-wave-pulse wave-pulse-1"></div>
                <div class="amo-wave-pulse wave-pulse-2"></div>
                </div>';
            }
        ?>
            <div class="amo-player-container" data-videotype="<?php echo esc_attr( wp_json_encode( $videocontainer ) ); ?>">
                <?php if($settings['videocontainer'] == 'self'): ?>
                    <div class="amo-video-player" data-property="<?php echo esc_attr( wp_json_encode( $player_options_settings ) ); ?> "></div>
                <?php else:
                    if( 'icon' == $buttonicon_type && $settings['buttonicon']['value'] != '' ){
                        echo sprintf('<a class="magnify-video-active" href="%1$s">%2$s %3$s %4$s</a>',esc_url( $settings['video_url'] ),AmoKit_Icon_manager::render_icon( $settings['buttonicon'], [ 'aria-hidden' => 'true' ] ), amokit_kses_title($settings['buttontext'] ), $animation_markup );
                    } elseif ('image' == $buttonicon_type && $buttonicon_image != '' ){
                        
                        echo sprintf( '<a class="magnify-video-active" href="%1$s"><img src="%2$s" alt="amokit-addons"> %3$s %4$s </a>', esc_url( $settings['video_url'] ), $buttonicon_image, amokit_kses_title( $settings['buttontext'] ), $animation_markup );

                    } else {
                        echo sprintf('<a class="magnify-video-active" href="%1$s">%2$s %3$s</a>', esc_url( $settings['video_url'] ), amokit_kses_title( $settings['buttontext'] ), $animation_markup );
                    }
                ?>
                <?php endif;?>
            </div>
        <?php
    }
}
<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Audio_Player extends Widget_Base {

    public function get_name() {
        return 'amokit-audio-player-addons';
    }
    
    public function get_title() {
        return __( 'Audio Player', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-user-preferences';
    }
    public function get_categories() {
        return [ 'amokit-addons' ];
    }
    public function get_style_depends(){
        return [
            'wp-mediaelement',
            'amokit-audio-player'
        ];
    }
    public function get_script_depends() {
        return [
            'wp-mediaelement',
            'amokit-audio-player'
        ];
    }
    public function get_keywords() {
        return ['audio player', 'player', 'mp3', 'audio', 'songs','amokit', 'Amona Kit', 'song','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'audio_player_content_source',
            [
                'label' => __( 'Audio Player', 'amokit-addons' ),
            ]
        );

		$this->add_control(
			'audio_player_source',
			[
				'label' => esc_html__('Source', 'amokit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'selfhosted',
				'options' => [
					'selfhosted' => esc_html__('Self Hosted', 'amokit-addons'),
					'remote' => esc_html__('External', 'amokit-addons'),
				],
			]
		);

		$this->add_control(
			'audio_selfhosted_url',
			[
				'label' => esc_html__('Upload Media', 'amokit-addons'),
				'type'  => Controls_Manager::MEDIA,
				'description' => esc_html__('Support MP3 audio format', 'amokit-addons'),
				'media_type' => ['audio'],
				'condition' => [
					'audio_player_source' => 'selfhosted',
				],
			]
		);

		$this->add_control(
			'audio_remote_url',
			[
				'label' => esc_html__('Remote URL', 'amokit-addons'),
				'label_block' => true,
				'placeholder' => esc_html__('Enter remote audio URL', 'amokit-addons'),
				'description' => esc_html__('Input a valid audio url', 'amokit-addons'),
				'type'  => Controls_Manager::TEXT,
				'condition' => [
					'audio_player_source' => 'remote',
				],
			]
		);

            $this->add_control(
                'audio_poster_image',
                [
                    'label' => __( 'Poster Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'poster_image_size',
                    'default' => 'large',
                    'separator' => 'none',
					'condition'=>[
						'audio_poster_image[url]!'=>'',
					]
                ]
            );

            $this->add_control(
                'audio_title',
                [
                    'label' => __( 'Title', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block'=> true,
                    'placeholder' => __( 'Audio Title', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'audio_description',
                [
                    'label' => __( 'Description', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Audio Description', 'amokit-addons' ),
                ]
            );
            
			$this->add_control(
				'audio_player_image_positionp',
				[
					'label' => esc_html__('Image Position On', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
					'type' => Controls_Manager::CHOOSE,
					'default' => 'column',
					'options' => [
						'column' => [
                            'title' => __('Top', 'amokit-addons'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'row' => [
                            'title' => __('Left', 'amokit-addons'),
                            'icon' => 'eicon-h-align-left',
                        ],

                        'row-reverse' => [
                            'title' => __('Right', 'amokit-addons'),
                            'icon' => 'eicon-h-align-right',
                        ],
						'column-reverse' => [
                            'title' => __('Right', 'amokit-addons'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
					'toggle' => false,
					'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-info' => 'flex-direction: column;',
                    ],
					'classes' => 'amokit-disable-control',
					'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                            'terms' => [
                                    ['name' => 'audio_poster_image[url]', 'operator' => '!==', 'value' => ''],
									['name' => 'audio_title', 'operator' => '!==', 'value' => ''],
                                ]
                            ],
                            [
                            'terms' => [
								['name' => 'audio_poster_image[url]', 'operator' => '!==', 'value' => ''],
								['name' => 'audio_description', 'operator' => '!==', 'value' => '']
                                ]
                            ],
                        ]  
					]  
				]
			);
			$this->add_responsive_control(
				'audio_player_image_position_gap',
				[
					'label' => esc_html__('Inner Space', 'amokit-addons'),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px', 'em', 'rem'],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => '20',
						'unit' => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} .amo-audio-player-info'	=> 'gap: {{SIZE}}{{UNIT}}'
					],
					'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                            'terms' => [
                                    ['name' => 'audio_poster_image[url]', 'operator' => '!==', 'value' => ''],
									['name' => 'audio_title', 'operator' => '!==', 'value' => ''],
                                ]
                            ],
                            [
                            'terms' => [
								['name' => 'audio_poster_image[url]', 'operator' => '!==', 'value' => ''],
								['name' => 'audio_description', 'operator' => '!==', 'value' => '']
                                ]
                            ],
                        ]  
					]  
				]
			);


			$this->add_control(
				'audio_player_positionp',
				[
					'label' => esc_html__('Player Position On', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
					'type' => Controls_Manager::CHOOSE,
					'default' => 'column',
					'options' => [
						'column-reverse' => [
                            'title' => __('Top', 'amokit-addons'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'row-reverse' => [
                            'title' => __('Left', 'amokit-addons'),
                            'icon' => 'eicon-h-align-left',
                        ],

                        'row' => [
                            'title' => __('Right', 'amokit-addons'),
                            'icon' => 'eicon-h-align-right',
                        ],
						'column' => [
                            'title' => __('Bottom', 'amokit-addons'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
					'toggle' => false,
					'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-wrapper' => 'flex-direction: column;',
                    ],
					'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            ['name' => 'audio_poster_image[url]', 'operator' => '!=', 'value' => ''],
                            ['name' => 'audio_title', 'operator' => '!==', 'value' => ''],
                            ['name' => 'audio_description', 'operator' => '!==', 'value' => ''],
                        ]
                    ],
					'classes' => 'amokit-disable-control',
				]
			);
			$this->add_responsive_control(
				'audio_player_gap',
				[
					'label' => esc_html__('Inner Space', 'amokit-addons'),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px', 'em', 'rem'],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => '30',
						'unit' => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} .amo-audio-player-wrapper'	=> 'gap: {{SIZE}}{{UNIT}}'
					],
					'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            ['name' => 'audio_poster_image[url]', 'operator' => '!=', 'value' => ''],
                            ['name' => 'audio_title', 'operator' => '!==', 'value' => ''],
                            ['name' => 'audio_description', 'operator' => '!==', 'value' => ''],
                        ]
                    ],
				]
			);
        $this->end_controls_section();
        // additional settings
        $this->start_controls_section(
            'audio_additional_settings',
            [
                'label' => __( 'Additional Settings', 'amokit-addons' ),
            ]
        );
		$this->add_control(
			'audio_player_autoplay',
			[
				'label' => esc_html__('Autoplay', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'audio_player_loop',
			[
				'label' => esc_html__('Loop', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'audio_player_muted',
			[
				'label' => esc_html__('Muted', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);
		// controll options
		$this->add_control(
			'audio_player_playpause',
			[
				'label' => esc_html__('Play/Pause', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'audio_player_display_optin_heading',
			[
				'label' => __( 'Display Options', 'amokit-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'audio_player_progress',
			[
				'label' => esc_html__('Progress Bar', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'audio_player_current',
			[
				'label' => esc_html__('Current Time', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'audio_player_duration',
			[
				'label' => esc_html__('Total Duration', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'audio_player_volume',
			[
				'label' => esc_html__('Volume Bar', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
			]
		);

		$this->add_control(
			'audio_player_hide_volume_touch_devices',
			[
				'label' => esc_html__('Hide Volume On Touch Devices', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
				'condition' => [
					'audio_player_volume' => ['yes']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_slider_layout',
			[
				'label' => esc_html__('Volume Slider Layout', 'amokit-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__('Horizontal', 'amokit-addons'),
					'vertical' => esc_html__('Vertical (pro)', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				],
				'condition' => [
					'audio_player_volume' => ['yes']
				],
			]
		);
		amokit_pro_notice( $this,'audio_player_volume_slider_layout', 'vertical', Controls_Manager::RAW_HTML );
		$this->add_control(
			'audio_player_start_volume',
			[
				'label' => esc_html__('Start Volume', 'amokit-addons'),
				'description' => esc_html__('Initial volume when the player starts.', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0.6,
				],
			]
		);

		$this->add_control(
			'audio_restrict_time',
			[
				'label' => esc_html__('Start Time (seconds)', 'amokit-addons'),
				'description' => esc_html__('Specify the starting time for the audio playback.', 'amokit-addons'),
				'type' => Controls_Manager::NUMBER,
			]
		);
		$this->end_controls_section();

		// pro features
		$this->start_controls_section(
			'playericon_settings',
			[
				'label' => __( 'Player Icons', 'amokit-addons' ),
			]
		);
		$this->add_control(
			'player_custtom_icon_enable',
			[
				'label' => esc_html__('Custom Icons', 'amokit-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__('Yes', 'amokit-addons'),
				'label_off' => esc_html__('No', 'amokit-addons'),
				'return_value' => 'yes',
			]
		);
		amokit_pro_notice( $this,'player_custtom_icon_enable', 'yes', Controls_Manager::RAW_HTML );
		$this->add_control(
			'audio_player_play_iconp',
			[
				'label' => esc_html__('Play Icon', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				],
				'classes' => 'amokit-disable-control',
			]
		);

		$this->add_control(
			'audio_player_pause_iconp',
			[
				'label' => esc_html__('Pause Icon', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				],
				'classes' => 'amokit-disable-control',
			]
		);

		$this->add_control(
			'audio_player_replay_iconp',
			[
				'label' => esc_html__('Replay Icon', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				],
				'classes' => 'amokit-disable-control',
			]
		);

		$this->add_control(
			'audio_player_volume_unmute_iconp',
			[
				'label' => esc_html__('Unmute Icon', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				],
				'classes' => 'amokit-disable-control',
			]
		);

		$this->add_control(
			'audio_player_volume_mute_iconp',
			[
				'label' => esc_html__('Mute Icon', 'amokit-addons') . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				],
				'classes' => 'amokit-disable-control',
			]
		);


        $this->end_controls_section();
        // Style tab section
        $this->start_controls_section(
            'audio_player_style_section',
            [
                'label' => __( 'Audio Box', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'audio_player_section_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
					'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-wrapper,{{WRAPPER}} .amo-audio-player-info' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'audio_player_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'audio_player_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'audio_player_section_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-audio-player-wrapper',
                    'separator' =>'after',
                ]
            );
    
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'audio_player_section_border',
                    'label' => esc_html__('Border', 'amokit-addons'),
                    'selector' => '{{WRAPPER}} .amo-audio-player-wrapper',
                ]
            );
            $this->add_responsive_control(
                'audio_player_section_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player-wrapper' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
			$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'audio_player_section_box_shadow',
                    'label' => esc_html__('Box Shadow', 'amokit-addons'),
                    'selector' => '{{WRAPPER}} .amo-audio-player-wrapper',
                ]
            );
        $this->end_controls_section();
        // Style tab section
        $this->start_controls_section(
            'audio_player_box_section',
            [
                'label' => __( 'Audio Player', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'audio_player_box_width',
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
                        'size' => 100,
                        'unit' => '%',
                    ],
					'selectors' => [
						'{{WRAPPER}} .amo-audio-player' => 'width: {{SIZE}}{{UNIT}}!important;',
					],
				]
			); 
			$this->add_responsive_control(
				'audio_player_box_height',
					[
						'label' => __( 'Height', 'amokit-addons' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
								'step' => 1,
							],
						],
						'default' => [
							'size' => 40,
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .amo-audio-player.mejs-container, {{WRAPPER}} .mejs-container .mejs-controls' => 'height: {{SIZE}}{{UNIT}}!important;display:flex;align-items:center;',
						],
					]
				); 
            $this->add_responsive_control(
                'audio_player_box_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'audio_player_box_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls',
                    'separator' =>'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'audio_player_border',
                    'label' => esc_html__('Border', 'amokit-addons'),
                    'selector' => '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls',
                ]
            );
            $this->add_responsive_control(
                'audio_player_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
			$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'audio_player_box_shadow',
                    'label' => esc_html__('Box Shadow', 'amokit-addons'),
                    'selector' => '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls',
                ]
            );
			$this->add_responsive_control(
                'audio_player_box_align',
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
                        '{{WRAPPER}} .amo-audio-player.mejs-container .mejs-controls' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section(); // palyer style end

        // Style Title tab section
        $this->start_controls_section(
            'audio_info_section',
            [
                'label' => __( 'Audio Info', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'audio_title', 'operator' => '!==', 'value' => ''],
						['name' => 'audio_description', 'operator' => '!==', 'value' => ''],
					]
				],
            ]
        );
		$this->add_responsive_control(
			'audio_info_alignment',
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
					'{{WRAPPER}} .amo-audio-content' => 'text-align: {{VALUE}};',
				],
			]
		);
            $this->add_control(
                'audio_title_color',
                [
                    'label' => __( 'Title Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-title' => 'color: {{VALUE}};',
					],
					'condition'=>[
						'audio_title!'=>'',
					]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'audio_title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-audio-title',
					'condition'=>[
						'audio_title!'=>'',
					]
                ]
            );

            $this->add_responsive_control(
                'audio_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
					'condition'=>[
						'audio_title!'=>'',
					]
                ]
            );
			$this->add_control(
                'audio_info_description_heading',
                [
                    'label' => __( 'Description', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
					'condition'=>[
						'audio_description!'=>'',
					]
                ]
            );

			$this->add_control(
                'audio_description_color',
                [
                    'label' => __( ' Description Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-description' => 'color: {{VALUE}};',
					],
					'condition'=>[
						'audio_description!'=>'',
					]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'audio_description_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-audio-description',
					'condition'=>[
						'audio_description!'=>'',
					]
                ]
            );

            $this->add_responsive_control(
                'audio_description_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
					'condition'=>[
						'audio_description!'=>'',
					]
                ]
            );
        $this->end_controls_section();
        // images Style tab section
        $this->start_controls_section(
            'audio_image_style',
            [
                'label' => __( 'Image', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'audio_poster_image[url]!'=>'',
				]
            ]
        );
            
            $this->add_control(
                'audio_image_width',
                [
                    'label' => __( 'Width', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-thumb' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'audio_image_height',
                [
                    'label' => __( 'Height', 'amokit-addons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-thumb' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'audio_image_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'audio_image_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
					'exclude'=> ['image'],
                    'selector' => '{{WRAPPER}} .amo-audio-thumb',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'audio_image_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-audio-thumb',
					'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'audio_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-audio-thumb' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'audio_image_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-audio-thumb',
                ]
            );
            $this->add_responsive_control(
                'audio_image_align',
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
                        '{{WRAPPER}} .amo-audio-thumb' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Service Images style end
		// Play pause button section
		$this->start_controls_section(
			'audio_player_playpause_style_section',
			[
				'label' => esc_html__('Play/Pause Button', 'amokit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'audio_player_playpause' => ['yes']
				],
			]
		);

		$this->add_responsive_control(
			'audio_player_playpause_box-h_w',
			[
				'label' => esc_html__('Icon Box Heith/Width', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player .mejs-playpause-button'	=> 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		// pro feature
		$this->start_controls_tabs(
			'audio_player_playpause_style_tabs'
		);

		$this->start_controls_tab(
			'audio_player_playpause_normal_style_tab',
			[
				'label' => esc_html__('Normal', 'amokit-addons'),
			]
		);
// pro feartures
		$this->add_control(
			'audio_player_playpause_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .amokit-pro-player .mejs-playpause-button button' => 'color: {{VALUE}}',
				],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'audio_player_playpause_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-playpause-button' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'audio_player_playpause_box_shadow',
				'label' => esc_html__('Box Shadow', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-playpause-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_playpause_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-playpause-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'audio_player_playpause_hover_style_tab',
			[
				'label' => esc_html__('Hover', 'amokit-addons'),
			]
		);
// pro feature

		$this->add_control(
			'audio_player_playpause_bg_hover_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-playpause-button:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'audio_player_playpause_hover_box_shadow',
				'label' => esc_html__('Box Shadow', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-playpause-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_playpause_hover_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-playpause-button:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'audio_player_playpause_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-playpause-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'audio_player_playpause_margin',
			[
				'label' => esc_html__('Margin (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-playpause-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Progress bar section
		$this->start_controls_section(
			'audio_player_progress_bar_style_section',
			[
				'label' => esc_html__('Progress Bar', 'amokit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'audio_player_progress' => ['yes']
				],
			]
		);

		$this->add_responsive_control(
			'audio_player_progress_bar_height',
			[
				'label' => esc_html__('Height', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total'	=> 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'audio_player_progress_bar_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_progress_bar_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-time-total',
			]
		);

		$this->add_control(
			'audio_player_progress_bar_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total,
					{{WRAPPER}} .amo-audio-player .mejs-time-total .mejs-time-current,
					{{WRAPPER}} .amo-audio-player .mejs-time-total .mejs-time-loaded' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow:hidden',
				],
			]
		);

		$this->add_control(
			'audio_player_progress_bar_loaded_heading',
			[
				'label' => esc_html__('Loaded Progress Bar', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'audio_player_progress_bar_loaded_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total .mejs-time-loaded' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'audio_player_progress_bar_current_heading',
			[
				'label' => esc_html__('Current Progress Bar', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'audio_player_progress_bar_current_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total .mejs-time-current' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'audio_player_progress_bar_time_hover_heading',
			[
				'label' => esc_html__('Time Hover', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'audio_player_progress_bar_time_hover_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF00',
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time-total .mejs-time-hovered' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Time section
		$this->start_controls_section(
			'audio_player_time_style_section',
			[
				'label' => esc_html__('Time', 'amokit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'audio_player_current',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'audio_player_duration',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'audio_player_time_typography',
				'label' => __( 'Typography', 'amokit-addons' ),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-time span',
			]
		);


		$this->add_control(
			'audio_player_currenttime_heading',
			[
				'label' => esc_html__('Current Time', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'audio_player_current' => ['yes']
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'audio_player_currenttime_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time.mejs-currenttime-container' => 'color: {{VALUE}}',
				],
				'condition' => [
					'audio_player_current' => ['yes']
				],
			]
		);

		$this->add_responsive_control(
			'audio_player_currenttime_margin',
			[
				'label' => esc_html__('Margin (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time .mejs-currenttime' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'audio_player_current' => ['yes']
				],
			]
		);

		$this->add_control(
			'audio_player_durationtime_heading',
			[
				'label' => esc_html__('Duration Time', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'audio_player_duration' => ['yes']
				],
			]
		);

		$this->add_control(
			'audio_player_durationtime_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time.mejs-duration-container' => 'color: {{VALUE}}',
				],
				'condition' => [
					'audio_player_duration' => ['yes']
				],
			]
		);

		$this->add_responsive_control(
			'audio_player_durationtime_margin',
			[
				'label' => esc_html__('Margin (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-time .mejs-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'audio_player_duration' => ['yes']
				],
			]
		);

		$this->end_controls_section();

		// Volume Section
		$this->start_controls_section(
			'audio_player_volume_style_section',
			[
				'label' => esc_html__('Volume', 'amokit-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'audio_player_volume' => ['yes']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_button_heading',
			[
				'label' => esc_html__('Volume Button', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'audio_player_volume_size',
			[
				'label' => esc_html__('Icon Box  Height/Width', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button'	=> 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		// pro feaure
		$this->add_responsive_control(
			'audio_player_volume_font_size',
			[
				'label' => esc_html__('Icon Font Size', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'default' => [
					'size' => '13',
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button i'	=> 'font-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'player_custtom_icon_enable' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'audio_player_volume_btn_style_tabs'
		);

		$this->start_controls_tab(
			'audio_player_volume_btn_normal_style_tab',
			[
				'label' => esc_html__('Normal', 'amokit-addons'),
			]
		);

		$this->add_control(
			'audio_player_volume_btn_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'audio_player_volume_btn_box_shadow',
				'label' => esc_html__('Box Shadow', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-volume-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_volume_btn_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-volume-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'audio_player_volume_btn_hover_style_tab',
			[
				'label' => esc_html__('Hover', 'amokit-addons'),
			]
		);

		$this->add_control(
			'audio_player_volume_btn_hover_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button:hover button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'audio_player_volume_btn_bg_hover_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'audio_player_volume_btn_hover_box_shadow',
				'label' => esc_html__('Box Shadow', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-volume-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_volume_btn_hover_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-volume-button:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'audio_player_volume_btn_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'audio_player_volume_btn_margin',
			[
				'label' => esc_html__('Margin (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Volume slider
		$this->add_control(
			'audio_player_volume_slider_heading',
			[
				'label' => esc_html__('Volume Slider', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'audio_player_volume_slider_layout' => ['vertical']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_slider_bg_color',
			[
				'label' => esc_html__('Background Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'audio_player_volume_slider_layout' => ['vertical']
				],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-slider' => 'background: {{VALUE}}',
				],
			]
		);

		// Volume bar
		$this->add_control(
			'audio_player_volume_bar_heading',
			[
				'label' => esc_html__('Volume Bar', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'audio_player_volume_bar_width',
			[
				'label' => esc_html__('Width', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player :is(.mejs-horizontal-volume-total, .mejs-volume-total)'	=> 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'audio_player_volume_slider_layout' => ['horizontal']
				],
			]
		);

		$this->add_responsive_control(
			'audio_player_volume_bar_height',
			[
				'label' => esc_html__('Height', 'amokit-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .amo-audio-player .mejs-horizontal-volume-total'	=> 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'audio_player_volume_slider_layout' => ['horizontal']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_bar_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player :is(.mejs-horizontal-volume-total, .mejs-volume-total)' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'audio_player_volume_bar_border',
				'label' => esc_html__('Border', 'amokit-addons'),
				'selector' => '{{WRAPPER}} .amo-audio-player .mejs-horizontal-volume-total',
				'condition' => [
					'audio_player_volume_slider_layout' => ['horizontal']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_bar_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-horizontal-volume-total,
					{{WRAPPER}} .amo-audio-player .mejs-horizontal-volume-total .mejs-horizontal-volume-current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'audio_player_volume_slider_layout' => ['horizontal']
				],
			]
		);
		$this->add_responsive_control(
			'audio_player_current_volume_bar_margin',
			[
				'label' => esc_html__('Margin (px)', 'amokit-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-horizontal-volume-total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'audio_player_volume_slider_layout' => ['horizontal'],
				],
			]
		);
		// Current volume bar
		$this->add_control(
			'audio_player_current_volume_bar_heading',
			[
				'label' => esc_html__('Current Volume Bar', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'audio_player_current_volume_bar_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player :is(.mejs-horizontal-volume-current, .mejs-volume-current)' => 'background: {{VALUE}}',
				],
			]
		);

		// Current volume bar
		$this->add_control(
			'audio_player_volume_handle_heading',
			[
				'label' => esc_html__('Volume Handle', 'amokit-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'audio_player_volume_slider_layout' => ['vertical']
				],
			]
		);

		$this->add_control(
			'audio_player_volume_handle_color',
			[
				'label' => esc_html__('Color', 'amokit-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amo-audio-player .mejs-volume-handle' => 'background: {{VALUE}}',
				],
				'condition' => [
					'audio_player_volume_slider_layout' => ['vertical']
				],
			]
		);

		$this->end_controls_section();
 

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
		$audio_url = '';
		if ( $settings['audio_player_source'] === 'selfhosted' ) {
			$audio_url = !empty( $settings['audio_selfhosted_url']['url'] ) ? $settings['audio_selfhosted_url']['url'] : '';
		} elseif( $settings['audio_player_source'] === 'remote' ) {
			$audio_url = $settings['audio_remote_url'];
		}

        //features: ['playpause', 'progress', 'current', 'duration', 'tracks', 'volume', 'fullscreen'],
		$features = [];
		($settings['audio_player_playpause'] === 'yes') && array_push($features, 'playpause');
		($settings['audio_player_current'] === 'yes') && array_push($features, 'current');
		($settings['audio_player_progress'] === 'yes') && array_push($features, 'progress');
		($settings['audio_player_duration'] === 'yes') && array_push($features, 'duration');
		($settings['audio_player_volume'] === 'yes') && array_push($features, 'volume');

		// settings data attributes
		$data_settings['features'] = !empty($features) ? $features : ['playpause']; // playpause, current, progress, duration, volume
		$data_settings['hideVolumeOnTouchDevices'] = ($settings['audio_player_hide_volume_touch_devices'] === 'yes') ? 'true' : 'false';
		$data_settings['audioVolume'] = 'horizontal';
		$data_settings['startVolume'] = (!empty($settings['audio_player_start_volume']['size'])) ? floatval( $settings['audio_player_start_volume']['size'] ) : 0.8;
		$data_settings['restrictTime'] = (!empty($settings['audio_restrict_time'])) ? floatval( $settings['audio_restrict_time'] ) : 0;

		$this->add_render_attribute(
			'wrapper',
			[
				'class' => 'amokit-audio-player-wrapper', // pro features
				'data-audio-settings' => esc_attr( wp_json_encode( $data_settings ) ),
				'style' => "display:none",
			]
		);

		$this->add_render_attribute(
			'player_settings',
			[
				'class' => 'amokit-audio-player',
				'src' => esc_url( $audio_url ),
				'preload' => 'none',
				'controls' => '',
				'poster' => '',
			]
		);

		if ( 'yes' === $settings['audio_player_autoplay'] ) {
			$this->add_render_attribute('player_settings', 'autoplay', '');
		}

		if ( 'yes' === $settings['audio_player_loop'] ) {
			$this->add_render_attribute('player_settings', 'loop', '');
		}

		if ( 'yes' === $settings['audio_player_muted'] ) {
			$this->add_render_attribute('player_settings', 'muted', '');
		}

		$this->add_render_attribute( 'player_settings', 'hidden', '' );

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
		<?php if ( !empty( $settings['audio_title'] ) || !empty( $settings['audio_description'] ) || !empty( $settings['audio_poster_image']['url'] ) ){ ?>
            <div class="amo-audio-player-info">
				<?php if ( !empty( $settings['audio_poster_image']['url'] ) ) { ?>
                <div class="amo-audio-thumb">
                    <?php
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'poster_image_size', 'audio_poster_image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </div>
				<?php } ?>
				<?php if ( !empty( $settings['audio_title'] ) || !empty( $settings['audio_description'] ) ){ ?>
                <div class="amo-audio-content">
                    <?php
                    if ( !empty( $settings['audio_title'] ) ) {
                        echo '<div class="amo-audio-title">' . amokit_kses_title( $settings['audio_title'] ) . '</div>';
                    }
                    if ( !empty( $settings['audio_description'] ) ) {
                        echo '<div class="amo-audio-description">' . amokit_kses_desc( $settings['audio_description'] ) . '</div>';
                    }
                    ?>
                </div>
				<?php } ?>
            </div> 
			<?php } ?>
            <audio <?php $this->print_render_attribute_string('player_settings'); ?> class="amo-audio-player">
                <?php echo esc_html__('Your browser does not support the audio tag.', 'amokit-addons'); ?>
            </audio>
        </div>
        <?php
    }

}
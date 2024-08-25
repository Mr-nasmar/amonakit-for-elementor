<?php 
namespace AmoKit_Scroll_To_Top;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKitScrollToTop_Elementor {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
    public function __construct() {
		add_action('elementor/documents/register_controls', [ $this, 'register_controls' ], 10);
        add_action('wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }
	/**
	 * Enqueue scripts.
	 *
	 * Enqueue required JS dependencies for the extension.
	 *
	 * @since 2.2.7
	 * @access public
	 */
	public static function enqueue_scripts() {
        $amokit_stt_module_settings = amokit_get_option( 'amokit_stt', 'amokit_stt_module_settings' );
        $amokit_stt_module_settings = json_decode( $amokit_stt_module_settings, true );

        $stt_global = isset( $amokit_stt_module_settings['stt_global'] ) ? $amokit_stt_module_settings['stt_global'] : 'off';

        $amokit_stt_enable  = amokit_get_elementor_option( 'amokit_stt_enable', get_the_ID() );
        $amokit_stt_disable = amokit_get_elementor_option( 'amokit_stt_disable', get_the_ID() );

        $stt_icon_type      = amokit_get_elementor_option( 'stt_icon_type', get_the_ID() );
        $stt_icon           = amokit_get_elementor_option( 'stt_icon', get_the_ID() );
        $stt_image          = amokit_get_elementor_option( 'stt_image', get_the_ID() );

        $buton_icon = '';
        if( 'none' != $stt_icon_type ) {
            $buton_icon = ( 'icon' == $stt_icon_type ) ? $stt_icon : $stt_image;
        }

        $sttmodule_localize_data = [
            'stt_icon_type'    => $stt_icon_type,
            'buton_icon'    => $buton_icon,
            'stt_button_text'     => amokit_get_elementor_option( 'stt_button_text', get_the_ID() ),
        ];

        if( ( isset( $amokit_stt_enable ) &&  'yes' == $amokit_stt_enable ) ) {
            wp_enqueue_script( 'amokit-stt-script' );
            wp_enqueue_style( 'amokit-stt-css' );
            wp_localize_script( 'amokit-stt-script', 'sttData', $sttmodule_localize_data );
        }
        if( ( isset( $amokit_stt_disable ) &&  'yes' == $amokit_stt_disable )  && 'on' == $stt_global ) {
            wp_dequeue_script( 'amokit-stt-script' );
            wp_dequeue_script( 'amokit-stt-css' );
        }
	}

	/**
	 * Register Reading progress bar controls.
	 *
	 * @since 2.2.7
	 * @access public
	 * @param object $element for current element.
	 */
	public function register_controls( $element ) {

        $amokit_stt_module_settings = amokit_get_option( 'amokit_stt', 'amokit_stt_module_settings' );
        $amokit_stt_module_settings = json_decode( $amokit_stt_module_settings,true );

        $stt_global = isset( $amokit_stt_module_settings['stt_global'] ) ? $amokit_stt_module_settings['stt_global'] : 'off';
        $stt_enable_label =  ( 'on' == $stt_global && is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) ? __('Enable to Custom Style', 'amokit-addons') : __('Enable Scroll To Top', 'amokit-addons');
        
		$tabs = Controls_Manager::TAB_SETTINGS;

		$element->start_controls_section(
			'section_amokit_stt_section',
			array(
				'label' => __( 'amokit Scroll To Top', 'amokit-addons' ),
				'tab'   => $tabs,
			)
		);

        if( 'on' == $stt_global && is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) {
            $element->add_control(
                'amokit_stt_disable',
                [
                    'label' => __('Disable Scroll To Top', 'amokit-addons'),
                    'description' => __('Disable Scroll To Top for this  pages', 'amokit-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', 'amokit-addons'),
                    'label_off' => __('No', 'amokit-addons'),
                    'return_value' => 'yes',
                ]
            );

        } 
        $element->add_control(
            'amokit_stt_enable',
            [
                'label' =>  $stt_enable_label,
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'amokit-addons'),
                'label_off' => __('No', 'amokit-addons'),
                'return_value' => 'yes',
            ]
        );
        $element->add_control(
            'amokit_stt_notice',
            [
                'raw'             => __( 'The <b>Scroll To Top settings</b> are not functional in Editor mode. Please preview the page  & Scroll to see the desired result.', 'amokit-addons' ),
                'type'            => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'   => [
                    'amokit_stt_enable' => 'yes'
                ],
            ]
        );
        $element->add_control(
            'amokit_stt_position',
            [
                'label' => esc_html__('Position', 'amokit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom_left',
                'label_block' => false,
                'options' => [
                    'bottom_left' => esc_html__('Bottom Left', 'amokit-addons'),
                    'bottom_right' => esc_html__('Bottom Right', 'amokit-addons'),
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
                'selectors_dictionary' => [
                    'bottom_left' => 'left:15px !important; right:auto !important',
                    'bottom_right' =>'right:15px !important;left:auto !important'
                ],
				'selectors' => [
                    '{{WRAPPER}} .amo-stt-wrap' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
            'stt_offset',
            [
                'type' =>Controls_Manager::POPOVER_TOGGLE,
                'label' => esc_html__( 'Offsets', 'amokit-addons' ),
                'label_off' => esc_html__( 'Default', 'amokit-addons' ),
                'label_on' => esc_html__( 'Custom', 'amokit-addons' ),
                'return_value' => 'yes',
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->start_popover();

            $element->add_control(
                'offset_x',
                [
                    'label' => __('Offset X', 'amokit-addons'),
                    'description' => __('Add the position X  Offest of the button', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap' => 'left: {{SIZE}}{{UNIT}}!important;right:auto !important',
                    ],
                    'condition' => [
                        'amokit_stt_position' => 'bottom_left',
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
            $element->add_control(
                'offset_x2',
                [
                    'label' => __('Offset X', 'amokit-addons'),
                    'description' => __('Add the position X  Offest of the button', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap' => 'right: {{SIZE}}{{UNIT}}!important; left:auto !important',
                    ],
                    'condition' => [
                        'amokit_stt_position' => 'bottom_right',
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'offset_Y',
                [
                    'label' => __('Offset Y', 'amokit-addons'),
                    'description' => __('Add the position Y  Offest of the button', 'amokit-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap' => 'bottom: {{SIZE}}{{UNIT}} !important',
                    ],
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
        $element->end_popover();
        $element->add_control(
            'amokit_stt_width',
            [
                'label' => __('Width', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-stt-wrap' => 'min-width: {{SIZE}}{{UNIT}} !important',
                ],
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'amokit_stt_height',
            [
                'label' => __('Height', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' =>30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-stt-wrap' => 'min-height: {{SIZE}}{{UNIT}} !important',
                ],
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'stt_z_index',
            [
                'label' => __('Z Index', 'amokit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 999,
                'selectors' => [
                    '{{WRAPPER}} .amo-stt-wrap' => 'z-index:{{VALUE}}',
                ],
                'condition'=>[
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'stt_icon_type',
            [
                'label'   => __( 'Icon Type', 'amokit-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'amokit-addons' ),
                        'icon'  => 'eicon-ban',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'amokit-addons' ),
                        'icon'  => 'eicon-info-circle',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'amokit-addons' ),
                        'icon'  => 'eicon-image-bold',
                    ],
                ],
                'default' => 'icon',
                'condition'=>[
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'stt_icon',
            [
                'label'         => __( 'Icon', 'amokit-addons' ),
                'type'          => Controls_Manager::ICONS,
                'condition'=>[
                    'stt_icon_type'=>'icon',
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'stt_image',
            [
                'label' => __('Image','amokit-addons'),
                'type'=>Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'stt_icon_type' => 'image',
                    'amokit_stt_enable' => 'yes',
                ]
            ]
        );
        $element->add_control(
            'stt_icon_size',
            [
                'label' => __('Icon size', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-stt-wrap img' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .amo-stt-wrap i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'stt_button_text',
            [
                'label'         => __( 'Button Text', 'amokit-addons' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'stt_colors_borders',
            [
                'label' => __( 'Colors and Border', 'amokit-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
        );
        $element->start_controls_tabs(
            'stt_colors_borders_tabs', [
                'condition' => [
                    'amokit_stt_enable' => 'yes',
                ],
            ]
            
        );
            // Normal Style Tab
            $element->start_controls_tab(
                'input_normal',
                [
                    'label' => __( 'Normal', 'amokit-addons' ),
                ]
            );
                $element->add_control(
                    'stt_text_color',
                    [
                        'label'     => __( 'Color', 'amokit-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .amo-stt-wrap,{{WRAPPER}} .amo-stt-wrap i' => 'color: {{VALUE}} !important;',
                            '{{WRAPPER}} .amo-stt-wrap svg path' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'stt_text_typography',
                        'selector' => '{{WRAPPER}} .amo-stt-wrap',
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                            'stt_button_text!' => '',
                        ],
                    ]
                );
                $element->add_control(
                    'stt_bacground_color',
                    [
                        'label'     => __( 'Background Color', 'amokit-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .amo-stt-wrap'  => 'background-color: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'stt_border',
                        'label' => __( 'Border', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-stt-wrap',
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                        ],
                    ]
                );
    
                $element->add_responsive_control(
                    'stt_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .amo-stt-wrap' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'stt_boxshadow',
                        'label' => __( 'Box Shadow', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .amo-stt-wrap',
                        'condition' => [
                            'amokit_stt_enable' => 'yes',
                        ],
                    ]
                );
    
            $element->end_controls_tab();

            // Hover Style Tab
            $element->start_controls_tab(
                'input_focus',
                [
                    'label' => __( 'Hover', 'amokit-addons' ),
                ]
            );
            $element->add_control(
                'stt_text_color_hover',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap:hover,{{WRAPPER}} .amo-stt-wrap:hover i' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .amo-stt-wrap:hover svg path' => 'fill: {{VALUE}} !important;',
                    ],
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
            $element->add_control(
                'stt_bacground_color_hover',
                [
                    'label'     => __( 'Background Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap:hover'  => 'background-color: {{VALUE}} !important;',
                    ],
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
            $element->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'stt_border_hover',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-stt-wrap:hover',
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );

            $element->add_responsive_control(
                'stt_border_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-stt-wrap:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
            $element->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'stt_boxshadow_hover',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-stt-wrap:hover',
                    'condition' => [
                        'amokit_stt_enable' => 'yes',
                    ],
                ]
            );
            $element->end_controls_tab();
        $element->end_controls_tabs();
		$element->end_controls_section();

	}

}

AmoKitScrollToTop_Elementor::instance();
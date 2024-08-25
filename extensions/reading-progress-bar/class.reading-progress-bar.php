<?php 
namespace AmoKit_Reading_Progress_Bar;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKitReadingProgressBar_Elementor {

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
	 * @since 2.2.5
	 * @access public
	 */
	public static function enqueue_scripts() {
        $amokit_rpbar_module_settings = amokit_get_option( 'amokit_rpbar', 'amokit_rpbar_module_settings' );
        $amokit_rpbar_module_settings = json_decode( $amokit_rpbar_module_settings, true );

        $rpbar_global = isset( $amokit_rpbar_module_settings['rpbar_global'] ) ? $amokit_rpbar_module_settings['rpbar_global'] : 'off';

        // Enqueue js and css for individual page 
        $amokit_rpbar_enable = amokit_get_elementor_option( 'amokit_rpbar_enable', get_the_ID() );
        $amokit_rpbar_disable = amokit_get_elementor_option( 'amokit_rpbar_disable', get_the_ID() );

        if( ( isset( $amokit_rpbar_enable ) &&  'yes' == $amokit_rpbar_enable ) ) {
            wp_enqueue_script( 'amokit-rpbar-script');
            wp_enqueue_style( 'amokit-rpbar-css');
        }
        if( ( isset( $amokit_rpbar_disable ) &&  'yes' == $amokit_rpbar_disable )  && 'on' == $rpbar_global ) {
            wp_dequeue_script( 'amokit-rpbar-script');
            wp_dequeue_script( 'amokit-rpbar-css');
        }
	}

	/**
	 * Register Reading progress bar controls.
	 *
	 * @since 2.2.5
	 * @access public
	 * @param object $element for current element.
	 */
	public function register_controls( $element ) {

        $amokit_rpbar_module_settings = amokit_get_option( 'amokit_rpbar', 'amokit_rpbar_module_settings' );
        $amokit_rpbar_module_settings = json_decode( $amokit_rpbar_module_settings, true );

        $rpbar_global = isset( $amokit_rpbar_module_settings['rpbar_global'] ) ? $amokit_rpbar_module_settings['rpbar_global'] : 'off';
        $rpbar_enable_label =  ( 'on' == $rpbar_global && is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) ? __('Enable to Custom Style', 'amokit-addons') : __('Enable Reading Progress Bar', 'amokit-addons');
        
		$tabs = Controls_Manager::TAB_SETTINGS;

		$element->start_controls_section(
			'section_amokit_rpbar_section',
			array(
				'label' => __( 'amokit Reading Progress Bar', 'amokit-addons' ),
				'tab'   => $tabs,
			)
		);

        if( 'on' == $rpbar_global && is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) {
            $element->add_control(
                'amokit_rpbar_disable',
                [
                    'label' => __('Disable Reading Progress Bar', 'amokit-addons'),
                    'description' => __('Disable Reading Progress Bar for this  pages', 'amokit-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', 'amokit-addons'),
                    'label_off' => __('No', 'amokit-addons'),
                    'return_value' => 'yes',
                ]
            );

        } 
        $element->add_control(
            'amokit_rpbar_enable',
            [
                'label' =>  $rpbar_enable_label,
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'amokit-addons'),
                'label_off' => __('No', 'amokit-addons'),
                'return_value' => 'yes',
            ]
        );
        $element->add_control(
            'amokit_rpbar_notice',
            [
                'raw'             => __( 'The <b>Reading Progress Bar settings</b> are not functional in Editor mode. Please preview the page  & Scroll to see the desired result.', 'amokit-addons' ),
                'type'            => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'   => [
                    'amokit_rpbar_enable' => 'yes'
                ],
            ]
        );
        $element->add_control(
            'amokit_rpbar_position',
            [
                'label' => esc_html__('Position', 'amokit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'label_block' => false,
                'options' => [
                    'top' => esc_html__('Top', 'amokit-addons'),
                    'bottom' => esc_html__('Bottom', 'amokit-addons'),
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_rpbar_enable' => 'yes',
                ],
                'selectors_dictionary' => [
                    'top' => 'top:0!important; bottom:auto!important',
                    'bottom' =>'bottom:0 !important; top:auto!important'
                ],
				'selectors' => [
                    '{{WRAPPER}} .amo-rpbar-wrap' => '{{VALUE}}',
                ],
            ]
        );

        $element->add_control(
            'amokit_rpbar_height',
            [
                'label' => __('Height', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-rpbar-wrap,{{WRAPPER}} .amo-rpbar-wrap .amo-reading-progress-bar' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_rpbar_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'amokit_rpbar_bg_color',
            [
                'label' => __('Background Color', 'amokit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .amo-rpbar-wrap' => 'background-color: {{VALUE}}!important',
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_rpbar_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'amokit_rpbar_fill_color',
            [
                'label' => __('Fill Color', 'amokit-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#D43A6B',
                'selectors' => [
                    '{{WRAPPER}} .amo-rpbar-wrap .amo-reading-progress-bar' => 'background-color: {{VALUE}}!important',
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_rpbar_enable' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'amokit_rpbar_animation_speed',
            [
                'label' => __('Animation Speed', 'amokit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-rpbar-wrap .amo-reading-progress-bar' => 'transition: width {{SIZE}}ms ease;',
                ],
                'separator' => 'before',
                'condition' => [
                    'amokit_rpbar_enable' => 'yes',
                ],
            ]
        );
		$element->end_controls_section();

	}

}

AmoKitReadingProgressBar_Elementor::instance();
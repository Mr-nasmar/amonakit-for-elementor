<?php 
namespace AmoKit_Floating_Effects;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKitFloatingEffects_Elementor {

    private static $_instance = null;
	static $load_script = false;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
    public function __construct() {
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'register_controls' ], 1 );
		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
    }
	/**
	 * Enqueue scripts.
	 *
	 * Enqueue required JS dependencies for the extension.
	 *
	 * @since 2.2.9
	 * @access public
	 */
	public static function enqueue_scripts() {
        // JS File
        wp_enqueue_script( 'amokit-floating-effects', AMONAKIT_ADDONS_PL_URL . 'extensions/floating-effects/assets/js/amokit-floating-effects.js', array('jquery'),AMONAKIT_VERSION );
        wp_enqueue_script( 'anime' );

	}



	/**
	 * Set should_script_enqueue based on module settings
	 *
	 * @param Element_Base $section
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $section ) {
		if ( self::$load_script ) {
			return;
		}

		if ( 'yes' == $section->get_settings_for_display( 'amokit_fe' ) ) {
			self::enqueue_scripts();

			self::$load_script = true;

			remove_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		}
	}



	/**
	 * Register Wrapper link controls.
	 *
	 * @since 2.2.9
	 * @access public
	 * @param object $element for current element.
	 */
	public static function register_controls( $element ) {

		$element->start_controls_section(
			'section_floating_effects',
			[
				'label' => __( 'amokit Floating Effects', 'amokit-addons' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'amokit_fe',
			[
				'label' => __( 'Enable', 'amokit-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'amokit_fe_motion_toggle',
			[
				'label' => __( 'Motion', 'amokit-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'amokit_fe' => 'yes',
				]
			]
		);

		$element->add_control(
			'amokit_fe_translate_toggle',
			[
				'label' => __( 'Translate', 'amokit-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'amokit_fe' => 'yes',
					'amokit_fe_motion_toggle' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'amokit_fe_translate_x',
			[
				'label' => __( 'Translate X', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 5,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_translate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_translate_y',
			[
				'label' => __( 'Translate Y', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 5,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_translate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_translate_duration',
			[
				'label' => __( 'Duration', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'amokit_fe_translate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_translate_delay',
			[
				'label' => __( 'Delay', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'condition' => [
					'amokit_fe_translate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();

		$element->add_control(
			'amokit_fe_rotate_toggle',
			[
				'label' => __( 'Rotate', 'amokit-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'amokit_fe' => 'yes',
					'amokit_fe_motion_toggle' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'amokit_fe_rotate_x',
			[
				'label' => __( 'Rotate X', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_rotate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_rotate_y',
			[
				'label' => __( 'Rotate Y', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_rotate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_rotate_z',
			[
				'label' => __( 'Rotate Z', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_rotate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_rotate_duration',
			[
				'label' => __( 'Duration', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'amokit_fe_rotate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_rotate_delay',
			[
				'label' => __( 'Delay', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'condition' => [
					'amokit_fe_rotate_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();

		$element->add_control(
			'amokit_fe_scale_toggle',
			[
				'label' => __( 'Scale', 'amokit-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'amokit_fe' => 'yes',
					'amokit_fe_motion_toggle' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'amokit_fe_scale_x',
			[
				'label' => __( 'Scale X', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 1,
						'to' => 1.2,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_scale_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_scale_y',
			[
				'label' => __( 'Scale Y', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 1,
						'to' => 1.2,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'labels' => [
					__( 'From', 'amokit-addons' ),
					__( 'To', 'amokit-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'amokit_fe_scale_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_scale_duration',
			[
				'label' => __( 'Duration', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'amokit_fe_scale_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'amokit_fe_scale_delay',
			[
				'label' => __( 'Delay', 'amokit-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'condition' => [
					'amokit_fe_scale_toggle' => 'yes',
					'amokit_fe' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();
		// Skew
		$element->add_control(
			'amokit_fe_skew_togglep',
			[
				'label' => __( 'Skew', 'amokit-addons' ) . ' <i class="eicon-pro-icon"></i>',
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'amokit_fe' => 'yes',
					'amokit_fe_motion_toggle' => 'yes',
				],
				'classes' => 'amokit-disable-control',
			]
		);

		$element->add_control(
			'amokit_fe_style_togglep',
			array(
				'label'        => __( 'Style', 'amokit-addons' ) . ' <i class="eicon-pro-icon"></i>',
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'condition'    => array(
					'amokit_fe' => 'yes',
				),
				'frontend_available' => true,
				'classes' => 'amokit-disable-control',
			)
		);

		// End Style Settings
		$element->add_control(
			'amokit_fe_filters_togglep',
			array(
				'label'        => __( 'Filters', 'amokit-addons' ) . ' <i class="eicon-pro-icon"></i>',
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'condition'    => array(
					'amokit_fe' => 'yes',
				),
				'frontend_available' => true,
				'classes' => 'amokit-disable-control',
			)
		);

		// General Setting start
		$element->add_control(
			'amokit_fe_general_settings_heading',
			array(
				'label'     => __( 'General Settings', 'amokit-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'amokit_fe' => 'yes',
				),
			)
		);

		$element->add_control(
			'amokit_fe_direction',
			array(
				'label'     => __( 'Direction', 'amokit-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'alternate',
				'options'   => array(
					'normal'    => __( 'Normal', 'amokit-addons' ),
					'reverse'   => __( 'Reverse', 'amokit-addons' ),
					'alternate' => __( 'Alternate', 'amokit-addons' ),
				),
				'condition' => array(
					'amokit_fe' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'amokit_fe_loop',
			array(
				'label'     => __( 'Loop', 'amokit-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Infinite', 'amokit-addons' ),
					'number'  => __( 'Custom', 'amokit-addons' ),
				),
				'condition' => array(
					'amokit_fe' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'amokit_fe_loop_number',
			array(
				'label'     => __( 'Number', 'amokit-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'condition' => array(
					'amokit_fe' => 'yes',
					'amokit_fe_loop'     => 'number',
				),
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'amokit_fe_easing',
			array(
				'label'     => __( 'Easing', 'amokit-addons' ) . ' <i class="eicon-pro-icon"></i>',
				'type'      => Controls_Manager::SELECT,
				'default'   => 'easeInOutSine',
				'options'   => array(
					'linear'                  => __( 'Linear', 'amokit-addons' ),
					'easeInOutSine'           => __( 'easeInOutSine', 'amokit-addons' ),
					'easeInOutExpo'           => __( 'easeInOutExpo', 'amokit-addons' ),
					'easeInOutQuart'          => __( 'easeInOutQuart', 'amokit-addons' ),
					'easeInOutCirc'           => __( 'easeInOutCirc', 'amokit-addons' ),
					'easeInOutBack'           => __( 'easeInOutBack', 'amokit-addons' ),
					'steps'                   => __( 'Steps', 'amokit-addons' ),
					'easeInElastic(1, .6)'    => __( 'Elastic In', 'amokit-addons' ),
					'easeOutElastic(1, .6)'   => __( 'Elastic Out', 'amokit-addons' ),
					'easeInOutElastic(1, .6)' => __( 'Elastic In Out', 'amokit-addons' ),
				),
				'condition' => array(
					'amokit_fe' => 'yes',
				),
				'frontend_available' => true,
				'classes' => 'amokit-disable-control',

			)
		);

		$element->add_control(
			'amokit_fe_ease_step',
			array(
				'label'     => __( 'Steps', 'amokit-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5,
				'condition' => array(
					'amokit_fe' => 'yes',
					'amokit_fe_easing'   => 'steps',
				),
				'frontend_available' => true,
			)
		);

		$element->end_controls_section();
	}
}

AmoKitFloatingEffects_Elementor::instance();
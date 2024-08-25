<?php 
namespace AmoKit_Wrapper_link;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKitWrapperLink_Elementor {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
    public function __construct() {
		add_action( 'elementor/element/column/section_advanced/after_section_end', array( $this, 'register_controls' ), 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', array( $this, 'register_controls' ), 1 );
		add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls' ), 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', array( $this, 'register_controls' ), 1 );
		add_action( 'elementor/frontend/before_render' ,array( $this, 'before_render' ), 1 );
    }
	/**
	 * Enqueue scripts.
	 *
	 * Enqueue required JS dependencies for the extension.
	 *
	 * @since 2.0.2
	 * @access public
	 */
	public static function enqueue_scripts() {
        // JS File
        wp_enqueue_script( 'amokit-wrapper-link', AMONAKIT_ADDONS_PL_URL . 'extensions/wrapper-link/assets/js/amokit-wrapper-link.js', array('jquery'),AMONAKIT_VERSION );

	}

	/**
	 * Register Wrapper link controls.
	 *
	 * @since 2.0.2
	 * @access public
	 * @param object $element for current element.
	 */
	public function register_controls( $element ) {
		$tabs = Controls_Manager::TAB_CONTENT;
		if ( 'section' === $element->get_name() || 'column' === $element->get_name()  || 'container' === $element->get_name()) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'section_AMOKIT_WRAPPER_link',
			array(
				'label' => __( 'Wrapper Link', 'amokit-addons' ).amo_get_elementor_section_icon(),
				'tab'   => $tabs,
			)
		);

		$element->add_control(
			'amokit_element_link',
			[
				'label'       => __( 'Link', 'amokit-addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://example.com',
			]
		);

		$element->end_controls_section();

	}

	/**
	 * Render HTML output on the frontend.
	 *
	 * Written in PHP and used to generate the final Output.
	 *
	 * @since 2.0.2
	 * @access public
	 * @param object $element for current element.
	 */
	public function before_render( $element ) {
		$AMOKIT_WRAPPER_link = $element->get_settings_for_display( 'amokit_element_link' );

		if ( $AMOKIT_WRAPPER_link && ! empty( $AMOKIT_WRAPPER_link['url'] ) ) {
			$AMOKIT_WRAPPER_link['url'] =  esc_url( $AMOKIT_WRAPPER_link['url'] );
			$element->add_render_attribute(
				'_wrapper',
				[
					'data-amokit-element-link' => wp_json_encode( $AMOKIT_WRAPPER_link ),
					'style' => 'cursor: pointer',
					'class' => 'amokit-element-link'
				]
			);

			$this->enqueue_scripts();
		}
	}
}

AmoKitWrapperLink_Elementor::instance();
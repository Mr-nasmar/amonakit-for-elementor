<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Template_Selector extends Widget_Base {

    public function get_name() {
        return 'amokit-template-selector';
    }
    
    public function get_title() {
        return __( 'Template Selector', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-select';
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
            'amokit-widgets-scripts',
        ];
    }

    public function get_keywords() {
        return ['template', 'remote template', 'dynamic tempate', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    protected function register_controls() {

        // Content
        $this->start_controls_section(
            'template_selector_content',
            [
                'label' => esc_html__( 'Template', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'template_id',
                [
                    'label' => __( 'Select Your template', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => amokit_elementor_template(),
                ]
            );


        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        if ( !empty( $settings['template_id'] )) {
            echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['template_id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }else{
            echo '<div class="amo_error">'.esc_html__( 'No selected template', 'amokit-addons' ).'<div/>';
        }
        
    }



}



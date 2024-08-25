<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Revolution_Slider extends Widget_Base {

    public function get_name() {
        return 'amokit-revolution-addons';
    }
    
    public function get_title() {
        return __( 'Revolution Slider', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-slideshow';
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
        return ['revslider', 'slider', 'revolution slider', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    public function amokit_rev_slider_options() {
        if( class_exists( 'RevSlider' ) ){
            $slider = new \RevSlider();
            $revolution_sliders = $slider->getArrSliders();
            $slider_options     = ['0' => esc_html__( 'Select Slider', 'amokit-addons' ) ];
            if ( ! empty( $revolution_sliders ) && ! is_wp_error( $revolution_sliders ) ) {
                foreach ( $revolution_sliders as $revolution_slider ) {
                   $alias = $revolution_slider->getAlias();
                   $title = $revolution_slider->getTitle();
                   $slider_options[$alias] = $title;
                }
            }
        } else {
            $slider_options = ['0' => esc_html__( 'No Slider Found.', 'amokit-addons' ) ];
        }
        return $slider_options;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'revolution_slider_content',
            [
                'label' => __( 'Revolution Slider', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'slider_alias',
                [
                    'label'   => esc_html__( 'Select Slider', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $this->amokit_rev_slider_options(),
                ]
            );
            
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $revolution_attributes = [
            'alias'  => sanitize_text_field( $settings['slider_alias'] ),
        ];
        $this->add_render_attribute( 'shortcode', $revolution_attributes );
        echo do_shortcode( sprintf( '[rev_slider %s]', $this->get_render_attribute_string( 'shortcode' ) ) );

    }

}


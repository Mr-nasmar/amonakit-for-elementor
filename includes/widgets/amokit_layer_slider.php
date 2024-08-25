<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Layer_Slider extends Widget_Base {

    public function get_name() {
        return 'amokit-layerslider-addons';
    }
    
    public function get_title() {
        return __( 'LayerSlider', 'amokit-addons' );
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
        return [ 'layerslider', 'layer slider', 'slider','Amona Kit','amokit addons' ];
    }

    public function get_help_url() {
		return 'https://nasdesigns.rf.gd/docs/3rd-party-plugin-widgets/layer-slider-widget/';
	}


    public function amokit_get_layer_slider_list() {
        if(shortcode_exists("layerslider")){
            $output = '';
            $sliders = \LS_Sliders::find(array('limit' => 100));
            foreach($sliders as $item) {
                $name = empty($item['name']) ? 'Unnamed' : htmlspecialchars($item['name']);
                $output[$item['id']] = $name;
            }
            return $output;
        }
    }

    protected function register_controls() {

        $this->start_controls_section(
            'layer_slider_content',
            [
                'label' => __( 'LayerSlider', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'slider_name',
                [
                    'label'     => esc_html__( 'Select Slider', 'amokit-addons' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => $this->amokit_get_layer_slider_list(),
                ]
            );

            $this->add_control(
                'first_slide',
                [
                    'label'       => esc_html__( 'First Slide Number', 'amokit-addons' ),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 1,
                ]
            );
            
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $slider_attributes = [
            'id'         => sanitize_text_field( $settings['slider_name'] ),
            'firstslide' => sanitize_text_field( $settings['first_slide'] ),
        ];

        $this->add_render_attribute( 'shortcode', $slider_attributes );
        echo do_shortcode( sprintf( '[layerslider %s]', $this->get_render_attribute_string( 'shortcode' ) ) );

    }

}


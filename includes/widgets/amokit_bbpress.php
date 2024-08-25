<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Bbpress extends Widget_Base {

    public function get_name() {
        return 'amokit-bbpress-addons';
    }
    
    public function get_title() {
        return __( 'Bbpress', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-form-horizontal';
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
        return [ 'bbpress', 'bbpress widget', 'forum', 'reply','amokit','amokit' ];
    }

    public function get_help_url() {
		return 'https://nasdesigns.rf.gd/docs/3rd-party-plugin-widgets/bbpress-widget/';
	}
    
    protected function register_controls() {

        $this->start_controls_section(
            'bbpress_content',
            [
                'label' => __( 'Bbpress', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'bbpress_layout',
                [
                    'label'   => __( 'Layout', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'forum-index',
                    'options' => [
                        'forum-index'  => __('Forum Index', 'amokit-addons'),
                        'forum-form'   => __('Forum Form', 'amokit-addons'),
                        'single-forum' => __('Single Forum', 'amokit-addons'),
                        'topic-index'  => __('Topic Index', 'amokit-addons'),
                        'topic-form'   => __('Topic Form', 'amokit-addons'),
                        'single-topic' => __('Single Topic', 'amokit-addons'),
                        'reply-form'   => __('Reply Form', 'amokit-addons'),
                        'single-reply' => __('Single Reply', 'amokit-addons'),
                        'topic-tags'   => __('Topic Tags', 'amokit-addons'),
                        'single-tag'   => __('Single Tag', 'amokit-addons'),
                        'single-view'  => __('Single View', 'amokit-addons'),
                        'stats'        => __('Stats', 'amokit-addons'),
                    ],
                ]
            );

            $this->add_control(
                'bbpress_id',
                [
                    'label'       => __( 'ID', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXT,
                    'condition'   => [
                        'bbpress_layout' => array( 'single-forum', 'single-topic', 'single-reply', 'single-tag', 'single-view' )
                    ],
                ]
            );
            
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $layout = array( 'single-forum', 'single-topic', 'single-reply', 'single-tag', 'single-view' );
        $bbpress_attributes = array();

        if ( isset( $settings['bbpress_id'] ) ) {
            $bbpress_attributes = array( ' id' => esc_attr( $settings['bbpress_id'] ) );
        } elseif ( $settings['bbpress_layout'] == 'topic-form' && isset( $settings['bbpress_id'] ) ) {
            $bbpress_attributes = array( ' forum_id' =>  esc_attr( $settings['bbpress_id'] ) );
        }
        $this->add_render_attribute( 'shortcode', $bbpress_attributes );

        echo do_shortcode( sprintf( '[bbp-'. esc_attr( $settings['bbpress_layout'] ) .'%s]', $this->get_render_attribute_string( 'shortcode' ) ));

    }

}


<?php
namespace AmoKit_Builder\Elementor\Widget;

// Elementor Classes
use Elementor\Plugin as Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_Site_Title_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-site-title';
    }

    public function get_title() {
        return __( 'Site Title', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-site-title';
    }

    public function get_categories() {
        return ['amokit_builder'];
    }
    public function get_keywords() {
        return ['site title', 'default title','blog title', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    protected function register_controls() {

        // Title
        $this->start_controls_section(
            'title_content',
            [
                'label' => __( 'Site Title', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'title_html_tag',
                [
                    'label'   => __( 'Title HTML Tag', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => amokit_html_tag_lists(),
                    'default' => 'h1',
                ]
            );

        $this->end_controls_section();


        // Style
        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => __( 'Site Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'title_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htsite-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'title_typography',
                    'label'     => __( 'Typography', 'amokit-addons' ),
                    'selector'  => '{{WRAPPER}} .htsite-title',
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'title_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .htsite-title',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'title_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htsite-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htsite-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htsite-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
                [
                    'label'        => __( 'Alignment', 'amokit-addons' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .htsite-title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();

        $title_tag = amokit_validate_html_tag( $settings['title_html_tag'] );
        
        if( Elementor::instance()->editor->is_edit_mode() ){
            echo sprintf( '<%1$s class="htsite-title">' . esc_html__('Site Title', 'amokit-addons' ). '</%1$s>', esc_attr( $title_tag ) );
        }else{
            echo sprintf( '<%1$s class="htsite-title">%2$s</%1$s>' , esc_attr( $title_tag ), esc_html( get_bloginfo( 'name', 'display' ) ) );
        }
    }

    

}

<?php
namespace AmoKit_Builder\Elementor\Widget;

// Elementor Classes
use Elementor\Plugin as Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_Post_Title_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-single-blog-title';
    }

    public function get_title() {
        return __( 'Post Title', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-post-title';
    }

    public function get_categories() {
        return ['amokit_builder'];
    }

    public function get_keywords() {
        return ['blog title', 'post title', 'post heading', 'news title', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    protected function register_controls() {


        // Post Title
        $this->start_controls_section(
            'blog_title_content',
            [
                'label' => __( 'Post Title', 'amokit-addons' ),
            ]
        );
            $this->add_control(
                'blog_title_html_tag',
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
            'blog_title_style_section',
            array(
                'label' => __( 'Post Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'blog_title_color',
                [
                    'label'     => __( 'Title Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .entry-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'blog_title_typography',
                    'label'     => __( 'Typography', 'amokit-addons' ),
                    'selector'  => '{{WRAPPER}} .entry-title',
                )
            );

            $this->add_responsive_control(
                'blog_title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'blog_title_align',
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
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $title_tag = amokit_validate_html_tag( $settings['blog_title_html_tag'] );

        if( Elementor::instance()->editor->is_edit_mode() ){
            echo sprintf( '<%1$s class="entry-title">' . esc_html__('Blog Title', 'amokit-addons' ). '</%1$s>', esc_attr( $title_tag ) );
        }else{
            echo sprintf( the_title( '<%1$s class="entry-title">', '</%1$s>', false ), esc_attr( $title_tag ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

    }

}

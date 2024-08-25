<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Dropcaps extends Widget_Base {

    public function get_name() {
        return 'amokit-dropcaps-addons';
    }
    
    public function get_title() {
        return __( 'Dropcaps', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-editor-paragraph';
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
        return ['dropcaps', 'drop caps', 'dropcaps text', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/dropcaps-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'dropcaps_content',
            [
                'label' => __( 'Dropcaps', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'dropcaps_style',
                [
                    'label' => __( 'Style', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'amokit-addons' ),
                        '2'   => __( 'Style Two', 'amokit-addons' ),
                        '3'   => __( 'Style Three', 'amokit-addons' ),
                        '4'   => __( 'Style Four', 'amokit-addons' ),
                        '5'   => __( 'Style Five', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'dropcaps_text',
                [
                    'label'         => __( 'Content', 'amokit-addons' ),
                    'type'          => Controls_Manager::TEXTAREA,
                    'default'       => __( 'Lorem ipsum dolor sit amet, consec adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip exl Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'amokit-addons' ),
                    'placeholder'   => __( 'Enter Your Dropcaps Content.', 'amokit-addons' ),
                    'separator'=>'before',
                ]
            );
            
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'amokit_dropcaps_style_section',
            [
                'label' => __( 'Content Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'amokit_dropcaps_content_align',
                [
                    'label'   => __( 'Alignment', 'amokit-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-inner p'   => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#434343',
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p,{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner',
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner',
                ]
            );

            $this->add_responsive_control(
                'content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style dropcaps letter tab section
        $this->start_controls_section(
            'amokit_dropcaps_letter_style_section',
            [
                'label' => __( 'Dropcap Letter', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'amokit_dropcaps_letter_font_text_backround',
                [
                    'label' => esc_html__( 'Backround Image as Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' =>'before',
                ]
            );
            $this->add_control(
                'content_dropcaps_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#d6d6d6',
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter' => 'color: {{VALUE}};',
                    ],
                    'condition'   => [
                        'amokit_dropcaps_letter_font_text_backround!' => "yes"
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_dropcaps_typography',
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter,{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_dropcaps_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter,{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_dropcaps_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter',
                    'selector' => '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner:first-of-type:first-letter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .amo-dropcaps-area .amo-dropcaps-inner p:first-of-type:first-letter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $sectionid = "amokit-". $this-> get_id();

        $this->add_render_attribute( 'amokit_dropcaps_attr', 'class', 'amokit-dropcaps-area ' . esc_attr( $sectionid ) );
        $this->add_render_attribute( 'amokit_dropcaps_attr', 'class', 'amokit-dropcaps-style-' . esc_attr( $settings['dropcaps_style'] ) );
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_dropcaps_attr' ); ?>>
                <?php
                    $dropcap_text = esc_textarea( $settings['dropcaps_text'] );
                    if( !empty( $dropcap_text ) ){
                        echo '<div class="amo-dropcaps-inner">'.wpautop( $dropcap_text ).'</div>';
                    }
                ?>
            </div>

            <?php if($settings['amokit_dropcaps_letter_font_text_backround'] == 'yes'): ?>
                <style>
                    <?php echo '.'. sanitize_key( $sectionid ) ?> .amo-dropcaps-inner p:first-of-type:first-letter{ 
                        color: #00FF4B00; 
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        }
                    <?php echo '.' . sanitize_key( $sectionid ) ?> .amo-dropcaps-inner:first-of-type:first-letter{
                        color: #00FF4B00; 
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;',
                    }
                </style>

        <?php endif;
    }

}


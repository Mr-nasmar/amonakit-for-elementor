<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Animated_Heading extends Widget_Base {

    public function get_name() {
        return 'amokit-animatedheading-addons';
    }
    
    public function get_title() {
        return __( 'Animated Heading', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-animated-headline';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends() {
        return [
            'animated-heading',
            'amokit-widgets',
        ];
    }

    public function get_script_depends() {
        return [
            'animated-heading',
        ];
    }
    public function get_keywords() {
        return ['heading', 'title', 'animated headline', 'animated heading', 'dual color heading', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/animated-heading-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'animatedheading_content',
            [
                'label' => __( 'Animated Heading', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'layout_style',
                [
                    'label'   => __( 'Layout', 'amokit-addons' ),
                    'type'    => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1' => __( 'Style One', 'amokit-addons' ),
                        '2' => __( 'Style Two', 'amokit-addons' ),
                        '3' => __( 'Style Three', 'amokit-addons' ),
                        '4' => __( 'Style Four', 'amokit-addons' ),
                        '5' => __( 'Style Five', 'amokit-addons' ),
                        '6' => __( 'Style Six', 'amokit-addons' ),
                        '7' => __( 'Style Seven', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'animation_type',
                [
                    'label'   => __( 'Animation Type', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'slide',
                    'options' => [
                        'type'          => __( 'Type', 'amokit-addons' ),
                        'loading-bar'   => __( 'Loading bar', 'amokit-addons' ),
                        'slide'         => __( 'Slide', 'amokit-addons' ),
                        'clip'          => __( 'Clip', 'amokit-addons' ),
                        'zoom'          => __( 'Zoom', 'amokit-addons' ),
                        'scale'         => __( 'Scale', 'amokit-addons' ),
                        'push'          => __( 'Push', 'amokit-addons' ),
                        'rotate-1'      => __( 'Rotate Style One', 'amokit-addons' ),
                        'rotate-2'      => __( 'Rotate Style Two', 'amokit-addons' ),
                        'rotate-3'      => __( 'Rotate Style Three', 'amokit-addons' ),
                    ],
                    'condition'=>[
                        'layout_style!' => '2',
                    ],
                ]
            );

            $this->add_control(
                'animated_before_text',
                [
                    'label' => __( 'Heading Before Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Honesty is the best policy', 'amokit-addons' ),
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'animated_heading_text',
                [
                    'label'       => __( 'Animated Heading Text', 'amokit-addons' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'default'     => __( "Purpose,policy,Company", 'amokit-addons' ),
                    'condition'=>[
                        'layout_style!' => '2',
                    ],
                ]
            );

            $this->add_control(
                'visible_items',
                [
                    'label' => __( 'Visible Item Number', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'step' => 1,
                    'default' => 1,
                    'condition'=>[
                        'layout_style!' => '2',
                    ],
                ]
            );

            $this->add_control(
                'animated_after_text',
                [
                    'label' => __( 'Heading After Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'animated_placeholder_text',
                [
                    'label' => __( 'Heading Placeholder Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'heading_align',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading, {{WRAPPER}} .cd-headline'   => 'text-align: {{VALUE}};',
                    ],
                    'separator' => 'before',
                    'render_type' => 'template',
                ]
            );
        $this->end_controls_section();

        // Before Style tab section
        $this->start_controls_section(
            'animated_heading_beforetext_style',
            [
                'label' => __( 'Before Text Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'animated_before_text!'=>'',
                ]
            ]
        );
            $this->add_control(
                'heading_before_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'',
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.beforetext' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_before_text_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.beforetext',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'heading_before_text_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.beforetext',
                ]
            );

            $this->add_responsive_control(
                'heading_before_text_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.beforetext' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'heading_before_text_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.beforetext',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_before_text_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.beforetext',
                ]
            );

            $this->add_responsive_control(
                'heading_before_text_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.beforetext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'heading_placeholder_options_title',
                    [
                        'label' => esc_html__( 'Placeholder Text', 'amokit-addons' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );

            $this->add_control(
                'heading_placeholder_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'',
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading .cd-headline::before' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_placeholder_text_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading .cd-headline::before',
                    'separator' => 'before'
                ]
            );

            $this->add_responsive_control(
                'heading_placeholder_text_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading .cd-headline::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // After Style tab section
        $this->start_controls_section(
            'animated_heading_aftertext_style',
            [
                'label' => __( 'After Text Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'animated_after_text!'=>'',
                ]
            ]
        );
            $this->add_control(
                'heading_after_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'',
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.aftertext' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_after_text_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.aftertext',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'heading_after_text_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.aftertext',
                ]
            );

            $this->add_responsive_control(
                'heading_after_text_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.aftertext' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'heading_after_text_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.aftertext',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_after_text_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading h4 span.aftertext',
                ]
            );

            $this->add_responsive_control(
                'heading_after_text_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading h4 span.aftertext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'animated_heading_text_style',
            [
                'label' => __( 'Animated Text Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'layout_style!'=>'2',
                ]
            ]
        );
            $this->add_control(
                'heading_animated_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'',
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .cd-headline.loading-bar .cd-words-wrapper::after' =>  'background:{{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_animated_text_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'heading_animated_text_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_responsive_control(
                'heading_animated_text_border_radius',
                [
                    'label' => __( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'heading_animated_text_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_animated_text_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_responsive_control(
                'heading_animated_text_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-animated-heading .cd-words-wrapper b' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'heading_animated_after_clip',
                [
                    'label'     => __( 'Clip Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'',
                    'condition'=>[
                        'animation_type'=>'clip',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cd-headline.clip .cd-words-wrapper::after' => 'background-color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'heading_animated_after_clip_width',
                [
                    'label' => esc_html__( 'Clip Width', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'placeholder' => '0',
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => 2,
                    'condition'=>[
                        'animation_type'=>'clip',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cd-headline.clip .cd-words-wrapper::after' => 'width: {{VALUE}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $rotateAmimationClass = ( $settings['animation_type'] == 'scale' || $settings['animation_type'] == 'rotate-2' || $settings['animation_type'] == 'rotate-3') ? 'letters':'';
        
        $this->add_render_attribute( 'heading_area_attr', 'class', 'amokit-animated-heading amokit-style-'. esc_attr( $settings['layout_style'] ) );

        if ( isset( $settings['heading_align'] ) && ! empty( $settings['heading_align'] ) ) {
            $this->add_render_attribute( 'heading_area_attr', 'class', 'amokit-animated-alignment-'. esc_attr( $settings['heading_align'] ) ); 
        }

        $this->add_render_attribute( 'heading_attr', 'class', 'cd-headline '. esc_attr( $rotateAmimationClass ) .' headline-placeholder '. esc_attr( $settings['animation_type'] ) );
        $animatedheading_text = explode(",", esc_html( $settings['animated_heading_text'] ) );
       
        ?>

            <div <?php echo $this->get_render_attribute_string( 'heading_area_attr' ); ?> >
                <h4 
                    <?php if($settings['animated_placeholder_text'] !== ''): ?>
                        data-pltext="<?php echo esc_attr( $settings['animated_placeholder_text'] ) ?>" 
                    <?php endif ?>
                    <?php echo $this->get_render_attribute_string( 'heading_attr' ); ?>>
                    <?php
                        if( !empty( $settings['animated_before_text'] ) ){
                            echo '<span class="beforetext">'.esc_html( $settings['animated_before_text'] ).'</span>';
                        }

                        if( is_array( $animatedheading_text ) && count( $animatedheading_text ) > 0 ): ?>
                           
                           <span class="cd-words-wrapper">
                                <?php
                                    $i = 0; 
                                    foreach ( $animatedheading_text as $animatedheadintext ) {
                                        $i++;
                                        if( $i == $settings['visible_items'] ){
                                            echo '<b class="is-visible" >'.esc_html( $animatedheadintext ).'</b>';
                                        }else{
                                            echo '<b>'.esc_html( $animatedheadintext ).'</b>';
                                        }
                                    }
                                ?>
                            </span>
                    <?php endif;
                    
                        if( !empty( $settings['animated_after_text'] ) ){
                            echo '<span class="aftertext">'.esc_html( $settings['animated_after_text'] ).'</span>';
                        }
                    ?>
                </h4>
            </div>
        <?php
    }
}


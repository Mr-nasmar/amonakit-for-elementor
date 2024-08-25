<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Lightbox extends Widget_Base {

    public function get_name() {
        return 'amokit-magnific-popup-addons';
    }
    
    public function get_title() {
        return __( 'Lightbox', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-zoom-in';
    }
    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends() {
        return [
            'magnific-popup',
            'amokit-widgets',
        ];
    }

    public function get_script_depends() {
        return [
            'magnific-popup',
            'amokit-widgets-scripts',
        ];
    }
    public function get_keywords() {
        return ['lightbox', 'image popup', 'photo view', 'image view','magnific popup', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/light-box-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'lightbox_content',
            [
                'label' => __( 'Lightbox', 'amokit-addons' ),
            ]
        );
        
            $this->add_control(
                'lightbox_type',
                [
                    'label' => __( 'Lightbox Type', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image'         => __( 'Image', 'amokit-addons' ),
                        'video'         => __( 'Video', 'amokit-addons' ),
                        'google-map'    => __( 'Google Map', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'lightbox_image',
                [
                    'label' => __( 'Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition'     => [
                        'lightbox_type' => 'image',
                    ],
                ]
            );

            $this->add_control(
                'lightbox_video_url',
                [
                    'label'         => __( 'Video URL', 'amokit-addons' ),
                    'type'          => Controls_Manager::URL,
                    'show_external' => false,
                    'default'       => [
                        'url' => __( 'https://www.youtube.com/watch?v=G_G8SdXktHg', 'amokit-addons' ),
                    ],
                    'placeholder'   => __( 'https://www.youtube.com/watch?v=G_G8SdXktHg', 'amokit-addons' ),
                    'label_block'   => true,
                    'condition'     => [
                        'lightbox_type' => 'video',
                    ],
                    'dynamic'     => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'lightbox_google_map',
                [
                    'label'         => __( 'Goggle Map Embed URL', 'amokit-addons' ),
                    'type'          => Controls_Manager::URL,
                    'show_external' => false,
                    'default'       => [
                        'url' => __( 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.38703692693!2d90.27923991057244!3d23.780573258035957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1536834022797', 'amokit-addons' ),
                    ],
                    'placeholder'   => __( 'https://www.google.com/maps/embed?pb', 'amokit-addons' ),
                    'label_block'   => true,
                    'condition'     => [
                        'lightbox_type' => 'google-map',
                    ],
                    'dynamic'     => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'lightbox_toggler_type',
                [
                    'label' => __( 'Toggler Type', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image'   => __( 'Image', 'amokit-addons' ),
                        'button'  => __( 'Button', 'amokit-addons' ),
                        'icon'    => __( 'Icon', 'amokit-addons' ),
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'lightbox_toggler_image',
                [
                    'label' => __( 'Toggler Image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' =>[
                        'lightbox_toggler_type' =>'image'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'lightbox_toggler_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' =>[
                        'lightbox_toggler_type' =>'image'
                    ],
                ]
            );

            $this->add_control(
                'zoom_icon',
                [
                    'label' => __( 'Zoom Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fas fa-plus',
                        'library' => 'solid',
                    ],
                    'condition' =>[
                        'lightbox_toggler_type!' =>'button'
                    ],
                ]
            );

            $this->add_control(
                'zoom_text',
                [
                    'label' => __( 'Zoom Button Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Open','amokit-addons'),
                    'condition' =>[
                        'lightbox_toggler_type' => 'button'
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'lightbox_style_section',
            [
                'label' => __( 'Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'lightbox_style_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                    'condition' =>[
                        'lightbox_type!' =>'image',
                    ],
                ]
            );

            $this->add_control(
                'lightbox_image_overlay_color',
                [
                    'label' => __( 'Overlay', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => 'rgba(0, 0, 0, 0.5)',
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .amo-lightbox-action::before' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'lightbox_image_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'lightbox_image_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'lightbox_image_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-lightbox',
                ]
            );

            $this->add_responsive_control(
                'lightbox_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'lightbox_image_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-lightbox',
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

         // Style tab section
        $this->start_controls_section(
            'lightbox_zoom_btn_style_section',
            [
                'label' => __( 'Zoom Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'lightbox_zoom_btn_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .amo-lightbox-action' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                    'condition' =>[
                        'lightbox_toggler_type!' =>'image'
                    ],
                ]
            );

            $this->add_control(
                'zoom_button_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-lightbox .amo-lightbox-action a i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'zoom_button_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .lightbox_button_only.amo-lightbox .amo-lightbox-action a',
                    'condition' =>[
                        'lightbox_toggler_type!' =>'image'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'zoom_button_typography',
                    'selector' => '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit',
                    'condition'=>[
                        'zoom_icon[value]'=>'',
                    ],
                ]
            );

            $this->add_control(
                'zoom_icon_fontsize',
                [
                    'label' => __( 'Font Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 25,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'zoom_icon[value]!'=>'',
                        'zoom_icon[library]!'=>'svg',
                    ],
                ]
            );

            $this->add_control(
                'zoom_icon_width',
                [
                    'label' => __( 'Icon Dimensions', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'zoom_icon[value]!'=>'',
                    ],
                ]
            );

            $this->add_responsive_control(
                'lightbox_zoom_button_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'lightbox_zoom_button_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit',
                ]
            );

            $this->add_responsive_control(
                'lightbox_zoom_button_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'lightbox_zoom_button_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-lightbox .image-popup-vertical-fit',
                    'separator' =>'before',
                    'condition' =>[
                        'lightbox_toggler_type!' =>'image'
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        // Remove Elementor Lightbox
        $this->add_render_attribute( 'popup_content_attr', 'data-elementor-open-lightbox', 'no' );

        // Default Attribute
        $this->add_render_attribute( 'popup_content_attr', 'class', 'image-popup-vertical-fit' );

        // Default Options
        $popup_settings = [
            'datatype'     => 'image',
        ];

        if ( 'image' == $settings['lightbox_type'] ) {
            $this->add_render_attribute( 'popup_content_attr', 'href', esc_url( $settings['lightbox_image']['url'] ) );
        } elseif ('video' == $settings['lightbox_type'] and '' != $settings['lightbox_video_url']) {
            $this->add_render_attribute( 'popup_content_attr', 'href', esc_url( $settings['lightbox_video_url']['url'] ) );
            $popup_settings['datatype'] = 'iframe';
        }else {
            $this->add_render_attribute( 'popup_content_attr', 'href', esc_url( $settings['lightbox_google_map']['url'] ) );
            $popup_settings['datatype'] = 'iframe';
        }

        $this->add_render_attribute('popup_content_attr', 'data-popupoption', wp_json_encode( $popup_settings ));

        ?>
            <div class="amo-lightbox <?php if( $settings['lightbox_toggler_type'] != 'image' ){ echo 'lightbox_button_only'; }?>">
                <?php if( !empty( $settings['lightbox_toggler_image']['url'] ) ){ ?>
                <div class="amo-lightboxthumb">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'lightbox_toggler_imagesize', 'lightbox_toggler_image' );?>
                </div>
                <?php } ?>
                <div class="amo-lightbox-action">
                    <?php if( !empty($settings['zoom_icon']['value'] ) ): ?>
                        <a <?php echo $this->get_render_attribute_string( 'popup_content_attr' ); ?> ><?php echo AmoKit_Icon_manager::render_icon( $settings['zoom_icon'], [ 'aria-hidden' => 'true' ] ); ?></a>
                    <?php else:?>
                        <a <?php echo $this->get_render_attribute_string( 'popup_content_attr' ); ?> ><?php echo esc_html( $settings['zoom_text'] );?></a>
                    <?php endif;?>
                </div>
            </div>

        <?php

    }

}


<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Post_Carousel extends Widget_Base {

    public function get_name() {
        return 'amokit-postcarousel-addons';
    }
    
    public function get_title() {
        return __( 'Post carousel', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends() {
        return [
            'slick',
            'amokit-widgets',
        ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'amokit-widgets-scripts',
        ];
    }

    public function get_keywords() {
        return [ 'post slider', 'slider widget','carousel','post carousel','amokit','Amona Kit' ];
    }

    public function get_help_url() {
		return 'https://nasdesigns.rf.gd/docs/post-widgets/post-carousel-widget/';
	}

    protected function register_controls() {

        $this->start_controls_section(
            'post_carousel_content',
            [
                'label' => __( 'Post carousel', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'post_carousel_style',
                [
                    'label' => __( 'Layout', 'amokit-addons' ),
                    'type' => 'amokit-preset-select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Layout One', 'amokit-addons' ),
                        '2'   => __( 'Layout Two', 'amokit-addons' ),
                        '3'   => __( 'Layout Three', 'amokit-addons' ),
                        '4'   => __( 'Layout Four', 'amokit-addons' ),
                        '5'   => __( 'Layout Five', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'slider_on',
                [
                    'label'         => __( 'Carousel', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'amokit-addons' ),
                    'label_off'     => __( 'Off', 'amokit-addons' ),
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );
            
        $this->end_controls_section();

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __( 'Post Option', 'amokit-addons' ),
            ]
        );
            


        $this->show_post_source();

            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__( 'Category', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label' => esc_html__( 'Date', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

             $this->add_control(
                'show_title',
                [
                    'label' => esc_html__( 'Title', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label' => __( 'Title Length', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 5,
                    'condition'=>[
                        'show_title'=>'yes',
                    ]
                ]
            );
            $this->add_control(
                'show_content',
                [
                    'label' => esc_html__( 'Show Content', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'content_type',
                [
                    'label' => esc_html__( 'Content Source', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'content',
                    'options' => [
                        'content'          => esc_html__('Content','amokit-addons'),
                        'excerpt'            => esc_html__('Excerpt','amokit-addons'),
                    ],
                    'condition'=>[
                        'show_content'=>'yes',
                    ]
                ]
            );
            $this->add_control(
                'content_length',
                [
                    'label' => __( 'Content Length', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 20,
                    'condition'=>[
                        'show_content'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_read_more_btn',
                [
                    'label' => esc_html__( 'Read More', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'read_more_txt',
                [
                    'label' => __( 'Read More button text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Read More', 'amokit-addons' ),
                    'placeholder' => __( 'Read More', 'amokit-addons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_read_more_btn'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_author',
                [
                    'label' => esc_html__( 'Author', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'hide_empty_thumbnail_post',
                [
                    'label'         => esc_html__( 'Hide Empty Thumbnail', 'amokit-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'separator'     =>'after',
                ]
            );
        $this->end_controls_section(); // Content Option End

        // Carousel setting
        $this->start_controls_section(
            'slider_option',
            [
                'label' => esc_html__( 'Carousel Option', 'amokit-addons' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => esc_html__( 'Slider Items', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                    'default' => 3,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'sli_gutter',
                [
                    'label' => esc_html__( 'Column Space', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                    'default' => 15,
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper' => 'margin: 0 -{{VALUE}}px',
                        '{{WRAPPER}} .post-carousel-wrapper .slick-slide' => 'margin: 0 {{VALUE}}px',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'equal_height_column',
                [
                    'label' => esc_html__( 'Equal Height Column', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );         
            $this->add_control(
                'slarrows',
                [
                    'label' => esc_html__( 'Slider Arrow', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label' => __( 'Previous icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fas fa-angle-left',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label' => __( 'Next icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => 'fas fa-angle-right',
                    'default' => [
                        'value'=>'fas fa-angle-right',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => esc_html__( 'Slider dots', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'amokit-addons'),
                    'label_on' => __('Yes', 'amokit-addons'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'amokit-addons'),
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label' => esc_html__( 'Center Mode', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label' => esc_html__( 'Center padding', 'amokit-addons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'default' => 50,
                    'condition' => [
                        'slider_on' => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => esc_html__( 'Slider auto play', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slloop',
                [
                    'label' => esc_html__( 'Slide Loop', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Slider item to scroll', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Slider Items', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'amokit-addons'),
                    'description' => __('The resolution to tablet.', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 750,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Slider Items', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'amokit-addons'),
                    'description' => __('The resolution to mobile.', 'amokit-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section(); // Slider Option end
        // Style Slide Image
        $this->start_controls_section(
            'post_carousel_image_style',
            [
                'label' => __( 'Carousel Item Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [  'name' => 'amokit_post_image',
                    'default' => 'amokit_size_396x360',
                    'separator' => 'before',
                ]
            ); 
            $this->add_responsive_control(
                'slider_height',
                [
                    'label' => __( 'Item Min Height', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'description' =>'Custom  Item height(px)',
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 1024,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .thumb' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );            
            $this->add_responsive_control(
                'items_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .thumb a img,{{WRAPPER}} .amo-single-post-slide .thumb a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'post_carousel_image_overlay_heading',
                [
                    'label' => __( 'Image Overlay', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'post_slider_image_overlay',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-single-post-slide .thumb a:after',
                    'separator' => 'after',
                ]
            );
            $this->add_control(
                'image_overlay_heading_hover',
                [
                    'label' => __( 'Image Hover Overlay', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style' =>'3', 
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'post_slider_image_overlay_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-single-post-slide .thumb a:before',
                    'separator' => 'after',
                    'condition'=>[
                        'post_carousel_style' =>'3', 
                    ]
                ]
            );
 
            // Content box style start
            $this->add_control(
                'content_box_heading',
                [
                    'label' => __( 'Content Box Style', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );   
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_box_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1 .content .post-inner, {{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner',
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style!' =>'3', 
                    ]
                ]
            );
            // Content box hover bg 
            $this->add_control(
                'content_box_hover_heading',
                [
                    'label' => __( 'Content Box Hover BG', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style' =>'1',
                    ]
                ]
            );   
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_box_background_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1:hover .content .post-inner',
                    'condition'=>[
                        'post_carousel_style' =>'1',
                    ]
                ]
            );
            $this->add_responsive_control(
                'content_box_margin', 
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-postslider-layout-5 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style!' =>['1','3'], 
                    ]
                ]
            );
            $this->add_responsive_control(
                'content_box_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner,{{WRAPPER}} .amo-postslider-layout-3 .content .post-inner, {{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content, {{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_box_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner',
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style!' =>['3','4','2'], 
                    ]
                ]
            );
            $this->add_responsive_control(
                'content_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                    'condition'=>[
                        'post_carousel_style!' =>'3', 
                    ]
                ]
            );

            $this->add_responsive_control(
                'post_slider_content_box_align',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-1 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content .post-inner, {{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner, {{WRAPPER}} .amo-postslider-layout-3 .content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-4 .content,{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner',
                    'condition'=>[
                        'post_carousel_style!' =>['1','3'], 
                    ]
                ]
            );

        $this->end_controls_section();
         //Slider Image Style end
        
        $this->start_controls_section(
            'post_slider_content_border',
            [
                'label' => __( 'Content Box Bottom Border', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_carousel_style' => '2',
                ]
            ]
        );
        $this->add_control(
            'border_type',
            [
                'label' => esc_html__( 'Border Type', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'amokit-solid',
                'options' => [
                    'amokit-solid'          => esc_html__('Solid Color','amokit-addons'),
                    'amokit-gradient'       => esc_html__('Gradient Color','amokit-addons'),
                ],
                
            ]
        );

            $this->add_control(
                'post_slider_content_border_color',
                [
                    'label' => __( 'Border Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#b5b5b5',
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner' => 'border-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'border_type' => 'amokit-solid',
                    ]
                ]
            );

            $this->add_control(
                'post_slider_content_hover_border_color',
                [
                    'label' => __( 'Hover Border Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#0056ff',
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2:hover .content .post-inner' => 'border-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'border_type' => 'amokit-solid',
                    ]
                ]
            );
            $this->add_control(
                'border_gradient_bg_title',
                [
                    'label' => __( 'Border Gradient Color', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'border_type' => 'amokit-gradient',
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'border_gradient_bg',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2 .content .post-inner:after',
                    'condition' => [
                        'border_type' => 'amokit-gradient',
                    ]
                ]
            );
            $this->add_control(
                'border_gradient_bg_title_hover',
                [
                    'label' => __( 'Border Hover Gradient Color', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'border_type' => 'amokit-gradient',
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'border_gradient_bg_hover',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-2:hover .content .post-inner:after',
                    'condition' => [
                        'border_type' => 'amokit-gradient',
                    ]
                ]
            );
            
        $this->end_controls_section(); // Slider Option end

        // Style Title tab section
        $this->start_controls_section(
            'post_slider_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_title'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2 a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'title_color_hover',
                [
                    'label' => __( 'Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2 a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
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
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner h2' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Content tab section
        $this->start_controls_section(
            'post_slider_content_style_section',
            [
                'label' => __( 'Content', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_content'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-single-post-slide .content .post-inner p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_align',
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
                        '{{WRAPPER}} .amo-single-post-slide .content .post-inner p' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        //style thumbnail opacity section
        $this->start_controls_section(
            'post_thumbnail_opacity_section',
            [
                'label' => __( 'Thumbnail', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'post_carousel_style'=>'3',
                ]
            ]
        );

        $this->add_control(
            'post_thumbnail_opacity_color',
            [
                'label' => esc_html__( 'Opacity Color', 'amokit-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-postslider-layout-3 .thumb:before' => 'content: ""; background: {{VALUE}}; width: 100%; height: 100%; position: absolute; z-index:1;',
                ]
            ]
        );

        $this->add_control(
            'post_thumbnail_opacity_opacity',
            [
                'label'   => __( 'Opacity (%)', 'amokit-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.8,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-postslider-layout-3 .thumb:before' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Style Category tab section
        $this->start_controls_section(
            'post_slider_category_style_section',
            [
                'label' => __( 'Category', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_category'=>'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('category_style_tabs');

                $this->start_controls_tab(
                    'category_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'category_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'category_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'category_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'category_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a',
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'category_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'category_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'category_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-single-post-slide .content ul.post-category li a:hover',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Meta tab section
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' => __( 'Meta', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'meta_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide ul.meta li' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .content .post-inner ul.meta li a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'meta_color_icon',
                [
                    'label' => __( 'Icon Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide ul.meta li i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .content .post-inner ul.meta li a i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'meta_color_hover',
                [
                    'label' => __( 'Meta Hover Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .content .post-inner ul.meta li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'meta_separator_color',
                [
                    'label' => __( 'Separator Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-postslider-layout-5 .content .post-inner ul.meta li::before' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'post_carousel_style' => '5',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_typography',
                    'label' => __( 'Typography', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide ul.meta li',
                ]
            );

            $this->add_responsive_control(
                'meta_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide ul.meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide ul.meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_align',
                [
                    'label' => __( 'Alignment', 'amokit-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-single-post-slide ul.meta' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Read More button tab section
        $this->start_controls_section(
            'post_slider_readmore_style_section',
            [
                'label' => __( 'Read More', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                    'read_more_txt!'=>'',
                ]
            ]
        );
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#464545',
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn' => 'color: {{VALUE}}; border-bottom: 1px solid {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'readmore_typography',
                            'label' => __( 'Typography', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'read_more_alignment',
                        [
                            'label' => __( 'Alignment', 'amokit-addons' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'start' => [
                                    'title' => __( 'Left', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => __( 'Right', 'amokit-addons' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper .amo-single-post-slide .post-btn a.readmore-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Slider arrow style start
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'     => __( 'Arrow', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
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
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-carousel-activation button.slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-carousel-activation button.slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
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
                                'size' => 40,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_width',
                        [
                            'label' => __( 'Width', 'amokit-addons' ),
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
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $this->add_control(
                        'slider_arrow_postion_option',
                        [
                            'label' => __( 'Arrow Position', 'amokit-addons' ),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'amokit-top-right-arrow'   => __( 'Top Right', 'amokit-addons' ),
                                'amokit-bottom-right-arrow'   => __( 'Bottom Right', 'amokit-addons' ),
                                'amokit-verticle-center-arrow'   => __( 'Vertical Center', 'amokit-addons' ),
                                'amokit-bottom-center-arrow'   => __( 'Bottom Center', 'amokit-addons' ),
                            ],
                            'default' =>'amokit-verticle-center-arrow'

                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_horizontal_postion',
                        [
                            'label' => __( 'Horizontal Position', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -1000,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper button.slick-arrow' => 'left: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .post-carousel-wrapper button.amo-carosul-next.slick-arrow' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
                            ],
                            'condition'=>[
                                'slider_arrow_postion_option' => 'amokit-verticle-center-arrow',
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_horizontal_postion_prev',
                        [
                            'label' => __( 'Horizontal Position Prev', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -1000,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper.amo-top-right-arrow button.slick-arrow,{{WRAPPER}} .post-carousel-wrapper.amo-bottom-right-arrow button.slick-arrow' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
                                '{{WRAPPER}} .post-carousel-wrapper.amo-bottom-center-arrow button.slick-arrow' => 'margin-left: {{SIZE}}{{UNIT}};',

                            ],
                            'condition'=>[
                                'slider_arrow_postion_option!' => 'amokit-verticle-center-arrow',
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_horizontal_postion_right',
                        [
                            'label' => __( 'Horizontal Position Next', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -1000,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper.amo-top-right-arrow button.amo-carosul-next.slick-arrow,{{WRAPPER}} .post-carousel-wrapper.amo-bottom-right-arrow button.amo-carosul-next.slick-arrow' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
                                '{{WRAPPER}} .post-carousel-wrapper.amo-bottom-center-arrow button.amo-carosul-next.slick-arrow' => 'margin-right: {{SIZE}}{{UNIT}}; left:auto;',
                            ],
                            'condition'=>[
                                'slider_arrow_postion_option!' => 'amokit-verticle-center-arrow',
                            ]
                        ]
                    );


                    $this->add_responsive_control(
                        'slider_arrow_verticle_postion',
                        [
                            'label' => __( 'Vertical Position', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -1000,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-carousel-wrapper button.slick-arrow' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );                    
                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label' => __( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow:hover svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation button.slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Slider arrow style end

        // Style Pagination button tab section
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label' => __( 'Pagination', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on' => 'yes',
                    'sldots'=>'yes',
                   
                ]
            ]
        );
            
            $this->start_controls_tabs('pagination_style_tabs');

                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
                        [
                            'label' => __( 'Height', 'amokit-addons' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_pagination_width',
                        [
                            'label' => __( 'Width', 'amokit-addons' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-carousel-activation .slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pagination_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-carousel-activation .slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-carousel-activation .slick-dots li:hover button, {{WRAPPER}} .amo-carousel-activation .slick-dots li.slick-active button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pagination_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-carousel-activation .slick-dots li:hover button, {{WRAPPER}} .amo-carousel-activation .slick-dots li.slick-active button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li.slick-active button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .amo-carousel-activation .slick-dots li:hover button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings  = $this->get_settings_for_display();
        $sectionid = "sid". $this-> get_id();
        $post_slider_image_overlay_hover = isset( $settings['post_slider_image_overlay_hover_background'] ) ? $settings['post_slider_image_overlay_hover_background'] : '';
        $amokit_post_image  =  $this->get_settings_for_display('amokit_post_image_size');
        $post_type =  isset( $settings['carousel_post_type'] ) ? $settings['carousel_post_type'] : 'post';
        $post_categorys = [];
        if( 'post'== $post_type && ! empty( $settings['carousel_categories'] ) && is_array( $settings['carousel_categories'] ) ) {
            $post_categorys = $settings['carousel_categories'];
        } else if( 'product'== $post_type && ! empty( $settings['carousel_prod_categories'] ) && is_array( $settings['carousel_prod_categories'] ) ) {
            $post_categorys = $settings['carousel_prod_categories'];
        }else {
            if( ! empty( $settings[ $post_type.'_post_category'] )  && is_array( $settings[ $post_type.'_post_category'] ) ) {
                $post_categorys =  $settings[ $post_type.'_post_category'];
            }
        }

        $post_author = $settings['post_author'];
        $exclude_posts = $settings['exclude_posts'];
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'amokit_post_carousel', 'class', 'post-carousel-wrapper amokit-postcarousel-layout-'. esc_attr( $settings['post_carousel_style'].' '. $settings['slider_arrow_postion_option'].' '.$sectionid ) );

        $this->add_render_attribute( 'amokit_post_slider_item_attr', 'class', 'amokit-single-post-slide amokit-postslider-layout-'. esc_attr( $settings['post_carousel_style'] ) );
        // Slider options
        if( $settings['slider_on'] == 'yes' ){

            $direction = is_rtl() ? 'rtl' : 'ltr';
            $this->add_render_attribute( 'amokit_post_slider_attr', 'dir', $direction );
            
            $this->add_render_attribute( 'amokit_post_slider_attr', 'class', 'amokit-carousel-activation' );

            $slider_settings = [
                'sectionid' => esc_attr( $sectionid ),
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => amokit_Icon_manager::render_icon( $settings['slprevicon'], [ 'aria-hidden' => 'true' ] ),
                'arrow_next_txt' => amokit_Icon_manager::render_icon( $settings['slnexticon'], [ 'aria-hidden' => 'true' ] ),
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'slloop' => ('yes' === $settings['slloop']) ? true:false,
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                'center_mode' => ( 'yes' === $settings['slcentermode']),
                'center_padding' => absint($settings['slcenterpadding']),
                'equal_height_column' => ('yes' === $settings['equal_height_column']),
                'equal_height_column_class' => '.post-inner',
            ];

            $slider_responsive_settings = [
                'display_columns' => absint( $settings['slitems'] ),
                'scroll_columns' => absint( $settings['slscroll_columns'] ),
                'tablet_width' => absint( $settings['sltablet_width'] ),
                'tablet_display_columns' => absint( $settings['sltablet_display_columns'] ),
                'tablet_scroll_columns' => absint( $settings['sltablet_scroll_columns'] ),
                'mobile_width' => absint( $settings['slmobile_width'] ),
                'mobile_display_columns' => absint( $settings['slmobile_display_columns'] ),
                'mobile_scroll_columns' => absint( $settings['slmobile_scroll_columns'] ),

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

            $this->add_render_attribute( 'amokit_post_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }

         // Post query
         $args = array(
            'post_type'             => $post_type,
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? (int)$settings['post_limit'] : 3,
        );

        if ( !empty( $post_categorys ) ) {

            $category_name =  get_object_taxonomies($post_type);
            if( $category_name && $category_name['0'] == "product_type" ){
                    $category_name['0'] = 'product_cat';
            }

            if( $category_name &&  is_array($post_categorys) && count($post_categorys) > 0 ){

                $field_name = is_numeric( $post_categorys[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $category_name[0],
                        'terms' => $post_categorys,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }
        // author check
        if (  !empty( $post_author ) && is_array( $post_author ) ) {
            $args['author__in'] = $post_author;
        }
        // order by  check
        if ( !empty( $orderby ) ) {
            if ( 'date' == $orderby && 'yes'== $settings['custom_order_by_date'] && (!empty( $settings['order_by_date_after'] || $settings['order_by_date_before'] ) ) ) {
            $order_by_date_after = strtotime($settings['order_by_date_after']);
            $order_by_date_before = strtotime($settings['order_by_date_before']);
                $args['date_query'] = array(
                    array(
                        'before'    => array(
                            'year'  => gmdate('Y', $order_by_date_before),
                            'month' =>gmdate('m', $order_by_date_before),
                            'day'   => gmdate('d', $order_by_date_before),
                        ),
                        'after'    => array(
                            'year'  => gmdate('Y', $order_by_date_after),
                            'month' =>gmdate('m', $order_by_date_after),
                            'day'   => gmdate('d', $order_by_date_after),
                        ),
                        'inclusive' => true,
                    ),
                );

            } else {
                $args['orderby'] = $orderby;
            }
        }

        // Exclude posts check
        if (  !empty( $exclude_posts ) ) {
            $exclude_posts = explode(',',$exclude_posts);
            $args['post__not_in'] =  $exclude_posts;
        }

        // Order check
        if (  !empty( $postorder ) ) {
            $args['order'] =  $postorder;
        }
        // empty thumbnail post
        if ( 'yes' === $settings['hide_empty_thumbnail_post'] ) {
            $args['meta_query'] = [
                [
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                ],
            ];
        }

        $carousel_post = new \WP_Query( $args );

        $s_display_none = ( 'yes' == $settings['slider_on'] ) ? ' style="display:none;"':'';
        ?>
            <div <?php echo $this->get_render_attribute_string( 'amokit_post_carousel' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'amokit_post_slider_attr' ).$s_display_none; ?>>

                    <?php
                if( $carousel_post->have_posts() ):
                    while( $carousel_post->have_posts() ): $carousel_post->the_post();
                            ?>

                        <?php if( $settings['post_carousel_style'] == 2 ): ?>
                            <div <?php echo $this->get_render_attribute_string( 'amokit_post_slider_item_attr' ); ?> >
                                <div class="thumb">
                                    <a href="<?php the_permalink();?>"><?php $this->amokit_render_loop_thumbnail( $amokit_post_image );?></a>
                                </div>
                                <?php $this->amokit_render_loop_content( 2,$carousel_post->ID ); ?>
                            </div>

                        <?php elseif( $settings['post_carousel_style'] == 4 ): ?>
                            <div <?php echo $this->get_render_attribute_string( 'amokit_post_slider_item_attr' ); ?> >
                                <div class="post-carousel-flex">
                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>"><?php $this->amokit_render_loop_thumbnail( $amokit_post_image );?></a>
                                    </div>
                                    <?php $this->amokit_render_loop_content(null,$carousel_post->ID); ?>
                                </div>
                            </div>

                        <?php elseif( $settings['post_carousel_style'] == 5 ): ?>
                            <div <?php echo $this->get_render_attribute_string( 'amokit_post_slider_item_attr' ); ?> >
                                <div class="thumb">
                                    <a href="<?php the_permalink();?>"><?php $this->amokit_render_loop_thumbnail( $amokit_post_image );?></a>
                                </div>
                                <?php $this->amokit_render_loop_content( 3,$carousel_post->ID ); ?>
                            </div>

                        <?php else:?>
                            <div <?php echo $this->get_render_attribute_string( 'amokit_post_slider_item_attr' ); ?> >
                                <div class="thumb">
                                    <a href="<?php the_permalink();?>"><?php $this->amokit_render_loop_thumbnail( $amokit_post_image  ); ?></a>
                                </div>
                                <?php $this->amokit_render_loop_content(null,$carousel_post->ID); ?>
                            </div>
                        <?php endif;?>

                        <?php 
                    endwhile; wp_reset_postdata(); wp_reset_query(); 

                else:
                    echo "<div class='amo-error-notice'>".esc_html__('There are no posts in this query','amokit-addons')."</div>";
                endif; ?>

                </div>
            </div>
            
            <?php
     if( 'null'!= $post_slider_image_overlay_hover && ''!= $post_slider_image_overlay_hover  ){
        $amokit_print_css = "
            .{$sectionid} .amo-single-post-slide:hover .thumb a:after{
                opacity: 0;
              }";
             ?> 
              <style><?php echo esc_html( $amokit_print_css ); ?></style>
    <?php } ?>


        <?php

    }

    // Loop Content
    public function amokit_render_loop_content( $contetntstyle = NULL, $post_id = null  ){
        $settings   = $this->get_settings_for_display();
        $category_name =  get_object_taxonomies($settings['carousel_post_type']);
        ?>
            <div class="content <?php echo esc_attr( $settings['border_type'] ); ?>">
                <div class="post-inner">
                    <?php 
                    if( $settings['show_category'] == 'yes' ): 
                        if( $category_name ){
                            $get_terms = get_the_terms($post_id, $category_name[0] );
                            if($settings['carousel_post_type'] == 'product'){
                                $get_terms = get_the_terms($post_id, 'product_cat');
                            }
                            if($get_terms){
                                ?>
                                <ul class="post-category">
                                    <?php
                                    foreach ( $get_terms as $category ) {
                                        $term_link = get_term_link( $category );
                                        ?>
                                            <li><a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name );?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            <?php 
                            }
                        }
                    endif; ?>

                    <?php
                        if( $contetntstyle == 3 ):
                            if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): 
                    ?>
                            <ul class="meta">
                                <?php if( $settings['show_author'] == 'yes' ): ?>
                                    <li><i class="fa fa-user-circle"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author();?></a></li>
                                <?php endif; if( $settings['show_date'] == 'yes' ):?>
                                    <li><i class="fa fa-clock-o"></i><?php the_time('d F Y');?></li>
                                <?php endif; ?>
                            </ul>
                                
                    <?php endif; endif;?>

                    <?php if( $settings['show_title'] == 'yes' ):
                        
                        if ( 0 > $settings['title_length'] ) { ?>
                            <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                        <?php
                        } else { ?>
                            <h2><a href="<?php the_permalink();?>"><?php echo esc_html( wp_trim_words( get_the_title(), floatval( $settings['title_length'] ), '' ) ); ?></a></h2>
                        <?php
                         }
                        
                        endif;?>

                    <?php
                        if( $contetntstyle != 2 ):
                            if( $contetntstyle != 3 ):
                            if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): 
                    ?>
                                <ul class="meta">
                                    <?php if( $settings['show_author'] == 'yes' ): ?>
                                        <li><i class="fa fa-user-circle"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author();?></a></li>
                                    <?php endif; if( $settings['show_date'] == 'yes' ):?>
                                        <li><i class="fa fa-clock-o"></i><?php the_time('d F Y');?></li>
                                    <?php endif; ?>
                                </ul>

                    <?php endif; endif;endif;?>

                    <?php
                        if( $settings['show_content'] == 'yes' ){
                            if( $settings['content_type'] == 'excerpt' ){
                                echo '<p>'. esc_html( wp_trim_words( get_the_excerpt(), floatval( $settings['content_length'] ),'' ) ) .'</p>';
                            } else {
                                echo '<p>'. wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), floatval( $settings['content_length'] ), '' ) ).'</p>'; 
                            }
                        }
                    ?>

                    <?php
                        if( $contetntstyle == 2 ):
                            if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): 
                    ?>
                            <ul class="meta">
                                <?php if( $settings['show_author'] == 'yes' ): ?>
                                    <li><i class="fa fa-user-circle"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ) ; ?>"><?php the_author();?></a></li>
                                <?php endif; if( $settings['show_date'] == 'yes' ):?>
                                    <li><i class="fa fa-clock-o"></i><?php the_time('d F Y');?></li>
                                <?php endif; ?>
                            </ul>
                                
                    <?php endif; endif;?>

                    <?php if( $settings['show_read_more_btn'] == 'yes' ): ?>
                        <div class="post-btn">
                            <a class="readmore-btn" href="<?php the_permalink();?>"><?php echo amokit_kses_desc( $settings['read_more_txt'] );?></a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php
    }

    // Loop Thumbnails
    public function amokit_render_loop_thumbnail( $thumbnails_size = 'full' ){
        if ( has_post_thumbnail() ){
            the_post_thumbnail( $thumbnails_size ); 
        }else{
            echo '<img src="' . esc_url( AMONAKIT_ADDONS_PL_URL . '/assets/images/image-placeholder.png' ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
        }
    }
    // post query fields
    public function show_post_source(){

        $this->add_control(
            'carousel_post_type',
            [
                'label' => esc_html__( 'Post Type', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => amokit_get_post_types(),
                'default' =>'post',
                'frontend_available' => true,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label' => __( 'Include By', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'default' =>'in_category',
                'options' => [
                    'in_author'      => __( 'Author', 'amokit-addons' ),
                    'in_category'      => __( 'Category', 'amokit-addons' ),
                ],
            ]
        );
        $this->add_control(
            'post_author',
            [
                'label' => esc_html__( 'Authors', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => amokit_get_authors_list(),
                'condition' =>[
                    'include_by' => 'in_author',
                ]
            ]
        );
        $all_post_type = amokit_get_post_types();
        foreach( $all_post_type as $post_key => $post_item ){
            
            if( 'post' == $post_key ){
                $this->add_control(
                    'carousel_categories',
                    [
                        'label' => esc_html__( 'Categories', 'amokit-addons' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => amokit_get_taxonomies(),
                        'condition' =>[
                            'carousel_post_type' => 'post',
                            'include_by' => 'in_category',
                        ]
                    ]
                );
            } else if( 'product' == $post_key){
                $this->add_control(
                    'carousel_prod_categories',
                    [
                        'label' => esc_html__( 'Categories', 'amokit-addons' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => amokit_get_taxonomies('product_cat'),
                        'condition' =>[
                            'carousel_post_type' => 'product',
                            'include_by' => 'in_category',
                        ]
                    ]
                );

            } else {
                $this->add_control(
                    "{$post_key}_post_category",
                    [
                        'label' => esc_html__( 'Select Categories', 'amokit-addons' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => all_object_taxonomie_show_catagory($post_key),
                        'condition' => [
                            'carousel_post_type' => $post_key,
                            'include_by' => 'in_category',
                        ],
                    ]
                );
            }

        }
        $this->add_control(
            "exclude_posts",
            [
                'label' => esc_html__( 'Exclude Posts', 'amokit-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Example: 10,11,105', 'amokit-addons' ),
                'description' => esc_html__( "To Exclude Post, Enter  the post id separated by ','", 'amokit-addons' ),
            ]
        );
        $this->add_control(
            'post_limit',
            [
                'label' => __('Limit', 'amokit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'separator'=>'before',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID'            => esc_html__('ID','amokit-addons'),
                    'date'          => esc_html__('Date','amokit-addons'),
                    'name'          => esc_html__('Name','amokit-addons'),
                    'title'         => esc_html__('Title','amokit-addons'),
                    'comment_count' => esc_html__('Comment count','amokit-addons'),
                    'rand'          => esc_html__('Random','amokit-addons'),
                ],
            ]
        );
        $this->add_control(
            'custom_order_by_date',
            [
                'label' => esc_html__( 'Custom Date', 'amokit-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
                'condition' =>[
                    'orderby'=>'date'
                ]
            ]
        );
        $this->add_control(
            'order_by_date_before',
            [
                'label' => __( 'Before Date', 'amokit-addons' ),
                'type' => Controls_Manager::DATE_TIME,
                'condition' =>[
                    'orderby'=>'date',
                    'custom_order_by_date'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'order_by_date_after',
            [
                'label' => __( 'After Date', 'amokit-addons' ),
                'type' => Controls_Manager::DATE_TIME,
                'condition' =>[
                    'orderby'=>'date',
                    'custom_order_by_date'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'postorder',
            [
                'label' => esc_html__( 'Order', 'amokit-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','amokit-addons'),
                    'ASC'   => esc_html__('Ascending','amokit-addons'),
                ],

            ]
        );
    }

}


<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_TeamMember extends Widget_Base {

    public function get_name() {
        return 'amokit-team-member-addons';
    }
    
    public function get_title() {
        return __( 'Team Member', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-person';
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
        return [ 'amokit', 'Amona Kit', 'team', 'team member', 'member', 'person', 'agent','crew', 'staff', 'client' ];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/team-member-widget/';
    }
    protected function register_controls() {

        // Team Content tab Start
        $this->start_controls_section(
            'amokit_teammember_content',
            [
                'label' => __( 'Team Member', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'amokit_team_style',
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
                        '6'   => __( 'Style Six', 'amokit-addons' ),
                        '7'   => __( 'Style Seven', 'amokit-addons' ),
                        '8'   => __( 'Style Eight', 'amokit-addons' ),
                    ],
                ]
            );
            $this->add_control(
                'amokit_team_content_style',
                [
                    'label' => __( 'Content Style', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'      => __( 'Style One', 'amokit-addons' ),
                        'two'      => __( 'Style Two', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'amokit_team_style' => array('2'),
                    ],
                ]
            );
            $this->add_control(
                'amokit_team_content_style2',
                [
                    'label' => __( 'Content Style', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'      => __( 'Style One', 'amokit-addons' ),
                        'two'      => __( 'Style Two', 'amokit-addons' ),
                        'three'      => __( 'Style Three', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'amokit_team_style' => array('8'),
                    ],
                ]
            );

            $this->add_control(
                'amokit_team_image_hover_style',
                [
                    'label' => __( 'Image Hover Animate', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'none'      => __( 'None', 'amokit-addons' ),
                        'left'      => __( 'Left', 'amokit-addons' ),
                        'right'     => __( 'Right', 'amokit-addons' ),
                        'top'       => __( 'Top', 'amokit-addons' ),
                        'bottom'    => __( 'Bottom', 'amokit-addons' ),
                    ],
                    'condition' =>[
                        'amokit_team_style' =>'4',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'amokit_team_image_hover_on_mobile',
                [
                    'label' => esc_html__( 'Animate Top on Mobile Layout', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' =>[
                        'amokit_team_style' =>'4',
                        'amokit_team_image_hover_style' =>array('left','right'),
                    ],
                    'separator' => 'after',
                ]
            );
            $this->add_control(
                'amokit_member_image',
                [
                    'label' => __( 'Member image', 'amokit-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'amokit_member_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'amokit_member_name',
                [
                    'label' => __( 'Name', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Sams Roy',
                    'placeholder' => __( 'Sams Roy', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'amokit_member_designation',
                [
                    'label' => __( 'Designation', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Managing director', 'amokit-addons' ),
                    'condition' =>[
                        'amokit_team_style' => array('1','3','5','6','7','8','2','4'),
                    ],
                ]
            );
            
            $this->add_control(
                'amokit_member_bioinfo',
                [
                    'label' => __( 'Bio Info', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'I am web developer.', 'amokit-addons' ),

                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                            'terms' => [
                                    ['name' => 'amokit_team_style', 'operator' => 'in', 'value' => ['1','5','6']]
                                ]
                            ],
                            [
                            'terms' => [
                                    ['name' => 'amokit_team_style', 'operator' => '===', 'value' => '4'],
                                    ['name' => 'amokit_team_image_hover_style', 'operator' => '!==', 'value' => 'none'],
                                ]
                            ],
                        ]
                    ],

                ]
            );
            
        $this->end_controls_section(); // End Team Content tab

        // Social Media tab
        $this->start_controls_section(
            'amokit_team_member_social_link',
            [
                'label' => __( 'Social Media', 'amokit-addons' ),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'amokit_social_title',
                [
                    'label'   => __( 'Title', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => 'Facebook',
                ]
            );

            $repeater->add_control(
                'amokit_social_link',
                [
                    'label'   => __( 'Link', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'https://www.facebook.com/nasdesigns.company/', 'amokit-addons' ),
                ]
            );

            $repeater->add_control(
                'amokit_social_icon',
                [
                    'label'   => __( 'Icon', 'amokit-addons' ),
                    'type'    => Controls_Manager::ICONS,
                    'default' => [
                        'value'=>'fab fa-facebook-f',
                        'library'=>'solid',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_icon_color',
                [
                    'label'     => __( 'Icon Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_icon_background',
                [
                    'label'     => __( 'Icon Background', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_icon_hover_color',
                [
                    'label'     => __( 'Icon Hover Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a:hover svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_icon_hover_background',
                [
                    'label'     => __( 'Icon Hover Background', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_control(
                'amokit_icon_hover_border_color',
                [
                    'label'     => __( 'Icon Hover border color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-social-network {{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'amokit_team_member_social_link_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [

                        [
                            'amokit_social_title'      => 'Facebook',
                            'amokit_social_icon'       => 'fab fa-facebook-f',
                            'amokit_social_link'       => __( 'https://www.facebook.com/nasdesigns.company/', 'amokit-addons' ),
                        ],
                    ],
                    'title_field' => '{{{ amokit_social_title }}}',
                    'prevent_empty'=>false,
                ]
            );

        $this->end_controls_section(); // End Social Member tab

        // Member Item Style tab section
        $this->start_controls_section(
            'amokit_team_member_style',
            [
                'label' => __( 'Team Box Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'team_member_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_member_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => '8',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'team_item_border_box',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-team',
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => '8',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_item_border_radius_box',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team,{{WRAPPER}} .amo-team-style-2 .amo-thumb img, {{WRAPPER}} .amo-team-style-4 .amo-thumb,{{WRAPPER}} .amo-team-style-4 .amo-thumb img,{{WRAPPER}} .amo-team-style-4 .amo-team-hover-action::before,{{WRAPPER}} .amo-team-style-4 .amo-team-hover-action' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => '8',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'team_member_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-team,{{WRAPPER}} .amo-team-style-6 .amo-team-info',
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => array( '8','2','5','4' ),
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'team_item_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-team-style-7, {{WRAPPER}} .amo-team',
                    'separator' =>'before',
                ]
            );            
            $this->add_control(
                'team_member_hover_content_bg',
                [
                    'label' => __( 'Hover Background Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => 'rgba(24, 1, 44, 0.6)',
                    'selectors' => [
                        '{{WRAPPER}} .amo-team:hover .amo-team-hover-action' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .amo-team-style-6:hover .amo-team-info' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .amo-team-style-4 .amo-team-hover-action::before,{{WRAPPER}} .amo-team-style-1::before' => 'background-color: {{VALUE}};',
                    ],
                    'condition' =>[
                        'amokit_team_style' => array( '1','4','5','6' ),
                    ],
                ]
            );
            $this->add_responsive_control(
                'team_member_hover_st4_space',
                [
                    'label' => __( 'Hover Round Space', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-4 .amo-team-image-hover-none .amo-team-hover-action::before' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};left: {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style' => '4',
                        'amokit_team_image_hover_style' => 'none',
                        
                    ],
                ]
            );

            $this->add_control(
                'team_member_hover_content_bg_2',
                [
                    'label' => __( 'Hover Content background color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-2 .amo-team-hover-action .amo-hover-action' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .amo-team-click-action' => 'background-color: {{VALUE}};',
                    ],

                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                            'terms' => [
                                    ['name' => 'amokit_team_style', 'operator' => '===', 'value' => '3'],
                                ]
                            ],
                            [
                            'terms' => [
                                    ['name' => 'amokit_team_style', 'operator' => '===', 'value' => '2'],
                                    ['name' => 'amokit_team_content_style', 'operator' => '===', 'value' => 'one'],
                                ]
                            ],
                        ]
                    ],
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'team_member_plus_icon_color',
                [
                    'label' => __( 'Plus Icon Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-3 .plus_click::before' => 'color: {{VALUE}};',
                    ],
                    'condition' =>[
                        'amokit_team_style' => array('3'),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'team_member_plus_icon_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-team-style-3 .plus_click::before',
                    'condition' =>[
                        'amokit_team_style' => array('3'),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'team_member_plus_icon_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-team-style-3 .plus_click::before',
                    'condition' =>[
                        'amokit_team_style' => array('3'),
                    ],
                ]
            );
            // Team content Box Style
            $this->add_control(
                'content_box_bg_heading',
                [
                    'label' => __( 'Content Box Background', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => array( '4','6','3','5' ),
                    ],
                ]
            ); 
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'team_content_background_box',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-team .amo-team-content,{{WRAPPER}} .amo-team-style-2 .amo-team-hover-action .amo-hover-action, {{WRAPPER}} .amo-team-hover-action.amo-action-hover-st2 .amo-hover-action',
                    'condition' =>[
                        'amokit_team_style!' => array( '4','6','3','5' ),
                    ],
                ]
            );
            $this->add_control(
                'content_box_bg_hover_heading',
                [
                    'label' => __( 'Content Box Hover Background', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' =>'before',
                    'condition' =>[
                        'amokit_team_style!' => array( '4','6','7','3','2','5' ),
                    ],
                ]
            ); 
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'team_content_hover_background_box',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-team-style-8 .amo-team-hover-action',
                    'condition' =>[
                        'amokit_team_style!' => array( '4','6','7','3','2','5' ),
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'team_content_border_box',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-team .amo-team-content',
                    'condition' =>[
                        'amokit_team_style!' => array( '4','6','3','5' ),
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_content_border_radius_box',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-content,{{WRAPPER}} .amo-team-style-2 .amo-team-hover-action .amo-hover-action' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition' =>[
                        'amokit_team_style!' => array('8','4','6','3','5'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_content_margin_box',
                [
                    'label' => __( 'Content Box Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .amo-team-style-2 .amo-team-hover-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'amokit_team_style!' => array( '4','3','5', ),
                    ],
                ]
            );
            $this->add_responsive_control(
                'team_content_padding_box',
                [
                    'label' => __( 'Content Box Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-content,{{WRAPPER}} .amo-team-style-2 .amo-team-hover-action .amo-hover-action,{{WRAPPER}} .amo-team-style-5 .amo-team-hover-action .amo-hover-action,{{WRAPPER}} .amo-team-style-4 .amo-team-hover-action .amo-hover-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' =>[
                        'amokit_team_style!' => array('3' ),
                    ],
                ]
            );
            $this->add_responsive_control(
                'team_content_alignment_box',
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
                        '{{WRAPPER}} .amo-team .amo-team-content,{{WRAPPER}} .amo-team-style-5 .amo-team-hover-action .amo-hover-action,{{WRAPPER}} .amo-team-style-4 .amo-team-hover-action .amo-hover-action,{{WRAPPER}} .amo-team ul.amo-social-network' => 'text-align: {{VALUE}};',
                    ],
                    'condition' =>[
                        'amokit_team_style!' => array('6','3' ),
                    ],
                ]
            );
            $this->add_control(
                'team_content_corner_shape_color',
                [
                    'label' => __( 'Corner Shape Color', 'amokit-addons' ),
                    'description' => __( 'To hide the shape, please set the color to transparent.', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#8e74ff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-8::before,{{WRAPPER}} .amo-team-style-8::after' => 'border-color: {{VALUE}};',
                    ],
                    'condition' =>[
                        'amokit_team_style' => '8',
                    ],
                ]
            );           
            $this->add_control(
                'team_content_corner_shape_hover',
                [
                    'label' => __( 'Hover Shape Color', 'amokit-addons' ),
                    'description' => __( 'To hide the shape, please set the color to transparent.', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-8 .amo-team-hover-action:after' => 'background-color: {{VALUE}};',
                    ],
                    'condition' =>[
                        'amokit_team_style' => '8',
                    ],
                ]
            );  
            $this->add_control(
                'show_img_animation',
                [
                    'label' => esc_html__( 'ON/OFF Image Hover rotation', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'no',
                    'default' => 'yes',
                    'condition' =>[
                        'amokit_team_style' => array( '6','7','8' ),
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Team Member Name style tab start
        $this->start_controls_section(
            'amokit_team_member_name_style',
            [
                'label'     => __( 'Name', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_member_name!' => '',
                ],
            ]
        );

            $this->add_control(
                'team_name_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'team_name_typography',
                    'selector' => '{{WRAPPER}} .amo-team .amo-team-name',
                ]
            );

            $this->add_responsive_control(
                'team_name_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_name_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_name_align',
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
                        '{{WRAPPER}} .amo-team .amo-team-name' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Team Member Name style tab end

        // Team Member Designation style tab start
        $this->start_controls_section(
            'amokit_team_member_designation_style',
            [
                'label'     => __( 'Designation', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_member_designation!' => '',
                    'amokit_team_style' =>array('1','3','5','6','7','8','2','4'),
                ],
            ]
        );

            $this->add_control(
                'team_designation_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-designation' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'team_designation_typography',
                    'selector' => '{{WRAPPER}} .amo-team .amo-team-designation',
                ]
            );

            $this->add_responsive_control(
                'team_designation_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_designation_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_designation_align',
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
                        '{{WRAPPER}} .amo-team .amo-team-designation' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Team Member Designation style tab end

        // Team Member Bio Info style tab start
        $this->start_controls_section(
            'amokit_team_member_bioinfo_style',
            [
                'label'     => __( 'Bio info', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'amokit_member_bioinfo!' => '',
                    'amokit_team_style' => array('1','5','6','4'),
                ],
            ]
        );

            $this->add_control(
                'team_bioinfo_color',
                [
                    'label' => __( 'Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-bio-info' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'team_bioinfo_typography',
                    'selector' => '{{WRAPPER}} .amo-team .amo-team-bio-info',
                ]
            );

            $this->add_responsive_control(
                'team_bioinfo_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-bio-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_bioinfo_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team .amo-team-bio-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_bioinfo_align',
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
                        '{{WRAPPER}} .amo-team .amo-team-bio-info' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Team Member Designation style tab end

        // Team Member Social Media style tab start
        $this->start_controls_section(
            'amokit_team_member_socialmedia_style',
            [
                'label'     => __( 'Social Media', 'amokit-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'team_socialmedia_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-network li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_socialmedia_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-network li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_socialmedia_align',
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
                        '{{WRAPPER}} .amo-team ul.amo-social-network' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'team_socialmedia_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-network li a',
                ]
            );

            $this->add_responsive_control(
                'team_socialmedia_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-network li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'team_socialmedia_boxshadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-social-network li a',
                ]
            );

            $this->add_responsive_control(
                'team_socialmedia_font_size',
                [
                    'label' => __( 'Font Size', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-social-network li a' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .amo-social-network li a svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
                        
            $this->add_responsive_control(
                'team_socialmedia_height_widht',
                [
                    'label' => __( 'Height and Width', 'amokit-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-team-style-7 .amo-team-hover-action .amo-hover-action .amo-social-network li a,{{WRAPPER}} .amo-social-network li a' => 'height: {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section(); // Team Member Designation style tab end

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $sectionid = "sid". $this-> get_id();


        $this->add_render_attribute( 'team_area_attr', 'class', 'amokit-team' );
        if( '8' == $settings['amokit_team_style'] ){
            if( 'two'== $settings['amokit_team_content_style2'] ){
                $this->add_render_attribute( 'team_area_attr', 'class', 'amokit-st8-new amokit-team-style-7 amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) );
            } elseif( 'three'== $settings['amokit_team_content_style2'] ){
                $this->add_render_attribute( 'team_area_attr', 'class', 'amokit-st8-new3 amokit-st8-new amokit-team-style-7 amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) );
            }
            else {
                $this->add_render_attribute( 'team_area_attr', 'class', ' amokit-team-style-7 amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) );
            }

            $this->add_render_attribute( 'team_area_attr', 'class', ' amokit-team-style-7 amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) );

        } else {

            if( 'two'== $settings['amokit_team_content_style'] ){
                $this->add_render_attribute( 'team_area_attr', 'class', 'amokit-st2-new amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) ); 
            } else {
                $this->add_render_attribute( 'team_area_attr', 'class', 'amokit-team-style-' . esc_attr( $settings['amokit_team_style'].' '.$sectionid ) );
            }
        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'team_area_attr' ); ?> >

                <?php if( $settings['amokit_team_style'] == 2 ): ?>
                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );
                        // for new design
                        if( 'two'== $settings['amokit_team_content_style'] ){ ?>
                            <div class="amo-team-hover-action amokit-action-hover-st2">
                                <div class="amo-hover-action">
                                    <div class="amo-hover-content-box-st2">
                                        <?php
                                        if( !empty($settings['amokit_member_name']) ){
                                            echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                        }
                                        if( !empty($settings['amokit_member_designation']) ){
                                            echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                        }
                                        ?>
                                    </div>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php
                      } else {  ?>                        
                            <div class="amo-team-hover-action">
                                <div class="amo-hover-action">
                                    <?php
                                        if( !empty($settings['amokit_member_name']) ){
                                            echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                        }
                                        if( !empty($settings['amokit_member_designation']) ){
                                            echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                        }
                                    ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>

                <?php elseif( $settings['amokit_team_style'] == 3 ):?>
                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">

                            <div class="amo-team-click-action">
                                <div class="plus_click"></div>
                                <?php
                                    if( !empty($settings['amokit_member_name']) ){
                                        echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                    }
                                    if( !empty($settings['amokit_member_designation']) ){
                                        echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                    }
                                ?>
                                <ul class="amo-social-network">
                                    <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                        <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                <?php 
                    elseif( $settings['amokit_team_style'] == 4 ):
                    $this->add_render_attribute( 'team_thumb_attr', 'class', 'amokit-thumb' );
                    $this->add_render_attribute( 'team_thumb_attr', 'class', 'amokit-team-image-hover-' . esc_attr( $settings['amokit_team_image_hover_style'] ) );
                ?>
                    <div <?php echo $this->get_render_attribute_string( 'team_thumb_attr' ); ?>>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">
                            <div class="amo-hover-action">
                                <?php
                                    if( !empty($settings['amokit_member_name']) ){
                                        echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                    } 
                                    if( !empty($settings['amokit_member_designation']) ){
                                        echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                    }
                                    if( !empty($settings['amokit_member_bioinfo']) ){ echo '<p class="amo-team-bio-info">'.amo_kses_desc( $settings['amokit_member_bioinfo'] ).'</p>'; }
                                    if( $settings['amokit_team_member_social_link_list'] ): 
                                ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>

                <?php elseif( $settings['amokit_team_style'] == 5 ):?>
                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">
                            <div class="amo-hover-action">
                                <?php
                                    if( !empty($settings['amokit_member_name']) ){
                                        echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                    }
                                    if( !empty($settings['amokit_member_designation']) ){
                                        echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                    }
                                    if( !empty($settings['amokit_member_bioinfo']) ){ echo '<p class="amo-team-bio-info">'.amo_kses_desc( $settings['amokit_member_bioinfo'] ).'</p>'; }
                                ?>
                                <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>

                <?php elseif( $settings['amokit_team_style'] == 6 ):?>
                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                    </div>
                    <div class="amo-team-info">
                        <div class="amo-team-content">
                            <?php
                                if( !empty($settings['amokit_member_name']) ){
                                    echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                                }
                                if( !empty($settings['amokit_member_designation']) ){
                                    echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                                }
                                if( !empty($settings['amokit_member_bioinfo']) ){ echo '<p class="amo-team-bio-info">'.amo_kses_desc( $settings['amokit_member_bioinfo'] ).'</p>'; }
                            ?>
                        </div>
                        <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                            <ul class="amo-social-network">
                                <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                    <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif;?>
                    </div>

                <?php elseif( $settings['amokit_team_style'] == 7 ):?>

                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">
                            <div class="amo-hover-action">
                                <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="amo-team-content">
                        <?php
                            if( !empty($settings['amokit_member_name']) ){
                                echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                            }
                            if( !empty($settings['amokit_member_designation']) ){
                                echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                            }
                        ?>
                    </div>
                <?php elseif( $settings['amokit_team_style'] == 7 ):?>

                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">
                            <div class="amo-hover-action">
                                <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="amo-team-content">
                        <?php
                            if( !empty($settings['amokit_member_name']) ){
                                echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                            }
                            if( !empty($settings['amokit_member_designation']) ){
                                echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                            }
                        ?>
                    </div>
                <?php elseif( $settings['amokit_team_style'] == 8 ):?>

                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                    </div>
                    <div class="amo-team-content">
                        <?php
                            if( !empty($settings['amokit_member_name']) ){
                                echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                            }
                            if( !empty($settings['amokit_member_designation']) ){
                                echo '<span class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</span>';
                            }
                        ?>
                        <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                        <div class="amo-team-hover-action">
                            <div class="amo-hover-action">
                                
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>                    
                <?php else:?>
                    <div class="amo-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'amokit_member_imagesize', 'amokit_member_image' );?>
                        <div class="amo-team-hover-action">
                            <div class="amo-team-hover">
                                <?php if( $settings['amokit_team_member_social_link_list'] ): ?>
                                    <ul class="amo-social-network">
                                        <?php foreach ( $settings['amokit_team_member_social_link_list'] as $socialprofile ) :?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $socialprofile['_id'] ); ?>" ><a href="<?php echo esc_url( $socialprofile['amokit_social_link'] ); ?>"><?php echo AmoKit_Icon_manager::render_icon( $socialprofile['amokit_social_icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                                <?php if( !empty($settings['amokit_member_bioinfo']) ){ echo '<p class="amo-team-bio-info">'.amo_kses_desc( $settings['amokit_member_bioinfo'] ).'</p>'; }?>
                            </div>
                        </div>
                    </div>
                    <div class="amo-team-content">
                        <?php
                            if( !empty($settings['amokit_member_name']) ){
                                echo '<h4 class="amo-team-name">'.amo_kses_title( $settings['amokit_member_name'] ).'</h4>';
                            }
                            if( !empty($settings['amokit_member_designation']) ){
                                echo '<p class="amo-team-designation">'.esc_html( $settings['amokit_member_designation'] ).'</p>';
                            }
                        ?>
                    </div>
                <?php endif;?>
            </div>

                <?php 
                 $amokit_print_css = '';

                    if( 'no'== $settings['show_img_animation'] ){
                        $amokit_print_css .=  " .{$sectionid}.amo-team-style-7:hover .amo-thumb img,.{$sectionid}.amo-team-style-6:hover .amo-thumb img {
                        transform: scale(1) rotate(0);
                    }";
                    ?>
                <?php } ?>

                <?php if( 'yes'== $settings['amokit_team_image_hover_on_mobile'] ){
                    $amokit_print_css .= " @media (max-width: 767px) {
                        .{$sectionid}.amo-team-style-4 .amo-thumb.amo-team-image-hover-left img,.{$sectionid}.amo-team-style-4 .amo-thumb.amo-team-image-hover-right img {
                            -webkit-transform-origin: 50% 0%;
                            -moz-transform-origin: 50% 0%;
                            -ms-transform-origin: 50% 0%;
                            -o-transform-origin: 50% 0%;
                            transform-origin: 50% 0%;
                        }
                        .{$sectionid}.amo-team-style-4:hover .amo-thumb.amo-team-image-hover-left img,.{$sectionid}.amo-team-style-4:hover .amo-thumb.amo-team-image-hover-right img {
                            -webkit-transform: rotate3d(1, 0, 0, 180deg);
                            -moz-transform: rotate3d(1, 0, 0, 180deg);
                            -ms-transform: rotate3d(1, 0, 0, 180deg);
                            -o-transform: rotate3d(1, 0, 0, 180deg);
                            transform: rotate3d(1, 0, 0, 180deg);
                        }
                        }";
                    ?>
                <?php }
                
                if( '' != $amokit_print_css ){ ?>
                    <style>
                        <?php echo esc_html( $amokit_print_css ); ?>
                    </style>

                <?php } ?>



        <?php
    }
}
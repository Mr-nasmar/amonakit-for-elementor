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

class Bl_Post_Comments_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-post-commnets';
    }

    public function get_title() {
        return __( 'Post Comments', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-comments';
    }

    public function get_categories() {
        return ['amokit_builder'];
    }
    public function get_keywords() {
        return ['post', 'comments', 'comments box', 'comment reply', 'amokit', 'Amona Kit', 'addons'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs';
    }
    protected function register_controls() {
        // Input Box Style
        $this->start_controls_section(
            'post_commnet_inputbox_style_sectionee',
            array(
                'label' => __( 'Post Comments', 'amokit-addons' ),
            )
        );
        $this->add_responsive_control(
            'post_comment_align',
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
                ],
                'default'      => 'left',
                'selectors' => [
                    '{{WRAPPER}} .comment-respond' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'post_commnet_title_section',
            array(
                'label' => __( 'Title & Description', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'post_commnet_title_color',
            [
                'label'     => __( 'Title Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-reply-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'post_commnet_title_typography',
                'label'     => __( 'Typography', 'amokit-addons' ),
                'selector'  => '{{WRAPPER}} .comment-reply-title',
            )
        );
        $this->add_responsive_control(
            'post_commnet_title_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .comment-reply-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'post_commnet_description_color',
            [
                'label'     => __( 'Description Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logged-in-as, {{WRAPPER}} .comment-notes' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'post_commnet_description_link_color',
            [
                'label'     => __( 'Description Link Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logged-in-as a, {{WRAPPER}} .comment-notes a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'post_commnet_description_typography',
                'label'     => __( 'Typography', 'amokit-addons' ),
                'selector'  => '{{WRAPPER}} .logged-in-as, {{WRAPPER}} .comment-notes',
            )
        );

        $this->end_controls_section();

        // Input Box Style
        $this->start_controls_section(
            'post_commnet_inputbox_style_section',
            array(
                'label' => __( 'Input Box', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'post_commnet_inputbox_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} form.comment-form input[type="text"],
                        {{WRAPPER}} form.comment-form input[type="email"],
                        {{WRAPPER}} form.comment-form input[type="url"],
                        {{WRAPPER}} form.comment-form textarea' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'post_commnet_inputbox_typography',
                    'label'     => __( 'Typography', 'amokit-addons' ),
                    'selector'  => '{{WRAPPER}} form.comment-form input[type="text"], {{WRAPPER}} form.comment-form textarea',
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'post_commnet_inputbox_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} form.comment-form input[type="text"],
                    {{WRAPPER}} form.comment-form input[type="email"],
                    {{WRAPPER}} form.comment-form input[type="url"],
                    {{WRAPPER}} form.comment-form textarea',
                ]
            );
            $this->add_control(
                'post_commnet_label_color',
                [
                    'label'     => __( 'Label Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} form.comment-form label' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'post_commnet_label_typography',
                    'label'     => __( 'Typography', 'amokit-addons' ),
                    'selector'  => '{{WRAPPER}} form.comment-form label',
                )
            );
        $this->end_controls_section();

        // Submit Button
        $this->start_controls_section(
            'post_commnet_submitbtn_style_section',
            array(
                'label' => __( 'Submit Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->start_controls_tabs('submitbtn_style_tabs');

                // Submit Button Normal
                $this->start_controls_tab(
                    'submitbtn_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'post_commnet_submitbtn_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} form.comment-form input[type="submit"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'post_commnet_submitbtn_bg_color',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} form.comment-form input[type="submit"]' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        array(
                            'name'      => 'post_commnet_submitbtn_typography',
                            'label'     => __( 'Typography', 'amokit-addons' ),
                            'selector'  => '{{WRAPPER}} form.comment-form input[type="submit"]!important',
                        )
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'post_commnet_submitbtn_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} form.comment-form input[type="submit"]!important',
                        ]
                    );

                $this->end_controls_tab();

                // Submit Button Hover
                $this->start_controls_tab(
                    'submitbtn_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'post_commnet_submitbtn_hover_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} form.comment-form input[type="submit"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'post_commnet_submitbtn_hover_bg_color',
                        [
                            'label'     => __( 'Background Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} form.comment-form input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'post_commnet_submitbtn_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} form.comment-form input[type="submit"]:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        if( Elementor::instance()->editor->is_edit_mode() ){ ?>
            <section id="comments" class="comments-area">
                <div id="respond" class="comment-respond">
                    <h2 id="reply-title" class="comment-reply-title"><?php esc_html_e( 'Leave a Reply', 'amokit-addons' ); ?> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;"><?php esc_html_e( 'Cancel reply', 'amokit-addons' ); ?></a></small></h2>
                    <form action="#" method="post" id="commentform" class="comment-form" novalidate="" autocomplete="off">
                        <p class="logged-in-as"><?php esc_html_e( 'Logged in as admin.', 'amokit-addons' ); ?> <a href="#"><?php esc_html_e( 'Edit your profile.', 'amokit-addons' ); ?></a> <a href="#"><?php esc_html_e( 'Log out?', 'amokit-addons' ); ?></a> <span class="required-field-message"><?php esc_html_e( 'Required fields are marked', 'amokit-addons' ); ?> <span class="required"><?php esc_html_e( '*', 'amokit-addons' ); ?></span></span></p>
                        <p class="comment-form-comment"><label for="comment"><?php esc_html_e( 'Comment', 'amokit-addons' ); ?> <span class="required"><?php esc_html_e( '*', 'amokit-addons' ); ?></span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="" autocomplete="off" spellcheck="false" data-ms-editor="true"></textarea></p>
                        <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment" autocomplete="off"> <input type="hidden" name="comment_post_ID" value="534" id="comment_post_ID" autocomplete="off">
                    </form>
                </div>
                
            </section>
        <?php
        }else{
            if( !comments_open() ){
                ?>
                    <span class="htcomment-close">
                        <?php esc_html_e( 'Comments Are Closed', 'amokit-addons' ); ?>
                    </span>
                <?php
            }else{
                comments_template();
            }
        }
    }

    

}

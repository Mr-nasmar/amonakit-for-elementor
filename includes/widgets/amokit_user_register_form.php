<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_User_Register_Form extends Widget_Base {

    public function get_name() {
        return 'amokit-userregister-form-addons';
    }
    
    public function get_title() {
        return __( 'User Register Form', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-lock-user';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_keywords() {
        return ['user register form', 'register form', 'amokit', 'Amona Kit', 'create account'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/user-register-form-widget/';
    }

    public function get_style_depends() {
        return [
            'elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','amokit-widgets',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'user_register_form_content',
            [
                'label' => __( 'Register Form', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'register_form_style',
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
                    ],
                ]
            );        
            
            $this->add_control(
                'amokit_register_heading',
                [
                    'label' => __( 'Register Heading', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );  

            $this->add_control(
                'show_register_heading',
                [
                    'label' => __( 'Show Heading And Content', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'register_heading_title',
                [
                    'label' => __( 'Register Heading', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __( 'Hello!', 'amokit-addons' ),
                    'placeholder' => __( 'Hello!', 'amokit-addons' ),
                    'condition'=>[
                        'show_register_heading'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'register_heading_content',
                [
                    'label' => __( 'Register Content', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( "Don’t Have account? You can create an account by using this form. ","amokit-addons" ),
                    'placeholder' => __( "Don’t Have account? You can create an account by using this form. ","amokit-addons" ),
                    'condition'=>[
                        'show_register_heading'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'register_heading_url',
                [
                    'label' => __( 'Register Heading Login', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'condition'=>[
                        'show_register_heading'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'register_heading_url_control',
                [
                    'label' => __( 'URL Content', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Sign in', 'amokit-addons' ),
                    'placeholder' => __( 'Sign in', 'amokit-addons' ),
                    'condition'     => [
                        'register_heading_url' => 'yes',
                    ],
                ]
            );            
            
            $this->add_control(
                'amokit_register_form',
                [
                    'label' => __( 'Register Form', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );            

            $this->add_control(
                'show_firstname',
                [
                    'label' => __( 'Show First Name', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_lastname',
                [
                    'label' => __( 'Show Last Name', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_nickname',
                [
                    'label' => __( 'Nick Name', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_website',
                [
                    'label' => __( 'Website', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_bio',
                [
                    'label' => __( 'Biographical Info', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_terms',
                [
                    'label' => esc_html__( 'Terms and conditions', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default'=>'no',
                ]
            );

            $this->add_control(
                'terms_label',
                [
                    'label' => esc_html__( 'Terms and conditions Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Creating an account means you’re okay with our Terms of Service, Privacy Policy', 'amokit-addons' ),
                    'placeholder' => esc_html__( 'Terms and conditions', 'amokit-addons' ),
                    'condition'=>[
                        'show_terms'=>'yes',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'select_terms_page',
                [
                    'label' => __( 'Terms & Condition Page', 'amokit-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => amokit_get_page_list(),
                    'condition'=>[
                        'show_terms'=>'yes',
                    ],
                ]
            );       

            $this->add_control(
                'terms_conditions_label_color_settings',
                [
                    'label' => __( 'Color Settings', 'amokit-addons' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'None', 'amokit-addons' ),
                    'label_on' => __( 'Custom', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );

            $this->start_popover();

            $this->add_control(
                'terms_conditions_label_text_color',
                [
                    'label'     => __( 'Text Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label.amo-form-label'   => 'color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'terms_conditions_label_link_color',
                [
                    'label'     => __( 'Link Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label.amo-form-label a.terms-conditions'   => 'color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'terms_conditions_label_link_hover_color',
                [
                    'label'     => __( 'Link Hover Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label.amo-form-label a.terms-conditions:hover'   => 'color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );
            
            $this->end_popover();     

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'terms_conditions_label_typography',
                    'selector' => '{{WRAPPER}} .amo-register-wrapper label.amo-form-label',
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );          

            $this->add_responsive_control(
                'terms_conditions_label_padding',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper .termscondition' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'show_terms'=>'yes',
                    ],
                ]
            );  

            $this->add_responsive_control(
                'show_terms_align',
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
                        '{{WRAPPER}} .termscondition' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'condition'=>[
                        'show_terms'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_label',
                [
                    'label' => __( 'Show label', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition'=>[
                        'register_form_style!'=>'3',
                    ]
                ]
            );

            $this->add_control(
                'show_custom_label',
                [
                    'label' => __( 'Custom label', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition'=>[
                        'show_label'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'username_label',
                [
                    'label' => __( 'Username Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Username', 'amokit-addons' ),
                    'placeholder' => __( 'Username', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'password_label',
                [
                    'label' => __( 'Password Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Password', 'amokit-addons' ),
                    'placeholder' => __( 'Password', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'email_label',
                [
                    'label' => __( 'Mail Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Mail', 'amokit-addons' ),
                    'placeholder' => __( 'Mail', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'firstname_label',
                [
                    'label' => __( 'First Name Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'First Name', 'amokit-addons' ),
                    'placeholder' => __( 'First Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                        'show_firstname'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'lastname_label',
                [
                    'label' => __( 'Last Name Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Last Name', 'amokit-addons' ),
                    'placeholder' => __( 'Last Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                        'show_lastname'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'nickname_label',
                [
                    'label' => __( 'Nick Name Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Nick Name', 'amokit-addons' ),
                    'placeholder' => __( 'Nick Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                        'show_nickname'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'website_label',
                [
                    'label' => __( 'Website Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Website', 'amokit-addons' ),
                    'placeholder' => __( 'Website', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                        'show_website'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'bio_label',
                [
                    'label' => __( 'Biographical Info Label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Biographical', 'amokit-addons' ),
                    'placeholder' => __( 'Biographical', 'amokit-addons' ),
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_custom_label'=>'yes',
                        'show_bio'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_custom_placeholder',
                [
                    'label' => __( 'Custom Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'amokit-addons' ),
                    'label_off' => __( 'Hide', 'amokit-addons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'username_placeholder_label',
                [
                    'label' => __( 'Username Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Username', 'amokit-addons' ),
                    'placeholder' => __( 'Username', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'password_placeholder_label',
                [
                    'label' => __( 'Password Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Password', 'amokit-addons' ),
                    'placeholder' => __( 'Password', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'email_placeholder_label',
                [
                    'label' => __( 'Mail Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Mail', 'amokit-addons' ),
                    'placeholder' => __( 'Mail', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'firstname_placeholder_label',
                [
                    'label' => __( 'First Name Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'First Name', 'amokit-addons' ),
                    'placeholder' => __( 'First Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                        'show_firstname'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'lastname_placeholder_label',
                [
                    'label' => __( 'Last Name Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Last Name', 'amokit-addons' ),
                    'placeholder' => __( 'Last Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                        'show_lastname'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'nickname_placeholder_label',
                [
                    'label' => __( 'Nick Name Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Nick Name', 'amokit-addons' ),
                    'placeholder' => __( 'Nick Name', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                        'show_nickname'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'website_placeholder_label',
                [
                    'label' => __( 'Website Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Website', 'amokit-addons' ),
                    'placeholder' => __( 'Website', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                        'show_website'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'bio_placeholder_label',
                [
                    'label' => __( 'Biographical Placeholder', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Bio', 'amokit-addons' ),
                    'placeholder' => __( 'Bio', 'amokit-addons' ),
                    'condition'=>[
                        'show_custom_placeholder'=>'yes',
                        'show_bio'=>'yes',
                    ],
                ]
            ); 

            $this->add_control(
                'submit_button_label',
                [
                    'label' => __( 'Submit Button label', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'REGISTER', 'amokit-addons' ),
                    'placeholder' => __( 'REGISTER', 'amokit-addons' ),
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'redirect_page',
                [
                    'label' => __( 'Redirect page after register', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'redirect_page_url',
                [
                    'type'          => Controls_Manager::URL,
                    'show_label'    => false,
                    'show_external' => false,
                    'separator'     => false,
                    'placeholder'   => 'http://your-link.com/',
                    'condition'     => [
                        'redirect_page' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'login_option_content',
                [
                    'label' => __( 'Or Login Text', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                ]
            );

            $this->add_control(
                'or_login_content_text',
                [
                    'label' => __( 'Or Login Content', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'or you can', 'amokit-addons' ),
                    'placeholder' => __( 'or you can', 'amokit-addons' ),
                    'separator' =>'before',
                    'condition'     => [
                        'login_option_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'login_option_button',
                [
                    'label' => __( 'Login Button', 'amokit-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => __( 'No', 'amokit-addons' ),
                    'label_on' => __( 'Yes', 'amokit-addons' ),
                    'condition'     => [
                        'register_form_style!' => '3',
                    ],
                ]
            );
   
            $this->add_control(
                'custom_login',
                [
                    'label'                    => __( 'Custom Login URL ', 'amokit-addons' ).' <i class="eicon-pro-icon"></i>',
                    'type'                     => Controls_Manager::SWITCHER,
                    'default'                  => 'no',
                    'label_off'                => __( 'No', 'amokit-addons' ),
                    'label_on'                 => __( 'Yes', 'amokit-addons' ),
                    'return'                   => 'yes',
                    'condition'                => [
                        'login_option_button' => 'yes',
                    ],
                ]
            );
            $this->pro_notice( $this,'custom_login', 'yes' );
            $this->add_responsive_control(
                'register_form_buttons_align',
                [
                    'label' => __( 'Buttons Alignment', 'amokit-addons' ),
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
                        '{{WRAPPER}} .amo-register-wrapper .amo-submit-button' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'condition'=>[
                        'register_form_style!'=>'3',
                    ]
                ]
            );

        $this->end_controls_section();
        $this->start_controls_section(
            'validation_messages_section',
                [
                'label' => __( 'Errors and Success Messages ', 'amokit-addons' ).'<i class="eicon-pro-icon"></i>',
            ]
        );
        $this->add_control(
            'update_pro_validation_messages',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(/* translators: 1: Opening strong and anchor tags for Pro Version link, 2: Closing anchor and strong tags */
                    __('Upgrade to pro version to use this feature %1$s Pro Version %2$s', 'amokit-addons'),
                    '<strong><a href="https://nasdesigns.rf.gd/pricing/" target="_blank">',
                    '</a></strong>'),
                'content_classes' => 'amokit-addons-notice',
            ]
        );
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'register_form_style_section',
            [
                'label' => __( 'Form Wrapper', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'amokit_register_area_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-register-wrapper',
                ]
            );

            $this->add_responsive_control(
                'amokit_register_area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'amokit_register_area_box_shadow',
                    'label' => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-register-wrapper',
                ]
            );

            $this->add_responsive_control(
                'register_form_section_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'register_form_section_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'register_form_heading_style',
            [
                'label' => __( 'Register Heading', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_register_heading'=>'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'register_heading_align',
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
                    '{{WRAPPER}} .amo-register-wrapper .user-register-header' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'register_form_text_color_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-register-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
            
        $this->add_control(
            'register_form_heading_style_heading',
            [
                'label' => __( 'Heading Title Style', 'amokit-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    'register_heading_title!'=>'',
                ]
            ]
        );  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'register_form_heading_typography',
                'selector' => '{{WRAPPER}} .user-register-header h2',
                'condition'=>[
                    'register_heading_title!'=>'',
                ]
            ]
        );
            
        $this->add_control(
            'register_form_heading_color',
            [
                'label'     => __( 'Header Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-register-header h2'   => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'register_heading_title!'=>'',
                ]
            ]
        );

        $this->add_responsive_control(
            'register_form_text_color_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-register-header h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'=>[
                    'register_heading_title!'=>'',
                ]
            ]
        );
        
        $this->add_control(
            'register_form_heading_style_content',
            [
                'label' => __( 'Header Content', 'amokit-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    'register_heading_content!'=>'',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'register_form_content_typography',
                'selector' => '{{WRAPPER}} .user-register-header p',
                'condition'=>[
                    'register_heading_content!'=>'',
                ]
            ]
        );
            
        $this->add_control(
            'register_form_content_color',
            [
                'label'     => __( 'Content Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-register-header p'   => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'register_heading_content!'=>'',
                ]
            ]
        );

        $this->add_responsive_control(
            'register_form_content_color_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .user-register-header p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'=>[
                    'register_heading_content!'=>'',
                ]
            ]
        ); 
            
        $this->add_control(
            'register_form_content_link_color',
            [
                'label'     => __( 'Link Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-register-header p a'   => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'register_heading_url_control!'=>'',
                ]
            ]
        );
            
        $this->add_control(
            'register_form_content_link_hover_color',
            [
                'label'     => __( 'Link Hover Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-register-header p a:hover'   => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'register_heading_url_control!'=>'',
                ]
            ]
        );

        $this->end_controls_section();
        // Style tab section
        $this->start_controls_section(
            'register_form_style_input',
            [
                'label' => __( 'Input', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'input_form_area_padding',
                [
                    'label' => __( 'Input Area Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-1 form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'register_form_style!'=>'3',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'register_form_input_typography',
                    'selector' => '{{WRAPPER}} .amo-register-wrapper input',
                ]
            );

            $this->add_responsive_control(
                'register_input_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'register_form_style!'=>'3',
                    ]
                ]
            );

            $this->add_responsive_control(
                'register_input_margin_three',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-3 form .input_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'register_form_style'=>'3',
                    ]
                ]
            );

            $this->add_responsive_control(
                'register_input_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper input:not(input[type="submit"] )' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'register_input_height',
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
                        'size' => 70,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper.amo-register-style-3 input' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'register_form_style' => '3',
                    ],
                ]
            );

            $this->add_control(
                'register_input_height_not_three',
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
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper input' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition'=>[
                        'register_form_style!' => '3',
                    ],
                ]
            );

            $this->add_control(
                'input_color_border_heading',
                [
                    'label' => __( 'Colors and Border', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs(
                'input_fields_tab'
            );
                // Normal Style Tab
                $this->start_controls_tab(
                    'input_normal',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'register_form_input_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );
        
                    $this->add_control(
                        'register_form_input_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="password"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="password"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="password"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_input_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_input_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input',
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_responsive_control(
                        'register_input_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                // Hover Style Tab
                $this->start_controls_tab(
                    'input_focus',
                    [
                        'label' => __( 'Focus', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'register_form_input_text_color_focus',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input:focus'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_input_background_focus',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input:focus',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_input_border_focus',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input:focus',
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_responsive_control(
                        'register_input_border_radius_focus',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        // Style tab Textarea section
        $this->start_controls_section(
            'register_form_style_textarea',
            [
                'label' => __( 'Textarea', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'show_bio' =>'yes',
                ]
            ]
        );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'register_form_textarea_typography',
                    'selector' => '{{WRAPPER}} .amo-register-wrapper textarea',
                ]
            );

            $this->add_responsive_control(
                'register_textarea_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'register_textarea_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'register_textarea_height',
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
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper textarea' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'textarea_color_border_heading',
                [
                    'label' => __( 'Colors and Border', 'amokit-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs(
                'textarea_fields_tab'
            );
                // Normal Style Tab
                $this->start_controls_tab(
                    'textarea_normal',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'register_form_textarea_text_color',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper textarea'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );
        
                    $this->add_control(
                        'register_form_textarea_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper textarea::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper textarea::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .amo-register-wrapper textarea:-ms-input-placeholder'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_textarea_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper textarea',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_textarea_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper textarea',
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_responsive_control(
                        'register_textarea_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                // Hover Style Tab
                $this->start_controls_tab(
                    'textarea_focus',
                    [
                        'label' => __( 'Focus', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'textarea_text_color_focus',
                        [
                            'label'     => __( 'Text Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper textarea:focus'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_textarea_background_focus',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper textarea:focus',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_textarea_border_focus',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper textarea:focus',
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_responsive_control(
                        'textarea_border_radius_focus',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper textarea:focus' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        // Submit Button
        $this->start_controls_section(
            'register_form_input_box_style',
            [
                'label' => __( 'Input Icon', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'register_form_style'=>'3',
                ]
            ]
        );

        $this->add_control(
            'register_form_input_box_height',
            [
                'label' => __( 'Height', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_control(
            'register_form_input_box_width',
            [
                'label' => __( 'Width', 'amokit-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_control(
            'register_form_input_box_icon_size',
            [
                'label' => __( 'Icon Size', 'amokit-addons' ),
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
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_control(
            'input_box_icon_color',
            [
                'label'     => __( 'Text Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'input_box_icon_background',
                'label' => __( 'Background', 'amokit-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .amo-register-style-3 form .input_box i',
            ]
        );
        $this->add_responsive_control(
            'register_form_input_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'register_form_input_box_margin',
            [
                'label' => esc_html__( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'register_form_input_box_padding',
            [
                'label' => esc_html__( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .amo-register-style-3 form .input_box i' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();
        // Label Style Start
        $this->start_controls_section(
            'register_form_style_label',
            [
                'label' => __( 'Label', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_label'=>'yes',
                ]
            ]
        );

            $this->add_control(
                'register_form_label_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'register_form_label_typography',
                    'selector' => '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'register_form_label_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)',
                ]
            );

            $this->add_responsive_control(
                'register_form_label_margin',
                [
                    'label' => __( 'Margin', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'register_form_label_padding',
                [
                    'label' => __( 'Padding', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'register_form_label_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'register_form_label_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'register_form_label_align',
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
                        '{{WRAPPER}} .amo-register-wrapper label:not(.amo-form-label)' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();       

        // Submit Button
        $this->start_controls_section(
            'register_form_style_submit_button',
            [
                'label' => __( 'Submit Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('register_form_style_submit_tabs');

                // Start Normal Submit button tab
                $this->start_controls_tab(
                    'register_form_style_submit_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'register_form_submitbutton_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'register_form_submitbutton_typography',
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input[type="submit"]',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_form_submitbutton_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input[type="submit"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_height',
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
                                'size' => 50,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_width',
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
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );                    

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_form_submitbutton_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input[type="submit"]',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'register_form_style_submit_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'register_form_submitbutton_hover_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_form_submitbutton_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input[type="submit"]:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_form_submitbutton_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper input[type="submit"]:hover',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_submitbutton_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper input[type="submit"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();

        // Login Button
        $this->start_controls_section(
            'register_form_style_before_login_text',
            [
                'label' => __( 'Before Login Text', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'register_form_style' =>'3',
                ],
            ]
        );

            $this->add_control(
                'register_form_style_before_text_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-3 .separator span'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'register_form_style_before_border_color',
                [
                    'label' => __( 'Border Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-3 .separator span::before , {{WRAPPER}} .amo-register-style-3 .separator span::after' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'register_form_style_before_border_width',
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
                        'size' => 130,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-3 .separator span::before , {{WRAPPER}} .amo-register-style-3 .separator span::after' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'register_form_style_before_border_height',
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
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .amo-register-style-3 .separator span::before , {{WRAPPER}} .amo-register-style-3 .separator span::after' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Login Button
        $this->start_controls_section(
            'register_form_style_login_button',
            [
                'label' => __( 'Login Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'register_form_style' =>'3',
                ],
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('register_form_style_login_tabs');

                // Start Normal Login button tab
                $this->start_controls_tab(
                    'register_form_style_login_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'register_form_loginbutton_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'register_form_loginbutton_typography',
                            'selector' => '{{WRAPPER}} .amo-register-style-3 .login a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_form_loginbutton_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-style-3 .login a',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_height',
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
                                'size' => 90,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_form_loginbutton_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-style-3 .login a',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal login Button tab end

                // Start Hover login button tab
                $this->start_controls_tab(
                    'register_form_style_login_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'register_form_loginbutton_hover_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'register_form_loginbutton_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-style-3 .login a:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'register_form_loginbutton_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-style-3 .login a:hover',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'register_form_loginbutton_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-style-3 .login a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();


        // Before Login text Content
        $this->start_controls_section(
            'before_login_text_style',
            [
                'label' => __( 'Before Login Text', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'or_login_content_text!' => '',
                    'register_form_style!' => '3',
                    'login_option_content' => 'yes'
                ]
            ]
        );
            
        $this->add_control(
            'before_login_text_color',
            [
                'label'     => __( 'Text Color', 'amokit-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .amo-register-wrapper .separator span'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'before_login_text_typography',
                'selector' => '{{WRAPPER}} .amo-register-wrapper .separator span',
            ]
        );

        $this->add_responsive_control(
            'before_login_text_margin',
            [
                'label' => __( 'Margin', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-register-wrapper .separator span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'before_login_text_padding',
            [
                'label' => __( 'Padding', 'amokit-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .amo-register-wrapper .separator span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->end_controls_section(); // Before Login text Content End
        

        // Submit Button
        $this->start_controls_section(
            'login_style_submit_button',
            [
                'label' => __( 'Login Button', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'register_form_style!'=>'3',
                    'login_option_button'=>'yes'
                ]
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('login_style_submit_tabs');

                // Start Normal Submit button tab
                $this->start_controls_tab(
                    'login_style_submit_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'login_button_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'login_button_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'login_button_typography',
                            'selector' => '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'login_button_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'login_button_margin',
                        [
                            'label' => __( 'Margin', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'login_button_padding',
                        [
                            'label' => __( 'Padding', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'login_button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'login_button_width',
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
                                'unit' => '%',
                                'size' => 50,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'login_button_submit_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    
                    $this->add_control(
                        'login_button_hover_text_color',
                        [
                            'label'     => __( 'Color', 'amokit-addons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'login_button_hover_background',
                            'label' => __( 'Background', 'amokit-addons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'login_hover_button_opacity',
                        [
                            'label' => __( 'Opacity', 'amokit-addons' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0.1,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'size' => 0.7,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a:hover' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'login_button_hover_border',
                            'label' => __( 'Border', 'amokit-addons' ),
                            'selector' => '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a:hover',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'login_button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .amo-register-wrapper:not(.amo-register-style-3) .amo-register-form form a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section(); // End Login Button Control

        // Validation message
        $this->start_controls_section(
            'validation_message_style',
            [
                'label' => __( 'Errors & Success ', 'amokit-addons' ).' <i class="eicon-pro-icon"></i>',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'update_pro_error_style',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(/* translators: 1: Opening strong and anchor tags for Pro Version link, 2: Closing anchor and strong tags */
                    __('Upgrade to pro version to use this feature %1$s Pro Version %2$s', 'amokit-addons'),
                    '<strong><a href="https://nasdesigns.rf.gd/pricing/" target="_blank">',
                    '</a></strong>'),
                'content_classes' => 'amokit-addons-notice',
            ]
        );
        
        $this->end_controls_section(); 
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $current_url = remove_query_arg( 'fake_arg' );
        $id = $this->get_id();

        if ( $settings['redirect_page'] == 'yes' && ! empty( $settings['redirect_page_url']['url'] ) ) {
            $redirect_url =  esc_url( $settings['redirect_page_url']['url'] );
        } else {
            $redirect_url = $current_url;
        }

        $this->add_render_attribute( 'register_area_attr', 'class', 'amokit-register-wrapper' );
        $this->add_render_attribute( 'register_area_attr', 'class', 'amokit-register-style-' . esc_attr( $settings['register_form_style'] ) );

        $terms_label = ( !empty( $settings['terms_label'] ) ? esc_html( $settings['terms_label'] ) : esc_html__('Terms and conditions','amokit-addons') );
        $terms_page = ( !empty( $settings['select_terms_page'] ) ? esc_attr( $settings['select_terms_page'] ) : '0');

        if($settings['select_terms_page'] == '0'){
            $page_id = "";
            $page_title = "";
        }else{
            $page_id = get_permalink($terms_page);
            $page_title = get_the_title($terms_page);
        }

        ?>
            <?php
                // if ( is_user_logged_in() && ! Plugin::instance()->editor->is_edit_mode() ) {
                //     $current_user = wp_get_current_user();
                //     echo '<div class="amo-user-login">' .
                //         sprintf(/* translators: %1$s is replaced with the user's display name, %2$s is replaced with the logout URL */
                //             esc_html__( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'amokit-addons' ), esc_html( $current_user->display_name ), wp_logout_url( $current_url ) ) .
                //         '</div>';
                //     return;
                // }
                if ( is_user_logged_in() && ! Plugin::instance()->editor->is_edit_mode() ) {
                    $current_user = wp_get_current_user();
                    $logout_url = wp_logout_url( $current_url );
                
                    echo '<div class="amo-user-login">' .
                        sprintf(
                            /* translators: 1: user's display name, 2: logout URL */
                            esc_html__( 'You are logged in as %1$s (%2$s)', 'amokit-addons' ),
                            esc_html( $current_user->display_name ),
                            '<a href="' . esc_url( $logout_url ) . '">' . esc_html__( 'Logout', 'amokit-addons' ) . '</a>'
                        ) .
                    '</div>';
                    return;
                }
                






            ?>

            <?php

                $this->add_render_attribute(
                    'username_input_attr', [
                        'name'  => 'reg_name',
                        'id'    => 'reg_name'. esc_attr( $id ),
                        'type'  => 'text',
                        'value' => isset( $_REQUEST['reg_name'] ) ? esc_attr( $_REQUEST['reg_name'] ) : null,
                        'placeholder' => isset( $settings['username_placeholder_label'] ) ? esc_attr( $settings['username_placeholder_label'] ) : __('Username', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'password_input_attr', [
                        'name'  => 'reg_password',
                        'id'    => 'reg_password' . esc_attr( $id ),
                        'type'  => 'password',
                        'value' => isset( $_REQUEST['reg_password'] ) ? esc_attr( $_REQUEST['reg_password'] ) : null,
                        'placeholder' => isset( $settings['password_placeholder_label'] ) ? esc_attr( $settings['password_placeholder_label'] ) : __('Password', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'email_input_attr', [
                        'name'  => 'reg_email',
                        'id'    => 'reg_email' . esc_attr( $id ),
                        'type'  => 'email',
                        'value' => isset( $_REQUEST['reg_email'] ) ? esc_attr( $_REQUEST['reg_email'] ) : null,
                        'placeholder' => isset( $settings['email_placeholder_label'] ) ? esc_attr( $settings['email_placeholder_label'] ) : __('Email', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'fname_input_attr', [
                        'name'  => 'reg_fname',
                        'id'    => 'reg_fname' . esc_attr( $id ),
                        'type'  => 'text',
                        'value' => isset( $_REQUEST['reg_fname'] ) ? esc_attr( $_REQUEST['reg_fname'] ) : null,
                        'placeholder' => isset( $settings['firstname_placeholder_label'] ) ? esc_attr( $settings['firstname_placeholder_label'] ) : __('First Name', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'lname_input_attr', [
                        'name'  => 'reg_lname',
                        'id'    => 'reg_lname' . esc_attr( $id ),
                        'type'  => 'text',
                        'value' => isset( $_REQUEST['reg_lname'] ) ? esc_attr( $_REQUEST['reg_lname'] ) : null,
                        'placeholder' => isset( $settings['lastname_placeholder_label'] ) ? esc_attr( $settings['lastname_placeholder_label'] ) : __('Last Name', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'nickname_input_attr', [
                        'name'  => 'reg_nickname',
                        'id'    => 'reg_nickname' . esc_attr( $id ),
                        'type'  => 'text',
                        'value' => isset( $_REQUEST['reg_nickname'] ) ? esc_attr( $_REQUEST['reg_nickname'] ) : null,
                        'placeholder' => isset( $settings['nickname_placeholder_label'] ) ? esc_attr( $settings['nickname_placeholder_label'] ) : __('Nick Name', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'website_input_attr', [
                        'name'  => 'reg_website',
                        'id'    => 'reg_website' . esc_attr( $id ),
                        'type'  => 'text',
                        'value' => isset( $_REQUEST['reg_website'] ) ? esc_attr( $_REQUEST['reg_website'] ) : null,
                        'placeholder' => isset( $settings['website_placeholder_label'] ) ? esc_attr( $settings['website_placeholder_label'] ) : __('Website', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'bio_textarea_attr', [
                        'name'  => 'reg_bio',
                        'id'    => 'reg_bio' . esc_attr( $id ),
                        'placeholder' => isset( $settings['bio_placeholder_label'] ) ? esc_attr( $settings['bio_placeholder_label'] ) : __('Biographical Info', 'amokit-addons'),
                    ]
                );

                $this->add_render_attribute(
                    'submit_input_attr', [
                        'name'  => 'reg_submit' . esc_attr( $id ),
                        'id'    => 'reg_submit' . esc_attr( $id ),
                        'type'  => 'submit',
                        'value' => isset( $settings['submit_button_label'] ) ? esc_attr( $settings['submit_button_label'] ) : __('REGISTER', 'amokit-addons'),
                    ]
                );
            ?>

            <div id="amokit_message_<?php echo esc_attr( $id ); ?>" class="amo_message">&nbsp;</div>
            <div <?php echo $this->get_render_attribute_string( 'register_area_attr' ); ?>>
                <div class="amo-register-form">
                    <?php if($settings['show_register_heading'] ): ?>
                    <div class="user-register-header">
                        <?php if($settings['register_heading_title'] ):
                            echo '<h2>'. amokit_kses_title($settings['register_heading_title'] ) .'</h2>';
                        endif; ?>
                        <?php if($settings['register_heading_content'] ):                            
                            echo '<p>' .
                            sprintf( '%1$s <a href="%2$s">%3$s</a>', wp_kses_post($settings['register_heading_content'] ) , esc_url( wp_login_url()) , wp_kses_post($settings['register_heading_url_control'] ) ) .
                            '</p>';

                        endif; ?>
                    </div>
                    <?php endif; ?>    

                    <form id="amokit_register_form_<?php echo esc_attr( $id ); ?>" method="post" action="amokitregisteraction">

                        <?php if( $settings['register_form_style'] == 2 ): ?>
                            <div class="htb-row">
                                <div class="htb-col-lg-6">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_name' . esc_attr( $id ), (isset( $settings['username_label'] )) ? amokit_kses_title( $settings['username_label'] ) : esc_html__( 'Username', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-6">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_password' . esc_attr( $id ), (isset( $settings['password_label'] )) ? amokit_kses_title( $settings['password_label'] ) : esc_html__( 'Password', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_email' . esc_attr( $id ), isset( $settings['email_label'] ) ?  amokit_kses_title( $settings['email_label'] ): esc_html__( 'Email', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';
                                    ?>
                                </div>

                                <!-- Editional Fiedls -->
                                <?php
                                    if( $settings['show_firstname'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_fname' . esc_attr( $id ), (isset( $settings['firstname_label'] )) ? amokit_kses_title( $settings['firstname_label'] ) : esc_html__( 'First Name', 'amokit-addons'));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                        echo '</div>';
                                    }
                                    if( $settings['show_lastname'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_lname' . esc_attr( $id ), ( isset( $settings['lastname_label'] )) ? amokit_kses_title( $settings['lastname_label'] ) : esc_html__( 'Last Name', 'amokit-addons'));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                        echo '</div>';
                                    }

                                    if( $settings['show_nickname'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_nickname' . esc_attr( $id ), ( isset( $settings['nickname_label'] )) ? amokit_kses_title( $settings['nickname_label'] ) : esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                        echo '</div>';
                                    }

                                    if( $settings['show_website'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_website' . esc_attr( $id ), (isset( $settings['website_label'] )) ? amokit_kses_title( $settings['website_label'] ) : esc_html__( 'Website', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                        echo '</div>';
                                    }

                                    if( $settings['show_bio'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_bio' . esc_attr( $id ), ( isset( $settings['bio_label'] )) ? amokit_kses_title( $settings['bio_label'] ) : esc_html__( 'Biographical Info', 'amokit-addons' ));
                                            }
                                            echo sprintf( '<textarea %1$s>%2$s</textarea>', $this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ));
                                        echo '</div>';

                                    }

                                    if( $settings['show_terms'] == 'yes' ){ ?>
                                        <div class="htb-col-lg-12 termscondition">
                                            <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                            <?php 
                                                echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ) , $terms_label , $page_id , $page_title  );
                                            ?>
                                        </div>
                                    <?php }

                                ?>
                                <div class="htb-col-lg-12 amokit-submit-button">
                                    <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />
                                </div>

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12 amokit-submit-button">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                                
                                <?php if( $settings['login_option_button'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12 amokit-submit-button">
                                        <a href="<?php echo esc_url( wp_login_url()); ?>"><?php echo esc_html__( 'Login','amokit-addons' );?></a>
                                    </div>
                                <?php } ?>

                            </div>

                            <?php elseif( $settings['register_form_style'] == 6 ): ?>
                            <div class="htb-row">
                                <div class="htb-col-lg-6">
                                    <?php
                                        if( $settings['show_firstname'] == 'yes' ){
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label>%1$s</label>',isset( $settings['firstname_label'] ) ? amokit_kses_title( $settings['firstname_label'] ): esc_html__( 'First Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                        }
                                    ?>
                                </div>

                                <div class="htb-col-lg-6">
                                    <?php
                                        if( $settings['show_lastname'] == 'yes' ){
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label>%1$s</label>',isset( $settings['lastname_label'] ) ? amokit_kses_title( $settings['lastname_label'] ) : esc_html__( 'Last Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                        }
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label>%1$s</label>', ( isset( $settings['email_label'] )) ? amokit_kses_title( $settings['email_label'] ) : esc_html__( 'Email', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){
                                            echo sprintf('<label>%1$s</label>', (isset( $settings['username_label'] )) ? amokit_kses_title( $settings['username_label'] ) : esc_html__( 'Username', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label>%1$s</label>', ( isset( $settings['password_label'] )) ? amokit_kses_title( $settings['password_label'] ) : esc_html__( 'Password', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';
                                    ?>
                                </div>

                                <!-- Editional Fiedls -->
                                <?php
                                    if( $settings['show_nickname'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label>%1$s</label>', ( isset( $settings['nickname_label'] )) ? amokit_kses_title( $settings['nickname_label'] ) : esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                        echo '</div>';
                                    }

                                    if( $settings['show_website'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label>%1$s</label>', (isset( $settings['website_label'] )) ? amokit_kses_title( $settings['website_label'] ) : esc_html__( 'Website', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                        echo '</div>';
                                    }

                                    if( $settings['show_bio'] == 'yes' ){
                                        echo '<div class="htb-col-lg-12">';
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label>%1$s</label>', ( isset( $settings['bio_label'] )) ? amokit_kses_title( $settings['bio_label'] ) : esc_html__('Biographical Info', 'amokit-addons' ));
                                            }
                                            echo sprintf( '<textarea %1$s>%2$s</textarea>', $this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ));
                                        echo '</div>';

                                    }

                                    if( $settings['show_terms'] == 'yes' ){ ?>
                                        <div class="htb-col-lg-12 termscondition">
                                            <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                            <?php 
                                                echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ), $terms_label , $page_id , $page_title  );
                                            ?>
                                        </div>
                                    <?php }

                                ?>
                                <div class="htb-col-lg-12">
                                    <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />
                                </div>

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                                
                                <?php if( $settings['login_option_button'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <a href="<?php echo esc_url( wp_login_url()); ?>"><?php echo esc_html__( 'Login','amokit-addons' );?></a>
                                    </div>
                                <?php } ?>
                                
                            </div>                            

                        <?php elseif( $settings['register_form_style'] == 3 ): ?>

                            <div class="htb-row">

                                <?php if( $settings['show_firstname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <div class="input_box">
                                            <?php
                                                echo '<i class="fa fa-user-circle" aria-hidden="true"></i> <input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if( $settings['show_lastname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <div class="input_box">
                                            <?php
                                                echo '<i class="fa fa-user-circle" aria-hidden="true"></i> <input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if( $settings['show_nickname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <div class="input_box">
                                            <?php
                                                echo '<i class="fa fa-user-circle" aria-hidden="true"></i> <input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="htb-col-lg-12">
                                    <div class="input_box">
                                        <?php
                                            echo '<i class="fa fa-user"></i><input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';
                                        ?>
                                    </div>
                                </div>

                                <div class="htb-col-lg-12">
                                    <div class="input_box">
                                        <?php
                                            echo '<i class="fa fa-lock" aria-hidden="true"></i>
                                            <input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';
                                        ?>
                                    </div>
                                </div>

                                <div class="htb-col-lg-12">
                                    <div class="input_box">
                                        <?php
                                            echo '<i class="fa fa-envelope"></i><input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';
                                        ?>
                                    </div>
                                </div>
                                
                                <?php if( $settings['show_website'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <div class="input_box">
                                            <?php
                                                echo '<i class="fa fa-address-book" aria-hidden="true"></i> <input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <?php if( $settings['show_bio'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <div class="input_box">
                                            <?php                                            
                                                echo sprintf( '<textarea %1$s>%2$s</textarea>' ,$this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ) );
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_terms'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12 termscondition">
                                        <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                        <?php 
                                            echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ), $terms_label , $page_id , $page_title  );
                                        ?>
                                    </div>
                                <?php } ?>

                                <div class="htb-col-lg-12">
                                    <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />
                                </div>

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>

                                <div class="htb-col-lg-12">
                                    <div class="login">
                                        <a href="<?php echo esc_url( wp_login_url()); ?>"><?php echo esc_html__( 'LOGIN','amokit-addons' );?></a>
                                    </div>
                                </div>

                            </div>

                        <?php elseif( $settings['register_form_style'] == 4 ): ?>
                            <div class="htb-row">
                                <?php if( $settings['show_firstname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_fname' . esc_attr( $id ), isset( $settings['firstname_label'] ) ? amokit_kses_title( $settings['firstname_label'] ) :  esc_html__( 'First Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if( $settings['show_lastname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_lname' . esc_attr( $id ), isset( $settings['lastname_label'] ) ? amokit_kses_title( $settings['lastname_label'] ) :  esc_html__( 'First Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if( $settings['show_nickname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_nickname' . esc_attr( $id ), isset( $settings['nickname_label'] ) ? amokit_kses_title( $settings['nickname_label'] ) :  esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_name' . esc_attr( $id ), isset( $settings['username_label'] ) ? amokit_kses_title( $settings['username_label'] ) :  esc_html__( 'Username', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';
                                    ?>
                                </div>
                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_password' . esc_attr( $id ), isset( $settings['password_label'] ) ? amokit_kses_title( $settings['password_label'] ):  esc_html__( 'Password', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';
                                    ?>
                                </div>
                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_email' . esc_attr( $id ), isset( $settings['email_label'] ) ? amokit_kses_title( $settings['email_label'] ) :  esc_html__( 'Email', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';
                                    ?>
                                </div>
                                <?php if( $settings['show_website'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_website' . esc_attr( $id ), isset( $settings['website_label'] ) ? amokit_kses_title( $settings['website_label'] ) :  esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if( $settings['show_bio'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){ 
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_bio' . esc_attr( $id ), isset( $settings['bio_label'] ) ? amokit_kses_title( $settings['bio_label'] ) :  esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            
                                            echo sprintf( '<textarea %1$s>%2$s</textarea>', $this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ) );
                                        ?>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_terms'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12 termscondition">
                                        <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                        <?php 
                                            echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ), $terms_label , $page_id , $page_title  );
                                        ?>
                                    </div>
                                <?php } ?>                               

                                <div class="htb-col-lg-12">
                                    <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />
                                </div>

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                                
                                <?php if( $settings['login_option_button'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <a href="<?php echo esc_url( wp_login_url()); ?>"><?php echo esc_html__( 'Login','amokit-addons' );?></a>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php elseif( $settings['register_form_style'] == 5 ): ?>
                            <div class="htb-row">

                                <?php if( $settings['show_firstname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_fname' . esc_attr( $id ), isset( $settings['firstname_label'] ) ? amokit_kses_title( $settings['firstname_label'] ) :  esc_html__( 'First Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_lastname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_lname' . esc_attr( $id ), isset( $settings['lastname_label'] ) ? amokit_kses_title( $settings['lastname_label'] ) :  esc_html__( 'Last Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_nickname'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_nickname' . esc_attr( $id ), isset( $settings['nickname_label'] ) ? amokit_kses_title( $settings['nickname_label'] ) :  esc_html__( 'Nick Name', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_name' . esc_attr( $id ), isset( $settings['username_label'] ) ? amokit_kses_title( $settings['username_label'] ) :  esc_html__( 'Username', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_password' . esc_attr( $id ), isset( $settings['password_label'] ) ? amokit_kses_title( $settings['password_label'] ) :  esc_html__( 'Password', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';
                                    ?>
                                </div>

                                <div class="htb-col-lg-12">
                                    <?php
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_email' . esc_attr( $id ), isset( $settings['email_label'] ) ? amokit_kses_title( $settings['email_label'] ) :  esc_html__( 'Email', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';
                                    ?>
                                </div>

                                <?php if( $settings['show_website'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_website' . esc_attr( $id ), isset( $settings['website_label'] ) ? amokit_kses_title( $settings['website_label'] ) :  esc_html__( 'Website', 'amokit-addons' ));
                                            }
                                            echo '<input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                        ?>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_bio'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <?php
                                            if( $settings['show_label'] == 'yes' ){
                                                echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_bio' . esc_attr( $id ), isset( $settings['bio_label'] ) ? amokit_kses_title( $settings['bio_label'] ) :  esc_html__( 'Biographical Info', 'amokit-addons' ));
                                            }
                                            
                                            echo sprintf( '<textarea %1$s>%2$s</textarea>', $this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ) );
                                        ?>
                                    </div>
                                <?php } ?>

                                <?php if( $settings['show_terms'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12 termscondition">
                                        <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                        <?php 
                                            echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ), $terms_label , $page_id , $page_title  );
                                        ?>
                                    </div>
                                <?php } ?>  

                                <div class="htb-col-lg-12">
                                    <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />
                                </div>

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                                
                                <?php if( $settings['login_option_button'] == 'yes' ){ ?>
                                    <div class="htb-col-lg-12">
                                        <a href="<?php echo esc_url( wp_login_url()); ?>"><?php echo esc_html__( 'Login','amokit-addons' );?></a>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php else:?>
                            <div class="amo-fields">
                                <?php
                                    // Default Field
                                    if( $settings['show_label'] == 'yes' ){
                                        echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_name' . esc_attr( $id ), isset( $settings['username_label'] ) ? amokit_kses_title( $settings['username_label'] ) :  esc_html__( 'Username', 'amokit-addons' ));
                                    }
                                    echo '<input '.$this->get_render_attribute_string( 'username_input_attr' ).' />';

                                    if( $settings['show_label'] == 'yes' ){ 
                                        echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_password' . esc_attr( $id ), isset( $settings['password_label'] ) ? amokit_kses_title( $settings['password_label'] ) :  esc_html__( 'Password', 'amokit-addons' ));
                                    }
                                    echo '<input '.$this->get_render_attribute_string( 'password_input_attr' ).' />';

                                    if( $settings['show_label'] == 'yes' ){ 
                                        echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_email' . esc_attr( $id ), isset( $settings['email_label'] ) ? amokit_kses_title( $settings['email_label'] ) :  esc_html__( 'Email', 'amokit-addons' ));
                                    }
                                    echo '<input '.$this->get_render_attribute_string( 'email_input_attr' ).' />';

                                    // Additionnal Field
                                    if( $settings['show_firstname'] == 'yes' ){
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_fname' . esc_attr( $id ), isset( $settings['firstname_label'] ) ? amokit_kses_title( $settings['firstname_label'] ) :  esc_html__('First Name', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'fname_input_attr' ).' />';
                                    }
                                    if( $settings['show_lastname'] == 'yes' ){
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_lname' . esc_attr( $id ), isset( $settings['lastname_label'] ) ? amokit_kses_title( $settings['lastname_label'] ) :  esc_html__( 'Last Name', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'lname_input_attr' ).' />';
                                    }
                                    if( $settings['show_nickname'] == 'yes' ){
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_nickname' . esc_attr( $id ), isset( $settings['nickname_label'] ) ? amokit_kses_title( $settings['nickname_label'] ) :  esc_html__( 'Nick Name', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'nickname_input_attr' ).' />';
                                    }
                                    if( $settings['show_website'] == 'yes' ){
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_website' . esc_attr( $id ), isset( $settings['website_label'] ) ? amokit_kses_title( $settings['website_label'] ) :  esc_html__( 'Website', 'amokit-addons' ));
                                        }
                                        echo '<input '.$this->get_render_attribute_string( 'website_input_attr' ).' />';
                                    }
                                    if( $settings['show_bio'] == 'yes' ){
                                        if( $settings['show_label'] == 'yes' ){ 
                                            echo sprintf('<label for="%1$s">%2$s</label>' ,'reg_bio' . esc_attr( $id ), isset( $settings['bio_label'] ) ? amokit_kses_title( $settings['bio_label'] ) :  esc_html__('Biographical Info', 'amokit-addons' ));
                                        }
                                        
                                        echo sprintf( '<textarea %1$s>%2$s</textarea>', $this->get_render_attribute_string( 'bio_textarea_attr' ), ( isset( $_REQUEST['reg_bio'] ) ? esc_html( $_REQUEST['reg_bio'] ) : NULL ));
                                    }

                                    if( $settings['show_terms'] == 'yes' ){ ?>
                                        <div class="termscondition">
                                            <input name="termscondition" type="checkbox" id="terms-<?php echo esc_attr( $id );?>">
                                            <?php 
                                                echo sprintf('<label for="%1$s" class="amo-form-label">%2$s <a class="terms-conditions" href="%3$s">%4$s</a>  </label>' ,'terms-' . esc_attr( $id ), $terms_label , $page_id , $page_title  );
                                            ?>

                                        </div>
                                    <?php }
                                ?>
                                <input <?php echo $this->get_render_attribute_string( 'submit_input_attr' ); ?> />

                                <?php if($settings['login_option_content'] ) : ?>
                                    <div class="htb-col-lg-12">
                                        <div class="separator">
                                            <?php if($settings['or_login_content_text'] ):
                                                echo '<span>'. wp_kses_post($settings['or_login_content_text'] ) .'</span>';
                                            endif; ?>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                                
                                <?php if( $settings['login_option_button'] == 'yes' ){ ?>
                                    <a href="<?php echo esc_url( wp_login_url() ); ?>"><?php echo esc_html__( 'Login','amokit-addons' );?></a>
                                <?php } ?>
                            </div>
                        <?php endif;?>
                    </form>
                </div>
            </div>

        <?php
        $this->amokit_register_request( $id, $settings['redirect_page'], $redirect_url );

    }


    public function amokit_register_request( $id, $reddirectstatus ,$redirect_url ){
        ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    "use strict";

                    var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
                    var loadingmessage = '<?php echo esc_html__('Please Wait...','amokit-addons'); ?>';
                    var form_id = 'form#amokit_register_form_<?php echo esc_attr( $id ); ?>';
                    var button_id = '#reg_submit<?php echo esc_attr( $id ); ?>';
                    var nonce = '<?php echo esc_js( wp_create_nonce( 'amokit_register_nonce' ) ); ?>';
                    var redirect = '<?php echo esc_attr( $reddirectstatus ); ?>';

                    $( button_id ).on('click', function(){

                        $('#amokit_message_<?php echo esc_attr( $id ); ?>').html('<span class="amo_lodding_msg">'+ loadingmessage +'</span>').fadeIn();

                        var data = {
                            action:         "amokit_ajax_register",
                            nonce:          nonce,
                            reg_name:       $( form_id + ' #reg_name<?php echo esc_js( $id ); ?>').val(),
                            reg_password:   $( form_id + ' #reg_password<?php echo esc_js( $id ); ?>').val(),
                            reg_email:      $( form_id + ' #reg_email<?php echo esc_js( $id ); ?>').val(),
                            reg_website:    $( form_id + ' #reg_website<?php echo esc_js( $id ); ?>').val(),
                            reg_fname:      $( form_id + ' #reg_fname<?php echo esc_js( $id ); ?>').val(),
                            reg_lname:      $( form_id + ' #reg_lname<?php echo esc_js( $id ); ?>').val(),
                            reg_nickname:   $( form_id + ' #reg_nickname<?php echo esc_js( $id ); ?>').val(),
                            reg_bio:        $( form_id + ' #reg_bio<?php echo esc_js( $id ); ?>').val(),
                        };

                        $.ajax({  
                            type: 'POST',
                            dataType: 'json',  
                            url:  ajaxurl,
                            data: data,
                            success: function( msg ){
                                if ( msg.registerauth == true ){
                                    $('#amokit_message_<?php echo esc_attr( $id ); ?>').html('<div class="amo_success_msg alert alert-success">'+ msg.message +'</div>').fadeIn();
                                    if( redirect === 'yes' ){
                                        document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
                                    }
                                }else{
                                    $('#amokit_message_<?php echo esc_attr( $id ); ?>').html('<div class="amo_invalid_msg alert alert-danger">'+ msg.message +'</div>').fadeIn();
                                }
                            }  
                        });
                        return false;
                      
                    });

                });

            </script>
        <?php
    }

    public function pro_notice( $repeater,$condition_key, $array_value ) {

        $repeater->add_control(
            'update_pro'.$condition_key,
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(/* translators: 1: Opening strong and anchor tags for Pro Version link, 2: Closing anchor and strong tags */
                    __('Upgrade to pro version to use this feature %1$s Pro Version %2$s', 'amokit-addons'),
                    '<strong><a href="https://nasdesigns.rf.gd/pricing/" target="_blank">',
                    '</a></strong>'),
                'content_classes' => 'amokit-addons-notice',
                'condition' => [
                    $condition_key => $array_value,
                ]
            ]
        );
    }
}
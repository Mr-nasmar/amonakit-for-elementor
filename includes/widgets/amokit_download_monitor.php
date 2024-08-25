<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Download_Monitor extends Widget_Base {

    public function get_name() {
        return 'amokit-downloadmonitor-addons';
    }
    
    public function get_title() {
        return __( 'Download Monitor', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-file-download';
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
        return [ 'download', 'download monitor', 'widget','Amona Kit','amokit addons' ];
    }

    public function get_help_url() {
		return 'https://nasdesigns.rf.gd/docs/3rd-party-plugin-widgets/download-monitor-widget/';
	}

    protected function amokit_download_file_list(){
        $downloadfile = array();
        array_push( $downloadfile, __('Select Download File','amokit-addons') );
        $args      = array( 'post_status' => 'publish' );
        $downloads  = download_monitor()->service( 'download_repository' )->retrieve( $args, -1, false );
        foreach ( $downloads as $download ) {
            $downloadfile[absint( $download->get_id() )] = $download->get_title() .' ('. $download->get_version()->get_filename() . ')';
        }
        return $downloadfile;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'download_file_content',
            [
                'label' => __( 'Download File', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'file_id',
                [
                    'label'     => esc_html__( 'Select File', 'amokit-addons' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => $this->amokit_download_file_list(),
                    'label_block'=>true,
                ]
            );


            $this->add_control(
                'file_type_show',
                [
                    'label'     => esc_html__( 'Show File Type', 'amokit-addons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
            );

            $this->add_control(
                'file_size_show',
                [
                    'label'     => esc_html__( 'Show File Size', 'amokit-addons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
            );

            $this->add_control(
                'download_count_show',
                [
                    'label'     => esc_html__( 'Show Download Count', 'amokit-addons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Button Content
        $this->start_controls_section(
            'button_content',
            [
                'label' => __( 'Button', 'amokit-addons' ),
            ]
        );
            
            $this->add_control(
                'button_text',
                [
                    'label' => __( 'Text', 'amokit-addons' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'amokit-addons' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __( 'Button Style', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'download_button_style_tabs' );
            
                $this->start_controls_tab(
                    'download_button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'amokit-addons' ),
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'button_background_color',
                        'types'     => [ 'classic', 'gradient' ],
                        'selector'  => '{{WRAPPER}} a.amo-downloadbtn',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'selector' => '{{WRAPPER}} a.amo-downloadbtn',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(), [
                        'name' => 'button_border',
                        'label' => esc_html__( 'Border', 'amokit-addons' ),
                        'placeholder' => '1px',
                        'default' => '1px',
                        'selector' => '{{WRAPPER}} a.amo-downloadbtn',
                    ]
                );

                $this->add_control(
                    'button_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} a.amo-downloadbtn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_padding',
                    [
                        'label' => esc_html__( 'Padding', 'amokit-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} a.amo-downloadbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_control(
                    'button_title_heading',
                    [
                        'label' => __( 'Title Style', 'amokit-addons' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                
                $this->add_control(
                    'button_text_color',
                    [
                        'label' => esc_html__( 'Color', 'amokit-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a.amo-downloadbtn' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'button_typography',
                        'label' => esc_html__( 'Typography', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} a.amo-downloadbtn',
                    ]
                );
                $this->add_control(
                    'button_meta_heading',
                    [
                        'label' => __( 'Meta Style', 'amokit-addons' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                'terms' => [
                                        ['name' => 'download_count_show', 'operator' => '===', 'value' => 'yes']
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_size_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_type_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                            ]
                        ], 
                    ]
                );
                $this->add_control(
                    'button_text_color_meta',
                    [
                        'label' => esc_html__( 'Color', 'amokit-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .file_meta' => 'color: {{VALUE}};',
                        ],
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                'terms' => [
                                        ['name' => 'download_count_show', 'operator' => '===', 'value' => 'yes']
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_size_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_type_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                            ]
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'button_typography_meta',
                        'label' => esc_html__( 'Typography', 'amokit-addons' ),
                        'selector' => '{{WRAPPER}} .file_meta',
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                'terms' => [
                                        ['name' => 'download_count_show', 'operator' => '===', 'value' => 'yes']
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_size_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                                [
                                'terms' => [
                                        ['name' => 'file_type_show', 'operator' => '===', 'value' => 'yes'],
                                    ]
                                ],
                            ]
                        ],
                    ]
                );


                $this->end_controls_tab(); // Normal Button style End

                // Hover Button style End
                $this->start_controls_tab(
                    'download_button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'amokit-addons' ),
                    ]
                );
                    $this->add_control(
                        'button_hover_text_color',
                        [
                            'label' => esc_html__( 'Color', 'amokit-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} a.amo-downloadbtn:hover,{{WRAPPER}} a.amo-downloadbtn:hover .file_meta' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'button_hover_background_color',
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} a.amo-downloadbtn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_hover_box_shadow',
                            'selector' => '{{WRAPPER}} a.amo-downloadbtn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(), [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'amokit-addons' ),
                            'placeholder' => '1px',
                            'default' => '1px',
                            'selector' => '{{WRAPPER}} a.amo-downloadbtn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'amokit-addons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} a.amo-downloadbtn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'amokit_button', 'class', 'amokit-button' );

        $download = download_monitor()->service( 'download_repository' )->retrieve_single( $settings['file_id'] );

        if ( isset( $download ) ):
            ?>
                <a class="amo-downloadbtn elementor-button" href="<?php echo esc_url( $download->the_download_link() ); ?>">
                    <?php
                        if( !empty( $settings['button_icon']['value'] ) ){
                            echo '<span class="download_icon">'.amo_Icon_manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ).'</span>';
                        }
                        if( !empty( $settings['button_text'] ) ){
                            echo esc_html($settings['button_text'] );
                        }else{
                            echo esc_html( $download->get_title() );
                        }
                    ?>
                    <?php if ( 'yes' === $settings['file_type_show'] || 'yes' === $settings['file_size_show'] || 'yes' === $settings['download_count_show'] ) : ?>
                        <div class="file_meta">
                            <?php if ( 'yes' === $settings['file_type_show'] ) : ?>
                                <span class="file_meta_type">
                                    <?php echo esc_html($download->get_version()->get_filetype()); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ( 'yes' === $settings['file_size_show'] ) : ?>
                                <span class="file_meta_size">
                                    <?php echo esc_html($download->get_version()->get_filesize_formatted()); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ( 'yes' === $settings['download_count_show'] ) : ?>
                                <span class="file_meta_count">
                                    <?php esc_html_e('Downloaded', 'amokit-addons'); ?> <?php echo esc_html($download->get_download_count()); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                </a>
            <?php
        endif;

    }

}
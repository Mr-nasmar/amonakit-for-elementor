<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AmoKit_Elementor_Widget_Weather extends Widget_Base {

    public function get_name() {
        return 'amokit-weather-addons';
    }
    
    public function get_title() {
        return __( 'Weather', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-cloud-check';
    }

    public function get_categories() {
        return [ 'amokit-addons' ];
    }

    public function get_style_depends(){
        return [
            'regular-weather-icon',
            'amokit-weather',
        ];
    }
    public function get_keywords() {
        return ['amokit', 'Amona Kit', 'weather', 'geolocation', 'forecast', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/general-widgets/weather-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'weather_content',
            [
                'label' => __( 'Weather', 'amokit-addons' ),
            ]
        );

            $this->add_control(
                'overridetitle',
                [
                    'label'   => __( 'Override Title', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '',
                ]
            );

            $this->add_control(
                'units',
                [
                    'label'   => __( 'Units', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'C',
                    'options' => [
                        'F'   => __( 'F', 'amokit-addons' ),
                        'C'   => __( 'C', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'layout',
                [
                    'label'   => __( 'Style', 'amokit-addons' ),
                    'type'    => 'amokit-preset-select',
                    'default' => 'layout-1',
                    'options' => [
                        'layout-1'  => __( 'Style One', 'amokit-addons' ),
                        'layout-2'  => __( 'Style Two', 'amokit-addons' ),
                        'layout-3'  => __( 'Style Three', 'amokit-addons' ),
                        'layout-4'  => __( 'Style Four', 'amokit-addons' ),
                    ],
                ]
            );

            $this->add_control(
                'forecast',
                [
                    'label'   => __( 'Forecast', 'amokit-addons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '4',
                    'options' => [
                        '3' => __( '3 Days', 'amokit-addons' ),
                        '4' => __( '4 Days', 'amokit-addons' ),
                        '5' => __( '5 Days', 'amokit-addons' ),
                        '6' => __( '6 Days', 'amokit-addons' ),
                    ],
                    'conditions'=>[
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-1'
                            ],
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-2'
                            ],
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-4'
                            ],
                        ]
                    ],
                ]
            );

            $this->add_control(
                'hidecurrentstate',
                [
                    'label'   => __( 'Hide Current Status', 'amokit-addons' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'conditions'=>[
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-1'
                            ],
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-4'
                            ]
                        ]
                    ],
                ]
            );

            $this->add_control(
                'hidesunstate',
                [
                    'label'   => __( 'Hide Sun Status', 'amokit-addons' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition'=>[
                        'layout' => 'layout-1'
                    ],
                ]
            );

            $this->add_control(
                'hide_forcast',
                [
                    'label'   => __( 'Hide Forecast', 'amokit-addons' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'conditions'=>[
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-1'
                            ],
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'layout-4'
                            ]
                        ]
                    ],
                ]
            );

            $this->add_control(
                'custom_giolocation',
                [
                    'label'   => __( 'Custom Geolocation', 'amokit-addons' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'custom_lat',
                [
                    'label'   => __( 'Latitude', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '',
                    'condition'=>[
                        'custom_giolocation' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'custom_long',
                [
                    'label'   => __( 'Longitude', 'amokit-addons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '',
                    'condition'=>[
                        'custom_giolocation' => 'yes'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'custom_bg_color',
                    'label' => __( 'Custom Background Color', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htm-weather-wraper,{{WRAPPER}} .htm-weather-wraper.layout-4',
                ]
            );

            $this->add_control(
                'custom_bg_overlay',
                [
                    'label' => __( 'Background Overlay', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition'=>[
                        'custom_bg_color_background' => 'classic'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htm-weather-wraper:after' => 'background: {{VALUE}}'
                    ],
                ]
            );

            $this->add_control(
                'text_color',
                [
                    'label' => __( 'Text Color', 'amokit-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htm-weather-wraper' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
        $this->end_controls_section();

        
        // Title Style
        $this->start_controls_section(
            'weather_title_style_section',
            [
                'label' => __( 'Title', 'amokit-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'weather_title_color',
                [
                    'label'     => __( 'Color', 'amokit-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .htm-weather-wraper h3' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'weather_title_typography',
                    'selector' => '{{WRAPPER}} .htm-weather-wraper h3',
                ]
            );

            $this->add_responsive_control(
                'weather_title_padding',
                [
                    'label'      => __( 'Padding', 'amokit-addons' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htm-weather-wraper h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'weather_title_border',
                    'label' => __( 'Border', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .htm-weather-wraper h3',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'weather_title_background',
                    'label' => __( 'Background', 'amokit-addons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htm-weather-wraper h3',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'weather_title_shadow',
                    'label'     => __( 'Box Shadow', 'amokit-addons' ),
                    'selector' => '{{WRAPPER}} .htm-weather-wraper h3',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'weather_forcast_style_section',
            [
                'label' => __( 'Forcast', 'amokit-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'weather_forcast_border',
                'label' => __( 'Border', 'amokit-addons' ),
                'selector' => '{{WRAPPER}} .htm-weather-wraper .htm-weather-forcast',
            ]
        );

        $this->add_responsive_control(
            'weather_forcast_padding',
            [
                'label'      => __( 'Padding', 'amokit-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .htm-weather-wraper .htm-weather-forcast' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    private function add_weather_rosource(){
        require_once AMONAKIT_ADDONS_PL_PATH.'includes/weather-resource/weather-resource.php';
        require_once AMONAKIT_ADDONS_PL_PATH.'includes/weather-resource/weather-map.php';
    }

    protected function render( $instance = [] ) {

        if(file_exists(AMONAKIT_ADDONS_PL_PATH.'includes/weather-resource/weather-resource.php') && file_exists(AMONAKIT_ADDONS_PL_PATH.'includes/weather-resource/weather-map.php')){
            $this->add_weather_rosource();
        }else{
            return;
        }

        $settings   = $this->get_settings_for_display();
        $api_key  = amokit_get_option( 'weather_map_api_key','amokit_general_tabs' );
        $hide_current_stats = $settings['hidecurrentstate'] == 'yes' ? 1 : 0;
        $hide_sun_stats = $settings['hidesunstate'] == 'yes' ? 1 : 0;
        $hide_forcast  = $settings['hide_forcast'] == 'yes' ? 1 : 0;
        $units = $settings['units'];
        $custom_lat = $settings['custom_lat'];
        $custom_long = $settings['custom_long'];

        if(empty($api_key) ) {
            ?>
                <div class="htm-api-notice">
                    <p><?php echo esc_html__('Please Insert Weather Map API Key from "amokit Addons > Settings > Other options > Weather Map API Key".','amokit-addons'); ?></p>
                </div>
            <?php
            return;
        }

        $weather = amokit\Weather\WeatherMap::get_wather_data(array(
            'api_key' => sanitize_text_field( $api_key ),
            'language'=> 'en',
            'units'   => esc_attr( $units ),
            'forecast_days' => (int)$settings['forecast'], 
            'custom_lat' => sanitize_text_field( $custom_lat ),
            'custom_long' => sanitize_text_field( $custom_long )
        ));

        if( !is_array($weather) && !isset($weather['current']) ){
            echo $weather; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }

        $current_temp_max = $weather['forecast'][0]['high'];
        $current_temp_min = $weather['forecast'][0]['low'];
        if(file_exists(AMONAKIT_ADDONS_PL_PATH . 'includes/weather-resource/template/'.$settings['layout'].'.php')) {
            require_once( AMONAKIT_ADDONS_PL_PATH . 'includes/weather-resource/template/' . sanitize_file_name( $settings['layout'] ) . '.php' );
        }

    }

}


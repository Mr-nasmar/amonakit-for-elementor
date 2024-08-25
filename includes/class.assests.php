<?php

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

if ( !class_exists( 'AmoKit_Elementor_Addons_Assests' ) ) {

    class AmoKit_Elementor_Addons_Assests{

        /**
         * [$_instance]
         * @var null
         */
        private static $_instance = null;

        /**
         * [instance] Initializes a singleton instance
         * @return [AmoKit_Elementor_Addons_Assests]
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * [__construct] Class construcotr
         */
        public function __construct(){

            // Register Scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );

            // Elementor Editor Style
            add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_scripts' ] );

            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        }

        /**
         * All available styles
         *
         * @return array
         */
        public function get_styles() {

            $style_list = [

                'htbbootstrap' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/htbbootstrap.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-widgets' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/amokit-widgets.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-animation' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/animation.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-weather' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/amokit-weather.css',
                    'version' => AMONAKIT_VERSION
                ],
                'regular-weather-icon' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/weather-icons.min.css',
                    'version' => AMONAKIT_VERSION
                ],
                'slick' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/slick.min.css',
                    'version' => AMONAKIT_VERSION
                ],
                'magnific-popup' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/magnific-popup.css',
                    'version' => AMONAKIT_VERSION
                ],
                'ytplayer' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/jquery.mb.YTPlayer.min.css',
                    'version' => AMONAKIT_VERSION
                ],
                'swiper' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/swiper.min.css',
                    'version' => '8.4.5'
                ],
                'compare-image' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/compare-image.css',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-widgets' ]
                ],
                'justify-gallery' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/justify-gallery.css',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-widgets' ]
                ],
                'datatables' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/datatables.min.css',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-widgets' ]
                ],
                'magnifier' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/magnifier.css',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-widgets' ]
                ],
                'animated-heading' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/animated-text.css',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-widgets' ]
                ],
                'amokit-keyframes' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/css/amokit-keyframes.css',
                    'version' => AMONAKIT_VERSION
                ],

                'amokit-admin' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/css/amokit_admin.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-selectric' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/lib/css/selectric.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-temlibray-style' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/css/tmp-style.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-rpbar-css' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'extensions/reading-progress-bar/assets/css/amokit-reading-progress-bar.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-stt-css' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'extensions/scroll-to-top/assets/css/amokit-scroll-to-top.css',
                    'version' => AMONAKIT_VERSION
                ],
                'amokit-audio-player' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/widgets/audio-player/style.css',
                    'version' => AMONAKIT_VERSION
                ]
            ];

            return apply_filters( 'amokit_style_list', $style_list );

        }

        /**
         * All available scripts
         *
         * @return array
         */
        public function get_scripts(){

            $google_map_api_key = amokit_get_option( 'google_map_api_key','amokit_general_tabs' );

            $script_list = [

                'amokit-audio-player' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/widgets/audio-player/active.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'htbbootstrap' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/htbbootstrap.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-popper' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/popper.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-widgets-scripts' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/amokit-widgets-active.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'slick' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/slick.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'magnific-popup' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.magnific-popup.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'beerslider' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery-beerslider-min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'ytplayer' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.mb.YTPlayer.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'mapmarker' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/mapmarker.jquery.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'jquery-easing' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.easing.1.3.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'jquery-mousewheel' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.mousewheel.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'vaccordion' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.vaccordion.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'easy-pie-chart' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery-easy-pie-chart.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-countdown' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery-countdown.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-newsticker' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery-newsticker-min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-goodshare' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/goodshare.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-notify' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/notify.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'counterup' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/jquery.counterup.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'isotope' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/isotope.pkgd.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'swiper' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/swiper.min.js',
                    'version' => '8.4.5',
                    'deps'    => [ 'jquery' ]
                ],
                'justified-gallery' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/justified-gallery.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'datatables' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/datatables.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'magnifier' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/magnifier.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'animated-heading' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/animated-heading.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'waypoints' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/waypoints.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'google-map-api' => [
                    'src'     => 'http://maps.googleapis.com/maps/api/js?sensor=false',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],

                'amokit-admin' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/js/admin.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-modernizr' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/lib/js/modernizr.custom.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'jquery-selectric' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/lib/js/jquery.selectric.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'jquery-ScrollMagic' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/lib/js/ScrollMagic.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'babel-min' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/lib/js/babel.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-templates' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/js/template_library_manager.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-install-manager' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'admin/assets/js/install_manager.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'amokit-templates', 'wp-util', 'updates' ]
                ],
                'amokit-rpbar-script' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'extensions/reading-progress-bar/assets/js/amokit-reading-progress-bar.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'amokit-stt-script' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'extensions/scroll-to-top/assets/js/amokit-scroll-to-top.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
                'anime' => [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'extensions/floating-effects/assets/js/anime.min.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ],
            ];

            if( !empty( $google_map_api_key ) ){
                $script_list['google-map-api'] = [
                    'src'     => 'https://maps.googleapis.com/maps/api/js?key='.$google_map_api_key,
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ];
            }

            if ( is_plugin_active('woocommerce/woocommerce.php') && amokit_get_option( 'wcaddtocart', 'amokit_thirdparty_element_tabs', 'on' ) === 'on' && 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ) {
                $script_list['amokit-single-product-ajax-cart'] = [
                    'src'     => AMONAKIT_ADDONS_PL_URL . 'assets/js/single_product_ajax_add_to_cart.js',
                    'version' => AMONAKIT_VERSION,
                    'deps'    => [ 'jquery' ]
                ];
            }

            return apply_filters( 'amokit_script_list', $script_list );

        }

        /**
         * Register scripts and styles
         *
         * @return void
         */
        public function register_assets() {
            $scripts = $this->get_scripts();
            $styles  = $this->get_styles();

            $localize_data_frontend = [];
            $localize_data_admin = [];

            if( is_plugin_active('elementor-pro/elementor-pro.php') ){
                $localize_data_frontend['elementorpro'] = true;
            }else{
                wp_deregister_script( 'swiper' );
                $localize_data_frontend['elementorpro'] = false;
            }
            // string for carousel next/ preve area button
            $localize_data_frontend['buttion_area_text_next'] = __( 'Next', 'amokit-addons');
            $localize_data_frontend['buttion_area_text_prev'] = __( 'Previous', 'amokit-addons');
            
            // Register Scripts
            foreach ( $scripts as $handle => $script ) {
                $deps = ( isset( $script['deps'] ) ? $script['deps'] : false );
                wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
            }

            // Register Styles
            foreach ( $styles as $handle => $style ) {
                $deps = ( isset( $style['deps'] ) ? $style['deps'] : false );
                wp_register_style( $handle, $style['src'], $deps, $style['version'] );
            }

            // Localize Scripts for frontend
            wp_localize_script( 'amokit-widgets-scripts', 'amokitF', $localize_data_frontend );
            if( is_plugin_active('amokit-pro/amokit_pro.php') ){
                wp_localize_script( 'amokit-pro-slick-active', 'amokitF', $localize_data_frontend );
            }
            // admin js ajax request nonce
            $localize_data_admin['admin_ajax_nonce'] = wp_create_nonce( "amokit-admin-ajax-request" );

            wp_localize_script( 'amokit-admin', 'amokitA', $localize_data_admin );

            // Localize Scripts for template manager
            $current_user  = wp_get_current_user();
            $localize_data = [
                'ajaxurl'          => admin_url( 'admin-ajax.php' ),
                'adminURL'         => admin_url(),
                'elementorURL'     => admin_url( 'edit.php?post_type=elementor_library' ),
                'version'          => AMONAKIT_VERSION,
                'pluginURL'        => plugin_dir_url( __FILE__ ),
                'alldata'          => !empty( AmoKit_Addons_Elementor::$template_info['templates'] ) ? AmoKit_Addons_Elementor::$template_info['templates'] : array(),
                'prolink'          => isset( AmoKit_Addons_Elementor::$template_info['pro_link'] ) ? AmoKit_Addons_Elementor::$template_info['pro_link'] : '#',

                'prolabel'         => esc_html__( 'Pro', 'amokit-addons' ),
                'loadingimg'       => AMONAKIT_ADDONS_PL_URL . 'admin/assets/images/loading.gif',
                'message'          =>[
                    'packagedesc'=> esc_html__( 'in this package', 'amokit-addons' ),
                    'allload'    => esc_html__( 'All Items have been Loaded', 'amokit-addons' ),
                    'notfound'   => esc_html__( 'Nothing Found', 'amokit-addons' ),
                ],
                'buttontxt'      =>[
                    'tmplibrary' => esc_html__( 'Import to Library', 'amokit-addons' ),
                    'tmppage'    => esc_html__( 'Import to Page', 'amokit-addons' ),
                    'import'     => esc_html__( 'Import', 'amokit-addons' ),
                    'buynow'     => esc_html__( 'Buy Now', 'amokit-addons' ),
                    'preview'    => esc_html__( 'Preview', 'amokit-addons' ),
                    'installing' => esc_html__( 'Installing..', 'amokit-addons' ),
                    'activating' => esc_html__( 'Activating..', 'amokit-addons' ),
                    'active'     => esc_html__( 'Active', 'amokit-addons' ),
                ],
                'user'           => [
                    'email' => $current_user->user_email,
                ],
                'plgactivenonce'   => wp_create_nonce( 'amokit_actication_verifynonce' ),
            ];
            wp_localize_script( 'amokit-templates', 'AMONAS', $localize_data );

            // Reading progress bar global functionality
            if( is_plugin_active('amokit-pro/amokit_pro.php') ) {

                $amokit_rpbar_module_settings = amokit_get_option( 'amokit_rpbar', 'amokit_rpbar_module_settings' );
                $amokit_rpbar_module_settings = json_decode( $amokit_rpbar_module_settings,true );

                if( $amokit_rpbar_module_settings && ('on' == $amokit_rpbar_module_settings['rpbar_enable']  && ( isset( $amokit_rpbar_module_settings['rpbar_global'] ) && 'on' == $amokit_rpbar_module_settings['rpbar_global'] ) ) ) {

                    $rpbar_select_to_show_pages = isset( $amokit_rpbar_module_settings['rpbar_select_to_show_pages'] ) ? $amokit_rpbar_module_settings['rpbar_select_to_show_pages'] : 'all';

                    if( 'all' == $rpbar_select_to_show_pages && ( is_single() || is_page() ) ) {  

                        wp_enqueue_script( 'amokit-rpbar-script');
                        wp_enqueue_style( 'amokit-rpbar-css');

                    } else if( 'pages' == $rpbar_select_to_show_pages && is_page() ) {

                        wp_enqueue_script( 'amokit-rpbar-script');
                        wp_enqueue_style( 'amokit-rpbar-css');
                        
                    } else if( 'posts' == $rpbar_select_to_show_pages && is_single() ) {
                        
                        wp_enqueue_script( 'amokit-rpbar-script');
                        wp_enqueue_style( 'amokit-rpbar-css');
                    }

                    $rpbar_localize_data = [
                        'bg_color'       => isset( $amokit_rpbar_module_settings['rpbar_background_color']) ? $amokit_rpbar_module_settings['rpbar_background_color'] : 'transparent',
                        'fill_color'     => isset( $amokit_rpbar_module_settings['rpbar_fill_color']) ? $amokit_rpbar_module_settings['rpbar_fill_color'] : '#fill_color',
                        'loading_height' => isset( $amokit_rpbar_module_settings['rpbar_loading_height']) ? $amokit_rpbar_module_settings['rpbar_loading_height'] : 5,
                        'position'       => isset( $amokit_rpbar_module_settings['rpbar_position']) ? $amokit_rpbar_module_settings['rpbar_position'] : 'top',
                    ];
    
                    wp_localize_script( 'amokit-rpbar-script', 'rpbar', $rpbar_localize_data );
                }
            }

            // Scroll To Top global functionality
            if( is_plugin_active('amokit-pro/amokit_pro.php') ) {

                $amokit_stt_module_settings = amokit_get_option( 'amokit_stt', 'amokit_stt_module_settings' );
                $amokit_stt_module_settings = json_decode( $amokit_stt_module_settings,true );

                if( $amokit_stt_module_settings && ('on' == $amokit_stt_module_settings['stt_enable']  && ( isset( $amokit_stt_module_settings['stt_global'] ) && 'on' == $amokit_stt_module_settings['stt_global'] ) ) ) {

                    $stt_select_to_show_pages = isset( $amokit_stt_module_settings['stt_select_to_show_pages'] ) ? $amokit_stt_module_settings['stt_select_to_show_pages'] : 'all';

                    if( 'all' == $stt_select_to_show_pages && ( is_single() || is_page() ) ) {  

                        wp_enqueue_script( 'amokit-stt-script');
                        wp_enqueue_style( 'amokit-stt-css');

                    } else if( 'pages' == $stt_select_to_show_pages && is_page() ) {

                        wp_enqueue_script( 'amokit-stt-script');
                        wp_enqueue_style( 'amokit-stt-css');
                        
                    } else if( 'posts' == $stt_select_to_show_pages && is_single() ) {
                        
                        wp_enqueue_script( 'amokit-stt-script');
                        wp_enqueue_style( 'amokit-stt-css');
                    }

                    $stt_localize_data = [
                        'stt_bg_color'       => isset( $amokit_stt_module_settings['stt_bg_color']) ? $amokit_stt_module_settings['stt_bg_color'] : '#000000',
                        'stt_color'          => isset( $amokit_stt_module_settings['stt_color']) ? $amokit_stt_module_settings['stt_color'] : '#ffffff',
                        'stt_bg_color_hover' => isset( $amokit_stt_module_settings['stt_bg_color_hover']) ? $amokit_stt_module_settings['stt_bg_color_hover'] : '#000000',
                        'stt_color_hover'    => isset( $amokit_stt_module_settings['stt_color_hover']) ? $amokit_stt_module_settings['stt_color_hover'] : '#ffffff',
                        'position'           => isset( $amokit_stt_module_settings['stt_position']) ? $amokit_stt_module_settings['stt_position'] : 'right',
                        'stt_bottom_space'   => isset( $amokit_stt_module_settings['stt_bottom_space']) ? $amokit_stt_module_settings['stt_bottom_space'] : 30,
                    ];
    
                    wp_localize_script( 'amokit-stt-script', 'stt', $stt_localize_data );
                }
            }
            // localize  woocommerce  add to card button action 
            if ( is_plugin_active('woocommerce/woocommerce.php') && amokit_get_option( 'wcaddtocart', 'amokit_thirdparty_element_tabs', 'on' ) === 'on' && 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ) {
                $localize_data_woocommerce = [];
                $localize_data_woocommerce['woocommerce_ajax_nonce'] = wp_create_nonce( "amokit-woocommerce-ajax-request" );
                wp_localize_script( 'amokit-single-product-ajax-cart', 'amokitW', $localize_data_woocommerce );
            }
        }


        /**
         * [editor_scripts]
         * @return [void] Load Editor Scripts
         */
        public function editor_scripts() {
            wp_enqueue_style('amokit-element-editor', AMONAKIT_ADDONS_PL_URL . 'assets/css/amokit-elementor-editor.css',['elementor-editor'], AMONAKIT_VERSION );
            wp_enqueue_script("amokit-widgets-editor", AMONAKIT_ADDONS_PL_URL ."/assets/js/amokit-widgets-editor.js", array( "elementor-editor","jquery" ), AMONAKIT_VERSION,true);
            wp_enqueue_script("amokit-pormotion-editor", AMONAKIT_ADDONS_PL_URL ."/assets/js/promotion.js", array( "elementor-editor","jquery" ), AMONAKIT_VERSION,true);
            //Localized  promotional widget for editor js
            wp_localize_script(
                'amokit-widgets-editor',
                'amokitPanelSettings',
                array(
                    'amokit_pro_installed' => is_plugin_active('amokit-pro/amokit_pro.php') ? true : false,
                    'amokit_pro_widgets'   => $this->get_promotional_widget_list(),
                )
            );
        }

        /**
         * [enqueue_scripts]
         * @return [void] Frontend Scripts
         */
        public function enqueue_scripts(){

            // CSS
            wp_enqueue_style( 'htbbootstrap' );
            wp_enqueue_style( 'font-awesome' );
            wp_enqueue_style( 'amokit-animation' );
            wp_enqueue_style( 'amokit-keyframes' );

            // JS
            wp_enqueue_script( 'amokit-popper' );
            wp_enqueue_script( 'htbbootstrap' );
            wp_enqueue_script( 'waypoints' ); 

        }
        /**
         * get_promotional_widget_list function
         *
         * @return promotional_widgets list
         */
       public function get_promotional_widget_list() {
        
        $promotional_widgets = array(
            array(
				'key'       => 'amokit-info-box-addons',
				'title'      => __( 'Info Box', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-info',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-info-box-widget/'),
			),
            array(
				'key'       => 'amokit-advanced-slider-addons',
				'title'      => __( 'Advanced Slider', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-post-slider',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-advanced-slider-widget/'),
			),
            array(
				'key'       => 'amokit-background-switcher',
				'title'      => __( 'Background Switcher', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-exchange',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-background-switcher-widget/'),
			),
            array(
				'key'        => 'amokit-breadcrumbs',
				'title'      => __( 'Breadcrumbs', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-exchange',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-breadcrumbs-widget/'),
			),
            array(
				'key'        => 'amokit-category-list-addons',
				'title'      => __( 'Category List', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-bullet-list',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-category-list-widget/'),
			),
            array(
				'key'       => 'amokit-chart-addons',
				'title'      => __( 'Chart', 'amokit-addons' ),
				'icon'       => 'amokit-icon amokit-chart-img',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-chart-widget/'),
			),
            array(
				'key'       => 'amokit-dynamic-gallery-addons',
				'title'      => __( 'Dynamic Gallery', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-gallery-justified',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-dynamic-gallery-widget/'),
			),
            array(
				'key'       => 'amokit-event-box-addons',
				'title'      => __( 'Event Box', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-table-of-contents',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-event-box-widget/'),
			),
            array(
				'key'       => 'amokit-event-calendar-addons',
				'title'      => __( 'Event Calendar', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-calendar',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-event-calendar-widget/'),
			),
            array(
				'key'       => 'amokit-facebook-review-addons',
				'title'      => __( 'Facebook Review', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-facebook',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-facebook-review-widget/'),
			),
            array(
				'key'       => 'amokit-feature-list-addons',
				'title'      => __( 'Feature List', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-post-list',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-feature-list-widget/'),
			),
            array(
				'key'       => 'amokit-filterable-gallery-addons',
				'title'      => __( 'Filterable Gallery', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-gallery-justified',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-filterable-gallery-widget/'),
			),
            array(
				'key'       => 'amokit-flip-switcher-pricing-table-addons',
				'title'      => __( 'Flip Switcher Pricing Table', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-dual-button',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-pricing-table-flip-box-widget/'),
			),
            array(
				'key'       => 'amokit-icon-box-addons',
				'title'      => __( 'Icon Box', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-icon-box',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-icon-box-widget/'),
			),
            array(
				'key'       => 'amokit-image-roted-addons',
				'title'      => __( 'Image Rotate', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-image-before-after',
				'action_url' => esc_url('https://nasdesigns.rf.gd/'),
			),
            array(
				'key'       => 'amokit-interactive-promo-addons',
				'title'      => __( 'Interactive Promo', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-call-to-action',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-interactive-promo-widget/'),
			),
            array(
				'key'       => 'amokit-lottie-addons',
				'title'      => __( 'Lottie', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-lottie',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-lottie-widget/'),
			),
            array(
				'key'       => 'amokit-page-list-addons',
				'title'      => __( 'Page List', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-bullet-list',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-page-list-widget/'),
			),
            array(
				'key'       => 'amokit-post-masonry-addons',
				'title'      => __( 'Post Masonry', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-posts-masonry',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-post-masonry-widget/'),
			),
            array(
				'key'       => 'amokit-post-timeline-addons',
				'title'      => __( 'Post Timeline', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-time-line',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-post-timeline-widget/'),
			),
            array(
				'key'       => 'amokit-pricing-menu-addons',
				'title'      => __( 'Pricing Menu', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-info-box',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-price-menu-widget/'),
			),
            array(
				'key'       => 'amokit-pricing-table-flip-box',
				'title'      => __( 'Pricing Table Flip Box', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-flip-box',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-pricing-table-flip-box-widget/'),
			),
            array(
				'key'       => 'amokit-social-network-icons-addons',
				'title'      => __( 'Social Network Icons', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-social-icons',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-social-network-widget/'),
			),
            array(
				'key'       => 'amokit-source-code-addons',
				'title'      => __( 'Source Code', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-code',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-source-code-widget/'),
			),
            array(
				'key'       => 'amokit-sticky-section-addons',
				'title'      => __( 'Sticky Section', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-filter',
				'action_url' => esc_url('https://nasdesigns.rf.gd/'),
			),
            array(
				'key'       => 'amokit-taxonomy-terms-addons',
				'title'      => __( 'Taxonomy Terms', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-radio',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-taxonomy-terms-widget/'),
			),
            array(
				'key'       => 'amokit-team-carousel-addons',
				'title'      => __( 'Team Carousel', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-person',
				'action_url' => esc_url('https://nasdesigns.rf.gd/elementor-team-carousel-widget/'),
			),
            array(
				'key'       => 'amokit-threesixty-rotation-addons',
				'title'      => __( '360 Rotation', 'amokit-addons' ),
				'icon'       => 'amokit-icon amokit-threesixty-rotation-img',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-360-rotation-widget/'),
			),
            array(
				'key'       => 'amokit-whatsapp-chat-addons',
				'title'      => __( 'WhatsApp Chat', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-commenting-o',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-whatsapp-chat-widget/'),
			),
            array(
				'key'       => 'amokit-flip-carousel-addons',
				'title'      => __( 'Flip Carousel', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-media-carousel',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-flip-carousel-widget/'),
			),

            array(
				'key'       => 'amokit-interactive-circle-infographic-addons',
				'title'      => __( 'Interactive Circle Infographic', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-integration',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-interactive-circle-infographic-widget/'),
			),
            array(
				'key'       => 'amokit-copy-coupon-code-addons',
				'title'      => __( 'Copy Coupon Code', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-copy',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-copy-coupon-code-widget/'),
			),
            array(
				'key'       => 'amokit-video-gallery-addons',
				'title'      => __( 'Video Gallery', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-media-carousel',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-video-gallery-widget/'),
			),
            array(
				'key'       => 'amokit-video-playlist-addons',
				'title'      => __( 'Video Playlist', 'amokit-addons' ),
				'icon'       => 'amokit-icon eicon-video-playlist',
				'action_url' => esc_url('https://nasdesigns.rf.gd/widget/elementor-video-playlist-widget/'),
			),

        );

        return $promotional_widgets;
       }

    }

    AmoKit_Elementor_Addons_Assests::instance();

}
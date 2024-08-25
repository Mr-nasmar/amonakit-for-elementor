<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 /**
 * Assets Manager
 */
 class AmoKitExtensions_Scripts{

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Register Scripts
        add_action( 'init', [ $this, 'register_scripts' ] );

        // Frontend Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );

    }

    /**
    * Register Scripts
    */

    public function register_scripts(){

        if( amokit_get_option( 'themebuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
            wp_register_script(
                'goodshare',
                AMONAKIT_ADDONS_PL_URL . 'assets/extensions/amo-builder/js/goodshare.min.js',
                array('jquery'),
                AMONAKIT_VERSION,
                TRUE
            );
        }

    }

    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {

        // HT Builder
        if( amokit_get_option( 'themebuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
            // CSS
            wp_enqueue_style(
                'amobuilder-main',
                AMONAKIT_ADDONS_PL_URL . 'assets/extensions/amo-builder/css/amobuilder.css',
                NULL,
                AMONAKIT_VERSION
            );

            // JS
            wp_enqueue_script( 'masonry' );
            wp_enqueue_script(
                'amobuilder-main',
                AMONAKIT_ADDONS_PL_URL . 'assets/extensions/amo-builder/js/amobuilder.js',
                array('jquery'),
                AMONAKIT_VERSION,
                TRUE
            );
            
        }

        // WC Sales Notification
        if( amokit_get_option( 'salenotification', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
            wp_enqueue_style(
                'wcsales-main',
                AMONAKIT_ADDONS_PL_URL . 'assets/extensions/wc-sales-notification/css/wc_notification.css',
                NULL,
                AMONAKIT_VERSION
            );
        }


    }



}

AmoKitExtensions_Scripts::instance();
<?php

namespace AmoKit\Preset;

defined( 'ABSPATH' ) || die();

class Preset_Manage {
    public static function init() {
        add_action( 'wp_ajax_amokit_preset_design', [ __CLASS__, 'get_preset_design' ] );
    }

    public static function get_preset_design(){

        if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( $_GET['nonce'], 'amokit_preset_select' ) ) {
            wp_send_json_error( __( 'Invalid preset request', 'amokit-addons' ), 403 );
        }

        if ( empty( $_GET['widget'] ) ) {
            wp_send_json_error( __( 'Incomplete preset request', 'amokit-addons' ), 404 );
        }

        if ( ! ( $preset_designs = self::get_presets_option( $_GET['widget'] ) ) ) {
            wp_send_json_error( __( 'Preset not found', 'amokit-addons' ), 404 );
        }

        wp_send_json_success( $preset_designs, 200 );

        die();
    }

    protected static function get_presets_option($presete_name) {
        $preset_path = AMONAKIT_ADDONS_PL_PATH . 'admin/assets/presets/' . sanitize_file_name( $presete_name ) . '.json'; 
    
        if (is_plugin_active('amokit-pro/amokit_pro.php')) {
            if (!file_exists($preset_path)) {
                $preset_path = AMONAKIT_ADDONS_PL_PATH_PRO . 'assets/preset-json/' . sanitize_file_name( $presete_name ) . '.json';
            }
        }

        return amokit_get_local_file_data( $preset_path );
    }
    
}

Preset_Manage::init();
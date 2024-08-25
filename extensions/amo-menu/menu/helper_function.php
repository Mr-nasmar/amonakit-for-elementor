<?php

    // Exit if accessed directly
    if( ! defined( 'ABSPATH' ) ) exit();

   /*
    * Elementor Templates List
    * return array
    */
    if(!function_exists('amokit_menu_elementor_template')){
        function amokit_menu_elementor_template() {
            $templates = '';
            if( class_exists('\Elementor\Plugin') ){
                $templates = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
            }
            if ( empty( $templates ) ) {
                $template_lists = [ '0' => __( 'Do not Saved Templates.', 'amokit-addons' ) ];
            } else {
                $template_lists = [ '0' => __( 'Select Template', 'amokit-addons' ) ];
                foreach ( $templates as $template ) {
                    $template_lists[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
                }
            }
            return $template_lists;
        }
    }

   /**
    * Options return
    */
    if(!function_exists('amokit_menu_get_option')){
        function amokit_menu_get_option( $option, $section, $default = '' ){
            $options = get_option( $section );
            if ( isset( $options[$option] ) ) {
                return $options[$option];
            }
            return $default;
        }
    }

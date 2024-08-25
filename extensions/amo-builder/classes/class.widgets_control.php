<?php

namespace AmoKit_Builder\Elementor;
use Elementor\Plugin as Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Widgets Control
*/
class AmoKitBuilder_Widgets_Control{

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

    // Widgets Initialize
    public function init() {

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        // Add Plugin actions
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

    }

    // Add custom category.
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'amokit_builder',
            [
                'title' => __( 'amokit Builder', 'amokit-addons' ),
                'icon' => 'fa fa-snowflake-o',
            ]
        );
    }

    // Compatibility with elementor version 3.6.1
    public function widget_for_amobuilder_manager($widget_class){
        $widgets_manager = Elementor::instance()->widgets_manager;
        
        if ( amokit_is_elementor_version( '>=', '3.5.0' ) ){
            $widgets_manager->register( $widget_class );
        }else{
            $widgets_manager->register_widget_type( $widget_class );
        }
    }

    // Widgets Register
    public function register_widgets() {

        $bl_element  = array();
        $element_manager = array();

        // Builder Element
        $bl_element  = array(
            'bl_post_title',
            'bl_post_featured_image',
            'bl_post_meta_info',
            'bl_post_excerpt',
            'bl_post_content',
            'bl_post_comments',
            'bl_post_search_form',
            'bl_post_archive',
            'bl_post_archive_title',
            'bl_page_title',
            'bl_site_title',
            'bl_site_logo',
            'bl_nav_menu',
            'bl_post_author_info',
        );
        $element_manager = array_merge( $element_manager, $bl_element );

        // Include Widget files
        foreach ( $element_manager as $element ){
            if (  ( amokit_get_option( $element, 'amokit_themebuilder_element_tabs', 'on' ) === 'on' ) && file_exists(AMONAKIT_ADDONS_PL_PATH.'extensions/amo-builder/widgets/'.$element.'.php' ) ){
                require( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-builder/widgets/'.$element.'.php' );
                $class_name = 'amokit_Builder\Elementor\Widget\\'.$element.'_ELement';
                $this->widget_for_amobuilder_manager( new $class_name() );
            }
        }

    }

}

AmoKitBuilder_Widgets_Control::instance();
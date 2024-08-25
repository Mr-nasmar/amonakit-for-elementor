<?php 

namespace AmoKit\ElementorTemplate;
use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Library_Manage{
	
	/**
     * [$source]
     * @var null
     */
    protected static $source = null;

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Library_Manager]
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * [init] Initializes
     * @return [void]
     */
    function __construct() {
        add_action( 'elementor/editor/footer', [ $this, 'print_template_views' ] );
        add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elem_template_scripts' ] );
        add_action( 'elementor/preview/enqueue_styles', [ $this, 'preview_scripts' ] );

    }


    /**
     * [print_template_views] template view print
     * @return [void]
     */
    public function print_template_views() {
       include_once ( AMONAKIT_ADDONS_PL_PATH . 'admin/include/templates/library/templates.php' );
    }

    /**
     * [register_ajax_actions]
     * @param  Ajax $ajax 
     * @return [array] template list
     */
    public function register_ajax_actions( Ajax $ajax ) {
        $ajax->register_ajax_action( 'get_amokit_library_data', function( $data ) {
            if ( ! current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            $result = [];

            if ( ! empty( $data['sync'] ) ) {

                $stror_time = (int) get_option( 'amokit_api_last_req' );

                if ( $stror_time ){
                    if( time() > $stror_time + 86400 ){
                        update_option( 'amokit_api_last_req', time() );
                        delete_transient('amokit_template_info');
                        delete_transient('amokit_template_request_pending');
                        delete_transient('amokit_severdown_request_pending');
                    }

                } else {
                    update_option( 'amokit_api_last_req', time() );
                    delete_transient('amokit_template_info');
                    delete_transient('amokit_template_request_pending');
                    delete_transient('amokit_severdown_request_pending');       
                }
               
            }
          
            $transient = get_transient( 'amokit_template_info' );

            if ( $transient ){
                $result = $transient;
            }else{
                $result = \AmoKit_Template_Library::instance()->get_templates_info();
            }
            return $result;
        } );

        $ajax->register_ajax_action( 'get_amokit_template_data', function( $data ) {
            
            if ( ! current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( ! empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( ! get_post( $editor_post_id ) ) {
                    throw new \Exception( esc_html__( 'Post not found', 'amokit-addons' ) );
                }

                amokit_get_elementor()->db->switch_to_post( $editor_post_id );
            }

            if ( empty( $data['template_id'] ) ) {
                throw new \Exception( esc_html__( 'Template id missing', 'amokit-addons' ) );
            }

            $result = $this->get_template_data( $data );

            return $result;

        } );

    }

    /**
     * [elem_template_scripts] Editor Scripts
     * @return [void]
     */
    public function elem_template_scripts() {

        wp_enqueue_style(
            'amokit-templates-library',
            AMONAKIT_ADDONS_PL_URL . 'admin/assets/css/elementor_template_library.css',
            [
                'elementor-editor',
            ],
            AMONAKIT_VERSION
        );

        wp_enqueue_script(
            'amokit-templates-library',
            AMONAKIT_ADDONS_PL_URL . 'admin/assets/js/elementors_template_library.js',
            [
                'elementor-editor',
                'jquery-hover-intent',
            ],
            AMONAKIT_VERSION,
            true
        );

        wp_localize_script( 'amokit-templates-library', 'amokitETMP',
            [
                'icon' => AMONAKIT_ADDONS_PL_URL .'admin/assets/images/menu-icon.svg',
            ]
        );

    }

    /**
     * [preview_scripts] Preview Style
     * @return [void]
     */
    public function preview_scripts(){

        $inline_styles = '
            .elementor-add-new-section .elementor-add-amokit-template-button {
                background-color: #D73361;
                margin-left: 5px;
                vertical-align:top;
            }
        ';
        wp_add_inline_style( 'amokit-widgets', $inline_styles );
    }

    /**
     * [get_source]
     * @return [void]
     */
    public function get_source() {
        if ( is_null( self::$source ) ) {
            self::$source = new Library_Source();
        }

        return self::$source;
    }


    /**
     * [get_template_data] Get Template content
     * @param  array $args new custom argument
     * @return [array]
     */
    public function get_template_data( array $args ) {
        $source = $this->get_source();
        $data = $source->get_data( $args );
        return $data;
    }

}
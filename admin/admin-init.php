<?php

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class AmoKit_Admin_Setting{

    public function __construct(){
        add_action( 'admin_enqueue_scripts', [ $this, 'amokit_enqueue_admin_scripts' ] );
        $this->AmoKit_Admin_Settings_page();

        // Amona Kit Pro version check and menu remove action
        if( is_plugin_active('amokit-pro/amokit_pro.php') && ( version_compare( AMONAKIT_VERSION_PRO, '1.0.0' ) <= 0 ) ){
            add_action( 'admin_init', [ $this, 'amokit_un_register_admin_menu' ] );
        }

        // Dashboard Widget.
        if( !is_plugin_active('woolentor-addons/woolentor_addons_elementor.php') ){
            add_action( 'wp_dashboard_setup', [ $this, 'dashboard_widget' ], 9999 );
        }
        // Upgrade Pro Menu
        if( !is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) {
            add_action( 'admin_menu', [$this, 'upgrade_to_pro_menu'], 329 );
            add_action('admin_head', [ $this, 'admin_menu_item_adjust'] );
            add_action('admin_head', [ $this, 'enqueue_admin_head_scripts'], 11 );
        }

    }

    /*
    *  Setting Page
    */
    public function AmoKit_Admin_Settings_page() {
        require_once('include/class.newsletter-data.php');
        require_once('include/class.diagnostic-data.php');
        require_once('include/template-library.php');
        require_once ('include/class.amokit-elementor-template-library.php' );
        require_once ('include/class.library-source.php' );
        require_once( 'include/class.dynamic-notice.php' ); // dynamic notice file
        require_once( AMONAKIT_ADDONS_PL_PATH.'includes/class.api.php' );
        if( ! class_exists( 'AmoKit_Settings_API' ) ) {
            require_once ( AMONAKIT_ADDONS_PL_PATH . '/admin/include/class.settings-api.php' );
        }
        require_once( 'include/admin-setting.php' );
        if( is_plugin_active('amokit-pro/amokit_pro.php') && defined( "AMONAKIT_ADDONS_PL_PATH_PRO" ) && file_exists( AMONAKIT_ADDONS_PL_PATH_PRO.'includes/admin/admin-setting.php' ) ){
            require_once ( AMONAKIT_ADDONS_PL_PATH_PRO.'includes/admin/admin-setting.php' );
        }

        // Amo Builder
        if ( 'on' == amokit_get_module_option( 'amokit_themebuilder_module_settings','themebuilder','themebuilder_enable','off' ) ) {
            if( is_plugin_active('amokit-pro/amokit_pro.php') ){
                require_once( AMONAKIT_ADDONS_PL_PATH_PRO.'extensions/amo-builder/admin/setting.php' );
            }else{
                require_once( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-builder/admin/setting.php' );
            }

        } else {
            if ( amokit_get_option( 'themebuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' && empty ( amokit_get_module_option( 'amokit_themebuilder_module_settings') ) ){
                if( is_plugin_active('amokit-pro/amokit_pro.php') ){
                    require_once( AMONAKIT_ADDONS_PL_PATH_PRO.'extensions/amo-builder/admin/setting.php' );
                }else{
                    require_once( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-builder/admin/setting.php' );
                }
            }
        }

        // Sale Notification
        if( amokit_get_option( 'salenotification', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
            if( is_plugin_active('amokit-pro/amokit_pro.php') ){
                require_once( AMONAKIT_ADDONS_PL_PATH_PRO.'extensions/wc-sales-notification/admin/setting.php' );
            }else{
                require_once( AMONAKIT_ADDONS_PL_PATH.'extensions/wc-sales-notification/admin/setting.php' );
            }
        }
        // Amona Kit Menu
        if ( 'on' == amokit_get_module_option( 'amokit_megamenu_module_settings','megamenubuilder','megamenubuilder_enable','off' ) ) {

            require_once( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-menu/admin/setting.php' );

        } else {

            if ( amokit_get_option( 'megamenubuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' && empty ( amokit_get_module_option( 'amokit_megamenu_module_settings') ) ){
                require_once( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-menu/admin/setting.php' );
            }
        }
    }

    /**
     * [upgrade_to_pro_menu] Admin Menu
     */
    public function upgrade_to_pro_menu(){
        add_submenu_page(
            'amokit-addons', 
            esc_html__('Upgrade to Pro', 'amokit-addons'),
            esc_html__('Upgrade to Pro', 'amokit-addons'), 
            'manage_options', 
            'https://nasdesigns.rf.gd/pricing/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free'
        );
    }

    // Add Class For pro Menu Item
    public function admin_menu_item_adjust(){
        global $submenu;

		// Check Amona Kit Menu page exist or not
		if ( ! isset( $submenu['amokit-addons'] ) ) {
			return;
		}

        $position = key(
			array_filter( $submenu['amokit-addons'],  
				static function( $item ) {
					return strpos( $item[2], 'https://nasdesigns.rf.gd/pricing/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free' ) !== false;
				}
			)
		);

        if ( isset( $submenu['amokit-addons'][ $position ][4] ) ) {
			$submenu['amokit-addons'][ $position ][4] .= ' amokit-upgrade-pro';
		} else {
			$submenu['amokit-addons'][ $position ][] = 'amokit-upgrade-pro';
		}
    }

    // Add Custom scripts for pro menu item
    public function enqueue_admin_head_scripts() {
        $styles = '';
        $scripts = '';

        $styles .= '#adminmenu #toplevel_page_amokit-addons a.amo-upgrade-pro { font-weight: 600; background-color: #D43A6B; color: #ffffff; display: block; text-align: left;}';
        $scripts .= 'jQuery(document).ready( function($) {
			$("#adminmenu #toplevel_page_amokit-addons a.amo-upgrade-pro").attr("target","_blank");  
		});';
		
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<style>%s</style>', $styles );
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<script>%s</script>', $scripts );
    }
    
    /*
    *   Enqueue admin scripts
    */
    public function amokit_enqueue_admin_scripts( $hook ){
        if( $hook === 'amokit-addons_page_amokit_addons_templates_library' || $hook === 'toplevel_page_amokit-addons' || $hook === 'amokit-addons_page_amokitnotification' || $hook === 'amokit-addons_page_amokitmenubl' || $hook === 'amokit-addons_page_amokitbuilder' ){
            // wp core styles
            wp_enqueue_style( 'wp-jquery-ui-dialog' );
            wp_enqueue_style( 'amokit-admin' );
            
            // wp core scripts
            wp_enqueue_script( 'jquery-ui-dialog' );
            wp_enqueue_script( 'amokit-admin' );
            
        }

    }
    /*
    *   Remove old Amona Kit admin menu from (version 1.4.3 )
    */
    public function amokit_un_register_admin_menu(){
        remove_menu_page( 'amonakit_addons_option_page' );
    }

    /**
     * [dashboard_widget] Register Dashboard Widget
     * @return [void]
     */
    public function dashboard_widget() {
		wp_add_dashboard_widget( 
            'amonakit-dashboard-stories', 
            esc_html__( 'Amona Kit Stories', 'amokit-addons' ), 
            [ $this, 'dashboard_amonakit_widget' ] 
        );

		// Metaboxes Array.
		global $wp_meta_boxes;

		$dashboard_widget_list = $wp_meta_boxes['dashboard']['normal']['core'];

        $amonakit_dashboard_widget = [
            'amonakit-dashboard-stories' => $dashboard_widget_list['amonakit-dashboard-stories']
        ];

        $all_dashboard_widget = array_merge( $amonakit_dashboard_widget, $dashboard_widget_list );

		$wp_meta_boxes['dashboard']['normal']['core'] = $all_dashboard_widget;

	}


    /**
     * [dashboard_amonakit_widget] Dashboard Stories Widget
     * @return [void]
     */
    public function dashboard_amonakit_widget() {
        ob_start();
        self::load_template('widget');
        echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * [load_template] Template load
     * @param  [string] $template template suffix
     * @return [void]
     */
    private static function load_template( $template ) {
        $tmp_file = AMONAKIT_ADDONS_PL_PATH . 'admin/include/templates/dashboard-' . $template . '.php';
        if ( file_exists( $tmp_file ) ) {
            include_once( $tmp_file );
        }
    }

}

new AmoKit_Admin_Setting();
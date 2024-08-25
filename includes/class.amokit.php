<?php

final class AmoKit_Addons_Elementor {
    
    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * [$template_info]
     * @var array
     */
    public static $template_info = [];

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [AmoKit_Addons_Elementor]
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
    private function __construct() {
           if ( ! function_exists('is_plugin_active') ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ], 15 );

        // Register Plugin Active Hook
        register_activation_hook( AMONAKIT_ADDONS_PL_ROOT, [ $this, 'plugin_activate_hook'] );

    }

    /**
     * [i18n] Load Text Domain
     * @return [void]
     */
    public function i18n() {
        load_plugin_textdomain( 'amokit-addons', false, dirname( plugin_basename( AMONAKIT_ADDONS_PL_ROOT ) ) . '/languages/' );
    }

    /**
     * [init] Plugins Loaded Init Hook
     * @return [void]
     */
    public function init() {

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Plugins Required File
        $this->includes();

        //elementor editor template library
        if ( is_user_logged_in() && did_action( 'elementor/loaded' ) ) {
            AmoKit\ElementorTemplate\Elementor_Library_Manage::instance();
        }

        // Add Image Size
        $this->add_image_size();

        // After Active Plugin then redirect to setting page
        $this->plugin_redirect_option_page();

        // Plugins Setting Page
        add_filter('plugin_action_links_'.AMONAKIT_ADDONS_PLUGIN_BASE, [ $this, 'plugins_setting_links' ] );
        add_filter( 'plugin_row_meta', [ $this, 'amokit_plugin_row_meta' ], 10, 4 );
        /**
         * [$template_info] Assign template data
         * @var [type]
         */

        if(isset($_GET['page']) && 'amokit_addons_templates_library' === $_GET['page'] ){ // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            if( is_admin() && class_exists('amokit_Template_Library') ){

                $stror_time = (int) get_option( 'amokit_api_last_req' );

                if ( $stror_time ){
                    
                    if( time() > $stror_time + 604800 ){
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

                self::$template_info = AmoKit_Template_Library::instance()->get_templates_info();
            }

        }
        
        // Admin Notices
        add_action( 'admin_head', [ $this, 'admin_rating_notice' ] );

         if ( is_plugin_active('amokit-pro/amokit_pro.php' ) ) {
            add_action( 'admin_head', [ $this, 'admin_amokit_pro_version_compatibily' ] );
        }
    }

    /**
     * Rating Notice
     *
     * @return void
     */
    public function admin_rating_notice(){

        if ( get_option( 'amokit_rating_already_rated', false ) ) {
            return;
        }
        
        $logo_url = esc_url(AMONAKIT_ADDONS_PL_URL . "admin/assets/images/logo.png");

        $message = '<div class="nasdesigns-review-notice-wrap">
                    <div class="nasdesigns-rating-notice-logo">
                        <img src="' . $logo_url . '" alt="' . esc_attr__('Amona Kit','amokit-addons') . '" style="max-width:85px"/>
                    </div>
                    <div class="nasdesigns-review-notice-content">
                        <h3>' . esc_html__('Hi there! Thanks a lot for choosing Amona Kit Elementor Addons to take your WordPress website to the next level.','amokit-addons').'</h3>
                        <p>' . esc_html__('It would be greatly appreciated if you consider giving us a review in WordPress. These reviews help us improve the plugin further and make it easier for other users to decide when exploring Amona Kit Elementor Addons!', 'amokit-addons') . '</p>
                        <div class="nasdesigns-review-notice-action">
                            <a href="https://wordpress.org/support/plugin/amo-kit-for-elementor/reviews/?filter=5#new-post" class="nasdesigns-review-notice button-primary" target="_blank">' . esc_html__('Ok, you deserve it!','amokit-addons') . '</a>
                            <span class="dashicons dashicons-calendar"></span>
                            <a href="#" class="nasdesigns-notice-close nasdesigns-review-notice">' . esc_html__('Maybe Later','amokit-addons').'</a>
                            <span class="dashicons dashicons-smiley"></span>
                            <a href="#" data-already-did="yes" class="nasdesigns-notice-close nasdesigns-review-notice">' . esc_html__('I already did','amokit-addons') . '</a>
                        </div>
                    </div>
                </div>';

        \NasDesigns_Notices::set_notice(
            [
                'id'          => 'amokit-rating-notice',
                'type'        => 'info',
                'dismissible' => true,
                'message_type' => 'html',
                'message'     => $message,
                'display_after' => ( 2 * WEEK_IN_SECONDS ),
                'expire_time' => MONTH_IN_SECONDS,
                'close_by'    => 'transient'
            ]
        );
    }



    /**
     * Amona Kit Pro version compatibility Notice
     *
     * @return void
     */
    public function admin_amokit_pro_version_compatibily() {

        if ( is_plugin_active('amokit-pro/amokit_pro.php') && ( version_compare( AMONAKIT_VERSION_PRO, '1.0.0' ) >= 0 ) ) {
            return;
        }
        
        $message = '<p>' . __( 'To ensure smooth functionality of <strong>Amona Kit Addons for Elementor</strong>, it\'s essential to have the most recent version of <strong>Amona Kit Pro</strong>. Please make sure to update <strong>Amona Kit Pro</strong> to ensure seamless compatibility with this version.', 'amokit-addons' ) . '</p>';

        \NasDesigns_Notices::set_notice(
            [
                'id'          => 'amokit-free-and-pro-compatibilty-notice',
                'type'        => 'warning',
                'dismissible' => false,
                'message_type' => 'html',
                'message'     => $message,
                'display_after'  => 1,
                'expire_time' => 0,
                'close_by'    => 'user'
            ]
        );
    }

    /**
     * [add_image_size]
     * @return [void]
     */
    public function add_image_size() {
        add_image_size( 'amokit_size_585x295', 585, 295, true );
        add_image_size( 'amokit_size_1170x536', 1170, 536, true );
        add_image_size( 'amokit_size_396x360', 396, 360, true );
    }

    /**
     * [is_plugins_active] Check Plugin installation status
     * @param  [string]  $pl_file_path plugin location
     * @return boolean  True | False
     */
    public function is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }

    /**
     * [admin_notice_missing_main_plugin] Admin Notice if elementor Deactive | Not Install
     * @return [void]
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor = 'elementor/elementor.php';
        if( $this->is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) { return; }

            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

            $message = '<p>' . __( '<strong>Amona KIT Addons for Elementor</strong> requires "<strong>Elementor</strong>" plugin to be active. Please activate Elementor to continue.', 'amokit-addons' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Elementor Activate Now', 'amokit-addons' ) ) . '</p>';
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) { return; }

            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

            $message = '<p>' . __( '<strong>Amona KIT Addons for Elementor</strong> requires "<strong>Elementor</strong>" plugin to be active. Please install the Elementor plugin to continue.', 'amokit-addons' ) . '</p>';

            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Elementor Install Now', 'amokit-addons' ) ) . '</p>';
        }
        echo '<div class="error"><p>' . $message . '</p></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * [admin_notice_minimum_elementor_version]
     * @return [void] Elementor Required version check with current version
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            /* translators: 1: Plugin name (AmoKit Addons), 2: Required plugin name (Elementor), 3: Minimum required version */
            __( '"%1$s" requires "%2$s" version %3$s or greater.', 'amokit-addons' ),
            '<strong>' . __( 'amokit Addons', 'amokit-addons' ) . '</strong>',
            '<strong>' . __( 'Elementor', 'amokit-addons' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * [admin_notice_minimum_php_version] Check PHP Version with required version
     * @return [void]
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf( /* translators: 1: Plugin name (AmoKit Addons), 2: Required component name (PHP), 3: Minimum required version */
            __( '"%1$s" requires "%2$s" version %3$s or greater.', 'amokit-addons' ),
            '<strong>' . __( 'amokit Addons', 'amokit-addons' ) . '</strong>',
            '<strong>' . __( 'PHP', 'amokit-addons' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    } 

    /**
     * [plugins_setting_links]
     * @param  [array] $links plugin menu list.
     * @return [array] plugin menu list.
     */
    public function plugins_setting_links( $links ) {
        $amokit_settings_link = '<a href="admin.php?page=amokit-addons#/general">'.esc_html__( 'Settings', 'amokit-addons' ).'</a>';
        array_unshift( $links, $amokit_settings_link );
        if( !is_plugin_active('amokit-pro/amokit_pro.php') ){
            $links['amokitgo_pro'] = sprintf('<a href="https://nasdesigns.rf.gd/pricing/" target="_blank" style="color: #39b54a; font-weight: bold;">' . esc_html__('Go Pro','amokit-addons') . '</a>');
        }
        return $links; 
    }

    /**
     * [plugin_activate_hook] Plugin Activation Hook
     * @return [void]
     */
    public function plugin_activate_hook() {


        // save plugin activation time
        if ( false === get_option( 'amokit_elementor_addons_activation_time' ) ) {
            add_option( 'amokit_elementor_addons_activation_time', absint( intval( strtotime('now') ) ) );
        }
        // save plugin version
        if ( false === get_option( 'amokit_elementor_addons_version' ) ) {
            update_option('amokit_elementor_addons_version', AMONAKIT_VERSION );
        }

        add_option('amokit_do_activation_redirect', true);

    }

    /**
     * [plugin_redirect_option_page] After Install plugin then redirect setting page
     * @return [void]
     */
    public function plugin_redirect_option_page() {

        // save data for old user before version 1.4.5
        if ( false === get_option( 'amokit_elementor_addons_activation_time' ) ) {
            add_option( 'amokit_elementor_addons_activation_time', absint( intval( strtotime('now') ) ) );
        }
        // save plugin version
        if ( false === get_option( 'amokit_elementor_addons_version' ) ) {
            update_option('amokit_elementor_addons_version', AMONAKIT_VERSION );
        } 
        if ( get_option( 'amokit_do_activation_redirect', false ) ) {
            delete_option('amokit_do_activation_redirect');
            if( !isset( $_GET['activate-multi'] ) ){
                wp_redirect( admin_url("admin.php?page=amokit-addons_extensions") );
            }
        }
    }

    /**
     * [include_files] Required Necessary file
     * @return [void]
     */
    public function includes() {
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/helper-function.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/class.assests.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'admin/admin-init.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/widgets_control.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/class.amo-icon-manager.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'admin/include/custom-control/preset-manage.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'admin/include/custom-control/preset-select.php' );
        if('yes' === get_option('woocommerce_enable_ajax_add_to_cart')){
            require_once ( AMONAKIT_ADDONS_PL_PATH.'includes/class.single-product-ajax-addto-cart.php' );
        }

        // Admin Required File
        if( is_admin() ){

            // Post Duplicator
            if( amokit_get_option( 'postduplicator', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
                require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/class.post-duplicator.php' );
            }

            // Recommended plugins
            require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/recommended-plugins/class.recommended-plugins.php' );
            require_once ( AMONAKIT_ADDONS_PL_PATH . 'includes/recommended-plugins/recommended-plugins.php' );
            
        }

        // Extension Assest Management
        require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/class.enqueue_scripts.php' );

        // HT Builder
        if ( 'on' == amokit_get_module_option( 'amokit_themebuilder_module_settings','themebuilder','themebuilder_enable','off' ) ) {
            require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-builder/init.php' );

        } else {
            if ( amokit_get_option( 'themebuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' && empty ( amokit_get_module_option( 'amokit_themebuilder_module_settings') ) ){
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-builder/init.php' );
            }
        }
        // WC Sales Notification
        if( amokit_get_option( 'salenotification', 'amokit_advance_element_tabs', 'off' ) === 'on' && is_plugin_active('woocommerce/woocommerce.php') ){
            if( is_plugin_active('amokit-pro/amokit_pro.php') ){
                if( amokit_get_option( 'notification_content_type', 'amokitwcsales_setting_tabs', 'actual' ) == 'fakes' ){
                    require_once( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/wc-sales-notification/classes/class.sale_notification_fake.php' );
                }else{
                    require_once( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/wc-sales-notification/classes/class.sale_notification.php' );
                }
            }else{
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/wc-sales-notification/classes/class.sale_notification.php' );
            }
        }

        // AmonaKit Menu
        if ( 'on' == amokit_get_module_option( 'amokit_megamenu_module_settings','megamenubuilder','megamenubuilder_enable','off' ) ) {

            if ( is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) {
                require_once( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/amo-menu/classes/class.mega-menu.php' );
            } else {
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/classes/class.mega-menu.php' );
            }

        } else {

            if ( amokit_get_option( 'megamenubuilder', 'amokit_advance_element_tabs', 'off' ) === 'on' && empty ( amokit_get_module_option( 'amokit_megamenu_module_settings') ) ){
                if ( is_plugin_active( 'amokit-pro/amokit_pro.php' ) ) {
                    require_once( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/amo-menu/classes/class.mega-menu.php' );
                } else {
                    require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/classes/class.mega-menu.php' );
                }
            }
        }

        //Wrapper Link Module
        if( amokit_get_option( 'wrapperlink', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
            require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/wrapper-link/class.wrapper-link.php' );
        }
        //Reading progress bar Module
        $amokit_rpbar_module_settings = amokit_get_option( 'amokit_rpbar', 'amokit_rpbar_module_settings' );
        $amokit_rpbar_module_settings = json_decode( $amokit_rpbar_module_settings,true );

        if( ! empty ( $amokit_rpbar_module_settings['rpbar_enable'] ) ) {

            if( 'on' == $amokit_rpbar_module_settings['rpbar_enable'] ) {
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/reading-progress-bar/class.reading-progress-bar.php' );
            }

        } else {
            
            if  (  amokit_get_option( 'amokit_rpbar', 'amokit_advance_element_tabs', 'off' ) === 'on' ){
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/reading-progress-bar/class.reading-progress-bar.php' );
            }
        }
        //Scroll To Top Module
        $amokit_stt_module_settings = amokit_get_option( 'amokit_stt', 'amokit_stt_module_settings' );
        $amokit_stt_module_settings = json_decode( $amokit_stt_module_settings, true );

        if( ! empty ( $amokit_stt_module_settings['stt_enable'] ) && 'on' == $amokit_stt_module_settings['stt_enable'] ) {
            require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/scroll-to-top/class.scroll-to-top.php' );
        }
        // Floating Effects Module
        if( amokit_get_option( 'floating_effects', 'amokit_advance_element_tabs', 'off' ) === 'on' ){

            if( is_plugin_active('amokit-pro/amokit_pro.php')  && file_exists( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/floating-effects/class.floating-effects.php' )){
                require_once( AMONAKIT_ADDONS_PL_PATH_PRO . 'extensions/floating-effects/class.floating-effects.php' );
            }else{
                require_once( AMONAKIT_ADDONS_PL_PATH . 'extensions/floating-effects/class.floating-effects.php' );
            }
            
        }
    }
    
   /**
     * [amokit_plugin_row_meta] Plugin row meta
     * @return [links] plugin action link
     */
    public function amokit_plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
    
        if ( $plugin_file === AMONAKIT_ADDONS_PLUGIN_BASE ) {
            $new_links = array(
                'docs'          => '<a href="https://nasdesigns.rf.gd/docs/" target="_blank"><span class="dashicons dashicons-search"></span>' . esc_html__( 'Documentation', 'amokit-addons' ) . '</a>',
                'facebookgroup' => '<a href="https://www.facebook.com/groups/woolentor" target="_blank"><span class="dashicons dashicons-facebook" style="font-size:14px;line-height:1.3"></span>' . esc_html__( 'Facebook Group', 'amokit-addons' ) . '</a>',
                'rateus'        => '<a href="https://wordpress.org/support/plugin/amo-kit-for-elementor/reviews/?filter=5#new-post" target="_blank"><span class="dashicons dashicons-star-filled" style="font-size:14px;line-height:1.3"></span>' . esc_html__( 'Rate the plugin', 'amokit-addons' ) . '</a>',

                );
            
            $plugin_meta = array_merge( $plugin_meta, $new_links );
        }
        
        return $plugin_meta;
    }
}

/**
 * Initializes the main plugin
 *
 * @return \AmoKit_Addons_Elementor
 */
function amokit() {
    return AmoKit_Addons_Elementor::instance();
}
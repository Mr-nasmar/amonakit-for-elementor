<?php 

class AmoKitMenu_Elementor {

    private static $_instance = null;
    protected $mode;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'init', [ $this, 'init' ] );

        add_action( 'wp_ajax_AmoKit_Menu_Panels_ajax_requests', [ $this, 'panel_ajax_requests' ] );
    }

    /**
     * [setMode]
     */
    protected function setMode() {
        if ( is_admin() ) {
            $this->mode = 'admin';
        } else {
            $this->mode = 'frontend';
        }
    }

    public function init() {

        // Set current mode
        $this->setMode();

        // Plugins Required File
        $this->includes();

         if( $this->mode === 'admin' ) {
            // If the user can manage options, let the fun begin!
            if ( current_user_can( 'manage_options' ) ) {
                add_action( 'admin_init', [ $this, 'register_nav_meta_box' ], 9 );
            }
        }

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        // Add Plugin actions
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

        // Admin Scripts
        add_action('admin_enqueue_scripts', array( $this, 'amokit_megamenu_admin_scripts_method' ) );
        add_action( 'admin_footer', array( $this, 'amokit_menu_pop_up_content' ) );

        // Frontend Scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'amokit_menu_styles_inline' ) );

    }



    // Add custom category.
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'amokitmenu-addons',
            [
                'title' => esc_html__( 'amokit Menu', 'amokit-addons' ),
                'icon' => 'fa fa-snowflake-o',
            ]
        );
    }

    // Register Widgets
    public function init_widgets() {
       // Include files
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/widgets/inline-mega-menu.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/widgets/verticle-mega-menu.php' );
    }

    // Meta Box Field render
    public function register_nav_meta_box() {
        global $pagenow;
        if ( 'nav-menus.php' == $pagenow ) {
            add_meta_box(
                'AmoKit__Menu_meta_box',
                esc_html__('Mega Menu Settings', 'amokit-addons'),
                array( $this, 'metabox_contents' ),
                'nav-menus',
                'side',
                'core'
            );
        }
    }

    public function metabox_contents(){
        // Get recently edited nav menu.
        $recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );
        $nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? absint( $_REQUEST['menu'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ( empty( $recently_edited ) && is_nav_menu( $nav_menu_selected_id ) )
            $recently_edited = $nav_menu_selected_id;
        
        // Use $recently_edited if none are selected.
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ( empty( $nav_menu_selected_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) ) 
            $nav_menu_selected_id = $recently_edited;
        
        $options = get_option( "ht_menu_options_" . $nav_menu_selected_id );

    ?>
        <div id="amokitmenu-menu-metabox">

            <?php wp_nonce_field( basename( __FILE__ ), 'amokitmenu_menu_metabox_noce' ); ?>
            <input type="hidden" value="<?php echo esc_attr( $nav_menu_selected_id ); ?>" id="amokitmenu-metabox-input-menu-id" />
            <p>
                <label><strong><?php esc_html_e( "Enable megamenu?", 'amokit-addons' ); ?></strong></label>
                <input type="checkbox" class="alignright pull-right-input" id="amokitmenu-menu-metabox-input-is-enabled" <?php echo isset($options['enable_menu']) && $options['enable_menu'] == 'on' ? 'checked="true"' : '' ?>>
            </p>
            <p>
                <?php echo get_submit_button( esc_html__('Save', 'amokit-addons' ), 'amokitmenu-menu-settings-save button-primary alignright','', false); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <span class='spinner'></span>
            </p>

        </div>

    <?php
    }

    public function panel_ajax_requests(){
        if ( ! check_ajax_referer( 'amokit_menu_nonce', 'nonce' ) ) {
            wp_send_json_error();
        }
        $action = isset( $_POST['sub_action'] ) ? $_POST['sub_action'] : '';
        
        if( $action === 'save_menu_settings' ){



            $form_data = ( !empty( $_POST['settings'] ) ?  sanitize_text_field( $_POST['settings'] ) : '' );

            if( !empty( $form_data ) ) {
                parse_str( $form_data, $data );
            } else {
                return;
            }

            $menu_item_id = absint( $_POST['menu_item_id'] );

            update_post_meta( $menu_item_id, 'amokit_menu_settings', $data );

            wp_send_json_success([
                'message' => esc_html__( 'Successfully data saved','amokit-addons' )
            ]);

        }
        
        else if( $action === 'save_menu_options' ){

            if ( ! check_ajax_referer( 'amokit_menu_nonce', 'nonce' ) ) {
                wp_send_json_error();
            }

            $settings = isset( $_POST['settings'] ) ? $_POST['settings'] : array();
            $menu_id = absint( $_POST['menu_id'] );
            update_option( 'ht_menu_options_' . $menu_id, $settings );
            wp_die();
        }

        else{
            $menu_item_id = absint( $_REQUEST['menu_item_id'] );

            $menu_data = !empty( get_post_meta( $menu_item_id, 'amokit_menu_settings', true ) ) ? get_post_meta( $menu_item_id, 'amokit_menu_settings', true ) : '';

            if( empty( $menu_data ) ){
                $menu_data = [
                    'menu-item-menuwidth-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_menuwidth', true ),
                    'menu-item-menuposition-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_menuposition', true ),
                    'menu-item-template-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_template', true ),
                    'menu-item-ficon-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_ficon', true ),
                    'menu-item-ficoncolor-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_ficoncolor', true ),
                    'menu-item-menutag-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_menutag', true ),
                    'menu-item-menutagcolor-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_menutagcolor', true ),
                    'menu-item-menutagbgcolor-'.$menu_item_id => get_post_meta( $menu_item_id, '_menu_item_menutagbgcolor', true ),
                ];
            }else{
              $menu_data['menu-item-ficon-'.$menu_item_id] = '';  
              $menu_data['menu-item-ficoncolor-'.$menu_item_id] = '';  
              $menu_data['menu-item-menutag-'.$menu_item_id] = '';  
              $menu_data['menu-item-menutagcolor-'.$menu_item_id] = '';  
              $menu_data['menu-item-menutagbgcolor-'.$menu_item_id] = '';  
            }

            wp_send_json_success( array(
                'content'   => $menu_data,
                'temp_list' => amokit_menu_elementor_template(),
            ) );
        }
    }

    public function includes() {
        // Include files
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/menu/amomenu_menu.php' );
        require_once ( AMONAKIT_ADDONS_PL_PATH . 'extensions/amo-menu/menu/helper_function.php' );
    }

    // enqueue frontend scripts
    public function enqueue_frontend_scripts(){
        
        // CSS File
        wp_enqueue_style( 'font-awesome-5-all', ELEMENTOR_ASSETS_URL . '/lib/font-awesome/css/all.min.css' );
        wp_enqueue_style(  'amokit-menu',  AMONAKIT_ADDONS_PL_URL . 'assets/extensions/amo-menu/css/mega-menu-style.css', array(), AMONAKIT_VERSION );

        // JS File
        wp_enqueue_script( 'amokitmenu-main', AMONAKIT_ADDONS_PL_URL . 'assets/extensions/amo-menu/js/amokitmenu-main.js', array('jquery') );

    }

    public function amokit_megamenu_admin_scripts_method($hook){

        if( 'nav-menus.php' === $hook ){

            wp_enqueue_script('fonticonpicker.js', AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/js/jquery.fonticonpicker.min.js',
                array('jquery'));

            wp_enqueue_script( 'amokitmenu-admin', AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/js/admin_updated_scripts.js', array('jquery','jquery-ui-dialog'), AMONAKIT_VERSION, TRUE );

            wp_enqueue_style( 'fonticonpicker', AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/css/jquery.fonticonpicker.min.css' );
            
            wp_enqueue_style( 'fonticonpicker-bootstrap', AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/css/jquery.fonticonpicker.bootstrap.min.css');
            wp_enqueue_style ('wp-jquery-ui-dialog');
            wp_enqueue_style( 'amokitmenu-admin', AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/css/admin.css' );

            wp_localize_script(
                'amokitmenu-admin', 
                'amokitMENU',
                [
                    'nonce'    => wp_create_nonce( 'amokit_menu_nonce' ),
                    'iconlist' => $this->amokit_menu_get_icon_sets(),
                    'button'   => [
                        'text'       => esc_html__( 'Save', 'amokit-addons' ),
                        'lodingtext' => esc_html__( 'Saving…', 'amokit-addons' ),
                        'successtext'=> esc_html__( 'All Data Saved', 'amokit-addons' ),
                    ],
                ]
            );
        }
        
    }

    public function amokit_menu_get_icon_sets(){
        $icon_set = array();
        $icon_set['FontAwesome'][] = 'Pro';
    }

    public function amokit_menu_pop_up_content(){
        require_once ( AMONAKIT_ADDONS_PL_PATH.'extensions/amo-menu/menu/templates.php' );
        ob_start();
        ?>
            <div id="amokitpro-dialog" title="<?php echo esc_attr( 'Go Premium' ); ?>" style="display: none;">
                <div class="amo-dialog-content">
                    <span><i class="dashicons dashicons-warning"></i></span>
                    <p>
                        <?php
                            echo esc_html__('Purchase our','amokit-addons').' <strong><a href="'.esc_url( 'https://nasdesigns.rf.gd/pricing/' ).'" target="_blank" rel="nofollow">'.esc_html__( 'premium version', 'amokit-addons' ).'</a></strong> '.esc_html__('to unlock these pro options!','amokit-addons');
                        ?>
                    </p>
                </div>
            </div>
        <?php
        echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
    * Add Inline CSS.
    */
    public function amokit_menu_styles_inline() {

        $menu_item_color = $menu_item_hover_color = $sub_menu_width = $sub_menu_bg = $sub_menu_itemcolor = $sub_menu_itemhover_color = $mega_menu_width = $mega_menu_bg = '';

        //$menuitemscolor         = amokit_get_option( 'menu_items_color', 'amokitmenu_setting_tabs' );
        $menuitemscolor         = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'menu_items_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'menu_items_color') : amokit_get_option( 'menu_items_color', 'amokitmenu_setting_tabs' );

        $menuitemshovercolor    = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'menu_items_hover_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'menu_items_hover_color') : amokit_get_option( 'menu_items_hover_color', 'amokitmenu_setting_tabs' );

        $submenuwidth           = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_width') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_width') : amokit_get_option( 'sub_menu_width', 'amokitmenu_setting_tabs' );

        $submenubg              = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_bg_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_bg_color') : amokit_get_option( 'sub_menu_bg_color', 'amokitmenu_setting_tabs' );

        $submenuitemcolor       = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_items_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_items_color') : amokit_get_option( 'sub_menu_items_color', 'amokitmenu_setting_tabs' );

        $submenuitemhovercolor  = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_items_hover_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'sub_menu_items_hover_color') : amokit_get_option( 'sub_menu_items_hover_color', 'amokitmenu_setting_tabs' );
        
        $megamenuwidth          = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'mega_menu_width') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'mega_menu_width') : amokit_get_option( 'mega_menu_width', 'amokitmenu_setting_tabs' );

        $megamenubg             = amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'mega_menu_bg_color') ? amokit_get_module_option( 'amokit_megamenu_module_settings', 'megamenubuilder', 'mega_menu_bg_color') : amokit_get_option( 'mega_menu_bg_color', 'amokitmenu_setting_tabs' );

        if( $menuitemscolor && !empty($menuitemscolor) ){
            $menu_item_color = "
                .amo-menu-container ul > li > a{
                    color: {$menuitemscolor};
                }
            ";
        }

        if( $menuitemshovercolor && !empty($menuitemshovercolor) ){
            $menu_item_hover_color = "
                .amo-menu-container ul > li:hover > a {
                    color: {$menuitemshovercolor};
                }
            ";
        }

        if( $submenuwidth && !empty($submenuwidth) ){
            $sub_menu_width = "
                .amo-menu-container .sub-menu{
                    width: {$submenuwidth}px;
                }
            ";
        }

        if( $submenubg && !empty($submenubg) ){
            $sub_menu_bg = "
                .amo-menu-container .sub-menu{
                    background-color: {$submenubg};
                }
            ";
        }

        if( $submenuitemcolor && !empty($submenuitemcolor) ){
            $sub_menu_itemcolor = "
                .amo-menu-container .sub-menu li a{
                    color: {$submenuitemcolor};
                }
            ";
        }

        if( $submenuitemhovercolor && !empty($submenuitemhovercolor) ){
            $sub_menu_itemhover_color = "
                .amo-menu-container .sub-menu li:hover > a {
                    color: {$submenuitemhovercolor};
                }
            ";
        }

        if( $megamenuwidth && !empty($megamenuwidth) ){
            $mega_menu_width = "
                .amo-menu-container .amomenu-content-wrapper{
                    width: {$megamenuwidth}px;
                }
            ";
        }

        if( $megamenubg && !empty($megamenubg) ){
            $mega_menu_bg = "
                .amo-menu-container .amomenu-content-wrapper{
                    background-color: {$megamenubg};
                }
            ";
        }

        $custom_css = "
            $menu_item_color
            $menu_item_hover_color
            $sub_menu_width
            $sub_menu_bg
            $sub_menu_itemcolor
            $sub_menu_itemhover_color
            $mega_menu_width
            $mega_menu_bg
            ";
        wp_add_inline_style( 'amokit-menu', $custom_css );
    }


}

AmoKitMenu_Elementor::instance();
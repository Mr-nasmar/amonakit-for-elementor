<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class AmoKitWcsale_Admin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new AmoKit_Settings_API();
        add_action( 'admin_init', [ $this, 'admin_init' ] );
        add_action( 'admin_menu', [ $this, 'admin_menu' ], 224 );

        add_action( 'wsa_form_bottom_amokitwcsales_setting_tabs', [ $this, 'popup_box' ] );
    }

    // Admin Initialize
    function admin_init() {

        // //set the settings
        $this->settings_api->set_sections( $this->admin_get_settings_sections() );
        $this->settings_api->set_fields( $this->admin_fields_settings() );

        // //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {

        add_submenu_page(
            'amokit-addons', 
            esc_html__( 'Sales Notification', 'amokit-addons' ),
            esc_html__( 'Sales Notification', 'amokit-addons' ), 
            'manage_options', 
            'amokitnotification', 
            array ( $this, 'plugin_page' ) 
        );

    }

    // Options page Section register
    function admin_get_settings_sections() {
        $sections = array(

            array(
                'id'    => 'amokitwcsales_setting_tabs',
                'title' => esc_html__( 'Sale Notification Settings', 'amokit-addons' )
            ),

        );
        return $sections;
    }

    // Options page field register
    protected function admin_fields_settings() {

        $settings_fields = array(
            
            'amokitwcsales_setting_tabs' => array(
                
                array(
                    'name'    => 'notification_content_typep',
                    'label'   => __( 'Notification Content Type', 'amokit-addons' ),
                    'desc'    => __( 'Select Content Type <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'radio',
                    'default' => 'actual',
                    'options' => array(
                        'actual' => __('Real','amokit-addons'),
                        'fakes'  => __('Fakes','amokit-addons'),
                    ),
                    'class'=>'amokitpro',
                ),

                array(
                    'name'    => 'notification_posp',
                    'label'   => __( 'Position', 'amokit-addons' ),
                    'desc'    => __( 'Sale Notification Position on frontend.( Top Left, Top Right, Bottom Right option are pro features ) <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => 'bottomleft',
                    'options' => array(
                        'bottomleft'    =>__( 'Bottom Left','amokit-addons' ),
                    ),
                    'class'=>'amokitpro',
                ),

                array(
                    'name'    => 'notification_layoutp',
                    'label'   => __( 'Image Position', 'amokit-addons' ),
                    'desc'    => __( 'Notification Layout. <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => 'imageleft',
                    'options' => array(
                        'imageleft'       =>__( 'Image Left','amokit-addons' ),
                    ),
                    'class'       => 'notification_real amokitpro'
                ),

                array(
                    'name'              => 'notification_limit',
                    'label'             => __( 'Limit', 'amokit-addons' ),
                    'desc'              => __( 'Order Limit for notification.', 'amokit-addons' ),
                    'min'               => 1,
                    'max'               => 100,
                    'default'           => '5',
                    'step'              => '1',
                    'type'              => 'number',
                    'sanitize_callback' => 'number',
                    'class'       => 'notification_real',
                ),

                array(
                    'name'    => 'notification_loadduration',
                    'label'   => __( 'Loading Time', 'amokit-addons' ),
                    'desc'    => __( 'Notification Loading duration.', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => '3',
                    'options' => array(
                        '2'       =>__( '2 seconds','amokit-addons' ),
                        '3'       =>__( '3 seconds','amokit-addons' ),
                        '4'       =>__( '4 seconds','amokit-addons' ),
                        '5'       =>__( '5 seconds','amokit-addons' ),
                        '6'       =>__( '6 seconds','amokit-addons' ),
                        '7'       =>__( '7 seconds','amokit-addons' ),
                        '8'       =>__( '8 seconds','amokit-addons' ),
                        '9'       =>__( '9 seconds','amokit-addons' ),
                        '10'       =>__( '10 seconds','amokit-addons' ),
                        '20'       =>__( '20 seconds','amokit-addons' ),
                        '30'       =>__( '30 seconds','amokit-addons' ),
                        '40'       =>__( '40 seconds','amokit-addons' ),
                        '50'       =>__( '50 seconds','amokit-addons' ),
                        '60'       =>__( '1 minute','amokit-addons' ),
                        '90'       =>__( '1.5 minutes','amokit-addons' ),
                        '120'       =>__( '2 minutes','amokit-addons' ),
                    ),
                ),

                array(
                    'name'    => 'notification_time_intp',
                    'label'   => __( 'Time Interval', 'amokit-addons' ),
                    'desc'    => __( 'Time between notifications. <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => '4',
                    'options' => array(
                        '4'       =>__( '4 seconds','amokit-addons' ),
                    ),
                    'class' => 'amokitpro',
                ),

                array(
                    'name'    => 'notification_uptodatep',
                    'label'   => __( 'Order Upto', 'amokit-addons' ),
                    'desc'    => __( 'Do not show purchases older than.( More Options are Pro features ) <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => '7',
                    'options' => array(
                        '7'   =>__( '1 week','amokit-addons' ),
                    ),
                    'class'   => 'notification_real amokitpro',
                ),

                array(
                    'name'    => 'notification_inanimationp',
                    'label'   => __( 'Animation In', 'amokit-addons' ),
                    'desc'    => __( 'Notification Enter Animation. <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => 'fadeInLeft',
                    'options' => array(
                        'fadeInLeft'  =>__( 'fadeInLeft','amokit-addons' ),
                    ),
                    'class' => 'amokitpro',
                ),

                array(
                    'name'    => 'notification_outanimationp',
                    'label'   => __( 'Animation Out', 'amokit-addons' ),
                    'desc'    => __( 'Notification Out Animation. <span>( Pro )</span>', 'amokit-addons' ),
                    'type'    => 'select',
                    'default' => 'fadeOutRight',
                    'options' => array(
                        'fadeOutRight'  =>__( 'fadeOutRight','amokit-addons' ),
                    ),
                    'class' => 'amokitpro',
                ),
                
                array(
                    'name'  => 'background_colorp',
                    'label' => __( 'Background Color', 'amokit-addons' ),
                    'desc' => wp_kses_post( 'Notification Background Color. <span>( Pro )</span>', 'amokit-addons' ),
                    'type' => 'color',
                    'class'=> 'notification_real amokitpro',
                ),

                array(
                    'name'  => 'heading_colorp',
                    'label' => __( 'Heading Color', 'amokit-addons' ),
                    'desc' => wp_kses_post( 'Notification Heading Color. <span>( Pro )</span>', 'amokit-addons' ),
                    'type' => 'color',
                    'class'       => 'notification_real amokitpro',
                ),

                array(
                    'name'  => 'content_colorp',
                    'label' => __( 'Content Color', 'amokit-addons' ),
                    'desc' => wp_kses_post( 'Notification Content Color. <span>( Pro )</span>', 'amokit-addons' ),
                    'type' => 'color',
                    'class'=> 'notification_real amokitpro',
                ),

                array(
                    'name'  => 'cross_colorp',
                    'label' => __( 'Cross Icon Color', 'amokit-addons' ),
                    'desc' => wp_kses_post( 'Notification Cross Icon Color. <span>( Pro )</span>', 'amokit-addons' ),
                    'type' => 'color',
                    'class'=> 'amokitpro',
                ),

            ),


        );
        
        return array_merge( $settings_fields );
    }

    // Pop up Box
    function popup_box(){
        ob_start();
        ?>
            <div id="amokit-dialog" title="<?php echo esc_attr( 'Go Premium' ); ?>" style="display: none;">
                <div class="amo-content">
                    <span><i class="dashicons dashicons-warning"></i></span>
                    <p>
                        <?php
                            echo esc_html__('Purchase our','amokit-addons').' <strong><a href="'.esc_url( 'https://nasdesigns.rf.gd/pricing/' ).'" target="_blank" rel="nofollow">'.esc_html__( 'premium version', 'amokit-addons' ).'</a></strong> '.esc_html__('to unlock these pro elements!','amokit-addons');
                        ?>
                    </p>
                </div>
            </div>
            <script type="text/javascript">
                ( function( $ ) {
                    
                    $(function() {
                        $( '.amo_table_row.pro,.amopro label' ).click(function() {
                            $( "#amokit-dialog" ).dialog({
                                modal: true,
                                minWidth: 500,
                                buttons: {
                                    Ok: function() {
                                      $( this ).dialog( "close" );
                                    }
                                }
                            });
                        });
                        $(".amo_table_row.pro input[type='checkbox'],.amopro select,.amopro input[type='radio']").attr("disabled", true);
                    });

                } )( jQuery );
            </script>
        <?php
        echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    // Admin Menu Page Render
    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'WC Sales Notification Settings','amokit-addons' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    // Save Options Message
    function save_message() {
        if( isset($_GET['settings-updated']) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'amokit-addons') ?></strong></p>
            </div>
            <?php
        }
    }


}

new AmoKitWcsale_Admin_Settings();
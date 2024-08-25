<?php
/**
 * Constructor Parameters
 *
 * @param string    $text_domain your plugin text domain.
 * @param string    $parent_menu_slug the menu slug name where the "Recommendations" submenu will appear.
 * @param string    $submenu_label To change the submenu name.
 * @param string    $submenu_page_name an unique page name for the submenu.
 * @param int       $priority Submenu priority adjust.
 * @param string    $hook_suffix use it to load this library assets only to the recommedded plugins page. Not into the whol admin area.
 *
 */

if( class_exists('Nasdesigns\AmoKit_Builder\HTRP_Recommended_Plugins') ){
    $recommendations = new Nasdesigns\AmoKit_Builder\HTRP_Recommended_Plugins(
        array( 
            'text_domain'       => 'amokit-addons',
            'parent_menu_slug'  => 'amokit-addons', 
            'menu_capability'   => 'manage_options', 
            'menu_page_slug'    => '',
            'priority'          => 300,
            'assets_url'        => '',
            'hook_suffix'       => 'amokit-addons_page_amokit-addons_extensions',
        )
    );

    $recommendations->add_new_tab(array(
        'title' => __( 'Recommended Plugins', 'amokit-addons' ),
        'active' => true,
        'plugins' => array(
            array(
                'slug'      => 'woolentor-addons',
                'location'  => 'woolentor_addons_elementor.php',
                'name'      => __( 'ShopLentor – WooCommerce Builder for Elementor & Gutenberg +10 Modules – All in One Solution (formerly WooLentor)
                ', 'amokit-addons' )
            ),
            array(
                'slug'      => 'hashbar-wp-notification-bar',
                'location'  => 'init.php',
                'name'      => __( 'Notification Bar for WordPress', 'amokit-addons' )
            ),
            array(
                'slug'      => 'insert-headers-and-footers-script',
                'location'  => 'init.php',
                'name'      => __( 'Insert Headers and Footers Code', 'amokit-addons' )
            )
            
        )
    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'WooCommerce', 'amokit-addons' ),

        'plugins' => array(

            array(
                'slug'      => 'woolentor-addons',
                'location'  => 'woolentor_addons_elementor.php',
                'name'      => __( 'WooLentor – WooCommerce Elementor Addons + Builder', 'amokit-addons' )
            ),
            array(
                'slug'      => 'wishsuite',
                'location'  => 'wishsuite.php',
                'name'      => __( 'WishSuite', 'amokit-addons' )
            ),
            array(
                'slug'      => 'ever-compare',
                'location'  => 'ever-compare.php',
                'name'      => __( 'EverCompare', 'amokit-addons' )
            ),
            array(
                'slug'      => 'quickswish',
                'location'  => 'quickswish.php',
                'name'      => __( 'QuickSwish', 'amokit-addons' )
            ),
            array(
                'slug'      => 'just-tables',
                'location'  => 'just-tables.php',
                'name'      => __( 'JustTables', 'amokit-addons' )
            ),
            array(
                'slug'      => 'whols',
                'location'  => 'whols.php',
                'name'      => __( 'Whols', 'amokit-addons' )
            ),

        )

    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'Other Plugins', 'amokit-addons' ),
        'plugins' => array(
            array(
                'slug'      => 'wp-plugin-manager',
                'location'  => 'plugin-main.php',
                'name'      => __( 'WP Plugin Manager', 'amokit-addons' )
            ),
            array(
                'slug'      => 'ht-easy-google-analytics',
                'location'  => 'ht-easy-google-analytics.php',
                'name'      => __( 'HT Easy GA4 ( Google Analytics 4 )', 'amokit-addons' )
            ),
            array(
                'slug'      => 'ht-contactform',
                'location'  => 'contact-form-widget-elementor.php',
                'name'      => __( 'HT Contact Form 7', 'amokit-addons' )
            ),
            array(
                'slug'      => 'ht-wpform',
                'location'  => 'wpform-widget-elementor.php',
                'name'      => __( 'HT WPForms', 'amokit-addons' )
            ),
            array(
                'slug'      => 'docus',
                'location'  => 'docus.php',
                'name'      => __( 'Docus', 'amokit-addons' )
            ),
            array(
                'slug'      => 'data-captia',
                'location'  => 'data-captia.php',
                'name'      => __( 'DataCaptia', 'amokit-addons' )
            )

        )
    ));
}

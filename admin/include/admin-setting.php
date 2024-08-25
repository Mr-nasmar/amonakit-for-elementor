<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

require_once( AMONAKIT_ADDONS_PL_PATH.'admin/include/settings-panel/settings-panel.php' );

class AmoKit_Admin_Settings {

    function __construct() {
        AmoKitOpt_Base::init();
    }


}

new AmoKit_Admin_Settings();
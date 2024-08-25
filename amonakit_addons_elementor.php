<?php
/**
 * Plugin Name: Amonakit – Addons for Elementor.
 * Description: Amona Kit is a elementor addons package for Elementor page builder plugin for WordPress.
 * Plugin URI: 	https://nasdesigns.rf.gd/
 * Author: 		NasDesignes
 * Author URI: 	https://nasdesigns.rf.gd/
 * Version: 	1.0.1
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: amonakit-addons
 * Domain Path: /languages
 * Elementor tested up to: 3.23.4
 * Elementor Pro tested up to: 3.23.3
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'AMONAKIT_VERSION', '1.0.1' );
define( 'AMONAKIT_ADDONS_PL_ROOT', __FILE__ );
define( 'AMONAKIT_ADDONS_PL_URL', plugins_url( '/', AMONAKIT_ADDONS_PL_ROOT ) );
define( 'AMONAKIT_ADDONS_PL_PATH', plugin_dir_path( AMONAKIT_ADDONS_PL_ROOT ) );
define( 'AMONAKIT_ADDONS_PLUGIN_BASE', plugin_basename( AMONAKIT_ADDONS_PL_ROOT ) );


/**
 * Gutenberg Blocks
 */
require_once ( AMONAKIT_ADDONS_PL_PATH.'amokit-blocks/amokit-blocks.php' );

// Required File
require_once ( AMONAKIT_ADDONS_PL_PATH .'includes/class.amokit.php' );

amokit();
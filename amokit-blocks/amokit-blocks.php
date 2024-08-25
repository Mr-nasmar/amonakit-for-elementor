<?php
if ( ! class_exists( 'AmoKitBlocks' ) ) :

	define( 'AMOKIT_BLOCK_FILE', __FILE__ );
	define( 'amokit_BLOCK_PATH', __DIR__ );
	define( 'AMOKIT_BLOCK_URL', plugins_url( '/', AMOKIT_BLOCK_FILE ) );
	define( 'AMOKIT_BLOCK_DIR', plugin_dir_path( AMOKIT_BLOCK_FILE ) );
	define( 'AMOKIT_BLOCK_ASSETS', AMOKIT_BLOCK_URL . '/assets' );
	define( 'AMOKIT_BLOCK_TEMPLATE', trailingslashit( AMOKIT_BLOCK_DIR . 'includes/templates' ) );

	/**
	 * Main AmoKitBlocks Class
	 */
	final class AmoKitBlocks{

		/**
		 * [$_instance]
		 * @var null
		 */
		private static $_instance = null;

		/**
		 * [instance] Initializes a singleton instance
		 * @return [Actions]
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * The Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Initialize
		 */
		public function init(){
			$this->dependency_class_instance();
		}

		/**
		 * Load required file
		 *
		 * @return void
		 */
		private function includes() {
			include( AMOKIT_BLOCK_PATH . '/vendor/autoload.php' );
		}

		/**
		 * Load dependency class
		 *
		 * @return void
		 */
		private function dependency_class_instance() {
			AmoKitBlocks\Scripts::instance();
			AmoKitBlocks\Manage_Styles::instance();
			AmoKitBlocks\Actions::instance();
			AmoKitBlocks\Blocks_init::instance();
		}


	}
	
endif;

/**
 * The main function for that returns amokitblocks
 *
 */
function amokitblocks() {
	if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}elseif( class_exists( 'Classic_Editor' ) ){
		return;
	}else{
		return AmoKitBlocks::instance();
	}
}
amokitblocks();

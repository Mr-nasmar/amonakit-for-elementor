<?php
namespace AmoKitBlocks;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Blocks Assets Manage
 */
class Scripts
{

	/**
	 * [$_instance]
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * [instance] Initializes a singleton instance
	 * @return [Scripts]
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * The Constructor.
	 */
	public function __construct()
	{
		add_action('enqueue_block_assets', [$this, 'block_assets']);
		add_action('enqueue_block_editor_assets', [$this, 'block_editor_assets']);
	}

	/**
	 * Block assets.
	 */
	public function block_assets()
	{

		if ( ! has_blocks( get_queried_object_id() ) ) {
			return;
		}
		wp_enqueue_style('dashicons');
		wp_enqueue_style(
			'amokit-block-common-style',
			AMOKIT_BLOCK_URL . 'src/assets/css/common-style.css',
			[],
			AMONAKIT_VERSION
		);
		wp_enqueue_style(
			'slick',
			AMONAKIT_ADDONS_PL_URL . 'assets/css/slick.min.css',
			[],
			AMONAKIT_VERSION
		);
		wp_enqueue_style(
			'amokit-block-fontawesome',
			AMONAKIT_ADDONS_PL_URL . 'admin/assets/extensions/amo-menu/css/font-awesome.min.css',
			[],
			AMONAKIT_VERSION
		);
		wp_enqueue_style(
			'amokit-block-style',
			AMOKIT_BLOCK_URL . 'build/style-blocks-amokit.css',
			[],
			AMONAKIT_VERSION,
			'all'
		);

		wp_enqueue_script(
			'slick',
			AMONAKIT_ADDONS_PL_URL . 'assets/js/slick.min.js',
			['jquery'],
			AMONAKIT_VERSION,
			true
		);
		wp_enqueue_script(
			'amokit-block-main',
			AMOKIT_BLOCK_URL . 'src/assets/js/script.js',
			['slick'],
			AMONAKIT_VERSION,
			true
		);

	}

	/**
	 * Block editor assets.
	 */
	public function block_editor_assets()
	{

		global $pagenow;

		if ($pagenow !== 'widgets.php') {

			wp_enqueue_style('slick');
			wp_enqueue_style(
				'amokit-block-editor-style',
				AMOKIT_BLOCK_URL . 'src/assets/css/editor-style.css',
				[],
				AMONAKIT_VERSION,
				'all'
			);

			$dependencies = require_once(AMOKIT_BLOCK_PATH . '/build/blocks-amokit.asset.php');
			wp_enqueue_script(
				'amokit-blocks',
				AMOKIT_BLOCK_URL . 'build/blocks-amokit.js',
				$dependencies['dependencies'],
				AMONAKIT_VERSION,
				true
			);

			/**
			 * Localize data
			 */
			$editor_localize_data = array(
				'url' => AMOKIT_BLOCK_URL,
				'ajax' => admin_url('admin-ajax.php'),
				'security' => wp_create_nonce('amokit-block-nonce'),
				'locale' => get_locale(),
				'options' => $this->get_block_list()['block_list']
			);

			wp_localize_script('amokit-blocks', 'amokitData', $editor_localize_data);
		}

	}

	/**
	 * Manage block based on template type
	 */
	public function get_block_list()
	{

		$blocks_list = Blocks_init::$blocksList;

		$common_block = array_key_exists('common', $blocks_list) ? $blocks_list['common'] : [];

		return array(
			'block_list' => $common_block
		);
	}

}
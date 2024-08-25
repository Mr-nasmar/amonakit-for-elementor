<?php
namespace AmoKitBlocks;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manage Block CSS
 */
class Manage_Styles {

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Manage_Styles]
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
		if( ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) ){
			$this->manage_block_css();
		}
	}

	/**
	 * Resgister API routes
	 */
	public function register_routes( $namespace ){

		register_rest_route( $namespace, 'get_post',
			[
				[
					'methods'  => 'POST',
					'callback' => [ $this, 'get_post_data' ],
					'permission_callback' => [ $this, 'permission_check' ],
					'args' => []
				]
			]
		);

		register_rest_route( $namespace, 'save_css',
			[
				[
					'methods'  => 'POST', 
					'callback' => [ $this, 'save_block_css' ],
					'permission_callback' => [ $this, 'permission_check' ],
					'args' => []
				]
			]
		);

		register_rest_route( $namespace, 'appened_css',
			[
				[
					'methods'  => 'POST',
					'callback' => [ $this, 'appened_css' ],
					'permission_callback' => [ $this, 'permission_check' ],
					'args' => []
				]
			]
		);

	}

	/**
     * Api permission check
     */
    public function permission_check() {
        if( current_user_can( 'edit_posts' ) ){
            return true;
        }else{
            return false;
        }
    }

	/**
	 * Get Post data From API request
	 */
	public function get_post_data( $request ) {
		$params = $request->get_params();
		if ( isset( $params['post_id'] ) ) {
			return [
				'success' => true, 
				'data' 	  => get_post( $params['post_id'] )->post_content, 
				'message' => __('Post Data found.', 'amokit-addons' )
			];
		} else {
			return [
				'success' => false, 
				'message' => __('Post Data not found.', 'amokit-addons' )
			];
		}
	}

	/**
	 * Save Block CSS
	 */
	public function save_block_css( $request ){
		try{
			global $wp_filesystem;
			if ( ! $wp_filesystem ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			$params 	= $request->get_params();
			$post_id 	= sanitize_text_field( $params['post_id'] );
			
			if ( $post_id == 'amokit-widget' && $params['has_block'] ) {
				update_option( $post_id, $params['block_css'] );
				return [
					'success' => true, 
					'message' => __('Widget CSS Saved.', 'amokit-addons')
				];
			}

			$filename 		= "amokit-css-{$post_id}.css";
			$upload_dir_url = wp_upload_dir();
			$dirname 		= trailingslashit( $upload_dir_url['basedir'] ) . 'amokit-addons/';

			if ( $params['has_block'] ) {
				update_post_meta( $post_id, '_amokit_active', 'yes' );
				$all_block_css = $params['block_css'];

				WP_Filesystem( false, $upload_dir_url['basedir'], true );
				if( ! $wp_filesystem->is_dir( $dirname ) ) {
					$wp_filesystem->mkdir( $dirname );
				}

				update_post_meta( $post_id, '_amokit_css', $all_block_css );
				if ( ! $wp_filesystem->put_contents( $dirname . $filename, $all_block_css ) ) {
					throw new Exception( __('You are not permitted to save CSS.', 'amokit-addons' ) ); 
				}
				return [
					'success' => true,
					'message' =>__('amokit Blocks css file update.', 'amokit-addons' )
				];
			} else {
				delete_post_meta( $post_id, '_amokit_active' );
				if ( file_exists( $dirname.$filename ) ) {
					wp_delete_file( $dirname.$filename );
				}
				delete_post_meta( $post_id, '_amokit_css' );
				return [
					'success' => true,
					'message' => __('amokit Blocks CSS Delete.', 'amokit-addons' )
				];
			}
		} catch( Exception $e ){
			return [
				'success' => false,
				'message' => $e->getMessage()
			];
        }
	}


	/**
	 * Save Inner Block CSS
	 */
	public function appened_css( $request ) {
		global $wp_filesystem;
		if ( ! $wp_filesystem ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		$params  = $request->get_params();
		$css 	 = $params['inner_css'];
		$post_id = (int) sanitize_text_field( $params['post_id'] );

		if( $post_id ){

			$filename = "amokit-css-{$post_id}.css";
			$dirname  = trailingslashit( wp_upload_dir()['basedir'] ).'amokit-addons/';
			
			WP_Filesystem( false, $upload_dir_url['basedir'], true );
			if( ! $wp_filesystem->is_dir( $dirname ) ) {
				$wp_filesystem->mkdir( $dirname );
			}
			
			update_post_meta( $post_id, '_amokit_css', $css );
			update_post_meta( $post_id, '_amokit_active', 'yes' );
			
			if ( ! $wp_filesystem->put_contents( $dirname . $filename, $css ) ) {
				throw new Exception( esc_html__('You are not permitted to save CSS.', 'amokit-addons' ) );
			}

			wp_send_json_success(
				[
					'success' => true, 
					'message' => __('Data fetch', 'amokit-addons' )
				]
			);

		} else {
			return [ 
				'success' => false, 
				'message' => __('Data not found.', 'amokit-addons' )
			];
		}

	}

    /**
	 * Manage Block CSS
	 * @return void
	 */
	public function manage_block_css(){
		$css_adding_system = amoKitBlocks_get_option( 'css_add_via', 'amokit_gutenberg_tabs', 'internal' );
		if ( $css_adding_system === 'internal' ) {
			add_action( 'wp_head', [ $this, 'block_inline_css' ], 100 );
		} else {
			add_action( 'wp_enqueue_scripts', [ $this, 'block_css_file' ] );
		}
	}

    /**
     * Inline CSS Manage
     *
     * @return void
     */
    public function block_inline_css(){
		$this->generate_inline_css( amoKitBlocks_get_ID() );
    }

	/**
     * CSS File Manage
     *
     * @return void
     */
	public function block_css_file(){
		$this->enqueue_block_css( amoKitBlocks_get_ID() );
	}

	/**
	 * Generate Inline CSS
	 *
	 * @param [type] $post_id
	 * @return void
	 */
	public function generate_inline_css( $post_id ){
		if( $post_id ){
			$upload_dir_url 	= wp_get_upload_dir();
            $upload_css_dir_url = trailingslashit( $upload_dir_url['basedir'] );
			$css_file_path 		= $upload_css_dir_url."amokit-addons/amokit-css-{$post_id}.css";

			// Reusable Block CSS
			$reusable_block_css = '';
			$reusable_id = amoKitBlocks_reusable_id( $post_id );
			foreach ( $reusable_id as $id ) {
				$reusable_dir_path = $upload_css_dir_url."amokit-addons/amokit-css-{$id}.css";
				if (file_exists( $reusable_dir_path )) {
					$reusable_block_css .= amokit_get_local_file_data( $reusable_dir_path );
				}else{
					$reusable_block_css .= get_post_meta($id, '_amokit_css', true);
				}
			}

			if ( file_exists( $css_file_path ) ) {
				echo '<style type="text/css">'.amo_get_local_file_data( $css_file_path ).$reusable_block_css.'</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				$css = get_post_meta( $post_id, '_amokit_css', true );
				if( $css ) {
					echo '<style type="text/css">'.$css.$reusable_block_css.'</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	}

	/**
	 * enqueue block CSS
	 *
	 * @param [type] $post_id
	 * @return void
	 */
	public function enqueue_block_css( $post_id ){
		if( $post_id ){
			$upload_dir_url 	= wp_get_upload_dir();
            $upload_css_dir_url = trailingslashit( $upload_dir_url['basedir'] );
			$css_file_path 		= $upload_css_dir_url."amokit-addons/amokit-css-{$post_id}.css";

            $css_dir_url = trailingslashit( $upload_dir_url['baseurl'] );
            if ( is_ssl() ) {
                $css_dir_url = str_replace('http://', 'https://', $css_dir_url);
            }

            // Reusable Block CSS
			$reusable_id = amoKitBlocks_reusable_id( $post_id );
			foreach ( $reusable_id as $id ) {
				$reusable_dir_path = $upload_css_dir_url."amokit-addons/amokit-css-{$id}.css";
				if (file_exists( $reusable_dir_path )) {
                    $css_file_url = $css_dir_url . "amokit-addons/amokit-css-{$id}.css";
				    wp_enqueue_style( "amokit-post-{$id}", $css_file_url, false, AMONAKIT_VERSION, 'all' );
				}else{
					$css = get_post_meta( $id, '_amokit_css', true );
                    if( $css ) {
                        wp_enqueue_style( "amokit-post-{$id}", $css, false, AMONAKIT_VERSION );
                    }
				}
            }

			if ( file_exists( $css_file_path ) ) {
				$css_file_url = $css_dir_url . "amokit-addons/amokit-css-{$post_id}.css";
				wp_enqueue_style( "amokit-post-{$post_id}", $css_file_url, false, AMONAKIT_VERSION, 'all' );
			} else {
				$css = get_post_meta( $post_id, '_amokit_css', true );
				if( $css ) {
					wp_enqueue_style( "amokit-post-{$post_id}", $css, false, AMONAKIT_VERSION );
				}
			}
		}
	}


}
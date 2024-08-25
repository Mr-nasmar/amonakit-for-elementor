<?php

/**
 * [AmoKir_get_elementor] Get elementor instance
 * @return [\Elementor\Plugin]
 */
function amokit_get_elementor() {
    return \Elementor\Plugin::instance();
}

/**
 * [amokit_get_elementor_option]
 * @param  [string] $key Option Key
 * @param  [int] $post_id page id
 * @return [string] custom value
 */
function amokit_get_elementor_option( $key, $post_id ){
    // Get the page settings manager
    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

    // Get the settings model for current post
    $page_settings_model = $page_settings_manager->get_model( $post_id );

    // Retrieve value
    $elget_value = $page_settings_model->get_settings( $key );
    return $elget_value;
}


/**
* Elementor Version check
* Return boolean value
*/
function amokit_is_elementor_version( $operator = '<', $version = '2.6.0' ) {
    return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

// Compatibility with elementor version 3.6.1
function amokit_widget_register_manager($widget_class){
    $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
    
    if ( amokit_is_elementor_version( '>=', '3.5.0' ) ){
        $widgets_manager->register( $widget_class );
    }else{
        $widgets_manager->register_widget_type( $widget_class );
    }
}

/*
 * Plugisn Options value
 * return on/off
 */
if( !function_exists('amokit_get_option') ){
    function amokit_get_option( $option, $section, $default = '' ){
        $options = get_option( $section );
        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }
        return $default;
    }
}

/*
 * Elementor Templates List
 * return array
 */
if( !function_exists('amokit_elementor_template') ){
    function amokit_elementor_template( $args = [] ) {
        if( class_exists('\Elementor\Plugin') ){

            $template_instance = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' );
            
            $defaults = [
                'post_type' => 'elementor_library',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => [
                    [
                        'key' => '_elementor_template_type',
                        'value' => $template_instance::get_template_types()
                    ],
                ],
            ];
            $query_args = wp_parse_args( $args, $defaults );

            $templates_query = new \WP_Query( $query_args );

            $templates = [];
            if ( $templates_query->have_posts() ) {
                $templates = [ '0' => __( 'Select Template', 'amokit-addons' ) ];
                foreach ( $templates_query->get_posts() as $post ) {
                    $templates[$post->ID] = $post->post_title . '(' . $template_instance::get_template_type( $post->ID ). ')';
                }
            }else{
                $templates = [ '0' => __( 'Do not Saved Templates.', 'amokit-addons' ) ];
            }
            wp_reset_postdata();

            return $templates;

        }else{
            return array( '0' => __( 'Do not Saved Templates.', 'amokit-addons' ) );
        }
    }
}

/*
 * Elementor Setting page value
 * return $elget_value
 */
if( !function_exists('amokit_get_elementor_setting') ){
    function amokit_get_elementor_setting( $key, $post_id ){
        // Get the page settings manager
        $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

        // Get the settings model for current post
        $page_settings_model = $page_settings_manager->get_model( $post_id );

        // Retrieve value
        $elget_value = $page_settings_model->get_settings( $key );
        return $elget_value;
    }
}


/*
 * Sidebar Widgets List
 * return array
 */
if( !function_exists('amokit_sidebar_options') ){
    function amokit_sidebar_options() {
        global $wp_registered_sidebars;
        $sidebar_options = array();

        if ( ! $wp_registered_sidebars ) {
            $sidebar_options['0'] = __( 'No sidebars were found', 'amokit-addons' );
        } else {
            $sidebar_options['0'] = __( 'Select Sidebar', 'amokit-addons' );
            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $sidebar_options[ $sidebar_id ] = $sidebar['name'];
            }
        }
        return $sidebar_options;
    }
}

/*
 * Get Taxonomy
 * return array
 */
if( !function_exists('amokit_get_taxonomies') ){
    function amokit_get_taxonomies( $amokit_texonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy' => $amokit_texonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }
}

/*
 * Get Post Type
 * return array
 */
if( !function_exists('amokit_get_post_types') ){
    function amokit_get_post_types( $args = [] ) {
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];
        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }
        $_post_types = get_post_types( $post_type_args , 'objects' );

        $post_types  = [];
        if( !empty( $args['defaultadd'] ) ){
            $post_types[ strtolower($args['defaultadd']) ] = ucfirst($args['defaultadd']);
        }
        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }
        return $post_types;
    }
}

/*
 * HTML Tag list
 * return array
 */
if( !function_exists('amokit_html_tag_lists') ){
    function amokit_html_tag_lists() {
        $html_tag_list = [
            'h1'   => __( 'H1', 'amokit-addons' ),
            'h2'   => __( 'H2', 'amokit-addons' ),
            'h3'   => __( 'H3', 'amokit-addons' ),
            'h4'   => __( 'H4', 'amokit-addons' ),
            'h5'   => __( 'H5', 'amokit-addons' ),
            'h6'   => __( 'H6', 'amokit-addons' ),
            'p'    => __( 'p', 'amokit-addons' ),
            'div'  => __( 'div', 'amokit-addons' ),
            'span' => __( 'span', 'amokit-addons' ),
        ];
        return $html_tag_list;
    }
}

/*
 * HTML Tag Validation
 * return strig
 */
function amokit_validate_html_tag( $tag ) {
    $allowed_html_tags = [
        'article',
        'aside',
        'footer',
        'header',
        'section',
        'nav',
        'main',
        'div',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'p',
        'span',
    ];
    $valid_tag = is_string( $tag ) ? strtolower( $tag ) : 'div';
    return in_array( $valid_tag, $allowed_html_tags ) ? $tag : 'div';
}

/*
 * Custom Pagination
 */
if( !function_exists('amokit_custom_pagination') ){
    function amokit_custom_pagination( $totalpage ){
        $big = 999999999;
        echo '<div class="amobuilder-pagination">';
            echo paginate_links( array( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $totalpage,
                'prev_text' => '&larr;', 
                'next_text' => '&rarr;', 
                'type'      => 'list', 
                'end_size'  => 3, 
                'mid_size'  => 3
            ) ); 
        echo '</div>';
    }
}

/*
 * Contact form list
 * return array
 */
if( !function_exists('amokit_contact_form_seven') ){
    function amokit_contact_form_seven(){
        $countactform = array();
        $amokit_forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $amokit_forms = get_posts( $amokit_forms_args );

        if( $amokit_forms ){
            foreach ( $amokit_forms as $amokit_form ){
                $countactform[$amokit_form->ID] = $amokit_form->post_title;
            }
        }else{
            $countactform[ esc_html__( 'No contact form found', 'amokit-addons' ) ] = 0;
        }
        return $countactform;
    }
}


/*
 * All Post Name
 * return array
 */
if( !function_exists('amokit_post_name') ){
    function amokit_post_name ( $post_type = 'post', $limit = 'default' ){
        if( $limit === 'default' ){
            $limit = amokit_get_option( 'loadpostlimit', 'amokit_general_tabs', '20' );
        }
        $options = array();
        $options = ['0' => esc_html__( 'None', 'amokit-addons' )];
        $wh_post = array( 'posts_per_page' => $limit, 'post_type'=> $post_type );
        $wh_post_terms = get_posts( $wh_post );
        if ( ! empty( $wh_post_terms ) && ! is_wp_error( $wh_post_terms ) ){
            foreach ( $wh_post_terms as $term ) {
                $options[ $term->ID ] = $term->post_title;
            }
            return $options;
        }
    }
}

/**
* Blog page return true
*/
if( !function_exists('amokit_builder_is_blog_page') ){
    function amokit_builder_is_blog_page() {
        global $post;
        //Post type must be 'post'.
        $post_type = get_post_type( $post );
        return (
            ( is_home() || is_archive() )
            && ( $post_type == 'post')
        ) ? true : false ;
    }
}

/**
 * Get all menu list
 * return array
 */
if( !function_exists('amokit_get_all_create_menus') ){
    function amokit_get_all_create_menus() {
        $raw_menus = wp_get_nav_menus();
        $menus     = wp_list_pluck( $raw_menus, 'name', 'term_id' );
        $parent    = isset( $_GET['parent_menu'] ) ? absint( $_GET['parent_menu'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ( 0 < $parent && isset( $menus[ $parent ] ) ) {
            unset( $menus[ $parent ] );
        }
        return $menus;
    }
}

/*
 * Caldera Form
 * @return array
 */
if( !function_exists('amokit_caldera_forms_options') ){
    function amokit_caldera_forms_options() {
        if ( class_exists( 'Caldera_Forms' ) ) {
            $caldera_forms = Caldera_Forms_Forms::get_forms( true, true );
            $form_options  = ['0' => esc_html__( 'Select Form', 'amokit-addons' )];
            $form          = array();
            if ( ! empty( $caldera_forms ) && ! is_wp_error( $caldera_forms ) ) {
                foreach ( $caldera_forms as $form ) {
                    if ( isset($form['ID']) and isset($form['name'])) {
                        $form_options[$form['ID']] = $form['name'];
                    }   
                }
            }
        } else {
            $form_options = ['0' => esc_html__( 'Form Not Found!', 'amokit-addons' ) ];
        }
        return $form_options;
    }
}

/*
 * Check user Login and call this function
 */
global $user;
if ( empty( $user->ID ) ) {
    add_action('elementor/init', 'amokit_ajax_login_init' );
    add_action( 'elementor/init', 'amokit_ajax_register_init' );
}

/*
 * wp_ajax_nopriv Function
 */
function amokit_ajax_login_init() {
    add_action( 'wp_ajax_nopriv_amokit_ajax_login', 'amokit_ajax_login' );
}

/*
 * ajax login
 */
function amokit_ajax_login(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $user_data = array();
    $user_data['user_login'] = !empty( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ): "";
    $user_data['user_password'] = !empty( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ): "";
    $user_data['remember'] = true;
    $user_signon = wp_signon( $user_data, false );

    $messages = !empty( $_POST['messages'] ) ? $_POST['messages']: "";
    if( $messages ){
        $messages = json_decode( stripslashes( $messages ), true );
    }

    if ( is_wp_error($user_signon) ){

        $invalid_info = !empty( $messages['invalid_info'] ) ? esc_html( $messages['invalid_info'] ) : esc_html__('Invalid username or password!', 'amokit-addons');
        echo wp_json_encode( [ 'loggeauth'=>false, 'message'=> $invalid_info ] );
    } else {
        $success_msg = !empty( $messages['success_msg'] ) ? esc_html( $messages['success_msg'] ) : esc_html__('Login Successfully', 'amokit-addons');
        echo wp_json_encode( [ 'loggeauth'=>true, 'message'=> $success_msg ] );
    }
    wp_die();
}

/*
 * wp_ajax_nopriv Register Function
 */
function amokit_ajax_register_init() {
    add_action( 'wp_ajax_nopriv_amokit_ajax_register', 'amokit_ajax_register' );
}

/*
* Ajax Register Call back
*/
function amokit_ajax_register() {

	if ( ! isset( $_POST['nonce'] ) ) {
		echo wp_json_encode( [ 'registerauth' =>false, 'message'=> esc_html__( 'Invalid Request', 'amokit-addons' ) ] );
		wp_die();
	}

    $verified_nonce = wp_verify_nonce( $_POST['nonce'], 'amokit_register_nonce' );
    
    if ( ! $verified_nonce ) {
        echo wp_json_encode( [ 'registerauth' =>false, 'message'=> esc_html__( 'Invalid Request', 'amokit-addons' ) ] );
        wp_die();
    }
    if ( ! get_option( 'users_can_register' ) ) {
        echo wp_json_encode( [ 'registerauth' =>false, 'message'=> esc_html__( 'User registration is currently not allowed.', 'amokit-addons' ) ] );
        wp_die();
    }


    $user_data = array(
        'user_login'    => ! empty( $_POST['reg_name'] ) ? sanitize_text_field( $_POST['reg_name'] ) : "",
        'user_pass'     => ! empty( $_POST['reg_password'] ) ? sanitize_text_field( $_POST['reg_password'] ) : "",
        'user_email'    => ! empty( $_POST['reg_email'] ) ? sanitize_email( $_POST['reg_email'] ) : "",
        'user_url'      => ! empty( $_POST['reg_website'] ) ? esc_url( $_POST['reg_website'] ) : "",
        'first_name'    => ! empty( $_POST['reg_fname'] ) ? sanitize_text_field( $_POST['reg_fname'] ) : "",
        'last_name'     => ! empty( $_POST['reg_lname'] ) ? sanitize_text_field( $_POST['reg_lname'] ) : "",
        'nickname'      => ! empty( $_POST['reg_nickname'] ) ? sanitize_text_field( $_POST['reg_nickname'] ) : "",
        'description' => !empty( $_POST['reg_bio'] ) ? sanitize_text_field( $_POST['reg_bio'] ) : "",
    );
    $messages = ! empty( $_POST['messages'] ) ? $_POST['messages'] : "";
    if ( $messages ) {
        $messages = json_decode( stripslashes( $messages ), true );
    }

    if ( amokit_validation_data( $user_data ) !== true ) {
        echo amokit_validation_data( $user_data, $messages  ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    } else {
        $register_user = wp_insert_user( $user_data );

        if ( is_wp_error( $register_user ) ){
            $server_error_msg = !empty( $messages['server_error_msg'] ) ? esc_html( $messages['server_error_msg'] ) : esc_html__('Something is wrong please check again!', 'amokit-addons');
            echo wp_json_encode( [ 'registerauth' =>false, 'message'=> $server_error_msg ] );
        } else {
            $success_msg = !empty( $messages['success_msg'] ) ? esc_html( $messages['success_msg'] ) : esc_html__('Successfully Register', 'amokit-addons');
            echo wp_json_encode( [ 'registerauth' =>true, 'message'=> $success_msg ] );
        }
    }
    wp_die();

}

// Register Data Validation
function amokit_validation_data( $user_data = null, $messages = null ){
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if( empty( $user_data['user_login'] ) || empty( $_POST['reg_email'] ) || empty( $_POST['reg_password'] ) ){ // phpcs:ignore WordPress.Security.NonceVerification.Missing

        $required_msg = !empty( $messages['required_msg'] ) ? esc_html( $messages['required_msg'] ) : esc_html__('Username, Password and E-Mail are required', 'amokit-addons');
        return wp_json_encode( [ 'registerauth' =>false, 'message'=> $required_msg ] );
    }
    if( !empty( $user_data['user_login'] ) ){

        if ( 4 > strlen( $user_data['user_login'] ) ) {
            $user_length_msg = !empty( $messages['user_length_msg'] ) ? esc_html( $messages['user_length_msg'] ) : esc_html__('Username too short. At least 4 characters is required', 'amokit-addons');

            return wp_json_encode( [ 'registerauth' =>false, 'message'=> $user_length_msg ] );
        }

        if ( username_exists( $user_data['user_login'] ) ){
            $user_exists_msg = !empty( $messages['user_exists_msg'] ) ? esc_html( $messages['user_exists_msg'] ) : esc_html__('Sorry, that username already exists!', 'amokit-addons');
            
            return wp_json_encode( [ 'registerauth' =>false, 'message'=> $user_exists_msg ] );
        }

        if ( !validate_username( $user_data['user_login'] ) ) {

            $user_invalid_msg = !empty( $messages['user_invalid_msg'] ) ? esc_html( $messages['user_invalid_msg'] ) : esc_html__('Sorry, the username you entered is not valid', 'amokit-addons');
            
            return wp_json_encode( [ 'registerauth' =>false, 'message'=> $user_invalid_msg ] );
        }

    }
    if( !empty( $user_data['user_pass'] ) ){
        if ( 5 > strlen( $user_data['user_pass'] ) ) {

            $password_length_msg = !empty( $messages['password_length_msg'] ) ? esc_html( $messages['password_length_msg'] ) : esc_html__('Password length must be greater than 5', 'amokit-addons');
            
            return wp_json_encode( [ 'registerauth' =>false, 'message'=> $password_length_msg ] );
        }
    }

    if ( !is_email( $user_data['user_email'] ) ) {

        $invalid_email_msg = !empty( $messages['invalid_email_msg'] ) ? esc_html( $messages['invalid_email_msg'] ) : esc_html__('Email is not valid', 'amokit-addons');
        
        return wp_json_encode( [ 'registerauth' =>false, 'message'=> $invalid_email_msg ] );
    }
    if ( email_exists( $user_data['user_email'] ) ) {
        $email_exists_msg = !empty( $messages['email_exists_msg'] ) ? esc_html( $messages['email_exists_msg'] ) : esc_html__('Email Already in Use', 'amokit-addons');
        
        return wp_json_encode( [ 'registerauth' =>false, 'message'=> $email_exists_msg ] );
    }
    if( !empty( $user_data['user_url'] ) ){
        if ( !filter_var( $user_data['user_url'], FILTER_VALIDATE_URL ) ) {
            $invalid_url_msg = !empty( $messages['invalid_url_msg'] ) ? esc_html( $messages['invalid_url_msg'] ) : esc_html__('Website is not a valid URL', 'amokit-addons');
            
            return wp_json_encode( [ 'registerauth' =>false, 'message'=> $invalid_url_msg ] );
        }
    }
    return true;

}

/*
 * Redirect 404 page select from plugins options
 */
if( !function_exists('amokit_redirect_404') ){
    function amokit_redirect_404() {
        $errorpage_id = amokit_get_option( 'errorpage','amokit_general_tabs' );
        if ( is_404() && !empty ( $errorpage_id ) ) {
            wp_redirect( esc_url( get_page_link( $errorpage_id ) ) ); die();
        }
    }
    add_action('template_redirect','amokit_redirect_404');
}


/*
 * All list of allowed html tags.
 *
 * @param string $tag_type Allowed levels are title and desc
 * @return array
 */
function amokit_get_html_allowed_tags($tag_type = 'title') {
	$accept_html_tags = [
        'span'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strong' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'br'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],        
		'b'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
        'sub'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sup'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'i'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'u'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		's'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'em'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'del'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'ins'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],

		'code'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'mark'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'small'  => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strike' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'abbr'   => [
			'title' => [],
			'class' => [],
			'id'    => [],
			'style' => [],
		],
	];

	if ('desc' === $tag_type) {
		$desc_tags = [
            'h1' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h2' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h3' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h4' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h5' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h6' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'p' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
			'a'       => [
				'href'  => [],
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'q'       => [
				'cite'  => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'img'     => [
				'src'    => [],
				'alt'    => [],
				'height' => [],
				'width'  => [],
				'class'  => [],
				'id'     => [],
				'title'  => [],
				'style'  => [],
			],
			'dfn'     => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'time'    => [
				'datetime' => [],
				'class'    => [],
				'id'       => [],
				'style'    => [],
			],
			'cite'    => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'acronym' => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'hr'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
            'div' => [
                'class' => [],
                'id'    => [],
                'style' => []
            ],
           
            'button' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],

		];

		$accept_html_tags = array_merge($accept_html_tags, $desc_tags);
	}

	return $accept_html_tags;
}
/*
 * Escaping function for allow html tags
 * Title escaping function
 */

function amokit_kses_title( $string = '' ) {

    if ( ! is_string( $string ) ) {
        $string = ''; 
    }

	return wp_kses( $string, amokit_get_html_allowed_tags( 'title' ) );
}


/*
 * Escaping function for allow html tags
 * Description escaping function
 */
function amokit_kses_desc( $string = '' ) {
    if ( ! is_string( $string ) ) {
        $string = ''; 
    }
	return wp_kses( $string, amokit_get_html_allowed_tags( 'desc' ) );
}

/**
 * To show allowed html tags in description
 */
function amokit_get_allowed_tag_desc( $tag_type = 'title' ) {
	if (!in_array( $tag_type, ['title', 'desc'] )) {
		$tag_type = 'title';
	}

	$tags_string = '<' . implode('>,<', array_keys(amokit_get_html_allowed_tags( $tag_type ))) . '>';
	return sprintf( /* translators: %s: List of supported HTML tags */ __('This input field supports the following HTML tags: %1$s', 'amokit-addons'), '<code>' . esc_html($tags_string) . '</code>');
}


/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 * @return string $default default tag will be return during no matches
 */
if (!function_exists('amokit_escape_tags')) {
    function amokit_escape_tags($tag, $default = 'span', $extra = [])
    {

        $supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

        $supports = array_merge($supports, $extra);

        if (!in_array($tag, $supports, true)) {
            return $default;
        }

        return $tag;
    }
}



/**
 * [amokit_get_page_list]
 * @param  string $post_type
 * @return [array]
 */
if( !function_exists('amokit_get_page_list') ){
function amokit_get_page_list( $post_type = 'page' ){
    $options = array();
    $options['0'] = __('Select','amokit-addons');
    $perpage = -1;
    $all_post = array( 'posts_per_page' => $perpage, 'post_type'=> $post_type );
    $post_terms = get_posts( $all_post );
    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ){
        foreach ( $post_terms as $term ) {
            $options[ $term->ID ] = $term->post_title;
        }
        return $options;
    }
}
}


/*
 * Instagram feed list
 * return array
 */
if( !function_exists('amokit_instagram_feed_list') ){
    function amokit_instagram_feed_list(){
        global $wpdb;
        $table_name     =  esc_sql( $wpdb->prefix . 'sbi_sources' );
        $feeds_sql      = "SELECT username FROM $table_name WHERE %d";
        $feeds_query    = $wpdb->prepare( $feeds_sql, 1 ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
        $get_feeds      = $wpdb->get_results( $feeds_query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
        $all_feeds      = array();
        if( !empty( $get_feeds ) ){
            foreach($get_feeds as $value){
                $all_feeds[$value['username']] = $value['username'];
            }
        }else{
            $all_feeds['blank'] = "connect instagram account from settings"; 
        }
        return $all_feeds;
    }
}
/*
 * All Taxonomie Category Load
 * return Array
*/
if( !function_exists('all_object_taxonomie_show_catagory') ){
    function all_object_taxonomie_show_catagory($taxonomieName){

        $allTaxonomie =  get_object_taxonomies($taxonomieName);
        if(isset($allTaxonomie['0'])){
            if($allTaxonomie['0'] == "product_type"){
                $allTaxonomie['0'] = 'product_cat';
            }
            return amokit_get_taxonomies($allTaxonomie['0']);
        }
    }
}

/**
 * Get all Authors List
 *
 * @return array
 */
if( !function_exists('amokit_get_authors_list') ){
    function amokit_get_authors_list() {
        $args = [
            'capability'          => [ 'edit_posts' ],
            'has_published_posts' => true,
            'fields'              => [
                'ID',
                'display_name',
            ],
        ];

        // Version check 5.9.
        if ( version_compare( $GLOBALS['wp_version'], '5.9-alpha', '<' ) ) {
            $args['who'] = 'authors';
            unset( $args['capability'] );
        }

        $authors = get_users( $args );

        if ( ! empty( $authors ) ) {
            return wp_list_pluck( $authors, 'display_name', 'ID' );
        }

        return [];
    }
}

/**
 * Get Amona Kit Elementor section dashboard icon
 *
 * @return image
 */
if (!function_exists('amokit_get_elementor_section_icon')) {
	function amokit_get_elementor_section_icon() {
		return "<img class='ht-badge-icon' src='".AMONAKIT_ADDONS_PL_URL."admin/assets/images/menu-icon-collerd.png' alt='".esc_attr('HT','amokit-addons')."'>";
	}
}

/**
 *  Elementor pro feature notice function
 *
 * @param [type] $repeater/ $this
 * @param [type] $condition_key
 * @param [type] $array_value
 * @param [type] $type Controls_Manager::RAW_HTML
 * @return HTML
 */
function amokit_pro_notice( $repeater,$condition_key, $array_value, $type ){

    $repeater->add_control(
        'update_pro'.$condition_key,
        [
            'type' => $type,
            'raw' => sprintf(/* translators: 1: Opening strong and anchor tags for Pro Version link, 2: Closing anchor and strong tags */
                __('Upgrade to pro version to use this feature %1$s Pro Version %2$s', 'amokit-addons'),
                '<strong><a href="https://nasdesigns.rf.gd/pricing/" target="_blank">',
                '</a></strong>'),
            'content_classes' => 'amokit-addons-notice',
            'condition' => [
                $condition_key => $array_value,
            ]
        ]
    );
}


/**
 * Get module option value
 * @input section, option_id, option_key, default
 * @return mixed
 */
if( !function_exists('amokit_get_module_option') ) {
    function amokit_get_module_option( $section = '', $option_id = '', $option_key = '', $default = null ){

        $module_settings = get_option( $section );
        
        if( $option_id && is_array( $module_settings ) && count( $module_settings ) > 0 ) {


            if( isset ( $module_settings[ $option_id ] ) && '' != $module_settings[ $option_id ] ) {

                $option_value = json_decode( $module_settings[ $option_id ], true );

                if( $option_key && is_array( $option_value  ) && count( $option_value  ) > 0 ) {

                    if ( isset($option_value[$option_key] ) && '' != $option_value[$option_key] ) {
                        return $option_value[$option_key];
                    } else {
                        return $default;
                    }
                } else {
                    return $module_settings[ $option_id ];
                }
                
            } else {
                return $default;;
            }

        } else {
            return $module_settings;
        }

    }
}

/**
 * [amokit_clean]
 * @param  [JSON] $var
 * @return [array]
 */

 if( !function_exists('amokit_clean') ) {

    function amokit_clean( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'amokit_clean', $var );
        } else {
            return is_scalar( $var ) ? esc_html( $var ) : $var;
        }
    }
 }

/**
 * [amokit_get_local_file_data]
 * @param  string $file_path
 * @return mixed  $data | false
 */
if ( ! function_exists( 'amokit_get_local_file_data' ) ) {
    function amokit_get_local_file_data( $file_path ) {
        if ( ! file_exists( $file_path ) ) {
            return false;
        }

        // Initialize the WordPress filesystem
        global $wp_filesystem;
        if ( empty( $wp_filesystem ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            WP_Filesystem();
        }
        
        // Check if the file is readable
        if ( ! is_readable( $file_path ) ) {
            return false;
        }
        
        // Read the file contents using the WP_Filesystem API
        $data = $wp_filesystem->get_contents( $file_path );
        if ( $data === false ) {
            return false;
        }

        return $data;
    }
}

/**
 * [amokit_get_remote_file_data]
 * @param  string $file_url
 * @return mixed  $data | false
 */
if ( ! function_exists( 'amokit_get_remote_file_data' ) ) {
    function amokit_get_remote_file_data( $file_url ) {
        // Using wp_remote_get to fetch the remote file
        $response = wp_remote_get( $file_url );

        // Check if the response contains an error
        if ( is_wp_error( $response ) ) {
            return false;
        }

        // Retrieve the body of the response
        $data = wp_remote_retrieve_body( $response );

        // Check if the body is empty
        if ( empty( $data ) ) {
            return false;
        }

        return $data;
    }
}
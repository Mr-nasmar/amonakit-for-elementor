<?php
namespace AmoKit_Builder\Elementor\Widget;

// Elementor Classes
use Elementor\Plugin as Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_Post_Featured_Image_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-post-featured-image';
    }

    public function get_title() {
        return __( 'Post Featured Image', 'amokit-addons' );
    }

    public function get_icon() {
        return 'amokit-icon eicon-featured-image';
    }

    public function get_categories() {
        return ['amokit_builder'];
    }

    public function get_keywords() {
        return ['featured image', 'post thumbnail', 'post image', 'blog image', 'amokit', 'Amona Kit', 'addons','widget'];
    }

    public function get_help_url() {
        return 'https://nasdesigns.rf.gd/docs/';
    }
    protected function register_controls() {

        // Content
        $this->start_controls_section(
            'post_featured_image_section',
            array(
                'label' => __( 'Post Featured Image', 'amokit-addons' ),
            )
        );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'imagesize',
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

        $this->end_controls_section();

        // Post image Style
        $this->start_controls_section(
            'post_featured_image_style_section',
            array(
                'label' => __( 'Post Featured Image', 'amokit-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_responsive_control(
                'post_featured_image_align',
                [
                    'label'        => __( 'Alignment', 'amokit-addons' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'amokit-addons' ),
                            'icon'  => 'eicon-text-align-right',
                        ]
                    ],                    
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        if( Elementor::instance()->editor->is_edit_mode() ){ ?>
            <img src="<?php echo esc_url( AMONAKIT_ADDONS_PL_URL . 'assets/images/image-placeholder.png' ); ?>" alt="<?php echo esc_html__( 'Amona Kit Placeholder Image', 'amokit-addons' ); ?>">
        <?php
        }else{
            if ( has_post_thumbnail() ){
                if( $settings['imagesize_size'] == 'custom' ){
                    the_post_thumbnail( array( $settings['imagesize_custom_dimension']['width'], $settings['imagesize_custom_dimension']['height'] ) );
                }else{
                    the_post_thumbnail( $settings['imagesize_size'] ); 
                }
            }                                               
        }

    }

}

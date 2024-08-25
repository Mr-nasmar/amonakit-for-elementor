<?php
namespace AmoKitBlocks;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Manage Blocks
 */
class Blocks_List
{

    /**
     * Block List
     * @return array
     */
    public static function get_block_list()
    {
        $blockList = [
            'accordion' => [
                'label' => __('Accordion', 'amokit-addons'),
                'name' => 'amokit/accordion',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('accordion', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'accordion-card' => [
                'label' => __('Accordion Card', 'amokit-addons'),
                'name' => 'amokit/accordion-card',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('accordion', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'brand' => [
                'label' => __('Brand Logo', 'amokit-addons'),
                'name' => 'amokit/brand',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('brand', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'buttons' => [
                'label' => __('Buttons', 'amokit-addons'),
                'name' => 'amokit/buttons',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('buttons', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'button' => [
                'label' => __('Button', 'amokit-addons'),
                'name' => 'amokit/button',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('buttons', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'cta' => [
                'label' => __('Call To Action', 'amokit-addons'),
                'name' => 'amokit/cta',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('cta', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'image-grid' => [
                'label' => __('Image Grid', 'amokit-addons'),
                'name' => 'amokit/image-grid',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('image-grid', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'info-box' => [
                'label' => __('Info Box', 'amokit-addons'),
                'name' => 'amokit/info-box',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('info-box', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'section-title' => [
                'label' => __('Section Title', 'amokit-addons'),
                'name' => 'amokit/section-title',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('section-title', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'tab' => [
                'label' => __('Tab', 'amokit-addons'),
                'name' => 'amokit/tab',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('tab', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'tab-content' => [
                'label' => __('Tab Content', 'amokit-addons'),
                'name' => 'amokit/tab-content',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('tab', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'team' => [
                'label' => __('Team', 'amokit-addons'),
                'name' => 'amokit/team',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('team', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
            'testimonial' => [
                'label' => __('Testimonial', 'amokit-addons'),
                'name' => 'amokit/testimonial',
                'server_side_render' => true,
                'type' => 'common',
                'active' => amokitBlocks_get_option('testimonial', 'amokit_gutenberg_tabs', 'off') === 'on' ? true : false,
            ],
        ];
        return apply_filters('amokit_block_list', $blockList);
    }
}

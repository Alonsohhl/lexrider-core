<?php
if (!defined('ABSPATH')) {
    exit;
}

class OSF_Metabox {
    public function __construct() {
        add_action('cmb2_admin_init', array($this, 'page_meta_box'));
    }

    public function page_meta_box() {
        $prefix = 'osf_';
        if (apply_filters('osf_check_page_settings', true)) {
            $this->page_meta_box_tabs();
        }
        $this->header_builder($prefix);
    }

    private function page_meta_box_tabs() {
        $prefix = 'osf_';
        $cmb2 = new_cmb2_box(array(
            'id'            => $prefix . 'page_setting',
            'title'         => __('Page Setting', 'lexrider-core'),
            'object_types'  => array('page'),
            'vertical_tabs' => true,
            'tabs'          => array(
                array(
                    'id'     => 'osf_page_layout',
                    'title'  => __('Layout', 'lexrider-core'),
                    'fields' => array(
                        $prefix . 'enable_sidebar_page',
                        $prefix . 'sidebar_width',
                        $prefix . 'sidebar',
                        $prefix . 'enable_page_heading',
                        $prefix . 'enable_full_page',
                    ),
                ),
                array(
                    'id'     => 'osf_page_header',
                    'title'  => __('Header', 'lexrider-core'),
                    'fields' => array(
                        $prefix . 'enable_custom_header',
                        $prefix . 'header_layout'
                    ),
                ),
                array(
                    'id'     => 'osf_page_breadcrumb',
                    'title'  => __('Breadcrumb', 'lexrider-core'),
                    'fields' => array(
                        $prefix . 'enable_breadcrumb',
                        $prefix . 'breadcrumb_text_color',
                        $prefix . 'breadcrumb_bg_color',
                        $prefix . 'breadcrumb_bg_image',
                        $prefix . 'heading_color',
                    ),
                ),
                array(
                    'id'     => 'osf_page_footer',
                    'title'  => __('Footer', 'lexrider-core'),
                    'fields' => array(
                        $prefix . 'enable_custom_footer',
                        $prefix . 'footer_padding_top',
                        $prefix . 'footer_layout',
                        $prefix . 'enable_fixed_footer',
                    ),
                )
            )
        ));
        $cmb2->add_field(array(
            'name'        => __('Enable Sidebar', 'lexrider-core'),
            'id'          => $prefix . 'enable_sidebar_page',
            'type'        => 'opal_switch',
            'default'     => '0',
            'show_fields' => array(
                $prefix . 'sidebar',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Sidebar Width', 'lexrider-core'),
            'id'      => $prefix . 'sidebar_width',
            'type'    => 'opal_slider',
            'default' => '320',
            'attrs'   => array(
                'min'  => '0',
                'max'  => '400',
                'step' => '1',
                'unit' => 'px',
            ),
        ));

        $cmb2->add_field(array(
            'name'             => __('Sidebar', 'lexrider-core'),
            'desc'             => 'Select sidebar',
            'id'               => $prefix . 'sidebar',
            'type'             => 'select',
            'show_option_none' => true,
            'options'          => $this->get_sidebars(),
        ));

        $cmb2->add_field(array(
            'name'    => __('Enable Page Title', 'lexrider-core'),
            'id'      => $prefix . 'enable_page_heading',
            'type'    => 'opal_switch',
            'default' => '1',
        ));

        if (osf_is_elementor_activated()) {
            $cmb2->add_field(array(
                'name'    => __('Enable Full Page', 'lexrider-core'),
                'id'      => $prefix . 'enable_full_page',
                'type'    => 'opal_switch',
                'default' => '0',
            ));
        }

        // Header
        $cmb2->add_field(array(
            'name'        => __('Enable Custom Header', 'lexrider-core'),
            'id'          => $prefix . 'enable_custom_header',
            'type'        => 'opal_switch',
            'default'     => '0',
            'show_fields' => array(
                $prefix . 'header_layout',
            ),
        ));
        $headers = wp_parse_args($this->get_post_type_data('header'), array(
            'default' => esc_html__('Default', 'lexrider-core'),
        ));
        $cmb2->add_field(array(
            'name'             => __('Layout', 'lexrider-core'),
            'id'               => $prefix . 'header_layout',
            'type'             => 'select',
            'show_option_none' => false,
            'default'          => 'default',
            'options'          => $headers,
        ));

        //Breadcrumb

        $cmb2->add_field(array(
            'name'        => __('Enable Breadcrumb', 'lexrider-core'),
            'id'          => $prefix . 'enable_breadcrumb',
            'type'        => 'opal_switch',
            'default'     => '1',
            'show_fields' => array(
                $prefix . 'breadcrumb_text_color',
                $prefix . 'breadcrumb_bg_color',
                $prefix . 'breadcrumb_bg_image',
                $prefix . 'heading_color',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Heading Color', 'lexrider-core'),
            'id'      => $prefix . 'heading_color',
            'type'    => 'colorpicker',
            'default' => '',
        ));

        $cmb2->add_field(array(
            'name'    => __('Breadcrumb Text Color', 'lexrider-core'),
            'id'      => $prefix . 'breadcrumb_text_color',
            'type'    => 'colorpicker',
            'default' => '',
        ));

        $cmb2->add_field(array(
            'name'    => __('Breadcrumb Background Color', 'lexrider-core'),
            'id'      => $prefix . 'breadcrumb_bg_color',
            'type'    => 'colorpicker',
            'default' => '',
        ));

        $cmb2->add_field(array(
            'name'         => __('Breadcrumb Background', 'lexrider-core'),
            'desc'         => 'Upload an image or enter an URL.',
            'id'           => $prefix . 'breadcrumb_bg_image',
            'type'         => 'file',
            'options'      => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'         => array(
                'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
            ),
            'preview_size' => 'large', // Image size to use when previewing in the admin.
        ));

        //Footer

        $cmb2->add_field(array(
            'name'        => __('Enable Custom Footer', 'lexrider-core'),
            'id'          => $prefix . 'enable_custom_footer',
            'type'        => 'opal_switch',
            'default'     => '0',
            'show_fields' => array(
                $prefix . 'footer_padding_top',
                $prefix . 'footer_layout',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Padding Top', 'lexrider-core'),
            'id'      => $prefix . 'footer_padding_top',
            'type'    => 'opal_slider',
            'default' => '15',
            'attrs'   => array(
                'min'  => '0',
                'max'  => '100',
                'step' => '1',
                'unit' => 'px',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Layout', 'lexrider-core'),
            'id'      => $prefix . 'footer_layout',
            'type'    => 'opal_footer_layout',
            'default' => '',
        ));

        $cmb2->add_field(array(
            'name'    => __('Enable Fixed Footer', 'lexrider-core'),
            'id'      => $prefix . 'enable_fixed_footer',
            'type'    => 'opal_switch',
            'default' => '0'
        ));

    }

    private function header_builder($prefix = 'osf_') {
        $cmb2 = new_cmb2_box(array(
            'id'           => 'osf_header_builder',
            'title'        => __('Header Settings', 'lexrider-core'),
            'object_types' => array('header'), // Post type
            'context'      => 'normal',
            'priority'     => 'high',
            'show_names'   => true, // Show field names on the left
        ));

        $cmb2->add_field(array(
            'name'        => __('Enable AbHeader Absolute', 'lexrider-core'),
            'id'          => $prefix . 'enable_header_absolute',
            'type'        => 'opal_switch',
            'default'     => '0',
            'show_fields' => array(
                $prefix . 'header_bg_color_mobile',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Background Color Mobile', 'lexrider-core'),
            'id'      => $prefix . 'header_bg_color_mobile',
            'type'    => 'colorpicker',
            'default' => '',
        ));
    }

    private function get_post_type_data($post_type = 'post') {
        $args = array(
            'post_type'      => 'header',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        $data = array();
        if ($posts = get_posts($args)) {
            foreach ($posts as $post) {
                /**
                 * @var $post WP_Post
                 */
                $data[$post->post_name] = $post->post_title;
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    private function get_sidebars() {
        global $wp_registered_sidebars;
        $output = array();

        if (!empty($wp_registered_sidebars)) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $output[$sidebar['id']] = $sidebar['name'];
            }
        }

        return $output;
    }
}
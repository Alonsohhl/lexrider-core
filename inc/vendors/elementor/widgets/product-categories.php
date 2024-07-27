<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!osf_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Opal Product Categories', 'lexrider-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
    }


    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __('Settings', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'lexrider-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_product_categories(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'categories_style',
            [
                'label'   => __('Style', 'lexrider-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => __('Background image', 'lexrider-core'),
                    'embed' => __('Transparent', 'lexrider-core'),
                ],
            ]
        );

        $this->add_control(
            'categories_embed',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1by1',
                'options'   => [
                    '21by9' => __('Ratio 21:9', 'lexrider-core'),
                    '16by9' => __('Ratio 16:9', 'lexrider-core'),
                    '4by3'  => __('Ratio 4:3', 'lexrider-core'),
                    '1by1'  => __('Ratio 1:1', 'lexrider-core'),
                ],
                'condition' => [
                    'categories_style' => 'embed'
                ]
            ]
        );

        $this->add_control(
            'category_image',
            [
                'label'      => __('Choose Image', 'lexrider-core'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'condition'  => [
                    'categories_style' => 'image'
                ]
            ]

        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'categories_style' => 'image'
                ]
            ]
        );

        $this->add_control(
            'text_align_h',
            [
                'label'       => __('Horizontal Alignment', 'lexrider-core'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => 'center',
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'lexrider-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'lexrider-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'lexrider-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .product-cats-meta' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_align_v',
            [
                'label'        => __('Vertical Alignment', 'lexrider-core'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'default'      => 'center',
                'options'      => [
                    'flex-start' => [
                        'title' => __('Top', 'lexrider-core'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => __('Middle', 'lexrider-core'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => __('Bottom', 'lexrider-core'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'stretch'    => [
                        'title' => __('Stretch', 'lexrider-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor-vertical-align-',
                'selectors'    => [
                    '{{WRAPPER}} .product-cats-meta' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'     => __('Show Button', 'lexrider-core'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'     => __('Text', 'lexrider-core'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => __('View Collection', 'lexrider-core'),
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label'       => __('Icon', 'lexrider-core'),
                'type'        => Controls_Manager::ICON,
                'label_block' => true,
                'default'     => '',
                'condition'   => [
                    'show_button' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'show_button_when_hover',
            [
                'label'        => __('Show When Hover', 'lexrider-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'active',
                'prefix_class' => 'show-button-hover-',
                'condition'    => [
                    'show_button' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_lable_style',
            [
                'label' => __('Categories Style', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_name_typography',
                'selector' => '{{WRAPPER}} .cats-title a',
                'label'    => 'Category name typography'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'item_typography',
                'selector' => '{{WRAPPER}} .cats-total',
                'label'    => 'Item typography'
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => __('Item Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cats-total' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->start_controls_tabs('categories_colors');

        $this->start_controls_tab(
            'categories_normal',
            [
                'label' => __('Normal', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'category_name_color',
            [
                'label'     => __('Name Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cats-title a' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => __('Overlay Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cats-image:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_category_hover',
            [
                'label' => __('Hover', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'category_name_color_hover',
            [
                'label'     => __('Name Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cats:hover .cats-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_color_hover',
            [
                'label'     => __('Overlay Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .cats-image:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'text_padding',
            [
                'label'      => __('Padding', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cats-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label'     => __('Button', 'lexrider-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .elementor-button'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_background_color_hover',
            [
                'label'     => __('Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border_hover',
                'selector' => '{{WRAPPER}} .elementor-button:hover'
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'hr',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );
        $this->add_responsive_control(
            'button_text_padding',
            [
                'label'      => __('Padding', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_text_margin',
            [
                'label'      => __('Margin', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            return;
        }

        $category = get_term_by('slug', $settings['categories'], 'product_cat');
        if (!is_wp_error($category)) {

            if (!empty($settings['category_image']['id'])) {
                $image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
            } else {
                $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_url($thumbnail_id);
                } else {
                    $image = wc_placeholder_img_src();
                }
            }
            ?>

            <div class="product-cats">
                <div class="cats-image">
                    <?php
                    if (($settings['categories_style']) === 'embed') {
                        ?>
                        <div class="embed-responsive embed-responsive-<?php echo esc_attr($settings['categories_embed']); ?>"></div>
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo esc_url_raw($image); ?>"
                             alt="<?php echo esc_html($category->name); ?>">
                        <?php
                    }
                    ?>
                </div>
                <div class="product-cats-meta">
                    <div class="cats-title typo-heading">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>"
                           title="<?php echo esc_attr($category->name); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </div>
                    <div class="cats-total">
                        <?php echo esc_html($category->count) . esc_html__(' Products', 'lexrider-core'); ?>
                    </div>
                    <?php
                    if ($settings['show_button'] === 'yes') {
                        ?>
                        <div class="cats-button">
                            <a class="elementor-button" href="<?php echo esc_url(get_term_link($category)); ?>"
                               title="<?php echo esc_attr($category->name); ?>">
                                <?php
                                if (!empty($settings['button_icon'])):
                                    echo '<i class="' . esc_attr($settings['button_icon']) . '" aria-hidden="true"></i>';
                                endif;
                                ?>
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php

        }

    }
}

$widgets_manager->register(new OSF_Elementor_Products_Categories());


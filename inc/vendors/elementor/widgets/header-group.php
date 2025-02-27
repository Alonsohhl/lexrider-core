<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Group_Control_Border;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class OSF_Elementor_Header_Group extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-header-group';
    }

    public function get_title() {
        return __( 'Opal Header Group', 'lexrider-core' );
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return [ 'opal-addons' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'account_config',
            [
                'label' => __( 'Config', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => __( 'Show wishlist', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => __( 'Show search form', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => __( 'Show account', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => __( 'Show cart', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'align_config',
            [
                'label' => __('Alignment', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'lexrider-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'lexrider-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'lexrider-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-align-',
                'default' => 'right',
            ]
        );

        $this->end_controls_section();


        //Wishlist config
        $this->start_controls_section(
            'wishlist_config',
            [
                'label' => __( 'WooCommerce Wishlist', 'lexrider-core' ),
                'condition' => [
                    'show_wishlist!' => '',
                ],
            ]
        );

        $this->add_control(
            'wishlist_icon',
            [
                'label' => __( 'Choose Icon', 'lexrider-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'opal-icon-heart',
            ]
        );

        $this->add_control(
            'show_subtotal',
            [
                'label'       => __('Show Total', 'lexrider-core'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'title_wishtlist_hover',
            [
                'label' => __( 'Title Hover', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'View wishlist ', 'lexrider-core' ),
                'label_block' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'config_wishlist_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-widget-container .site-header-wishlist',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'config_wishlist_border_radius',
            [
                'label' => __('Border Radius', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .site-header-wishlist' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'config_wishlist_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .site-header-wishlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'config_wishlist_margin',
            [
                'label' => __('Margin', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .site-header-wishlist' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //End Wishlist config

        //Search form config
        $this->start_controls_section(
            'search_config',
            [
                'label' => __( 'Search Form', 'lexrider-core' ),
                'condition' => [
                    'show_search!' => '',
                ],
            ]
        );


        $this->add_control(
            'skin',
            [
                'label' => __( 'Skin', 'lexrider-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'classic',
                'options' => [
                    'classic' => __( 'Classic', 'lexrider-core' ),
                    'minimal' => __( 'Minimal', 'lexrider-core' ),
                    'full_screen' => __( 'Full Screen', 'lexrider-core' ),
                ],
                'prefix_class' => 'elementor-search-form--skin-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'icon_skin',
            [
                'label' => __( 'Choose Icon', 'lexrider-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'opal-icon-search',
                'condition' => [
                    'skin!' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label' => __( 'Placeholder', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'default' => __( 'Search', 'lexrider-core' ) . '...',
            ]
        );

        $this->add_control(
            'heading_button_content',
            [
                'label' => __( 'Button', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => __( 'Type', 'lexrider-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __( 'Icon', 'lexrider-core' ),
                    'text' => __( 'Text', 'lexrider-core' ),
                ],
                'prefix_class' => 'elementor-search-form--button-type-',
                'render_type' => 'template',
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Search', 'lexrider-core' ),
                'separator' => 'after',
                'condition' => [
                    'button_type' => 'text',
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'lexrider-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'search',
                'options' => [
                    'search' => [
                        'title' => __( 'Search', 'lexrider-core' ),
                        'icon' => 'fa fa-search',
                    ],
                    'arrow' => [
                        'title' => __( 'Arrow', 'lexrider-core' ),
                        'icon' => 'fa fa-arrow-right',
                    ],
                ],
                'render_type' => 'template',
                'prefix_class' => 'elementor-search-form--icon-',
                'condition' => [
                    'button_type' => 'icon',
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__container' => 'min-height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .elementor-search-form__submit' => 'min-width: {{SIZE}}{{UNIT}}',
                    'body:not(.rtl) {{WRAPPER}} .elementor-search-form__icon' => 'padding-left: calc({{SIZE}}{{UNIT}} / 3)',
                    'body.rtl {{WRAPPER}} .elementor-search-form__icon' => 'padding-right: calc({{SIZE}}{{UNIT}} / 3)',
                    '{{WRAPPER}} .elementor-search-form__input, {{WRAPPER}}.elementor-search-form--button-type-text .elementor-search-form__submit' => 'padding-left: calc({{SIZE}}{{UNIT}} / 3); padding-right: calc({{SIZE}}{{UNIT}} / 3)',
                ],
                'condition' => [
                    'skin!' => 'full_screen',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_content',
            [
                'label' => __( 'Toggle', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'skin' => 'full_screen',
                ],
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label' => __( 'Alignment', 'lexrider-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'lexrider-core' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'lexrider-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'lexrider-core' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle' => 'display: flex; justify-content: {{VALUE}}',
                ],
                'condition' => [
                    'skin' => 'full_screen',
                ],
            ]
        );

        $this->add_control(
            'toggle_size',
            [
                'label' => __( 'Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 33,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'full_screen',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'config_search_form_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-widget-container .search-form',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'config_search_form_border_radius',
            [
                'label' => __('Border Radius', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'config_search_form_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .search-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'config_search_form_margin',
            [
                'label' => __('Margin', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .search-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //End Search form config


        //Account config
        $this->start_controls_section(
            'account_content',
            [
                'label' => __( 'Account', 'lexrider-core' ),
                'condition' => [
                    'show_account!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_icon_account',
            [
                'label' => __( 'Show Icon', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_submenu_indicator',
            [
                'label' => __( 'Show Submenu Indicator', 'lexrider-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'icon_account',
            [
                'label' => __( 'Choose Icon', 'lexrider-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'opal-icon-user-circle',
                'condition' => [
                    'show_icon_account!' => '',
                ],
            ]
        );

        $this->add_control(
            'text_account',
            [
                'label' => __( 'Text', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('My account', 'lexrider-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'config_account_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-widget-container .account',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'config_account_border_radius',
            [
                'label' => __('Border Radius', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .account' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'config_account_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .account' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'config_account_margin',
            [
                'label' => __('Margin', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .account' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //End account config



        //WooCommerce cart config
        $this->start_controls_section(
            'cart_content',
            [
                'label' => __( 'WooCommerce Cart', 'lexrider-core' ),
                'condition' => [
                    'show_cart!' => '',
                ],
            ]
        );

        $this->add_control(
            'cart_icon',
            [
                'label' => __( 'Choose Icon', 'lexrider-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'opal-icon-shopping-cart',
            ]
        );

        $this->add_control(
            'title_cart',
            [
                'label' => __( 'Title', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Cart', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'title_cart_hover',
            [
                'label' => __( 'Title Hover', 'lexrider-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'View your shopping cart', 'lexrider-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_items',
            [
                'label'       => __('Show Count Text', 'lexrider-core'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_amount',
            [
                'label'       => __('Show Amount', 'lexrider-core'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'       => __('Show Count', 'lexrider-core'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'cart_align',
            [
                'label'   => __('Align', 'lexrider-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Right',
                'options' => array(
                    'justify-content-start' => esc_html__('Left', 'lexrider-core'),
                    'justify-content-center' => esc_html__('Center', 'lexrider-core'),
                    'justify-content-end' => esc_html__('Right', 'lexrider-core'),
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'config_cart_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-widget-container .cart-woocommerce',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'config_cart_border_radius',
            [
                'label' => __('Border Radius', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .cart-woocommerce' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'config_cart_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart-woocommerce' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'config_cart_margin',
            [
                'label' => __('Margin', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart-woocommerce' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //End WooCommerce cart


        //Start style wishlist
        $this->start_controls_section(
            'section_lable_style_wishlist',
            [
                'label' => __( 'Wishlist Style', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_wishlist' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'wishlist_style',
            [
                'label' => __( 'STYLE', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs( 'tabs_wishlist_style' );

        $this->start_controls_tab(
            'tab_wishlist_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'wishlist_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist > a' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wishlist_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'wishlist_background_hover_color',
            [
                'label' => __( 'Background Hover Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist > a:hover' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'padding_wishlist',
            [
                'label' => __( 'Padding', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_wishlist_style',
            [
                'label' => __( 'ICON', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs( 'tabs_icon_wishlist_style' );

        $this->start_controls_tab(
            'tab_icon_wishlist_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'icon_wishlist_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .opal-header-wishlist i' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_wishlist_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'icon_wishlist__hover_color',
            [
                'label' => __( 'Hover Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .opal-header-wishlist:hover i' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_wishlist_size',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-header-wishlist i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_wishlist_spacing',
            [
                'label'     => __('Spacing', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-header-wishlist i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'count_wishlish_style',
            [
                'label' => __( 'COUNT', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs( 'tabs_count_wishlist_style' );

        $this->start_controls_tab(
            'tab_count_wishlist_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );


        $this->add_control(
            'count_wl_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_wl_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_count_wishlist_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );


        $this->add_control(
            'hover_count_wl_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist:hover .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_count_wl_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist:hover .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();











        $this->add_responsive_control(
            'count_wl_font_size',
            [
                'label'     => __('Font Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'count_wl_size',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'line-height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'count_wl_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .site-header-wishlist .count',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'count_wl_border_radius',
            [
                'label' => __( 'Border Radius', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'count_wl_box_shadow',
                'selector' => '{{WRAPPER}} .site-header-wishlist .count',
            ]
        );

        $this->add_responsive_control(
            'count_wl_padding',
            [
                'label' => __( 'Padding', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_wl_margin',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //End style wishlist


        //Style Search Form
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __( 'Search Form Style', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_search!' => '',
                ],
            ]
        );

        $this->add_control(
            'search_input',
            [
                'label' => __( 'INPUT', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'icon_size_minimal',
            [
                'label' => __( 'Icon Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'minimal',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_background_color',
            [
                'label' => __( 'Overlay Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen .elementor-search-form__container' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin' => 'full_screen',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} input[type="search"].elementor-search-form__input',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => __( 'Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__input,
					{{WRAPPER}} .elementor-search-form__icon,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button:hover,
					{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form__container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin!' => 'full_screen',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label' => __( 'Border Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form__container' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-search-form__container',
                'fields_options' => [
                    'box_shadow_type' => [
                        'separator' => 'default',
                    ],
                ],
                'condition' => [
                    'skin!' => 'full_screen',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => __( 'Focus', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label' => __( 'Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form--focus .elementor-search-form__input,
					{{WRAPPER}} .elementor-search-form--focus .elementor-search-form__icon,
					{{WRAPPER}} .elementor-lightbox .dialog-lightbox-close-button:hover,
					{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color_focus',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form--focus .elementor-search-form__container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input:focus' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin!' => 'full_screen',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label' => __( 'Border Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form--focus .elementor-search-form__container' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input:focus' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_focus',
                'selector' => '{{WRAPPER}} .elementor-search-form--focus .elementor-search-form__container',
                'fields_options' => [
                    'box_shadow_type' => [
                        'separator' => 'default',
                    ],
                ],
                'condition' => [
                    'skin!' => 'full_screen',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_width',
            [
                'label' => __( 'Border Size', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form__container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}:not(.elementor-search-form--skin-full_screen) .elementor-search-form__container' => 'border-radius: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-search-form--skin-full_screen input[type="search"].elementor-search-form__input' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => __( 'Button', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-search-form__submit',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'condition' => [
                    'button_type' => 'text',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_colors' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __( 'Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'button_type' => 'icon',
                    'skin!' => 'full_screen',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label' => __( 'Width', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__submit' => 'min-width: calc( {{SIZE}} * {{size.SIZE}}{{size.UNIT}} )',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label' => __( 'Toggle', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'full_screen',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_toggle_color' );

        $this->start_controls_tab(
            'tab_toggle_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_toggle_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'toggle_color_hover',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_background_color_hover',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'toggle_icon_size',
            [
                'label' => __( 'Icon Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i:before' => 'font-size: calc({{SIZE}}em / 100)',
                ],
                'condition' => [
                    'skin' => 'full_screen',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'toggle_border_width',
            [
                'label' => __( 'Border Width', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'toggle_border_radius',
            [
                'label' => __( 'Border Radius', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-form__toggle i' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
        //End style search form


        //Start Style Account
        $this->start_controls_section(
            'section_style_account',
            [
                'label' => __( 'Account Style', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_account' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_title_account',
            [
                'label' => __( 'TITLE', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_hover_color',
            [
                'label'     => __('Text Hover Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .site-header-account > a',
            ]
        );

        $this->add_responsive_control(
            'account_align',
            [
                'label' => __( 'Text Alignment', 'lexrider-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'lexrider-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'lexrider-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'lexrider-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-account' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_icon_account',
            [
                'label' => __( 'ICON', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __('Hover Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_account_size',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_account_spacing',
            [
                'label'     => __('Spacing', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        //Start style cart
        $this->start_controls_section(
            'section_lable_style',
            [
                'label' => __( 'Cart Style', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cart' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'cart_style',
            [
                'label' => __( 'STYLE', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'tabs_cart_style' );

        $this->start_controls_tab(
            'tab_cart_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'cart_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart > a' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'cart_background_hover_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart > a:hover' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_responsive_control(
            'text_padding_cart',
            [
                'label' => __( 'Padding', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_cart_style',
            [
                'label' => __( 'ICON', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'tabs_cart_icon_style' );

        $this->start_controls_tab(
            'tab_cart_icon_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'icon_cart_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .site-header-cart i' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_icon_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'icon_cart_hover_color',
            [
                'label' => __( 'Hover Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover i' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_cart_size',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_cart_spacing',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_cart_style',
            [
                'label' => __( 'TITLE', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cart_title_typography',
                'selector' => '{{WRAPPER}} .site-header-cart .title',
            ]
        );


        $this->start_controls_tabs( 'tabs_cart_title_style' );

        $this->start_controls_tab(
            'tab_cart_title_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'cart_title_color',
            [
                'label' => __( 'Title Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_title_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'cart_title_hover_color',
            [
                'label' => __( 'Title Hover Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover .title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_responsive_control(
            'cart_title_spacing',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'amount_cart_style',
            [
                'label' => __( 'AMOUNT', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                        'show_amount!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cart_amount_typography',
                'selector' => '{{WRAPPER}} .site-header-cart .amount',
                'condition' => [
                    'show_amount!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_cart_amount_style' );

        $this->start_controls_tab(
            'tab_cart_amount_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'amount_color',
            [
                'label' => __( 'Amount Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .amount' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_amount!' => '',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_amount_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'amount_hover_color',
            [
                'label' => __( 'Amount Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover .amount' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_amount!' => '',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'amount_spacing',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .header-button .amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_amount!' => '',
                ],
            ]
        );


        $this->add_control(
            'count_text_cart_style',
            [
                'label' => __( 'COUNT TEXT', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                        'show_items!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cart_count_text_typography',
                'selector' => '{{WRAPPER}} .site-header-cart .count-text',
                'condition' => [
                    'show_items!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_cart_count_text_style' );

        $this->start_controls_tab(
            'tab_cart_count_text_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'count_text_color',
            [
                'label' => __( 'Count Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_items!' => '',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_count_text_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'count_text_hover_color',
            [
                'label' => __( 'Count Text Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover .count-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_items!' => '',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'countcart_style',
            [
                'label' => __( 'COUNT', 'lexrider-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                        'show_count!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_cart_count_style' );

        $this->start_controls_tab(
            'tab_cart_count_normal',
            [
                'label' => __( 'Normal', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_control(
            'count_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_cart_count_hover',
            [
                'label' => __( 'Hover', 'lexrider-core' ),
            ]
        );

        $this->add_control(
            'hover_count_color',
            [
                'label' => __( 'Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover .count' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_control(
            'hover_count_background_color',
            [
                'label' => __( 'Background Color', 'lexrider-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart:hover .count' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'count_font_size',
            [
                'label'     => __('Font Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );


        $this->add_responsive_control(
            'count_size',
            [
                'label'     => __('Size', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'line-height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'count_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .site-header-cart .count',
                //'separator' => 'before',
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_control(
            'count_border_radius',
            [
                'label' => __( 'Border Radius', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'count_box_shadow',
                'selector' => '{{WRAPPER}} .site-header-cart .count',
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_padding',
            [
                'label' => __( 'Padding', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_margin',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-cart .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_count!' => '',
                ],
            ]
        );

        $this->end_controls_section();
        //End style cart
    }

    protected function render() {
        $settings = $this->get_settings();

        if($settings['show_wishlist'] == 'yes' && osf_is_woocommerce_activated()){
            echo '<div class="site-header-wishlist">';
            $this->render_wishlist();
            echo '</div>';
        }

        if($settings['show_search'] == 'yes'){
            echo '<div class="search-form">';
                $this->render_search_form();
            echo '</div>';
        }

        if($settings['show_account'] == 'yes'){
            echo '<div class="account">';
            $this->render_account();
            echo '</div>';
        }

        if($settings['show_cart'] == 'yes' && osf_is_woocommerce_activated()){
            echo '<div class="cart-woocommerce">';
            $this->render_cart();
            echo '</div>';
        }
    }

    protected function render_wishlist() {
        $settings = $this->get_settings();

        $items = '';

        if (function_exists('yith_wcwl_count_all_products')) {
            $items = '<div class="site-header-wishlist-config">';
            $items .= '<a class="opal-header-wishlist header-button" title="'. esc_attr($settings['title_wishtlist_hover']).'" href="'. esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))).'">';
            $items .= '<i class="'. $settings['wishlist_icon'].'" aria-hidden="true"></i>';
            if($settings['show_subtotal']){
                $items .= '<span class="count">'. esc_html(yith_wcwl_count_all_products()).'</span>';
            }
            $items .= '</a>';
            $items .= '</div>';
        }elseif (function_exists('woosw_init')) {
            $key = WPCleverWoosw::get_key();

            $items = '<div class="site-header-wishlist-config">';
            $items .= '<a class="opal-header-wishlist header-button" href="' . esc_url(WPCleverWoosw::get_url( $key, true )) . '">';
            $items .= '<i class="' . $settings['wishlist_icon'] . '" aria-hidden="true"></i>';
            if ($settings['show_subtotal']) {
                $items .= '<span class="count">' . esc_html(WPCleverWoosw::get_count($key)) . '</span>';
            }
            $items .= '</a>';
            $items .= '</div>';
        }
        echo ($items);

    }

    protected function render_search_form() {
        $settings = $this->get_settings();
        $this->add_render_attribute(
            'input', [
                'placeholder' => $settings['placeholder'],
                'class' => 'elementor-search-form__input',
                'type' => 'search',
                'name' => 's',
                'title' => __( 'Search', 'lexrider-core' ),
                'value' => get_search_query(),
            ]
        );

        // Set the selected icon.
        if ( 'icon' == $settings['button_type'] ) {
            $icon_class = 'search';

            if ( 'arrow' == $settings['icon'] ) {
                $icon_class = is_rtl() ? 'arrow-left' : 'arrow-right';
            }

            $this->add_render_attribute( 'icon', [
                'class' => 'fa fa-' . $icon_class,
            ] );
        }

        ?>
        <form class="elementor-search-form" role="search" action="<?php echo home_url(); ?>" method="get">
            <?php if ( 'full_screen' === $settings['skin'] ) : ?>
                <div class="elementor-search-form__toggle">
                    <i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
                </div>
            <?php endif; ?>
            <div class="elementor-search-form__container">
                <?php if ( 'minimal' === $settings['skin'] ) : ?>
                    <div class="elementor-search-form__icon">
                        <i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
                    </div>
                <?php endif; ?>
                <input <?php echo $this->get_render_attribute_string('input'); ?>>
                <?php if(osf_is_woocommerce_activated()): ?>
                    <input type="hidden" name="post_type" value="product" />
                <?php endif; ?>
                <?php if ( 'classic' === $settings['skin'] ) : ?>
                    <button class="elementor-search-form__submit" type="submit">
                        <?php if ( 'icon' === $settings['button_type'] ) : ?>
                            <i <?php echo $this->get_render_attribute_string('icon'); ?> aria-hidden="true"></i>
                        <?php elseif ( ! empty( $settings['button_text'] ) ) : ?>
                            <?php echo $settings['button_text']; ?>
                        <?php endif; ?>
                    </button>
                <?php endif; ?>
                <?php if ( 'full_screen' === $settings['skin'] ) : ?>
                    <div class="dialog-lightbox-close-button dialog-close-button">
                        <i class="eicon-close" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php esc_html_e( 'Close', 'lexrider-core' ); ?></span>
                    </div>
                <?php endif ?>
            </div>
        </form>
        <?php
    }

    protected function render_cart() {
        $settings = $this->get_settings(); ?>
        <div class="site-header-cart menu d-flex <?php echo esc_attr( $settings['cart_align']); ?>">
            <a data-toggle="toggle" class="cart-contents header-button" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr( $settings['title_cart_hover'] ); ?>">
                <i class="<?php echo esc_attr( $settings['cart_icon']); ?>" aria-hidden="true"></i>
                <?php if (!empty(WC()->cart) && WC()->cart instanceof WC_Cart): ?>
                    <?php if($settings['show_count']): ?>
                        <span class="count d-inline-block text-center"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="box-cart">
                    <span class="title"><?php echo esc_html( $settings['title_cart']); ?></span>
                    <?php if (!empty(WC()->cart) && WC()->cart instanceof WC_Cart): ?>
                        <?php if($settings['show_items']): ?>
                            <span class="count-text"><?php echo wp_kses_data(_n("item", "items", WC()->cart->get_cart_contents_count(), "lexrider-core")); ?></span>
                        <?php endif; ?>
                        <?php if($settings['show_amount']): ?>
                            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </a>
            <ul class="shopping_cart">
                <li><?php the_widget('WC_Widget_Cart', 'title='); ?></li>
            </ul>
        </div>
        <?php
    }

    protected function render_account() {
        $settings = $this->get_settings();

        if (osf_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $account_link = wp_login_url();
        }
        ?>
        <div class="site-header-account">
            <?php
                echo '<a href="' . esc_html($account_link) . '">';

                if($settings['show_icon_account'] == 'yes'){
                    echo '<span class="'. esc_attr($settings['icon_account']) .'"></span>';
                }

                if(is_user_logged_in()) {
                    echo $settings['text_account'];
                }

                if($settings['show_submenu_indicator']){
                    echo '<i class="fa fa-angle-down submenu-indicator" aria-hidden="true"></i>';
                }

            echo '</a>';
            ?>
            <div class="account-dropdown">
                <div class="account-wrap">
                    <div class="account-inner <?php if (is_user_logged_in()): echo "dashboard"; endif; ?>">
                        <?php if (!is_user_logged_in()) {
                            $this->render_form_login();
                        } else {
                            $this->render_dashboard();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function render_form_login(){ ?>

        <div class="login-form-head pb-1 mb-3 bb-so-1 bc d-flex align-items-baseline justify-content-between">
            <span class="login-form-title"><?php esc_attr_e('Sign in', 'lexrider-core') ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url( wp_registration_url()); ?>"
                   title="<?php esc_attr_e('Register', 'lexrider-core'); ?>"><?php esc_attr_e('Create an Account', 'lexrider-core'); ?></a>
            </span>
        </div>
        <form class="opal-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e('Username or email', 'lexrider-core'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'lexrider-core') ?>">
            </p>
            <p>
                <label><?php esc_attr_e('Password', 'lexrider-core'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required placeholder="<?php esc_attr_e('Password', 'lexrider-core') ?>">
            </p>
            <button type="submit" data-button-action class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'lexrider-core') ?></button>
            <input type="hidden" name="action" value="osf_login">
            <?php wp_nonce_field('ajax-osf-login-nonce', 'security-login'); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="mt-2 lostpass-link d-inline-block" title="<?php esc_attr_e('Lost your password?', 'lexrider-core'); ?>"><?php esc_attr_e('Lost your password?', 'lexrider-core'); ?></a>
        </div>
        <?php

    }


    protected function render_dashboard(){ ?>
        <?php if (has_nav_menu('my-account')) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Dashboard', 'lexrider-core'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'my-account',
                    'menu_class'     => 'account-links-menu',
                    'depth'          => 1,
                ));
                ?>
            </nav><!-- .social-navigation -->
        <?php else: ?>
            <ul class="account-dashboard">

                <?php if (osf_is_woocommerce_activated()): ?>
                    <li>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" title="<?php esc_html_e('Dashboard', 'lexrider-core'); ?>"><?php esc_html_e('Dashboard', 'lexrider-core'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" title="<?php esc_html_e('Orders', 'lexrider-core'); ?>"><?php esc_html_e('Orders', 'lexrider-core'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('downloads')); ?>" title="<?php esc_html_e('Downloads', 'lexrider-core'); ?>"><?php esc_html_e('Downloads', 'lexrider-core'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" title="<?php esc_html_e('Edit Address', 'lexrider-core'); ?>"><?php esc_html_e('Edit Address', 'lexrider-core'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" title="<?php esc_html_e('Account Details', 'lexrider-core'); ?>"><?php esc_html_e('Account Details', 'lexrider-core'); ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo esc_url(get_dashboard_url(get_current_user_id())); ?>" title="<?php esc_html_e('Dashboard', 'lexrider-core'); ?>"><?php esc_html_e('Dashboard', 'lexrider-core'); ?></a>
                    </li>
                <?php endif; ?>
                <li>
                    <a title="<?php esc_html_e('Log out', 'lexrider-core'); ?>" class="tips" href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'lexrider-core'); ?></a>
                </li>
            </ul>
        <?php endif;

    }
}
$widgets_manager->register(new OSF_Elementor_Header_Group());
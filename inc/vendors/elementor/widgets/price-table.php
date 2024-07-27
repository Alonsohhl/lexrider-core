<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;

class OSF_Elementor_Price_Table extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-price-table';
    }

    public function get_title() {
        return __('Opal Price Table', 'lexrider-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Header', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'lexrider-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Title', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Pricing Table', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => __('Subtitle', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default'   => __('Starting From','lexrider-core'),
                'placeholder' => __('Enter Subtitle...', 'lexrider-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing',
            [
                'label' => __('Pricing', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label' => __('Currency Symbol', 'lexrider-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('None', 'lexrider-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'lexrider-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'lexrider-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'lexrider-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'lexrider-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'lexrider-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'lexrider-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'lexrider-core'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'lexrider-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'lexrider-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'lexrider-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'lexrider-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'lexrider-core'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'lexrider-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'lexrider-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'lexrider-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'lexrider-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'lexrider-core'),
                    'custom' => __('Custom', 'lexrider-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_symbol_custom',
            [
                'label' => __('Custom Symbol', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency_symbol' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '39.99',
            ]
        );

        $this->add_control(
            'currency_format',
            [
                'label' => __('Currency Format', 'lexrider-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => '1,234.56 (Default)',
                    ',' => '1.234,56',
                ],
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('monthly', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'sub_period',
            [
                'label' => __('Sub Period', 'lexrider-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Sub Period...', 'lexrider-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => __('Features', 'lexrider-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => __('Text', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('List Item', 'lexrider-core'),
            ]
        );

        $repeater->add_control(
            'item_check',
            [
                'label' => __('Check', 'lexrider-core'),
                'type' => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_text' => __('List Item #1', 'lexrider-core'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                    [
                        'item_text' => __('List Item #2', 'lexrider-core'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                    [
                        'item_text' => __('List Item #3', 'lexrider-core'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' => __('Button', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => __('Type', 'lexrider-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'default' => __('Default', 'lexrider-core'),
                    'primary' => __('Primary', 'lexrider-core'),
                    'secondary' => __('Secondary', 'lexrider-core'),
                    'outline_primary' => __('Outline Primary', 'lexrider-core'),
                    'outline_secondary' => __('Outline Secondary', 'lexrider-core'),
                    'link' => __('Link', 'lexrider-core'),
                    'info' => __('Info', 'lexrider-core'),
                    'success' => __('Success', 'lexrider-core'),
                    'warning' => __('Warning', 'lexrider-core'),
                    'danger' => __('Danger', 'lexrider-core'),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'lexrider-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __('Extra Small', 'lexrider-core'),
                    'sm' => __('Small', 'lexrider-core'),
                    'md' => __('Medium', 'lexrider-core'),
                    'lg' => __('Large', 'lexrider-core'),
                    'xl' => __('Extra Large', 'lexrider-core'),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Click Here', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'lexrider-core'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'lexrider-core'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon',
            [
                'label' => __('Ribbon', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'show_ribbon',
            [
                'label' => __('Show', 'lexrider-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ribbon_title',
            [
                'label' => __('Title', 'lexrider-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Popular', 'lexrider-core'),
                'condition' => [
                    'show_ribbon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

//        wrapper control style
        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'section_wrapper_bkg',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'animation_moveup',
            [
                'label' => __('Hover Move Up', 'lexrider-core'),
                'type'  => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover' => 'transform: translateY(-5px);',
                ],
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header_style',
            [
                'label' => __('Header', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_alignment',
            [
                'label' => __('Alignment', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_heading_style',
            [
                'label' => __('Title', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'heading_spacing',
            [
                'label' => __( 'Spacing', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_sub_heading_style',
            [
                'label' => __('Sub Title', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__subheading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'sub_heading_spacing',
            [
                'label' => __( 'Spacing', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

//        icon control style
        $this->add_control(
            'icon_heading',
            [
                'label' => __('Icon', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 65,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Spacing', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

//        pricing controll style
        $this->start_controls_section(
            'section_pricing_element_style',
            [
                'label' => __('Pricing', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency, {{WRAPPER}} .elementor-price-table__integer-part, {{WRAPPER}} .elementor-price-table__fractional-part' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'pricing_alignment',
            [
                'label' => __('Alignment', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'label_block' => false,
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => __( 'Spacing', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table_number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_currency_style',
            [
                'label' => __('Currency Symbol', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_size',
            [
                'label' => __('Size', 'lexrider-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                        'size'  => 35
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_vertical_position',
            [
                'label' => __('Vertical Position', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'lexrider-core'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'lexrider-core'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'lexrider-core'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'align-self: {{VALUE}}',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_period_style',
            [
                'label' => __('Period', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__period' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'sub_period_style',
            [
                'label' => __('Sub Period', 'lexrider-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'sub_period!' => '',
                ],
            ]
        );

        $this->add_control(
            'sub_period_color',
            [
                'label' => __('Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__sub_period' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'sub_period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_period_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__sub_period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'sub_period!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features_list_style',
            [
                'label' => __('Features', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'features_list_bg_color',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => __( 'Items Spacing', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color_check',
            [
                'label' => __('Color Check', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li.item_check' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_color_uncheck',
            [
                'label' => __('Color Uncheck', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:not(.item_check)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__features-list li',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'features_list_alignment',
            [
                'label' => __('Alignment', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_features_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-price-table__features-list',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_style',
            [
                'label' => __('Button', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_alignment',
            [
                'label' => __('Alignment', 'lexrider-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'   => 'justify',
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
                    'justify' => [
                        'title' => __('Justify', 'lexrider-core'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'text-align: {{VALUE}}',
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '.elementor-price-table__button.elementor-button'
            ]
        );

        $this->add_responsive_control(
            'button_position',
            [
                'label' => __( 'Position', 'lexrider-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'  => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __('Padding', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Margin', 'lexrider-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => __('Text Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'background-color: {{VALUE}};',
                ],
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
            'button_hover_color',
            [
                'label' => __('Text Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Animation', 'lexrider-core'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon_style',
            [
                'label' => __('Ribbon', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition' => [
                    'show_ribbon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ribbon_bg_color',
            [
                'label' => __('Background Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__ribbon-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label' => __('Text Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__ribbon-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__ribbon-inner',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hover_color_style',
            [
                'label' => __('Color Hover', 'lexrider-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'section_wrapper_bkg_hover',
            [
                'label' => __('Background Wrapper', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_hover',
            [
                'label' => __('Title', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_color_hover',
            [
                'label' => __('Border Color', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover .elementor-price-table__features-list' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_color_check_hover',
            [
                'label' => __('Color Check', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover .elementor-price-table__features-list li.item_check' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_color_uncheck_hover',
            [
                'label' => __('Color Uncheck', 'lexrider-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table:hover .elementor-price-table__features-list li:not(.item_check)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_currency_symbol($symbol_name) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];
        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render() {
        $settings = $this->get_settings();
        $symbol = '';

        if (!empty($settings['currency_symbol'])) {
            if ('custom' !== $settings['currency_symbol']) {
                $symbol = $this->get_currency_symbol($settings['currency_symbol']);
            } else {
                $symbol = $settings['currency_symbol_custom'];
            }
        }

        $pricing_string = (string)$settings['price'];
        $pricing_array = explode('.',$pricing_string);
        if (strlen($pricing_array[1])<2){
            $decimals = 1;
        }
        else{
            $decimals = 2;
        }

        if(count($pricing_array)<2){
            $decimals = 0;
        }

        if (empty($settings['currency_format'])){
            $dec_point = '.';
            $thousands_sep = ',';
        }
        else{
            $dec_point = ',';
            $thousands_sep = '.';
        }
        $pricing_number = number_format($settings['price'],$decimals,$dec_point,$thousands_sep);

        $this->add_render_attribute('button_text', 'class', [
            'elementor-price-table__button',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ]);

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('button_text', 'href', $settings['link']['url']);

            if (!empty($settings['link']['is_external'])) {
                $this->add_render_attribute('button_text', 'target', '_blank');
            }
        }

        if (!empty($settings['button_hover_animation'])) {
            $this->add_render_attribute('button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
        }

        $this->add_render_attribute('heading', 'class', 'elementor-price-table__heading');
        $this->add_render_attribute('sub_heading', 'class', 'elementor-price-table__subheading');
        $this->add_render_attribute('period', 'class', ['elementor-price-table__period', 'elementor-typo-excluded']);
        $this->add_render_attribute('sub_period', 'class', ['elementor-price-table__sub_period', 'elementor-typo-excluded']);
        $this->add_render_attribute('footer_additional_info', 'class', 'elementor-price-table__additional_info');
        $this->add_render_attribute('ribbon_title', 'class', 'elementor-price-table__ribbon-inner');

        if ( !empty($settings['icon']) ) {
            $this->add_render_attribute( 'i', 'class', $settings['icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }

        $this->add_inline_editing_attributes('heading', 'none');
        $this->add_inline_editing_attributes('sub_heading', 'none');
        $this->add_inline_editing_attributes('period', 'none');
        $this->add_inline_editing_attributes('sub_period', 'none');
        $this->add_inline_editing_attributes('footer_additional_info');
        $this->add_inline_editing_attributes('button_text');
        $this->add_inline_editing_attributes('ribbon_title');


        $period_element = '<div ' . $this->get_render_attribute_string('period') . '>/' . $settings['period'] . '</div>';
        ?>

        <div class="elementor-price-table">
            <?php if ($settings['heading'] || $settings['sub_heading']) : ?>
                <div class="elementor-price-table__header">

                    <?php if ( !empty($settings['icon']) ):?>
                        <div class="elementor-price-table__icon">
                            <span class="elementor-icon">
                                <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
                            </span>
                        </div>
                    <?php endif;?>
                    <?php if (!empty($settings['heading'])) : ?>
                        <h3 <?php echo $this->get_render_attribute_string('heading'); ?>><?php echo $settings['heading']; ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($settings['sub_heading'])) : ?>
                        <span <?php echo $this->get_render_attribute_string('sub_heading'); ?>><?php echo $settings['sub_heading']; ?></span>
                    <?php endif; ?>

                    <div class="elementor-price-table__price">
                        <div class="elementor-price-table_number">
                            <?php if (!empty($settings['price'])) : ?>
                                <?php if (!empty($symbol)) : ?>
                                    <span class="elementor-price-table__currency"><?php echo $symbol; ?></span>
                                <?php endif; ?>
                                <span class="elementor-price-table__integer-part"><?php echo $pricing_number; ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($settings['period'])) : ?>
                            <?php echo $period_element; ?>
                        <?php endif; ?>

                        <?php if (!empty($settings['sub_period']) ) : ?>
                            <div class="elementor-price-table__sub_period">
                                <?php echo $settings['sub_period']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; ?>

            <?php if (!empty($settings['features_list'])) : ?>
                <ul class="elementor-price-table__features-list">
                    <?php foreach ($settings['features_list'] as $index => $item) :
                        $repeater_setting_key = $this->get_repeater_setting_key('item_text', 'features_list', $index);
                        $this->add_inline_editing_attributes($repeater_setting_key);
                        if ($item['item_check']){
                            $class_active = 'item_check';
                        }
                        else{
                            $class_active = '';
                        }
                        ?>
                        <li class="<?php echo esc_attr($class_active,'lexrider-core');?> elementor-repeater-item-<?php echo $item['_id']; ?>">
                            <div class="elementor-price-table__feature-inner">
                                <?php if ($item['item_check']):?>
                                    <i class="opal-icon-check" aria-hidden="true"></i>
                                    <?php $this->add_render_attribute( 'i_check', 'class', 'item_check' ); ?>
                                <?php else : ?>
                                    <i class="opal-icon-times" aria-hidden="true"></i>
                                <?php endif;?>
                                <?php if (!empty($item['item_text'])) : ?>
                                    <span <?php echo $this->get_render_attribute_string($repeater_setting_key).$this->get_render_attribute_string('i_check'); ?>>
										<?php echo $item['item_text']; ?>
									</span>
                                <?php else :
                                    echo '&nbsp;';
                                endif;
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($settings['button_text'])) : ?>
                <div class="elementor-price-table__footer">
                    <?php if (!empty($settings['button_text'])) : ?>
                        <a <?php echo $this->get_render_attribute_string('button_text'); ?>><?php echo $settings['button_text']; ?></a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        </div>

        <?php if ('yes' === $settings['show_ribbon'] && !empty($settings['ribbon_title'])) :
            $this->add_render_attribute('ribbon-wrapper', 'class', 'elementor-price-table__ribbon');

            ?>
            <div <?php echo $this->get_render_attribute_string('ribbon-wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('ribbon_title'); ?>><?php echo $settings['ribbon_title']; ?></div>
            </div>
        <?php endif;
    }
}
$widgets_manager->register(new OSF_Elementor_Price_Table());

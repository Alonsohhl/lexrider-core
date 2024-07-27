<?php
/**
 * Elementor counter widget.
 *
 * Elementor widget that displays stats and numbers in an escalating manner.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color as Scheme_Color;

class OSF_Elementor_Divider {
    public function __construct() {
        add_action('elementor/element/after_section_end', array($this, 'add_extra_control'), 10, 3);
    }

    /**
     * @param $element Elementor\Widget_Base
     * @param $section_id string
     * @param $args array
     */
    public function add_extra_control($element, $section_id, $args) {
        if ($element->get_name() === 'divider') {
            if ($section_id === 'section_divider') {
                $element->start_controls_section(
                    'section_underline',
                    [
                        'label' => __('Custom Underline', 'lexrider-core'),
                    ]
                );

                $element->add_control(
                    'underline_enable',
                    [
                        'label'        => __('Show Item First', 'lexrider-core'),
                        'type'         => Controls_Manager::SWITCHER,
                        'prefix_class' => 'divider-has-underline-'
                    ]
                );

                $element->add_control(
                    'position',
                    [
                        'label'        => __('Icon Position', 'lexrider-core'),
                        'type'         => Controls_Manager::CHOOSE,
                        'options'      => [
                            'left'   => [
                                'title' => __('Left', 'lexrider-core'),
                                'icon'  => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __('Center', 'lexrider-core'),
                                'icon'  => 'eicon-text-align-center',
                            ],
                            'right'  => [
                                'title' => __('Right', 'lexrider-core'),
                                'icon'  => 'eicon-text-align-right',
                            ],
                        ],
                        'prefix_class' => 'divider-underline-',
                        'condition'    => [
                            'underline_enable' => 'yes',
                        ],
                    ]
                );


                $element->add_control(
                    'underline_color',
                    [
                        'label'     => __('Primary Color', 'lexrider-core'),
                        'type'      => Controls_Manager::COLOR,
                        'scheme'    => [
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'default'   => '',
                        'selectors' => [
                            '{{WRAPPER}} .elementor-divider-separator:before' => 'background-color: {{VALUE}}!important;',
                        ],
                        'condition'    => [
                            'underline_enable' => 'yes',
                        ],
                    ]
                );

                $element->add_responsive_control(
                    'underline_width',
                    [
                        'label'     => __('Width', 'lexrider-core'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px' => [
                                'min' => 30,
                                'max' => 400,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .elementor-divider-separator:before' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition'    => [
                            'underline_enable' => 'yes',
                        ],
                    ]
                );

                $element->add_responsive_control(
                    'underline_height',
                    [
                        'label'     => __('Height', 'lexrider-core'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px' => [
                                'min' => 1,
                                'max' => 10,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .elementor-divider-separator:before' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition'    => [
                            'underline_enable' => 'yes',
                        ],
                    ]
                );

                $element->add_responsive_control(
                    'underline_position_vertical',
                    [
                        'label'     => __('Position Vertical', 'lexrider-core'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px' => [
                                'min' => -20,
                                'max' => 20,
                            ],
                        ],
                        'default' => [
                            'size' => -1,
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .elementor-divider-separator:before' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition'    => [
                            'underline_enable' => 'yes',
                        ],
                    ]
                );

                $element->end_controls_section();
            }
        }
    }

}

new OSF_Elementor_Divider();
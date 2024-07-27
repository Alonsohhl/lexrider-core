<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Scroll_Timeline extends Elementor\Widget_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-scroll-timeline';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Scroll Timeline', 'lexrider-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
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
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __('Scroll Timeline', 'lexrider-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('st_year', [
            'label'       => __('Year', 'lexrider-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('1993', 'lexrider-core'),
            'placeholder' => __('1993', 'lexrider-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('st_heading', [
            'label'       => __('Heading & Content', 'lexrider-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Scroll Timeline Heading', 'lexrider-core'),
            'placeholder' => __('Scroll Timeline Heading', 'lexrider-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('st_content', [
            'label'       => __('Content', 'lexrider-core'),
            'default'     => __('Scroll Timeline Content', 'lexrider-core'),
            'placeholder' => __('Scroll Timeline Content', 'lexrider-core'),
            'type'        => Controls_Manager::WYSIWYG,
            'show_label'  => false,
        ]);


        $this->add_control(
            'tabs',
            [
                'label'   => __('Scroll Timeline Items', 'lexrider-core'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'st_year'    => __('1893', 'lexrider-core'),
                        'st_heading' => __('Heading #1', 'lexrider-core'),
                        'st_content' => __('I am timeline content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lexrider-core'),
                    ],
                    [
                        'st_year'    => __('1985', 'lexrider-core'),
                        'st_heading' => __('Heading #2', 'lexrider-core'),
                        'st_content' => __('I am timeline content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lexrider-core'),
                    ],
                ],

                'title_field' => '{{{ st_year }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height_wrapper',
            [
                'label'     => __('Height', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scroll-timeline-main' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_year_style',
            [
                'label' => __('Year', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'year_typography',
                'selector' => '{{WRAPPER}} .scroll-timeline-nav ul li',
            ]
        );

        $this->add_responsive_control(
            'spacing_year',
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
                    '{{WRAPPER}} .scroll-timeline-nav ul li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_year_style');

        $this->start_controls_tab(
            'tab_year_normal',
            [
                'label' => __('Normal', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .scroll-timeline-nav ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_year_hover',
            [
                'label' => __('Hover', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'year_color_hover',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .scroll-timeline-nav ul li:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_year_active',
            [
                'label' => __('Active', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'year_color_active',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .scroll-timeline-nav ul li.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_milestone_style',
            [
                'label' => __('Milestone', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'milestone_typography',
                'selector' => '{{WRAPPER}} .st-year',
            ]
        );

        $this->add_control(
            'milestone_color',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .st-year' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_milestone',
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
                    '{{WRAPPER}} .st-year' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_heading_style',
            [
                'label' => __('Heading', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'selector' => '{{WRAPPER}} .st-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .st-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_heading',
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
                    '{{WRAPPER}} .st-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .st-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .st-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .st-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


    }

    protected function get_html_wrapper_class() {
        return 'elementor-widget-scroll-timeline elementor-widget-' . $this->get_name();
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
        $tabs     = $this->get_settings_for_display('tabs');
        $settings = $this->get_settings_for_display();
        ?>
        <div class="scroll-timeline-root">
            <nav class="scroll-timeline-nav">
                <ul>
                    <?php
                    foreach ($tabs as $index => $item) :
                        ?>
                        <li data-index="<?php echo esc_attr($index) ?>" class="st-nav-item st-nav-<?php echo esc_attr($index) ?>">
                            <span><?php echo $item['st_year']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="scroll-timeline-main">
                <div class="inner">
                    <div class="scroll-timeline-wrapper">
                        <?php
                        foreach ($tabs as $index => $item) :?>
                            <section class="st-section st-section-<?php echo esc_attr($index) ?>" data-index="<?php echo esc_attr($index) ?>">
                                <h2 class="st-year"><?php echo $item['st_year']; ?></h2>
                                <h3 class="st-heading"><?php echo $item['st_heading']; ?></h3>
                                <div class="st-content">
                                    <?php echo do_shortcode($item['st_content']); ?>
                                </div>
                            </section>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new OSF_Elementor_Scroll_Timeline());

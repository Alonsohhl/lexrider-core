<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;

class OSF_Elementor_Testimonials extends OSF_Elementor_Carousel_Base {

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Testimonials', 'lexrider-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'lexrider-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('testimonial_content', [
            'label'       => __('Content', 'lexrider-core'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
            'rows'        => '10',
        ]);

        $repeater->add_control('testimonial_image', [
            'label'      => __('Choose Image', 'lexrider-core'),
            'default'    => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'type'       => Controls_Manager::MEDIA,
            'show_label' => false,
        ]);

        $repeater->add_control('testimonial_name', [
            'label'   => __('Name', 'lexrider-core'),
            'default' => 'John Doe',
            'type'    => Controls_Manager::TEXT,
        ]);

        $repeater->add_control('testimonial_job', [
            'label'   => __('Job', 'lexrider-core'),
            'default' => 'Designer',
            'type'    => Controls_Manager::TEXT,
        ]);

        $repeater->add_control('testimonial_link', [
            'label'       => __('Link to', 'lexrider-core'),
            'placeholder' => __('https://your-link.com', 'lexrider-core'),
            'type'        => Controls_Manager::URL,
        ]);

        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Item', 'lexrider-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );


        $this->add_responsive_control(
            'columns',
            [
                'label'              => __('Columns', 'lexrider-core'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'frontend_available' => true,
                'condition'          => [
                    'enable_carousel' => '',
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'lexrider-core'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();


        // Wrapper carousel
        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label'     => __('Wrapper', 'lexrider-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'wrapper_bgcolor',
            [
                'label'     => __('Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper',
                //'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label'      => __('Border Radius', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __('Padding', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Wrapper default
        $this->start_controls_section(
            'section_style_wrapper_df',
            [
                'label'     => __('Wrapper', 'lexrider-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => ''
                ]
            ]
        );

        $this->add_control(
            'wrapper_bgcolor_df',
            [
                'label'     => __('Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border_df',
                'selector' => '{{WRAPPER}} .elementor-testimonial-content-box',
                //'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_radius_df',
            [
                'label'      => __('Border Radius', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding_df',
            [
                'label'      => __('Padding', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image control
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => __('Image', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing',
            [
                'label'     => __('Spacing', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content control
        $this->start_controls_section(
            'section_style_testimonial_content',
            [
                'label' => __('Content', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'lexrider-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Name control
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => __('Name', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-name, {{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-name',
            ]
        );

        $this->add_responsive_control(
            'name_spacing',
            [
                'label'     => __('Spacing', 'lexrider-core'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job control
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => __('Job', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Text Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-job'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-details' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-job',
            ]
        );

        $this->end_controls_section();

        // Arrows
        $this->start_controls_section(
            'section_style_testimonial_arrow',
            [
                'label'     => __('Arrow', 'lexrider-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_arrow_style');

        $this->start_controls_tab(
            'tab_arrow_normal',
            [
                'label' => __('Normal', 'lexrider-core'),
            ]
        );

        $this->add_control(
            'arrow_nav_color',
            [
                'label'     => __('Arrow Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev,
                    {{WRAPPER}} .testimonial-control-next' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_nav_bg_color',
            [
                'label'     => __('Arrow Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev,
                    {{WRAPPER}} .testimonial-control-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_nav_border_color',
            [
                'label'     => __('Arrow Border Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev,
                    {{WRAPPER}} .testimonial-control-next' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrow_hover',
            [
                'label' => __('Hover', 'lexrider-core'),
            ]
        );


        $this->add_control(
            'arrow_nav_color_hover',
            [
                'label'     => __('Arrow Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev:hover,
                    {{WRAPPER}} .testimonial-control-next:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_nav_bg_color_hover',
            [
                'label'     => __('Arrow Background Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev:hover,
                    {{WRAPPER}} .testimonial-control-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_nav_border_color_hover',
            [
                'label'     => __('Arrow Border Color', 'lexrider-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-control-prev:hover,
                    {{WRAPPER}} .testimonial-control-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

//         Add Carousel Control
        $this->add_control_carousel();


    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-wrapper');
            // Row
            $this->add_render_attribute('row', 'class', 'row');
            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = array(
                    'navigation'         => $settings['navigation'],
                    'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? 'true' : 'false',
                    'autoplay'           => $settings['autoplay'] === 'yes' ? 'true' : 'false',
                    'autoplayTimeout'    => $settings['autoplay_speed'],
                    'items'              => 1,
                    'loop'               => $settings['infinite'] === 'yes' ? 'true' : 'false',

                );
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                if (!empty($settings['columns'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns', $settings['columns']);
                }

                if (!empty($settings['columns_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['columns_tablet']);
                }
                if (!empty($settings['columns_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['columns_mobile']);
                }
            }

            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');
            $this->add_render_attribute('item', 'class', 'column-item');

            ?>

            <!--            content carousel-->
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <!--                    turn on carousel-->

            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                    <div <?php echo $this->get_render_attribute_string('item'); ?>>

                        <div class="elementor-testimonial-content-box">
                            <div class="elementor-testimonial-content" data-trigger="<?php echo '.tes-item-' . $testimonial['_id']; ?>">
                                <?php echo $testimonial['testimonial_content']; ?>
                            </div>

                            <div class="elementor-testimonial-box">
                                <?php
                                $this->render_image($settings, $testimonial);
                                ?>
                                <div class="elementor-testimonial-details">
                                    <?php
                                    $testimonial_name_html = $testimonial['testimonial_name'];
                                    if (!empty($testimonial['testimonial_link']['url'])) :
                                        $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                    endif;
                                    ?>
                                    <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                    <div class="elementor-testimonial-job"><?php echo $testimonial['testimonial_job']; ?></div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($settings['enable_carousel'] === 'yes'): ?>
                <div class="elementor-testimonial-item-carousel">
                    <div class="elementor-testimonial-box">
                        <div class="elementor-testimonial-image-carousel">
                            <?php foreach ($settings['testimonials'] as $testimonial): ?>
                                <div class="<?php echo 'tes-item-' . $testimonial['_id']; ?> elementor-testimonial-image-wrapper">
                                    <?php $this->render_image($settings, $testimonial); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="elementor-testimonial-meta-inner">
                            <?php foreach ($settings['testimonials'] as $testimonial): ?>
                                <div class="<?php echo 'tes-item-' . $testimonial['_id']; ?> elementor-testimonial-details">
                                    <?php
                                    $testimonial_name_html = $testimonial['testimonial_name'];
                                    if (!empty($testimonial['testimonial_link']['url'])) :
                                        $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                    endif;
                                    ?>
                                    <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                    <div class="elementor-testimonial-job"><?php echo $testimonial['testimonial_job']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="testimonial-nav-2">
                        <div class="testimonial-control-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="testimonial-control-next"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>

                </div>
            <?php endif; ?>
            <?php
        }
    }

    private function render_image($settings, $testimonial) { ?>
        <div class="elementor-testimonial-image">
            <?php
            $testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
            $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
            if (!empty($testimonial['testimonial_image']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new OSF_Elementor_Testimonials());

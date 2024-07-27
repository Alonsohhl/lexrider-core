<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Tribe__Events__Main')) {
    return;
}

use Elementor\Controls_Manager;

class OSF_Elementor_Events extends OSF_Elementor_Carousel_Base
{

    public function get_name()
    {
        return 'opal-events';
    }

    public function get_title()
    {
        return __('Opal Events', 'lexrider-core');
    }

    public function get_script_depends()
    {
        return [
            'otf-countdown'
        ];
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_events',
            [
                'label' => __('Events', 'lexrider-core'),
            ]
        );

//        $this->add_control(
//            'event_id',
//            [
//                'label'       => __('Event ids', 'lexrider-core'),
//                'type'        => Controls_Manager::SELECT2,
//                'options'     => $this->get_event_ids(),
//                'multiple'    => true,
//                'description' => __('Enter a comma-separated list of event IDs. If empty, all published events are displayed.', 'lexrider-core'),
//            ]
//        );
//
//        $this->add_control(
//            'excluded_event_id',
//            [
//                'label'       => __('Excluded Event IDs', 'lexrider-core'),
//                'type'        => Controls_Manager::SELECT2,
//                'options'     => $this->get_event_ids(),
//                'multiple'    => true,
//                'description' => __('Enter a comma-separated list of event IDs to exclude those from the grid.', 'lexrider-core'),
//            ]
//        );

        $this->add_control(
            'event_type',
            [
                'label' => __('Events Type', 'lexrider-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_event_taxonomy(),
                'multiple' => true,
            ]
        );


//        $this->add_responsive_control(
//            'columns',
//            [
//                'label' => __('Columns', 'lexrider-core'),
//                'type' => Controls_Manager::SELECT,
//                'options' => [
//                    '1' => __('1', 'lexrider-core'),
//                    '2' => __('2', 'lexrider-core'),
//                    '3' => __('3', 'lexrider-core'),
//                    '4' => __('4', 'lexrider-core'),
//                ],
//                'default' => 4,
//                'description' => __('Sets the number of events per row.', 'lexrider-core'),
//            ]
//        );

        $this->add_control(
            'events_per_page',
            [
                'label' => __('Number Events', 'lexrider-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Style', 'lexrider-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => __('Style 1', 'lexrider-core'),
                    'style-2' => __('Style 2', 'lexrider-core'),
                    'style-3' => __('Style 3', 'lexrider-core')
                ],
                'default' => 'style-1',
                'prefix_class' => 'event-block-'
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label' => __('Gutter', 'lexrider-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .type-hb_event' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .events' => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_inner_style',
            [
                'label' => __( 'Inner', 'lexrider-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'inner_padding',
            [
                'label' => __( 'Padding', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tribe-events-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inner_margin',
            [
                'label' => __( 'Margin', 'lexrider-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tribe-events-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array(
            'post_type' => 'tribe_events',
            'posts_per_page' => $settings['events_per_page'],
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        );

        if (isset($settings['event_type']) && $settings['event_type']) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'id',
                    'terms' => $settings['event_type']
                )
            );
        }

//        if (isset($settings['event_id']) && $settings['event_id']) {
//            $args['post__in'] = explode(',', $settings['event_id']);
//        }
//
//        if (isset($settings['excluded_event_id ']) && $settings['excluded_event_id ']) {
//            $args['post__not_in'] = explode(',', $settings['event_not_in']);
//        }


        $this->add_render_attribute('row', 'class', $settings['style']);
        $this->add_render_attribute('row', 'class', 'events tp-hotel-booking');

        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
            $carousel_settings = array(
                'navigation' => $settings['navigation'],
                'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? 'true' : 'false',
                'autoplay' => $settings['autoplay'] === 'yes' ? 'true' : 'false',
                'autoplayTimeout' => $settings['autoplay_speed'],
                'items' => 1,
                'items_tablet' => 1,
                'items_mobile' => 1,
                'loop' => $settings['infinite'] === 'yes' ? 'true' : 'false',

            );
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns', 1);
        }

        $query = new WP_Query($args);
        global $post;
        global $more;
        $more = false;

        if ($query->have_posts()):?>
            <ul <?php echo $this->get_render_attribute_string('row') ?>>
                <?php

                while ($query->have_posts()) : $query->the_post();

                    $post_parent = '';
                    if ($post->post_parent) {
                        $post_parent = ' data-parent-post-id="' . absint($post->post_parent) . '"';
                    }
                    ?>
                    <div id="post-<?php the_ID() ?>"
                         class="column-item <?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>
                        <div class="tribe-events-inner">
                            <?php
                            $event_type = tribe('tec.featured_events')->is_featured($post->ID) ? 'featured' : 'event';
                            $event_type = apply_filters('tribe_events_list_view_event_type', $event_type);
                            tribe_get_template_part('list/single', $event_type);
                            ?>
                        </div>
                    </div>

                <?php

                endwhile; // end of the loop.
                ?>
            </ul>
        <?php
        else:

            _e('No event found', 'lexrider-core');

        endif;
        wp_reset_postdata();

    }

    private function get_event_ids()
    {
        $args = array(
            'post_type' => 'tribe_events',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
        $events_ids = array();
        $events = get_posts($args);
        foreach ($events as $event) {
            $event_title = empty($event->post_title) ? sprintf(__('Untitled (#%s)', 'lexrider-core'), $event->ID) :
                $event->post_title;
            $events_ids[$event->ID] = $event_title;
        }
        return $events_ids;
    }

    private function get_event_taxonomy()
    {
        $args = array(
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
            'number' => 0,
        );
        $terms = get_terms('tribe_events_cat', $args);
        $events_taxonomy = array();
        foreach ($terms as $term) {
            $events_taxonomy[$term->term_id] = $term->name;
        }
        return $events_taxonomy;
    }

}

$widgets_manager->register(new OSF_Elementor_Events());
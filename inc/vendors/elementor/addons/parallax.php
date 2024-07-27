<?php

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Responsive\Responsive;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OSF_Elementor_Parallax {
    public function __construct() {
        // Fix Parallax granular-controls-for-elementor
        if (function_exists('granular_get_options')) {
            $parallax_on = granular_get_options('granular_editor_parallax_on', 'granular_editor_settings', 'no');
            if ('yes' === $parallax_on) {
                add_action('elementor/frontend/section/after_render', [
                    $this,
                    'granular_editor_after_render'
                ], 10, 1);
            }
        }

		add_action( 'elementor/element/section/section_layout/after_section_end', [
			$this,
			'register_controls'
		], 10, 2 );
        add_action('elementor/frontend/section/after_render', [$this, 'osf_paralax_render'], 10, 1);
    }

    public function granular_editor_after_render($element) {
        $settings = $element->get_settings();
        if ($element->get_settings('section_parallax_on') == 'yes') {
            $type        = $settings['parallax_type'];
            $and_support = $settings['android_support'];
            $ios_support = $settings['ios_support'];
            $speed       = $settings['parallax_speed'];
            ?>

            <script type="text/javascript">
                (function ($) {
                    "use strict";
                    var granularParallaxElementorFront = {
                        init: function () {
                            elementorFrontend.hooks.addAction('frontend/element_ready/global', granularParallaxElementorFront.initWidget);
                        },
                        initWidget: function ($scope) {
                            $('.elementor-element-<?php echo $element->get_id(); ?>').jarallax({
                                type: '<?php echo $type; ?>',
                                speed: <?php echo $speed; ?>,
                                keepImg: true,
                                imgSize: 'cover',
                                imgPosition: '50% 0%',
                                noAndroid: <?php echo $and_support; ?>,
                                noIos: <?php echo $ios_support; ?>
                            });
                        }
                    };
                    $(window).on('elementor/frontend/init', granularParallaxElementorFront.init);
                }(jQuery));
            </script>

        <?php }
    }

    public function osf_paralax_render($element) {
        wp_enqueue_script('tweenmax');
        wp_enqueue_script('parallaxmouse');
        $settings      = $element->get_settings();
        $repeater_list = (isset($settings['osf_section_parallax_layer']) && $settings['osf_section_parallax_layer']) ? $settings['osf_section_parallax_layer'] : array();
        if ($settings['osf_section_parallax_switcher'] === 'yes') {
            ?>
            <script type="text/javascript">
                (function ($) {
                    "use strict";

                    <?php foreach( $repeater_list as $layer ): ?>

                    $('<div id="parallax-layer-<?php echo $element->get_id(); ?>"' + ' data-parallax="' + <?php  echo ($layer['osf_section_parallax_mouse'] == 'yes') ? 'true' : 'false'; ?> +'" ' + ' data-rate="' + <?php echo $layer['osf_section_parallax_rate']; ?> +'" ' + ' class="parallax-layer"><img src="<?php echo $layer['osf_section_parallax_image']['url']; ?>" title=""></div>').prependTo($('.elementor-element-<?php echo $element->get_id(); ?>')).css({
                        'z-index': <?php echo !empty($layer['osf_section_parallax_z_index']) ? $layer['osf_section_parallax_z_index'] : 0; ?>,
                        'left': <?php echo !empty($layer['osf_section_parallax_position_h']['size']) ? $layer['osf_section_parallax_position_h']['size'] : 50; ?> +'<?php echo !empty($layer['osf_section_parallax_position_h']['unit']) ? $layer['osf_section_parallax_position_h']['unit'] : '%'; ?>',
                        'top': <?php echo !empty($layer['osf_section_parallax_position_v']['size']) ? $layer['osf_section_parallax_position_v']['size'] : 50; ?> +'<?php echo !empty($layer['osf_section_parallax_position_v']['unit']) ? $layer['osf_section_parallax_position_v']['unit'] : '%'; ?>'
                    });

                    <?php endforeach; ?>
                    if ($(window).outerWidth() > <?php echo esc_js(Responsive::get_breakpoints()['md']); ?> ) {

                        $('.elementor-element-<?php echo $element->get_id(); ?>').mousemove(function (e) {

                            $(this).find('.parallax-layer[data-parallax="true"]').each(function (index, element) {

                                $(this).parallax($(this).data('rate'), e);

                            });

                        });

                    }
                }(jQuery));
            </script>
            <?php
        }

    }

    public function register_controls($element, $args) {

        $element->start_controls_section(
            'osf_section_parallax',
            [
                'label' => __('Multi Parallax ', 'lexrider-core'),
                'tab'   => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control('osf_section_parallax_switcher',
            [
                'label' => __('Enable Parallax', 'lexrider-core'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('osf_section_parallax_image', [
            'label'   => __('Choose Image', 'lexrider-core'),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]);

        $repeater->add_control('osf_section_parallax_position_h', [
            'label'      => __('Position h', 'lexrider-core'),
            'type'       => Controls_Manager::SLIDER,
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default'    => [
                'unit' => '%',
                'size' => 50,
            ],
            'size_units' => ['%', 'px', 'em'],
        ]);

        $repeater->add_control('osf_section_parallax_position_v', [
            'label'      => __('Position v', 'lexrider-core'),
            'type'       => Controls_Manager::SLIDER,
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default'    => [
                'unit' => '%',
                'size' => 50,
            ],
            'size_units' => ['%', 'px', 'em'],
        ]);

        $repeater->add_control('osf_section_parallax_background_size', [
            'label'   => __('Background Size', 'lexrider-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto'    => __('Auto', 'lexrider-core'),
                'cover'   => __('Cover', 'lexrider-core'),
                'contain' => __('Contain', 'lexrider-core'),
            ],
        ]);

        $repeater->add_control('osf_section_parallax_z_index', [
            'label'       => __('Z-Index', 'lexrider-core'),
            'type'        => Controls_Manager::NUMBER,
            'default'     => 1,
            'description' => __('Choose z-index for the parallax layer, default: 3', 'lexrider-core'),
        ]);

        $repeater->add_control('osf_section_parallax_mouse', [
            'label'       => __('Mousemove Parallax', 'lexrider-core'),
            'type'        => Controls_Manager::SWITCHER,
            'description' => __('Enable or disable mousemove interaction', 'lexrider-core'),
        ]);

        $repeater->add_control('osf_section_parallax_rate', [
            'label'   => __('Rate', 'lexrider-core'),
            'type'    => Controls_Manager::NUMBER,
            'default' => -10,
            'min'     => -20,
            'max'     => 20,
            'step'    => 1,
        ]);

        $element->add_control(
            'osf_section_parallax_layer',
            [
                'label'     => __('Parallax Items', 'lexrider-core'),
                'type'      => Controls_Manager::REPEATER,
                'condition' => [
                    'osf_section_parallax_switcher' => 'yes',
                ],
                'fields'    => $repeater->get_controls(),
            ]
        );

        $element->end_controls_section();

    }
}

new OSF_Elementor_Parallax();

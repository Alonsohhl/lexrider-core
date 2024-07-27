<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

abstract class OSF_Elementor_Carousel_Base extends Elementor\Widget_Base {

	public function get_categories() {
		return array( 'opal-addons' );
	}

	public function get_name() {
		return 'opal-carousel-base';
	}


	protected function add_control_carousel( $condition = array() ) {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label'     => __( 'Carousel Options', 'lexrider-core' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => $condition,
			]
		);

		$this->add_control(
			'enable_carousel',
			[
				'label' => __( 'Enable', 'lexrider-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'lexrider-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Arrows',
				'options'   => [
					'both'   => __( 'Arrows and Dots', 'lexrider-core' ),
					'arrows' => __( 'Arrows', 'lexrider-core' ),
					'dots'   => __( 'Dots', 'lexrider-core' ),
					'none'   => __( 'None', 'lexrider-core' ),
				],
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => __( 'Pause on Hover', 'lexrider-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => __( 'Autoplay', 'lexrider-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed', 'lexrider-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay'        => 'yes',
					'enable_carousel' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'     => __( 'Infinite Loop', 'lexrider-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_carousel_style',
			[
				'label'     => __( 'Carousel', 'lexrider-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_nav_style' );

		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'carousel_nav_color',
			[
				'label'     => __( 'Arrow Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_nav_bg_color',
			[
				'label'     => __( 'Arrow Background Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_nav_border_color',
			[
				'label'     => __( 'Arrow Border Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_dot_color',
			[
				'label'     => __( 'Dot Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'carousel_nav_color_hover',
			[
				'label'     => __( 'Arrow Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_nav_bg_color_hover',
			[
				'label'     => __( 'Arrow Background Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_nav_border_color_hover',
			[
				'label'     => __( 'Arrow Border Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel_dot_color_hover',
			[
				'label'     => __( 'Dot Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot:hover'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot.active' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function get_carousel_settings() {
		$settings = $this->get_settings_for_display();

		return array(
			'navigation'         => $settings['navigation'],
			'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? 'true' : 'false',
			'autoplay'           => $settings['autoplay'] === 'yes' ? 'true' : 'false',
			'autoplayTimeout'    => $settings['autoplay_speed'],
			'items'              => $settings['column'],
			'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
			'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
			'loop'               => $settings['infinite'] === 'yes' ? 'true' : 'false',
		);
	}

	protected function render_carousel_template() {
		?>
        var carousel_settings = {
        navigation: settings.navigation,
        autoplayHoverPause: settings.pause_on_hover === 'yes' ? true : false,
        autoplay: settings.autoplay === 'yes' ? true : false,
        autoplayTimeout: settings.autoplay_speed,
        items: settings.column,
        items_tablet: settings.column_tablet ? settings.column_tablet : settings.column,
        items_mobile: settings.column_mobile ? settings.column_mobile : 1,
        loop: settings.infinite === 'yes' ? true : false,
        };
		<?php
	}
}
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! osf_is_woocommerce_activated() ) {
	return;
}

/**
 * Elementor Single product.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Single_Product extends Widget_Base {

	public function get_categories() {
		return array( 'opal-addons' );
	}

	public function get_name() {
		return 'opal-single-product';
	}

	public function get_title() {
		return __( 'Opal Single Product', 'lexrider-core' );
	}

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
			'section_setting',
			[
				'label' => __( 'Settings', 'lexrider-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_id',
			[
				'label'   => __( 'Product', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => $this->get_products_id(),
				'default' => 0
			]
		);

		$this->add_control(
			'show_price',
			[
				'label'        => __( 'Show Price', 'lexrider-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'lexrider-core' ),
				'label_off'    => __( 'Hide', 'lexrider-core' ),
				'default'      => '0',
				'return_value' => '1'
			]

		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'lexrider-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_title',
				'selector' => '{{WRAPPER}} .woocommerce-loop-product__title',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Padding', 'lexrider-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_price_style',
			[
				'label'     => __( 'Price', 'lexrider-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_price' => '1'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_1',
				'selector' => '{{WRAPPER}} .price .amount',
			]
		);

		$this->start_controls_tabs( 'tabs_price_style' );

		$this->start_controls_tab(
			'tab_price_normal',
			[
				'label' => __( 'Normal', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .price .amount' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
			[
				'label'      => __( 'Padding', 'lexrider-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .price .amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_price_hover',
			[
				'label' => __( 'Hover', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .price:hover .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'lexrider-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .elementor-button a',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-button'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .elementor-button',
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
			'hover_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_color_hover',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-button:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_hover',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .elementor-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'lexrider-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'text_padding',
			[
				'label'      => __( 'Padding', 'lexrider-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();


	}


	protected function get_products_id() {
		$params  = array(
			'posts_per_page' => - 1,
			'post_type'      => [
				'product',
			],
			'post_status'    => 'publish'
		);
		$results = [];
		$query   = new \WP_Query( $params );
		while ( $query->have_posts() ): $query->the_post();
			$results[ get_the_ID() ] = get_the_title();
		endwhile;
		wp_reset_postdata();

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

		if ( empty( $settings['product_id'] ) && ! $settings['product_id'] ) {
			return;
		}
		$product = wc_get_product( $settings['product_id'] );
		if($product){
			echo '<div class="columns-1"><ul class="product-style-1 products columns-1"><li class="product"><div class="product-block">';
			echo get_the_post_thumbnail( $product->get_id(), 'woocommerce_thumbnail' );
			echo '<div class="caption">';
			echo '<h3 class="woocommerce-loop-product__title">' . $product->get_name() . '</h3>';
			echo '<span class="price">' . $product->get_price_html() . '</span>';
			echo do_shortcode( '[add_to_cart id="' . $settings['product_id'] . '" show_price="' . $settings['show_price'] . '" style="" class="elementor-button" ]' );
			echo '</div>';
			echo '</div></li></ul></div>';
		}else{
			echo __('product not found', 'lexrider-core');

		}

	}
}

$widgets_manager->register( new OSF_Elementor_Single_Product() );
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! osf_is_woocommerce_activated() ) {
	return;
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Products extends OSF_Elementor_Carousel_Base {


	public function get_categories() {
		return array( 'opal-addons' );
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
		return 'opal-products';
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
		return __( 'Opal Products', 'lexrider-core' );
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


	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'lexrider-core' ),
			'sm' => __( 'Small', 'lexrider-core' ),
			'md' => __( 'Medium', 'lexrider-core' ),
			'lg' => __( 'Large', 'lexrider-core' ),
			'xl' => __( 'Extra Large', 'lexrider-core' ),
		];
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
				'label' => __( 'Settings', 'lexrider-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'limit',
			[
				'label'   => __( 'Posts Per Page', 'lexrider-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'   => __( 'columns', 'lexrider-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ],
			]
		);

		$this->add_control(
			'advanced',
			[
				'label' => __( 'Advanced', 'lexrider-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'       => __( 'Date', 'lexrider-core' ),
					'id'         => __( 'Post ID', 'lexrider-core' ),
					'menu_order' => __( 'Menu Order', 'lexrider-core' ),
					'popularity' => __( 'Number of purchases', 'lexrider-core' ),
					'rating'     => __( 'Average Product Rating', 'lexrider-core' ),
					'title'      => __( 'Product Title', 'lexrider-core' ),
					'rand'       => __( 'Random', 'lexrider-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'lexrider-core' ),
					'desc' => __( 'DESC', 'lexrider-core' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => __( 'Categories', 'lexrider-core' ),
				'type'     => Controls_Manager::SELECT2,
				'options'  => $this->get_product_categories(),
				'multiple' => true,
			]
		);

		$this->add_control(
			'cat_operator',
			[
				'label'     => __( 'Category Operator', 'lexrider-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => __( 'AND', 'lexrider-core' ),
					'IN'     => __( 'IN', 'lexrider-core' ),
					'NOT IN' => __( 'NOT IN', 'lexrider-core' ),
				],
				'condition' => [
					'categories!' => ''
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label'   => __( 'Product Type', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'newest',
				'options' => [
					'newest'       => __( 'Newest Products', 'lexrider-core' ),
					'on_sale'      => __( 'On Sale Products', 'lexrider-core' ),
					'best_selling' => __( 'Best Selling', 'lexrider-core' ),
					'top_rated'    => __( 'Top Rated', 'lexrider-core' ),
					'featured'     => __( 'Featured Product', 'lexrider-core' ),
				],
			]
		);

		$this->add_control(
			'paginate',
			[
				'label'   => __( 'Paginate', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => __( 'None', 'lexrider-core' ),
					'pagination' => __( 'Pagination', 'lexrider-core' ),
				],
			]
		);

		$this->add_control(
			'product_layout',
			[
				'label'   => __( 'Product Layout', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => __( 'Grid', 'lexrider-core' ),
					'list' => __( 'List', 'lexrider-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'style',
			[
				'label'        => __( 'Style', 'lexrider-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 1,
				'options'      => [
					1 => __( 'Default', 'lexrider-core' ),
					2 => __( 'With border', 'lexrider-core' ),
				],
				'prefix_class' => 'elementor-product-style-',
				'condition'    => [
					'product_layout' => 'grid'
				]
			]
		);

		$this->add_responsive_control(
			'product_gutter',
			[
				'label'      => __( 'Gutter', 'lexrider-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} ul.products'            => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
				],
			]
		);

		$this->end_controls_section();
		// End Section Query

		// Carousel Option
		$this->add_control_carousel( array(
			'product_layout' => 'grid'
		) );
	}


	protected function get_product_categories() {
		$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			)
		);
		$results    = array();
		if ( ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$results[ $category->slug ] = $category->name;
			}
		}

		return $results;
	}

	protected function get_product_type( $atts, $product_type ) {
		switch ( $product_type ) {
			case 'featured':
				$atts['visibility'] = "featured";
				break;

			case 'on_sale':
				$atts['on_sale'] = true;
				break;

			case 'best_selling':
				$atts['best_selling'] = true;
				break;

			case 'top_rated':
				$atts['top_rated'] = true;
				break;

			default:
				break;
		}

		return $atts;
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
		$this->woocommerce_default( $settings );
	}

	private function woocommerce_default( $settings ) {
		$type = 'products';
		$atts = [
			'limit'          => $settings['limit'],
			'columns'        => $settings['column'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'product_layout' => $settings['product_layout'],
		];

		$atts = $this->get_product_type( $atts, $settings['product_type'] );
		if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
			$type = 'sale_products';
		} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
			$type = 'best_selling_products';
		} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
			$type = 'top_rated_products';
		}

		if ( ! empty( $settings['categories'] ) ) {
			$atts['category']     = implode( ',', $settings['categories'] );
			$atts['cat_operator'] = $settings['cat_operator'];
		}

		// Carousel
		if ( $settings['enable_carousel'] === 'yes' ) {
			$atts['carousel_settings'] = json_encode( wp_slash( $this->get_carousel_settings() ) );
			$atts['product_layout']    = 'carousel';
		}

		if ( $settings['paginate'] === 'pagination' ) {
			$atts['paginate'] = 'true';
		}

		$shortcode = new WC_Shortcode_Products( $atts, $type );

		echo $shortcode->get_content();
	}
}

$widgets_manager->register( new OSF_Elementor_Products() );
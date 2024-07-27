<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes\Typography as Scheme_Typography;

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class  OSF_Elementor_Heading extends Widget_Heading {

	public function get_title() {
		return __( 'Opal Heading', 'lexrider-core' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'lexrider-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'lexrider-core' ),
				'default'     => __( 'Add Your Heading Text Here', 'lexrider-core' ),
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'       => __( 'Sub Title', 'lexrider-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'lexrider-core' ),
				'default'     => __( '', 'lexrider-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'link',
			[
				'label'     => __( 'Link', 'lexrider-core' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Size', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'lexrider-core' ),
					'small'   => __( 'Small', 'lexrider-core' ),
					'medium'  => __( 'Medium', 'lexrider-core' ),
					'large'   => __( 'Large', 'lexrider-core' ),
					'xl'      => __( 'XL', 'lexrider-core' ),
					'xxl'     => __( 'XXL', 'lexrider-core' ),
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label'   => __( 'HTML Tag', 'lexrider-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => __( 'Alignment', 'lexrider-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => __( 'Left', 'lexrider-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'lexrider-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'lexrider-core' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'lexrider-core' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'      => '',
				'selectors'    => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'lexrider-core' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
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

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label'     => __( 'Blend Mode', 'lexrider-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''            => __( 'Normal', 'lexrider-core' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label'     => __( 'Sub Title', 'lexrider-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'sub_title!' => ''
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => __( 'Text Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .sub-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'sub_title!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'subtitle_typography',
				'selector'  => '{{WRAPPER}}.elementor-widget-heading .sub-title',
				'condition' => [
					'sub_title!' => ''
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'     => __( 'Spacing', 'lexrider-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'sub_title!' => ''
				],
			]
		);

		$this->add_control(
			'show_decor',
			[
				'label'        => __( 'Show decor', 'lexrider-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'condition'    => [
					'sub_title!' => ''
				],
				'selectors'    => [
					//'{{WRAPPER}}.elementor-widget-heading .sub-title span' => 'padding-left: 20px; padding-right: 20px',
					'{{WRAPPER}}.elementor-widget-heading .sub-title i.opal-icon-decor-left' => 'display: inline-block',
				],
				'prefix_class' => 'show-decor-',
			]
		);

		$this->add_control(
			'decor_color',
			[
				'label'     => __( 'Decor Color', 'lexrider-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .sub-title i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_decor!' => ''
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['title'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'elementor-heading-title' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		$title_html = '';

		if ( $settings['sub_title'] ) {

			$title_html .= '<span class="sub-title"><i class="opal-icon-decor-left" aria-hidden="true"></i><span>' . $settings['sub_title'] . '</span><i class="opal-icon-decor-right" aria-hidden="true"></i></span>';
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}
		if ( ! empty( $settings['title'] ) && trim($settings['title']) ) {
			$title_html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
		}

		echo $title_html;
	}

    /**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
        <#
        var title = settings.title;
        var title_html = '';

        if ( settings.sub_title ) {
        title_html += '<span class="sub-title"><i class="opal-icon-decor-left" aria-hidden="true"></i><span>' + settings.sub_title + '</span><i class="opal-icon-decor-right" aria-hidden="true"></i></span>';
        }

        if ( '' !== settings.link.url ) {
        title = '<a href="' + settings.link.url + '">' + title + '</a>';
        }

        view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );

        view.addInlineEditingAttributes( 'title' );

        title_html += '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.header_size + '>';

        print( title_html );
        #>
		<?php
	}
}

$widgets_manager->register( new OSF_Elementor_Heading() );
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OSF_Custom_Post_Type_Report
 */
class OSF_Custom_Post_Type_Report extends OSF_Custom_Post_Type_Abstract {
	public $post_type = 'osf_report';

	static $instance;

	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OSF_Custom_Post_Type_Report ) ) {
			self::$instance = new OSF_Custom_Post_Type_Report();
		}

		return self::$instance;
	}

	/**
	 * @return void
	 */
	public function create_post_type() {

		$labels = array(
			'name'               => __( 'Reports', 'lexrider-core' ),
			'singular_name'      => __( 'Report', 'lexrider-core' ),
			'add_new'            => __( 'Add New Report', 'lexrider-core' ),
			'add_new_item'       => __( 'Add New Report', 'lexrider-core' ),
			'edit_item'          => __( 'Edit Report', 'lexrider-core' ),
			'new_item'           => __( 'New Report', 'lexrider-core' ),
			'view_item'          => __( 'View Report', 'lexrider-core' ),
			'search_items'       => __( 'Search Reports', 'lexrider-core' ),
			'not_found'          => __( 'No Reports found', 'lexrider-core' ),
			'not_found_in_trash' => __( 'No Reports found in Trash', 'lexrider-core' ),
			'parent_item_colon'  => __( 'Parent Report:', 'lexrider-core' ),
			'menu_name'          => __( 'Reports', 'lexrider-core' ),
		);

		$labels = apply_filters( 'osf_postype_report_labels', $labels );

		register_post_type( $this->post_type,
			array(
				'labels'        => $labels,
				'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => apply_filters( 'osf_postype_report_slug', 'report' ) ),
				'menu_position' => 5,
				'categories'    => array(),
				'menu_icon'     => $this->get_icon( __FILE__ )
			)
		);
	}

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	public function body_class( $classes ) {
		return $classes;
	}

	public function add_shortcode() {
		add_shortcode( 'opal_report_list', function ( $atts ) {
			$atts = shortcode_atts( array(
				'posts_per_page' => 9,
				'gutter'         => '',
				'columns'        => 3,
				'style'          => '',
			), $atts );

			$atts['posts_per_page'] = intval( $atts['posts_per_page'] );

			$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$query_args = [
				'post_type'           => $this->post_type,
				'ignore_sticky_posts' => 1,
				'post_status'         => 'publish',
				'posts_per_page'      => $atts['posts_per_page'],
				'paged'               => $paged
			];

			$query = new WP_Query( $query_args );
			if($atts['style'] === 'timeline') {
				echo '<div class="opal-timeline">';
			}else{
				echo '<div class="row" data-elementor-columns="' . esc_attr( $atts['columns'] ) . '">';
			}
			while ( $query->have_posts() ) {
				$query->the_post();
				if($atts['style'] === 'timeline'){
					get_template_part( 'template-parts/posts-grid/item-post', 'timeline' );
				}else{
					get_template_part( 'template-parts/posts-grid/item-post', 'style-1' );
				}

			}
			wp_reset_postdata();
            if($atts['style'] === 'timeline') {
                echo '<span class="timeline-line"></span>';
            }
			echo '</div>';
			$paginate_args = array(
				'current'            => max( 1, get_query_var( 'paged' ) ),
				'total'              => $query->max_num_pages,
				'show_all'           => false,
				'end_size'           => 1,
				'mid_size'           => 2,
				'prev_next'          => true,
				'type'               => 'plain',
				'add_args'           => false,
				'prev_text'          => '<span class="arrow">&larr;</span><span class="screen-reader-text">' . esc_html__( 'Previous', 'lexrider-core' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'lexrider-core' ) . '</span><span class="arrow">&rarr;</span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lexrider-core' ) . ' </span>',
			);
			$paginate      = paginate_links( $paginate_args );
			if ( $paginate ) {
				printf( '<nav class="navigation pagination" role="navigation"><div class="nav-links">%s</div></nav>',
					$paginate
				);
			}
		} );
	}
}

OSF_Custom_Post_Type_Report::getInstance();
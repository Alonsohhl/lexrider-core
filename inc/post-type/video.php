<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OSF_Custom_Post_Type_Video
 */
class OSF_Custom_Post_Type_Video extends OSF_Custom_Post_Type_Abstract {
	public $post_type = 'osf_video';

	static $instance;

	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OSF_Custom_Post_Type_Video ) ) {
			self::$instance = new OSF_Custom_Post_Type_Video();
		}

		return self::$instance;
	}

	/**
	 * @return void
	 */
	public function create_post_type() {

		$labels = array(
			'name'               => __( 'Videos', 'lexrider-core' ),
			'singular_name'      => __( 'Video', 'lexrider-core' ),
			'add_new'            => __( 'Add New Video', 'lexrider-core' ),
			'add_new_item'       => __( 'Add New Video', 'lexrider-core' ),
			'edit_item'          => __( 'Edit Video', 'lexrider-core' ),
			'new_item'           => __( 'New Video', 'lexrider-core' ),
			'view_item'          => __( 'View Video', 'lexrider-core' ),
			'search_items'       => __( 'Search Videos', 'lexrider-core' ),
			'not_found'          => __( 'No Videos found', 'lexrider-core' ),
			'not_found_in_trash' => __( 'No Videos found in Trash', 'lexrider-core' ),
			'parent_item_colon'  => __( 'Parent Video:', 'lexrider-core' ),
			'menu_name'          => __( 'Videos', 'lexrider-core' ),
		);

		$labels = apply_filters( 'osf_postype_video_labels', $labels );

		register_post_type( $this->post_type,
			array(
				'labels'        => $labels,
				'supports'      => array( 'title', 'thumbnail' ),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => apply_filters( 'osf_postype_video_slug', 'video' ) ),
				'menu_position' => 5,
				'categories'    => array(),
				'menu_icon'     => $this->get_icon( __FILE__ )
			)
		);
	}


	public function create_meta_box() {
		$cmb = new_cmb2_box( array(
			'id'           => 'osf_video',
			'title'        => __( 'Settings', 'lexrider-core' ),
			'object_types' => array( $this->post_type, ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );

		$cmb->add_field( array(
			'name' => 'oEmbed',
			'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'lexrider-core' ),
			'id'   => 'osf_video',
			'type' => 'oembed',
		) );
	}

	public function body_class( $classes ) {
		if ( is_post_type_archive( $this->post_type ) || is_singular( $this->post_type ) ) {
			$classes   = array_diff( $classes, array(
				'opal-content-layout-2cl',
				'opal-content-layout-2cr',
				'opal-content-layout-1c'
			) );
			$classes[] = 'opal-content-layout-' . get_theme_mod( 'osf_room_archive_layout', '1c' );
		}

		return $classes;
	}

	public function add_shortcode() {
		add_shortcode( 'opal_videos', function ( $atts ) {
			$atts = shortcode_atts( array(
				'posts_per_page' => 9,
				'gutter'         => '',
				'columns'        => 3,
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

			echo '<div class="row opal-video-gallery" data-elementor-columns="' . esc_attr( $atts['columns'] ) . '">';
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
                <div class="column-item video-entries">
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'video' ); ?>>
                        <div class="video-post-thumbnail">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'lexrider-featured-image-small' ); ?>
							<?php endif; ?>
                            <a class="play" data-id="<?php echo esc_attr( get_the_ID() ) ?>" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'osf_video', true ) ) ?>"><i class="opal-icon-play"></i></a>
                        </div>
                    </article>
                </div>
				<?php

			}
			wp_reset_postdata();
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

OSF_Custom_Post_Type_Video::getInstance();
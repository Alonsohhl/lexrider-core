<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class OSF_Class_Event_Calendar {
	public function __construct() {
		add_filter( 'post_type_archive_title', [ $this, 'fix_breadcrumb' ], 20, 2 );
		add_filter( 'tribe_events_assets_should_enqueue_full_styles', [ $this, 'checkstyle' ] );

		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'opal_theme_sidebar', [ $this, 'set_sidebar' ], 20 );

		$this->template_table_calendar();
	}

	public function checkstyle( $should_enqueue ) {
		return false;
//		return true;
	}

	public function fix_breadcrumb( $object_labels_name, $object_name ) {
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$post_type_obj = get_post_type_object( $object_name );

			return $post_type_obj->labels->name;
		} elseif ( is_single( 'tribe_events' ) ) {
			return get_the_title();
		}

		return $object_labels_name;
	}

	private function template_table_calendar() {
		add_action( 'tribe_pre_get_template_part_month/single', function ( $slug, $name ) {
			if ( $name === 'day' ) {
				echo '<div class="opal-inner">';
			}
		}, 10, 2 );

		add_action( 'tribe_post_get_template_part_month/single', function ( $slug, $name ) {
			if ( $name === 'day' ) {
				echo '</div>';
			}
		}, 10, 2 );
	}

	public function widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Events Sidebar', 'lexrider-core' ),
			'id'            => 'sidebar_events',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on Events single and Events archive pages.', 'lexrider-core' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	}

	public function body_class( $classes ) {
		$current_view = ! empty( $current_view ) ? $current_view : basename( tribe_get_current_template() );

		if ( is_singular( 'tribe_events' ) || is_post_type_archive( 'tribe_events' ) ) {
			$classes = array_diff( $classes, array(
				'opal-content-layout-2cl',
				'opal-content-layout-2cr',
				'opal-content-layout-1c'
			) );
			if ( is_active_sidebar( 'sidebar_events' ) && ( $current_view !== 'month.php' ) ) {
				$classes[] = 'opal-content-layout-2cr';
			}
		}

		return $classes;
	}

	public function set_sidebar( $name ) {
		$current_view = ! empty( $current_view ) ? $current_view : basename( tribe_get_current_template() );
		if ( ( is_singular( 'tribe_events' ) || is_post_type_archive( 'tribe_events' ) ) && is_active_sidebar( 'sidebar_events' ) && ( $current_view !== 'month.php' ) ) {
			$name = 'sidebar_events';
		}

		return $name;
	}

	public function tribe_breadcrumbs() {
		global $post;

		$separator = " &raquo; ";

		echo '<div class="tribe-breadcrumbs">';
		echo '<a href="' . get_option( 'home' ) . '">' . bloginfo( 'name' ) . '</a>';
		if ( tribe_is_month() && ! is_tax() ) { // The Main Calendar Page
			echo $separator;
			echo 'The Events Calendar';
		} elseif ( tribe_is_month() && is_tax() ) { // Calendar Category Pages
			global $wp_query;

			$term_slug = $wp_query->query_vars['tribe_events_cat'];
			$term      = get_term_by( 'slug', $term_slug, 'tribe_events_cat' );
			get_term( $term->term_id, 'tribe_events_cat' );
			$name = $term->name;
			echo $separator;
			echo '<a href="' . tribe_get_events_link() . '">Events</a>';
			echo $separator;
			echo $name;
		} elseif ( tribe_is_event() && ! tribe_is_day() && ! is_single() ) { // The Main Events List
			echo $separator;
			echo 'Events List';
		} elseif ( tribe_is_event() && is_single() ) { // Single Events
			echo $separator;
			echo '<a href="' . tribe_get_events_link() . '">Events</a>';
			echo $separator;
			the_title();
		} elseif ( tribe_is_day() ) { // Single Event Days
			global $wp_query;

			echo $separator;
			echo '<a href="' . tribe_get_events_link() . '">Events</a>';
			echo $separator;
			echo 'Events on: ' . date( 'F j, Y', strtotime( $wp_query->query_vars['eventDate'] ) );
		} elseif ( tribe_is_venue() ) { // Single Venues
			echo $separator;
			echo '<a href="' . tribe_get_events_link() . '">Events</a>';
			echo $separator;
			the_title();
		} elseif ( is_category() || is_single() ) {
			echo $separator;
			the_category( ' &bull; ' );

			if ( is_single() ) {
				echo ' ' . $separator . ' ';
				the_title();
			}
		} elseif ( is_page() ) {
			if ( $this->is_child( get_the_ID() ) ) {
				echo $separator;
				echo '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>';
				echo $separator;
				echo the_title();
			} else {
				echo $separator;
				echo the_title();
			}
		} 
		echo '</div>';
	}

	private function is_child( $page_id ) {
		global $post;
		if ( is_page() && ( $post->post_parent != '' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

return new OSF_Class_Event_Calendar();
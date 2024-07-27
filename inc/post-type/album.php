<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Album
 */
class OSF_Custom_Post_Type_Album extends OSF_Custom_Post_Type_Abstract
{
    public $post_type = 'osf_album';

    /**
     * @return void
     */
    public function create_post_type()
    {

        $labels = array(
            'name' => __('Albums', 'lexrider-core'),
            'singular_name' => __('Album', 'lexrider-core'),
            'add_new' => __('Add New Album', 'lexrider-core'),
            'add_new_item' => __('Add New Album', 'lexrider-core'),
            'edit_item' => __('Edit Album', 'lexrider-core'),
            'new_item' => __('New Album', 'lexrider-core'),
            'view_item' => __('View Album', 'lexrider-core'),
            'search_items' => __('Search Albums', 'lexrider-core'),
            'not_found' => __('No Albums found', 'lexrider-core'),
            'not_found_in_trash' => __('No Albums found in Trash', 'lexrider-core'),
            'parent_item_colon' => __('Parent Album:', 'lexrider-core'),
            'menu_name' => __('Albums', 'lexrider-core'),
        );

        $labels = apply_filters('osf_postype_album_labels', $labels);

        register_post_type($this->post_type,
            array(
                'labels' => $labels,
                'supports' => array('title', 'thumbnail'),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => apply_filters('osf_postype_album_slug', 'album')),
                'menu_position' => 4,
                'categories' => array(),
                'menu_icon' => $this->get_icon(__FILE__)
            )
        );
    }


    public function create_meta_box()
    {
        $cmb = new_cmb2_box(array(
            'id' => 'osf_album',
            'title' => __('Settings', 'lexrider-core'),
            'object_types' => array($this->post_type,), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        ));

        $cmb->add_field(array(
            'name' => 'Photos',
            'id' => 'osf_photos',
            'type' => 'file_list',
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text' => array(
                'add_upload_file_text' => esc_html__('Add Photo', 'lexrider-core')
                // Change upload button text. Default: "Add or Upload File"
            ),
            'query_args' => array(
                'type' => array(
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                ),
            ),
            'preview_size' => 'large', // Image size to use when previewing in the admin.
        ));
    }

    public function body_class($classes)
    {
        if (is_post_type_archive($this->post_type) || is_singular($this->post_type)) {
            $classes = array_diff($classes, array(
                'opal-content-layout-2cl',
                'opal-content-layout-2cr',
                'opal-content-layout-1c'
            ));
            $classes[] = 'opal-content-layout-' . get_theme_mod('osf_room_archive_layout', '1c');
        }

        return $classes;
    }

    public function add_shortcode()
    {
        add_shortcode('opal_albums', function ($atts) {
            $atts = shortcode_atts(array(
                'posts_per_page' => 9,
                'gutter' => '',
                'columns' => 3,
            ), $atts);

            $atts['posts_per_page'] = intval($atts['posts_per_page']);

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $query_args = [
                'post_type' => $this->post_type,
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'posts_per_page' => $atts['posts_per_page'],
                'paged' => $paged
            ];

            $query = new WP_Query($query_args);

            echo '<div class="row" data-elementor-columns="' . esc_attr($atts['columns']) . '">';
            while ($query->have_posts()) {
                $query->the_post();
                $gallery = get_post_meta(get_the_ID(), 'osf_photos', true);
                $is_gallery = is_array($gallery) && count($gallery) > 0;

                ?>
                <div class="column-item album-entries">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('album'); ?>>
                        <div class="album-post-thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('lexrider-featured-image-small'); ?>
                            <?php endif; ?>
                            <div class="album-caption">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                                <?php if ($is_gallery): ?>
                                    <div class="entry-meta-photo h5 c-primary"><?php echo count($gallery) . ' ' . wp_kses_data(_n("Photo", "Photos", count($gallery), "lexrider-core")); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($is_gallery):

                            ?>
                            <div class="opal-photo-action d-none">
                                <?php foreach ($gallery as $id => $url): ?>
                                    <a href="<?php echo esc_url($url); ?>">
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url($id, 'thumbnail')) ?>"/>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
                <?php
            }
            wp_reset_postdata();
            echo '</div>';
            $paginate_args = array(
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'show_all' => false,
                'end_size' => 1,
                'mid_size' => 2,
                'prev_next' => true,
                'type' => 'plain',
                'add_args' => false,
                'prev_text' => '<span class="arrow">&larr;</span><span class="screen-reader-text">' . esc_html__('Previous', 'lexrider-core') . '</span>',
                'next_text' => '<span class="screen-reader-text">' . esc_html__('Next', 'lexrider-core') . '</span><span class="arrow">&rarr;</span>',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Page', 'lexrider-core') . ' </span>',
            );
            $paginate = paginate_links($paginate_args);
            if ($paginate) {
                printf('<nav class="navigation pagination" role="navigation"><div class="nav-links">%s</div></nav>',
                    $paginate
                );
            }
        });
    }
}

return new OSF_Custom_Post_Type_Album();
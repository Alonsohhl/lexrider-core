<?php
if (!defined( 'ABSPATH' )) {
    exit;
}
if (!class_exists( 'OSF_Customize' )){

class OSF_Customize {
    /**
     * @var array
     */
    private $google_fonts;
    
    /**
     * @var string
     */
    private $link_image;
    
    private $theme_domain;

    public function __construct() {
        add_action( 'customize_register', array( $this, 'customize_register' ) );
    }

    /**
     * @param $wp_customize WP_Customize_Manager
     */
    public function customize_register($wp_customize) {
        /**
         * Theme options.
         */
        $this->google_fonts = osf_get_google_fonts();
        $this->link_image   = trailingslashit(get_site_url())  . 'wp-content/plugins/lexrider-core/assets/images/customize/';
        $this->theme_domain = get_template();

        $this->init_osf_typography( $wp_customize );

        $this->init_osf_colors( $wp_customize );

        $this->init_osf_layout( $wp_customize );

        $this->init_osf_header( $wp_customize );

        $this->init_osf_footer( $wp_customize );

        $this->init_osf_blog( $wp_customize );

        $this->init_osf_social( $wp_customize );

        if( otf_is_woocommerce_activated() ){
            $this->init_woocommerce( $wp_customize ); 
        }

        $this->init_osf_maintenance( $wp_customize );
   
        do_action( 'osf_customize_register', $wp_customize );
    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_typography($wp_customize){
    
        $wp_customize->add_panel( 'osf_typography', array(
            'title'          => __( 'Typography', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'priority'       => 1,
        ));

        $wp_customize->add_section( 'osf_typography_general', array(
            'title'          => __( 'General', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_typography', 
            'priority'       => 1, 
        ) );

        if(class_exists('OSF_Customize_Control_Button_Move')){
            $wp_customize->add_setting( 'osf_typography_general_body_button_move', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Move( $wp_customize, 'osf_typography_general_body_button_move', array(
                'section' => 'osf_typography_general',
                'buttons'  => array(
                'osf_colors_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Color',
                ),
                'osf_layout_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Layout',
                ),
            ),
            ) ) );
        }

        // =========================================
        // Primary Font
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_primary_font_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_primary_font_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Primary Font', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Font Family
        // =========================================
        if(class_exists('OSF_Customize_Control_Google_Font')){
            $wp_customize->add_setting( 'osf_typography_general_body_font', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_family',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Google_Font( $wp_customize, 'osf_typography_general_body_font', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Font Family', 'lexrider-core' ),
                'fonts'    => $this->google_fonts,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_general_body_font', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Heading Font
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_secondary_font_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_secondary_font_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Heading Font', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Font Family
        // =========================================
        if(class_exists('OSF_Customize_Control_Google_Font')){
            $wp_customize->add_setting( 'osf_typography_general_heading_font', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_family',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Google_Font( $wp_customize, 'osf_typography_general_heading_font', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Font Family', 'lexrider-core' ),
                'fonts'    => $this->google_fonts,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_general_heading_font', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Tertiary Font
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_tertiary_font_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_tertiary_font_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Tertiary Font', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Font Family
        // =========================================
        if(class_exists('OSF_Customize_Control_Google_Font')){
            $wp_customize->add_setting( 'osf_typography_general_tertiary_font', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_family',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Google_Font( $wp_customize, 'osf_typography_general_tertiary_font', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Font Family', 'lexrider-core' ),
                'fonts'    => $this->google_fonts,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_general_tertiary_font', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Quaternary Font
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_quaternary_font_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_quaternary_font_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Quaternary Font', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Font Family
        // =========================================
        if(class_exists('OSF_Customize_Control_Google_Font')){
            $wp_customize->add_setting( 'osf_typography_general_quaternary_font', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_family',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Google_Font( $wp_customize, 'osf_typography_general_quaternary_font', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Font Family', 'lexrider-core' ),
                'fonts'    => $this->google_fonts,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_general_quaternary_font', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Body
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_body_heading_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_body_heading_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Body', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Font Size
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_typography_general_body_font_size', array(
                'default'           => '15',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_typography_general_body_font_size', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Font Size', 'lexrider-core' ),
                'choices' => array(
                'min' => '10',
                'max' => '25',
                'unit' => 'px',
            ),
            ) ) );
        }

        // =========================================
        // Letter Spacing
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_typography_general_body_letter_spacing', array(
                'default'           => '0',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_typography_general_body_letter_spacing', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Letter Spacing', 'lexrider-core' ),
                'choices' => array(
                'min' => '0',
                'max' => '10',
                'unit' => 'px',
            ),
            ) ) );
        }

        // =========================================
        // Heading
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_typography_general_heading_heading_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_typography_general_heading_heading_title', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Heading', 'lexrider-core' ),
            ) ) );
        }

        if(class_exists('OSF_Customize_Control_Font_Style')){
            $wp_customize->add_setting( 'osf_typography_general_heading_font_style', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_style',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Font_Style( $wp_customize, 'osf_typography_general_heading_font_style', array(
                'section' => 'osf_typography_general',
            ) ) );
        }

        // =========================================
        // Letter Spacing
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_typography_general_heading_letter_spacing', array(
                'default'           => '0',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_typography_general_heading_letter_spacing', array(
                'section' => 'osf_typography_general',
                'label' => __( 'Letter Spacing', 'lexrider-core' ),
                'choices' => array(
                'min' => __( '0', 'lexrider-core' ),
                'max' => __( '10', 'lexrider-core' ),
                'unit' => __( 'px', 'lexrider-core' ),
            ),
            ) ) );
        }

        $wp_customize->add_section( 'osf_typography_button', array(
            'title'          => __( 'Button', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_typography', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Font Family
        // =========================================
        if(class_exists('OSF_Customize_Control_Google_Font')){
            $wp_customize->add_setting( 'osf_typography_button_font_family', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_family',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Google_Font( $wp_customize, 'osf_typography_button_font_family', array(
                'section' => 'osf_typography_button',
                'label' => __( 'Font Family', 'lexrider-core' ),
                'fonts'    => $this->google_fonts,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_button_font_family', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        if(class_exists('OSF_Customize_Control_Font_Style')){
            $wp_customize->add_setting( 'osf_typography_button_font_style', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_font_style',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Font_Style( $wp_customize, 'osf_typography_button_font_style', array(
                'section' => 'osf_typography_button',
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_typography_button_font_style', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Letter Spacing
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_typography_buttom_letter_spacing', array(
                'default'           => '0',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_typography_buttom_letter_spacing', array(
                'section' => 'osf_typography_button',
                'label' => __( 'Letter Spacing', 'lexrider-core' ),
                'choices' => array(
                'min' => __( '0', 'lexrider-core' ),
                'max' => __( '10', 'lexrider-core' ),
                'unit' => __( 'px', 'lexrider-core' ),
            ),
            ) ) );
        }

    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_colors($wp_customize){
    
        $wp_customize->add_panel( 'osf_colors', array(
            'title'          => __( 'Colors', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'priority'       => 1,
        ));

        $wp_customize->add_section( 'osf_colors_general', array(
            'title'          => __( 'General', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_colors', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_general_color_heading_label', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_general_color_heading_label', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Color', 'lexrider-core' ),
                'priority' => 1,
            ) ) );
        }

        // =========================================
        // Primary Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_general_primary', array(
                'default'           => '#0160b4',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_general_primary', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Primary Color', 'lexrider-core' ),
                'priority' => 1,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_general_primary', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Secondary Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_general_secondary', array(
                'default'           => '#00c484',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_general_secondary', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Secondary Color', 'lexrider-core' ),
                'priority' => 1,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_general_secondary', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Heading Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_general_heading', array(
                'default'           => '#111',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_general_heading', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Heading Color', 'lexrider-core' ),
                'priority' => 1,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_general_heading', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Body Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_general_body', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_general_body', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Body Color', 'lexrider-core' ),
                'priority' => 1,
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_general_body', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Body Background
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_general_body_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_general_body_title', array(
                'section' => 'osf_colors_general',
                'label' => __( 'Body Background', 'lexrider-core' ),
                'priority' => 2,
            ) ) );
        }

        if(class_exists('OSF_Customize_Control_Button_Move')){
            $wp_customize->add_setting( 'osf_colors_general_button_move', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Move( $wp_customize, 'osf_colors_general_button_move', array(
                'section' => 'osf_colors_general',
                'buttons'  => array(
                'osf_typography_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Typography',
                ),
                'osf_layout_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Layout',
                ),
            ),
            ) ) );
        }

        $wp_customize->add_section( 'osf_colors_page_title', array(
            'title'          => __( 'Page Title', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_colors', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Background
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_page_title_bg_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_page_title_bg_title', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Background', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // BG Image
        // =========================================
        if(class_exists('WP_Customize_Image_Control')){
            $wp_customize->add_setting( 'osf_colors_page_title_bg_image', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'osf_colors_page_title_bg_image', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'BG Image', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // BG Position
        // =========================================
        if(class_exists('OSF_Customize_Control_Background_Position')){
            $wp_customize->add_setting( 'osf_colors_page_title_bg_position', array(
                'default'           => 'top left',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Background_Position( $wp_customize, 'osf_colors_page_title_bg_position', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'BG Position', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Disable Repeat
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_colors_page_title_bg_repeat', array(
                'default'           => '1',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_colors_page_title_bg_repeat', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Disable Repeat', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // BG Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_page_title_bg', array(
                'default'           => '#fafafa',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_page_title_bg', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'BG Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_page_title_bg', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_page_title_color_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_page_title_color_title', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Color', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Heading Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_page_title_heading_color', array(
                'default'           => '#666',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_page_title_heading_color', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Heading Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_page_title_heading_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Breadcrumb Text Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_page_title_breadcrumb_color', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_page_title_breadcrumb_color', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Breadcrumb Text Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_page_title_breadcrumb_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Breadcrumb Text Color Hover
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_page_title_breadcrumb_color_hover', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_page_title_breadcrumb_color_hover', array(
                'section' => 'osf_colors_page_title',
                'label' => __( 'Breadcrumb Text Color Hover', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_page_title_breadcrumb_color_hover', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        $wp_customize->add_section( 'osf_colors_buttons', array(
            'title'          => __( 'Buttons', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_colors', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Enable Custom
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_colors_buttons_enable_custom', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_colors_buttons_enable_custom', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Enable Custom', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_enable_custom', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Primary Button
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_title_buttons_primary', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_title_buttons_primary', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Primary Button', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Background Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_bg', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_bg', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Background Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_bg', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Border Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_border', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_border', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Border Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_border', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_color', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_color', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color (outline)
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_color_outline', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_color_outline', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color (outline)', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_color_outline', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Primary Button Hover
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_title_buttons_primary_hover', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_title_buttons_primary_hover', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Primary Button Hover', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Background Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_hover_bg', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_hover_bg', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Background Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_hover_bg', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Border Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_hover_border', array(
                'default'           => '#222',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_hover_border', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Border Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_hover_border', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_primary_hover_color', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_primary_hover_color', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_primary_hover_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Secondary Button
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_title_buttons_secondary', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_title_buttons_secondary', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Secondary Button', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Background Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_bg', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_bg', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Background Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_bg', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Border Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_border', array(
                'default'           => '#767676',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_border', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Border Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_border', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_color', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_color', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color (outline)
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_color_outline', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_color_outline', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color (outline)', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_color_outline', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Secondary Button Hover
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_colors_title_buttons_secondary_hover', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_colors_title_buttons_secondary_hover', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Secondary Button Hover', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Background Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_hover_bg', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_hover_bg', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Background Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_hover_bg', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Border Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_hover_border', array(
                'default'           => '#767676',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_hover_border', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Border Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_hover_border', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_colors_buttons_secondary_hover_color', array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_colors_buttons_secondary_hover_color', array(
                'section' => 'osf_colors_buttons',
                'label' => __( 'Color', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_colors_buttons_secondary_hover_color', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_layout($wp_customize){
    
        $wp_customize->add_panel( 'osf_layout', array(
            'title'          => __( 'Layout', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'priority'       => 1,
        ));

        $wp_customize->add_section( 'osf_layout_general', array(
            'title'          => __( 'General', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_layout', 
            'priority'       => 1, 
        ) );

        if(class_exists('OSF_Customize_Control_Button_Group')){
            $wp_customize->add_setting( 'osf_layout_general_layout_mode', array(
                'default'           => 'wide',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Group( $wp_customize, 'osf_layout_general_layout_mode', array(
                'section' => 'osf_layout_general',
                'choices' => array(
                'boxed' => __( 'Boxed', 'lexrider-core' ),
                'wide' => __( 'Wide', 'lexrider-core' ),
            ),
            ) ) );
        }

        // =========================================
        // Boxed Container Width
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_layout_boxed_width', array(
                'default'           => '1170',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_layout_boxed_width', array(
                'section' => 'osf_layout_general',
                'label' => __( 'Boxed Container Width', 'lexrider-core' ),
                'choices' => array(
                'min' => '767',
                'max' => '1920',
                'unit' => 'px',
            ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_layout_general_layout_boxed_width', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Boxed Offset
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_layout_boxed_offset', array(
                'default'           => '0',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_layout_boxed_offset', array(
                'section' => 'osf_layout_general',
                'label' => __( 'Boxed Offset', 'lexrider-core' ),
                'choices' => array(
                'min' => '0',
                'max' => '200',
                'unit' => 'px',
            ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_layout_general_layout_boxed_offset', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Content Width
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Group')){
            $wp_customize->add_setting( 'osf_layout_general_content_width_type', array(
                'default'           => 'px',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Group( $wp_customize, 'osf_layout_general_content_width_type', array(
                'section' => 'osf_layout_general',
                'label' => __( 'Content Width', 'lexrider-core' ),
                'choices' => array(
                'px' => __( 'px', 'lexrider-core' ),
                '%' => __( '%', 'lexrider-core' ),
            ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_layout_general_content_width_type', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_content_width_px', array(
                'default'           => '1170',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_content_width_px', array(
                'section' => 'osf_layout_general',
                'choices' => array(
                'min' => '767',
                'max' => '1920',
                'unit' => 'px',
            ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_layout_general_content_width_px', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_content_width_percent', array(
                'default'           => '100',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_content_width_percent', array(
                'section' => 'osf_layout_general',
                'choices' => array(
                'min' => '20',
                'max' => '100',
                'unit' => '%',
            ),
            ) ) );
        }

        // =========================================
        // Gutter Width
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_gutter_width', array(
                'default'           => '30',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_gutter_width', array(
                'section' => 'osf_layout_general',
                'label' => __( 'Gutter Width', 'lexrider-core' ),
                'choices' => array(
                'min' => '10',
                'max' => '60',
                'unit' => 'px',
            ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_layout_general_gutter_width', array(
            'selector'        => '#osf-style-inline-css-customizer',
            'render_callback' => 'osf_customize_partial_css',
        ) );
        
        // =========================================
        // Content Padding
        // =========================================
        if(class_exists('OSF_Customize_Control_Slider')){
            $wp_customize->add_setting( 'osf_layout_general_content_width_padding', array(
                'default'           => '15',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Slider( $wp_customize, 'osf_layout_general_content_width_padding', array(
                'section' => 'osf_layout_general',
                'label' => __( 'Content Padding', 'lexrider-core' ),
                'choices' => array(
                'min' => '0',
                'max' => '100',
                'unit' => 'px',
            ),
            ) ) );
        }

        if(class_exists('OSF_Customize_Control_Button_Move')){
            $wp_customize->add_setting( 'osf_layout_general_button_move', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Move( $wp_customize, 'osf_layout_general_button_move', array(
                'section' => 'osf_layout_general',
                'buttons'  => array(
                'osf_colors_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Color',
                ),
                'osf_typography_general' => array(
                    'type'  => 'section',
                    'label' => 'Edit Typography',
                ),
            ),
            ) ) );
        }

        $wp_customize->add_section( 'osf_layout_pagination', array(
            'title'          => __( 'Pagination', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_layout', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Select Pagination Style
        // =========================================
        if(class_exists('OSF_Customize_Control_Image_Select')){
            $wp_customize->add_setting( 'osf_layout_pagination_style', array(
                'default'           => '6',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Image_Select( $wp_customize, 'osf_layout_pagination_style', array(
                'section' => 'osf_layout_pagination',
                'label' => __( 'Select Pagination Style', 'lexrider-core' ),
                'choices' => array(
                '1' => esc_url($this->link_image . 'pagination1.jpg'),
                '2' => esc_url($this->link_image . 'pagination2.jpg'),
                '3' => esc_url($this->link_image . 'pagination3.jpg'),
                '4' => esc_url($this->link_image . 'pagination4.jpg'),
                '5' => esc_url($this->link_image . 'pagination5.jpg'),
                '6' => esc_url($this->link_image . 'pagination6.jpg'),
            ),
                'layout' => 'sidebar'
            ) ) );
        }

        $wp_customize->add_section( 'osf_comment_template', array(
            'title'          => __( 'Comment Template', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_layout', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Comment Skin
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_comment_template_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_comment_template_title', array(
                'section' => 'osf_comment_template',
                'label' => __( 'Comment Skin', 'lexrider-core' ),
            ) ) );
        }

        if(class_exists('OSF_Customize_Control_Image_Select')){
            $wp_customize->add_setting( 'osf_comment_template_skin', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Image_Select( $wp_customize, 'osf_comment_template_skin', array(
                'section' => 'osf_comment_template',
                'choices' => array(
                '1' => esc_url($this->link_image . 'comment1.png'),
                '2' => esc_url($this->link_image . 'comment2.png'),
                '3' => esc_url($this->link_image . 'comment3.png'),
                '4' => esc_url($this->link_image . 'comment4.png'),
                '5' => esc_url($this->link_image . 'comment5.png'),
                '6' => esc_url($this->link_image . 'comment6.png'),
                '7' => esc_url($this->link_image . 'comment7.png'),
            ),
                'layout' => 'sidebar'
            ) ) );
        }

        // =========================================
        // Comment Form
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_comment_template_form_title', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_comment_template_form_title', array(
                'section' => 'osf_comment_template',
                'label' => __( 'Comment Form', 'lexrider-core' ),
            ) ) );
        }

        if(class_exists('OSF_Customize_Control_Image_Select')){
            $wp_customize->add_setting( 'osf_comment_template_form', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Image_Select( $wp_customize, 'osf_comment_template_form', array(
                'section' => 'osf_comment_template',
                'choices' => array(
                '1' => esc_url($this->link_image . 'comment_form1.png'),
                '2' => esc_url($this->link_image . 'comment_form2.png'),
                '3' => esc_url($this->link_image . 'comment_form3.png'),
                '4' => esc_url($this->link_image . 'comment_form4.png'),
                '5' => esc_url($this->link_image . 'comment_form5.png'),
                '6' => esc_url($this->link_image . 'comment_form6.png'),
            ),
                'layout' => 'sidebar'
            ) ) );
        }

        $wp_customize->add_section( 'osf_404_page_setting', array(
            'title'          => __( '404 Page Setting', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_layout', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Page Setting
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Group')){
            $wp_customize->add_setting( 'osf_page_404_page_enable', array(
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Group( $wp_customize, 'osf_page_404_page_enable', array(
                'section' => 'osf_404_page_setting',
                'label' => __( 'Page Setting', 'lexrider-core' ),
                'choices' => array(
                'default' => __( 'Default', 'lexrider-core' ),
                'custom' => __( 'Customize', 'lexrider-core' ),
            ),
            ) ) );
        }

        // =========================================
        // 404 Page
        // =========================================
            $wp_customize->add_setting( 'osf_page_404_page_custom', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_page_404_page_custom', array(
            'section' => 'osf_404_page_setting',
            'label' => __( '404 Page', 'lexrider-core' ),
            'type' => 'dropdown-pages',
        ) );

        // =========================================
        // BG Image
        // =========================================
        if(class_exists('WP_Customize_Image_Control')){
            $wp_customize->add_setting( 'osf_page_404_bg_image', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'osf_page_404_bg_image', array(
                'section' => 'osf_404_page_setting',
                'label' => __( 'BG Image', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // BG Position
        // =========================================
        if(class_exists('OSF_Customize_Control_Background_Position')){
            $wp_customize->add_setting( 'osf_page_404_bg_position', array(
                'default'           => 'top left',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Background_Position( $wp_customize, 'osf_page_404_bg_position', array(
                'section' => 'osf_404_page_setting',
                'label' => __( 'BG Position', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Disable Repeat
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_page_404_bg_repeat', array(
                'default'           => '1',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_page_404_bg_repeat', array(
                'section' => 'osf_404_page_setting',
                'label' => __( 'Disable Repeat', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // BG Color
        // =========================================
        if(class_exists('OSF_Customize_Control_Color')){
            $wp_customize->add_setting( 'osf_page_404_bg', array(
                'default'           => '#fafafa',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Color( $wp_customize, 'osf_page_404_bg', array(
                'section' => 'osf_404_page_setting',
                'label' => __( 'BG Color', 'lexrider-core' ),
            ) ) );
        }

    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_header($wp_customize){
    
        $wp_customize->add_section( 'osf_header', array(
            'title'          => __( 'Header', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => '', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_header_layout_side_header_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_header_layout_side_header_heading', array(
                'section' => 'osf_header',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Enable Header Builder
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_header_enable_builder', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_header_enable_builder', array(
                'section' => 'osf_header',
                'label' => __( 'Enable Header Builder', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_header_enable_builder', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Header Builder
        // =========================================
        if(class_exists('OSF_Customize_Control_Headers')){
            $wp_customize->add_setting( 'osf_header_builder', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Headers( $wp_customize, 'osf_header_builder', array(
                'section' => 'osf_header',
                'label' => __( 'Header Builder', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_header_builder', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Fullwidth?
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_header_width', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_header_width', array(
                'section' => 'osf_header',
                'label' => __( 'Fullwidth?', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_header_width', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_footer($wp_customize){
    
        $wp_customize->add_section( 'osf_footer', array(
            'title'          => __( 'Footer', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => '', 
            'priority'       => 1, 
        ) );

        if(class_exists('OSF_Customize_Control_Button_Move')){
            $wp_customize->add_setting( 'osf_footer_button_move', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Move( $wp_customize, 'osf_footer_button_move', array(
                'section' => 'osf_footer',
                'buttons'  => array(
                'osf_typography_footer' => array(
                    'type'  => 'section',
                    'label' => 'Edit Typography',
                ),
            ),
            ) ) );
        }

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_footer_title_layout', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_footer_title_layout', array(
                'section' => 'osf_footer',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Fixed Footer
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_fixed_footer', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_fixed_footer', array(
                'section' => 'osf_footer',
                'label' => __( 'Fixed Footer', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Footers')){
            $wp_customize->add_setting( 'osf_footer_layout', array(
                'default'           => '0',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Footers( $wp_customize, 'osf_footer_layout', array(
                'section' => 'osf_footer',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Copyright
        // =========================================
        if(class_exists('OSF_Customize_Control_Editor')){
            $wp_customize->add_setting( 'osf_footer_copyright', array(
                'default'           => 'Proudly powered by Wpopal.com',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_editor',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Editor( $wp_customize, 'osf_footer_copyright', array(
                'section' => 'osf_footer',
                'label' => __( 'Copyright', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_footer_copyright', array(
            'selector'        => '.site-info > .container',
            'render_callback' => 'osf_customize_partial_copyright',
        ) );
        
        // =========================================
        // Enable Back To Top
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_back_to_top_footer', array(
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_back_to_top_footer', array(
                'section' => 'osf_footer',
                'label' => __( 'Enable Back To Top', 'lexrider-core' ),
            ) ) );
        }

    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_blog($wp_customize){
    
        $wp_customize->add_panel( 'osf_blog', array(
            'title'          => __( 'Blog', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'priority'       => 1,
        ));

        $wp_customize->add_section( 'osf_blog_archive', array(
            'title'          => __( 'Archive', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'osf_blog', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Select Style
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Group')){
            $wp_customize->add_setting( 'osf_blog_archive_style', array(
                'default'           => '0',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Group( $wp_customize, 'osf_blog_archive_style', array(
                'section' => 'osf_blog_archive',
                'label' => __( 'Select Style', 'lexrider-core' ),
                'choices' => array(
                '0' => __( 'default', 'lexrider-core' ),
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( 'timeline', 'lexrider-core' ),
            ),
            ) ) );
        }

    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_social($wp_customize){
    
        $wp_customize->add_section( 'osf_social', array(
            'title'          => __( 'Socials', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => '', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Socials Share
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_social_layout_side_header_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_social_layout_side_header_heading', array(
                'section' => 'osf_social',
                'label' => __( 'Socials Share', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Socials
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_socials', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_socials', array(
                'section' => 'osf_social',
                'label' => __( 'Socials', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_socials', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Facebook
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_facebook', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_facebook', array(
                'section' => 'osf_social',
                'label' => __( 'Facebook', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_facebook', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Twitter
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_twitter', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_twitter', array(
                'section' => 'osf_social',
                'label' => __( 'Twitter', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_twitter', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Linkedin
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_linkedin', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_linkedin', array(
                'section' => 'osf_social',
                'label' => __( 'Linkedin', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_linkedin', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Tumblr
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_tumblr', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_tumblr', array(
                'section' => 'osf_social',
                'label' => __( 'Tumblr', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_tumblr', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Google Plus
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_google_plus', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_google_plus', array(
                'section' => 'osf_social',
                'label' => __( 'Google Plus', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_google_plus', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Pinterest
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_pinterest', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_pinterest', array(
                'section' => 'osf_social',
                'label' => __( 'Pinterest', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_pinterest', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Email
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_email', array(
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_email', array(
                'section' => 'osf_social',
                'label' => __( 'Email', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_email', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_woocommerce($wp_customize){
    
        $wp_customize->add_panel( 'woocommerce', array(
            'title'          => __( 'Woocommerce', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'priority'       => 1,
        ));

        $wp_customize->add_section( 'osf_woocommerce_archive', array(
            'title'          => __( 'Archive', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'woocommerce', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_archive_layout_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_archive_layout_heading', array(
                'section' => 'osf_woocommerce_archive',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Fullwidth?
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_woocommerce_archive_product_width', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_woocommerce_archive_product_width', array(
                'section' => 'osf_woocommerce_archive',
                'label' => __( 'Fullwidth?', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Filter position
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_archive_filter_position', array(
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_archive_filter_position', array(
            'section' => 'osf_woocommerce_archive',
            'label' => __( 'Filter position', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                'none' => __( 'None', 'lexrider-core' ),
                'top' => __( 'Top', 'lexrider-core' ),
                'left' => __( 'Left', 'lexrider-core' ),
                'right' => __( 'Right', 'lexrider-core' ),
            ),
        ) );

        // =========================================
        // Columns
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_archive_columns', array(
                'default'           => '4',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_archive_columns', array(
            'section' => 'osf_woocommerce_archive',
            'label' => __( 'Columns', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( '3', 'lexrider-core' ),
                '4' => __( '4', 'lexrider-core' ),
                '5' => __( '5', 'lexrider-core' ),
                '6' => __( '6', 'lexrider-core' ),
            ),
        ) );

        // =========================================
        // Number product to show
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_archive_number', array(
                'default'           => '12',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_archive_number', array(
            'section' => 'osf_woocommerce_archive',
            'label' => __( 'Number product to show', 'lexrider-core' ),
            'type' => 'number',
        ) );

        // =========================================
        // Product Catalog
        // =========================================
        if(osf_woocommerce_version_check() && class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_archive_catalog_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_archive_catalog_heading', array(
                'section' => 'osf_woocommerce_archive',
                'label' => __( 'Product Catalog', 'lexrider-core' ),
                'priority' => 20,
            ) ) );
        }

        $wp_customize->add_section( 'osf_woocommerce_single', array(
            'title'          => __( 'Single', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'woocommerce', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Image
        // =========================================
        if(osf_woocommerce_version_check() && class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single__image_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single__image_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Image', 'lexrider-core' ),
                'priority' => 8,
            ) ) );
        }

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single_layout_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single_layout_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Fullwidth?
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_woocommerce_single_product_width', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_woocommerce_single_product_width', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Fullwidth?', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Tab Style
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Group')){
            $wp_customize->add_setting( 'osf_woocommerce_single_product_tab_style', array(
                'default'           => 'tab',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Group( $wp_customize, 'osf_woocommerce_single_product_tab_style', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Tab Style', 'lexrider-core' ),
                'choices' => array(
                'tab' => __( 'Tab', 'lexrider-core' ),
                'accordion' => __( 'Accordion', 'lexrider-core' ),
            ),
            ) ) );
        }

        // =========================================
        // Product Gallery
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single_image_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single_image_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Product Gallery', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Columns
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_product_thumbnail_columns', array(
                'default'           => '4',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_product_thumbnail_columns', array(
            'section' => 'osf_woocommerce_single',
            'label' => __( 'Columns', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( '3', 'lexrider-core' ),
                '4' => __( '4', 'lexrider-core' ),
                '5' => __( '5', 'lexrider-core' ),
                '6' => __( '6', 'lexrider-core' ),
            ),
        ) );

        // =========================================
        // Product Upsale
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single_upsale_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single_upsale_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Product Upsale', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Columns
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_single_upsale_columns', array(
                'default'           => '4',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_single_upsale_columns', array(
            'section' => 'osf_woocommerce_single',
            'label' => __( 'Columns', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( '3', 'lexrider-core' ),
                '4' => __( '4', 'lexrider-core' ),
                '5' => __( '5', 'lexrider-core' ),
                '6' => __( '6', 'lexrider-core' ),
            ),
        ) );

        // =========================================
        // Product Related
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single_related_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single_related_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Product Related', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Number product to show
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_single_related_number', array(
                'default'           => '3',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_single_related_number', array(
            'section' => 'osf_woocommerce_single',
            'label' => __( 'Number product to show', 'lexrider-core' ),
            'type' => 'number',
        ) );

        // =========================================
        // Columns
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_single_related_columns', array(
                'default'           => '3',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_single_related_columns', array(
            'section' => 'osf_woocommerce_single',
            'label' => __( 'Columns', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( '3', 'lexrider-core' ),
                '4' => __( '4', 'lexrider-core' ),
                '5' => __( '5', 'lexrider-core' ),
                '6' => __( '6', 'lexrider-core' ),
            ),
        ) );

        // =========================================
        // Product Up-sell
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_single_upsell_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_single_upsell_heading', array(
                'section' => 'osf_woocommerce_single',
                'label' => __( 'Product Up-sell', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Columns
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_single_upsell_columns', array(
                'default'           => '3',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_single_upsell_columns', array(
            'section' => 'osf_woocommerce_single',
            'label' => __( 'Columns', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                '1' => __( '1', 'lexrider-core' ),
                '2' => __( '2', 'lexrider-core' ),
                '3' => __( '3', 'lexrider-core' ),
                '4' => __( '4', 'lexrider-core' ),
                '5' => __( '5', 'lexrider-core' ),
                '6' => __( '6', 'lexrider-core' ),
            ),
        ) );

        $wp_customize->add_section( 'osf_woocommerce_product', array(
            'title'          => __( 'Product', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'woocommerce', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Image
        // =========================================
        if(osf_woocommerce_version_check() && class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_woocommerce_archive__image_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_woocommerce_archive__image_heading', array(
                'section' => 'osf_woocommerce_product',
                'label' => __( 'Image', 'lexrider-core' ),
                'priority' => 8,
            ) ) );
        }

        // =========================================
        // Layout
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'otf_woocommerce_product_layout_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'otf_woocommerce_product_layout_heading', array(
                'section' => 'osf_woocommerce_product',
                'label' => __( 'Layout', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Animation Image Hover
        // =========================================
            $wp_customize->add_setting( 'osf_woocommerce_product_hover', array(
                'default'           => 'none',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_woocommerce_product_hover', array(
            'section' => 'osf_woocommerce_product',
            'label' => __( 'Animation Image Hover', 'lexrider-core' ),
            'type' => 'select',
            'choices' => array(
                'none' => __( 'None', 'lexrider-core' ),
                'bottom-to-top' => __( 'Bottom to Top', 'lexrider-core' ),
                'top-to-bottom' => __( 'Top to Bottom', 'lexrider-core' ),
                'right-to-left' => __( 'Right to Left', 'lexrider-core' ),
                'left-to-right' => __( 'Left to Right', 'lexrider-core' ),
                'swap' => __( 'Swap', 'lexrider-core' ),
                'fade' => __( 'Fade', 'lexrider-core' ),
                'zoom-in' => __( 'Zoom In', 'lexrider-core' ),
                'zoom-out' => __( 'Zoom Out', 'lexrider-core' ),
            ),
        ) );

        $wp_customize->add_section( 'otf_woocommerce_extra', array(
            'title'          => __( 'Extra', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => 'woocommerce', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Enable Product Recently Viewed
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'otf_woocommerce_extra_enable_product_recently_viewed', array(
                'default'           => '1',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'otf_woocommerce_extra_enable_product_recently_viewed', array(
                'section' => 'otf_woocommerce_extra',
                'label' => __( 'Enable Product Recently Viewed', 'lexrider-core' ),
            ) ) );
        }

    }

    /**
     * @param $wp_customize WP_Customize_Manager
     *
     * @return void
     */
    public function init_osf_maintenance($wp_customize){
    
        $wp_customize->add_section( 'osf_maintenance', array(
            'title'          => __( 'Maintenance', 'lexrider-core' ),
            'capability'     => 'edit_theme_options',
            'panel'          => '', 
            'priority'       => 1, 
        ) );

        // =========================================
        // Maintenance Mode
        // =========================================
        if(class_exists('OSF_Customize_Control_Heading')){
            $wp_customize->add_setting( 'osf_maintenance_layout_side_header_heading', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Heading( $wp_customize, 'osf_maintenance_layout_side_header_heading', array(
                'section' => 'osf_maintenance',
                'label' => __( 'Maintenance Mode', 'lexrider-core' ),
            ) ) );
        }

        // =========================================
        // Activated
        // =========================================
        if(class_exists('OSF_Customize_Control_Button_Switch')){
            $wp_customize->add_setting( 'osf_maintenance', array(
                'transport'         => 'postMessage',
                'sanitize_callback' => 'osf_sanitize_button_switch',
            ) );
            $wp_customize->add_control( new OSF_Customize_Control_Button_Switch( $wp_customize, 'osf_maintenance', array(
                'section' => 'osf_maintenance',
                'label' => __( 'Activated', 'lexrider-core' ),
            ) ) );
        }

        $wp_customize->selective_refresh->add_partial( 'osf_maintenance', array(
            'selector'        => '#masthead',
            'render_callback' => 'osf_customize_partial_header_content',
        ) );
        
        // =========================================
        // Maintenance Page
        // =========================================
            $wp_customize->add_setting( 'osf_maintenance_page', array(
                'sanitize_callback' => 'sanitize_text_field',
            ) );
        $wp_customize->add_control( 'osf_maintenance_page', array(
            'section' => 'osf_maintenance',
            'label' => __( 'Maintenance Page', 'lexrider-core' ),
            'type' => 'dropdown-pages',
        ) );

    }

}
}
new OSF_Customize();
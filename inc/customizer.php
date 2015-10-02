<?php
/**
 * marketingblog Theme Customizer
 *
 * @package marketingblog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function marketingblog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

}
add_action( 'customize_register', 'marketingblog_customize_register' );

/**
 * Ootions for WordPress Theme Customizer.
 */
function marketingblog_customizer( $wp_customize ) {

	// add "Blog Style Setting" section
	$wp_customize->add_section( 'marketingblog_general_settings' , array(
		'title'      => esc_html__( 'Blog Style Setting', 'marketingblog' ),
		'priority'   => 10,
	) );
	// add setting for Blog Style
	$wp_customize->add_setting( 'marketingblog_theme_options[blog_style_type]', array(
		'default'           => 'small_thumb',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'marketingblog_blog_style_sanitize'
	) );

	// add Option Control for Blog Style
	$wp_customize->add_control( 'marketingblog_general_settings_blog_style_type', array(
		'label'     => esc_html__( 'Blog Display Style', 'marketingblog' ),
        'settings'   => 'marketingblog_theme_options[blog_style_type]',
		'section'   => 'marketingblog_general_settings',
		'priority'  => 10,
		'type'      => 'radio',
        'choices'    => array(
            'small_thumb'   => 'Small Thumb',
            'big_thumb'     => 'Big Featured Image'
        ),
	) );

    // add setting for Blog Sidebar Position
    $wp_customize->add_setting( 'marketingblog_theme_options[blog_sidebar_position]', array(
        'default'           => 'right',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'marketingblog_blog_sidebar_sanitize'
    ) );

    // add Option Control for Blog Sidebar Position
    $wp_customize->add_control( 'marketingblog_general_settings_blog_sidebar_position', array(
        'label'     => esc_html__( 'Blog Sidebar Position', 'marketingblog' ),
        'settings'   => 'marketingblog_theme_options[blog_sidebar_position]',
        'section'   => 'marketingblog_general_settings',
        'priority'  => 10,
        'type'      => 'radio',
        'choices'    => array(
            'right'   => 'Right Side',
            'left'     => 'Left Side'
        ),
    ) );

    // add "Typography Setting" section
    $wp_customize->add_section( 'marketingblog_typography_settings' , array(
        'title'      => esc_html__( 'Typography Settings', 'marketingblog' ),
        'priority'   => 20,
    ) );

    // add setting for heading Font
    $wp_customize->add_setting( 'marketingblog_theme_options[typo_header]', array(
        'default'           => marketingblog_theme_option( 'typo_header', 'Lato' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Heading font
    $wp_customize->add_control( 'marketingblog_general_settings_typo_header', array(
        'label'     => esc_html__( 'Primary Font', 'marketingblog' ),
        'settings'   => 'marketingblog_theme_options[typo_header]',
        'section'   => 'marketingblog_typography_settings',
        'priority'  => 10,
        'type'      => 'select',
        'choices'    => marketingblog_get_google_fonts_array(),
    ) );

    // add setting for Paragraph Font
    $wp_customize->add_setting( 'marketingblog_theme_options[typo_paragraph]', array(
        'default'           => marketingblog_theme_option( 'typo_paragraph', 'Roboto' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Paragraph font
    $wp_customize->add_control( 'marketingblog_general_settings_typo_paragraph', array(
        'label'     => esc_html__( 'Secondary Font', 'marketingblog' ),
        'settings'   => 'marketingblog_theme_options[typo_paragraph]',
        'section'   => 'marketingblog_typography_settings',
        'priority'  => 10,
        'type'      => 'select',
        'choices'    => marketingblog_get_google_fonts_array(),
    ) );

    // add setting for Primary Color
    $wp_customize->add_setting( 'marketingblog_theme_options[primary_color]', array(
        'default'           => marketingblog_theme_option( 'primary_color', '#000000' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Primary Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marketingblog_theme_options[primary_color]', array(
        'label'        => __( 'Primary Color (for h1-h6 tags)', 'marketingblog' ),
        'section'    => 'marketingblog_typography_settings',
        'settings'   => 'marketingblog_theme_options[primary_color]',
    ) ) );

    // add setting for Secondary Color
    $wp_customize->add_setting( 'marketingblog_theme_options[secondary_color]', array(
        'default'           => marketingblog_theme_option( 'secondary_color', '#000000' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Secondary Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marketingblog_theme_options[secondary_color]', array(
        'label'        => __( 'Secondary Color (for body Texts color)', 'marketingblog' ),
        'section'    => 'marketingblog_typography_settings',
        'settings'   => 'marketingblog_theme_options[secondary_color]',
    ) ) );

    // add setting for Link Color
    $wp_customize->add_setting( 'marketingblog_theme_options[link_color]', array(
        'default'           => marketingblog_theme_option( 'link_color', '#000000' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Link Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marketingblog_theme_options[link_color]', array(
        'label'        => __( 'Link Color', 'marketingblog' ),
        'section'    => 'marketingblog_typography_settings',
        'settings'   => 'marketingblog_theme_options[link_color]',
    ) ) );

    // add setting for Link Color
    $wp_customize->add_setting( 'marketingblog_theme_options[link_hover_color]', array(
        'default'           => marketingblog_theme_option( 'link_color', '#000000' ),
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' =>  'sanitize_text_field'
    ) );

    // add Option Control for Link Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marketingblog_theme_options[link_hover_color]', array(
        'label'        => __( 'Link Hover Color', 'marketingblog' ),
        'section'    => 'marketingblog_typography_settings',
        'settings'   => 'marketingblog_theme_options[link_hover_color]',
    ) ) );


    // add "Footer Setting" section
    $wp_customize->add_section( 'marketingblog_footer_settings' , array(
        'title'      => esc_html__( 'Footer Settings', 'marketingblog' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'marketingblog_theme_options[footer_text]', array(
        'default' => __("Change this texts from Customize -> Footer Settings", 'marketingblog'),
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_textarea',
    ) );

    $wp_customize->add_control( 'marketingblog_footer_text', array(
        'type' => 'textarea',
        'priority' => 10,
        'section' => 'marketingblog_footer_settings',
        'settings'   => 'marketingblog_theme_options[footer_text]',
        'label' => __( 'Footer Copyright Text', 'marketingblog' ),
        'description' => 'This will show at the footer (left) of the site',
    ) );

    // add "Custom CSS and Javascript" section
    $wp_customize->add_section( 'marketingblog_css_js_settings' , array(
        'title'      => esc_html__( 'Custom CSS', 'marketingblog' ),
        'priority'   => 40,
    ) );

    $wp_customize->add_setting( 'marketingblog_custom_css', array(
        'default' => '',
        'type' => 'option',
        'transport' =>  'postMessage',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_textarea',
    ) );

    $wp_customize->add_control( 'marketingblog_custom_css_control', array(
        'type' => 'textarea',
        'priority' => 10,
        'transport' =>  'postMessage',
        'section' => 'marketingblog_css_js_settings',
        'settings'   => 'marketingblog_custom_css',
        'label' => __( 'Custom CSS', 'marketingblog' ),
        'description' => __('Add Your Custom CSS Here', 'marketingblog'),
    ) );


    $wp_customize->remove_section( 'background_image');
    $wp_customize->remove_section( 'colors');
    $wp_customize->remove_control('display_header_text');

}
add_action( 'customize_register', 'marketingblog_customizer' );


function marketingblog_blog_sidebar_sanitize($value = null)
{
    if($value)
        return $value;
    else
        return 'right';
}

function marketingblog_blog_style_sanitize($value = null) {
    if($value)
        return $value;
    else
        return "small-thumb";
}


/**
 * Get the google fonts from the API or in the cache
 *
 * @param  integer $amount
 *
 * @return String
 */
function marketingblog_get_fonts_array()
{
    $cacheDirectory = get_template_directory_uri().'/inc/font_json/';
    $fontFile = $cacheDirectory . 'google-web-fonts.txt';
    $request = wp_remote_get($fontFile);
    $response = wp_remote_retrieve_body( $request );
    $content = json_decode($response);
    return $content->items;
}

function marketingblog_get_google_fonts_array()
{
    $fonts = marketingblog_get_fonts_array();

    $return_fonts = array();
    foreach ( $fonts as $k => $v )
    {
        $return_fonts[$v->family] = $v->family;

    }

    return $return_fonts;
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marketingblog_customize_preview_js() {
    wp_enqueue_script( 'marketingblog-customize-preview', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20150911', true );
}
add_action( 'customize_preview_init', 'marketingblog_customize_preview_js' );



function marketingblog_custom_css(){
    $marketingblog_link_color = marketingblog_theme_option( 'link_color', '#ff6f5a' );
    $marketingblog_primary_color = marketingblog_theme_option( 'primary_color', 'black' );
    ?>
    <style type="text/css">
        h1, h2, h3, h4, h5, h6 {
            color: <?php echo $marketingblog_primary_color; ?>;
            font-family: '<?php echo marketingblog_theme_option( 'typo_header', 'Lato' );?>';
        }
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 span, h2 span, h3 span, h4 span, h5 span, h6 span {
            font-family: '<?php echo marketingblog_theme_option( 'typo_header', 'Lato' );?>';
        }
        body, p, a, span {
            font-family: '<?php echo marketingblog_theme_option( 'typo_paragraph', 'Roboto' );?>', sans-serif;
        }
        a {
            color: <?php echo $marketingblog_link_color; ?>;
        }

        a:hover {
            color: <?php echo marketingblog_theme_option( 'link_hover_color', '#dd8d8d' ); ?>;
        }

        body, p {
            color: <?php echo marketingblog_theme_option( 'secondary_color', '#626262' ); ?>;
        }
        a.featured_blog_cat_link {
            background-color: <?php echo $marketingblog_link_color; ?>;
        }
        .widget a:hover, #footer-area a:hover {
            color: <?php echo $marketingblog_link_color;?>;
        }
        .blog-entry-title a {
            color: <?php echo $marketingblog_primary_color; ?>;
        }
        .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
            color: <?php echo $marketingblog_link_color;?>;
        }
        .post-navigation a:hover, .paging-navigation a:hover {
            color: #FFF;
            background: <?php echo $marketingblog_link_color;?>;
            text-decoration: none;
        }
        .btn-default, .label-default,.tagcloud a:hover {
            background-color: <?php echo $marketingblog_link_color;?>;
            border-color: <?php echo $marketingblog_link_color;?>;
        }
        .page-links span {
            background-color: <?php echo $marketingblog_link_color;?>;
        }
        <?php
            echo get_option( 'marketingblog_custom_css', '' );
        ?>
    </style>
    <?php
}


add_action('wp_footer','marketingblog_custom_css');

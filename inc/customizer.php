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
        'default'           => marketingblog_theme_option( 'link_color', '#ff6f5a' ),
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
        'default'           => marketingblog_theme_option( 'link_color', '#dd8d8d' ),
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

    // add "Pro Version Section" section
    $wp_customize->add_section( 'marketingblog_pro_version' , array(
        'title'      => esc_html__( 'Marketing Blog Pro', 'marketingblog' ),
        'priority'   => 1,
        'description'=> __("For Pro version features and support check this link : <a href='https://themewagon.com/marketingblog/'>MarketingBlog Pro</a>.", 'marketingblog' )
    ) );

    $wp_customize->add_setting( 'marketingblog[pro]', array(
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Info_Control(
        $wp_customize,
        'marketingblog_pro_version_control',
        array(
            'section' => 'marketingblog_pro_version',
            'settings' => 'marketingblog[pro]',
        )
    ));



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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marketingblog_customize_preview_js() {
    wp_enqueue_script( 'marketingblog-customize-preview', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20150911', true );
}
add_action( 'customize_preview_init', 'marketingblog_customize_preview_js' );


function marketingblog_custom_customize_enqueue() {
    wp_enqueue_script( 'fitness-custom-customize', get_template_directory_uri() . '/inc/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'marketingblog_custom_customize_enqueue' );


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

        h1 a:hover, a:hover {
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

if( class_exists( 'WP_Customize_Control' ) ):
    class WP_Customize_Info_Control extends WP_Customize_Control {
        public $type = 'info_control';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            <?php
        }
    }
endif;


function marketingblog_get_google_fonts_array()
{
    $return_fonts = array (
        'Open Sans' => 'Open Sans',
        'Roboto' => 'Roboto',
        'Lato' => 'Lato',
        'Slabo 27px' => 'Slabo 27px',
        'Oswald' => 'Oswald',
        'Roboto Condensed' => 'Roboto Condensed',
        'Lora' => 'Lora',
        'Source Sans Pro' => 'Source Sans Pro',
        'Montserrat' => 'Montserrat',
        'PT Sans' => 'PT Sans',
        'Open Sans Condensed' => 'Open Sans Condensed',
        'Raleway' => 'Raleway',
        'Droid Sans' => 'Droid Sans',
        'Ubuntu' => 'Ubuntu',
        'Roboto Slab' => 'Roboto Slab',
        'Droid Serif' => 'Droid Serif',
        'Merriweather' => 'Merriweather',
        'Arimo' => 'Arimo',
        'PT Sans Narrow' => 'PT Sans Narrow',
        'Noto Sans' => 'Noto Sans',
        'Titillium Web' => 'Titillium Web',
        'Poiret One' => 'Poiret One',
        'PT Serif' => 'PT Serif',
        'Bitter' => 'Bitter',
        'Indie Flower' => 'Indie Flower',
        'Arvo' => 'Arvo',
        'Dosis' => 'Dosis',
        'Fjalla One' => 'Fjalla One',
        'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
        'Lobster' => 'Lobster',
        'Cabin' => 'Cabin',
        'Oxygen' => 'Oxygen',
        'Playfair Display' => 'Playfair Display',
        'Abel' => 'Abel',
        'Hind' => 'Hind',
        'Noto Serif' => 'Noto Serif',
        'Muli' => 'Muli',
        'Alegreya Sans' => 'Alegreya Sans',
        'Nunito' => 'Nunito',
        'Bree Serif' => 'Bree Serif',
        'Candal' => 'Candal',
        'Inconsolata' => 'Inconsolata',
        'Vollkorn' => 'Vollkorn',
        'Francois One' => 'Francois One',
        'Play' => 'Play',
        'Archivo Narrow' => 'Archivo Narrow',
        'Shadows Into Light' => 'Shadows Into Light',
        'Libre Baskerville' => 'Libre Baskerville',
        'Pacifico' => 'Pacifico',
        'Josefin Sans' => 'Josefin Sans',
        'Fira Sans' => 'Fira Sans',
        'Passion One' => 'Passion One',
        'Signika' => 'Signika',
        'Ubuntu Condensed' => 'Ubuntu Condensed',
        'Cuprum' => 'Cuprum',
        'Sigmar One' => 'Sigmar One',
        'Asap' => 'Asap',
        'Maven Pro' => 'Maven Pro',
        'Alegreya' => 'Alegreya',
        'Orbitron' => 'Orbitron',
        'Istok Web' => 'Istok Web',
        'Exo 2' => 'Exo 2',
        'Rokkitt' => 'Rokkitt',
        'Merriweather Sans' => 'Merriweather Sans',
        'Anton' => 'Anton',
        'Crimson Text' => 'Crimson Text',
        'Quicksand' => 'Quicksand',
        'Karla' => 'Karla',
        'Varela Round' => 'Varela Round',
        'Dancing Script' => 'Dancing Script',
        'Righteous' => 'Righteous',
        'Exo' => 'Exo',
        'PT Sans Caption' => 'PT Sans Caption',
        'Monda' => 'Monda',
        'Bangers' => 'Bangers',
        'Questrial' => 'Questrial',
        'Pathway Gothic One' => 'Pathway Gothic One',
        'Architects Daughter' => 'Architects Daughter',
        'Abril Fatface' => 'Abril Fatface',
        'Josefin Slab' => 'Josefin Slab',
        'Patua One' => 'Patua One',
        'Source Code Pro' => 'Source Code Pro',
        'Covered By Your Grace' => 'Covered By Your Grace',
        'Armata' => 'Armata',
        'Crete Round' => 'Crete Round',
        'Ropa Sans' => 'Ropa Sans',
        'Chewy' => 'Chewy',
        'Amatic SC' => 'Amatic SC',
        'Gloria Hallelujah' => 'Gloria Hallelujah',
        'BenchNine' => 'BenchNine',
        'News Cycle' => 'News Cycle',
        'Old Standard TT' => 'Old Standard TT',
        'Quattrocento Sans' => 'Quattrocento Sans',
        'Pontano Sans' => 'Pontano Sans',
        'Gudea' => 'Gudea',
        'EB Garamond' => 'EB Garamond',
        'Noticia Text' => 'Noticia Text',
        'Kaushan Script' => 'Kaushan Script',
        'Lateef' => 'Lateef',
        'ABeeZee' => 'ABeeZee',
        'Voltaire' => 'Voltaire',
        'Hammersmith One' => 'Hammersmith One',
        'Ruda' => 'Ruda',
        'Comfortaa' => 'Comfortaa',
        'Sanchez' => 'Sanchez',
        'Lobster Two' => 'Lobster Two',
        'Tinos' => 'Tinos',
        'Fredoka One' => 'Fredoka One',
        'Cantarell' => 'Cantarell',
        'Cinzel' => 'Cinzel',
        'Alfa Slab One' => 'Alfa Slab One',
        'Archivo Black' => 'Archivo Black',
        'Shadows Into Light Two' => 'Shadows Into Light Two',
        'Slackey' => 'Slackey',
        'Coming Soon' => 'Coming Soon',
        'Courgette' => 'Courgette',
        'Rock Salt' => 'Rock Salt',
        'Philosopher' => 'Philosopher',
        'Kreon' => 'Kreon',
        'Cabin Condensed' => 'Cabin Condensed',
        'Sintony' => 'Sintony',
        'Satisfy' => 'Satisfy',
        'Varela' => 'Varela',
        'Russo One' => 'Russo One',
        'Andada' => 'Andada',
        'Bevan' => 'Bevan',
        'Cookie' => 'Cookie',
        'Economica' => 'Economica',
        'Chivo' => 'Chivo',
        'Amiri' => 'Amiri',
        'Handlee' => 'Handlee',
        'Playball' => 'Playball',
        'Paytone One' => 'Paytone One',
        'Changa One' => 'Changa One',
        'Didact Gothic' => 'Didact Gothic',
        'Tangerine' => 'Tangerine',
        'Permanent Marker' => 'Permanent Marker',
        'Fugaz One' => 'Fugaz One',
        'Fauna One' => 'Fauna One',
        'Cardo' => 'Cardo',
        'Pinyon Script' => 'Pinyon Script',
        'Quattrocento' => 'Quattrocento',
        'Jura' => 'Jura',
        'Nobile' => 'Nobile',
        'Antic Slab' => 'Antic Slab',
        'Gentium Book Basic' => 'Gentium Book Basic',
        'Amaranth' => 'Amaranth',
        'Droid Sans Mono' => 'Droid Sans Mono',
        'Damion' => 'Damion',
        'Vidaloka' => 'Vidaloka',
        'Special Elite' => 'Special Elite',
        'Advent Pro' => 'Advent Pro',
        'Domine' => 'Domine',
        'Signika Negative' => 'Signika Negative',
        'Squada One' => 'Squada One',
        'Great Vibes' => 'Great Vibes',
        'Scada' => 'Scada',
        'Marck Script' => 'Marck Script',
        'Molengo' => 'Molengo',
        'Marvel' => 'Marvel',
        'Patrick Hand' => 'Patrick Hand',
        'Days One' => 'Days One',
        'Rambla' => 'Rambla',
        'Delius' => 'Delius',
        'Luckiest Guy' => 'Luckiest Guy',
        'Playfair Display SC' => 'Playfair Display SC',
        'Actor' => 'Actor',
        'Sorts Mill Goudy' => 'Sorts Mill Goudy',
        'Enriqueta' => 'Enriqueta',
        'Oleo Script' => 'Oleo Script',
        'Allerta' => 'Allerta',
        'Audiowide' => 'Audiowide',
        'Marmelad' => 'Marmelad',
        'Neuton' => 'Neuton',
        'Bubblegum Sans' => 'Bubblegum Sans',
        'Limelight' => 'Limelight',
        'Calligraffitti' => 'Calligraffitti',
        'Viga' => 'Viga',
        'Niconne' => 'Niconne',
        'Ultra' => 'Ultra',
        'Basic' => 'Basic',
        'Khula' => 'Khula',
        'Glegoo' => 'Glegoo',
        'Julius Sans One' => 'Julius Sans One',
        'Contrail One' => 'Contrail One',
        'Lusitana' => 'Lusitana',
        'Just Another Hand' => 'Just Another Hand',
        'Volkhov' => 'Volkhov',
        'Arapey' => 'Arapey',
        'Six Caps' => 'Six Caps',
        'Doppio One' => 'Doppio One',
        'Copse' => 'Copse',
        'Bad Script' => 'Bad Script',
        'Cantata One' => 'Cantata One',
        'Montez' => 'Montez',
        'Walter Turncoat' => 'Walter Turncoat',
        'Waiting for the Sunrise' => 'Waiting for the Sunrise',
        'Homenaje' => 'Homenaje',
        'Alegreya Sans SC' => 'Alegreya Sans SC',
        'Electrolize' => 'Electrolize',
        'Coda' => 'Coda',
        'Denk One' => 'Denk One',
        'Carme' => 'Carme',
        'Syncopate' => 'Syncopate',
        'Cherry Cream Soda' => 'Cherry Cream Soda',
        'Cutive' => 'Cutive',
        'Podkova' => 'Podkova',
        'Quantico' => 'Quantico',
        'Antic' => 'Antic',
        'Overlock' => 'Overlock',
        'Jockey One' => 'Jockey One',
        'Share' => 'Share',
        'Nothing You Could Do' => 'Nothing You Could Do',
        'Nixie One' => 'Nixie One',
        'Rajdhani' => 'Rajdhani',
        'Berkshire Swash' => 'Berkshire Swash',
        'Gochi Hand' => 'Gochi Hand',
        'Reenie Beanie' => 'Reenie Beanie',
        'Trocchi' => 'Trocchi',
        'Crafty Girls' => 'Crafty Girls',
        'Kameron' => 'Kameron',
        'Alice' => 'Alice',
        'Acme' => 'Acme',
        'Homemade Apple' => 'Homemade Apple',
        'Michroma' => 'Michroma',
        'Average' => 'Average',
        'Fontdiner Swanky' => 'Fontdiner Swanky',
        'Boogaloo' => 'Boogaloo',
        'Alex Brush' => 'Alex Brush',
        'Montserrat Alternates' => 'Montserrat Alternates',
        'Aldrich' => 'Aldrich',
        'Gentium Basic' => 'Gentium Basic',
        'Sacramento' => 'Sacramento',
        'Mako' => 'Mako',
        'Ubuntu Mono' => 'Ubuntu Mono',
        'Carrois Gothic' => 'Carrois Gothic',
        'Fredericka the Great' => 'Fredericka the Great',
        'Telex' => 'Telex',
        'PT Serif Caption' => 'PT Serif Caption',
        'Adamina' => 'Adamina',
        'Yellowtail' => 'Yellowtail',
        'Press Start 2P' => 'Press Start 2P',
        'Rancho' => 'Rancho',
        'Coustard' => 'Coustard',
        'Spinnaker' => 'Spinnaker',
        'Rochester' => 'Rochester',
        'Neucha' => 'Neucha',
        'Allerta Stencil' => 'Allerta Stencil',
        'Ceviche One' => 'Ceviche One',
        'Puritan' => 'Puritan',
        'Belleza' => 'Belleza',
        'Convergence' => 'Convergence',
        'Source Serif Pro' => 'Source Serif Pro',
        'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
        'Prata' => 'Prata',
        'Megrim' => 'Megrim',
        'Oranienbaum' => 'Oranienbaum',
        'Frijole' => 'Frijole',
        'Cabin Sketch' => 'Cabin Sketch',
        'Radley' => 'Radley',
        'Aclonica' => 'Aclonica',
        'Arbutus Slab' => 'Arbutus Slab',
        'Black Ops One' => 'Black Ops One',
        'Rosario' => 'Rosario',
        'Fanwood Text' => 'Fanwood Text',
        'Nova Square' => 'Nova Square',
        'Racing Sans One' => 'Racing Sans One',
        'Allura' => 'Allura',
        'Freckle Face' => 'Freckle Face',
        'Work Sans' => 'Work Sans',
        'Forum' => 'Forum',
        'Ek Mukta' => 'Ek Mukta',
        'Lilita One' => 'Lilita One',
        'Magra' => 'Magra',
        'IM Fell English' => 'IM Fell English',
        'Parisienne' => 'Parisienne',
        'Fenix' => 'Fenix',
        'Schoolbell' => 'Schoolbell',
        'Marcellus' => 'Marcellus',
        'Poller One' => 'Poller One',
        'Port Lligat Slab' => 'Port Lligat Slab',
        'Alef' => 'Alef',
        'Inder' => 'Inder',
        'Sansita One' => 'Sansita One',
        'Alike' => 'Alike',
        'Alegreya SC' => 'Alegreya SC',
        'Metrophobic' => 'Metrophobic',
        'Yantramanav' => 'Yantramanav',
        'Cinzel Decorative' => 'Cinzel Decorative',
        'Duru Sans' => 'Duru Sans',
        'Hanuman' => 'Hanuman',
        'Marcellus SC' => 'Marcellus SC',
        'Halant' => 'Halant',
        'Tauri' => 'Tauri',
        'Cousine' => 'Cousine',
        'PT Mono' => 'PT Mono',
        'Tenor Sans' => 'Tenor Sans',
        'Kotta One' => 'Kotta One',
        'Chelsea Market' => 'Chelsea Market',
        'Allan' => 'Allan',
        'Mallanna' => 'Mallanna',
        'Lemon' => 'Lemon',
        'Finger Paint' => 'Finger Paint',
        'Yesteryear' => 'Yesteryear',
        'Just Me Again Down Here' => 'Just Me Again Down Here',
        'Timmana' => 'Timmana',
        'Capriola' => 'Capriola',
        'Unica One' => 'Unica One',
        'Gruppo' => 'Gruppo',
        'Roboto Mono' => 'Roboto Mono',
        'Carter One' => 'Carter One',
        'Average Sans' => 'Average Sans',
        'Unkempt' => 'Unkempt',
        'Leckerli One' => 'Leckerli One',
        'Grand Hotel' => 'Grand Hotel',
        'Baumans' => 'Baumans',
        'Petit Formal Script' => 'Petit Formal Script',
        'Lustria' => 'Lustria',
        'Knewave' => 'Knewave',
        'Lily Script One' => 'Lily Script One',
        'Gilda Display' => 'Gilda Display',
        'Londrina Solid' => 'Londrina Solid',
        'Annie Use Your Telescope' => 'Annie Use Your Telescope',
        'Italianno' => 'Italianno',
        'Kelly Slab' => 'Kelly Slab',
        'Kalam' => 'Kalam',
        'The Girl Next Door' => 'The Girl Next Door',
        'Voces' => 'Voces',
        'Henny Penny' => 'Henny Penny',
        'Caudex' => 'Caudex',
        'Anaheim' => 'Anaheim',
        'IM Fell DW Pica' => 'IM Fell DW Pica',
        'Corben' => 'Corben',
        'Imprima' => 'Imprima',
        'Creepster' => 'Creepster',
        'Give You Glory' => 'Give You Glory',
        'Belgrano' => 'Belgrano',
        'Khmer' => 'Khmer',
        'Crushed' => 'Crushed',
        'Ovo' => 'Ovo',
        'Fjord One' => 'Fjord One',
        'Rufina' => 'Rufina',
        'Sue Ellen Francisco' => 'Sue Ellen Francisco',
        'Andika' => 'Andika',
        'Oxygen Mono' => 'Oxygen Mono',
        'Norican' => 'Norican',
        'Merienda One' => 'Merienda One',
        'Cambay' => 'Cambay',
        'Brawler' => 'Brawler',
        'Strait' => 'Strait',
        'Judson' => 'Judson',
        'Graduate' => 'Graduate',
        'Gravitas One' => 'Gravitas One',
        'Slabo 13px' => 'Slabo 13px',
        'Merienda' => 'Merienda',
        'Sarala' => 'Sarala',
        'Titan One' => 'Titan One',
        'Caesar Dressing' => 'Caesar Dressing',
        'Patrick Hand SC' => 'Patrick Hand SC',
        'Bowlby One' => 'Bowlby One',
        'Love Ya Like A Sister' => 'Love Ya Like A Sister',
        'La Belle Aurore' => 'La Belle Aurore',
        'Salsa' => 'Salsa',
        'Clicker Script' => 'Clicker Script',
        'Bentham' => 'Bentham',
        'Skranji' => 'Skranji',
        'Mr De Haviland' => 'Mr De Haviland',
        'Monoton' => 'Monoton',
        'Mystery Quest' => 'Mystery Quest',
        'Khand' => 'Khand',
        'Kranky' => 'Kranky',
        'Orienta' => 'Orienta',
        'GFS Didot' => 'GFS Didot',
        'Pompiere' => 'Pompiere',
        'VT323' => 'VT323',
        'Loved by the King' => 'Loved by the King',
        'Headland One' => 'Headland One',
        'Simonetta' => 'Simonetta',
        'Wire One' => 'Wire One',
        'Spicy Rice' => 'Spicy Rice',
        'Happy Monkey' => 'Happy Monkey',
        'Lekton' => 'Lekton',
        'Quando' => 'Quando',
        'Molle' => 'Molle',
        'Shanti' => 'Shanti',
        'Teko' => 'Teko',
        'Euphoria Script' => 'Euphoria Script',
        'Tienne' => 'Tienne',
        'Amethysta' => 'Amethysta',
        'Prosto One' => 'Prosto One',
        'Trade Winds' => 'Trade Winds',
        'Share Tech' => 'Share Tech',
        'Bowlby One SC' => 'Bowlby One SC',
        'Seaweed Script' => 'Seaweed Script',
        'Iceland' => 'Iceland',
        'Anonymous Pro' => 'Anonymous Pro',
        'Poly' => 'Poly',
        'Carrois Gothic SC' => 'Carrois Gothic SC',
        'IM Fell English SC' => 'IM Fell English SC',
        'Averia Gruesa Libre' => 'Averia Gruesa Libre',
        'Over the Rainbow' => 'Over the Rainbow',
        'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
        'Sniglet' => 'Sniglet',
        'Englebert' => 'Englebert',
        'Kristi' => 'Kristi',
        'UnifrakturMaguntia' => 'UnifrakturMaguntia',
        'Cambo' => 'Cambo',
        'Stalemate' => 'Stalemate',
        'Gafata' => 'Gafata',
        'Qwigley' => 'Qwigley',
        'Italiana' => 'Italiana',
        'Chau Philomene One' => 'Chau Philomene One',
        'Biryani' => 'Biryani',
        'Oregano' => 'Oregano',
        'Numans' => 'Numans',
        'Mountains of Christmas' => 'Mountains of Christmas',
        'Cantora One' => 'Cantora One',
        'Short Stack' => 'Short Stack',
        'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
        'Prociono' => 'Prociono',
        'Griffy' => 'Griffy',
        'Delius Swash Caps' => 'Delius Swash Caps',
        'Geo' => 'Geo',
        'Buenard' => 'Buenard',
        'Arizonia' => 'Arizonia',
        'Aladin' => 'Aladin',
        'Meddon' => 'Meddon',
        'Metamorphous' => 'Metamorphous',
        'Mate' => 'Mate',
        'Concert One' => 'Concert One',
        'Yeseva One' => 'Yeseva One',
        'Nova Mono' => 'Nova Mono',
        'Federo' => 'Federo',
        'Stardos Stencil' => 'Stardos Stencil',
        'Oldenburg' => 'Oldenburg',
        'Expletus Sans' => 'Expletus Sans',
        'Vast Shadow' => 'Vast Shadow',
        'Unna' => 'Unna',
        'Mr Dafoe' => 'Mr Dafoe',
        'Vibur' => 'Vibur',
        'Rationale' => 'Rationale',
        'Ledger' => 'Ledger',
        'Mate SC' => 'Mate SC',
        'Uncial Antiqua' => 'Uncial Antiqua',
        'IM Fell Double Pica' => 'IM Fell Double Pica',
        'Kite One' => 'Kite One',
        'Mouse Memoirs' => 'Mouse Memoirs',
        'Engagement' => 'Engagement',
        'Life Savers' => 'Life Savers',
        'Holtwood One SC' => 'Holtwood One SC',
        'Cedarville Cursive' => 'Cedarville Cursive',
        'Dawning of a New Day' => 'Dawning of a New Day',
        'Kavoon' => 'Kavoon',
        'Gabriela' => 'Gabriela',
        'Averia Sans Libre' => 'Averia Sans Libre',
        'Sofia' => 'Sofia',
        'Ruslan Display' => 'Ruslan Display',
        'Cutive Mono' => 'Cutive Mono',
        'Flamenco' => 'Flamenco',
        'Shojumaru' => 'Shojumaru',
        'Medula One' => 'Medula One',
        'Esteban' => 'Esteban',
        'Tulpen One' => 'Tulpen One',
        'Zeyada' => 'Zeyada',
        'Londrina Outline' => 'Londrina Outline',
        'Poppins' => 'Poppins',
        'Maiden Orange' => 'Maiden Orange',
        'Junge' => 'Junge',
        'Bilbo Swash Caps' => 'Bilbo Swash Caps',
        'Codystar' => 'Codystar',
        'Balthazar' => 'Balthazar',
        'Suwannaphum' => 'Suwannaphum',
        'Rubik One' => 'Rubik One',
        'Dorsa' => 'Dorsa',
        'Cherry Swash' => 'Cherry Swash',
        'Rubik' => 'Rubik',
        'Share Tech Mono' => 'Share Tech Mono',
        'Averia Serif Libre' => 'Averia Serif Libre',
        'Martel' => 'Martel',
        'Monofett' => 'Monofett',
        'Coda Caption' => 'Coda Caption',
        'IM Fell French Canon' => 'IM Fell French Canon',
        'Snowburst One' => 'Snowburst One',
        'Delius Unicase' => 'Delius Unicase',
        'Sancreek' => 'Sancreek',
        'Stint Ultra Condensed' => 'Stint Ultra Condensed',
        'Piedra' => 'Piedra',
        'Amarante' => 'Amarante',
        'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
        'Keania One' => 'Keania One',
        'Rouge Script' => 'Rouge Script',
        'Donegal One' => 'Donegal One',
        'Artifika' => 'Artifika',
        'Cagliostro' => 'Cagliostro',
        'Raleway Dots' => 'Raleway Dots',
        'Gurajada' => 'Gurajada',
        'Habibi' => 'Habibi',
        'Sunshiney' => 'Sunshiney',
        'Wendy One' => 'Wendy One',
        'Rye' => 'Rye',
        'Condiment' => 'Condiment',
        'Sonsie One' => 'Sonsie One',
        'Galindo' => 'Galindo',
        'Stint Ultra Expanded' => 'Stint Ultra Expanded',
        'IM Fell Great Primer' => 'IM Fell Great Primer',
        'Inika' => 'Inika',
        'Stoke' => 'Stoke',
        'Aguafina Script' => 'Aguafina Script',
        'Karma' => 'Karma',
        'Milonga' => 'Milonga',
        'Paprika' => 'Paprika',
        'Fondamento' => 'Fondamento',
        'Ruluko' => 'Ruluko',
        'Scheherazade' => 'Scheherazade',
        'Rosarivo' => 'Rosarivo',
        'Nova Round' => 'Nova Round',
        'Overlock SC' => 'Overlock SC',
        'Sail' => 'Sail',
        'Ramabhadra' => 'Ramabhadra',
        'McLaren' => 'McLaren',
        'Quintessential' => 'Quintessential',
        'Offside' => 'Offside',
        'New Rocker' => 'New Rocker',
        'IM Fell French Canon SC' => 'IM Fell French Canon SC',
        'Sarpanch' => 'Sarpanch',
        'Redressed' => 'Redressed',
        'MedievalSharp' => 'MedievalSharp',
        'Port Lligat Sans' => 'Port Lligat Sans',
        'Text Me One' => 'Text Me One',
        'Jacques Francois' => 'Jacques Francois',
        'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
        'Averia Libre' => 'Averia Libre',
        'Wallpoet' => 'Wallpoet',
        'Battambang' => 'Battambang',
        'Snippet' => 'Snippet',
        'Buda' => 'Buda',
        'Krona One' => 'Krona One',
        'Swanky and Moo Moo' => 'Swanky and Moo Moo',
        'Nosifer' => 'Nosifer',
        'Fira Mono' => 'Fira Mono',
        'Pirata One' => 'Pirata One',
        'Antic Didone' => 'Antic Didone',
        'Linden Hill' => 'Linden Hill',
        'Asul' => 'Asul',
        'Dynalight' => 'Dynalight',
        'Miltonian Tattoo' => 'Miltonian Tattoo',
        'Trykker' => 'Trykker',
        'Bigshot One' => 'Bigshot One',
        'Nova Slim' => 'Nova Slim',
        'Bilbo' => 'Bilbo',
        'Atomic Age' => 'Atomic Age',
        'Fresca' => 'Fresca',
        'Sarina' => 'Sarina',
        'Alike Angular' => 'Alike Angular',
        'League Script' => 'League Script',
        'Angkor' => 'Angkor',
        'UnifrakturCook' => 'UnifrakturCook',
        'Wellfleet' => 'Wellfleet',
        'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
        'Miniver' => 'Miniver',
        'Della Respira' => 'Della Respira',
        'Autour One' => 'Autour One',
        'Warnes' => 'Warnes',
        'Spirax' => 'Spirax',
        'Julee' => 'Julee',
        'Mandali' => 'Mandali',
        'Germania One' => 'Germania One',
        'Kenia' => 'Kenia',
        'Jolly Lodger' => 'Jolly Lodger',
        'Montaga' => 'Montaga',
        'Trochut' => 'Trochut',
        'Glass Antiqua' => 'Glass Antiqua',
        'Rammetto One' => 'Rammetto One',
        'Iceberg' => 'Iceberg',
        'Ruthie' => 'Ruthie',
        'Kurale' => 'Kurale',
        'Lovers Quarrel' => 'Lovers Quarrel',
        'Plaster' => 'Plaster',
        'Sofadi One' => 'Sofadi One',
        'Ribeye' => 'Ribeye',
        'Bokor' => 'Bokor',
        'Elsie' => 'Elsie',
        'Mrs Saint Delafield' => 'Mrs Saint Delafield',
        'Irish Grover' => 'Irish Grover',
        'Astloch' => 'Astloch',
        'Nova Flat' => 'Nova Flat',
        'Passero One' => 'Passero One',
        'Nokora' => 'Nokora',
        'Elsie Swash Caps' => 'Elsie Swash Caps',
        'Ribeye Marrow' => 'Ribeye Marrow',
        'Montserrat Subrayada' => 'Montserrat Subrayada',
        'Modern Antiqua' => 'Modern Antiqua',
        'Galdeano' => 'Galdeano',
        'Akronim' => 'Akronim',
        'Ranchers' => 'Ranchers',
        'Chango' => 'Chango',
        'GFS Neohellenic' => 'GFS Neohellenic',
        'Vampiro One' => 'Vampiro One',
        'Geostar Fill' => 'Geostar Fill',
        'Smythe' => 'Smythe',
        'Peralta' => 'Peralta',
        'Bubbler One' => 'Bubbler One',
        'Lancelot' => 'Lancelot',
        'Palanquin' => 'Palanquin',
        'Eagle Lake' => 'Eagle Lake',
        'Joti One' => 'Joti One',
        'Goblin One' => 'Goblin One',
        'Almendra' => 'Almendra',
        'Rum Raisin' => 'Rum Raisin',
        'Palanquin Dark' => 'Palanquin Dark',
        'Jacques Francois Shadow' => 'Jacques Francois Shadow',
        'Combo' => 'Combo',
        'Devonshire' => 'Devonshire',
        'Miltonian' => 'Miltonian',
        'Petrona' => 'Petrona',
        'Dangrek' => 'Dangrek',
        'Monsieur La Doulaise' => 'Monsieur La Doulaise',
        'Nova Script' => 'Nova Script',
        'Martel Sans' => 'Martel Sans',
        'Koulen' => 'Koulen',
        'Emilys Candy' => 'Emilys Candy',
        'Asset' => 'Asset',
        'Butcherman' => 'Butcherman',
        'Smokum' => 'Smokum',
        'Catamaran' => 'Catamaran',
        'Marko One' => 'Marko One',
        'Diplomata' => 'Diplomata',
        'Original Surfer' => 'Original Surfer',
        'Chicle' => 'Chicle',
        'Mrs Sheppards' => 'Mrs Sheppards',
        'Emblema One' => 'Emblema One',
        'Metal Mania' => 'Metal Mania',
        'Butterfly Kids' => 'Butterfly Kids',
        'Odor Mean Chey' => 'Odor Mean Chey',
        'Nova Oval' => 'Nova Oval',
        'Croissant One' => 'Croissant One',
        'Nova Cut' => 'Nova Cut',
        'Romanesco' => 'Romanesco',
        'Margarine' => 'Margarine',
        'Gorditas' => 'Gorditas',
        'Faster One' => 'Faster One',
        'Aubrey' => 'Aubrey',
        'Federant' => 'Federant',
        'Geostar' => 'Geostar',
        'Laila' => 'Laila',
        'Freehand' => 'Freehand',
        'Revalia' => 'Revalia',
        'Kdam Thmor' => 'Kdam Thmor',
        'Felipa' => 'Felipa',
        'Ewert' => 'Ewert',
        'Eater' => 'Eater',
        'Moul' => 'Moul',
        'Londrina Shadow' => 'Londrina Shadow',
        'Londrina Sketch' => 'Londrina Sketch',
        'Moulpali' => 'Moulpali',
        'Miss Fajardose' => 'Miss Fajardose',
        'Seymour One' => 'Seymour One',
        'Erica One' => 'Erica One',
        'Fascinate' => 'Fascinate',
        'Supermercado One' => 'Supermercado One',
        'Vesper Libre' => 'Vesper Libre',
        'Purple Purse' => 'Purple Purse',
        'Kantumruy' => 'Kantumruy',
        'Diplomata SC' => 'Diplomata SC',
        'Underdog' => 'Underdog',
        'Meie Script' => 'Meie Script',
        'Princess Sofia' => 'Princess Sofia',
        'Macondo Swash Caps' => 'Macondo Swash Caps',
        'Risque' => 'Risque',
        'Bigelow Rules' => 'Bigelow Rules',
        'Sevillana' => 'Sevillana',
        'Ranga' => 'Ranga',
        'Jaldi' => 'Jaldi',
        'Ramaraja' => 'Ramaraja',
        'Mr Bedfort' => 'Mr Bedfort',
        'Arbutus' => 'Arbutus',
        'Almendra SC' => 'Almendra SC',
        'Sirin Stencil' => 'Sirin Stencil',
        'Stalinist One' => 'Stalinist One',
        'Itim' => 'Itim',
        'Dr Sugiyama' => 'Dr Sugiyama',
        'NTR' => 'NTR',
        'Content' => 'Content',
        'Siemreap' => 'Siemreap',
        'Metal' => 'Metal',
        'Bayon' => 'Bayon',
        'Chela One' => 'Chela One',
        'Macondo' => 'Macondo',
        'Taprom' => 'Taprom',
        'Jim Nightshade' => 'Jim Nightshade',
        'Ruge Boogie' => 'Ruge Boogie',
        'Rozha One' => 'Rozha One',
        'Flavors' => 'Flavors',
        'Suranna' => 'Suranna',
        'Preahvihear' => 'Preahvihear',
        'Bonbon' => 'Bonbon',
        'Dekko' => 'Dekko',
        'Sumana' => 'Sumana',
        'Chonburi' => 'Chonburi',
        'Kadwa' => 'Kadwa',
        'Amita' => 'Amita',
        'Arya' => 'Arya',
        'Chenla' => 'Chenla',
        'Eczar' => 'Eczar',
        'Dhurjati' => 'Dhurjati',
        'Fasthand' => 'Fasthand',
        'Tenali Ramakrishna' => 'Tenali Ramakrishna',
        'Gidugu' => 'Gidugu',
        'Almendra Display' => 'Almendra Display',
        'Pragati Narrow' => 'Pragati Narrow',
        'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
        'Fascinate Inline' => 'Fascinate Inline',
        'Hanalei' => 'Hanalei',
        'Suravaram' => 'Suravaram',
        'Rubik Mono One' => 'Rubik Mono One',
        'Hind Vadodara' => 'Hind Vadodara',
        'Unlock' => 'Unlock',
        'Tillana' => 'Tillana',
        'Lakki Reddy' => 'Lakki Reddy',
        'Inknut Antiqua' => 'Inknut Antiqua',
        'Hanalei Fill' => 'Hanalei Fill',
        'Fruktur' => 'Fruktur',
        'Peddana' => 'Peddana',
        'Asar' => 'Asar',
        'Rhodium Libre' => 'Rhodium Libre',
        'Hind Siliguri' => 'Hind Siliguri',
        'Sura' => 'Sura',
        'Modak' => 'Modak',
        'Ravi Prakash' => 'Ravi Prakash',
        'Sahitya' => 'Sahitya',
    );

    return $return_fonts;
}

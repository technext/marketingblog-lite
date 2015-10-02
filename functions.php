<?php
/**
 * marketingblog functions and definitions
 *
 * @package marketingblog
 */




/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 750; /* pixels */
}


if ( ! function_exists( 'marketingblog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marketingblog_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   */
  load_theme_textdomain( 'marketingblog', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  add_image_size( 'marketingblog-featured', 770);
  add_image_size( 'tab-small', 60, 60 , true); // Small Thumbnail
  add_image_size( 'marketingblog-blog-featured', 500);

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary'      => esc_html__( 'Primary Menu', 'marketingblog' )
  ) );

  // Enable support for Post Formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'marketingblog_custom_background_args', array(
    'default-color' => 'F2F2F2',
    'default-image' => '',
  ) ) );

  // Enable support for HTML5 markup.
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
  ) );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );


    /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, icons, and column width.
   */
    add_editor_style( 'inc/css/editor-style.css'  );


}
endif; // marketingblog_setup
add_action( 'after_setup_theme', 'marketingblog_setup' );


function marketingblog_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'marketingblog_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => '',
        'width'                  => 300,
        'height'                 => 76,
        'flex-height'			 => true,
        'flex-width'			 => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    ) ) );
}
add_action( 'after_setup_theme', 'marketingblog_custom_header_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function marketingblog_widgets_init() {
      register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'marketingblog' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ));

    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'marketingblog' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'id'            => 'footer-widget-1',
        'name'          =>  esc_html__( 'Footer Widget 1', 'marketingblog' ),
        'description'   =>  esc_html__( 'Used for footer widget area', 'marketingblog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'id'            => 'footer-widget-2',
        'name'          =>  esc_html__( 'Footer Widget 2', 'marketingblog' ),
        'description'   =>  esc_html__( 'Used for footer widget area', 'marketingblog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'id'            => 'footer-widget-3',
        'name'          =>  esc_html__( 'Footer Widget 3', 'marketingblog' ),
        'description'   =>  esc_html__( 'Used for footer widget area', 'marketingblog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ));

    register_widget( 'marketingblog_popular_posts' );
    register_widget( 'marketingblog_categories' );

}
add_action( 'widgets_init', 'marketingblog_widgets_init' );


/* --------------------------------------------------------------
       Get Theme Options
-------------------------------------------------------------- */

function marketingblog_theme_option( $option_name = false, $default = false ) {
    $marketingblog_theme_options = get_option('marketingblog_theme_options');

    if(!$marketingblog_theme_options)
        return $default;

    if(!$option_name)
        return $marketingblog_theme_options;

    if( array_key_exists($option_name, $marketingblog_theme_options ) ) {
        return $marketingblog_theme_options[$option_name];
    }

    return $default;
}


/* --------------------------------------------------------------
       Theme Widgets
-------------------------------------------------------------- */
require_once(get_template_directory() . '/inc/widgets/widget-categories.php');
require_once(get_template_directory() . '/inc/widgets/widget-popular-posts.php');


/**
 * This function removes inline styles set by WordPress gallery.
 */
function marketingblog_remove_gallery_css( $css ) {
  return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

add_filter( 'gallery_style', 'marketingblog_remove_gallery_css' );



function marketingblog_font_url(){

    $font_family = array();

    $font_family[] = marketingblog_theme_option( 'typo_header', 'Lato' );

    $font_family[] =  marketingblog_theme_option( 'typo_paragraph', 'Roboto' );

    $query_args = array(
        'family'	=> urlencode(implode('|',$font_family)),
    );

    $font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
    return $font_url;
}


/**
 * Enqueue scripts and styles.
 */
function marketingblog_scripts() {

  // Add Bootstrap default CSS
  wp_enqueue_style( 'marketingblog-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

  // Add Font Awesome stylesheet
  wp_enqueue_style( 'marketingblog-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

  // Add Google Fonts
//  $marketingblog_primary_font = str_replace(' ', '+', marketingblog_theme_option( 'typo_header', 'Lato' ) );
//  $marketingblog_seconday_font = str_replace(' ', '+', marketingblog_theme_option( 'typo_header', 'Roboto' ) );

  wp_enqueue_style( 'marketingblog-fonts', marketingblog_font_url(), array());



  // Add main theme stylesheet
  wp_enqueue_style( 'marketingblog-style', get_stylesheet_uri() );

  // Add Modernizr for better HTML5 and CSS3 support
  wp_enqueue_script('marketingblog-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );

  // Add Bootstrap default JS
  wp_enqueue_script('marketingblog-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );


  // Main theme related functions
  wp_enqueue_script( 'marketingblog-functions', get_template_directory_uri() . '/inc/js/functions.min.js', array('jquery') );

  // This one is for accessibility
  wp_enqueue_script( 'marketingblog-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20140222', true );

  // Treaded comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'marketingblog_scripts' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';

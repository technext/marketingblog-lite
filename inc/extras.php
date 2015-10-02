<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package marketingblog
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function marketingblog_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'marketingblog_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function marketingblog_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  return $classes;
}
add_filter( 'body_class', 'marketingblog_body_classes' );


if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
  /**
   * Filters wp_title to print a neat <title> tag based on what is being viewed.
   *
   * @param string $title Default title text for current view.
   * @param string $sep Optional separator.
   * @return string The filtered title.
   */
  function marketingblog_wp_title( $title, $sep ) {
    if ( is_feed() ) {
      return $title;
    }
    global $page, $paged;
    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title .= " $sep $site_description";
    }
    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
      $title .= " $sep " . sprintf( esc_html__( 'Page %s', 'marketingblog' ), max( $paged, $page ) );
    }
    return $title;
  }
  add_filter( 'wp_title', 'marketingblog_wp_title', 10, 2 );
  /**
   * Title shim for sites older than WordPress 4.1.
   *
   * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
   * @todo Remove this function when WordPress 4.3 is released.
   */
  function marketingblog_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
  }
  add_action( 'wp_head', 'marketingblog_render_title' );
endif;



/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function marketingblog_setup_author() {
  global $wp_query;

  if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
    $GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
  }
}
add_action( 'wp', 'marketingblog_setup_author' );


/**
 * Password protected post form using Boostrap classes
 */
add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
  global $post;
  $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
  $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
  <div class="row">
    <div class="col-lg-10">
        <p>' . esc_html__( "This post is password protected. To view it please enter your password below:" ,'marketingblog') . '</p>
        <label for="' . $label . '">' . esc_html__( "Password:" ,'marketingblog') . ' </label>
      <div class="input-group">
        <input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="' . esc_attr__( "Submit",'marketingblog' ) . '">' . esc_html__( "Submit" ,'marketingblog') . '</button>
        </span>
      </div>
    </div>
  </div>
</form>';
  return $o;
}

// Add Bootstrap classes for table
add_filter( 'the_content', 'marketingblog_add_custom_table_class' );
function marketingblog_add_custom_table_class( $content ) {
    return str_replace( '<table>', '<table class="table table-hover">', $content );
}

if ( ! function_exists( 'marketingblog_social' ) ) :
/**
 * Display social links in footer and widgets if enabled
 */
function marketingblog_social($force = false){
  if($force || of_get_option( 'footer_social' ) != 0){
    $services = array (
      'facebook'   => 'Facebook',
      'twitter'    => 'Twitter',
      'googleplus' => 'Google+',
      'youtube'    => 'Youtube',
      'vimeo'      => 'Vimeo',
      'linkedin'   => 'LinkedIn',
      'pinterest'  => 'Pinterest',
      'rss'        => 'RSS',
      'tumblr'     => 'Tumblr',
      'flickr'     => 'Flickr',
      'instagram'  => 'Instagram',
      'dribbble'   => 'Dribbble',
      'skype'      => 'Skype',
      'foursquare' => 'Foursquare',
      'soundcloud' => 'SoundCloud',
      'github'     => 'GitHub',
      'spotify'    => 'Spotify'
      );

    echo '<div class="social-icons">';

    foreach ( $services as $service => $name ) :

        $active[ $service ] = of_get_option ( 'social_'.$service );
        if ( $active[$service] ) { echo '<a href="'. esc_url( $active[$service] ) .'" title="'. esc_html__('Follow us on ','marketingblog').$name.'" class="'. $service .'" target="_blank"><i class="social_icon fa fa-'.$service.'"></i></a>';}

    endforeach;
    echo '</div>';
  }

}
endif;

if ( ! function_exists( 'marketingblog_header_menu' ) ) :
/**
 * Header menu (should you choose to use one)
 */
function marketingblog_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} /* end header menu */
endif;

if ( ! function_exists( 'marketingblog_footer_links' ) ) :
/**
 * Footer menu (should you choose to use one)
 */
function marketingblog_footer_links() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'container'       => '',                              // remove nav container
    'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    'menu'            => esc_html__( 'Footer Links', 'marketingblog' ),   // nav name
    'menu_class'      => 'nav footer-nav clearfix',      // adding custom nav class
    'theme_location'  => 'footer-links',             // where it's located in the theme
    'before'          => '',                                 // before the menu
    'after'           => '',                                  // after the menu
    'link_before'     => '',                            // before each link
    'link_after'      => '',                             // after each link
    'depth'           => 0,                                   // limit the depth of the nav
    'fallback_cb'     => 'marketingblog_footer_links_fallback'  // fallback function
  ));
} /* end marketingblog footer link */
endif;




/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function marketingblog_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts($defaults, $attr);

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . (esc_attr($attr['width']) + 10) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode($content);
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'marketingblog_caption', 10, 3);

/**
 * Skype URI support for social media icons
 */
function marketingblog_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'marketingblog_allow_skype_protocol' );

function marketingblog_footer_credit_text() {
    printf( esc_html__( 'Theme by %1$s', 'marketingblog' ) , '<a href="https://thememarketingblog.com/" title="MarketingBlog Lite" target="_blank">Thememarketingblog</a>');
}

function marketingblog_footer_copyright_text() {
    $default_footer_text = __("Change this texts from Customize -> Footer Settings", 'marketingblog');
    $footer_text = marketingblog_theme_option( 'footer_text', $default_footer_text );
    printf($footer_text);
}
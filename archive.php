<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package marketingblog
 */

get_header(); ?>

<?php
    $blog_content_position =  marketingblog_theme_option('blog_sidebar_position', 'right');
    if($blog_content_position == 'left') {
        $blog_content_css_class = 'pull-right';
    } else {
        $blog_content_css_class = '';
    }


    if( marketingblog_theme_option('blog_style_type', 'small_thumb') == 'big_thumb' ) {
        $big_image_format_posts = true;
    } else {
        $big_image_format_posts = false;
    }
?>

<header class="page-header archive_header">
    <h1 class="page-title text-center">
        <?php
        if ( is_category() ) :
            single_cat_title();

        elseif ( is_tag() ) :
            single_tag_title();

        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'marketingblog' ), '<span class="vcard">' . get_the_author() . '</span>' );

        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'marketingblog' ), '<span>' . get_the_date() . '</span>' );

        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'marketingblog' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'marketingblog' ) ) . '</span>' );

        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'marketingblog' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'marketingblog' ) ) . '</span>' );

        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'marketingblog');

        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'marketingblog');

        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'marketingblog' );

        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'marketingblog' );

        else :
            esc_html_e( 'Archives', 'marketingblog' );

        endif;
        ?>
    </h1>
    <hr />
    <?php
    // Show an optional term description.
    $term_description = term_description();
    if ( ! empty( $term_description ) ) :
        printf( '<div class="taxonomy-description text-center">%s</div>', $term_description );
    endif;
    ?>
</header><!-- .page-header -->

    <div class="container main-content-area">
    <div class="row">
    	<div class="main-content-inner col-sm-12 col-md-8 <?php echo $blog_content_css_class; ?>">

            <section id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                <?php if ( have_posts() ) : ?>



                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            if( $big_image_format_posts )
                            {
                                get_template_part( 'content', 'big_image_format' );
                            } else {
                                get_template_part( 'content', get_post_format() );
                            }
                        ?>

                    <?php endwhile; ?>

                    <?php marketingblog_paging_nav(); ?>

                <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

                <?php endif; ?>

                </main><!-- #main -->
            </section><!-- #primary -->

            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
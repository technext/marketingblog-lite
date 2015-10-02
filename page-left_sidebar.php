<?php
/**
 * Template Name: Page with Left Sidebar
 * @package marketingblog
 */

get_header(); ?>

<div class="container main-content-area">
    <div class="row">
        <div class="main-content-inner col-sm-8 col-md-8 pull-right">

            <div id="primary" class="content-area">

                <main id="main" class="site-main" role="main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'page' ); ?>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( get_theme_mod( 'marketingblog_page_comments' ) == 1 ) :
                            if ( comments_open() || '0' != get_comments_number() ) :
                                comments_template();
                            endif;
                        endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->
            </div><!-- #primary -->

            <?php get_sidebar('page'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

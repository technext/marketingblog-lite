<?php
/**
 * The template for displaying Search Results pages.
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
    <h1 class="page-title text-center"><?php printf( esc_html__( 'Search Results for: %s', 'marketingblog' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
                                get_template_part( 'content', 'search' );
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

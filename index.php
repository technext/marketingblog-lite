<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

<div class="container main-content-area">
	<div class="row">
		<div class="main-content-inner col-sm-12 col-md-8 <?php echo $blog_content_css_class; ?>">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php


								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								if(( is_sticky() && is_home() ) || $big_image_format_posts)
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
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
	</div><!-- close .row -->
</div><!-- close .container -->
<?php get_footer(); ?>
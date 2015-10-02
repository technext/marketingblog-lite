<?php
/**
 * The Template for displaying all single posts.
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
?>

<div class="container main-content-area">
	<?php while ( have_posts() ) : the_post(); ?>
    <header class="entry-header page-header">
			<div class="post_header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
			<div class="entry-meta">
				<?php marketingblog_post_author(); ?>
				<span class="dot_separator">.</span>
				<?php marketingblog_posted_on(); ?>
				<span class="dot_separator">.</span>
				<?php marketingblog_post_post_categories(); ?>
				<?php edit_post_link( esc_html__( 'Edit', 'marketingblog' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
	</header>

	<div class="row">
		<div class="main-content-inner col-sm-12 col-md-8 <?php echo $blog_content_css_class; ?>">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">


					<?php get_template_part( 'content', 'single' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

					<?php marketingblog_post_nav(); ?>

				<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
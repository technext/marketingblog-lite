<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package marketingblog
 */
?>
</div><!-- close .site-content -->

		<?php get_sidebar( 'footer' ); ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info container text-center">
				<div class="row">
					<div class="col-md-8 col-sm-8 copyright_texts">
						<?php marketingblog_footer_copyright_text(); ?>
					</div>
					<div class="col-md-4 col-sm-4 text-right">
						<?php  marketingblog_footer_credit_text(); ?>
					</div>
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->


<?php wp_footer(); ?>

<?php // style section for customizer, Don't delete  ?>
<style type="text/css" id="marketingblog_customizer_css">

</style>

</body>
</html>
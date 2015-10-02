<?php
/**
 * @package marketingblog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="blog-item-wrap big_featured_post">
        <div class="row">
                <div class="col-md-12">
                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="featured_image_container">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                <?php the_post_thumbnail( 'marketingblog-featured', array( 'class' => 'single-featured img-radius img-responsive' )); ?>
                            </a>
                            <a class="overlay" href="<?php the_permalink(); ?>"><span class="read-more_overlay"><i class="fa fa-caret-right"></i> <?php echo __('Read Article', 'marketingblog');?></span></a>
                            <?php
                            $post_category = marketingblog_get_post_single_category();
                            if( $post_category ) :
                                $category_link = get_category_link( $post_category->term_id );
                            ?>
                                <a href="<?php echo esc_url( $category_link ); ?>" class="featured_blog_cat_link"><?php echo $post_category->name; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="blog-entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                    <div class="blog-entry-content">
                        <?php the_excerpt(); ?>
                        <a class="more-link" href="<?php the_permalink(); ?>"><span class="more-button">CONTINUE READING</span></a>
                    </div>
                </div>
            </div>
        </div>
</article><!-- #post-## -->

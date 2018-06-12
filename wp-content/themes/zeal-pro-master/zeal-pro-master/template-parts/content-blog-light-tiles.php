<?php
/**
 * Template part for displaying dark tile Masonry blog items.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zeal
 */
?>

<div class="masonry-blog-item wow fadeInUp light-tile">
    
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php echo get_the_permalink(); ?>">
            <img alt="<?php esc_attr_e( get_the_title() ); ?>" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" />
        </a>
    <?php endif; ?>
    
    <div class="tile-details">

        <h3 class="tile-title">
            <a href="<?php echo get_the_permalink(); ?>">
                <?php esc_html_e( get_the_title() ); ?>
            </a>
        </h3>

        <div class="tile-meta">

            <?php if ( get_theme_mod( 'zeal_blog_masonry_show_author', 'on' ) == 'on' ) : ?>
                <div class="meta-value">
                    <?php echo get_the_author_posts_link(); ?>
                </div>
            <?php endif; ?>

            <?php $words = get_theme_mod( 'zeal_blog_masonry_word_trim', '50' ); ?>
            <?php if ( $words > 0 ) : ?>
                <div class="tile-content">
                    <?php esc_html_e( wp_trim_words( strip_shortcodes( strip_tags( get_the_content() ) ), $words, '...' ) ); ?>    
                </div>
            <?php endif; ?>

            <?php if ( $words > 0 ) : ?>
                <div class="read-more">
                    <?php if ( get_theme_mod( 'zeal_blog_link_text', __( 'Read More', 'zeal' ) ) != '' ) : ?>
                        <a class="blog-post-read-more" href="<?php echo get_permalink(); ?>"><?php echo get_theme_mod( 'zeal_blog_link_text', __( 'Read More', 'zeal' ) ); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ( get_theme_mod( 'zeal_blog_masonry_show_date', 'on' ) == 'on' ) : ?>
                <div class="tile-date">
                    <?php esc_html_e( get_the_date( 'F jS, Y' ) ); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>
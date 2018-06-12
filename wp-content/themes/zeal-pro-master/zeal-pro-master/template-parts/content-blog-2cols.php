<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?php
if (has_post_thumbnail(get_the_ID())) :
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
else:
    $image = get_template_directory_uri() . '/inc/images/blog-post-default-bg.jpg';
endif;
?>

<div class="col-sm-6 blog-roll-post wow fadeIn">

    <article data-link="<?php echo get_the_permalink(); ?>" id="<?php echo 'post-' . get_the_ID(); ?>">

        <div class="blog-post-image" style="background-image: url(<?php echo has_post_thumbnail(get_the_ID()) ? $image[0] : $image; ?>);">

        </div>   

        <div class="blog-post-overlay">

            <h2 class="post-title">
                <?php echo wp_trim_words( get_the_title(), 10 ); ?>
                <?php if ( get_theme_mod( 'zeal_blog_link_text', __( 'Read More', 'zeal' ) ) != '' ) : ?>
                    <a class="blog-post-read-more" href="<?php echo get_permalink(); ?>"><?php echo get_theme_mod( 'zeal_blog_link_text', __( 'Read More', 'zeal' ) ); ?></a>
                <?php endif; ?>
            </h2>

        </div>

    </article>

</div>
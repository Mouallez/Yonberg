<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zeal
 */

get_header(); ?>

    <div id="primary" class="content-area">
        
        <main id="main" class="site-main" role="main">

            <div class="container archive-page">

                <div class="row">

                    <?php if ( have_posts() ) : ?>

                            <header class="page-header">
                                <h1 class="page-title">
                                    <?php echo __( 'Archive:', 'zeal' ); ?>
                                    <span><?php esc_html( the_archive_title() ); ?></span>
                                </h1>
                            </header><!-- .page-header -->

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                    <?php

                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                            get_template_part( 'template-parts/content', get_post_format() );
                                    ?>

                            <?php endwhile; ?>

                            <?php the_posts_navigation(); ?>

                    <?php else : ?>

                            <?php get_template_part( 'template-parts/content', 'none' ); ?>

                    <?php endif; ?>

                </div>
            
            </div>

        </main><!-- #main -->
        
    </div><!-- #primary -->

<?php get_footer(); ?>

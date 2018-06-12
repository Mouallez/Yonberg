<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zeal
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php do_action('zeal_homepage'); ?>
        <?php $front = get_option('show_on_front'); ?>
        <?php if( get_theme_mod('zeal_homepage_content_bool', 'on' ) == 'on' ) : ?>
        <div class="container">
        
            <div class="row homepage-portfolio">

                <section class="homepage-portfolio">

                    <?php if ( $front == 'posts' ) : ?>
                    
                        <div class="col-sm-12">

                            <h2 class="wow fadeInDown feature-content-title">
                                <?php echo esc_attr( get_theme_mod( 'zeal_portfolio_section_name', __( 'Blog', 'zeal' ) ) ); ?>
                            </h2>

                            <hr>

                        </div>
                    
                    <?php endif; ?>
                   
                    <?php /* Start the Loop */ ?>
                    
                    <?php if ( $front == 'posts' && get_theme_mod( 'zeal_blog_layout_style', 'default' ) != 'default' ) : ?>

                        <div class="col-sm-12">

                            <div id="masonry-wrapper">

                                <div class="grid-sizer"></div>
                                <div class="gutter-sizer"></div>

                    <?php endif; ?>
                    
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        
                        if ( $front == 'posts' ) :
                            
                            if ( get_theme_mod( 'zeal_blog_layout_style', 'default' ) == 'default' ) : 

                                if( get_theme_mod( 'zeal_blog_template', '2cols' ) == '2cols' ) : 

                                    // Default Template - 2 Cols
                                    get_template_part( 'template-parts/content-blog-2cols', get_post_format() );

                                else :

                                    // Default Template - 3 Cols
                                    get_template_part( 'template-parts/content-blog-3cols', get_post_format() );

                                endif; 

                            else :

                                if ( get_theme_mod( 'zeal_blog_layout_style', 'default' ) == 'dark-tiles' ) :
                                
                                    // Dark Masonry Template
                                    get_template_part( 'template-parts/content-blog-dark-tiles', get_post_format() );
                                
                                else: 
                                    
                                    // Light Masonry Template
                                    get_template_part( 'template-parts/content-blog-light-tiles', get_post_format() );
                                    
                                endif;

                            endif;
          
                        else:
                                
                            get_template_part('template-parts/content-page-home', get_post_format() );
                            
                        endif;
                        
                        ?>

                    <?php endwhile; ?>
                    
                    <?php if ( $front == 'posts' && get_theme_mod( 'zeal_blog_layout_style', 'default' ) != 'default' ) : ?>

                            </div>
                            
                        </div>

                    <?php endif; ?>
                                
                </section>

            </div>
            
        </div>
        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>      
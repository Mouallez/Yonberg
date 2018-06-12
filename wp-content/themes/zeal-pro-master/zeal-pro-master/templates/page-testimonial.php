<?php
/*
Template Name: Testimonials
*/
get_header(); ?>

<div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            
            <div class="container">
        
                <div class="row homepage-portfolio">

                    <section class="homepage-portfolio">

                        <div class="col-sm-12">

                            <h1 class="entry-title">

                                <?php echo the_title(); ?>

                            </h1>

                            <hr>
                            
                            <?php while ( have_posts() ) : the_post(); ?>

                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div>

                            <?php endwhile; // End of the loop. ?>
                            
                        </div>

                        <?php AddOns::zeal_output_testimonials(); ?>

                    </section>
                    
                    <div class="zeal-pagination">
                        <?php echo paginate_links(); ?>
                    </div>
                    
                </div>
            
            </div>

        </main><!-- #main -->
        
    </div><!-- #primary -->

<?php get_footer(); ?>

    


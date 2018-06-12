<?php


function customization_css() { ?>
    
    <style type="text/css">
        
        <?php if( get_theme_mod('zeal_site_background', 'image' ) == 'image' ) :  ?>

            body{
                background: url(<?php echo esc_url( get_theme_mod('zeal_bg_image', get_template_directory_uri() . '/inc/images/textures/binding_dark.png' ) ); ?>);
            }

        <?php else : ?>

            body{
                background: <?php echo get_theme_mod( 'zeal_bg_color', '#414141' ); ?>;
            }

        <?php endif; ?>
        
    </style>

<?php }
add_action('wp_head', 'customization_css');

/**
 * Enqueue scripts and styles.
 */
function zeal_scripts() {
    
    $fonts = zeal_fonts();
    
    if ( ! get_option( 'color_transfer_check' ) ) {
        color_transfer_check();
    }
    
    wp_enqueue_style( 'zeal-style', get_stylesheet_uri() );

    // Fonts
    if( array_key_exists ( get_theme_mod('zeal_font_primary', 'Raleway, sans-serif'), $fonts ) ) :
        wp_enqueue_style('athena-font-primary', '//fonts.googleapis.com/css?family=' . $fonts[get_theme_mod('zeal_font_primary', 'Oswald, sans-serif')], array(), ZEAL_VERSION );
    endif;

    if( array_key_exists ( get_theme_mod('zeal_font_secondary', 'Raleway, sans-serif'), $fonts ) ) :
        wp_enqueue_style('athena-theme-secondary', '//fonts.googleapis.com/css?family=' . $fonts[get_theme_mod('zeal_font_secondary', 'Titillium Web, sans-serif')], array(), ZEAL_VERSION );
    endif;
    
    // Enqueue stylesheets
    wp_enqueue_style('zeal-unite', get_template_directory_uri() . '/inc/css/unite-gallery.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-fontawesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-slicknav', get_template_directory_uri() . '/inc/css/slicknav.min.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-animations', get_template_directory_uri() . '/inc/css/animate.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-lightbox', get_template_directory_uri() . '/inc/css/lightbox.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-main-style', get_template_directory_uri() . '/inc/css/style.css', array(), ZEAL_VERSION);
    //    wp_enqueue_style('zeal-template', get_template_directory_uri() . '/inc/css/temps/' . esc_attr( get_theme_mod( 'zeal_theme_color', 'teal' ) ) . '.min.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-camera-style', get_template_directory_uri() . '/inc/css/camera.css', array(), ZEAL_VERSION);
    wp_enqueue_style('zeal-carousel', get_template_directory_uri() . '/inc/css/owl.carousel.css', array(), ZEAL_VERSION);
    
    // Enqueue scripts
    wp_enqueue_script('zeal-unite', get_template_directory_uri() . '/inc/js/unite.min.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-easing', get_template_directory_uri() . '/inc/js/easing.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-slicknav-js', get_template_directory_uri() . '/inc/js/jquery.slicknav.min.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-wow', get_template_directory_uri() . '/inc/js/wow.min.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-lightbox-js', get_template_directory_uri() . '/inc/js/lightbox.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-custom', get_template_directory_uri() . '/inc/js/custom.js', array('jquery', 'jquery-masonry'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-camera', get_template_directory_uri() . '/inc/js/camera.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-parallax', get_template_directory_uri() . '/inc/js/parallax.min.js', array('jquery'), ZEAL_VERSION, true);
    wp_enqueue_script('zeal-carousel', get_template_directory_uri() . '/inc/js/owl.carousel.min.js', array('jquery'), ZEAL_VERSION, true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }    
    
}
add_action( 'wp_enqueue_scripts', 'zeal_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zeal_widgets_init() {
    
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage A', 'zeal' ),
        'id'            => 'sidebar-front',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage B', 'zeal' ),
        'id'            => 'sidebar-front-b',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage C', 'zeal' ),
        'id'            => 'sidebar-front-c',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage D', 'zeal' ),
        'id'            => 'sidebar-front-d',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage E', 'zeal' ),
        'id'            => 'sidebar-front-e',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer A', 'zeal' ),
        'id'            => 'sidebar-footer-a',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-12">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer B', 'zeal' ),
        'id'            => 'sidebar-footer',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-4">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
}
add_action( 'widgets_init', 'zeal_widgets_init' );


function zeal_jumbotron() { ?>
    
    <?php if( get_theme_mod( 'zeal_slider_bool', 'on' ) == 'on' ) : ?>
    <section class="front-page-hero">

        <?php if( get_theme_mod( 'zeal_slide_type', 'static') == 'slider' ) : ?>

            <?php if( get_theme_mod( 'zeal_featured_image', '#' ) ) : ?>
                <div id="zeal-slider" style="background-color: <?php echo get_theme_mod( 'zeal_hero_tint_toggle', 'on' ) == 'on' ? esc_attr( get_theme_mod( 'zeal_hero_tint', 'rgba(10, 10, 10, 0.25)' ) ) : 'none'; ?>">
                    <?php foreach( get_theme_mod( 'zeal_featured_image' ) as $slide ) : ?>
                        <?php if( $slide ) : ?>
                            <div id="slide1" data-thumb="<?php echo esc_url( $slide ); ?>" data-src="<?php echo esc_url( $slide ); ?>"></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div id="slider-overlay">
                    <div class="slider-overlay">
                        <?php zeal_jumbotron_text(); ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>

            <div data-stellar-background-ratio="0.5" class="zeal-parallax col-md-12 hero-banner <?php echo get_theme_mod( 'zeal_hero_background_style', 'image' ) == 'color' ? 'zeal-bg-img-none' : ''; ?>"
                style="background-color: <?php echo esc_url( get_theme_mod( 'zeal_hero_bg_color', '#0D0D0D' ) ); ?>;
                    background-image: url(<?php echo esc_url( get_theme_mod( 'zeal_hero_image', get_template_directory_uri() . '/inc/images/zeal-demo.jpg' ) ); ?>)">

                <div class="hero-overlay" style="background-color: <?php echo get_theme_mod( 'zeal_hero_tint_toggle', 'on' ) == 'on' ? esc_attr( get_theme_mod( 'zeal_hero_tint', 'rgba(10, 10, 10, 0.25)' ) ) : 'none'; ?>">

                    <?php zeal_jumbotron_text(); ?>

                </div>

            </div>          
        
        <?php endif; ?>

    </section>
    <?php endif; ?>

<?php }


function zeal_homepage_posts() { ?>
    
    <!-- Featured post #1 -->
    <?php if( get_theme_mod( 'zeal_the_featured_post_bool', 'on' ) == 'on' ) : ?>
    <section id="feat-home-1" class="featured-homepage-post">

        <?php $is_custom = get_theme_mod( 'zeal_feat_home_1_custom_toggle', 'post' ) == 'custom' ? true : false; ?>
        
        <?php $featured_post = get_theme_mod( 'zeal_the_featured_post', null ) == null ? null : get_post( esc_attr( get_theme_mod( 'zeal_the_featured_post', null ) ) ); ?>

        <?php
            if ( $is_custom ) :
                $image = get_theme_mod('zeal_feat_home_1_custom_image', get_template_directory_uri() . '/inc/images/jesse1.jpg' ); 
                $the_url = get_theme_mod( 'zeal_feat_home_1_custom_link', '#' );
                $the_title = get_theme_mod( 'zeal_feat_home_1_custom_title', __( 'Featured Post - Custom Content Title', 'zeal' ) );
                $the_body = get_theme_mod( 'zeal_feat_home_1_custom_content', __( 'Featured Post - Custom Content', 'zeal' ) );
            else:
                if ( ! is_null( $featured_post ) && has_post_thumbnail( $featured_post->ID ) ) :
                    $image = get_the_post_thumbnail_url( $featured_post->ID );
                else :
                    $image = get_template_directory_uri() . '/inc/images/jesse1.jpg';
                endif;
                $the_url = is_null( $featured_post ) ? '#' : get_permalink( $featured_post->ID );
                $the_title = is_null( $featured_post ) ? __( 'Select a Featured Post to Have it Displayed Here', 'zeal' ) : $featured_post->post_title;
                $the_body = is_null( $featured_post ) ? __( 'You may use the built in WordPress Customizer to modify which post appears here.', 'zeal' ) : apply_filters( 'the_content', $featured_post->post_content );
            endif;
        ?>

        <a href="<?php echo esc_url( $the_url ); ?>">
            <div class="col-sm-6 featured-post-image" style="background-image: url(<?php echo esc_url( $image ); ?>);">
            </div>
        </a>

        <div class="col-sm-6 featured-post-content">

            <h2 class="wow fadeInUp"><?php echo $the_title; ?></h2>

            <div class="wow fadeInUp">
                <?php echo $the_body; ?>
            </div>

            <div class="featured-post-overlay">
            </div>    

            <?php if ( get_theme_mod( 'zeal_the_featured_post_button', 'Read More ...' ) ) : ?> 
                <a href="<?php echo esc_url( $the_url ); ?>">
                    <div class="click-through-arrow">

                        <h4 class="wow fadeIn"><?php echo get_theme_mod('zeal_the_featured_post_button', 'Read More ...' ); ?></h4>

                    </div>
                </a>
            <?php endif; ?>

        </div>

    </section>
    <?php endif; ?>
    <!-- End Featured post #1 -->

    <!-- Featured post #2 -->
    <?php if( get_theme_mod( 'zeal_the_featured_post2_bool', 'on' ) == 'on' ) : ?>
    <section id="feat-home-2" class="featured-homepage-post">

        <?php $is_custom = get_theme_mod( 'zeal_feat_home_2_custom_toggle', 'post' ) == 'custom' ? true : false; ?>
        
        <?php $featured_post = get_theme_mod( 'zeal_the_featured_post2', null ) == null ? null : get_post( esc_attr( get_theme_mod( 'zeal_the_featured_post2', null ) ) ); ?>

        <?php
            if ( $is_custom ) :
                $image = get_theme_mod('zeal_feat_home_2_custom_image', get_template_directory_uri() . '/inc/images/jesse2.jpg' ); 
                $the_url = get_theme_mod( 'zeal_feat_home_2_custom_link', '#' );
                $the_title = get_theme_mod( 'zeal_feat_home_2_custom_title', __( 'Featured Post 2 - Custom Content Title', 'zeal' ) );
                $the_body = get_theme_mod( 'zeal_feat_home_2_custom_content', __( 'Featured Post 2 - Custom Content', 'zeal' ) );
            else:
                if ( ! is_null( $featured_post ) && has_post_thumbnail( $featured_post->ID ) ) :
                    $image = get_the_post_thumbnail_url( $featured_post->ID );
                else :
                    $image = get_template_directory_uri() . '/inc/images/jesse2.jpg';
                endif;
                $the_url = is_null( $featured_post ) ? '#' : get_permalink( $featured_post->ID );
                $the_title = is_null( $featured_post ) ? __( 'Select a Featured Post to Have it Displayed Here', 'zeal' ) : $featured_post->post_title;
                $the_body = is_null( $featured_post ) ? __( 'You may use the built in WordPress Customizer to modify which post appears here.', 'zeal' ) : apply_filters( 'the_content', $featured_post->post_content );
            endif;
        ?>

        <a href="<?php echo esc_url( $the_url ); ?>">
            <div class="col-sm-6 col-sm-push-6 featured-post-image" style="background-image: url(<?php echo $image; ?>);">
            </div>
        </a>
        
        <div class="col-sm-6 col-sm-pull-6 featured-post-content"> 

            <h2 class="wow fadeInUp"><?php echo $the_title; ?></h2>

            <div class="wow fadeInUp">
                <?php echo $the_body; ?>
            </div>

            <div class="featured-post-overlay">
            </div>    

            <?php if ( get_theme_mod( 'zeal_the_featured_post2_button', 'Read More ...' ) ) : ?> 
                <a href="<?php echo esc_url( $the_url ); ?>">
                    <div class="click-through-arrow">

                        <h4 class="wow fadeIn"><?php echo get_theme_mod('zeal_the_featured_post2_button', 'Read More ...' ); ?></h4>

                    </div>
                </a>
            <?php endif; ?>

        </div>

    </section>
    <?php endif; ?>
    <!-- End Featured post #2 -->

    <!-- Featured post #3 -->
    <?php if( get_theme_mod( 'zeal_the_featured_post3_bool', 'on' ) == 'on' ) : ?>
    <section id="feat-home-3" class="featured-homepage-post">

        <?php $is_custom = get_theme_mod( 'zeal_feat_home_3_custom_toggle', 'post' ) == 'custom' ? true : false; ?>
        
        <?php $featured_post = get_theme_mod( 'zeal_the_featured_post3', null ) == null ? null : get_post( esc_attr( get_theme_mod( 'zeal_the_featured_post3', null ) ) ); ?>

        <?php
            if ( $is_custom ) :
                $image = get_theme_mod('zeal_feat_home_3_custom_image', get_template_directory_uri() . '/inc/images/jesse1.jpg' ); 
                $the_url = get_theme_mod( 'zeal_feat_home_3_custom_link', '#' );
                $the_title = get_theme_mod( 'zeal_feat_home_3_custom_title', __( 'Featured Post 3 - Custom Content Title', 'zeal' ) );
                $the_body = get_theme_mod( 'zeal_feat_home_3_custom_content', __( 'Featured Post 3 - Custom Content', 'zeal' ) );
            else:
                if ( ! is_null( $featured_post ) && has_post_thumbnail( $featured_post->ID ) ) :
                    $image = get_the_post_thumbnail_url( $featured_post->ID );
                else :
                    $image = get_template_directory_uri() . '/inc/images/jesse1.jpg';
                endif;
                $the_url = is_null( $featured_post ) ? '#' : get_permalink( $featured_post->ID );
                $the_title = is_null( $featured_post ) ? __( 'Select a Featured Post to Have it Displayed Here', 'zeal' ) : $featured_post->post_title;
                $the_body = is_null( $featured_post ) ? __( 'You may use the built in WordPress Customizer to modify which post appears here.', 'zeal' ) : apply_filters( 'the_content', $featured_post->post_content );
            endif;
        ?>

        <a href="<?php echo esc_url( $the_url ); ?>">
            <div class="col-sm-6 featured-post-image" style="background-image: url(<?php echo $image; ?>);">
            </div>
        </a>


        <div class="col-sm-6 featured-post-content">

            <h2 class="wow fadeInUp"><?php echo $the_title; ?></h2>

            <div class="wow fadeInUp">
                <?php echo $the_body; ?>
            </div>

            <div class="featured-post-overlay">
            </div>    

            <?php if ( get_theme_mod( 'zeal_the_featured_post3_button', 'Read More ...' ) ) : ?> 
                <a href="<?php echo esc_url( $the_url ); ?>">
                    <div class="click-through-arrow">

                        <h4 class="wow fadeIn"><?php echo get_theme_mod('zeal_the_featured_post3_button', 'Read More ...' ); ?></h4>

                    </div>
                </a>
            <?php endif; ?>

        </div>

    </section>
    <?php endif; ?>
    <!-- End Featured post #3 -->


<?php }

function zeal_homepage_widgets(){ ?>
<!-- Homepage A -->
    <?php if ( get_theme_mod( 'zeal_cta_a_toggle', 'on' ) == 'on' ) : ?>

        <div data-stellar-background-ratio="0.5" class="zeal-parallax row homepage-a homepage-cta-background">

            <section class="homepage-cta-banner wow fadeInUp">

                <div class="col-sm-12 homepage-cta-banner">

                    <div class="cta-banner-content">

                        <?php if ( ! is_active_sidebar( 'sidebar-front' ) ) : ?>

                            <h2 class="widget-title">
                                <?php _e( 'Homepage A Widget', 'zeal' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget A. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                            </div>

                        <?php else : ?>

                            <?php get_sidebar( 'front' ); ?>

                        <?php endif; ?>

                    </div>

                </div>
                
            </section>

        </div> <!-- CTA BACKGROUND ROW -->

    <?php endif; ?>

    <!-- Homepage B -->
    <?php if ( get_theme_mod( 'zeal_cta_b_toggle', 'on' ) == 'on' ) : ?>

        <div data-stellar-background-ratio="0.5" class="zeal-parallax row homepage-b">

            <section class="homepage-cta-banner wow fadeInUp">

                <div class="col-sm-12 homepage-cta-banner">

                    <div class="cta-banner-content">

                        <?php if ( ! is_active_sidebar( 'sidebar-front-b' ) ) : ?>

                            <h2 class="widget-title">
                                <?php _e( 'Homepage B Widget', 'zeal' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget B. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                            </div>

                        <?php else : ?>

                            <?php get_sidebar( 'front_b' ); ?>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        </div> <!-- CTA BACKGROUND ROW -->

    <?php endif; ?>

    <!-- Homepage C -->
    <?php if ( get_theme_mod( 'zeal_cta_c_toggle', 'on' ) == 'on' ) : ?>

        <div data-stellar-background-ratio="0.5" class="zeal-parallax row homepage-c">

            <section class="homepage-cta-banner wow fadeInUp">

                <div class="col-sm-12 homepage-cta-banner">

                    <div class="cta-banner-content">

                        <?php if ( ! is_active_sidebar( 'sidebar-front-c' ) ) : ?>

                            <h2 class="widget-title">
                                <?php _e( 'Homepage C Widget', 'zeal' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget B. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                            </div>

                        <?php else : ?>

                            <?php get_sidebar( 'front_c' ); ?>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        </div> <!-- CTA BACKGROUND ROW -->


    <?php endif; ?>

    <!-- Homepage D -->
    <?php if ( get_theme_mod( 'zeal_cta_d_toggle', 'on' ) == 'on' ) : ?>

        <div data-stellar-background-ratio="0.5" class="zeal-parallax row homepage-d">

            <section class="homepage-cta-banner wow fadeInUp">

                <div class="col-sm-12 homepage-cta-banner">

                    <div class="cta-banner-content">

                        <?php if ( ! is_active_sidebar( 'sidebar-front-d' ) ) : ?>

                            <h2 class="widget-title">
                                <?php _e( 'Homepage D Widget', 'zeal' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget D. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                            </div>

                        <?php else : ?>

                            <?php get_sidebar( 'front_d' ); ?>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        </div> <!-- CTA BACKGROUND ROW -->


    <?php endif; ?>

    <!-- Homepage E -->
    <?php if ( get_theme_mod( 'zeal_cta_e_toggle', 'on' ) == 'on' ) : ?>

        <div data-stellar-background-ratio="0.5" class="zeal-parallax row homepage-e">

            <section class="homepage-cta-banner wow fadeInUp">

                <div class="col-sm-12 homepage-cta-banner">

                    <div class="cta-banner-content">

                        <?php if ( ! is_active_sidebar( 'sidebar-front-e' ) ) : ?>

                            <h2 class="widget-title">
                                <?php _e( 'Homepage E Widget', 'zeal' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget E. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                            </div>

                        <?php else : ?>

                            <?php get_sidebar( 'front_e' ); ?>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        </div> <!-- CTA BACKGROUND ROW -->


    <?php endif; ?>
<?php }

/**
 * Render the homepage layout.
 */
function zeal_render_homepage() { ?>

    <div class="container">

        <div class="row homepage-background">
            
            <?php zeal_jumbotron(); ?>
            <?php zeal_homepage_posts(); ?>
        
        </div> <!-- FEATURED POST BACKGROUND ROW -->
        
        <?php zeal_homepage_widgets(); ?>
        
            
    </div> <!-- CONTAINER -->

<?php }
add_action( 'zeal_homepage', 'zeal_render_homepage' );

/**
 * Render the footer.
 */
function zeal_render_footer() { ?>

    <div class="container">
        
        <!-- Footer A -->
        <?php if ( get_theme_mod( 'zeal_footer_a_toggle', 'on' ) == 'on' ) : ?>
        
            <div data-stellar-background-ratio="0.5" class="zeal-parallax row footer-a">

                <section class="homepage-cta-banner wow fadeInUp">

                    <div class="col-sm-12 homepage-cta-banner">

                        <div class="cta-banner-content">

                            <?php if ( ! is_active_sidebar( 'sidebar-footer-a' ) ) : ?>

                                <h2 class="widget-title">
                                    <?php _e( 'Footer A Widget', 'zeal' ); ?>
                                </h2>
                                <div class="textwidget">
                                    <?php _e( 'You can enable/disable this widget from Customizer - Footer - Footer A. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'zeal' ); ?>
                                </div>

                            <?php else : ?>

                                <?php get_sidebar( 'footer_a' ); ?>

                            <?php endif; ?>

                        </div>

                    </div>

                </section>

            </div> <!-- CTA BACKGROUND ROW -->
            
        <?php endif; ?>
        
        <!-- Footer B -->
        <?php if ( get_theme_mod( 'zeal_footer_b_toggle', 'on' ) == 'on' ) : ?>
        <div class="row footer-b">

            <div class="col-md-12 wow fadeIn">
                
                <?php get_sidebar( 'footer' ); ?>
                <div class="">
                    
                    <?php if( get_theme_mod('zeal_branding', 'on') == 'on' ) : ?>
                    <p class="footer" style="display: block !important">
                        <?php _e( 'Designed by Smartcat', 'zeal' ); ?> <img src="<?php echo get_template_directory_uri() . "/inc/images/smartcat-30x33.png"; ?>" alt="Smartcat">
                    </p>
                    <?php endif; ?>
                    <p class="footer">
                        <?php echo get_theme_mod( 'zeal_copyright_text', __( 'Copyright Your Company Name ' . date( 'Y' ), 'zeal' ) ); ?>
                    </p>
                    
                </div>

            </div>

        </div>
        <?php endif; ?>
        
        <div class="scroll-top alignright">
            <span class="fa fa-chevron-up"></span>
        </div>

    </div>

<?php }
add_action( 'zeal_footer', 'zeal_render_footer' );

function zeal_custom_css() { ?>

    <style type="text/css">
        
        .hero-overlay h2 {
            font-size: <?php echo esc_attr( get_theme_mod( 'zeal_hero_heading_size', 50 ) ); ?>px;
        }
        
        .hero-overlay p.site-tagline {
            font-size: <?php echo esc_attr( get_theme_mod( 'zeal_hero_tagline_size', 10 ) ); ?>px;
        }
        
        .grid-sizer,
        .masonry-blog-item { 
            width: <?php echo get_theme_mod( 'zeal_blog_template', '2cols' ) == '2cols' ? '48%' : '32%'; ?>; 
        }
        
        .masonry-blog-item .tile-title {
            font-size: <?php echo esc_attr( get_theme_mod( 'zeal_blog_title_size', '24' ) ); ?>px;
        }

        .masonry-blog-item .tile-content {
            font-size: <?php echo esc_attr( get_theme_mod( 'zeal_blog_content_size', '12' ) ); ?>px;
        }
        
        /* --- COLORS --- */
            
            /* --- PRIMARY --- */
            
            button, input[type=button], 
            input[type=submit],
            div.row.homepage-cta-background,
            .row.no-cta-divider,
            div#comments-header-bar,
            .team-member-wrapper.event .secondary-button,
            .event-blog .event-post .event-details .secondary-button,
            .zeal-button,
            .team-member-wrapper div.single-post-meta,
            div.team-member-wrapper,
            #single-team-member-social a:hover span.fa,
            div.team-member-wrapper .sc_team_skills .progress
            {
                background-color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }
            
            .camera_bar_cont span#pie_0{
                background-color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?> !important;
            }
            
            div#site-branding p,
            nav.main-nav ul#primary-menu > li.current-menu-item > a,
            nav.main-nav ul.slicknav_nav > li.current-menu-item > a,
            .main-navigation ul ul a:hover,
            section.featured-homepage-post div.click-through-arrow:hover h4,
            .blog-post-overlay p.post-meta a,
            a.blog-post-read-more,
            span.meta-value,
            div.single-post-left a,
            nav.post-navigation .nav-links a,
            div.comment-metadata a.comment-edit-link,
            div.reply a.comment-reply-link,
            div#respond p.logged-in-as a:last-child,
            .widget a,
            div.archive-page article a,
            .event-blog .event-post .event-details a,
            .event-blog .event-details .date,
            ul#zeal-testimonials .testimonial-content .fa.fa-quote-left,
            ul#zeal-testimonials .testimonial-author,
            .single-faq .faq-title,
            .zeal-contact-info span.fa,
            .posts-navigation .nav-links a,
            .masonry-blog-item:hover .tile-meta .meta-value a,
            .masonry-blog-item:hover a.blog-post-read-more,
            div.team-member-wrapper h2.about-heading,
            div.team-member-wrapper .sc_team_posts .skills-title,
            .team-member-wrapper h1.entry-title,
            #single-team-member-social span.fa,
            div.team-member-wrapper .sc-team-member-posts a:hover,
            .team-member-wrapper .sc-tags .sc-single-tag
            {
                color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }

            div.single-post-meta {
                border-top: 20px solid <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }

            nav.main-nav ul#primary-menu > li > ul.sub-menu,
            footer.site-footer > div.container > div.row {
                border-top: 2px solid <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }

            header#masthead > div.container > div.row > div.col-sm-12,
            .single-page .single-page-wrapper h1,
            .diviver span{
                border-bottom: 2px solid <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }

            nav.main-nav ul#primary-menu > li > ul.sub-menu > li > ul.sub-menu {
                border-left: 1px solid <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }

            .masonry-blog-item:hover img {
                border-bottom-color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }
            
            .team-member-wrapper .sc-tags .sc-single-tag {
                border: 2px solid <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_primary', '#3eb3b1' ) ); ?>;
            }
        
            /* --- SECONDARY --- */
        
            nav.main-nav ul#primary-menu > li.current-menu-item > a:hover,
            nav.main-nav a:hover,
            div.single-post-left a:hover,
            a.blog-post-read-more:hover,
            .blog-post-overlay p.post-meta a:hover,
            .posts-navigation .nav-links a:hover
            {
                color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_secondary', '#57DBD9' ) ); ?>;
            }

            button:hover, input[type=button]:hover, input[type=submit]:hover, .zeal-button:hover {
                background-color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_secondary', '#57DBD9' ) ); ?>;
            }

            @media screen and (max-width: 991px) {
                .slicknav_nav a:hover {
                    color: <?php echo esc_attr( get_theme_mod( 'zeal_skin_color_secondary', '#57DBD9' ) ); ?> !important;
                }
            }
            
            /* --- FEATURED HOMEPAGE POSTS - CUSTOM CONTROLS --- */
            
            #feat-home-1,
            #feat-home-1 div.featured-post-image,
            #feat-home-1 div.featured-post-content,
            #feat-home-1 div.featured-post-overlay {
                height: <?php echo esc_attr( get_theme_mod( 'zeal_feat_home_1_height', '585' ) ); ?>px;
            }
            
            #feat-home-2,
            #feat-home-2 div.featured-post-image,
            #feat-home-2 div.featured-post-content,
            #feat-home-2 div.featured-post-overlay {
                height: <?php echo esc_attr( get_theme_mod( 'zeal_feat_home_2_height', '585' ) ); ?>px;
            }
            
            #feat-home-3,
            #feat-home-3 div.featured-post-image,
            #feat-home-3 div.featured-post-content,
            #feat-home-3 div.featured-post-overlay {
                height: <?php echo esc_attr( get_theme_mod( 'zeal_feat_home_3_height', '585' ) ); ?>px;
            }
            
            <?php if ( get_theme_mod( 'zeal_feat_home_1_fade', 'show' ) != 'show' ) : ?>
                #feat-home-1 div.featured-post-overlay {
                    visibility: hidden;
                }
            <?php endif; ?>
            
            <?php if ( get_theme_mod( 'zeal_feat_home_2_fade', 'show' ) != 'show' ) : ?>
                #feat-home-2 div.featured-post-overlay {
                    visibility: hidden;
                }
            <?php endif; ?>
            
            <?php if ( get_theme_mod( 'zeal_feat_home_3_fade', 'show' ) != 'show' ) : ?>
                #feat-home-3 div.featured-post-overlay {
                    visibility: hidden;
                }
            <?php endif; ?>
            
    </style>
    
<?php }
add_action('wp_head', 'zeal_custom_css');

function hex2rgba( $color, $opacity = false ) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if ( empty( $color ) )
            return $default; 
 
	//Sanitize $color if "#" is provided 
        if ( $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if ( strlen( $color ) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }
 
        // Convert hexadec to rgb
        $rgb =  array_map( 'hexdec', $hex );
 
        // Check if opacity is set(rgba or rgb)
        if( $opacity ){
            if( abs( $opacity ) > 1 )
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
        
}

function zeal_jumbotron_text () { ?>
    
    <h2 class="wow fadeInDown"><?php echo esc_attr( get_theme_mod( 'zeal_hero_heading', __( 'Zeal', 'zeal' )  ) ); ?></h2>
    <p class="site-tagline wow fadeInUp"><?php echo esc_attr( get_theme_mod( 'zeal_hero_tagline', __( 'Designed by Smartcat', 'zeal' )  ) ); ?></p>

    <div class="big-hero-buttons wow fadeInUp">
        
        <?php if( '' != get_theme_mod( 'zeal_hero_button_1_text', __( 'View Demo', 'zeal' ) ) ) : ?>
        
            <?php 
            if ( is_null( get_theme_mod( 'zeal_hero_button_1_url', null ) ) || '' == get_theme_mod( 'zeal_hero_button_1_url', null ) ) :
                    $button_link_1 = esc_url( get_permalink( get_theme_mod( 'zeal_hero_button_1_internal', null ) ) );
            else : 
                    $button_link_1 = esc_url( get_theme_mod( 'zeal_hero_button_1_url', null ) );
            endif; 
            ?>

            <a href="<?php echo is_null( $button_link_1 ) ? '#' : $button_link_1; ?>">
                <button class="hero-button-1 dark-btn">
                    <?php echo esc_html( get_theme_mod( 'zeal_hero_button_1_text', __( 'View Demo', 'zeal' ) ) ); ?>
                </button>
            </a>
        
        <?php endif; ?>

        <?php if( '' != get_theme_mod( 'zeal_hero_button_2_text', __( 'View Portfolio', 'zeal' ) ) ) : ?>

            <?php 
            if ( is_null( get_theme_mod( 'zeal_hero_button_2_url', null ) ) || '' == get_theme_mod( 'zeal_hero_button_2_url', null ) ) :
                    $button_link_2 = esc_url( get_permalink( get_theme_mod( 'zeal_hero_button_2_internal', null ) ) );
            else : 
                    $button_link_2 = esc_url( get_theme_mod( 'zeal_hero_button_2_url', null ) );
            endif; 
            ?>

            <a href="<?php echo is_null( $button_link_2 ) ? '#' : $button_link_2; ?>">
                <button class="hero-button-2 dark-btn">
                    <?php echo esc_html( get_theme_mod( 'zeal_hero_button_2_text', __( 'View Portfolio', 'zeal' ) ) ); ?>
                </button>
            </a>

        <?php endif; ?>

    </div>
    
<?php }

/**
 * 
 * Inject custom JS in the header to handle certain scripted features.
 * 
 */
function zeal_custom_script() { ?>

    <script type="text/javascript">
        
        jQuery(document).ready(function ($) {
          
            $(function(){

                $('#primary-menu').slicknav({
                    prependTo: 'nav.main-nav',
                    allowParentLinks: <?php echo get_theme_mod( 'zeal_allow_parent_links', true ) ? 'true' : 'false'; ?>,
                });

            });
          
            /*
            * Handle Blog Roll Masonry
            */
            function doMasonry() {

                var $grid = $( "#masonry-wrapper" ).imagesLoaded(function () {
                    $grid.masonry({
                        itemSelector: '.masonry-blog-item',
                        columnWidth: '.grid-sizer',
                        percentPosition: true,
                        gutter: '.gutter-sizer',
                        transitionDuration: '.75s'
                    });
                });

                <?php if ( get_theme_mod( 'zeal_blog_template', '2cols' ) == '2cols' ) : ?>

                    if ( $( window ).width() >= 768 ) {

                        $('#masonry-wrapper .gutter-sizer').css('width', '2%');
                        $('#masonry-wrapper .grid-sizer').css('width', '48%');
                        $('#masonry-wrapper .masonry-blog-item').css('width', '48%');

                    } else {

                        $('#masonry-wrapper .gutter-sizer').css('width', '0%');
                        $('#masonry-wrapper .grid-sizer').css('width', '100%');
                        $('#masonry-wrapper .masonry-blog-item').css('width', '100%');

                    }

                <?php else : ?>

                    if ( $( window ).width() >= 992 ) {  

                        $('#masonry-wrapper .gutter-sizer').css('width', '2%');
                        $('#masonry-wrapper .grid-sizer').css('width', '32%');
                        $('#masonry-wrapper .masonry-blog-item').css('width', '32%');

                    } else if ( $( window ).width() < 992 && $( window ).width() >= 768 ) {

                        $('#masonry-wrapper .gutter-sizer').css('width', '2%');
                        $('#masonry-wrapper .grid-sizer').css('width', '48%');
                        $('#masonry-wrapper .masonry-blog-item').css('width', '48%');

                    } else {

                        $('#masonry-wrapper .gutter-sizer').css('width', '0%');
                        $('#masonry-wrapper .grid-sizer').css('width', '100%');
                        $('#masonry-wrapper .masonry-blog-item').css('width', '100%');

                    }

                <?php endif; ?>

           }

           /**
            * Call Masonry on window resize and load
            */
           $( window ).resize( function() {
               doMasonry();
           });
           doMasonry();
          
        });

    </script>
    
<?php }
add_action('wp_head', 'zeal_custom_script');

function color_transfer_check() {
    
    $theme = get_theme_mod( 'zeal_theme_color', 'teal' );
    
    switch ( $theme ) :
        
        case 'blue' :
            set_theme_mod( 'zeal_skin_color_primary',   '#6AD4EC' );
            set_theme_mod( 'zeal_skin_color_secondary', '#1DBEE2' );
            break;
        
        case 'blue2' :
            set_theme_mod( 'zeal_skin_color_primary',   '#2980B9' );
            set_theme_mod( 'zeal_skin_color_secondary', '#1378BA' );
            break;
        
        case 'green' :
            set_theme_mod( 'zeal_skin_color_primary',   '#A5D742' );
            set_theme_mod( 'zeal_skin_color_secondary', '#84B234' );
            break;
        
        case 'green2' :
            set_theme_mod( 'zeal_skin_color_primary',   '#2ECC71' );
            set_theme_mod( 'zeal_skin_color_secondary', '#32E67E' );
            break;
        
        case 'orange' :
            set_theme_mod( 'zeal_skin_color_primary',   '#FAB429' );
            set_theme_mod( 'zeal_skin_color_secondary', '#F9A806' );
            break;
        
        case 'pink' :
            set_theme_mod( 'zeal_skin_color_primary',   '#E64C66' );
            set_theme_mod( 'zeal_skin_color_secondary', '#BD2841' );
            break;
        
        case 'pink2' :
            set_theme_mod( 'zeal_skin_color_primary',   '#FFCCF7' );
            set_theme_mod( 'zeal_skin_color_secondary', '#FFA3F1' );
            break;
        
        case 'purple' :
            set_theme_mod( 'zeal_skin_color_primary',   '#9A63B1' );
            set_theme_mod( 'zeal_skin_color_secondary', '#964DB5' );
            break;
        
        case 'red' :
            set_theme_mod( 'zeal_skin_color_primary',   '#BD2828' );
            set_theme_mod( 'zeal_skin_color_secondary', '#ED5E5E' );
            break;
        
        case 'teal' :
            set_theme_mod( 'zeal_skin_color_primary',   '#3eb3b1' );
            set_theme_mod( 'zeal_skin_color_secondary', '#57DBD9' );
            break;
        
        case 'teal2' :
            set_theme_mod( 'zeal_skin_color_primary',   '#6EA085' );
            set_theme_mod( 'zeal_skin_color_secondary', '#5C866F' );
            break;
        
        case 'yellow' :
            set_theme_mod( 'zeal_skin_color_primary',   '#f1c40f' );
            set_theme_mod( 'zeal_skin_color_secondary', '#CEA70B' );
            break;
       
        case null :
            
            // Default to Teal
            set_theme_mod( 'zeal_skin_color_primary',   '#3eb3b1' );
            set_theme_mod( 'zeal_skin_color_secondary', '#57DBD9' );
            break;
        
    endswitch;

    update_option( 'color_transfer_check', true );
    
}
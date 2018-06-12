<?php
/**
 * Zeal Theme Customizer.
 *
 * @package Zeal
 */

function zeal_enqueue_customizer_styles() {
    wp_enqueue_script( 'zeal-customizer-js', get_template_directory_uri() . '/inc/js/customizer.js', array( 'jquery', 'customize-controls' ), ZEAL_VERSION, true );
    wp_enqueue_style('zeal-customizer-css', get_template_directory_uri() . '/inc/css/customizer.css', array(), ZEAL_VERSION);
}
add_action( 'customize_controls_enqueue_scripts', 'zeal_enqueue_customizer_styles' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function zeal_customize_register_alt( $wp_customize ) {
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'background_image' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_section( 'title_tagline' );    
}

function zeal_customize_register( $wp_customize ) {
    
//        delete_option('theme_mods_zeal');
    
        // Resets
        $wp_customize->remove_section( 'header_image' );
        $wp_customize->remove_section( 'background_image' );
        $wp_customize->remove_section( 'colors' );
        $wp_customize->remove_section( 'static_front_page' );
        $wp_customize->remove_section( 'title_tagline' );

        // General Panel
        require_once('customizer/panel-general.php');
        
        // Jumbotron
        require_once('customizer/panel-jumbotron.php');

        // Homepage Panel
        require_once('customizer/panel-homepage.php');

        // Single Post Panel
        require_once('customizer/panel-post.php');
        
        // Blog Panel
        require_once('customizer/panel-blog.php');
        
        // Appearance Panel
        require_once('customizer/panel-appearance.php');
        
        // Footer Panel
        require_once('customizer/panel-footer.php');
        
        // Shortcodes Panel
        require_once('customizer/panel-shortcodes.php');

        // Typography Panel
        // require_once('customizer/panel-typography.php');
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        
}
if( zeal_strap_pl() ) :
    add_action( 'customize_register', 'zeal_customize_register' );
    
else :
    add_action( 'customize_register', 'zeal_customize_register_alt' );
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function zeal_customize_preview_js() {
	wp_enqueue_script( 'zeal_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), ZEAL_VERSION, true );
}
add_action( 'customize_preview_init', 'zeal_customize_preview_js' );

/**
 * Returns all posts as an array.
 * Pass true to include Pages
 * 
 * @param boolean $include_pages
 * @return array of posts
 */
function zeal_all_posts_array( $include_pages = false ) {
    
    $posts = get_posts( array(
        'post_type'        => $include_pages ? array( 'post', 'page' ) : 'post',
        'posts_per_page'   => -1,
        'post_status'      => 'publish',
        'orderby'          => 'title',
        'order'            => 'ASC',
    ));

    $posts_array = array();

    foreach ( $posts as $post ) :
        
        if ( ! empty( $post->ID ) ) :
            $posts_array[ $post->ID ] = $post->post_title;
        endif;
        
    endforeach;
    
    return $posts_array;
    
}

function zeal_fonts() {

    $font_family_array = array(

        'Lobster Two, cursive' => 'Lobster+Two',
        'Impact, Charcoal, sans-serif' => 'Impact',
        'Josefin Sans, sans-serif' => 'Josefin',
        'Lucida Console, Monaco, monospace' => 'Lucida Console',
        'Lucida Sans Unicode, Lucida Grande, sans-serif' => 'Lucida Sans Unicode',
        'MS Sans Serif, Geneva, sans-serif' => 'MS Sans Serif',
        'MS Serif, New York, serif' => 'MS Serif',
        'Open Sans, sans-serif' => 'Open Sans',
        'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
        'Source Sans Pro, sans-serif' => 'Source Sans Pro',
        'Lato, sans-serif' => 'Lato',
        'Abel, sans-serif' => 'Abel',
        'Bangers, cursive' => 'Bangers',
        'Lobster Two, cursive' => 'Lobster+Two',
        'Josefin Sans, sans-serif' => 'Josefin+Sans:300,400,600,700',
        'Montserrat, sans-serif' => 'Montserrat:400,700',
        'Poiret One, cursive' => 'Poiret+One',
        'Source Sans Pro, sans-serif' => 'Source+Sans+Pro:200,400,600',
        'Lato, sans-serif' => 'Lato:100,300,400,700,900,300italic,400italic',
        'Raleway, sans-serif' => 'Raleway:400,300,500,700',
        'Shadows Into Light, cursive' => 'Shadows+Into+Light',
        'Orbitron, sans-serif' => 'Orbitron',
        'PT Sans Narrow, sans-serif' => 'PT+Sans+Narrow',
        'Lora, serif' => 'Lora',
        'Oswald, sans-serif' => 'Oswald:300',
        'Titillium Web, sans-serif' => 'Titillium+Web:400,200,300,600,700,200italic,300italic,400italic,600italic,700italic'
    );
    
    return $font_family_array;
}


function zeal_strap_pl() {
    
    if (get_option( 'zeal-pro_license_key_status', false) == 'valid') :
        
        return true;
    
    endif;

    return false;
}

function zeal_sanitize( $input ) {
    return $input;
}

function zeal_sanitize_post( $input ) {
    return $input;
}

function zeal_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

function zeal_sanitize_url( $input ) {
    return esc_url( $input );
}

function zeal_sanitize_integer( $input ) {
    return intval( $input );
}


function zeal_sanitize_filter_color( $input ) {
    return hex2rgba( $input, 0.25 );  
}

function zeal_sanitize_comments_toggle( $input ) {
    
    $valid_keys = array(
        'on'        => __( 'Allow Comments', 'zeal' ),
        'off'       => __( 'No Comments', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_background_toggle( $input ) {
    $valid_keys = array(
        'image' => __( 'Use a background image', 'zeal' ),
        'color' => __( 'Use a solid color background', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
}

function zeal_sanitize_post_column_ratio( $input ) {
    $valid_keys = array(
        'three-nine'    => __( '3:9', 'zeal' ),
        'four-eight'    => __( '4:8', 'zeal' ),
        'six-six'       => __( '6:6', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
}

function zeal_sanitize_tint_toggle( $input ) {
    
    $valid_keys = array(
        'on'            => __( 'Apply Filter', 'zeal' ),
        'off'           => __( 'No Filter', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_logo_or_title_switch( $input ) {
    
    $valid_keys = array(
        'title'         => __( 'Use Site Title', 'zeal' ),
        'logo'          => __( 'Use Logo', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_show_hide( $input ) {
    
    $valid_keys = array(
        'show'          => __( 'Show', 'zeal' ),
        'hide'          => __( 'Hide', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_cta_area_toggle( $input ) {
    
    $valid_keys = array(
        'on'            => __( 'Visible', 'zeal' ),
        'off'           => __( 'Hidden', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_allow_parent_links( $input ) {
    
    $valid_keys = array(
        true            => __( 'Clicking on a top level item navigates to the link location', 'zeal' ),
        false           => __( 'Clicking on a top level item has no effect', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

function zeal_sanitize_feat_post_content_toggle( $input ) {
    
    $valid_keys = array(
        'post'          => __( 'Use image, title, and content of selected post', 'zeal' ),
        'custom'        => __( 'Use image, title, and content I choose below', 'zeal' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
    
}

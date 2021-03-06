<?php

// ---------------------------------------------
// Jumbotron Panel
// ---------------------------------------------
$wp_customize->add_panel( 'slider', array (
    'title'                 => __( 'Jumbotron', 'zeal' ),
    'description'           => __( 'Customize the appearance of the site Jumbotron', 'zeal' ),
    'priority'              => 10
) );


// ---------------------------------------------
// Jumbotron Sections
// ---------------------------------------------

$wp_customize->add_section( 'slider_images', array (
    'title'                 => __( 'Slider Images', 'zeal' ),
    'description'           => __( 'Use the settings below to upload your images', 'zeal' ),
    'panel'                 => 'slider',
) );

$wp_customize->add_section( 'hero', array(
    'title'                 => __( 'Static Image', 'zeal'),
    'description'           => __( 'Customize the large banner on your homepage', 'zeal' ),
    'panel'                 => 'slider'
) );
    
$wp_customize->add_section( 'slide_settings', array (
    'title'                 => __( 'Jumbotron Settings', 'zeal' ),
    'description'           => __( 'Adjust the slider speed & animation', 'zeal' ),
    'panel'                 => 'slider',
) );




//----------------------------
// slide_settings Section
//----------------------------
$wp_customize->add_setting( 'zeal_slider_bool', array (
    'default'               => 'on',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize'
) );

$wp_customize->add_control( 'zeal_slider_bool', array(
    'label'   => __( 'Display Jumbotron on Frontpage', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'radio',
    'choices'    => array(
        'on'    => __( 'Show', 'zeal' ),
        'off'    => __( 'Hide', 'zeal' )
    )
));

// Hero Filter Toggle
$wp_customize->add_setting( 'zeal_hero_tint_toggle', array (
    'default'               => 'on',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_tint_toggle',
) );
$wp_customize->add_control( 'zeal_hero_tint_toggle', array(
    'type'                  => 'radio',
    'section'               => 'slide_settings',
    'label'                 => __( 'Colour Filter Toggle', 'zeal' ),
    'description'           => __( 'Specify whether you would like a tinted color filter displayed over the homepage banner', 'zeal' ),
    'choices'               => array(
        'on'            => __( 'Apply Filter', 'zeal' ),
        'off'           => __( 'No Filter', 'zeal' ),
) ) );

// Hero Overlay Filter
$wp_customize->add_setting( 'zeal_hero_tint', array (
    'default'               => 'rgba(10, 10, 10, 0.25)',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_filter_color',
) );
$wp_customize->add_control( 
    new WP_Customize_Color_Control( $wp_customize, 'zeal_hero_tint', array(
            'label'      => __( 'Filter Colour', 'zeal' ),
            'section'    => 'slide_settings',
            'settings'   => 'zeal_hero_tint',
    ) ) 
);  

$wp_customize->add_setting( 'zeal_slide_type', array (
    'default'               => 'static',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text'
) );

$wp_customize->add_control( 'zeal_slide_type', array(
    'label'   => __( 'Jumbotron Style', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'select',
    'choices'    => array(
        'slider'  => __( 'Slider', 'zeal' ),
        'static'  => __( 'Static Image', 'zeal' ),
    )
));

$wp_customize->add_setting( 'zeal_slider_height', array (
    'default'               => __( 450, 'zeal' ),
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text',
) );
$wp_customize->add_control( 'zeal_slider_height', array(
    'type'                  => 'text',
    'section'               => 'slide_settings',
    'label'                 => __( 'Slider height', 'zeal' ),
) );

$wp_customize->add_setting( 'zeal_slide_timer', array (
    'default'               => '3000',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text'
) );

$wp_customize->add_control( 'zeal_slide_timer', array(
    'label'   => __( 'Slide Delay', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'select',
    'choices'    => array(
        '2000'  => __( '2 Seconds', 'zeal' ),
        '3000'  => __( '3 Seconds', 'zeal' ),
        '4000'  => __( '4 Seconds', 'zeal' ),
        '5000'  => __( '5 Seconds', 'zeal' ),
        '6000'  => __( '6 Seconds', 'zeal' ),
    )
));

$wp_customize->add_setting( 'zeal_slide_transition', array (
    'default'               => 'random',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text'
) );

$wp_customize->add_control( 'zeal_slide_transition', array(
    'label'   => __( 'Slide Transition Effect', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'select',
    'choices'    => array(
        'simpleFade'  => __( 'Fade', 'zeal' ),
        'scrollTop'  => __( 'Scroll Top', 'zeal' ),
        'scrollHorz'  => __( 'Horizontal Scroll', 'zeal' ),
        'mosaicSpiral'  => __( 'Mosaic Spiral', 'zeal' ),
        'mosaicRandom'  => __( 'Mosaic Random', 'zeal' ),
        'mosaicReverse'  => __( 'Mosaic Reverse', 'zeal' ),
        'stampede'  => __( 'Stampede', 'zeal' ),
        'random'  => __( 'Random', 'zeal' ),

    )
));

$wp_customize->add_setting( 'zeal_slide_loader', array (
    'default'               => 'bar',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text'
) );

$wp_customize->add_control( 'zeal_slide_loader', array(
    'label'   => __( 'Slide Loader Style', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'select',
    'choices'    => array(
        'pie'  => __( 'Pie', 'zeal' ),
        'bar'  => __( 'Bar', 'zeal' ),
        'none'  => __( 'None', 'zeal' ),


    )
));

$wp_customize->add_setting( 'zeal_slide_pagination', array (
    'default'               => 'true',
    'transport'             => 'refresh',
    'sanitize_callback'     => 'zeal_sanitize_text'
) );

$wp_customize->add_control( 'zeal_slide_pagination', array(
    'label'   => __( 'Slider Next/Previous Buttons', 'zeal' ),
    'section' => 'slide_settings',
    'type'    => 'select',
    'choices'    => array(
        'true'  => __( 'Show', 'zeal' ),
        'false'  => __( 'Hide', 'zeal' ),

    )
));


// ---------------------------------------------
// Hero Section - Settings & Controls
// ---------------------------------------------

    // Use Image or Colour for Background? 
    $wp_customize->add_setting( 'zeal_hero_background_style', array (
        'default'               => 'image',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_background_toggle',
    ) );
    $wp_customize->add_control( 'zeal_hero_background_style', array(
        'type'                  => 'radio',
        'section'               => 'hero',
        'label'                 => __( 'Image or Color', 'zeal' ),
        'description'           => __( 'Specify whether you would like the background of the banner to be solid colour, a static background image or an image slider', 'zeal' ),
        'choices'               => array(
            'image'             => __( 'Use a background image', 'zeal' ),
            'color'             => __( 'Use a solid color background', 'zeal' ),
    ) ) );

    // Hero Banner Image
    $wp_customize->add_setting( 'zeal_hero_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_hero_image', array (
        'mime_type'             => 'image',
        'settings'              => 'zeal_hero_image',
        'section'               => 'hero',
        'label'                 => __( 'Banner Background Image', 'zeal' ),
        'description'           => __( 'Select the image file that you would like to use as the homepage banner background', 'zeal' ),        
    ) ) );
    
    // Hero Background Color
    $wp_customize->add_setting( 'zeal_hero_bg_color', array (
        'default'               => '#0D0D0D',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 
	new WP_Customize_Color_Control( $wp_customize, 'zeal_hero_bg_color', array(
		'label'      => __( 'Banner Background Color', 'zeal' ),
		'section'    => 'hero',
		'settings'   => 'zeal_hero_bg_color',
	) ) 
    );  
    
    // --------------------------------
    // Slide Section
    // --------------------------------
    
    // 1st slide
    $wp_customize->add_setting( 'zeal_featured_image[slide1]', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_featured_image[slide1]', array (
        'label' =>              __( 'Slide 1', 'zeal' ),
        'section'               => 'slider_images',
        'mime_type'             => 'image',
        'settings'              => 'zeal_featured_image[slide1]',
        'description'           => __( 'Select the image file that you would like to use as the featured images', 'zeal' ),
    ) ) );
    
    // 2nd slide
    $wp_customize->add_setting( 'zeal_featured_image[slide2]', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo2.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_featured_image[slide2]', array (
        'label' =>              __( 'Slide 2', 'zeal' ),
        'section'               => 'slider_images',
        'mime_type'             => 'image',
        'settings'              => 'zeal_featured_image[slide2]',
        'description'           => __( 'Select the image file that you would like to use as the featured images', 'zeal' ),
    ) ) );
    
    // 3rd slide
    $wp_customize->add_setting( 'zeal_featured_image[slide3]', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_featured_image[slide3]', array (
        'label' =>              __( 'Slide 3', 'zeal' ),
        'section'               => 'slider_images',
        'mime_type'             => 'image',
        'settings'              => 'zeal_featured_image[slide3]',
        'description'           => __( 'Select the image file that you would like to use as the featured images', 'zeal' ),
    ) ) );
    
    // 4th slide
    $wp_customize->add_setting( 'zeal_featured_image[slide4]', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_featured_image[slide4]', array (
        'label' =>              __( 'Slide 4', 'zeal' ),
        'section'               => 'slider_images',
        'mime_type'             => 'image',
        'settings'              => 'zeal_featured_image[slide4]',
        'description'           => __( 'Select the image file that you would like to use as the featured images', 'zeal' ),
    ) ) );
    
    // 5th slide
    $wp_customize->add_setting( 'zeal_featured_image[slide5]', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_featured_image[slide5]', array (
        'label' =>              __( 'Slide 5', 'zeal' ),
        'section'               => 'slider_images',
        'mime_type'             => 'image',
        'settings'              => 'zeal_featured_image[slide5]',
        'description'           => __( 'Select the image file that you would like to use as the featured images', 'zeal' ),
    ) ) );

    
   
    // Hero Banner Heading Text
    $wp_customize->add_setting( 'zeal_hero_heading', array (
        'default'               => __( 'Zeal', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_hero_heading', array(
        'type'                  => 'text',
        'section'               => 'slide_settings',
        'label'                 => __( 'Banner Heading', 'zeal' ),
    ) );
    
    // Hero Banner Heading Font Size
    $wp_customize->add_setting( 'zeal_hero_heading_size', array (
        'default'               => 50,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_hero_heading_size', array(
        'type'                  => 'number',
        'section'               => 'slide_settings',
        'label'                 => __( 'Banner Heading Font Size', 'zeal' ),
        'description'           => __( 'Adjust the font size of the banner heading in pixels', 'zeal' ),
        'input_attrs'           => array(
            'min' => 18,
            'max' => 72,
            'step' => 2,
    ) ) );
    
    // Hero Banner Tagline Text
    $wp_customize->add_setting( 'zeal_hero_tagline', array (
        'default'               => __( 'Designed by Smartcat', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_hero_tagline', array(
        'type'                  => 'text',
        'section'               => 'slide_settings',
        'label'                 => __( 'Banner Tagline', 'zeal' ),
    ) );

    // Hero Banner Tagline Font Size
    $wp_customize->add_setting( 'zeal_hero_tagline_size', array (
        'default'               => 10,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_hero_tagline_size', array(
        'type'                  => 'number',
        'section'               => 'slide_settings',
        'label'                 => __( 'Banner Tagline Font Size', 'zeal' ),
        'description'           => __( 'Adjust the font size of the banner tagline in pixels', 'zeal' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 40,
            'step' => 2,
    ) ) );
    
    // Hero Banner Buttons Visibility
    // TODO !!!
    
    // Hero Banner Button 1 Text 
    $wp_customize->add_setting( 'zeal_hero_button_1_text', array (
        'default'               => __( 'View Demo', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_1_text', array(
        'type'                  => 'text',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 1 - Text', 'zeal' ),
    ) );

    // Hero Banner Button 1 Internal Link
    $wp_customize->add_setting( 'zeal_hero_button_1_internal', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_1_internal', array(
        'type'                  => 'select',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 1 - Link to Post / Page', 'zeal' ),
        'choices'               => zeal_all_posts_array( true ),
    ) );
    
    // Hero Banner Button 1 External URL
    $wp_customize->add_setting( 'zeal_hero_button_1_url', array (
        'default'               => null,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_1_url', array(
        'type'                  => 'url',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 1 - External URL', 'zeal' ),
        'description'           => __( 'When not blank, forces Button 1 to link to an external URL instead of a specified post/page', 'zeal' ),
    ) );
    
    // Hero Banner Button 2 Text 
    $wp_customize->add_setting( 'zeal_hero_button_2_text', array (
        'default'               => __( 'View Portfolio', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_2_text', array(
        'type'                  => 'text',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 2 - Text', 'zeal' ),
    ) );

    // Hero Banner Button 2 Internal Link
    $wp_customize->add_setting( 'zeal_hero_button_2_internal', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_2_internal', array(
        'type'                  => 'select',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 2 - Link to Post / Page', 'zeal' ),
        'choices'               => zeal_all_posts_array( true ),
    ) );
    
    // Hero Banner Button 2 External URL
    $wp_customize->add_setting( 'zeal_hero_button_2_url', array (
        'default'               => null,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'zeal_hero_button_2_url', array(
        'type'                  => 'url',
        'section'               => 'slide_settings',
        'label'                 => __( 'Button 2 - External URL', 'zeal' ),
        'description'           => __( 'When not blank, forces Button 2 to link to an external URL instead of a specified post/page', 'zeal' ),
    ) );

    $wp_customize->add_setting( 'zeal_jumbo_button_size', array (
        'default'               => 10,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_jumbo_button_size', array(
        'type'                  => 'number',
        'section'               => 'slide_settings',
        'label'                 => __( 'Buttons Font Size', 'zeal' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 40,
            'step' => 2,
    ) ) );
    
    $wp_customize->add_setting( 'zeal_jumbo_text_color', array (
        'default'               => '#ffffff',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 
	new WP_Customize_Color_Control( $wp_customize, 'zeal_jumbo_text_color', array(
		'label'      => __( 'Banner Text Color', 'zeal' ),
		'section'    => 'slide_settings',
		'settings'   => 'zeal_jumbo_text_color',
	) ) 
    );     

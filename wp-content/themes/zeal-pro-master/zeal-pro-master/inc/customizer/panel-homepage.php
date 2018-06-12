<?php

// ---------------------------------------------
// Homepage Panel
// ---------------------------------------------
$wp_customize->add_panel( 'homepage', array (
    'title'                 => __( 'Frontpage', 'zeal' ),
    'description'           => __( 'Customize the appearance of your homepage', 'zeal' ),
    'priority'              => 10
) );

    // ---------------------------------------------
    // Featured Post Section
    // ---------------------------------------------
    $wp_customize->add_section( 'featured_post', array(
        'title'                 => __( 'Featured Post #1', 'zeal'),
        'description'           => __( 'Customize the featured post that appears beneath the banner on your homepage', 'zeal' ),
        'panel'                 => 'homepage'
    ) );

    // ---------------------------------------------
    // Featured Post Section - Settings & Controls
    // ---------------------------------------------
    
    $wp_customize->add_setting( 'zeal_the_featured_post_bool', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post_bool', array(
        'type'                  => 'radio',
        'section'               => 'featured_post',
        'label'                 => __( 'Show Featured Post #1 ?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    // Featured Post - Select the Post
    $wp_customize->add_setting( 'zeal_the_featured_post', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post', array(
        'type'                  => 'select',
        'section'               => 'featured_post',
        'label'                 => __( 'Select the Featured Post', 'zeal' ),
        'choices'               => zeal_all_posts_array( true ),
    ) );
    
    // Featured Post 1 - Custom Height 
    $wp_customize->add_setting( 'zeal_feat_home_1_height', array (
        'default'               => 585,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_height', array(
        'type'                  => 'number',
        'section'               => 'featured_post',
        'label'                 => __( 'Row Height of Featured Post 1', 'juno' ),
        'input_attrs'           => array(
            'min' => 300,
            'max' => 1000,
            'step' => 20,
    ) ) );
    
    $wp_customize->add_setting( 'zeal_the_featured_post_button', array (
        'default'               => __( 'Read More', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post_button', array(
        'type'                  => 'text',
        'section'               => 'featured_post',
        'label'                 => __( 'Button Text', 'zeal' ),
    ) );
    
    // Featured Post 1 - Fade Effect
    $wp_customize->add_setting( 'zeal_feat_home_1_fade', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_fade', array(
        'label'   => __( 'Bottom Fade Effect on Featured Post #1?', 'zeal' ),
        'section' => 'featured_post',
        'type'    => 'radio',
        'choices'    => array(
            'show'          => __( 'Show', 'zeal' ),
            'hide'          => __( 'Hide', 'zeal' ),
        )
    ));
    
    // Featured Post 1 - Custom Content Toggle
    $wp_customize->add_setting( 'zeal_feat_home_1_custom_toggle', array (
        'default'               => 'post',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_feat_post_content_toggle'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_custom_toggle', array(
        'label'   => __( 'Use a Featured Post or Custom Content?', 'zeal' ),
        'section' => 'featured_post',
        'type'    => 'radio',
        'choices'    => array(
            'post'          => __( 'Use image, title, and content of selected post', 'zeal' ),
            'custom'        => __( 'Use image, title, and content I choose below', 'zeal' ),
        )
    ));
    
    // Featured Post 1 - Custom Content Image
    $wp_customize->add_setting( 'zeal_feat_home_1_custom_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/jesse1.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_feat_home_1_custom_image', array (
        'label' =>              __( 'Custom Content - Image', 'zeal' ),
        'section'               => 'featured_post',
        'mime_type'             => 'image',
        'settings'              => 'zeal_feat_home_1_custom_image',
        'description'           => __( 'You can set an image that will be displayed if this post is toggled to Custom Content', 'zeal' ),
    ) ) );
    
    // Featured Post 1 - Custom Content Title
    $wp_customize->add_setting( 'zeal_feat_home_1_custom_title', array (
        'default'               => __( 'Featured Post - Custom Content Title', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_custom_title', array(
        'type'                  => 'text',
        'section'               => 'featured_post',
        'label'                 => __( 'Custom Content - Title', 'zeal' ),
    ) );

    // Featured Post 1 - Custom Content Content
    $wp_customize->add_setting( 'zeal_feat_home_1_custom_content', array (
        'default'               => __( 'Featured Post - Custom Content', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_custom_content', array(
        'type'                  => 'textarea',
        'section'               => 'featured_post',
        'label'                 => __( 'Custom Content', 'zeal' ),
    ) );

    // Featured Post 1 - Custom Content URL Link
    $wp_customize->add_setting( 'zeal_feat_home_1_custom_link', array (
        'default'               => '#',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_1_custom_link', array(
        'type'                  => 'text',
        'section'               => 'featured_post',
        'label'                 => __( 'Custom Content - Link / URL', 'zeal' ),
    ) );
    
    // ---------------------------------------------
    // Featured Post 2 Section
    // ---------------------------------------------
    $wp_customize->add_section( 'featured_post2', array(
        'title'                 => __( 'Featured Post #2', 'zeal'),
        'description'           => __( 'Customize the featured post that appears on your homepage', 'zeal' ),
        'panel'                 => 'homepage'
    ) );
    
    // ---------------------------------------------
    // Featured Post Section - Settings & Controls
    // ---------------------------------------------
    
    $wp_customize->add_setting( 'zeal_the_featured_post2_bool', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post2_bool', array(
        'type'                  => 'radio',
        'section'               => 'featured_post2',
        'label'                 => __( 'Show Featured Post #2 ?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    // Featured Post - Select the Post
    $wp_customize->add_setting( 'zeal_the_featured_post2', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post2', array(
        'type'                  => 'select',
        'section'               => 'featured_post2',
        'label'                 => __( 'Select the Featured Post', 'zeal' ),
        'choices'               => zeal_all_posts_array( true ),
    ) );
    
    // Featured Post 2 - Custom Height 
    $wp_customize->add_setting( 'zeal_feat_home_2_height', array (
        'default'               => 585,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_height', array(
        'type'                  => 'number',
        'section'               => 'featured_post2',
        'label'                 => __( 'Row Height of Featured Post 2', 'juno' ),
        'input_attrs'           => array(
            'min' => 300,
            'max' => 1000,
            'step' => 20,
    ) ) );
    
    $wp_customize->add_setting( 'zeal_the_featured_post2_button', array (
        'default'               => __( 'Read More', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post2_button', array(
        'type'                  => 'text',
        'section'               => 'featured_post2',
        'label'                 => __( 'Button Text', 'zeal' ),
    ) );
    
        
    // Featured Post 2 - Fade Effect
    $wp_customize->add_setting( 'zeal_feat_home_2_fade', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_fade', array(
        'label'   => __( 'Bottom Fade Effect on Featured Post #2?', 'zeal' ),
        'section' => 'featured_post2',
        'type'    => 'radio',
        'choices'    => array(
            'show'          => __( 'Show', 'zeal' ),
            'hide'          => __( 'Hide', 'zeal' ),
        )
    ));
    
    // Featured Post 2 - Custom Content Toggle
    $wp_customize->add_setting( 'zeal_feat_home_2_custom_toggle', array (
        'default'               => 'post',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_feat_post_content_toggle'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_custom_toggle', array(
        'label'   => __( 'Use a Featured Post or Custom Content?', 'zeal' ),
        'section' => 'featured_post2',
        'type'    => 'radio',
        'choices'    => array(
            'post'          => __( 'Use image, title, and content of selected post', 'zeal' ),
            'custom'        => __( 'Use image, title, and content I choose below', 'zeal' ),
        )
    ));
    
    // Featured Post 2 - Custom Content Image
    $wp_customize->add_setting( 'zeal_feat_home_2_custom_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/jesse2.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_feat_home_2_custom_image', array (
        'label' =>              __( 'Custom Content - Image', 'zeal' ),
        'section'               => 'featured_post2',
        'mime_type'             => 'image',
        'settings'              => 'zeal_feat_home_2_custom_image',
        'description'           => __( 'You can set an image that will be displayed if this post is toggled to Custom Content', 'zeal' ),
    ) ) );
    
    // Featured Post 2 - Custom Content Title
    $wp_customize->add_setting( 'zeal_feat_home_2_custom_title', array (
        'default'               => __( 'Featured Post 2 - Custom Content Title', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_custom_title', array(
        'type'                  => 'text',
        'section'               => 'featured_post2',
        'label'                 => __( 'Custom Content - Title', 'zeal' ),
    ) );

    // Featured Post 2 - Custom Content Content
    $wp_customize->add_setting( 'zeal_feat_home_2_custom_content', array (
        'default'               => __( 'Featured Post 2 - Custom Content', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_custom_content', array(
        'type'                  => 'textarea',
        'section'               => 'featured_post2',
        'label'                 => __( 'Custom Content', 'zeal' ),
    ) );

    // Featured Post 2 - Custom Content URL Link
    $wp_customize->add_setting( 'zeal_feat_home_2_custom_link', array (
        'default'               => '#',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_2_custom_link', array(
        'type'                  => 'text',
        'section'               => 'featured_post2',
        'label'                 => __( 'Custom Content - Link / URL', 'zeal' ),
    ) );
    
    // ---------------------------------------------
    // Featured Post 3 Section
    // ---------------------------------------------
    $wp_customize->add_section( 'featured_post3', array(
        'title'                 => __( 'Featured Post #3', 'zeal'),
        'description'           => __( 'Customize the featured post that appears on your homepage', 'zeal' ),
        'panel'                 => 'homepage'
    ) );
    
    // ---------------------------------------------
    // Featured Post Section - Settings & Controls
    // ---------------------------------------------
    
    $wp_customize->add_setting( 'zeal_the_featured_post3_bool', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post3_bool', array(
        'type'                  => 'radio',
        'section'               => 'featured_post3',
        'label'                 => __( 'Show Featured Post #3 ?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    // Featured Post - Select the Post
    $wp_customize->add_setting( 'zeal_the_featured_post3', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post3', array(
        'type'                  => 'select',
        'section'               => 'featured_post3',
        'label'                 => __( 'Select the Featured Post', 'zeal' ),
        'choices'               => zeal_all_posts_array( true ),
    ) );
    
    // Featured Post 3 - Custom Height 
    $wp_customize->add_setting( 'zeal_feat_home_3_height', array (
        'default'               => 585,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_height', array(
        'type'                  => 'number',
        'section'               => 'featured_post3',
        'label'                 => __( 'Row Height of Featured Post 3', 'juno' ),
        'input_attrs'           => array(
            'min' => 300,
            'max' => 1000,
            'step' => 20,
    ) ) );

    $wp_customize->add_setting( 'zeal_the_featured_post3_button', array (
        'default'               => __( 'Read More', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_the_featured_post3_button', array(
        'type'                  => 'text',
        'section'               => 'featured_post3',
        'label'                 => __( 'Button Text', 'zeal' ),
    ) );
        
    // Featured Post 3 - Fade Effect
    $wp_customize->add_setting( 'zeal_feat_home_3_fade', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_fade', array(
        'label'   => __( 'Bottom Fade Effect on Featured Post #3?', 'zeal' ),
        'section' => 'featured_post3',
        'type'    => 'radio',
        'choices'    => array(
            'show'          => __( 'Show', 'zeal' ),
            'hide'          => __( 'Hide', 'zeal' ),
        )
    ));
    
    // Featured Post 3 - Custom Content Toggle
    $wp_customize->add_setting( 'zeal_feat_home_3_custom_toggle', array (
        'default'               => 'post',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_feat_post_content_toggle'
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_custom_toggle', array(
        'label'   => __( 'Use a Featured Post or Custom Content?', 'zeal' ),
        'section' => 'featured_post3',
        'type'    => 'radio',
        'choices'    => array(
            'post'          => __( 'Use image, title, and content of selected post', 'zeal' ),
            'custom'        => __( 'Use image, title, and content I choose below', 'zeal' ),
        )
    ));
    
    // Featured Post 2 - Custom Content Image
    $wp_customize->add_setting( 'zeal_feat_home_3_custom_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/jesse1.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_feat_home_3_custom_image', array (
        'label' =>              __( 'Custom Content - Image', 'zeal' ),
        'section'               => 'featured_post3',
        'mime_type'             => 'image',
        'settings'              => 'zeal_feat_home_3_custom_image',
        'description'           => __( 'You can set an image that will be displayed if this post is toggled to Custom Content', 'zeal' ),
    ) ) );
    
    // Featured Post 2 - Custom Content Title
    $wp_customize->add_setting( 'zeal_feat_home_3_custom_title', array (
        'default'               => __( 'Featured Post 3 - Custom Content Title', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_custom_title', array(
        'type'                  => 'text',
        'section'               => 'featured_post3',
        'label'                 => __( 'Custom Content - Title', 'zeal' ),
    ) );

    // Featured Post 2 - Custom Content Content
    $wp_customize->add_setting( 'zeal_feat_home_3_custom_content', array (
        'default'               => __( 'Featured Post 3 - Custom Content', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_custom_content', array(
        'type'                  => 'textarea',
        'section'               => 'featured_post3',
        'label'                 => __( 'Custom Content', 'zeal' ),
    ) );

    // Featured Post 2 - Custom Content URL Link
    $wp_customize->add_setting( 'zeal_feat_home_3_custom_link', array (
        'default'               => '#',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'zeal_feat_home_3_custom_link', array(
        'type'                  => 'text',
        'section'               => 'featured_post3',
        'label'                 => __( 'Custom Content - Link / URL', 'zeal' ),
    ) );
    
    // ---------------------------------------------
    // Homepage Widget A
    // ---------------------------------------------
    $wp_customize->add_section( 'cta_area_a', array(
        'title'                 => __( 'Homepage A', 'zeal'),
        'panel'                 => 'homepage'
    ) );
    
    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_cta_a_toggle', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_cta_a_toggle', array(
        'type'                  => 'radio',
        'section'               => 'cta_area_a',
        'label'                 => __( 'Show Front Page CTA / Widget Area?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    $wp_customize->add_setting( 'zeal_cta_a_image', array (
        'default'               => '',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_cta_a_image', array (
        'label' =>              __( 'Background Image', 'zeal' ),
        'section'               => 'cta_area_a',
        'mime_type'             => 'image',
        'settings'              => 'zeal_cta_a_image',
        'description'           => __( 'You can set an image as a background, or leave blank for default background color', 'zeal' ),
    ) ) );
    
    // ---------------------------------------------
    // Homepage Widget B
    // ---------------------------------------------
    $wp_customize->add_section( 'cta_area_b', array(
        'title'                 => __( 'Homepage B', 'zeal'),
        'panel'                 => 'homepage'
    ) );
    
    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_cta_b_toggle', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_cta_b_toggle', array(
        'type'                  => 'radio',
        'section'               => 'cta_area_b',
        'label'                 => __( 'Show Front Page CTA / Widget Area?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    $wp_customize->add_setting( 'zeal_cta_b_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo3.jpg',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_cta_b_image', array (
        'label' =>              __( 'Background Image', 'zeal' ),
        'section'               => 'cta_area_b',
        'mime_type'             => 'image',
        'settings'              => 'zeal_cta_b_image',
        'description'           => __( 'You can set an image as a background, or leave blank for default background color', 'zeal' ),
    ) ) );
    
    // ---------------------------------------------
    // Homepage Widget C
    // ---------------------------------------------
    $wp_customize->add_section( 'cta_area_c', array(
        'title'                 => __( 'Homepage C', 'zeal'),
        'panel'                 => 'homepage'
    ) );
    
    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_cta_c_toggle', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_cta_c_toggle', array(
        'type'                  => 'radio',
        'section'               => 'cta_area_c',
        'label'                 => __( 'Show Front Page CTA / Widget Area?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    $wp_customize->add_setting( 'zeal_cta_c_image', array (
        'default'               => '',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_cta_c_image', array (
        'label' =>              __( 'Background Image', 'zeal' ),
        'section'               => 'cta_area_c',
        'mime_type'             => 'image',
        'settings'              => 'zeal_cta_c_image',
        'description'           => __( 'You can set an image as a background, or leave blank for default background color', 'zeal' ),
    ) ) );
    
    // ---------------------------------------------
    // Homepage Widget D
    // ---------------------------------------------
    $wp_customize->add_section( 'cta_area_d', array(
        'title'                 => __( 'Homepage D', 'zeal'),
        'panel'                 => 'homepage'
    ) );
    
    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_cta_d_toggle', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_dallback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_cta_d_toggle', array(
        'type'                  => 'radio',
        'section'               => 'cta_area_d',
        'label'                 => __( 'Show Front Page CTA / Widget Area?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
//    $wp_customize->add_setting( 'zeal_cta_d_image', array (
//        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
//        'sanitize_dallback'     => 'zeal_sanitize'
//    ) );
//
//    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_cta_d_image', array (
//        'label' =>              __( 'Background Image', 'zeal' ),
//        'section'               => 'cta_area_d',
//        'mime_type'             => 'image',
//        'settings'              => 'zeal_cta_d_image',
//        'description'           => __( 'You can set an image as a background, or leave blank for default background color', 'zeal' ),
//    ) ) );
    
    // ---------------------------------------------
    // Homepage Widget E
    // ---------------------------------------------
    $wp_customize->add_section( 'cta_area_e', array(
        'title'                 => __( 'Homepage E', 'zeal'),
        'panel'                 => 'homepage'
    ) );
    
    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_cta_e_toggle', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_dallback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_cta_e_toggle', array(
        'type'                  => 'radio',
        'section'               => 'cta_area_e',
        'label'                 => __( 'Show Front Page CTA / Widget Area?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
//    $wp_customize->add_setting( 'cta_e_image', array (
//        'default'               => get_template_directory_uri() . '/inc/images/zeal-demo.jpg',
//        'sanitize_dallback'     => 'zeal_sanitize'
//    ) );
//
//    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cta_e_image', array (
//        'label' =>              __( 'Background Image', 'zeal' ),
//        'section'               => 'cta_area_e',
//        'mime_type'             => 'image',
//        'settings'              => 'cta_e_image',
//        'description'           => __( 'You can set an image as a background, or leave blank for default background color', 'zeal' ),
//    ) ) );
    
    
    // ---------------------------------------------
    // Portfolio Section
    // ---------------------------------------------
    $wp_customize->add_section( 'portfolio', array(
        'title'                 => __( 'Blog', 'zeal'),
        'description'           => __( 'Customize the portfolio section on your homepage', 'zeal' ),
        'panel'                 => 'homepage'
    ) );
    
// ---------------------------------------------
// Static frontpage
// ---------------------------------------------
$wp_customize->add_section( 'static_front_page', array (
    'title' => __( 'Homepage Content', 'athena' ),
    'panel' => 'homepage',
) );

    // Toggle Visibility of CTA / Widget Area
    $wp_customize->add_setting( 'zeal_homepage_content_bool', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_homepage_content_bool', array(
        'type'                  => 'radio',
        'section'               => 'static_front_page',
        'label'                 => __( 'Show the frontpage content ?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
<?php
// ---------------------------------------------
// Blog Panel
// ---------------------------------------------
$wp_customize->add_panel( 'blog_panel', array (
    'title'                 => __( 'Blog', 'zeal' ),
    'description'           => __( 'Customize the blog template', 'zeal' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Blog Layout Section
// ---------------------------------------------
$wp_customize->add_section( 'blog_layout', array(
    'title'                 => __( 'Layout', 'zeal'),
    'description'           => __( 'Customize the layout of your blog template', 'zeal' ),
    'panel'                 => 'blog_panel'
) );

    // Blog Roll Columns
    $wp_customize->add_setting( 'zeal_blog_template', array (
        'default'               => '2cols',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_blog_template', array(
        'type'                  => 'radio',
        'section'               => 'blog_layout',
        'label'                 => __( 'Blog Columns', 'zeal' ),
        'choices'               => array(
            '2cols'    => __( '2-Column', 'zeal' ),
            '3cols'    => __( '3-Column', 'zeal' ),
    ) ) );

    // Blog Template Layout
    $wp_customize->add_setting( 'zeal_blog_layout_style', array (
        'default'               => 'default',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_blog_layout_style', array(
        'type'                  => 'radio',
        'section'               => 'blog_layout',
        'label'                 => __( 'Blog Layout / Style', 'zeal' ),
        'choices'               => array(
            'default'       => __( 'Default', 'zeal' ),
            'dark-tiles'    => __( 'Dark Masonry Tiles', 'zeal' ),
            'light-tiles'    => __( 'Light Masonry Tiles', 'zeal' ),
    ) ) );
    
    // Masonry - Number of Words to trim to
    $wp_customize->add_setting( 'zeal_blog_masonry_word_trim', array (
        'default'               => 50,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_blog_masonry_word_trim', array(
        'type'                  => 'number',
        'section'               => 'blog_layout',
        'label'                 => __( 'Masonry - Trim Content to How Many Words?', 'zeal' ),
        'input_attrs'           => array(
            'min' => 0,
            'max' => 200,
            'step' => 5,
    ) ) );
    
    // Masonry - Show Author on Blog Roll Posts?
    $wp_customize->add_setting( 'zeal_blog_masonry_show_author', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_blog_masonry_show_author', array(
        'type'                  => 'radio',
        'section'               => 'blog_layout',
        'label'                 => __( 'Masonry - Show Author Link on Posts?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    // Masonry - Show Post Date on Blog Roll Posts?
    $wp_customize->add_setting( 'zeal_blog_masonry_show_date', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_blog_masonry_show_date', array(
        'type'                  => 'radio',
        'section'               => 'blog_layout',
        'label'                 => __( 'Masonry - Show Date on Posts?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
    
    // ---------------------------------------------
    // Portfolio Section - Settings & Controls
    // ---------------------------------------------
    
    // Hero Banner Heading Text
    $wp_customize->add_setting( 'zeal_portfolio_section_name', array (
        'default'               => __( 'Blog', 'zeal' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_portfolio_section_name', array(
        'type'                  => 'text',
        'section'               => 'blog_layout',
        'label'                 => __( 'Blog Section Heading', 'zeal' ),
    ) );
    
    // Title size
    $wp_customize->add_setting( 'zeal_blog_title_size', array(
        'default'               => 24,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_blog_title_size', array(
        'type'                  => 'number',
        'section'               => 'blog_layout',
        'label'                 => __( 'Post Title Font Size', 'zeal' ),
        'input_attrs'           => array(
            'min' => 10,
            'max' => 72,
            'step' => 2,
    ) ) );
        
    // Read More Link Size
    $wp_customize->add_setting( 'zeal_blog_link_size', array(
        'default'               => 10,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_blog_link_size', array(
        'type'                  => 'number',
        'section'               => 'blog_layout',
        'label'                 => __( 'Post Link Font Size', 'zeal' ),
        'input_attrs'           => array(
            'min' => 6,
            'max' => 72,
            'step' => 2,
    ) ) );
    
    // Content Blurb Size
    $wp_customize->add_setting( 'zeal_blog_content_size', array (
        'default'               => 12,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_blog_content_size', array(
        'type'                  => 'number',
        'section'               => 'blog_layout',
        'label'                 => __( 'Masonry - Content Excerpt Font Size', 'zeal' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 72,
            'step' => 2,
    ) ) );
    
    // Read More Text
    $wp_customize->add_setting( 'zeal_blog_link_text', array (
        'default'               => __( 'Read More', 'zeal' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_text',
    ) );
    $wp_customize->add_control( 'zeal_blog_link_text', array(
        'type'                  => 'text',
        'section'               => 'blog_layout',
        'label'                 => __( 'Read More Link Text', 'zeal' ),
        'description'           => __( 'Leave blank to hide the link', 'zeal' ),
    ) );
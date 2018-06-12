<?php

// ---------------------------------------------
// General Panel
// ---------------------------------------------
$wp_customize->add_panel( 'general', array (
    'title' => __( 'Logo, Title & Favicon', 'zeal' ),
    'description' => __( 'General settings for your site, such as branding, title, and tagline', 'zeal' ),
    'priority' => 10
) );



// ---------------------------------------------
// Header Section
// ---------------------------------------------
$wp_customize->add_section( 'header', array(
    'title'                 => __( 'Logo', 'zeal'),
    'description'           => __( 'Customize the contents of the site header', 'zeal' ),
    'panel'                 => 'general'
) );

    // Use Logo or Title
    $wp_customize->add_setting( 'zeal_logo_or_title', array (
        'default'               => 'logo',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_logo_or_title_switch',
    ) );
    $wp_customize->add_control( 'zeal_logo_or_title', array(
        'type'                  => 'radio',
        'section'               => 'header',
        'label'                 => __( 'Use Logo or Title in Header?', 'zeal' ),
        'description'           => __( 'Specify whether you would like a logo to appear instead of the site title', 'zeal' ),
        'choices'               => array(
            'title'             => __( 'Use Site Title', 'zeal' ),
            'logo'              => __( 'Use Logo', 'zeal' ),
    ) ) );

    
    // Header Logo Image
    $wp_customize->add_setting( 'zeal_header_logo', array (
        'default'               => get_template_directory_uri() . '/inc/images/zeal-logo.png',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zeal_header_logo', array (
        'mime_type'             => 'image',
        'settings'              => 'zeal_header_logo',
        'section'               => 'header',
        'label'                 => __( 'Logo', 'zeal' ),
        'description'           => __( 'If you would like to use a logo instead of the site title, you may upload it here', 'zeal' ),        
    ) ) );
    
    // Header Logo Size (Height)
    $wp_customize->add_setting( 'zeal_logo_size', array (
        'default'               => 55,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_logo_size', array(
        'type'                  => 'range',
        'section'               => 'header',
        'label'                 => __( 'Logo Height', 'zeal' ),
        'description'           => __( 'Adjust the height of your logo. Aspect ratio will be maintained automatically', 'zeal' ),
        'input_attrs'           => array(
            'min' => 15,
            'max' => 70,
            'step' => 5,
    ) ) );
    
    // Show or Hide Tagline
    $wp_customize->add_setting( 'zeal_tagline_toggle', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'zeal_tagline_toggle', array(
        'type'                  => 'radio',
        'section'               => 'header',
        'label'                 => __( 'Show or Hide the Site Tagline?', 'zeal' ),
        'description'           => __( 'Specify whether the site tagline should appear below the title/logo', 'zeal' ),
        'choices'               => array(
            'show'              => __( 'Show', 'zeal' ),
            'hide'              => __( 'Hide', 'zeal' ),
    ) ) );
    
    
// ---------------------------------------------
// Header Section
// ---------------------------------------------
$wp_customize->add_section( 'mobile_menu', array(
    'title'                 => __( 'Mobile Menu', 'zeal'),
    'description'           => __( 'Customize the mobile menu', 'zeal' ),
    'panel'                 => 'general'
) );

    // Toggle Allow Parent Menu Links (Slicknav)
    $wp_customize->add_setting( 'zeal_allow_parent_links', array (
        'default'               => true,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_allow_parent_links',
    ) );
    $wp_customize->add_control( 'zeal_allow_parent_links', array(
        'type'                  => 'radio',
        'section'               => 'mobile_menu',
        'label'                 => __( 'Mobile Menu: Should top level menu items (that have sub-items) be clickable as links?', 'zeal' ),
        'choices'               => array(
            true            => __( 'Clicking on a top level item navigates to the link location', 'zeal' ),
            false           => __( 'Clicking on a top level item has no effect', 'zeal' ),
    ) ) );
    
$wp_customize->add_section( 'title_tagline', array (
    'title' => __( 'Site Title, Tagline & Favicon', 'athena' ),
    'panel' => 'general',
) );

$wp_customize->add_section( 'zeal_search_section', array(
    'title'                 => __( 'Search', 'zeal'),
    'description'           => __( 'Customize the appearance of the search bar', 'zeal' ),
    'panel'                 => 'general'
) );


    $wp_customize->add_setting( 'zeal_search_bool', array (
        'default'               => 'on',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_cta_area_toggle',
    ) );
    $wp_customize->add_control( 'zeal_search_bool', array(
        'type'                  => 'radio',
        'section'               => 'zeal_search_section',
        'label'                 => __( 'Show the search bar ?', 'zeal' ),
        'choices'               => array(
            'on'            => __( 'Visible', 'zeal' ),
            'off'           => __( 'Hidden', 'zeal' ),
    ) ) );
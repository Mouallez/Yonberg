<?php

// ---------------------------------------------
// Shortcodes Panel
// ---------------------------------------------
$wp_customize->add_panel( 'shortcodes', array (
    'title' => __( 'Custom Page Settings', 'zeal' ),
    'description' => __( 'Settings for custom Zeal page templates', 'zeal' ),
    'priority' => 10
) );

// ---------------------------------------------
// Gallery Section
// ---------------------------------------------
$wp_customize->add_section( 'zeal_gallery_shortcode', array(
    'title'                 => __( 'Zeal Gallery', 'zeal'),
    'description'           => __( 'These settings allow users to customize the output of the Zeal Gallery page template, with the same options available in the Zeal Gallery widget and shortcode.', 'zeal' ),
    'panel'                 => 'shortcodes'
) );

    // Get all user defined Gallery Groups
    $taxonomy_groups = get_terms( array(
        'taxonomy'      => 'gallery_group',
        'hide_empty'    => false,
    ) );

    // Start the Groups array
    $groups = array(
        'all' => __( 'All Gallery Items', 'zeal'),
    );

    // Add any user defined Gallery Groups to the starting array
    if ( !empty ( $taxonomy_groups ) && is_array( $taxonomy_groups ) ) :

        foreach ( $taxonomy_groups as $tax_group ) :
            $groups[ $tax_group->slug ] = $tax_group->name;
        endforeach;

    endif;

    // Gallery Group
    $wp_customize->add_setting('zeal_gallery_shortcode_group', array(
        'default' => 'all',
        'transport' => 'refresh',
        'sanitize_callback' => 'zeal_sanitize'
    ));
    $wp_customize->add_control('zeal_gallery_shortcode_group', array(
        'type'              => 'select',
        'section'           => 'zeal_gallery_shortcode',
        'label'             => __('Show All or Specific Gallery Group?', 'zeal'),
        'description'       => __('If anything other than "All" is selected, only photos in the selected group will be shown', 'zeal'),
        'choices'           => $groups
    ));

    // Gallery Style
    $wp_customize->add_setting('zeal_gallery_shortcode_tile_style', array(
        'default'           => 'columns',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeal_sanitize'
    ));
    $wp_customize->add_control('zeal_gallery_shortcode_tile_style', array(
        'type'              => 'select',
        'section'           => 'zeal_gallery_shortcode',
        'label'             => __('Tile / Layout Style', 'zeal'),
        'choices'           => array(
            'columns'   => __( 'Columns', 'zeal' ),
            'justified' => __( 'Justified', 'zeal' ),
            'nested'    => __( 'Nested', 'zeal' ),
        ),
    ));

    // Gallery Limit
    $wp_customize->add_setting( 'zeal_gallery_shortcode_limit', array (
        'default'               => -1,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'zeal_sanitize_integer',
    ) );
    $wp_customize->add_control( 'zeal_gallery_shortcode_limit', array(
        'type'                  => 'number',
        'section'               => 'zeal_gallery_shortcode',
        'label'                 => __( 'Limit the number of posts?', 'juno' ),
        'description'           => __( 'Use -1 to have no limit / show all', 'juno' ),
        'input_attrs'           => array(
            'min' => -1,
            'max' => 120,
            'step' => 1,
    ) ) );
  
    // Gallery Shuffle?
    $wp_customize->add_setting( 'zeal_gallery_shortcode_shuffle', array(
        'default'           => 'normal',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeal_sanitize'
    ));
    $wp_customize->add_control( 'zeal_gallery_shortcode_shuffle', array(
        'type'              => 'select',
        'section'           => 'zeal_gallery_shortcode',
        'label'             => __('Randomize Slide Order?', 'zeal'),
        'choices'           => array(
            'normal'    => __( 'Default', 'zeal' ),
            'shuffle'   => __( 'Randomize Order', 'zeal' ),
        ),
    ));

    // Icon on Hover?
    $wp_customize->add_setting( 'zeal_gallery_shortcode_icons', array(
        'default'           => 'show',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeal_sanitize'
    ));
    $wp_customize->add_control( 'zeal_gallery_shortcode_icons', array(
        'type'              => 'select',
        'section'           => 'zeal_gallery_shortcode',
        'label'             => __('Show Icon on Hover?', 'zeal'),
        'choices'           => array(
            'show'      => __( 'Show magnifying glass icon on hover', 'zeal' ),
            'hide'      => __( 'No icon on hover', 'zeal' ),
        ),
    ));

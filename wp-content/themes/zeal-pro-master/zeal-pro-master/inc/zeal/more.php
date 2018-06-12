<?php
$addons = new AddOns( array (
    'faqs',
    'events',
    'news',
    'testimonials',
    'gallery'
        ) );

new Event_Meta_Box;
new Jobs_Meta_Box;

class AddOns {

    private $args = null;

    public function __construct( $args ) {

        $this->args = $args;
        $this->add_hooks();
    }

    public function add_hooks() {

        // Create shortcodes
//        add_shortcode( 'zeal-faqs', array ( $this, 'zeal_faqs' ) );
      
        add_shortcode( 'zeal-faqs', array ( $this, 'zeal_faqs' ) );
        add_shortcode( 'zeal-news', array ( $this, 'zeal_news' ) );
        add_shortcode( 'zeal-gallery', array ( $this, 'zeal_gallery' ) );
        add_shortcode( 'zeal-current-events', array( $this, 'zeal_current_events' ) );
        add_shortcode( 'zeal-past-events', array( $this, 'zeal_past_events' ) );
        add_shortcode( 'zeal-testimonials', array( $this, 'zeal_testimonials' ) );

        add_action( 'wp_head', array ( $this, 'zeal_homepage_script' ) );
        add_action( 'wp_head', array ( $this, 'zeal_custom_css' ) );
        add_filter('widget_text', 'do_shortcode');
        add_filter( 'the_content', array( $this, 'zeal_add_social' ) );
        add_filter('wp_nav_menu_items', array( $this, 'zeal_customize_nav' ) );
        add_action('admin_menu', array( $this, 'zeal_add_menu_pages' ) );
        add_action( 'after_setup_theme', array( $this, 'zeal_theme_updater' ) );
        if( ! zeal_strap_pl() ) :
            add_action( 'admin_notices', array( $this, 'zeal_admin_notice__success' ) );
        endif;          
        if ( in_array( 'faqs', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_faqs' ) );
        endif;

        if ( in_array( 'jobs', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_jobs' ) );
        endif;

        if ( in_array( 'events', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_events' ) );
        endif;

        if ( in_array( 'news', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_news' ) );
        endif;

        if ( in_array( 'testimonials', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_testimonials' ) );
        endif;

        if ( in_array( 'gallery', $this->args ) ) :
            add_action( 'init', array ( $this, 'create_gallery' ) );
        endif;
        
        add_action( 'widgets_init', array( $this, 'zeal_register_widgets' ) );
    }

    
    function zeal_add_menu_pages(){
        add_menu_page('Zeal', 'Zeal Pro', 'manage_options', 'zeal_menu', array( $this, 'zeal_menu' ), get_template_directory_uri() . '/inc/images/cat_logo_mini.png' );
    }
    
    function zeal_menu() {
        include get_template_directory() . '/inc/zeal/upgrade.php';
    }
    
    function zeal_theme_updater() {
            require( get_template_directory() . '/inc/zeal/theme-updater.php' );
    }
    
    function zeal_register_widgets() {
            register_widget( 'Zeal_Faq_Widget' );
            register_widget( 'Zeal_News_Widget' );
            register_widget( 'Zeal_Events_Widget' );
            register_widget( 'Zeal_Testimonials_Widget' );
            register_widget( 'Zeal_Gallery_Widget' );
            register_widget( 'Zeal_Contact_Form' );
            register_widget( 'Zeal_Contact_Info' );
            register_widget( 'Zeal_Pricing_Table' );
            register_widget( 'Zeal_Service' );
            register_widget( 'Zeal_CTA' );
        
    }
    
    public function zeal_customize_nav ( $items ) {
        
        if( get_theme_mod( 'zeal_search_bool', 'on' ) == 'on' ) :
            $items .= '<li class="menu-item"><a class="zeal-search" href="#search" role="button" data-toggle="modal"><span class="fa fa-search"></span></a></li>';
        endif;
        
        return $items;
        
    }
    
    function create_testimonials() {

        $labels = array(
                'name'                => _x( 'Testimonials', 'Post Type General Name', 'zeal' ),
                'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'zeal' ),
                'menu_name'           => __( 'Testimonials', 'zeal' ),
                'name_admin_bar'      => __( 'Testimonials', 'zeal' ),
                'parent_item_colon'   => __( '', 'zeal' ),
                'all_items'           => __( 'All Testimonials', 'zeal' ),
                'add_new_item'        => __( 'Add New Testimonial', 'zeal' ),
                'add_new'             => __( 'Add New', 'zeal' ),
                'new_item'            => __( 'New Testimonial', 'zeal' ),
                'edit_item'           => __( 'Edit Testimonial', 'zeal' ),
                'update_item'         => __( 'Update Testimonial', 'zeal' ),
                'view_item'           => __( 'View Testimonial', 'zeal' ),
                'search_items'        => __( 'Search Testimonials', 'zeal' ),
                'not_found'           => __( 'No testimonials found', 'zeal' ),
                'not_found_in_trash'  => __( 'No testimonials found in trash', 'zeal' ),
        );
        $args = array(
                'label'               => __( 'testimonial', 'zeal' ),
                'description'         => __( 'Create and display your testimonials', 'zeal' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 5,
                'menu_icon'           => 'dashicons-format-quote',
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => true,
                'can_export'          => true,
                'has_archive'         => false,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'rewrite'             => false,
                'capability_type'     => 'page',
        );
        register_post_type( 'testimonial', $args );

    }

    function create_gallery() {

            $labels = array(
                    'name'                  => _x( 'Gallery', 'Post Type General Name', 'zeal' ),
                    'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'zeal' ),
                    'menu_name'             => __( 'Gallery', 'zeal' ),
                    'name_admin_bar'        => __( 'Gallery', 'zeal' ),
                    'archives'              => __( '', 'zeal' ),
                    'parent_item_colon'     => __( '', 'zeal' ),
                    'all_items'             => __( 'All Gallery Items', 'zeal' ),
                    'add_new_item'          => __( 'Gallery', 'zeal' ),
                    'add_new'               => __( 'Add Gallery Item', 'zeal' ),
                    'new_item'              => __( 'New Gallery Item', 'zeal' ),
                    'edit_item'             => __( 'Edit Gallery Item', 'zeal' ),
                    'update_item'           => __( 'Update Gallery Item', 'zeal' ),
                    'view_item'             => __( 'View Gallery Item', 'zeal' ),
                    'search_items'          => __( 'Search Gallery Items', 'zeal' ),
                    'not_found'             => __( 'Not found', 'zeal' ),
                    'not_found_in_trash'    => __( 'Not found in Trash', 'zeal' ),
                    'featured_image'        => __( 'Featured Image', 'zeal' ),
                    'set_featured_image'    => __( 'Set featured image', 'zeal' ),
                    'remove_featured_image' => __( 'Remove featured image', 'zeal' ),
                    'use_featured_image'    => __( 'Use as featured image', 'zeal' ),
                    'insert_into_item'      => __( 'Insert into item', 'zeal' ),
                    'uploaded_to_this_item' => __( 'Uploaded to this item', 'zeal' ),
                    'items_list'            => __( 'Items list', 'zeal' ),
                    'items_list_navigation' => __( 'Items list navigation', 'zeal' ),
                    'filter_items_list'     => __( 'Filter items list', 'zeal' ),
            );
            $args = array(
                    'label'                 => __( 'Gallery', 'zeal' ),
                    'description'           => __( 'The Gallery is a great way to create an image portfolio', 'zeal' ),
                    'labels'                => $labels,
                    'supports'              => array( 'title', 'thumbnail' ),
                    'hierarchical'          => false,
                    'public'                => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_position'         => 5,
                    'menu_icon'             => 'dashicons-format-gallery',
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'has_archive'           => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'rewrite'               => false,
                    'capability_type'       => 'page',
            );
            register_post_type( 'gallery', $args );
            
            // Register Gallery Group Taxonomy
            $labels = array(
                'name'                       => _x( 'Gallery Groups', 'Taxonomy General Name', 'zeal' ),
                'singular_name'              => _x( 'Gallery Group', 'Taxonomy Singular Name', 'zeal' ),
                'menu_name'                  => __( 'Gallery Group', 'zeal' ),
                'all_items'                  => __( 'All Gallery Groups', 'zeal' ),
                'parent_item'                => __( 'Parent Gallery Group', 'zeal' ),
                'parent_item_colon'          => __( 'Parent Gallery Group:', 'zeal' ),
                'new_item_name'              => __( 'New Gallery Group Name', 'zeal' ),
                'add_new_item'               => __( 'Add New Gallery Group', 'zeal' ),
                'edit_item'                  => __( 'Edit Gallery Group', 'zeal' ),
                'update_item'                => __( 'Update Gallery Group', 'zeal' ),
                'view_item'                  => __( 'View Gallery Group', 'zeal' ),
                'separate_items_with_commas' => __( 'Separate Gallery Group with commas', 'zeal' ),
                'add_or_remove_items'        => __( 'Add or remove Gallery Group', 'zeal' ),
                'choose_from_most_used'      => __( 'Choose from the most used', 'zeal' ),
                'popular_items'              => __( 'Popular Gallery Groups', 'zeal' ),
                'search_items'               => __( 'Search Gallery Groups', 'zeal' ),
                'not_found'                  => __( 'Not Found', 'zeal' ),
                'no_terms'                   => __( 'No Gallery Groups', 'zeal' ),
                'items_list'                 => __( 'Gallery Group list', 'zeal' ),
                'items_list_navigation'      => __( 'Gallery Group list navigation', 'zeal' ),
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => false,
                'rewrite'                    => false,
            );
            register_taxonomy( 'gallery_group', array( 'gallery' ), $args );

    }
    
    public function create_faqs() {

        $labels = array (
            'name' => _x( 'FAQs', 'Post Type General Name', 'zeal' ),
            'singular_name' => _x( 'FAQ', 'Post Type Singular Name', 'zeal' ),
            'menu_name' => __( 'FAQs', 'zeal' ),
            'name_admin_bar' => __( 'FAQ', 'zeal' ),
            'archives' => __( 'FAQ Archives', 'zeal' ),
            'parent_item_colon' => __( 'Parent Item:', 'zeal' ),
            'all_items' => __( 'All FAQs', 'zeal' ),
            'add_new_item' => __( 'Add New FAQ', 'zeal' ),
            'add_new' => __( 'Add FAQ', 'zeal' ),
            'new_item' => __( 'New FAQ', 'zeal' ),
            'edit_item' => __( 'Edit FAQ', 'zeal' ),
            'update_item' => __( 'Update FAQ', 'zeal' ),
            'view_item' => __( 'View FAQ', 'zeal' ),
            'search_items' => __( 'Search FAQs', 'zeal' ),
            'not_found' => __( 'Not found', 'zeal' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'zeal' ),
            'featured_image' => __( 'Featured Image', 'zeal' ),
            'set_featured_image' => __( 'Set featured image', 'zeal' ),
            'remove_featured_image' => __( 'Remove featured image', 'zeal' ),
            'use_featured_image' => __( 'Use as featured image', 'zeal' ),
            'insert_into_item' => __( 'Insert into FAQ', 'zeal' ),
            'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'zeal' ),
            'items_list' => __( 'FAQs list', 'zeal' ),
            'items_list_navigation' => __( 'Items list navigation', 'zeal' ),
            'filter_items_list' => __( 'Filter items list', 'zeal' ),
        );
        $args = array (
            'label' => __( 'FAQ', 'zeal' ),
            'description' => __( 'Frequently asked questions for your site', 'zeal' ),
            'labels' => $labels,
            'supports' => array ( 'title', 'editor', 'revisions', ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-editor-help',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'rewrite' => false,
            'capability_type' => 'page',
        );

        register_post_type( 'faq', $args );
    }

    function create_jobs() {

        $labels = array (
            'name' => _x( 'Jobs', 'Post Type General Name', 'zeal' ),
            'singular_name' => _x( 'Job', 'Post Type Singular Name', 'zeal' ),
            'menu_name' => __( 'Jobs', 'zeal' ),
            'name_admin_bar' => __( 'Jobs', 'zeal' ),
            'archives' => __( 'Archives', 'zeal' ),
            'parent_item_colon' => __( 'Parent Item:', 'zeal' ),
            'all_items' => __( 'All Jobs', 'zeal' ),
            'add_new_item' => __( 'Add New Job', 'zeal' ),
            'add_new' => __( 'Add New', 'zeal' ),
            'new_item' => __( 'New Job', 'zeal' ),
            'edit_item' => __( 'Edit Job', 'zeal' ),
            'update_item' => __( 'Update Job', 'zeal' ),
            'view_item' => __( 'View Job', 'zeal' ),
            'search_items' => __( 'Search Jobs', 'zeal' ),
            'not_found' => __( 'Not found', 'zeal' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'zeal' ),
            'featured_image' => __( 'Featured Image', 'zeal' ),
            'set_featured_image' => __( 'Set featured image', 'zeal' ),
            'remove_featured_image' => __( 'Remove featured image', 'zeal' ),
            'use_featured_image' => __( 'Use as featured image', 'zeal' ),
            'insert_into_item' => __( 'Insert into job', 'zeal' ),
            'uploaded_to_this_item' => __( 'Uploaded to this job', 'zeal' ),
            'items_list' => __( 'Jobs list', 'zeal' ),
            'items_list_navigation' => __( 'Jobs list navigation', 'zeal' ),
            'filter_items_list' => __( 'Filter jobs', 'zeal' ),
        );
        $args = array (
            'label' => __( 'Job', 'zeal' ),
            'description' => __( 'Jobs', 'zeal' ),
            'labels' => $labels,
            'supports' => array ( 'title', 'editor', 'author', 'thumbnail', ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );

        register_post_type( 'job', $args );
    }

    function create_events() {

        $labels = array (
            'name' => _x( 'Events', 'Post Type General Name', 'zeal' ),
            'singular_name' => _x( 'Event', 'Post Type Singular Name', 'zeal' ),
            'menu_name' => __( 'Events', 'zeal' ),
            'name_admin_bar' => __( 'Events', 'zeal' ),
            'archives' => __( 'Archives', 'zeal' ),
            'parent_item_colon' => __( 'Parent Item:', 'zeal' ),
            'all_items' => __( 'All Events', 'zeal' ),
            'add_new_item' => __( 'Add New Event', 'zeal' ),
            'add_new' => __( 'Add New', 'zeal' ),
            'new_item' => __( 'New Event', 'zeal' ),
            'edit_item' => __( 'Edit Event', 'zeal' ),
            'update_item' => __( 'Update Event', 'zeal' ),
            'view_item' => __( 'View Event', 'zeal' ),
            'search_items' => __( 'Search Events', 'zeal' ),
            'not_found' => __( 'Not found', 'zeal' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'zeal' ),
            'featured_image' => __( 'Featured Image', 'zeal' ),
            'set_featured_image' => __( 'Set featured image', 'zeal' ),
            'remove_featured_image' => __( 'Remove featured image', 'zeal' ),
            'use_featured_image' => __( 'Use as featured image', 'zeal' ),
            'insert_into_item' => __( 'Insert into event', 'zeal' ),
            'uploaded_to_this_item' => __( 'Uploaded to this event', 'zeal' ),
            'items_list' => __( 'Events list', 'zeal' ),
            'items_list_navigation' => __( 'Jobs list navigation', 'zeal' ),
            'filter_items_list' => __( 'Filter events', 'zeal' ),
        );
        $args = array (
            'label' => __( 'Event', 'zeal' ),
            'description' => __( 'Events', 'zeal' ),
            'labels' => $labels,
            'supports' => array ( 'title', 'editor', 'author', 'thumbnail', ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );
        register_post_type( 'event', $args );
    }

    function create_news() {

        $labels = array (
            'name' => _x( 'News', 'Post Type General Name', 'zeal' ),
            'singular_name' => _x( 'News Entry', 'Post Type Singular Name', 'zeal' ),
            'menu_name' => __( 'News', 'zeal' ),
            'name_admin_bar' => __( 'News', 'zeal' ),
            'archives' => __( 'Item Archives', 'zeal' ),
            'parent_item_colon' => __( 'Parent Item:', 'zeal' ),
            'all_items' => __( 'All Items', 'zeal' ),
            'add_new_item' => __( 'Add New Item', 'zeal' ),
            'add_new' => __( 'Add News Item', 'zeal' ),
            'new_item' => __( 'New News Item', 'zeal' ),
            'edit_item' => __( 'Edit News Item', 'zeal' ),
            'update_item' => __( 'Update News Item', 'zeal' ),
            'view_item' => __( 'View News Item', 'zeal' ),
            'search_items' => __( 'Search News Item', 'zeal' ),
            'not_found' => __( 'Not found', 'zeal' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'zeal' ),
            'featured_image' => __( 'Featured Image', 'zeal' ),
            'set_featured_image' => __( 'Set featured image', 'zeal' ),
            'remove_featured_image' => __( 'Remove featured image', 'zeal' ),
            'use_featured_image' => __( 'Use as featured image', 'zeal' ),
            'insert_into_item' => __( 'Insert into item', 'zeal' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'zeal' ),
            'items_list' => __( 'Items list', 'zeal' ),
            'items_list_navigation' => __( 'Items list navigation', 'zeal' ),
            'filter_items_list' => __( 'Filter items list', 'zeal' ),
        );
        $args = array (
            'label' => __( 'News Entry', 'zeal' ),
            'description' => __( 'In The News posts', 'zeal' ),
            'labels' => $labels,
            'supports' => array ( 'title', 'thumbnail', 'editor' ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-megaphone',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => false,
            'capability_type' => 'page',
        );
        register_post_type( 'news', $args );
    }
    
    function zeal_add_social( $content ){ 

        if( is_single() && 'post' == get_post_type() ) :

            if( get_theme_mod('zeal_social_bool', 'on' ) == 'off' ) : 
                return $content;
            endif;

            $home_url = home_url('/');

            $share_buttons = '<ul class="share-buttons">'; 
            
                $share_buttons .= '<li><a class="facebook" target="_BLANK" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '">' . '<img src="' . get_template_directory_uri() . '/inc/images/Facebook.png">' . '</a></li>';
                $share_buttons .= '<li><a class="twitter" target="_BLANK" href="https://twitter.com/intent/tweet?source=' . get_the_permalink() . '&text=' . get_the_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/inc/images/Twitter.png">' . '</a></li>';
                $share_buttons .= '<li><a class="gplus" target="_BLANK" href="https://plus.google.com/share?url=' . get_the_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/inc/images/Google+.png">' . '</a></li>';
                $share_buttons .= '<li><a class="tumblr" target="_BLANK" href="http://www.tumblr.com/share?v=3&u=' . get_the_permalink() . '&t=&s="><img src="' . get_template_directory_uri() . '/inc/images/Tumblr.png"></a></li>';
                $share_buttons .= '<li><a class="pinterest" target="_BLANK" href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '">' . '<img src="' . get_template_directory_uri() . '/inc/images/Pinterest.png">' . '</a></li>';
                $share_buttons .= '<li><a class="linkedin" target="_BLANK" href="http://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title() . '">' . '<img src="' . get_template_directory_uri() . '/inc/images/LinkedIn.png">' . '</a></li>';
                
            $share_buttons .= '</ul>'; 
            
            $new_content = $share_buttons;
            $new_content .= $content;
            
            return $new_content;
            
        else :
            
            return $content;
            
        endif;
            
    }
    
    public static function zeal_contact_form( $instance ){ ?>

        <form action="<?php echo admin_url('admin-ajax.php' ); ?>" id="zeal-contact-form">

            <input type="hidden" class="recipient" name="recipient" value="<?php echo !empty( $instance['zeal_contactemail'] ) ? $instance['zeal_contactemail'] : ''; ?>" />

            <div class="group">
                <label><?php echo !empty( $instance['zeal_contactfrom_label'] ) ? $instance['zeal_contactfrom_label'] : __('Name', 'zeal' ); ?></label>
                <input type="text" name="name" class="control name"/>
            </div>

            <div class="group">
                <label><?php echo !empty( $instance['zeal_contactemail_label'] ) ? $instance['zeal_contactemail_label'] : __('Email Address', 'zeal' ); ?></label>
                <input type="text" name="email" class="control email"/>
            </div>

            <div class="group">
                <label class="message"><?php echo !empty( $instance['zeal_contactmessage_label'] ) ? $instance['zeal_contactmessage_label'] : __('Message', 'zeal' ); ?></label>
                <textarea name="message" class="control message"></textarea>
            </div>

            <input type="submit" class="zeal-button" value="<?php echo !empty( $instance['zeal_contactsubmit_label'] ) ? $instance['zeal_contactsubmit_label'] : __('Submit', 'zeal' ); ?>"/>

            <div class="mail-sent"><span class="fa fa-check-circle"></span> <?php _e( 'Email sent!', 'zeal' ); ?></div>
            <div class="mail-not-sent"><span class="fa fa-exclamation-circle"></span> <?php _e( 'There has been an error, please check the information you entered and try again.', 'zeal' ); ?></div>

        </form>

    <?php }
    

    public function zeal_faqs() {
        
        ob_start();
        $this->zeal_output_faqs();
        $output = ob_get_clean();
        return $output;
    }
    
    public static function zeal_output_faqs() {
        
        // WP_Query arguments
        $args = array (
            'post_type' => array ( 'faq' ),
            'post_status' => array ( 'publish' ),
            'order' => 'DESC',
            'orderby' => 'date',
            'posts_per_page' => '200',
        );

        // The Query
        $faqs = new WP_Query( $args );

        // The Loop
        if ( $faqs->have_posts() ) :

            while ( $faqs->have_posts() ) :

                $faqs->the_post();
                ?>

                <div class="single-faq">
                    <h3 class="faq-title"><?php the_title(); ?></h3>
                    <div class="faq-content">
                        <p><?php the_content(); ?></p>
                    </div>
                </div>            

                <?php
            endwhile;
        else :
        // no posts found
        endif;



        // Restore original Post Data
        wp_reset_postdata();
        
    }

    function zeal_news() {

        ob_start();
        $this->zeal_output_news();
        $output = ob_get_clean();
        return $output;
    }
    
    public static function zeal_output_news () {
        
        echo '<div id="news-posts">';

        $paged = ( get_query_var( 'paged', 1 ) );


        // WP_Query arguments
        $args = array (
            'post_type' => array ( 'news' ),
            'post_status' => array ( 'publish' ),
            'paged' => $paged,
            'posts_per_page' => '6',
        );

        // The Query
        $news = new WP_Query( $args );

        // The Loop
        if ( $news->have_posts() ) :

            $ctr = 0;

            while ( $news->have_posts() ) :

                $ctr++;

                $news->the_post();
                ?>

                <div class="col-sm-4">
                    <div class="news-item">

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="image">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <h3 class="title">
                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                        </h3>
                        
                        <div class="diviver"><span></span></div>

                        <div class="date"><?php echo get_the_date( 'd M, Y'); ?></div>

                    </div>            
                </div>

                <?php if ( $ctr % 3 == 0 ): ?>
                    <div class="clear"></div>
                <?php endif; ?>

                <?php
            endwhile;

            if ( $news->max_num_pages > 1 ) { // check if the max number of pages is greater than 1  
                ?>
                <div class="clear"></div>
                <nav class="prev-next-posts">
                    <div class="prev-posts-link">
                        <?php echo get_previous_posts_link( '<span class="fa fa-chevron-left"></span>' ); // display newer posts link  ?>
                    </div>
                    <div class="next-posts-link">
                        <?php
                        echo get_query_var( 'paged', 1 ) ? get_query_var( 'paged', 1 ) : '1';
                        echo ' of ' . $news->max_num_pages;
                        ?>
                <?php echo get_next_posts_link( '<span class="fa fa-chevron-right"></span>', $news->max_num_pages ); // display older posts link   ?>
                    </div>
                </nav>
                <?php
            }

        // no posts found
        endif;

        // Restore original Post Data
        wp_reset_postdata();

        echo '</div>';
        
    }

    function zeal_current_events() {

        ob_start();
        $this->zeal_output_current_events();
        $output = ob_get_clean();
        return $output;
    }

    public static function zeal_output_current_events() {
        

        $args = array (
            'posts_per_page' => '200',
            'post_type' => array ( 'event' ),
            'post_status' => array ( 'publish' ),
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_query' => array (
                array (
                    'key' => 'event_metadate',
                    'value' => date( 'Y-m-d' ),
                    'compare' => '>=',
                    'type' => 'DATE',
                ),
            ),
        );

        // The Query
        $events = new WP_Query( $args );

        // The Loop
        if ( $events->have_posts() ) {
            ?>

            <div class="event-blog">

                <?php
                $ctr = 0;

                while ( $events->have_posts() ) {

                    $ctr++;

                    $events->the_post();
                    ?>

                    <div class="col-sm-6 event-post-wrapper">
                        <div class="blogroll-post event-post row <?php echo $ctr > 3 ? ' ' : ''; ?>">

                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="background col-sm-12" 
                                     style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>)"></div>
                <?php endif; ?>

                            <div class="col-sm-12 event-details">
                                <h2 class="title">

                                    <a target="_BLANK" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'event_more', true ) ); ?>">
                                        <?php echo the_title(); ?>
                                    </a>

                                    <div class="location">
                                        <?php echo get_post_meta( get_the_ID(), 'event_metalocation', true ); ?>
                                    </div>

                                    <div class="date">
                                        <?php echo date( 'M jS, Y', strtotime( get_post_meta( get_the_ID(), 'event_metadate', true ) ) ); ?>


                                        <?php echo date( 'g:i', strtotime( get_post_meta( get_the_ID(), 'event_metatime_start', true ) ) ); ?>
                                        to <?php echo date( 'g:i a', strtotime( get_post_meta( get_the_ID(), 'event_metatime_end', true ) ) ); ?>


                                    </div>


                                    <div class="clear"></div>

                                </h2>

                                <div class="">
                                    <a class="apply secondary-button" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"><?php _e( 'Learn More', 'zeal') ?></a>
                                </div>
                              

                            </div>



                        </div>
                    </div>

                <?php }
                ?>
            </div>
            <?php
        } else {
            echo '<h4>There are currently no upcoming events, please check again at a later time.</h4>';
        }

        // Restore original Post Data
        wp_reset_postdata();
        ?>

        <div class="clear"></div>

        <?php
        
    }
    
    function zeal_past_events() {

        ob_start();

        $args = array (
            'post_type' => array ( 'event' ),
            'post_status' => array ( 'publish' ),
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_query' => array (
                array (
                    'key' => 'event_metadate',
                    'value' => date( 'Y-m-d' ),
                    'compare' => '<',
                    'type' => 'DATE',
                ),
            ),
        );

        // The Query
        $events = new WP_Query( $args );

        // The Loop
        if ( $events->have_posts() ) {
            ?>

            <div class="event-blog">

                <?php
                $ctr = 0;

                while ( $events->have_posts() ) {

                    $ctr++;

                    $events->the_post();
                    ?>

                    <div class="col-sm-6 event-post-wrapper">
                        <div class="blogroll-post event-post row <?php echo $ctr > 3 ? ' ' : ''; ?>">

                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="background col-sm-12" 
                                     style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>)"></div>
                <?php endif; ?>

                            <div class="col-sm-12 event-details">
                                <h2 class="title">

                                    <a href="<?php echo the_permalink(); ?>">
                <?php echo the_title(); ?>
                                    </a>

                                    <div class="location">
                <?php echo get_post_meta( get_the_ID(), 'event_metalocation', true ); ?>
                                    </div>

                                    <div class="date">
                <?php echo date( 'M jS, Y', strtotime( get_post_meta( get_the_ID(), 'event_metadate', true ) ) ); ?>


                <?php echo date( 'g:i', strtotime( get_post_meta( get_the_ID(), 'event_metatime_start', true ) ) ); ?>
                                        to <?php echo date( 'g:i a', strtotime( get_post_meta( get_the_ID(), 'event_metatime_end', true ) ) ); ?>


                                    </div>


                                    <div class="clear"></div>

                                </h2>

                                <div class="">
                                    <a class="apply secondary-button" target="_BLANK" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'event_more', true ) ); ?>">Learn More</a>
                                </div>                               

                            </div>



                        </div>
                    </div>

                <?php }
                ?>
            </div>
            <?php
        } else {
            echo '<h4>There are currently no past events, please check again at a later time.</h4>';
        }

        // Restore original Post Data
        wp_reset_postdata();
        ?>

        <div class="clear"></div>

        <?php
        $output = ob_get_clean();
        return $output;
    }
    
    
    function zeal_testimonials() {
        
        ob_start();
        $this->zeal_output_testimonials();
        $output = ob_get_clean();
        return $output;
        
    }
    
    public static function zeal_output_testimonials( $type = null ){
        

        
        $args = array (
            'posts_per_page' => '200',
            'post_status'   => 'publish',
            'post_type'     => 'testimonial'
        );

        $testimonials = wp_get_recent_posts($args); ?>

        <ul id="zeal-testimonials" class="zeal-testimonials <?php echo !empty( $type ) ? $type : null ?> owl-carousel owl-theme">

            <?php foreach( $testimonials as $testimonial ) : ?>

            <li>
                <div class="testimonial-content">
                    <div class="col-xs-12">
                        <i class="fa fa-quote-left"></i>
                        <?php echo $testimonial['post_content']; ?>
                    </div>
                    <div class="clear"></div>
                    <!--<i class="fa fa-quote-right"></i>-->
                </div>
                <div class="testimonial-author center">
                    - <?php echo $testimonial['post_title']; ?> -
                </div>
            </li>

            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>
        </ul>

        <?php
        
        
    }
    
    function zeal_gallery( $atts) {

        $params = shortcode_atts( array(
            'group'     => 'all',
            'limit'     => -1,
            'order'     => 'normal',
            'style'     => 'columns',
            'icons'     => 'show',
        ), $atts );
        
        ob_start();
        $this->zeal_output_gallery( null, $params );
        $output = ob_get_clean();
        return $output;
        
    }
    
    public static function zeal_output_gallery( $instance = null, $params = null ){

        if ( !empty( $params ) ) :
            
            // For Shortcode which has no widget settings
            $instance['zeal_gallery_limit']         = $params['limit'];
            $instance['zeal_gallery_group']         = $params['group'];
            $instance['zeal_gallery_shuffle']       = $params['order'];
            $instance['zeal_gallery_tile_style']    = $params['style'];
            $instance['zeal_gallery_icons']         = $params['icons'];
            
        elseif ( empty( $instance ) && empty( $params ) ) :
            
            // For Gallery Page Template which has no widget settings - use customizer settings
            $instance['zeal_gallery_limit']         = get_theme_mod( 'zeal_gallery_shortcode_limit', -1 );
            $instance['zeal_gallery_group']         = get_theme_mod( 'zeal_gallery_shortcode_group', 'all' );
            $instance['zeal_gallery_shuffle']       = get_theme_mod( 'zeal_gallery_shortcode_shuffle', 'normal' );
            $instance['zeal_gallery_tile_style']    = get_theme_mod( 'zeal_gallery_shortcode_tile_style', 'columns' );
            $instance['zeal_gallery_icons']         = get_theme_mod( 'zeal_gallery_shortcode_icons', 'show' );
            
        endif;
            
        $args = array (
            'numberposts'   => ( !empty( $instance['zeal_gallery_limit'] ) ? (int)$instance['zeal_gallery_limit'] : -1 ),
            'post_status'   => 'publish',
            'post_type'     => 'gallery'
        );

        if( !empty( $instance['zeal_gallery_group'] ) && $instance['zeal_gallery_group'] != 'all' ) :

            $args['tax_query'] = array(
                array(
                    'taxonomy'  =>  'gallery_group',
                    'field'     => 'slug',
                    'terms'     => array( $instance['zeal_gallery_group'] ),
                )
            );
        
        endif;
        
        $gallery = wp_get_recent_posts( $args ); 
        
        $gallery_style = empty( $instance['zeal_gallery_shuffle'] ) || $instance['zeal_gallery_shuffle'] == 'normal' ? 'normal' : 'shuffle'; ?>

            <script type="text/javascript">

                jQuery(document).ready( function ($) {
                    $(".zeal-gallery").unitegallery({
                        
                        <?php if ( !empty( $instance['zeal_gallery_tile_style'] ) ) : ?>
                                    
                            <?php if ( $instance['zeal_gallery_tile_style'] != 'columns' ) : ?>
                                tiles_type: '<?php echo $instance['zeal_gallery_tile_style'] == 'justified' ? 'justified' : 'nested'; ?>',
                            <?php else : ?>
                                tiles_type: 'columns',
                            <?php endif; ?>
                            
                        <?php else : ?>
    
                            tiles_type: 'columns',
                                    
                        <?php endif; ?>
                            
                        tiles_col_width: 390,
                        tile_enable_icons: <?php echo empty( $instance['zeal_gallery_icons'] ) || $instance['zeal_gallery_icons'] == 'show' ? 'true' : 'false'; ?>,
                        theme_appearance_order: '<?php echo $gallery_style; ?>',
                                
                    });
                });

            </script>

            <?php if ( !empty( $gallery ) ) : ?>
            
                <div id="gallery" style="display:none;" class="zeal-gallery">

                    <?php $ctr = 0; ?>

                    <?php foreach( $gallery as $item ) : $ctr ++;?>

                        <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $item['ID'] ) ); ?>

                        <img alt="<?php echo $item['post_title']; ?>"
                         src="<?php echo $feat_image; ?>"
                         data-image="<?php echo $feat_image; ?>"
                         data-description="<?php echo $item['post_title']; ?>">

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </div>
            
            <?php endif; ?>

        <?php
    }
    
    function zeal_admin_notice__success() {
        ?>
        <div class="notice notice-error is-dismissible">
            <h3>Your Zeal license is not active. </h3>
            <p>
                <a href="<?php echo admin_url('themes.php?page=zeal-pro-license'); ?>" class="button button-primary"> Begin activating Zeal Pro</a>
            </p>
        </div>
        <?php
    }
    
    function zeal_custom_css() {
        ?>

        <style type="text/css">

            .hero-overlay h2,
            #slider-overlay h2{
                font-size: <?php echo esc_attr( get_theme_mod( 'zeal_hero_heading_size', 50 ) ); ?>px;
                color: <?php echo esc_attr( get_theme_mod( 'zeal_jumbo_text_color', '#ffffff' ) ); ?>
            }

            .hero-overlay p.site-tagline,
            #slider-overlay p.site-tagline{
                font-size: <?php echo esc_attr( get_theme_mod( 'zeal_hero_tagline_size', 10 ) ); ?>px;
                color: <?php echo esc_attr( get_theme_mod( 'zeal_jumbo_text_color', '#ffffff' ) ); ?>
            }

            .camera_target_content {
                background-color: <?php echo get_theme_mod( 'zeal_hero_tint_toggle', 'on' ) == 'on' ? esc_attr( get_theme_mod( 'zeal_hero_tint', 'rgba(10, 10, 10, 0.25)' ) ) : 'none'; ?>
            }
            
            div.big-hero-buttons button{
                font-size: <?php echo get_theme_mod( 'zeal_jumbo_button_size', 10 ); ?>px;
                color: <?php echo esc_attr( get_theme_mod( 'zeal_jumbo_text_color', '#ffffff' ) ); ?>
            }
            
            .blog-post-overlay h2.post-title{
                font-size: <?php echo get_theme_mod('zeal_blog_title_size', 24 ); ?>px;
            }

            a.blog-post-read-more {
                font-size: <?php echo get_theme_mod('zeal_blog_link_size', 10 ); ?>px;
            }
            
        <?php if ( get_theme_mod( 'zeal_theme_width', 'boxed' ) == 'full' ) : ?>

                .container {
                    width: 100%;
                }

        <?php else : ?>

                @media (min-width: 768px) {
                    .container {
                        width: 750px;
                    }
                }

                @media (min-width: 992px) {
                    .container {
                        width: 970px;
                    }                
                }     

                @media (min-width: 1200px) {
                    .container {
                        width: 1170px;
                    }
                }

        <?php endif; ?>


        <?php if ( get_theme_mod( 'zeal_cta_a_image' ) ) : ?>

                .homepage-a{
                    background-image: url(<?php echo esc_url( get_theme_mod( 'zeal_cta_a_image' ) ) ?>);
                    background-position: 50%;
                    background-size: cover;
                }
                .homepage-a section.homepage-cta-banner div.cta-banner-content h2.widget-title,
                .homepage-a section.homepage-cta-banner div.cta-banner-content div.textwidget,
                .homepage-a section.homepage-cta-banner div.cta-banner-content,
                .homepage-a section.homepage-cta-banner ul#zeal-testimonials .testimonial-content{
                    color: #fff;
                }
                .homepage-a section.homepage-cta-banner div.cta-banner-content {
                    background: rgba(10,10,10, 0.6);
                }
        <?php else : ?>
                .homepage-a ul#zeal-testimonials .testimonial-content .fa.fa-quote-left,
                .homepage-a ul#zeal-testimonials .testimonial-author{
                    color: #fff;
                }
            <?php endif; ?>

        <?php if ( get_theme_mod( 'zeal_cta_b_image', get_template_directory_uri() . '/inc/images/zeal-demo3.jpg' ) ) : ?>

                .homepage-b{
                    background-image: url(<?php echo esc_url( get_theme_mod( 'zeal_cta_b_image', get_template_directory_uri() . '/inc/images/zeal-demo3.jpg' ) ) ?>);
                    background-position: 50%;
                    background-size: cover;
                }
                .homepage-b section.homepage-cta-banner div.cta-banner-content h2.widget-title,
                .homepage-b section.homepage-cta-banner div.cta-banner-content div.textwidget,
                .homepage-b section.homepage-cta-banner div.cta-banner-content{
                    color: #fff;
                }
                .homepage-b section.homepage-cta-banner div.cta-banner-content {
                    background: rgba(10,10,10, 0.6);
                }

            <?php endif; ?>

        <?php if ( get_theme_mod( 'zeal_cta_c_image' ) ) : ?>

                .homepage-c{
                    background-image: url(<?php echo esc_url( get_theme_mod( 'zeal_cta_c_image' ) ) ?>);
                    background-position: 50%;
                    background-size: cover;
                }
                .homepage-c section.homepage-cta-banner div.cta-banner-content h2.widget-title,
                .homepage-c section.homepage-cta-banner div.cta-banner-content div.textwidget,
                .homepage-c section.homepage-cta-banner div.cta-banner-content{
                    color: #fff;
                }
                .homepage-c section.homepage-cta-banner div.cta-banner-content {
                    background: rgba(10,10,10, 0.6);
                }

        <?php endif; ?>

        <?php if ( get_theme_mod( 'zeal_footer_a_image', get_template_directory_uri() . '/inc/images/zeal-footer.jpg' ) ) : ?>

                .footer-a{
                    background: url(<?php echo esc_url( get_theme_mod( 'zeal_footer_a_image', get_template_directory_uri() . '/inc/images/zeal-footer.jpg' ) ) ?>);
                    background-position: 50%;
                    background-size: cover;
                }
                .footer-a section.homepage-cta-banner div.cta-banner-content h2.widget-title,
                .footer-a section.homepage-cta-banner div.cta-banner-content div.textwidget,
                footer.site-footer > div.container > div.footer-a div.textwidget,
                .footer-a section.homepage-cta-banner div.cta-banner-content{
                    color: #fff;
                }
                .footer-a section.homepage-cta-banner div.cta-banner-content {
                    background: rgba(10,10,10, 0.6);
                }

        <?php endif; ?>

                
                .event-blog .event-post .event-details a,
                button, input[type=button], input[type=submit],
                div#site-branding h1 a,
                .hero-overlay h2,
                #slider-overlay h2,
                .hero-overlay p,
                #slider-overlay p,
                section.featured-homepage-post div.click-through-arrow h4,
                div.featured-post-content h2,
                section.homepage-cta-banner div.cta-banner-content h2.widget-title,
                div.homepage-portfolio section.homepage-portfolio > div > h2,
                h2.feature-content-title,
                div.single-post-right > header > h1,
                nav.post-navigation .nav-links a,
                h3#reply-title,
                div#respond p.comment-form-comment label,
                p.no-comments,
                .widget h2.widget-title,
                div.archive-page h1,
                div.archive-page article h2,
                .single-page .single-page-wrapper h1,
                .team-member-wrapper .job-title-meta,
                div.team-member-wrapper h2.about-heading,
                div.team-member-wrapper .sc_team_posts .skills-title,
                div.team-member-wrapper .sc_team_skills span.skill-title,
                div.team-member-wrapper .sc_team_skills .progress,
                div.team-member-wrapper .sc-team-member-posts a,
                .event-blog .event-post .event-details a,
                .event-blog .event-details .location,
                .event-blog .event-details .date,
                ul#zeal-testimonials .testimonial-author,
                .zeal-pricing-table .title,
                .zeal-pricing-table .subtitle{
                    font-family: <?php echo get_theme_mod( 'zeal_font_primary', 'Oswald, sans-serif' ); ?>;
                }
                
                body,
                section.homepage-cta-banner div.cta-banner-content,
                div.archive-page h1 span,
                .event-blog .event-post .event-details .secondary-button{
                    font-family: <?php echo get_theme_mod( 'zeal_font_secondary', 'Titillium Web, sans-serif' ); ?>;
                }
                
                nav.main-nav a{
                    font-size: <?php echo get_theme_mod( 'zeal_menu_font_size', 10 ); ?>px;
                }
                
                body {
                    font-size: <?php echo get_theme_mod( 'zeal_body_font_size', 14 ); ?>px;
                }
                
                section.front-page-hero,
                div.col-md-12.hero-banner{
                    height: <?php echo get_theme_mod( 'zeal_slider_height', 450 ); ?>px;
                }
                
                
        </style>

        <?php
    }

    function zeal_homepage_script() {
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                if (jQuery('#zeal-slider').html()) {
                    zeal_slider();
                }

                function zeal_slider() {
                    
                    var height = get_height();

                    jQuery('#zeal-slider').camera({
                        height: "<?php echo esc_attr( get_theme_mod( 'zeal_slider_height', 450 ) ) . 'px'; ?>",
                        loader: "<?php echo esc_attr( get_theme_mod( 'zeal_slide_loader', 'bar' ) ); ?>",
                        overlay: false,
                        fx: "<?php echo esc_attr( get_theme_mod( 'zeal_slide_transition', 'simpleFade' ) ); ?>",
                        time: "<?php echo esc_attr( get_theme_mod( 'zeal_slide_timer', '4000' ) ); ?>",
                        pagination: false,
                        thumbnails: false,
                        transPeriod: 1500,
                        overlayer: false,
                        playPause: false,
                        hover: false,
                        navigation: <?php echo esc_attr( get_theme_mod( 'zeal_slide_pagination', "true" ) ); ?>

                    });
                }
                
                function get_height() {

                    if (jQuery(window).width() < 601) {
                        return jQuery(window).height();
                    } else {
                        return jQuery(window).height();
                    }


                }                
                
            });

        </script>
        <?php
        if ( get_theme_mod( 'zeal_js', false ) ) :

            echo get_theme_mod( 'zeal_js', false );

        endif;
        ?>

        <?php
    }

}

class Event_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php', array ( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array ( $this, 'init_metabox' ) );
        }
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes', array ( $this, 'add_metabox' ) );
        add_action( 'save_post', array ( $this, 'save_metabox' ), 10, 2 );
    }

    public function add_metabox() {

        add_meta_box(
                'event_meta', __( 'Event Details', 'zeal' ), array ( $this, 'render_event_meta' ), 'event', 'side', 'high'
        );
    }

    public function render_event_meta( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'event_metanonce_action', 'event_metanonce' );

        // Retrieve an existing value from the database.
        $event_metadate = get_post_meta( $post->ID, 'event_metadate', true );
        $event_metatime_start = get_post_meta( $post->ID, 'event_metatime_start', true );
        $event_metatime_end = get_post_meta( $post->ID, 'event_metatime_end', true );
        $event_metalocation = get_post_meta( $post->ID, 'event_metalocation', true );
        $event_rsvp = get_post_meta( $post->ID, 'event_rsvp', true );
        $event_more = get_post_meta( $post->ID, 'event_more', true );

        // Set default values.
        if ( empty( $event_metadate ) )
            $event_metadate = '';
        if ( empty( $event_metatime_start ) )
            $event_metatime_start = '';
        if ( empty( $event_metatime_end ) )
            $event_metatime_end = '';
        if ( empty( $event_metalocation ) )
            $event_metalocation = '';
        if ( empty( $event_rsvp ) )
            $event_rsvp = '';
        if ( empty( $event_more ) )
            $event_more = '';

        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="event_metadate" class="event_metadate_label">' . __( 'Date', 'zeal' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="date" id="event_metadate" name="event_metadate" class="event_metadate_field" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr__( $event_metadate ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_metatime_start" class="event_metatime_start_label">' . __( 'Time Start', 'zeal' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="time" id="event_metatime_start" name="event_metatime_start" class="event_metatime_start_field" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr__( $event_metatime_start ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_metatime_end" class="event_metatime_end_label">' . __( 'Time End', 'zeal' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="time" id="event_metatime_end" name="event_metatime_end" class="event_metatime_end_field" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr__( $event_metatime_end ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_metalocation" class="event_metalocation_label">' . __( 'Location', 'zeal' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="event_metalocation" name="event_metalocation" class="event_metalocation_field" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr__( $event_metalocation ) . '">';
        echo '		</td>';
        echo '	</tr>';



        echo '</table>';
    }

    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name = isset( $_POST[ 'event_metanonce' ] ) ? $_POST[ 'event_metanonce' ] : '';
        $nonce_action = 'event_metanonce_action';

        // Check if a nonce is set.
        if ( !isset( $nonce_name ) )
            return;

        // Check if a nonce is valid.
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) )
            return;

        // Sanitize user input.
        $event_metanew_date = isset( $_POST[ 'event_metadate' ] ) ? sanitize_text_field( $_POST[ 'event_metadate' ] ) : '';
        $event_metanew_time_start = isset( $_POST[ 'event_metatime_start' ] ) ? sanitize_text_field( $_POST[ 'event_metatime_start' ] ) : '';
        $event_metanew_time_end = isset( $_POST[ 'event_metatime_end' ] ) ? sanitize_text_field( $_POST[ 'event_metatime_end' ] ) : '';
        $event_metanew_location = isset( $_POST[ 'event_metalocation' ] ) ? sanitize_text_field( $_POST[ 'event_metalocation' ] ) : '';
        $event_metanew_rsvp = isset( $_POST[ 'event_rsvp' ] ) ? sanitize_text_field( $_POST[ 'event_rsvp' ] ) : '';
        $event_metanew_more = isset( $_POST[ 'event_more' ] ) ? sanitize_text_field( $_POST[ 'event_more' ] ) : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'event_metadate', $event_metanew_date );
        update_post_meta( $post_id, 'event_metatime_start', $event_metanew_time_start );
        update_post_meta( $post_id, 'event_metatime_end', $event_metanew_time_end );
        update_post_meta( $post_id, 'event_metalocation', $event_metanew_location );
        update_post_meta( $post_id, 'event_rsvp', $event_metanew_rsvp );
        update_post_meta( $post_id, 'event_more', $event_metanew_more );
    }

}

class Jobs_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php', array ( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array ( $this, 'init_metabox' ) );
        }
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes', array ( $this, 'add_metabox' ) );
        add_action( 'save_post', array ( $this, 'save_metabox' ), 10, 2 );
    }

    public function add_metabox() {

        add_meta_box(
                'job_meta', __( 'Job Details', 'text_domain' ), array ( $this, 'render_job_metabox' ), 'job', 'side', 'high'
        );
    }

    public function render_job_metabox( $post ) {

        // Retrieve an existing value from the database.
        $job_metatitle = get_post_meta( $post->ID, 'job_metatitle', true );
        $job_metadepartment = get_post_meta( $post->ID, 'job_metadepartment', true );

        // Set default values.
        if ( empty( $job_metatitle ) )
            $job_metatitle = '';
        if ( empty( $job_metadepartment ) )
            $job_metadepartment = '';

        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="job_metatitle" class="job_metatitle_label">' . __( 'Location', 'text_domain' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="job_metatitle" name="job_metatitle" class="job_metatitle_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $job_metatitle ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="job_metadepartment" class="job_metadepartment_label">' . __( 'Department', 'text_domain' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="job_metadepartment" name="job_metadepartment" class="job_metadepartment_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $job_metadepartment ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '</table>';
    }

    public function save_metabox( $post_id, $post ) {

        // Sanitize user input.
        $job_metanew_title = isset( $_POST[ 'job_metatitle' ] ) ? sanitize_text_field( $_POST[ 'job_metatitle' ] ) : '';
        $job_metanew_department = isset( $_POST[ 'job_metadepartment' ] ) ? sanitize_text_field( $_POST[ 'job_metadepartment' ] ) : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'job_metatitle', $job_metanew_title );
        update_post_meta( $post_id, 'job_metadepartment', $job_metanew_department );
    }

}


class Zeal_Faq_Widget extends WP_Widget {

	public function __construct() {

            parent::__construct(
                    'zeal-faqs-widget',
                    __( 'Zeal FAQs', 'zeal' ),
                    array(
                            'description' => __( 'Display the FAQs you have created', 'zeal' ),
                    )
            );

	}

	public function widget( $args, $instance ) {

            AddOns::zeal_output_faqs();

	}

	public function form( $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

	}

}

function zeal_faq_register_widgets() {
	register_widget( 'Zeal_Faq_Widget' );
}
add_action( 'widgets_init', 'zeal_faq_register_widgets' );

class Zeal_News_Widget extends WP_Widget {

	public function __construct() {

            parent::__construct(
                    'zeal-news-widget',
                    __( 'Zeal News', 'zeal' ),
                    array(
                            'description' => __( 'Display the News you have created', 'zeal' ),
                    )
            );

	}

	public function widget( $args, $instance ) {
            
            AddOns::zeal_output_news();

	}

	public function form( $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

	}

}

class Zeal_Events_Widget extends WP_Widget {

	public function __construct() {

            parent::__construct(
                    'zeal-events-widget',
                    __( 'Zeal Current Events', 'zeal' ),
                    array(
                            'description' => __( 'Display the Events you have created', 'zeal' ),
                    )
            );

	}

	public function widget( $args, $instance ) {
            
            AddOns::zeal_output_current_events();

	}

	public function form( $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

	}

}


class Zeal_Contact_Info extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'zeal-contact-info',
			__( 'Zeal Contact Info', 'zeal' ),
			array(
				'classname'   => 'zeal-contact-info',
			)
		);

	}

	public function widget( $args, $instance ) { ?>
            
        <div class="zeal-contact-info">
            
            <h2 class="widget-title"><?php echo !empty( $instance['zeal_contact_title'] ) ? $instance['zeal_contact_title'] : null ?></h2>
            <div class="diviver"><span></span></div>
            <div class="textwidget"><?php echo !empty( $instance['zeal_contact_subtitle'] ) ? $instance['zeal_contact_subtitle'] : null ?></div>

            <?php if( !empty( $instance['zeal_contact_phone'] ) ) : ?>
            <div class="col-sm-4">
                <div><span class="fa fa-phone"></span></div>
                <?php echo !empty( $instance['zeal_contact_phone'] ) ? $instance['zeal_contact_phone'] : null ?>
            </div>
            <?php endif; ?>

            <?php if( !empty( $instance['zeal_contact_email'] ) ) : ?>
            <div class="col-sm-4">
                <div><span class="fa fa-envelope"></span></div>
                <?php echo !empty( $instance['zeal_contact_email'] ) ? $instance['zeal_contact_email'] : null ?>
            </div>
            <?php endif; ?>

            <?php if( !empty( $instance['zeal_contact_address'] ) ) : ?>
            <div class="col-sm-4">
                <div><span class="fa fa-map"></span></div>
                <?php echo !empty( $instance['zeal_contact_address'] ) ? $instance['zeal_contact_address'] : null ?>
            </div>
            <?php endif; ?>
            
        </div>

        
        
	<?php }

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'zeal_contact_title' => '',
			'zeal_contact_subtitle' => '',
			'zeal_contact_phone' => '',
			'zeal_contact_email' => '',
			'zeal_contact_address' => '',
		) );

		// Retrieve an existing value from the database
		$zeal_contact_title = !empty( $instance['zeal_contact_title'] ) ? $instance['zeal_contact_title'] : '';
		$zeal_contact_subtitle = !empty( $instance['zeal_contact_subtitle'] ) ? $instance['zeal_contact_subtitle'] : '';
		$zeal_contact_phone = !empty( $instance['zeal_contact_phone'] ) ? $instance['zeal_contact_phone'] : '';
		$zeal_contact_email = !empty( $instance['zeal_contact_email'] ) ? $instance['zeal_contact_email'] : '';
		$zeal_contact_address = !empty( $instance['zeal_contact_address'] ) ? $instance['zeal_contact_address'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contact_title' ) . '" class="zeal_contact_title_label">' . __( 'Title', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contact_title' ) . '" name="' . $this->get_field_name( 'zeal_contact_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contact_title ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contact_subtitle' ) . '" class="zeal_contact_subtitle_label">' . __( 'Subtitle', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contact_subtitle' ) . '" name="' . $this->get_field_name( 'zeal_contact_subtitle' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contact_subtitle ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contact_phone' ) . '" class="zeal_contact_phone_label">' . __( 'Phone', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contact_phone' ) . '" name="' . $this->get_field_name( 'zeal_contact_phone' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contact_phone ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contact_email' ) . '" class="zeal_contact_email_label">' . __( 'Email', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contact_email' ) . '" name="' . $this->get_field_name( 'zeal_contact_email' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contact_email ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contact_address' ) . '" class="zeal_contact_address_label">' . __( 'Address', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contact_address' ) . '" name="' . $this->get_field_name( 'zeal_contact_address' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contact_address ) . '">';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['zeal_contact_title'] = !empty( $new_instance['zeal_contact_title'] ) ? strip_tags( $new_instance['zeal_contact_title'] ) : '';
		$instance['zeal_contact_subtitle'] = !empty( $new_instance['zeal_contact_subtitle'] ) ? strip_tags( $new_instance['zeal_contact_subtitle'] ) : '';
		$instance['zeal_contact_phone'] = !empty( $new_instance['zeal_contact_phone'] ) ? strip_tags( $new_instance['zeal_contact_phone'] ) : '';
		$instance['zeal_contact_email'] = !empty( $new_instance['zeal_contact_email'] ) ? strip_tags( $new_instance['zeal_contact_email'] ) : '';
		$instance['zeal_contact_address'] = !empty( $new_instance['zeal_contact_address'] ) ? strip_tags( $new_instance['zeal_contact_address'] ) : '';

		return $instance;

	}

}


class Zeal_Testimonials_Widget extends WP_Widget {

	public function __construct() {

            parent::__construct(
                    'zeal-testimonials-widget',
                    __( 'Zeal Testimonials Carousel', 'zeal' ),
                    array(
                            'description' => __( 'Display the Testimonials you have created', 'zeal' )
                    )
            );

	}

	public function widget( $args, $instance ) {
            
            AddOns::zeal_output_testimonials( 'owl-carousel owl-theme' );

	}

	public function form( $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

	}

}

class Zeal_Gallery_Widget extends WP_Widget {

	public function __construct() {

            parent::__construct(
                    'zeal-gallery-widget',
                    __( 'Zeal Gallery', 'zeal' ),
                    array(
                            'description' => __( 'Display the Gallery you have created', 'zeal' )
                    )
            );

	}

	public function widget( $args, $instance ) {
            
            AddOns::zeal_output_gallery( $instance );

	}

	public function form( $instance ) {

            $order = array(
                'normal'    => __( 'Default', 'zeal' ),
                'shuffle'   => __( 'Randomize Order', 'zeal' ),
            );
            
            $show_icons = array(
                'show'      => __( 'Show magnifying glass icon on hover', 'zeal' ),
                'hide'      => __( 'No icon on hover', 'zeal' ),
            );

            $styles = array(
                'columns'   => __( 'Columns', 'zeal' ),
                'justified' => __( 'Justified', 'zeal' ),
                'nested'    => __( 'Nested', 'zeal' ),
            );

            // Get all user defined Gallery Groups
            $taxonomy_groups = get_terms( array(
                'taxonomy'      => 'gallery_group',
                'hide_empty'    => false,
            ) );

            // Start an array with a default of All Gallery Items
            $groups = array(
                'all' => __( 'All Gallery Items', 'zeal'),
            );

            // Add any user defined Gallery Groups to the starting array
            if ( !empty ( $taxonomy_groups ) && is_array( $taxonomy_groups ) ) :
                
                foreach ( $taxonomy_groups as $tax_group ) :
                    $groups[ $tax_group->slug ] = $tax_group->name;
                endforeach;

            endif;

            // Set default values
            $instance = wp_parse_args( (array) $instance, array( 
                'zeal_gallery_tile_style'   => 'columns',
                'zeal_gallery_limit'        => '-1',
                'zeal_gallery_shuffle'      => 'normal',
                'zeal_gallery_icons'        => 'show',
                'zeal_gallery_group'        => 'all',
            ) );
            
            // Retrieve an existing value from the database
            $zeal_gallery_tile_style   = !empty( $instance['zeal_gallery_tile_style'] ) ? $instance['zeal_gallery_tile_style'] : 'columns';
            $zeal_gallery_limit        = !empty( $instance['zeal_gallery_limit'] ) ? $instance['zeal_gallery_limit'] : '-1';
            $zeal_gallery_shuffle      = !empty( $instance['zeal_gallery_shuffle'] ) ? $instance['zeal_gallery_shuffle'] : '-1';
            $zeal_gallery_icons      = !empty( $instance['zeal_gallery_icons'] ) ? $instance['zeal_gallery_icons'] : 'show';
            $zeal_gallery_group        = !empty( $instance['zeal_gallery_group'] ) ? $instance['zeal_gallery_group'] : 'all';

            // Show All or Specific Group of Gallery Items?
            echo '<p>';
            echo '	<label for="' . $this->get_field_id( 'zeal_gallery_group' ) . '" class="zeal_gallery_group_label">' . __( 'Show All or Specific Gallery Group?', 'zeal' ) . '</label>';
            echo '	<select id="' . $this->get_field_id( 'zeal_gallery_group' ) . '" name="' . $this->get_field_name( 'zeal_gallery_group' ) . '" class="widefat">';
                foreach( $groups as $key => $value ) :
                    echo '<option value="' . $key . '" ' . selected( $zeal_gallery_group, $key, false ) . '> ' . $value . '</option>';
                endforeach;
            echo '	</select>';
            echo '</p>';
            
            // Tile Style - Select/Option
            echo '<p>';
            echo '	<label for="' . $this->get_field_id( 'zeal_gallery_tile_style' ) . '" class="zeal_gallery_tile_style_label">' . __( 'Tile Style', 'zeal' ) . '</label>';
            echo '	<select id="' . $this->get_field_id( 'zeal_gallery_tile_style' ) . '" name="' . $this->get_field_name( 'zeal_gallery_tile_style' ) . '" class="widefat">';
                foreach( $styles as $key => $value ) :
                    echo '<option value="' . $key . '" ' . selected( $zeal_gallery_tile_style, $key, false ) . '> ' . $value . '</option>';
                endforeach;
            echo '	</select>';
            echo '</p>';
            
            // Limit Number to Show
            echo '<p>';
            echo '	<label for="' . $this->get_field_id( 'zeal_gallery_limit' ) . '" class="zeal_gallery_limit_label">' . __( 'Limit to Show ("-1" for No Limit)', 'zeal' ) . '</label>';
            echo '	<input type="text" id="' . $this->get_field_id( 'zeal_gallery_limit' ) . '" name="' . $this->get_field_name( 'zeal_gallery_limit' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_gallery_limit ) . '">';
            echo '</p>';

            // Tile Ordering Style - Select/Option
            echo '<p>';
            echo '	<label for="' . $this->get_field_id( 'zeal_gallery_shuffle' ) . '" class="zeal_gallery_shuffle_label">' . __( 'Randomize Slide Order?', 'zeal' ) . '</label>';
            echo '	<select id="' . $this->get_field_id( 'zeal_gallery_shuffle' ) . '" name="' . $this->get_field_name( 'zeal_gallery_shuffle' ) . '" class="widefat">';
                foreach( $order as $key => $value ) :
                    echo '<option value="' . $key . '" ' . selected( $zeal_gallery_shuffle, $key, false ) . '> ' . $value . '</option>';
                endforeach;
            echo '	</select>';
            echo '</p>';
            
            // Tile Icon on Hover
            echo '<p>';
            echo '	<label for="' . $this->get_field_id( 'zeal_gallery_icons' ) . '" class="zeal_gallery_icons_label">' . __( 'Show Icon on Hover?', 'zeal' ) . '</label>';
            echo '	<select id="' . $this->get_field_id( 'zeal_gallery_icons' ) . '" name="' . $this->get_field_name( 'zeal_gallery_icons' ) . '" class="widefat">';
                foreach( $show_icons as $key => $value ) :
                    echo '<option value="' . $key . '" ' . selected( $zeal_gallery_icons, $key, false ) . '> ' . $value . '</option>';
                endforeach;
            echo '	</select>';
            echo '</p>';
            
	}

	public function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            
            $instance['zeal_gallery_tile_style']       = !empty( $new_instance['zeal_gallery_tile_style'] ) ? strip_tags( $new_instance['zeal_gallery_tile_style'] ) : 'columns';
            $instance['zeal_gallery_limit']            = !empty( $new_instance['zeal_gallery_limit'] ) ? strip_tags( $new_instance['zeal_gallery_limit'] ) : '-1';
            $instance['zeal_gallery_shuffle']          = !empty( $new_instance['zeal_gallery_shuffle'] ) ? strip_tags( $new_instance['zeal_gallery_shuffle'] ) : 'normal';
            $instance['zeal_gallery_group']            = !empty( $new_instance['zeal_gallery_group'] ) ? strip_tags( $new_instance['zeal_gallery_group'] ) : 'all';
            $instance['zeal_gallery_icons']             = !empty( $new_instance['zeal_gallery_icons'] ) ? strip_tags( $new_instance['zeal_gallery_icons'] ) : 'show';
            
            return $instance;

            
	}

}

class Zeal_Contact_Form extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'zeal-contact-form',
			__( 'Zeal Contact Form', 'zeal' )
		);

	}

	public function widget( $args, $instance ) { 
            AddOns::zeal_contact_form( $instance );
	}

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'zeal_contactfrom_label' => __( 'Name', 'zeal' ),
			'zeal_contactemail_label' => __( 'Email Address', 'zeal' ),
			'zeal_contactmessage_label' => __( 'Message', 'zeal' ),
			'zeal_contactemail' => '',
                        'zeal_contactsubmit_label' => __( 'Submit', 'zeal' )
		) );

		// Retrieve an existing value from the database
		$zeal_contactfrom_label     = !empty( $instance['zeal_contactfrom_label'] ) ? $instance['zeal_contactfrom_label'] : '';
		$zeal_contactemail_label    = !empty( $instance['zeal_contactemail_label'] ) ? $instance['zeal_contactemail_label'] : '';
		$zeal_contactmessage_label  = !empty( $instance['zeal_contactmessage_label'] ) ? $instance['zeal_contactmessage_label'] : '';
		$zeal_contactemail          = !empty( $instance['zeal_contactemail'] ) ? $instance['zeal_contactemail'] : '';
		$zeal_contactsubmit_label   = !empty( $instance['zeal_contactsubmit_label'] ) ? $instance['zeal_contactsubmit_label'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contactfrom_label' ) . '" class="zeal_contactfrom_label_label">' . __( 'From Name Label', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contactfrom_label' ) . '" name="' . $this->get_field_name( 'zeal_contactfrom_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contactfrom_label ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contactemail_label' ) . '" class="zeal_contactemail_label_label">' . __( 'Email Address Label', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contactemail_label' ) . '" name="' . $this->get_field_name( 'zeal_contactemail_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contactemail_label ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contactmessage_label' ) . '" class="zeal_contactmessage_label_label">' . __( 'Message Label', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_contactmessage_label' ) . '" name="' . $this->get_field_name( 'zeal_contactmessage_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contactmessage_label ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contactemail' ) . '" class="zeal_contactemail_label">' . __( 'Recipient Email', 'zeal' ) . '</label>';
		echo '	<input type="email" id="' . $this->get_field_id( 'zeal_contactemail' ) . '" name="' . $this->get_field_name( 'zeal_contactemail' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contactemail ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_contactsubmit_label' ) . '" class="zeal_contactemail_label">' . __( 'Button Text', 'zeal' ) . '</label>';
		echo '	<input type="email" id="' . $this->get_field_id( 'zeal_contactsubmit_label' ) . '" name="' . $this->get_field_name( 'zeal_contactsubmit_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_contactsubmit_label ) . '">';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['zeal_contactfrom_label'] = !empty( $new_instance['zeal_contactfrom_label'] ) ? strip_tags( $new_instance['zeal_contactfrom_label'] ) : '';
		$instance['zeal_contactemail_label'] = !empty( $new_instance['zeal_contactemail_label'] ) ? strip_tags( $new_instance['zeal_contactemail_label'] ) : '';
		$instance['zeal_contactmessage_label'] = !empty( $new_instance['zeal_contactmessage_label'] ) ? strip_tags( $new_instance['zeal_contactmessage_label'] ) : '';
		$instance['zeal_contactemail'] = !empty( $new_instance['zeal_contactemail'] ) ? strip_tags( $new_instance['zeal_contactemail'] ) : '';
		$instance['zeal_contactsubmit_label'] = !empty( $new_instance['zeal_contactsubmit_label'] ) ? strip_tags( $new_instance['zeal_contactsubmit_label'] ) : '';

		return $instance;

	}

}

class Zeal_Pricing_Table extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'zeal-pricing-table',
			__( 'Zeal Pricing Table', 'zeal' ),
			array(
				'classname'   => 'zeal-pricing-table',
			)
		);

	}

	public function widget( $args, $instance ) { ?>

        <div class="col-sm-4 zeal-pricing-table">
            <div class="inner">
                <?php echo empty( $instance['zeal_pricing_table_special'] ) ? null : '<span class="special"><span class="fa fa-star"></span></span>'; ?>
                <h2 class="title"><?php echo !empty( $instance['zeal_pricing_table_title'] ) ? $instance['zeal_pricing_table_title'] : null ?></h2>
                <div class="diviver"><span></span></div>
                <div class="price"><?php echo !empty( $instance['zeal_pricing_table_price'] ) ? $instance['zeal_pricing_table_price'] : null ?></div>
                <div class="subtitle"><?php echo !empty( $instance['zeal_pricing_table_subtitle'] ) ? $instance['zeal_pricing_table_subtitle'] : null ?></div>
                <div class="description">
                    <?php echo !empty( $instance['zeal_pricing_table_description'] ) ? $instance['zeal_pricing_table_description'] : null ?>
                </div>
            </div>
        </div>
            
            
	<?php }

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'zeal_pricing_table_special' => '',
			'zeal_pricing_table_title' => '',
			'zeal_pricing_table_price' => '',
			'zeal_pricing_table_subtitle' => '',
			'zeal_pricing_table_description' => '',
		) );

		// Retrieve an existing value from the database
		$zeal_pricing_table_special = !empty( $instance['zeal_pricing_table_special'] ) ? $instance['zeal_pricing_table_special'] : '';
		$zeal_pricing_table_title = !empty( $instance['zeal_pricing_table_title'] ) ? $instance['zeal_pricing_table_title'] : '';
		$zeal_pricing_table_price = !empty( $instance['zeal_pricing_table_price'] ) ? $instance['zeal_pricing_table_price'] : '';
		$zeal_pricing_table_subtitle = !empty( $instance['zeal_pricing_table_subtitle'] ) ? $instance['zeal_pricing_table_subtitle'] : '';
		$zeal_pricing_table_description = !empty( $instance['zeal_pricing_table_description'] ) ? $instance['zeal_pricing_table_description'] : '';

		// Form fields
		echo '<p>';
		echo '	<label>';
		echo '		<input type="checkbox" id="' . $this->get_field_id( 'zeal_pricing_table_special' ) . '" name="' . $this->get_field_name( 'zeal_pricing_table_special' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="1" ' . checked( $zeal_pricing_table_special, true, false ) . '>' . __( 'Special', 'zeal' );
		echo '	</label><br>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_pricing_table_title' ) . '" class="zeal_pricing_table_title_label">' . __( 'Title', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_pricing_table_title' ) . '" name="' . $this->get_field_name( 'zeal_pricing_table_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_pricing_table_title ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_pricing_table_price' ) . '" class="zeal_pricing_table_price_label">' . __( 'Price', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_pricing_table_price' ) . '" name="' . $this->get_field_name( 'zeal_pricing_table_price' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_pricing_table_price ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_pricing_table_subtitle' ) . '" class="zeal_pricing_table_subtitle_label">' . __( 'Subtitle', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_pricing_table_subtitle' ) . '" name="' . $this->get_field_name( 'zeal_pricing_table_subtitle' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_pricing_table_subtitle ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_pricing_table_description' ) . '" class="zeal_pricing_table_description_label">' . __( 'Description', 'zeal' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'zeal_pricing_table_description' ) . '" name="' . $this->get_field_name( 'zeal_pricing_table_description' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '">' . $zeal_pricing_table_description . '</textarea>';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['zeal_pricing_table_special'] = !empty( $new_instance['zeal_pricing_table_special'] ) ? true : false;
		$instance['zeal_pricing_table_title'] = !empty( $new_instance['zeal_pricing_table_title'] ) ? strip_tags( $new_instance['zeal_pricing_table_title'] ) : '';
		$instance['zeal_pricing_table_price'] = !empty( $new_instance['zeal_pricing_table_price'] ) ? strip_tags( $new_instance['zeal_pricing_table_price'] ) : '';
		$instance['zeal_pricing_table_subtitle'] = !empty( $new_instance['zeal_pricing_table_subtitle'] ) ? strip_tags( $new_instance['zeal_pricing_table_subtitle'] ) : '';
		$instance['zeal_pricing_table_description'] = !empty( $new_instance['zeal_pricing_table_description'] ) ? ( $new_instance['zeal_pricing_table_description'] ) : '';

		return $instance;

	}

}

class Zeal_Service extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'zeal-service',
			__( 'Zeal Service', 'zeal' ),
			array(
				'classname'   => 'zeal-service',
			)                        
		);

	}

	public function widget( $args, $instance ) { ?>

        <div class="zeal-service col-sm-4">
            <span class="<?php echo $instance['zeal_service_icon']; ?>"></span>
            <h3><?php echo $instance['zeal_service_title']; ?></h3>
            <div class="diviver"><span></span></div>
            <p><?php echo $instance['zeal_service_description']; ?></p>
        </div>
        
        
	<?php }

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'zeal_service_title' => '',
			'zeal_service_icon' => '',
			'zeal_service_description' => '',
		) );

		// Retrieve an existing value from the database
		$zeal_service_title = !empty( $instance['zeal_service_title'] ) ? $instance['zeal_service_title'] : '';
		$zeal_service_icon = !empty( $instance['zeal_service_icon'] ) ? $instance['zeal_service_icon'] : '';
		$zeal_service_description = !empty( $instance['zeal_service_description'] ) ? $instance['zeal_service_description'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_service_title' ) . '" class="zeal_service_title_label">' . __( 'Title', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_service_title' ) . '" name="' . $this->get_field_name( 'zeal_service_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_service_title ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_service_icon' ) . '" class="zeal_service_icon_label">' . __( 'Icon', 'zeal' ) . '</label>';
		echo '	<select id="' . $this->get_field_id( 'zeal_service_icon' ) . '" name="' . $this->get_field_name( 'zeal_service_icon' ) . '" class="widefat">';
                
                foreach( zeal_icons() as $key=>$value ) :
		echo '		<option value="' . $key . '" ' . selected( $zeal_service_icon, $key, false ) . '> ' . $value . '</option>';
		endforeach;
                
                echo '	</select>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_service_description' ) . '" class="zeal_service_description_label">' . __( 'Description', 'zeal' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'zeal_service_description' ) . '" name="' . $this->get_field_name( 'zeal_service_description' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '">' . $zeal_service_description . '</textarea>';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['zeal_service_title'] = !empty( $new_instance['zeal_service_title'] ) ? strip_tags( $new_instance['zeal_service_title'] ) : '';
		$instance['zeal_service_icon'] = !empty( $new_instance['zeal_service_icon'] ) ? strip_tags( $new_instance['zeal_service_icon'] ) : '';
		$instance['zeal_service_description'] = !empty( $new_instance['zeal_service_description'] ) ? strip_tags( $new_instance['zeal_service_description'] ) : '';

		return $instance;

	}

}

class Zeal_CTA extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'zeal-cta',
			__( 'Zeal Call to Action', 'zeal' ),
			array(
				'classname'   => 'zeal-cta',
			)
		);

	}

	public function widget( $args, $instance ) { ?>

            <div class="zeal-callout">
                
                <h3 class="widget-title"><?php echo isset( $instance['zeal_cta_title'] ) && $instance['zeal_cta_title'] ? $instance['zeal_cta_title'] : ''; ?></h3>
                <div class="diviver"><span></span></div>
                <div class="textwidget"><?php echo isset( $instance['zeal_cta_detail'] ) && $instance['zeal_cta_detail'] ? $instance['zeal_cta_detail'] : ''; ?></div>
                <div>
                    <?php if( isset( $instance['zeal_cta_button1_url'] ) && $instance['zeal_cta_button1_url'] ) : ?>
                        <a class="zeal-button" href="<?php echo esc_url( $instance['zeal_cta_button1_url'] ); ?>"><?php echo isset( $instance['zeal_cta_button1_text'] ) ? $instance['zeal_cta_button1_text'] : ''; ?></a>
                    <?php endif; ?>
                    <?php if( isset( $instance['zeal_cta_button2_url'] ) && $instance['zeal_cta_button2_url'] ) : ?>
                        <a class="zeal-button" href="<?php echo esc_url( $instance['zeal_cta_button2_url'] ); ?>"><?php echo isset( $instance['zeal_cta_button2_text'] ) ? $instance['zeal_cta_button2_text'] : ''; ?></a>
                    <?php endif; ?>
                </div>
                
            </div>
        
        
	<?php }

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'zeal_cta_title' => '',
			'zeal_cta_detail' => '',
			'zeal_cta_button1_text' => '',
			'zeal_cta_button1_url' => '',
			'zeal_cta_button2_text' => '',
			'zeal_cta_button2_url' => '',
		) );

		// Retrieve an existing value from the database
		$zeal_cta_title = !empty( $instance['zeal_cta_title'] ) ? $instance['zeal_cta_title'] : '';
		$zeal_cta_detail = !empty( $instance['zeal_cta_detail'] ) ? $instance['zeal_cta_detail'] : '';
		$zeal_cta_button1_text = !empty( $instance['zeal_cta_button1_text'] ) ? $instance['zeal_cta_button1_text'] : '';
		$zeal_cta_button1_url = !empty( $instance['zeal_cta_button1_url'] ) ? $instance['zeal_cta_button1_url'] : '';
		$zeal_cta_button2_text = !empty( $instance['zeal_cta_button2_text'] ) ? $instance['zeal_cta_button2_text'] : '';
		$zeal_cta_button2_url = !empty( $instance['zeal_cta_button2_url'] ) ? $instance['zeal_cta_button2_url'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_title' ) . '" class="zeal_cta_title_label">' . __( 'Title', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_cta_title' ) . '" name="' . $this->get_field_name( 'zeal_cta_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_cta_title ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_detail' ) . '" class="zeal_cta_detail_label">' . __( 'Details', 'zeal' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'zeal_cta_detail' ) . '" name="' . $this->get_field_name( 'zeal_cta_detail' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '">' . $zeal_cta_detail . '</textarea>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_button1_text' ) . '" class="zeal_cta_button1_text_label">' . __( 'Button 1 Text', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_cta_button1_text' ) . '" name="' . $this->get_field_name( 'zeal_cta_button1_text' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_cta_button1_text ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_button1_url' ) . '" class="zeal_cta_button1_url_label">' . __( 'Button 1 URL', 'zeal' ) . '</label>';
		echo '	<input type="url" id="' . $this->get_field_id( 'zeal_cta_button1_url' ) . '" name="' . $this->get_field_name( 'zeal_cta_button1_url' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_cta_button1_url ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_button2_text' ) . '" class="zeal_cta_button2_text_label">' . __( 'Button 2 Text', 'zeal' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'zeal_cta_button2_text' ) . '" name="' . $this->get_field_name( 'zeal_cta_button2_text' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_cta_button2_text ) . '">';
		echo '</p>';
                
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'zeal_cta_button2_url' ) . '" class="zeal_cta_button2_url_label">' . __( 'Button 2 URL', 'zeal' ) . '</label>';
		echo '	<input type="url" id="' . $this->get_field_id( 'zeal_cta_button2_url' ) . '" name="' . $this->get_field_name( 'zeal_cta_button2_url' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'zeal' ) . '" value="' . esc_attr( $zeal_cta_button2_url ) . '">';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['zeal_cta_title'] = !empty( $new_instance['zeal_cta_title'] ) ? strip_tags( $new_instance['zeal_cta_title'] ) : '';
		$instance['zeal_cta_detail'] = !empty( $new_instance['zeal_cta_detail'] ) ? strip_tags( $new_instance['zeal_cta_detail'] ) : '';
		$instance['zeal_cta_button1_text'] = !empty( $new_instance['zeal_cta_button1_text'] ) ? strip_tags( $new_instance['zeal_cta_button1_text'] ) : '';
		$instance['zeal_cta_button1_url'] = !empty( $new_instance['zeal_cta_button1_url'] ) ? strip_tags( $new_instance['zeal_cta_button1_url'] ) : '';
		$instance['zeal_cta_button2_text'] = !empty( $new_instance['zeal_cta_button2_text'] ) ? strip_tags( $new_instance['zeal_cta_button2_text'] ) : '';
		$instance['zeal_cta_button2_url'] = !empty( $new_instance['zeal_cta_button2_url'] ) ? strip_tags( $new_instance['zeal_cta_button2_url'] ) : '';

		return $instance;

	}

}

function zeal_send_message(){

    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_text_field( $_POST['email'] );
    $message_entered = sanitize_text_field( $_POST['message'] );
    $recipient_email = sanitize_text_field( $_POST['recipient'] );

    $message = 'From: ' . $name . ' || Sender Email: ' . $email . ' || Message: ' . $message_entered;

    wp_mail( $recipient_email, __( 'New message from ' . get_option( 'blog_name' ), 'zeal' ), $message );
    
    echo 1;
    exit();

}
add_action('wp_ajax_zeal_send_message', 'zeal_send_message' );
add_action('wp_ajax_nopriv_zeal_send_message', 'zeal_send_message' );


function zeal_icons() {

    return array(
        'fa fa-clock' => __('Select One', 'zeal'),
        'fa fa-500px' => __(' 500px', 'zeal'),
        'fa fa-amazon' => __(' amazon', 'zeal'),
        'fa fa-balance-scale' => __(' balance-scale', 'zeal'), 'fa fa-battery-0' => __(' battery-0', 'zeal'), 'fa fa-battery-1' => __(' battery-1', 'zeal'), 'fa fa-battery-2' => __(' battery-2', 'zeal'), 'fa fa-battery-3' => __(' battery-3', 'zeal'), 'fa fa-battery-4' => __(' battery-4', 'zeal'), 'fa fa-battery-empty' => __(' battery-empty', 'zeal'), 'fa fa-battery-full' => __(' battery-full', 'zeal'), 'fa fa-battery-half' => __(' battery-half', 'zeal'), 'fa fa-battery-quarter' => __(' battery-quarter', 'zeal'), 'fa fa-battery-three-quarters' => __(' battery-three-quarters', 'zeal'), 'fa fa-black-tie' => __(' black-tie', 'zeal'), 'fa fa-calendar-check-o' => __(' calendar-check-o', 'zeal'), 'fa fa-calendar-minus-o' => __(' calendar-minus-o', 'zeal'), 'fa fa-calendar-plus-o' => __(' calendar-plus-o', 'zeal'), 'fa fa-calendar-times-o' => __(' calendar-times-o', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-chrome' => __(' chrome', 'zeal'), 'fa fa-clone' => __(' clone', 'zeal'), 'fa fa-commenting' => __(' commenting', 'zeal'), 'fa fa-commenting-o' => __(' commenting-o', 'zeal'), 'fa fa-contao' => __(' contao', 'zeal'), 'fa fa-creative-commons' => __(' creative-commons', 'zeal'), 'fa fa-expeditedssl' => __(' expeditedssl', 'zeal'), 'fa fa-firefox' => __(' firefox', 'zeal'), 'fa fa-fonticons' => __(' fonticons', 'zeal'), 'fa fa-genderless' => __(' genderless', 'zeal'), 'fa fa-get-pocket' => __(' get-pocket', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-hourglass' => __(' hourglass', 'zeal'), 'fa fa-hourglass-1' => __(' hourglass-1', 'zeal'), 'fa fa-hourglass-2' => __(' hourglass-2', 'zeal'), 'fa fa-hourglass-3' => __(' hourglass-3', 'zeal'), 'fa fa-hourglass-end' => __(' hourglass-end', 'zeal'), 'fa fa-hourglass-half' => __(' hourglass-half', 'zeal'), 'fa fa-hourglass-o' => __(' hourglass-o', 'zeal'), 'fa fa-hourglass-start' => __(' hourglass-start', 'zeal'), 'fa fa-houzz' => __(' houzz', 'zeal'), 'fa fa-i-cursor' => __(' i-cursor', 'zeal'), 'fa fa-industry' => __(' industry', 'zeal'), 'fa fa-internet-explorer' => __(' internet-explorer', 'zeal'), 'fa fa-map' => __(' map', 'zeal'), 'fa fa-map-o' => __(' map-o', 'zeal'), 'fa fa-map-pin' => __(' map-pin', 'zeal'), 'fa fa-map-signs' => __(' map-signs', 'zeal'), 'fa fa-mouse-pointer' => __(' mouse-pointer', 'zeal'), 'fa fa-object-group' => __(' object-group', 'zeal'), 'fa fa-object-ungroup' => __(' object-ungroup', 'zeal'), 'fa fa-odnoklassniki' => __(' odnoklassniki', 'zeal'), 'fa fa-odnoklassniki-square' => __(' odnoklassniki-square', 'zeal'), 'fa fa-opencart' => __(' opencart', 'zeal'), 'fa fa-opera' => __(' opera', 'zeal'), 'fa fa-optin-monster' => __(' optin-monster', 'zeal'), 'fa fa-registered' => __(' registered', 'zeal'), 'fa fa-safari' => __(' safari', 'zeal'), 'fa fa-sticky-note' => __(' sticky-note', 'zeal'), 'fa fa-sticky-note-o' => __(' sticky-note-o', 'zeal'), 'fa fa-television' => __(' television', 'zeal'), 'fa fa-trademark' => __(' trademark', 'zeal'), 'fa fa-tripadvisor' => __(' tripadvisor', 'zeal'), 'fa fa-tv' => __(' tv', 'zeal'), 'fa fa-vimeo' => __(' vimeo', 'zeal'), 'fa fa-wikipedia-w' => __(' wikipedia-w', 'zeal'), 'fa fa-y-combinator' => __(' y-combinator', 'zeal'), 'fa fa-yc' => __(' yc', 'zeal'), 'fa fa-adjust' => __(' adjust', 'zeal'), 'fa fa-anchor' => __(' anchor', 'zeal'), 'fa fa-archive' => __(' archive', 'zeal'), 'fa fa-area-chart' => __(' area-chart', 'zeal'), 'fa fa-arrows' => __(' arrows', 'zeal'), 'fa fa-arrows-h' => __(' arrows-h', 'zeal'), 'fa fa-arrows-v' => __(' arrows-v', 'zeal'), 'fa fa-asterisk' => __(' asterisk', 'zeal'), 'fa fa-at' => __(' at', 'zeal'), 'fa fa-automobile' => __(' automobile', 'zeal'), 'fa fa-balance-scale' => __(' balance-scale', 'zeal'), 'fa fa-ban' => __(' ban', 'zeal'), 'fa fa-bank' => __(' bank', 'zeal'), 'fa fa-bar-chart' => __(' bar-chart', 'zeal'), 'fa fa-bar-chart-o' => __(' bar-chart-o', 'zeal'), 'fa fa-barcode' => __(' barcode', 'zeal'), 'fa fa-bars' => __(' bars', 'zeal'), 'fa fa-battery-0' => __(' battery-0', 'zeal'), 'fa fa-battery-1' => __(' battery-1', 'zeal'), 'fa fa-battery-2' => __(' battery-2', 'zeal'), 'fa fa-battery-3' => __(' battery-3', 'zeal'), 'fa fa-battery-4' => __(' battery-4', 'zeal'), 'fa fa-battery-empty' => __(' battery-empty', 'zeal'), 'fa fa-battery-full' => __(' battery-full', 'zeal'), 'fa fa-battery-half' => __(' battery-half', 'zeal'), 'fa fa-battery-quarter' => __(' battery-quarter', 'zeal'), 'fa fa-battery-three-quarters' => __(' battery-three-quarters', 'zeal'), 'fa fa-bed' => __(' bed', 'zeal'), 'fa fa-beer' => __(' beer', 'zeal'), 'fa fa-bell' => __(' bell', 'zeal'), 'fa fa-bell-o' => __(' bell-o', 'zeal'), 'fa fa-bell-slash' => __(' bell-slash', 'zeal'), 'fa fa-bell-slash-o' => __(' bell-slash-o', 'zeal'), 'fa fa-bicycle' => __(' bicycle', 'zeal'), 'fa fa-binoculars' => __(' binoculars', 'zeal'), 'fa fa-birthday-cake' => __(' birthday-cake', 'zeal'), 'fa fa-bolt' => __(' bolt', 'zeal'), 'fa fa-bomb' => __(' bomb', 'zeal'), 'fa fa-book' => __(' book', 'zeal'), 'fa fa-bookmark' => __(' bookmark', 'zeal'), 'fa fa-bookmark-o' => __(' bookmark-o', 'zeal'), 'fa fa-briefcase' => __(' briefcase', 'zeal'), 'fa fa-bug' => __(' bug', 'zeal'), 'fa fa-building' => __(' building', 'zeal'), 'fa fa-building-o' => __(' building-o', 'zeal'), 'fa fa-bullhorn' => __(' bullhorn', 'zeal'), 'fa fa-bullseye' => __(' bullseye', 'zeal'), 'fa fa-bus' => __(' bus', 'zeal'), 'fa fa-cab' => __(' cab', 'zeal'), 'fa fa-calculator' => __(' calculator', 'zeal'), 'fa fa-calendar' => __(' calendar', 'zeal'), 'fa fa-calendar-check-o' => __(' calendar-check-o', 'zeal'), 'fa fa-calendar-minus-o' => __(' calendar-minus-o', 'zeal'), 'fa fa-calendar-o' => __(' calendar-o', 'zeal'), 'fa fa-calendar-plus-o' => __(' calendar-plus-o', 'zeal'), 'fa fa-calendar-times-o' => __(' calendar-times-o', 'zeal'), 'fa fa-camera' => __(' camera', 'zeal'), 'fa fa-camera-retro' => __(' camera-retro', 'zeal'), 'fa fa-car' => __(' car', 'zeal'), 'fa fa-caret-square-o-down' => __(' caret-square-o-down', 'zeal'), 'fa fa-caret-square-o-left' => __(' caret-square-o-left', 'zeal'), 'fa fa-caret-square-o-right' => __(' caret-square-o-right', 'zeal'), 'fa fa-caret-square-o-up' => __(' caret-square-o-up', 'zeal'), 'fa fa-cart-arrow-down' => __(' cart-arrow-down', 'zeal'), 'fa fa-cart-plus' => __(' cart-plus', 'zeal'), 'fa fa-cc' => __(' cc', 'zeal'), 'fa fa-certificate' => __(' certificate', 'zeal'), 'fa fa-check' => __(' check', 'zeal'), 'fa fa-check-circle' => __(' check-circle', 'zeal'), 'fa fa-check-circle-o' => __(' check-circle-o', 'zeal'), 'fa fa-check-square' => __(' check-square', 'zeal'), 'fa fa-check-square-o' => __(' check-square-o', 'zeal'), 'fa fa-child' => __(' child', 'zeal'), 'fa fa-circle' => __(' circle', 'zeal'), 'fa fa-circle-o' => __(' circle-o', 'zeal'), 'fa fa-circle-o-notch' => __(' circle-o-notch', 'zeal'), 'fa fa-circle-thin' => __(' circle-thin', 'zeal'), 'fa fa-clock-o' => __(' clock-o', 'zeal'), 'fa fa-clone' => __(' clone', 'zeal'), 'fa fa-close' => __(' close', 'zeal'), 'fa fa-cloud' => __(' cloud', 'zeal'), 'fa fa-cloud-download' => __(' cloud-download', 'zeal'), 'fa fa-cloud-upload' => __(' cloud-upload', 'zeal'), 'fa fa-code' => __(' code', 'zeal'), 'fa fa-code-fork' => __(' code-fork', 'zeal'), 'fa fa-coffee' => __(' coffee', 'zeal'), 'fa fa-cog' => __(' cog', 'zeal'), 'fa fa-cogs' => __(' cogs', 'zeal'), 'fa fa-comment' => __(' comment', 'zeal'), 'fa fa-comment-o' => __(' comment-o', 'zeal'), 'fa fa-commenting' => __(' commenting', 'zeal'), 'fa fa-commenting-o' => __(' commenting-o', 'zeal'), 'fa fa-comments' => __(' comments', 'zeal'), 'fa fa-comments-o' => __(' comments-o', 'zeal'), 'fa fa-compass' => __(' compass', 'zeal'), 'fa fa-copyright' => __(' copyright', 'zeal'), 'fa fa-creative-commons' => __(' creative-commons', 'zeal'), 'fa fa-credit-card' => __(' credit-card', 'zeal'), 'fa fa-crop' => __(' crop', 'zeal'), 'fa fa-crosshairs' => __(' crosshairs', 'zeal'), 'fa fa-cube' => __(' cube', 'zeal'), 'fa fa-cubes' => __(' cubes', 'zeal'), 'fa fa-cutlery' => __(' cutlery', 'zeal'), 'fa fa-dashboard' => __(' dashboard', 'zeal'), 'fa fa-database' => __(' database', 'zeal'), 'fa fa-desktop' => __(' desktop', 'zeal'), 'fa fa-diamond' => __(' diamond', 'zeal'), 'fa fa-dot-circle-o' => __(' dot-circle-o', 'zeal'), 'fa fa-download' => __(' download', 'zeal'), 'fa fa-edit' => __(' edit', 'zeal'), 'fa fa-ellipsis-h' => __(' ellipsis-h', 'zeal'), 'fa fa-ellipsis-v' => __(' ellipsis-v', 'zeal'), 'fa fa-envelope' => __(' envelope', 'zeal'), 'fa fa-envelope-o' => __(' envelope-o', 'zeal'), 'fa fa-envelope-square' => __(' envelope-square', 'zeal'), 'fa fa-eraser' => __(' eraser', 'zeal'), 'fa fa-exchange' => __(' exchange', 'zeal'), 'fa fa-exclamation' => __(' exclamation', 'zeal'), 'fa fa-exclamation-circle' => __(' exclamation-circle', 'zeal'), 'fa fa-exclamation-triangle' => __(' exclamation-triangle', 'zeal'), 'fa fa-external-link' => __(' external-link', 'zeal'), 'fa fa-external-link-square' => __(' external-link-square', 'zeal'), 'fa fa-eye' => __(' eye', 'zeal'), 'fa fa-eye-slash' => __(' eye-slash', 'zeal'), 'fa fa-eyedropper' => __(' eyedropper', 'zeal'), 'fa fa-fax' => __(' fax', 'zeal'), 'fa fa-feed' => __(' feed', 'zeal'), 'fa fa-female' => __(' female', 'zeal'), 'fa fa-fighter-jet' => __(' fighter-jet', 'zeal'), 'fa fa-file-archive-o' => __(' file-archive-o', 'zeal'), 'fa fa-file-audio-o' => __(' file-audio-o', 'zeal'), 'fa fa-file-code-o' => __(' file-code-o', 'zeal'), 'fa fa-file-excel-o' => __(' file-excel-o', 'zeal'), 'fa fa-file-image-o' => __(' file-image-o', 'zeal'), 'fa fa-file-movie-o' => __(' file-movie-o', 'zeal'), 'fa fa-file-pdf-o' => __(' file-pdf-o', 'zeal'), 'fa fa-file-photo-o' => __(' file-photo-o', 'zeal'), 'fa fa-file-picture-o' => __(' file-picture-o', 'zeal'), 'fa fa-file-powerpoint-o' => __(' file-powerpoint-o', 'zeal'), 'fa fa-file-sound-o' => __(' file-sound-o', 'zeal'), 'fa fa-file-video-o' => __(' file-video-o', 'zeal'), 'fa fa-file-word-o' => __(' file-word-o', 'zeal'), 'fa fa-file-zip-o' => __(' file-zip-o', 'zeal'), 'fa fa-film' => __(' film', 'zeal'), 'fa fa-filter' => __(' filter', 'zeal'), 'fa fa-fire' => __(' fire', 'zeal'), 'fa fa-fire-extinguisher' => __(' fire-extinguisher', 'zeal'), 'fa fa-flag' => __(' flag', 'zeal'), 'fa fa-flag-checkered' => __(' flag-checkered', 'zeal'), 'fa fa-flag-o' => __(' flag-o', 'zeal'), 'fa fa-flash' => __(' flash', 'zeal'), 'fa fa-flask' => __(' flask', 'zeal'), 'fa fa-folder' => __(' folder', 'zeal'), 'fa fa-folder-o' => __(' folder-o', 'zeal'), 'fa fa-folder-open' => __(' folder-open', 'zeal'), 'fa fa-folder-open-o' => __(' folder-open-o', 'zeal'), 'fa fa-frown-o' => __(' frown-o', 'zeal'), 'fa fa-futbol-o' => __(' futbol-o', 'zeal'), 'fa fa-gamepad' => __(' gamepad', 'zeal'), 'fa fa-gavel' => __(' gavel', 'zeal'), 'fa fa-gear' => __(' gear', 'zeal'), 'fa fa-gears' => __(' gears', 'zeal'), 'fa fa-gift' => __(' gift', 'zeal'), 'fa fa-glass' => __(' glass', 'zeal'), 'fa fa-globe' => __(' globe', 'zeal'), 'fa fa-graduation-cap' => __(' graduation-cap', 'zeal'), 'fa fa-group' => __(' group', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-hdd-o' => __(' hdd-o', 'zeal'), 'fa fa-headphones' => __(' headphones', 'zeal'), 'fa fa-heart' => __(' heart', 'zeal'), 'fa fa-heart-o' => __(' heart-o', 'zeal'), 'fa fa-heartbeat' => __(' heartbeat', 'zeal'), 'fa fa-history' => __(' history', 'zeal'), 'fa fa-home' => __(' home', 'zeal'), 'fa fa-hotel' => __(' hotel', 'zeal'), 'fa fa-hourglass' => __(' hourglass', 'zeal'), 'fa fa-hourglass-1' => __(' hourglass-1', 'zeal'), 'fa fa-hourglass-2' => __(' hourglass-2', 'zeal'), 'fa fa-hourglass-3' => __(' hourglass-3', 'zeal'), 'fa fa-hourglass-end' => __(' hourglass-end', 'zeal'), 'fa fa-hourglass-half' => __(' hourglass-half', 'zeal'), 'fa fa-hourglass-o' => __(' hourglass-o', 'zeal'), 'fa fa-hourglass-start' => __(' hourglass-start', 'zeal'), 'fa fa-i-cursor' => __(' i-cursor', 'zeal'), 'fa fa-image' => __(' image', 'zeal'), 'fa fa-inbox' => __(' inbox', 'zeal'), 'fa fa-industry' => __(' industry', 'zeal'), 'fa fa-info' => __(' info', 'zeal'), 'fa fa-info-circle' => __(' info-circle', 'zeal'), 'fa fa-institution' => __(' institution', 'zeal'), 'fa fa-key' => __(' key', 'zeal'), 'fa fa-keyboard-o' => __(' keyboard-o', 'zeal'), 'fa fa-language' => __(' language', 'zeal'), 'fa fa-laptop' => __(' laptop', 'zeal'), 'fa fa-leaf' => __(' leaf', 'zeal'), 'fa fa-legal' => __(' legal', 'zeal'), 'fa fa-lemon-o' => __(' lemon-o', 'zeal'), 'fa fa-level-down' => __(' level-down', 'zeal'), 'fa fa-level-up' => __(' level-up', 'zeal'), 'fa fa-life-bouy' => __(' life-bouy', 'zeal'), 'fa fa-life-buoy' => __(' life-buoy', 'zeal'), 'fa fa-life-ring' => __(' life-ring', 'zeal'), 'fa fa-life-saver' => __(' life-saver', 'zeal'), 'fa fa-lightbulb-o' => __(' lightbulb-o', 'zeal'), 'fa fa-line-chart' => __(' line-chart', 'zeal'), 'fa fa-location-arrow' => __(' location-arrow', 'zeal'), 'fa fa-lock' => __(' lock', 'zeal'), 'fa fa-magic' => __(' magic', 'zeal'), 'fa fa-magnet' => __(' magnet', 'zeal'), 'fa fa-mail-forward' => __(' mail-forward', 'zeal'), 'fa fa-mail-reply' => __(' mail-reply', 'zeal'), 'fa fa-mail-reply-all' => __(' mail-reply-all', 'zeal'), 'fa fa-male' => __(' male', 'zeal'), 'fa fa-map' => __(' map', 'zeal'), 'fa fa-map-marker' => __(' map-marker', 'zeal'), 'fa fa-map-o' => __(' map-o', 'zeal'), 'fa fa-map-pin' => __(' map-pin', 'zeal'), 'fa fa-map-signs' => __(' map-signs', 'zeal'), 'fa fa-meh-o' => __(' meh-o', 'zeal'), 'fa fa-microphone' => __(' microphone', 'zeal'), 'fa fa-microphone-slash' => __(' microphone-slash', 'zeal'), 'fa fa-minus' => __(' minus', 'zeal'), 'fa fa-minus-circle' => __(' minus-circle', 'zeal'), 'fa fa-minus-square' => __(' minus-square', 'zeal'), 'fa fa-minus-square-o' => __(' minus-square-o', 'zeal'), 'fa fa-mobile' => __(' mobile', 'zeal'), 'fa fa-mobile-phone' => __(' mobile-phone', 'zeal'), 'fa fa-money' => __(' money', 'zeal'), 'fa fa-moon-o' => __(' moon-o', 'zeal'), 'fa fa-mortar-board' => __(' mortar-board', 'zeal'), 'fa fa-motorcycle' => __(' motorcycle', 'zeal'), 'fa fa-mouse-pointer' => __(' mouse-pointer', 'zeal'), 'fa fa-music' => __(' music', 'zeal'), 'fa fa-navicon' => __(' navicon', 'zeal'), 'fa fa-newspaper-o' => __(' newspaper-o', 'zeal'), 'fa fa-object-group' => __(' object-group', 'zeal'), 'fa fa-object-ungroup' => __(' object-ungroup', 'zeal'), 'fa fa-paint-brush' => __(' paint-brush', 'zeal'), 'fa fa-paper-plane' => __(' paper-plane', 'zeal'), 'fa fa-paper-plane-o' => __(' paper-plane-o', 'zeal'), 'fa fa-paw' => __(' paw', 'zeal'), 'fa fa-pencil' => __(' pencil', 'zeal'), 'fa fa-pencil-square' => __(' pencil-square', 'zeal'), 'fa fa-pencil-square-o' => __(' pencil-square-o', 'zeal'), 'fa fa-phone' => __(' phone', 'zeal'), 'fa fa-phone-square' => __(' phone-square', 'zeal'), 'fa fa-photo' => __(' photo', 'zeal'), 'fa fa-picture-o' => __(' picture-o', 'zeal'), 'fa fa-pie-chart' => __(' pie-chart', 'zeal'), 'fa fa-plane' => __(' plane', 'zeal'), 'fa fa-plug' => __(' plug', 'zeal'), 'fa fa-plus' => __(' plus', 'zeal'), 'fa fa-plus-circle' => __(' plus-circle', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-plus-square-o' => __(' plus-square-o', 'zeal'), 'fa fa-power-off' => __(' power-off', 'zeal'), 'fa fa-print' => __(' print', 'zeal'), 'fa fa-puzzle-piece' => __(' puzzle-piece', 'zeal'), 'fa fa-qrcode' => __(' qrcode', 'zeal'), 'fa fa-question' => __(' question', 'zeal'), 'fa fa-question-circle' => __(' question-circle', 'zeal'), 'fa fa-quote-left' => __(' quote-left', 'zeal'), 'fa fa-quote-right' => __(' quote-right', 'zeal'), 'fa fa-random' => __(' random', 'zeal'), 'fa fa-recycle' => __(' recycle', 'zeal'), 'fa fa-refresh' => __(' refresh', 'zeal'), 'fa fa-registered' => __(' registered', 'zeal'), 'fa fa-remove' => __(' remove', 'zeal'), 'fa fa-reorder' => __(' reorder', 'zeal'), 'fa fa-reply' => __(' reply', 'zeal'), 'fa fa-reply-all' => __(' reply-all', 'zeal'), 'fa fa-retweet' => __(' retweet', 'zeal'), 'fa fa-road' => __(' road', 'zeal'), 'fa fa-rocket' => __(' rocket', 'zeal'), 'fa fa-rss' => __(' rss', 'zeal'), 'fa fa-rss-square' => __(' rss-square', 'zeal'), 'fa fa-search' => __(' search', 'zeal'), 'fa fa-search-minus' => __(' search-minus', 'zeal'), 'fa fa-search-plus' => __(' search-plus', 'zeal'), 'fa fa-send' => __(' send', 'zeal'), 'fa fa-send-o' => __(' send-o', 'zeal'), 'fa fa-server' => __(' server', 'zeal'), 'fa fa-share' => __(' share', 'zeal'), 'fa fa-share-alt' => __(' share-alt', 'zeal'), 'fa fa-share-alt-square' => __(' share-alt-square', 'zeal'), 'fa fa-share-square' => __(' share-square', 'zeal'), 'fa fa-share-square-o' => __(' share-square-o', 'zeal'), 'fa fa-shield' => __(' shield', 'zeal'), 'fa fa-ship' => __(' ship', 'zeal'), 'fa fa-shopping-cart' => __(' shopping-cart', 'zeal'), 'fa fa-sign-in' => __(' sign-in', 'zeal'), 'fa fa-sign-out' => __(' sign-out', 'zeal'), 'fa fa-signal' => __(' signal', 'zeal'), 'fa fa-sitemap' => __(' sitemap', 'zeal'), 'fa fa-sliders' => __(' sliders', 'zeal'), 'fa fa-smile-o' => __(' smile-o', 'zeal'), 'fa fa-soccer-ball-o' => __(' soccer-ball-o', 'zeal'), 'fa fa-sort' => __(' sort', 'zeal'), 'fa fa-sort-alpha-asc' => __(' sort-alpha-asc', 'zeal'), 'fa fa-sort-alpha-desc' => __(' sort-alpha-desc', 'zeal'), 'fa fa-sort-amount-asc' => __(' sort-amount-asc', 'zeal'), 'fa fa-sort-amount-desc' => __(' sort-amount-desc', 'zeal'), 'fa fa-sort-asc' => __(' sort-asc', 'zeal'), 'fa fa-sort-desc' => __(' sort-desc', 'zeal'), 'fa fa-sort-down' => __(' sort-down', 'zeal'), 'fa fa-sort-numeric-asc' => __(' sort-numeric-asc', 'zeal'), 'fa fa-sort-numeric-desc' => __(' sort-numeric-desc', 'zeal'), 'fa fa-sort-up' => __(' sort-up', 'zeal'), 'fa fa-space-shuttle' => __(' space-shuttle', 'zeal'), 'fa fa-spinner' => __(' spinner', 'zeal'), 'fa fa-spoon' => __(' spoon', 'zeal'), 'fa fa-square' => __(' square', 'zeal'), 'fa fa-square-o' => __(' square-o', 'zeal'), 'fa fa-star' => __(' star', 'zeal'), 'fa fa-star-half' => __(' star-half', 'zeal'), 'fa fa-star-half-empty' => __(' star-half-empty', 'zeal'), 'fa fa-star-half-full' => __(' star-half-full', 'zeal'), 'fa fa-star-half-o' => __(' star-half-o', 'zeal'), 'fa fa-star-o' => __(' star-o', 'zeal'), 'fa fa-sticky-note' => __(' sticky-note', 'zeal'), 'fa fa-sticky-note-o' => __(' sticky-note-o', 'zeal'), 'fa fa-street-view' => __(' street-view', 'zeal'), 'fa fa-suitcase' => __(' suitcase', 'zeal'), 'fa fa-sun-o' => __(' sun-o', 'zeal'), 'fa fa-support' => __(' support', 'zeal'), 'fa fa-tablet' => __(' tablet', 'zeal'), 'fa fa-tachometer' => __(' tachometer', 'zeal'), 'fa fa-tag' => __(' tag', 'zeal'), 'fa fa-tags' => __(' tags', 'zeal'), 'fa fa-tasks' => __(' tasks', 'zeal'), 'fa fa-taxi' => __(' taxi', 'zeal'), 'fa fa-television' => __(' television', 'zeal'), 'fa fa-terminal' => __(' terminal', 'zeal'), 'fa fa-thumb-tack' => __(' thumb-tack', 'zeal'), 'fa fa-thumbs-down' => __(' thumbs-down', 'zeal'), 'fa fa-thumbs-o-down' => __(' thumbs-o-down', 'zeal'), 'fa fa-thumbs-o-up' => __(' thumbs-o-up', 'zeal'), 'fa fa-thumbs-up' => __(' thumbs-up', 'zeal'), 'fa fa-ticket' => __(' ticket', 'zeal'), 'fa fa-times' => __(' times', 'zeal'), 'fa fa-times-circle' => __(' times-circle', 'zeal'), 'fa fa-times-circle-o' => __(' times-circle-o', 'zeal'), 'fa fa-tint' => __(' tint', 'zeal'), 'fa fa-toggle-down' => __(' toggle-down', 'zeal'), 'fa fa-toggle-left' => __(' toggle-left', 'zeal'), 'fa fa-toggle-off' => __(' toggle-off', 'zeal'), 'fa fa-toggle-on' => __(' toggle-on', 'zeal'), 'fa fa-toggle-right' => __(' toggle-right', 'zeal'), 'fa fa-toggle-up' => __(' toggle-up', 'zeal'), 'fa fa-trademark' => __(' trademark', 'zeal'), 'fa fa-trash' => __(' trash', 'zeal'), 'fa fa-trash-o' => __(' trash-o', 'zeal'), 'fa fa-tree' => __(' tree', 'zeal'), 'fa fa-trophy' => __(' trophy', 'zeal'), 'fa fa-truck' => __(' truck', 'zeal'), 'fa fa-tty' => __(' tty', 'zeal'), 'fa fa-tv' => __(' tv', 'zeal'), 'fa fa-umbrella' => __(' umbrella', 'zeal'), 'fa fa-university' => __(' university', 'zeal'), 'fa fa-unlock' => __(' unlock', 'zeal'), 'fa fa-unlock-alt' => __(' unlock-alt', 'zeal'), 'fa fa-unsorted' => __(' unsorted', 'zeal'), 'fa fa-upload' => __(' upload', 'zeal'), 'fa fa-user' => __(' user', 'zeal'), 'fa fa-user-plus' => __(' user-plus', 'zeal'), 'fa fa-user-secret' => __(' user-secret', 'zeal'), 'fa fa-user-times' => __(' user-times', 'zeal'), 'fa fa-users' => __(' users', 'zeal'), 'fa fa-video-camera' => __(' video-camera', 'zeal'), 'fa fa-volume-down' => __(' volume-down', 'zeal'), 'fa fa-volume-off' => __(' volume-off', 'zeal'), 'fa fa-volume-up' => __(' volume-up', 'zeal'), 'fa fa-warning' => __(' warning', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'), 'fa fa-wifi' => __(' wifi', 'zeal'), 'fa fa-wrench' => __(' wrench', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-o-down' => __(' hand-o-down', 'zeal'), 'fa fa-hand-o-left' => __(' hand-o-left', 'zeal'), 'fa fa-hand-o-right' => __(' hand-o-right', 'zeal'), 'fa fa-hand-o-up' => __(' hand-o-up', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-thumbs-down' => __(' thumbs-down', 'zeal'), 'fa fa-thumbs-o-down' => __(' thumbs-o-down', 'zeal'), 'fa fa-thumbs-o-up' => __(' thumbs-o-up', 'zeal'), 'fa fa-thumbs-up' => __(' thumbs-up', 'zeal'), 'fa fa-ambulance' => __(' ambulance', 'zeal'), 'fa fa-automobile' => __(' automobile', 'zeal'), 'fa fa-bicycle' => __(' bicycle', 'zeal'), 'fa fa-bus' => __(' bus', 'zeal'), 'fa fa-cab' => __(' cab', 'zeal'), 'fa fa-car' => __(' car', 'zeal'), 'fa fa-fighter-jet' => __(' fighter-jet', 'zeal'), 'fa fa-motorcycle' => __(' motorcycle', 'zeal'), 'fa fa-plane' => __(' plane', 'zeal'), 'fa fa-rocket' => __(' rocket', 'zeal'), 'fa fa-ship' => __(' ship', 'zeal'), 'fa fa-space-shuttle' => __(' space-shuttle', 'zeal'), 'fa fa-subway' => __(' subway', 'zeal'), 'fa fa-taxi' => __(' taxi', 'zeal'), 'fa fa-train' => __(' train', 'zeal'), 'fa fa-truck' => __(' truck', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'), 'fa fa-genderless' => __(' genderless', 'zeal'), 'fa fa-intersex' => __(' intersex', 'zeal'), 'fa fa-mars' => __(' mars', 'zeal'), 'fa fa-mars-double' => __(' mars-double', 'zeal'), 'fa fa-mars-stroke' => __(' mars-stroke', 'zeal'), 'fa fa-mars-stroke-h' => __(' mars-stroke-h', 'zeal'), 'fa fa-mars-stroke-v' => __(' mars-stroke-v', 'zeal'), 'fa fa-mercury' => __(' mercury', 'zeal'), 'fa fa-neuter' => __(' neuter', 'zeal'), 'fa fa-transgender' => __(' transgender', 'zeal'), 'fa fa-transgender-alt' => __(' transgender-alt', 'zeal'), 'fa fa-venus' => __(' venus', 'zeal'), 'fa fa-venus-double' => __(' venus-double', 'zeal'), 'fa fa-venus-mars' => __(' venus-mars', 'zeal'), 'fa fa-file' => __(' file', 'zeal'), 'fa fa-file-archive-o' => __(' file-archive-o', 'zeal'), 'fa fa-file-audio-o' => __(' file-audio-o', 'zeal'), 'fa fa-file-code-o' => __(' file-code-o', 'zeal'), 'fa fa-file-excel-o' => __(' file-excel-o', 'zeal'), 'fa fa-file-image-o' => __(' file-image-o', 'zeal'), 'fa fa-file-movie-o' => __(' file-movie-o', 'zeal'), 'fa fa-file-o' => __(' file-o', 'zeal'), 'fa fa-file-pdf-o' => __(' file-pdf-o', 'zeal'), 'fa fa-file-photo-o' => __(' file-photo-o', 'zeal'), 'fa fa-file-picture-o' => __(' file-picture-o', 'zeal'), 'fa fa-file-powerpoint-o' => __(' file-powerpoint-o', 'zeal'), 'fa fa-file-sound-o' => __(' file-sound-o', 'zeal'), 'fa fa-file-text' => __(' file-text', 'zeal'), 'fa fa-file-text-o' => __(' file-text-o', 'zeal'), 'fa fa-file-video-o' => __(' file-video-o', 'zeal'), 'fa fa-file-word-o' => __(' file-word-o', 'zeal'), 'fa fa-file-zip-o' => __(' file-zip-o', 'zeal'), 'fa fa-circle-o-notch' => __(' circle-o-notch', 'zeal'), 'fa fa-cog' => __(' cog', 'zeal'), 'fa fa-gear' => __(' gear', 'zeal'), 'fa fa-refresh' => __(' refresh', 'zeal'), 'fa fa-spinner' => __(' spinner', 'zeal'), 'fa fa-check-square' => __(' check-square', 'zeal'), 'fa fa-check-square-o' => __(' check-square-o', 'zeal'), 'fa fa-circle' => __(' circle', 'zeal'), 'fa fa-circle-o' => __(' circle-o', 'zeal'), 'fa fa-dot-circle-o' => __(' dot-circle-o', 'zeal'), 'fa fa-minus-square' => __(' minus-square', 'zeal'), 'fa fa-minus-square-o' => __(' minus-square-o', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-plus-square-o' => __(' plus-square-o', 'zeal'), 'fa fa-square' => __(' square', 'zeal'), 'fa fa-square-o' => __(' square-o', 'zeal'), 'fa fa-cc-amex' => __(' cc-amex', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-discover' => __(' cc-discover', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-cc-mastercard' => __(' cc-mastercard', 'zeal'), 'fa fa-cc-paypal' => __(' cc-paypal', 'zeal'), 'fa fa-cc-stripe' => __(' cc-stripe', 'zeal'), 'fa fa-cc-visa' => __(' cc-visa', 'zeal'), 'fa fa-credit-card' => __(' credit-card', 'zeal'), 'fa fa-google-wallet' => __(' google-wallet', 'zeal'), 'fa fa-paypal' => __(' paypal', 'zeal'), 'fa fa-area-chart' => __(' area-chart', 'zeal'), 'fa fa-bar-chart' => __(' bar-chart', 'zeal'), 'fa fa-bar-chart-o' => __(' bar-chart-o', 'zeal'), 'fa fa-line-chart' => __(' line-chart', 'zeal'), 'fa fa-pie-chart' => __(' pie-chart', 'zeal'), 'fa fa-bitcoin' => __(' bitcoin', 'zeal'), 'fa fa-btc' => __(' btc', 'zeal'), 'fa fa-cny' => __(' cny', 'zeal'), 'fa fa-dollar' => __(' dollar', 'zeal'), 'fa fa-eur' => __(' eur', 'zeal'), 'fa fa-euro' => __(' euro', 'zeal'), 'fa fa-gbp' => __(' gbp', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-ils' => __(' ils', 'zeal'), 'fa fa-inr' => __(' inr', 'zeal'), 'fa fa-jpy' => __(' jpy', 'zeal'), 'fa fa-krw' => __(' krw', 'zeal'), 'fa fa-money' => __(' money', 'zeal'), 'fa fa-rmb' => __(' rmb', 'zeal'), 'fa fa-rouble' => __(' rouble', 'zeal'), 'fa fa-rub' => __(' rub', 'zeal'), 'fa fa-ruble' => __(' ruble', 'zeal'), 'fa fa-rupee' => __(' rupee', 'zeal'), 'fa fa-shekel' => __(' shekel', 'zeal'), 'fa fa-sheqel' => __(' sheqel', 'zeal'), 'fa fa-try' => __(' try', 'zeal'), 'fa fa-turkish-lira' => __(' turkish-lira', 'zeal'), 'fa fa-usd' => __(' usd', 'zeal'), 'fa fa-won' => __(' won', 'zeal'), 'fa fa-yen' => __(' yen', 'zeal'), 'fa fa-align-center' => __(' align-center', 'zeal'), 'fa fa-align-justify' => __(' align-justify', 'zeal'), 'fa fa-align-left' => __(' align-left', 'zeal'), 'fa fa-align-right' => __(' align-right', 'zeal'), 'fa fa-bold' => __(' bold', 'zeal'), 'fa fa-chain' => __(' chain', 'zeal'), 'fa fa-chain-broken' => __(' chain-broken', 'zeal'), 'fa fa-clipboard' => __(' clipboard', 'zeal'), 'fa fa-columns' => __(' columns', 'zeal'), 'fa fa-copy' => __(' copy', 'zeal'), 'fa fa-cut' => __(' cut', 'zeal'), 'fa fa-dedent' => __(' dedent', 'zeal'), 'fa fa-eraser' => __(' eraser', 'zeal'), 'fa fa-file' => __(' file', 'zeal'), 'fa fa-file-o' => __(' file-o', 'zeal'), 'fa fa-file-text' => __(' file-text', 'zeal'), 'fa fa-file-text-o' => __(' file-text-o', 'zeal'), 'fa fa-files-o' => __(' files-o', 'zeal'), 'fa fa-floppy-o' => __(' floppy-o', 'zeal'), 'fa fa-font' => __(' font', 'zeal'), 'fa fa-header' => __(' header', 'zeal'), 'fa fa-indent' => __(' indent', 'zeal'), 'fa fa-italic' => __(' italic', 'zeal'), 'fa fa-link' => __(' link', 'zeal'), 'fa fa-list' => __(' list', 'zeal'), 'fa fa-list-alt' => __(' list-alt', 'zeal'), 'fa fa-list-ol' => __(' list-ol', 'zeal'), 'fa fa-list-ul' => __(' list-ul', 'zeal'), 'fa fa-outdent' => __(' outdent', 'zeal'), 'fa fa-paperclip' => __(' paperclip', 'zeal'), 'fa fa-paragraph' => __(' paragraph', 'zeal'), 'fa fa-paste' => __(' paste', 'zeal'), 'fa fa-repeat' => __(' repeat', 'zeal'), 'fa fa-rotate-left' => __(' rotate-left', 'zeal'), 'fa fa-rotate-right' => __(' rotate-right', 'zeal'), 'fa fa-save' => __(' save', 'zeal'), 'fa fa-scissors' => __(' scissors', 'zeal'), 'fa fa-strikethrough' => __(' strikethrough', 'zeal'), 'fa fa-subscript' => __(' subscript', 'zeal'), 'fa fa-superscript' => __(' superscript', 'zeal'), 'fa fa-table' => __(' table', 'zeal'), 'fa fa-text-height' => __(' text-height', 'zeal'), 'fa fa-text-width' => __(' text-width', 'zeal'), 'fa fa-th' => __(' th', 'zeal'), 'fa fa-th-large' => __(' th-large', 'zeal'), 'fa fa-th-list' => __(' th-list', 'zeal'), 'fa fa-underline' => __(' underline', 'zeal'), 'fa fa-undo' => __(' undo', 'zeal'), 'fa fa-unlink' => __(' unlink', 'zeal'), 'fa fa-angle-double-down' => __(' angle-double-down', 'zeal'), 'fa fa-angle-double-left' => __(' angle-double-left', 'zeal'), 'fa fa-angle-double-right' => __(' angle-double-right', 'zeal'), 'fa fa-angle-double-up' => __(' angle-double-up', 'zeal'), 'fa fa-angle-down' => __(' angle-down', 'zeal'), 'fa fa-angle-left' => __(' angle-left', 'zeal'), 'fa fa-angle-right' => __(' angle-right', 'zeal'), 'fa fa-angle-up' => __(' angle-up', 'zeal'), 'fa fa-arrow-circle-down' => __(' arrow-circle-down', 'zeal'), 'fa fa-arrow-circle-left' => __(' arrow-circle-left', 'zeal'), 'fa fa-arrow-circle-o-down' => __(' arrow-circle-o-down', 'zeal'), 'fa fa-arrow-circle-o-left' => __(' arrow-circle-o-left', 'zeal'), 'fa fa-arrow-circle-o-right' => __(' arrow-circle-o-right', 'zeal'), 'fa fa-arrow-circle-o-up' => __(' arrow-circle-o-up', 'zeal'), 'fa fa-arrow-circle-right' => __(' arrow-circle-right', 'zeal'), 'fa fa-arrow-circle-up' => __(' arrow-circle-up', 'zeal'), 'fa fa-arrow-down' => __(' arrow-down', 'zeal'), 'fa fa-arrow-left' => __(' arrow-left', 'zeal'), 'fa fa-arrow-right' => __(' arrow-right', 'zeal'), 'fa fa-arrow-up' => __(' arrow-up', 'zeal'), 'fa fa-arrows' => __(' arrows', 'zeal'), 'fa fa-arrows-alt' => __(' arrows-alt', 'zeal'), 'fa fa-arrows-h' => __(' arrows-h', 'zeal'), 'fa fa-arrows-v' => __(' arrows-v', 'zeal'), 'fa fa-caret-down' => __(' caret-down', 'zeal'), 'fa fa-caret-left' => __(' caret-left', 'zeal'), 'fa fa-caret-right' => __(' caret-right', 'zeal'), 'fa fa-caret-square-o-down' => __(' caret-square-o-down', 'zeal'), 'fa fa-caret-square-o-left' => __(' caret-square-o-left', 'zeal'), 'fa fa-caret-square-o-right' => __(' caret-square-o-right', 'zeal'), 'fa fa-caret-square-o-up' => __(' caret-square-o-up', 'zeal'), 'fa fa-caret-up' => __(' caret-up', 'zeal'), 'fa fa-chevron-circle-down' => __(' chevron-circle-down', 'zeal'), 'fa fa-chevron-circle-left' => __(' chevron-circle-left', 'zeal'), 'fa fa-chevron-circle-right' => __(' chevron-circle-right', 'zeal'), 'fa fa-chevron-circle-up' => __(' chevron-circle-up', 'zeal'), 'fa fa-chevron-down' => __(' chevron-down', 'zeal'), 'fa fa-chevron-left' => __(' chevron-left', 'zeal'), 'fa fa-chevron-right' => __(' chevron-right', 'zeal'), 'fa fa-chevron-up' => __(' chevron-up', 'zeal'), 'fa fa-exchange' => __(' exchange', 'zeal'), 'fa fa-hand-o-down' => __(' hand-o-down', 'zeal'), 'fa fa-hand-o-left' => __(' hand-o-left', 'zeal'), 'fa fa-hand-o-right' => __(' hand-o-right', 'zeal'), 'fa fa-hand-o-up' => __(' hand-o-up', 'zeal'), 'fa fa-long-arrow-down' => __(' long-arrow-down', 'zeal'), 'fa fa-long-arrow-left' => __(' long-arrow-left', 'zeal'), 'fa fa-long-arrow-right' => __(' long-arrow-right', 'zeal'), 'fa fa-long-arrow-up' => __(' long-arrow-up', 'zeal'), 'fa fa-toggle-down' => __(' toggle-down', 'zeal'), 'fa fa-toggle-left' => __(' toggle-left', 'zeal'), 'fa fa-toggle-right' => __(' toggle-right', 'zeal'), 'fa fa-toggle-up' => __(' toggle-up', 'zeal'), 'fa fa-arrows-alt' => __(' arrows-alt', 'zeal'), 'fa fa-backward' => __(' backward', 'zeal'), 'fa fa-compress' => __(' compress', 'zeal'), 'fa fa-eject' => __(' eject', 'zeal'), 'fa fa-expand' => __(' expand', 'zeal'), 'fa fa-fast-backward' => __(' fast-backward', 'zeal'), 'fa fa-fast-forward' => __(' fast-forward', 'zeal'), 'fa fa-forward' => __(' forward', 'zeal'), 'fa fa-pause' => __(' pause', 'zeal'), 'fa fa-play' => __(' play', 'zeal'), 'fa fa-play-circle' => __(' play-circle', 'zeal'), 'fa fa-play-circle-o' => __(' play-circle-o', 'zeal'), 'fa fa-random' => __(' random', 'zeal'), 'fa fa-step-backward' => __(' step-backward', 'zeal'), 'fa fa-step-forward' => __(' step-forward', 'zeal'), 'fa fa-stop' => __(' stop', 'zeal'), 'fa fa-youtube-play' => __(' youtube-play', 'zeal'), 'fa fa-500px' => __(' 500px', 'zeal'), 'fa fa-adn' => __(' adn', 'zeal'), 'fa fa-amazon' => __(' amazon', 'zeal'), 'fa fa-android' => __(' android', 'zeal'), 'fa fa-angellist' => __(' angellist', 'zeal'), 'fa fa-apple' => __(' apple', 'zeal'), 'fa fa-behance' => __(' behance', 'zeal'), 'fa fa-behance-square' => __(' behance-square', 'zeal'), 'fa fa-bitbucket' => __(' bitbucket', 'zeal'), 'fa fa-bitbucket-square' => __(' bitbucket-square', 'zeal'), 'fa fa-bitcoin' => __(' bitcoin', 'zeal'), 'fa fa-black-tie' => __(' black-tie', 'zeal'), 'fa fa-btc' => __(' btc', 'zeal'), 'fa fa-buysellads' => __(' buysellads', 'zeal'), 'fa fa-cc-amex' => __(' cc-amex', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-discover' => __(' cc-discover', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-cc-mastercard' => __(' cc-mastercard', 'zeal'), 'fa fa-cc-paypal' => __(' cc-paypal', 'zeal'), 'fa fa-cc-stripe' => __(' cc-stripe', 'zeal'), 'fa fa-cc-visa' => __(' cc-visa', 'zeal'), 'fa fa-chrome' => __(' chrome', 'zeal'), 'fa fa-codepen' => __(' codepen', 'zeal'), 'fa fa-connectdevelop' => __(' connectdevelop', 'zeal'), 'fa fa-contao' => __(' contao', 'zeal'), 'fa fa-css3' => __(' css3', 'zeal'), 'fa fa-dashcube' => __(' dashcube', 'zeal'), 'fa fa-delicious' => __(' delicious', 'zeal'), 'fa fa-deviantart' => __(' deviantart', 'zeal'), 'fa fa-digg' => __(' digg', 'zeal'), 'fa fa-dribbble' => __(' dribbble', 'zeal'), 'fa fa-dropbox' => __(' dropbox', 'zeal'), 'fa fa-drupal' => __(' drupal', 'zeal'), 'fa fa-empire' => __(' empire', 'zeal'), 'fa fa-expeditedssl' => __(' expeditedssl', 'zeal'), 'fa fa-facebook' => __(' facebook', 'zeal'), 'fa fa-facebook-f' => __(' facebook-f', 'zeal'), 'fa fa-facebook-official' => __(' facebook-official', 'zeal'), 'fa fa-facebook-square' => __(' facebook-square', 'zeal'), 'fa fa-firefox' => __(' firefox', 'zeal'), 'fa fa-flickr' => __(' flickr', 'zeal'), 'fa fa-fonticons' => __(' fonticons', 'zeal'), 'fa fa-forumbee' => __(' forumbee', 'zeal'), 'fa fa-foursquare' => __(' foursquare', 'zeal'), 'fa fa-ge' => __(' ge', 'zeal'), 'fa fa-get-pocket' => __(' get-pocket', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-git' => __(' git', 'zeal'), 'fa fa-git-square' => __(' git-square', 'zeal'), 'fa fa-github' => __(' github', 'zeal'), 'fa fa-github-alt' => __(' github-alt', 'zeal'), 'fa fa-github-square' => __(' github-square', 'zeal'), 'fa fa-gittip' => __(' gittip', 'zeal'), 'fa fa-google' => __(' google', 'zeal'), 'fa fa-google-plus' => __(' google-plus', 'zeal'), 'fa fa-google-plus-square' => __(' google-plus-square', 'zeal'), 'fa fa-google-wallet' => __(' google-wallet', 'zeal'), 'fa fa-gratipay' => __(' gratipay', 'zeal'), 'fa fa-hacker-news' => __(' hacker-news', 'zeal'), 'fa fa-houzz' => __(' houzz', 'zeal'), 'fa fa-html5' => __(' html5', 'zeal'), 'fa fa-instagram' => __(' instagram', 'zeal'), 'fa fa-internet-explorer' => __(' internet-explorer', 'zeal'), 'fa fa-ioxhost' => __(' ioxhost', 'zeal'), 'fa fa-joomla' => __(' joomla', 'zeal'), 'fa fa-jsfiddle' => __(' jsfiddle', 'zeal'), 'fa fa-lastfm' => __(' lastfm', 'zeal'), 'fa fa-lastfm-square' => __(' lastfm-square', 'zeal'), 'fa fa-leanpub' => __(' leanpub', 'zeal'), 'fa fa-linkedin' => __(' linkedin', 'zeal'), 'fa fa-linkedin-square' => __(' linkedin-square', 'zeal'), 'fa fa-linux' => __(' linux', 'zeal'), 'fa fa-maxcdn' => __(' maxcdn', 'zeal'), 'fa fa-meanpath' => __(' meanpath', 'zeal'), 'fa fa-medium' => __(' medium', 'zeal'), 'fa fa-odnoklassniki' => __(' odnoklassniki', 'zeal'), 'fa fa-odnoklassniki-square' => __(' odnoklassniki-square', 'zeal'), 'fa fa-opencart' => __(' opencart', 'zeal'), 'fa fa-openid' => __(' openid', 'zeal'), 'fa fa-opera' => __(' opera', 'zeal'), 'fa fa-optin-monster' => __(' optin-monster', 'zeal'), 'fa fa-pagelines' => __(' pagelines', 'zeal'), 'fa fa-paypal' => __(' paypal', 'zeal'), 'fa fa-pied-piper' => __(' pied-piper', 'zeal'), 'fa fa-pied-piper-alt' => __(' pied-piper-alt', 'zeal'), 'fa fa-pinterest' => __(' pinterest', 'zeal'), 'fa fa-pinterest-p' => __(' pinterest-p', 'zeal'), 'fa fa-pinterest-square' => __(' pinterest-square', 'zeal'), 'fa fa-qq' => __(' qq', 'zeal'), 'fa fa-ra' => __(' ra', 'zeal'), 'fa fa-rebel' => __(' rebel', 'zeal'), 'fa fa-reddit' => __(' reddit', 'zeal'), 'fa fa-reddit-square' => __(' reddit-square', 'zeal'), 'fa fa-renren' => __(' renren', 'zeal'), 'fa fa-safari' => __(' safari', 'zeal'), 'fa fa-sellsy' => __(' sellsy', 'zeal'), 'fa fa-share-alt' => __(' share-alt', 'zeal'), 'fa fa-share-alt-square' => __(' share-alt-square', 'zeal'), 'fa fa-shirtsinbulk' => __(' shirtsinbulk', 'zeal'), 'fa fa-simplybuilt' => __(' simplybuilt', 'zeal'), 'fa fa-skyatlas' => __(' skyatlas', 'zeal'), 'fa fa-skype' => __(' skype', 'zeal'), 'fa fa-slack' => __(' slack', 'zeal'), 'fa fa-slideshare' => __(' slideshare', 'zeal'), 'fa fa-soundcloud' => __(' soundcloud', 'zeal'), 'fa fa-spotify' => __(' spotify', 'zeal'), 'fa fa-stack-exchange' => __(' stack-exchange', 'zeal'), 'fa fa-stack-overflow' => __(' stack-overflow', 'zeal'), 'fa fa-steam' => __(' steam', 'zeal'), 'fa fa-steam-square' => __(' steam-square', 'zeal'), 'fa fa-stumbleupon' => __(' stumbleupon', 'zeal'), 'fa fa-stumbleupon-circle' => __(' stumbleupon-circle', 'zeal'), 'fa fa-tencent-weibo' => __(' tencent-weibo', 'zeal'), 'fa fa-trello' => __(' trello', 'zeal'), 'fa fa-tripadvisor' => __(' tripadvisor', 'zeal'), 'fa fa-tumblr' => __(' tumblr', 'zeal'), 'fa fa-tumblr-square' => __(' tumblr-square', 'zeal'), 'fa fa-twitch' => __(' twitch', 'zeal'), 'fa fa-twitter' => __(' twitter', 'zeal'), 'fa fa-twitter-square' => __(' twitter-square', 'zeal'), 'fa fa-viacoin' => __(' viacoin', 'zeal'), 'fa fa-vimeo' => __(' vimeo', 'zeal'), 'fa fa-vimeo-square' => __(' vimeo-square', 'zeal'), 'fa fa-vine' => __(' vine', 'zeal'), 'fa fa-vk' => __(' vk', 'zeal'), 'fa fa-wechat' => __(' wechat', 'zeal'), 'fa fa-weibo' => __(' weibo', 'zeal'), 'fa fa-weixin' => __(' weixin', 'zeal'), 'fa fa-whatsapp' => __(' whatsapp', 'zeal'), 'fa fa-wikipedia-w' => __(' wikipedia-w', 'zeal'), 'fa fa-windows' => __(' windows', 'zeal'), 'fa fa-wordpress' => __(' wordpress', 'zeal'), 'fa fa-xing' => __(' xing', 'zeal'), 'fa fa-xing-square' => __(' xing-square', 'zeal'), 'fa fa-y-combinator' => __(' y-combinator', 'zeal'), 'fa fa-y-combinator-square' => __(' y-combinator-square', 'zeal'), 'fa fa-yahoo' => __(' yahoo', 'zeal'), 'fa fa-yc' => __(' yc', 'zeal'), 'fa fa-yc-square' => __(' yc-square', 'zeal'), 'fa fa-yelp' => __(' yelp', 'zeal'), 'fa fa-youtube' => __(' youtube', 'zeal'), 'fa fa-youtube-play' => __(' youtube-play', 'zeal'), 'fa fa-youtube-square' => __(' youtube-square', 'zeal'), 'fa fa-ambulance' => __(' ambulance', 'zeal'), 'fa fa-h-square' => __(' h-square', 'zeal'), 'fa fa-heart' => __(' heart', 'zeal'), 'fa fa-heart-o' => __(' heart-o', 'zeal'), 'fa fa-heartbeat' => __(' heartbeat', 'zeal'), 'fa fa-hospital-o' => __(' hospital-o', 'zeal'), 'fa fa-medkit' => __(' medkit', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-stethoscope' => __(' stethoscope', 'zeal'), 'fa fa-user-md' => __(' user-md', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'));
}
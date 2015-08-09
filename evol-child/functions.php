<?php 

// Add child theme meta-boxes
require_once( get_stylesheet_directory() . '/meta-boxes-child.php' );

// Add scripts and styles
function evol_child_scripts() {

    wp_enqueue_style( 'evol-style', get_theme_root_uri() . '/evol/style.css' ); 
    wp_enqueue_style( 'custom-style', get_theme_root_uri() . '/evol-child/styles/css/main.css' ); 
    wp_enqueue_style( 'fancybox-style', get_theme_root_uri() . '/evol-child/fancybox/source/jquery.fancybox.css' ); 
    //wp_deregister_script('jquery');
    wp_enqueue_script('jquery-2', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null, true);
    //wp_dequeue_script('fancybox');
    //wp_enqueue_style( 'ticketbook', get_theme_root_uri() . '/evol-child/stylesheets/fonts/ticketbook/stylesheet.css' ); 
    wp_enqueue_script( 'fancybox-2', get_theme_root_uri() . '/evol-child/fancybox/source/jquery.fancybox.pack.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'cowboy-custom-js', get_theme_root_uri() . '/evol-child/custom-scripts.js', array('jquery'), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'evol_child_scripts', 11 );

// Remove icon support
function remove_icons() {
    wp_dequeue_style( 'icons' );
}
add_action( 'wp_enqueue_scripts', 'remove_icons' );

// Add portfolio post type legacy from Evol v 1
function tr_portfolio() {
    $labels = array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio Item',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Portfolio Item',
        'edit_item' => 'Edit Portfolio Item',
        'new_item' => 'New Portfolio Items',
        'view_item' => 'View Portfolio Item',
        'search_items' => 'Search Portfolio Items',
        'not_found' =>  'No Portfolio Items found',
        'not_found_in_trash' => 'No Portfolio Items found in Trash', 
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 4,
        'rewrite' => array( 'slug' => 'portfolio-item' ),
        'supports' => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type( 'portfolio', $args );
    
    register_taxonomy(
        "portfolio-category", array( "portfolio" ), array(
            "hierarchical" => true,
            "label" => "Portfolio Categories",
            "singular_label" => "Portfolio Categories",
            "rewrite" => true,
            "query_var" => true
        )
    );
}
add_action( 'init', 'tr_portfolio' );


// Register a custom post type but don't do anything fancy

register_post_type( 'team', array( 'label' => 'Team', 'public' => true, 'capability_type' => 'post',  'hierarchical' => true, 'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes') ) );

register_post_type( 'directors', array( 'label' => 'Directors', 'public' => true, 'capability_type' => 'post',  'hierarchical' => true, 'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes') ) );

register_post_type( 'hidden', array( 'label' => 'Hidden Projects', 'public' => true, 'capability_type' => 'post',  'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail' ) ) );

register_post_type( 'old', array( 'label' => 'Unused Pages', 'public' => true, 'capability_type' => 'post',  'hierarchical' => true, 'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes') ) );

// Remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


// Admin area favicons
function show_favicon() {
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$uri = get_theme_root_uri();
    if (strpos($url,'staging') !== false) {
        echo '<link href="'. $uri .'/evol-child/images/favicon_staging.png" rel="icon" type="image/png">';
    } 
    elseif (strpos($url,'dev') !== false) {
        echo '<link href="'. $uri .'/evol-child/images/favicon_local.png" rel="icon" type="image/png">';
    } 
    else {
        echo '<link href="'. $uri .'/evol-child/images/favicon_live.png" rel="icon" type="image/png">';
    }
}
add_action('admin_head', 'show_favicon');

// Auto update plugins
add_filter('auto_update_plugin', '__return_true');

// Don't update WP with nightly builds
add_filter( 'allow_dev_auto_core_updates', '__return_false' );

// Add ACF options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

// Post thumbnail caption
function get_post_thumbnail_caption() {
    if ( $thumb = get_post_thumbnail_id() )
        return get_post( $thumb )->post_excerpt;
}

// Remove trailing slash 
function permalink_untrailingslashit($link) {
    return untrailingslashit($link);
}
add_filter('page_link', 'permalink_untrailingslashit');
add_filter('post_type_link', 'permalink_untrailingslashit');
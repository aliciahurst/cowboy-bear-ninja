<?php function evol_child_scripts() {

    //wp_dequeue_style( 'magnific' );

    //wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Open+Sans:400,700,600');
    //wp_enqueue_style( 'googleFonts');

    wp_enqueue_style( 'evol-style', get_theme_root_uri() . '/evol/style.css' ); 

    //wp_register_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' );
    //wp_enqueue_style( 'prefix-font-awesome');

    //wp_enqueue_style( 'ticketbook', get_theme_root_uri() . '/evol-child/stylesheets/fonts/ticketbook/stylesheet.css' ); 

	//wp_enqueue_style( 'custom-style', get_theme_root_uri() . '/evol-child/stylesheets/css/style.css' ); 

    //wp_dequeue_style( 'style' );

   //wp_dequeue_style( 'magnific' );

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
register_post_type( 'hidden', array( 'label' => 'Hidden Pages', 'public' => true, 'capability_type' => 'post',  'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail' ) ) );


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

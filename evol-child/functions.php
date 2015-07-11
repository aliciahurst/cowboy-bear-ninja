<?php


function evol_child_scripts() {

    wp_dequeue_style( 'magnific' );

    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Open+Sans:400,700,600');
    wp_enqueue_style( 'googleFonts');

    wp_enqueue_style( 'evol-style', get_theme_root_uri() . '/evol/style.css' ); 

    wp_register_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' );
    wp_enqueue_style( 'prefix-font-awesome');

    wp_enqueue_style( 'ticketbook', get_theme_root_uri() . '/evol-child/stylesheets/fonts/ticketbook/stylesheet.css' ); 

	wp_enqueue_style( 'custom-style', get_theme_root_uri() . '/evol-child/stylesheets/css/style.css' ); 

    wp_dequeue_style( 'style' );

   wp_dequeue_style( 'magnific' );

    wp_enqueue_style( 'search-bar', get_site_url() . '/wp-content/plugins/shortcodes-ultimate/assets/css/box-shortcodes.css' );
    wp_enqueue_script( 'search-bar', get_site_url() . '/wp-content/plugins/shortcodes-ultimate/assets/js/other-shortcodes.js?ver=4.7.2' );
 
}
add_action( 'wp_enqueue_scripts', 'evol_child_scripts', 11 );



function wpdocs_dequeue_script() {

   wp_dequeue_script( 'magnific' );
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );


function remove_search_filter () {
    remove_filter( 'pre_get_posts', 'tr_search_filter' );
}
add_action( 'init', 'remove_search_filter');

function remove_icons() {
    wp_dequeue_style( 'icons' );
}

add_action( 'wp_enqueue_scripts', 'remove_icons' );

function tr_widgets_init_2() {
	
	if ( ot_get_option( 'tr_sidebars' ) ) :
		$tr_sidebars = ot_get_option( 'tr_sidebars' );
		foreach ( $tr_sidebars as $tr_sidebar ) {
			register_sidebar( array(
				'id' => $tr_sidebar["id"],
				'name' => $tr_sidebar["title"],
				'before_widget' => '<div class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h6 class="widget-title">',
				'after_title' => '</h6>',
			));
		}
	endif;
};
add_action( 'widgets_init', 'tr_widgets_init_2' );


function fb_add_search_box ( $items, $args ) {
    
    // only on primary menu
    if( 'primary' === $args -> theme_location )
        $items .= '<li class="menu-item menu-item-search">' . get_search_form( FALSE ) . '</li>';
    
    return $items;
}
add_filter( 'wp_nav_menu_items', 'fb_add_search_box', 10, 2 );

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => 'Image Text', 
            'block' => 'p',  
            'classes' => 'image-text',     
        ),  
        array(  
            'title' => 'Image Text no Overlay', 
            'block' => 'p',  
            'classes' => 'image-text-2',     
        ),  
        array(  
             'title' => 'w/ gray background', 
            'inline' => 'span',  
            'exact' => true,    
             'classes' => 'gray-background', 
        ),  
        array(  
             'title' => 'w/ white background', 
            'inline' => 'span',  
            'exact' => true,    
             'classes' => 'white-background', 
        ),  
        array(  
            'title' => 'Image Text no Indent', 
            'block' => 'p',  
            'classes' => 'image-text-3',     
        ), 
        array(  
             'title' => 'Button', 
            'inline' => 'a',  
            'exact' => true,    
             'classes' => 'button small', 
        ),  
        array(  
            'title' => 'Blog Image Caption', 
            'block' => 'p',  
            'classes' => 'caption',     
        ), 
        array(  
             'title' => 'Signature', 
            'inline' => 'span',  
            'exact' => true,    
             'classes' => 'sign', 
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/**
 * Register a custom post type but don't do anything fancy
 */
register_post_type( 'hidden', array( 'label' => 'Hidden Pages', 'public' => true, 'capability_type' => 'post',  'show_ui' => true, 'query_var' => true, 'supports' => array( 'title', 'editor', 'thumbnail' ) ) );
/**
 * Remove the slug from published post permalinks. Only affect our CPT though.
 */

// remove wp version param from any enqueued scripts
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

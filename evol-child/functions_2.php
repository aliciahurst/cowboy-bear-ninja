<?php

function evol_child_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/stylesheets/css/style.css' ); 

}
add_action( 'wp_enqueue_scripts', 'evol_child_scripts' );

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


 add_filter('post_type_link','custom_post_type_link', 10, 3); 
    function custom_post_type_link($permalink, $post, $leavename) { 

        $url_components = parse_url($permalink); 
        $post_path = $url_components['path']; 
        $post_name = end(explode('/', trim($post_path, '/'))); 

        if(!empty($post_name)) { 
            switch($post->post_type) { 
                case 'portfolio': 
                    $permalink = str_replace($post_path, '/' . $post_name . '/', $permalink); 
                break; 
            } 
        } 
        return $permalink; 
    } 

    function custom_pre_get_posts($query) { 
        global $wpdb; 

        if(!$query->is_main_query()) { 
            return; 
        } 

        $post_name = $query->get('name'); 
        $post_type = $wpdb->get_var( $wpdb->prepare( 'SELECT post_type FROM ' . $wpdb->posts . ' WHERE post_name = %s LIMIT 1', $post_name ) ); 

        switch($post_type) { 
            case 'portfolio': 
                $query->set('portfolio', $post_name); 
                $query->set('post_type', $post_type); 
                $query->is_single = true; 
                $query->is_page = false; 
            break; 
        } 

        return $query; 
     } 


     add_action('pre_get_posts','custom_pre_get_posts');

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
            'title' => 'Image Text no Overlay or Indent', 
            'block' => 'p',  
            'classes' => 'image-text-2',     
        ), 
        array(  
             'title' => '-- w/ gray background', 
            'inline' => 'span',  
            'exact' => true,    
             'classes' => 'gray-background', 
        ),  
         array(  
             'title' => '-- w/ white background', 
            'inline' => 'span',  
            'exact' => true,    
             'classes' => 'white-background', 
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
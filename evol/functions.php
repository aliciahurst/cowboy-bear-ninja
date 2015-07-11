<?php

/*----------------------------------------------------------------------------*/
/*	Sets up theme defaults and registers support for various WordPress features.
/*----------------------------------------------------------------------------*/

function tr_theme_setup() {
	load_theme_textdomain( 'themerain', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	register_nav_menu( 'primary', 'Navigation Menu' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'portfolio', 740, 540, true );
}
add_action( 'after_setup_theme', 'tr_theme_setup' );

/*----------------------------------------------------------------------------*/
/*	Sets up the content width value based on the theme's design and stylesheet.
/*----------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 780;

/*----------------------------------------------------------------------------*/
/*	Load Theme Options
/*----------------------------------------------------------------------------*/

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );
load_template( trailingslashit( get_template_directory() ) . 'includes/meta-boxes.php' );
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );

/*----------------------------------------------------------------------------*/
/*	Register Sidebars
/*----------------------------------------------------------------------------*/

function tr_widgets_init() {
	register_sidebar( array(
		'id' => 'sidebar',
		'name' => 'Default Sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	
	register_sidebar( array(
		'id' => 'footer-sidebar',
		'name' => 'Footer Sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	
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
add_action( 'widgets_init', 'tr_widgets_init' );

/*----------------------------------------------------------------------------*/
/*	Register and load CSS & jQuery
/*----------------------------------------------------------------------------*/

function tr_enqueue_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'icons', get_template_directory_uri() . '/assets/css/icons.css' );
	wp_enqueue_style( 'magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/jquery.custom.js', 'jquery' );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.min.js', 'jquery' );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', 'jquery' );
	wp_enqueue_script( 'magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', 'jquery' );
	wp_enqueue_script( 'validation', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', 'jquery' );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'tr_enqueue_scripts' );

/*----------------------------------------------------------------------------*/
/*	Load Widgets
/*----------------------------------------------------------------------------*/

include( "includes/widget-recent-projects.php" );

/*----------------------------------------------------------------------------*/
/*	Configure Pagination
/*----------------------------------------------------------------------------*/

function tr_pagination() {
	global $wp_query, $wp_rewrite;
	$pages = '';
	$total = 1;
	$max = $wp_query->max_num_pages;
	if ( ! $current = get_query_var( 'paged' ) ) $current = 1;
	$args['base'] = str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) );
	$args['total'] = $max;
	$args['current'] = $current;
	$args['end_size'] = 1;
	$args['mid_size'] = 3;
	$args['prev_text'] = '<i class="fa-angle-left"></i> Previous';
	$args['next_text'] = 'Next <i class="fa-angle-right"></i>';
	$args['type'] = 'list';
	if ( $max > 1 ) echo '<div id="pagination">';
	if ( $total == 1 && $max > 1 );
	echo $pages . paginate_links( $args );
	if ( $max > 1 ) echo '</div>';
}

/*----------------------------------------------------------------------------*/
/*	Configure Excerpt
/*----------------------------------------------------------------------------*/

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/*	Configure Tag Cloud
/*-----------------------------------------------------------------------------------*/

function tag_cloud_filter($args = array()) {
   $args['smallest'] = 12;
   $args['largest'] = 12;
   $args['unit'] = 'px';
   return $args;
}
add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);

/*----------------------------------------------------------------------------*/
/*	Exclude Pages from Search
/*----------------------------------------------------------------------------*/

function tr_search_filter( $filter ) {
	if ( $filter->is_search ) {
		$filter->set( 'post_type', 'post' );
	}
	return $filter;
}
add_filter( 'pre_get_posts', 'tr_search_filter' );

/*----------------------------------------------------------------------------*/
/*	Add Portfolio Post Types
/*----------------------------------------------------------------------------*/

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

/*----------------------------------------------------------------------------*/
/*	Add Gallery Post Types
/*----------------------------------------------------------------------------*/

function tr_gallery() {
	$labels = array(
		'name' => 'Gallery',
		'singular_name' => 'Gallery Item',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Gallery Item',
		'edit_item' => 'Edit Gallery Item',
		'new_item' => 'New Gallery Items',
		'view_item' => 'View Gallery Item',
		'search_items' => 'Search Gallery Items',
		'not_found' =>  'No Gallery Items found',
		'not_found_in_trash' => 'No Gallery Items found in Trash', 
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
		'rewrite' => array( 'slug' => 'gallery-item' ),
		'supports' => array( 'title', 'thumbnail' )
	);
	register_post_type( 'gallery', $args );
	
	register_taxonomy(
		"gallery-category", array( "gallery" ), array(
			"hierarchical" => true,
			"label" => "Gallery Categories",
			"singular_label" => "Gallery Categories",
			"rewrite" => true,
			"query_var" => true
		)
	);
}
add_action( 'init', 'tr_gallery' );

/*----------------------------------------------------------------------------*/
/*	Add a Custom Taxonomy to the Post Class
/*----------------------------------------------------------------------------*/

function custom_portfolio_post_class( $classes, $class, $ID ) {
	$taxonomy = 'portfolio-category';
	$terms = get_the_terms( (int) $ID, $taxonomy );
	if ( ! empty( $terms ) ) {
		foreach ( (array) $terms as $order => $term ) {
			if ( ! in_array( $term->slug, $classes ) ) {
				$classes[] = $term->slug;
			}
		}
	}
	return $classes;
}
add_filter( 'post_class', 'custom_portfolio_post_class', 10, 3 );

function custom_gallery_post_class( $classes, $class, $ID ) {
	$taxonomy = 'gallery-category';
	$terms = get_the_terms( (int) $ID, $taxonomy );
	if ( ! empty( $terms ) ) {
		foreach ( (array) $terms as $order => $term ) {
			if ( ! in_array( $term->slug, $classes ) ) {
				$classes[] = $term->slug;
			}
		}
	}
	return $classes;
}
add_filter( 'post_class', 'custom_gallery_post_class', 10, 3 );

/*----------------------------------------------------------------------------*/
/*	Register the Required Plugins
/*----------------------------------------------------------------------------*/

require_once dirname( __FILE__ ) . '/includes/plugin-activation.php';

function tr_register_required_plugins() {
	
	$plugins = array(
		array(
			'name'     				=> 'Rain Shortcodes',
			'slug'     				=> 'rain-shortcodes',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/rain-shortcodes.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		)
	);
	
	$theme_text_domain = 'tgmpa';
	
	$config = array(
		'domain'       		=> $theme_text_domain,
		'default_path' 		=> '',
		'parent_menu_slug' 	=> 'themes.php',
		'parent_url_slug' 	=> 'themes.php',
		'menu'         		=> 'install-required-plugins',
		'has_notices'      	=> true,
		'is_automatic'    	=> true,
		'message' 			=> '',
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
			'nag_type'									=> 'updated'
		)
	);
	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'tr_register_required_plugins' );

?>
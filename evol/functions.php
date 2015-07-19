<?php

/**
 * -----------------------------------------------------------------------------
 * Set up theme defaults and registers support for various WordPress features
 * -----------------------------------------------------------------------------
 */

function rainy_theme_setup() {
	load_theme_textdomain( 'themerain', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	register_nav_menu( 'menu-header', 'Header menu' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'project', 370, 270, true );
}
add_action( 'after_setup_theme', 'rainy_theme_setup' );

/**
 * -----------------------------------------------------------------------------
 * Set up the content width value
 * -----------------------------------------------------------------------------
 */

if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * -----------------------------------------------------------------------------
 * Add customizer
 * -----------------------------------------------------------------------------
 */

require get_template_directory() . '/includes/customizer.php';

/**
 * -----------------------------------------------------------------------------
 * Add meta boxes
 * -----------------------------------------------------------------------------
 */

require get_template_directory() . '/includes/meta-boxes.php';

/**
 * -----------------------------------------------------------------------------
 * Add plugins
 * -----------------------------------------------------------------------------
 */

require get_template_directory() . '/includes/plugins/plugin-registration.php';

/**
 * -----------------------------------------------------------------------------
 * Add recent projects widget
 * -----------------------------------------------------------------------------
 */

require get_template_directory() . '/includes/widget-recent-projects.php';

/**
 * -----------------------------------------------------------------------------
 * Register sidebars
 * -----------------------------------------------------------------------------
 */

function rainy_sidebars() {
	register_sidebar( array(
		'name' 			=> 'Default sidebar',
		'id' 			=> 'sidebar-1',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title">',
		'after_title'	=> '</h6>',
	) );

	register_sidebar( array(
		'name' 			=> 'Footer sidebar',
		'id' 			=> 'sidebar-2',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title">',
		'after_title'	=> '</h6>',
	) );
};
add_action( 'widgets_init', 'rainy_sidebars' );

/**
 * -----------------------------------------------------------------------------
 * Enqueue styles and scripts for the front end
 * -----------------------------------------------------------------------------
 */

function rainy_styles_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/includes/font-awesome/font-awesome.css' );
	wp_enqueue_script( 'jquery' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_page_template( 'template-contact.php' ) ) {
		wp_enqueue_script( 'validation', get_template_directory_uri() . '/assets/js/validation.js', array( 'jquery' ), false, true );
	}
	if ( is_page_template( 'template-portfolio.php' ) || is_tax( 'project-category' ) ) {
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.js', array( 'jquery' ), false, true );
	}
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'rainy_styles_scripts' );

/**
 * -----------------------------------------------------------------------------
 * Page header
 * -----------------------------------------------------------------------------
 */

function rainy_page_header() {
	$title = '';
	$subtitle = '';
	$img = '';
	$button_text = '';
	$button_url = '';

	if ( is_front_page() && is_home() ) {
		$title = get_theme_mod( 'rainy_default_blog_title', 'Blog' );
		$subtitle = get_theme_mod( 'rainy_default_blog_subtitle', 'Blog subtitle' );
		$img = get_theme_mod( 'rainy_default_blog_header_image' );
	} elseif ( is_singular( 'post' ) ) {
		$title = get_the_title();
		$subtitle = get_the_date() . ' &bull; ' . get_the_category_list( ', ' );
		$img = get_post_meta( get_the_ID(), 'rainy_header_image', true );
		$button_text = get_post_meta( get_the_ID(), 'rainy_button_text', true );
		$button_url = get_post_meta( get_the_ID(), 'rainy_button_url', true );
	} elseif ( is_home() ) {
		$blog = get_post( get_option( 'page_for_posts' ) );
		$title = $blog->post_title;
		$subtitle = get_post_meta( $blog->ID, 'rainy_subtitle', true );
		$img = get_post_meta( $blog->ID, 'rainy_header_image', true );
		$button_text = get_post_meta( $blog->ID, 'rainy_button_text', true );
		$button_url = get_post_meta( $blog->ID, 'rainy_button_url', true );
	} elseif ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = $term->name;
		$subtitle = category_description();
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false );
		$subtitle = category_description();
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
		$subtitle = tag_description();
	} elseif ( is_day() ) {
		$title = get_the_date();
		$subtitle = __( 'Daily archives', 'themerain' );
	} elseif ( is_month() ) {
		$title = get_the_date( 'F Y' );
		$subtitle = __( 'Monthly archives', 'themerain' );
	} elseif ( is_year() ) {
		$title = get_the_date( 'Y' );
		$subtitle = __( 'Yearly archives', 'themerain' );
	} elseif ( is_author() ) {
		$title = get_the_author();
		$subtitle = __( 'Author archives', 'themerain' );
	} elseif ( is_search() ) {
		$title = __( 'Search results for: ', 'themerain' ) . get_search_query();
	} elseif ( is_404() ) {
		$title = __( 'Error 404', 'themerain' );
		$subtitle = __( 'Page not found', 'themerain' );
	} else {
		$title = get_the_title();
		$subtitle = get_post_meta( get_the_ID(), 'rainy_subtitle', true );
		$img = get_post_meta( get_the_ID(), 'rainy_header_image', true );
		$button_text = get_post_meta( get_the_ID(), 'rainy_button_text', true );
		$button_url = get_post_meta( get_the_ID(), 'rainy_button_url', true );
	}

	echo '<div class="page-header">';
		echo '<h1 class="page-title">' . $title . '</h1>';

		if ( $subtitle ) {
			echo '<div class="page-subtitle">' . $subtitle . '</div>';
		}

		if ( $button_text ) {
			echo '<br/><a class="button" href="' . $button_url . '">' . esc_attr( $button_text ) . '</a>';
		}

		echo '<div class="page-header-bg">';
			echo '<div class="page-header-color">';
				if ( $img ) {
					echo '<img src="' . $img . '" />';
				} else {
					echo '<img src="' . get_theme_mod( 'rainy_default_header_image' ) . '" />';
				}
			echo '<div>';
		echo '</div>';
	echo '</div>';
}

/**
 * -----------------------------------------------------------------------------
 * Post meta
 * -----------------------------------------------------------------------------
 */

function rainy_post_meta() {
	echo '<div class="post-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="post-sticky">' . __( 'Sticky', 'themerain' ) . '</span>';
		}

		printf( '<span class="post-date"><a href="%1$s" rel="bookmark"><time datetime="%2$s">%3$s</time></a></span>', esc_url( get_permalink() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="post-comments">'; comments_popup_link(); echo '</span>';
		}

		echo '<span class="post-categories">' . get_the_category_list( ', ' ) . '</span>';
	echo '</div>';
}

/**
 * -----------------------------------------------------------------------------
 * Page navigation
 * -----------------------------------------------------------------------------
 */

function rainy_page_nav() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'themerain' ),
		'next_text' => __( 'Next &rarr;', 'themerain' ),
	) );

	if ( $links ) {
		echo '<nav class="page-navigation" role="navigation">';
			echo $links;
		echo '</nav>';
	}
}

/**
 * -----------------------------------------------------------------------------
 * Post navigation
 * -----------------------------------------------------------------------------
 */

function rainy_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $previous && ! $next ) {
		return;
	}

	echo '<nav class="post-navigation" role="navigation">';
		if ( is_attachment() ) {
			previous_post_link( '%link', __( '<span class="nav-meta">Published In</span>%title', 'themerain' ) );
		} else {
			previous_post_link( '%link', __( '<span class="nav-meta">Previous Post</span>%title', 'themerain' ) );
			next_post_link( '%link', __( '<span class="nav-meta">Next Post</span>%title', 'themerain' ) );
		}
	echo '</nav>';
}

/**
 * -----------------------------------------------------------------------------
 * Project navigation
 * -----------------------------------------------------------------------------
 */

function rainy_project_nav() {
	echo '<nav class="project-navigation" role="navigation">';
		echo '<span class="project-navigation-left">';
			if ( get_adjacent_post( false, '', true ) ) {
				previous_post_link( '%link', __( '&larr; Prev Project', 'themerain' ) );
			} else {
				echo __( '&larr; Prev Project', 'themerain' );
			};
		echo '</span>';

		echo '<span class="project-navigation-right">';
			if ( get_adjacent_post( false, '', false ) ) {
				next_post_link( '%link', __( 'Next Project &rarr;', 'themerain' ) );
			} else {
				echo __( 'Next Project &rarr;', 'themerain' );
			};
		echo '</span>';
	echo '</nav>';
}

/**
 * -----------------------------------------------------------------------------
 * Filter
 * -----------------------------------------------------------------------------
 */

function rainy_filter() {
	$terms = get_terms( 'project-category' );

	if ( $terms ) {
		echo '<div id="filter" class="filter-area">';
			echo '<span><a href="#" class="active" value="*">' . __( 'All', 'themerain' ) . '</a></span>';
			foreach ( $terms as $term ) {
				echo '<span><a href="#" value=".' . $term->slug . '">' . $term->name . '</a></span>';
			}
		echo '</div>';
	}
}

/**
 * -----------------------------------------------------------------------------
 * Create a nicely formatted and more specific wp_title
 * -----------------------------------------------------------------------------
 */

function rainy_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'themerain' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'rainy_wp_title', 10, 2 );

/**
 * -----------------------------------------------------------------------------
 * Change default excerpt
 * -----------------------------------------------------------------------------
 */

function rainy_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'rainy_excerpt_more' );

/**
 * -----------------------------------------------------------------------------
 * Add placeholders to comments form fields
 * -----------------------------------------------------------------------------
 */

function rainy_comment_fields_placeholders( $fields ) {
	$req = get_option( 'require_name_email' );

    $fields['author'] = str_replace( 'name="author"', 'placeholder="' . __( 'Name', 'themerain' ) . ( $req ? ' *' : '' ) . '" name="author"', $fields['author'] );
    $fields['email'] = str_replace( 'name="email"', 'placeholder="' . __( 'Email', 'themerain' ) . ( $req ? ' *' : '' ) . '" name="email"', $fields['email'] );
    $fields['url'] = str_replace( 'name="url"', 'placeholder="' . __( 'Website', 'themerain' ) . '" name="url"', $fields['url'] );

    return $fields;
}
add_filter( 'comment_form_default_fields', 'rainy_comment_fields_placeholders' );

function rainy_comment_textarea_placeholder( $fields ) {
	$fields['comment_field'] = str_replace( 'name="comment"', 'placeholder="' . __( 'Comment', 'themerain' ) . '" name="comment"', $fields['comment_field'] );

	return $fields;
}
add_filter( 'comment_form_defaults', 'rainy_comment_textarea_placeholder' );

/**
 * -----------------------------------------------------------------------------
 * Exclude pages from search
 * -----------------------------------------------------------------------------
 */

function rainy_search_filter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}

	return $query;
}
add_filter( 'pre_get_posts', 'rainy_search_filter' );

/**
 * -----------------------------------------------------------------------------
 * Extend the default post classes
 * -----------------------------------------------------------------------------
 */

function rainy_post_classes( $classes, $class, $ID ) {
	if ( is_page_template( 'template-portfolio.php' ) ) {
		$taxonomy = 'project-category';
		$terms = get_the_terms( ( int ) $ID, $taxonomy );

		if ( $terms ) {
			foreach ( ( array ) $terms as $order => $term ) {
				if ( ! in_array( $term->slug, $classes ) ) {
					$classes[] = $term->slug;
				}
			}
		}
	}

	if ( get_the_content() ) {
		$classes[] = 'has-post-content';
	}

	return $classes;
}
add_filter( 'post_class', 'rainy_post_classes', 10, 3 );

/**
 * -----------------------------------------------------------------------------
 * Modified gallery shortcode
 * -----------------------------------------------------------------------------
 */

function rainy_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
		'size' => 'full',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'rainy_gallery_atts', 10, 3 );

/**
 * -----------------------------------------------------------------------------
 * Add caption to attachment
 * -----------------------------------------------------------------------------
 */

function rainy_add_caption_to_attachment( $markup, $id ) {
	$att = get_post( $id );
	return str_replace( '<a ', '<a title="' . $att->post_excerpt . '" ', $markup );
}
add_filter( 'wp_get_attachment_link', 'rainy_add_caption_to_attachment', 10, 5 );
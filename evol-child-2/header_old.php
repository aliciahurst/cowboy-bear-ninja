<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />	
	<title><?php wp_title( ' - ', 'true', 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="mobile-menu">
		<div class="inner">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mob-menu' ) ); ?>
		</div>
	</div>
	<header id="header" role="banner">
		<div class="inner">
			<div id="logo">
				<?php $tr_logo = ot_get_option( 'tr_logo' ); if ( ! empty( $tr_logo ) ) { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $tr_logo; ?>" /> <span class="cbn">Cowboy Bear Ninja</span></a>
				<?php } else { ?>
					<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php } ?>
			</div>
			
			<nav id="nav" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>
			
			<i class="mob-btn fa-bars"></i>
		</div>
		<div id="page-header">
			<div class="inner">
				<h1>
					<?php
					if ( is_home() ) {
						$blog = get_post(get_option( 'page_for_posts' ) );
						$subtitle = get_post_meta( $blog->ID, 'subtitle', true );
						$header_img = get_post_meta( $blog->ID, 'header_img', true );
						echo $blog->post_title;
					} elseif ( is_tax() ) {
						$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						echo $term->name;
					} elseif ( is_category() ) {
						printf( __( 'Category: %s', 'themerain' ), single_cat_title( '', false ) );
					} elseif ( is_tag() ) {
						printf( __( 'Tag: %s', 'themerain' ), single_tag_title( '', false ) );
					} elseif ( is_day() ) {
						_e( 'Day: ', 'themerain' ); the_time( 'F jS, Y' );
					} elseif ( is_month() ) {
						_e( 'Month: ', 'themerain' ); the_time( 'F, Y' );
					} elseif ( is_year() ) {
						_e( 'Year: ', 'themerain' ); the_time( 'Y' );
					} elseif ( is_search() ) {
						printf( __( 'Search Results for: %s', 'themerain' ), get_search_query() );
					} elseif ( is_404() ) {
						_e( 'Oops! Page Not Found.', 'themerain' );
					} else {
						$subtitle = get_post_meta( $post->ID, 'subtitle', true );
						$header_img = get_post_meta( $post->ID, 'header_img', true );
						the_title();
					}
					?>
				</h1>
				
				<?php if ( ! empty( $subtitle ) ) { ?>
					<div class="subtitle"><?php echo do_shortcode( $subtitle ); ?></div>
				<?php } ?>
			</div>
			<div class="header-bg">
				<div class="header-color">
					<?php if ( ! empty( $header_img ) ) { ?>
						<img src="<?php echo $header_img; ?>" />
					<?php } ?>
				<div>
			</div>
		</div>
	</header>
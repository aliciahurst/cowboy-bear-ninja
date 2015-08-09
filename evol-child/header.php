<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php $headercolor = get_field('header_color', $post->ID); ?>

	<div class="site">
		<header class="site-header <?php echo $headercolor ?>" role="banner">
			<div class="inner">
				<div class="site-logo">
					<?php if ($headercolor): ?>
					<a class="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="/wordpress/wp-content/themes/evol-child/img/<?php echo $headercolor ?>_text.png" /></a>
				<?php else: ?>
				<a class="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="/wordpress/wp-content/themes/evol-child/img/logo_white_text.png" /></a>
			<?php endif; ?>
				</div>

				<div class="site-logo-mobile">
					<?php if ($headercolor): ?>
					<a class="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="/wordpress/wp-content/themes/evol-child/img/<?php echo $headercolor ?>_notext.png" /></a>
				<?php else: ?>
				<a class="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="/wordpress/wp-content/themes/evol-child/img/logo_white_notext.png" /></a>
			<?php endif; ?>
				</div>

				<nav class="site-navigation" role="navigation">
					<?php if ( has_nav_menu( 'menu-header' ) ) { ?>
						<?php wp_nav_menu( array( 'theme_location' => 'menu-header', 'menu_class' => 'nav-menu' ) ); ?>
					<?php } else { ?>
						<div class="nav-menu"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">Set up a navigation menu</a></div>
					<?php } ?>
					<button class="menu-toggle"></button>
				</nav>
			</div>

			<?php rainy_page_header(); ?>
		</header>

		<main class="site-main" role="main">
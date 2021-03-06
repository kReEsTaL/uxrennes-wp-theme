<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uxrennes
 */

$html_class 	= ' uxr-layout-full';
$body_class 	= ' uxr-layout-full';
$colour_class 	= '';
$layout_class 	= '';
$page_ID 		= get_the_ID();

//
// Get the last event's colour
//
$args = array(
	'post_type' 		=> 'events',
	'posts_per_page'	=> 1
);

$query = new WP_Query($args);

if ($query->have_posts()) : 

	while ($query->have_posts()) : $query->the_post();

		$event_ID 		= get_the_ID();
		$uxr_event_type = get_post_meta($event_ID, 'uxr_event_type', true);

		if (isset($uxr_event_type) && !empty($uxr_event_type) && is_front_page()) :

			$colour_class = ' uxr-color-' . $uxr_event_type;
			$layout_class = ' uxr-layout-' . $uxr_event_type;

		else : 

			$colour_class = ' uxr-color-uxdeiz';

		endif;

	endwhile;

endif; 

wp_reset_query();

$body_class .= $colour_class;
$body_class .= $layout_class;

//
//
//

?><!DOCTYPE html>
<!--[if lt IE 9]>      <html class="no-js ie8<?php if (isset($html_class) && !empty($html_class)) echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]>         <html class="no-js ie9<?php if (isset($html_class) && !empty($html_class)) echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js<?php if (isset($html_class) && !empty($html_class)) echo $html_class; ?>" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<meta name="pinterest" content="nopin" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
		<meta name="msapplication-TileColor" content="#000000">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#000000">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class($body_class); ?>>
		
		<!--[if lte IE 8]>
		<div id="no-ie8">
			<p class="browserupgrade"><p class="browserupgrade">
				<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>', 'uxrennes'); ?>
			</p>
		</div>
		<![endif]-->

		<div id="page" class="hfeed site uxr-layout-full_container">

			<a class="skip-link screen-reader-text" href="#content">
				<?php esc_html_e( 'Skip to content', 'uxrennes' ); ?>
			</a>

			<header id="masthead" class="uxr-site-header" role="banner">
				<div class="uxr-site-header_inside">
					<div class="uxr-grid-container">
						<div class="site-branding">
							<?php if ( is_front_page() || is_home() ) : ?>
								<h1 class="uxr-site-header_logo">
									<a href="<?php echo home_url('/'); ?>" rel="home">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-uxrennes.svg" width="121" height="121" alt="UX Rennes" data-pin-nopin="true" />
									</a>
								</h1>
							<?php else : ?>
								<p class="uxr-site-header_logo">
									<a href="<?php echo home_url('/'); ?>" rel="home">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-uxrennes.svg" width="121" height="121" alt="UX Rennes" data-pin-nopin="true" />
									</a>
								</p>
							<?php endif; ?>
						</div>

						<?php /*
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'uxrennes' ); ?></button>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav>
						*/ ?>
					</div>
				</div>
			</header>

			<div id="content" class="site-content uxr-layout-full_row uxr-layout-full_row-content">
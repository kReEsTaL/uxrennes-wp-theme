<?php
/**
 * uxrennes-theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uxrennes
 */

/**
 * Import ACF settings
 * /!\ Disable on dev environment.
 * /!\ Enable on preprod and prod environments.
 */
 
if ( defined('UXR_ENV') && (UXR_ENV === 'PROD' || UXR_ENV === 'PREPROD') ) {
 
	// Only call the ACF export in production.
	include_once( get_template_directory() . '/inc/acf-export.php' );
}

/**
 * Display the name of the template in use to display the current page
 */
if ( defined('UXR_ENV') && UXR_ENV === 'DEV' ){

	//add_action('wp_head', 'show_template');
	function show_template() {

		if (current_user_can('activate_plugins')) :
			global $template;
			print_r($template);
		endif;
	}
}

if ( ! function_exists( 'uxr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uxr_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on uxrennes-theme, use a find and replace
	 * to change 'uxrennes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'uxrennes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'uxrennes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	/**
	 * Remove theme support
	 */
	remove_theme_support('custom-background', 'custom-header', 'post-formats');

	/**
	 * Custom image sizes
	 */
	add_image_size('uxr_square', 			650, 650, true);
	add_image_size('uxr_speaker_medium', 	380, 270, true);
	add_image_size('uxr_fullwidth', 		1560, 9999);

}
endif; // uxr_setup
add_action( 'after_setup_theme', 'uxr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uxr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uxr_content_width', 780 );
}
add_action( 'after_setup_theme', 'uxr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uxr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uxrennes' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uxr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function uxr_scripts() {
	
	global $wp_styles;
	global $wp_scripts;

	/* Load our IE specific stylesheet for a range of older versions. */
	$last_update_css_ie8 	= filemtime( get_stylesheet_directory() . '/style-lte-ie8.css' );	
	wp_enqueue_style( 'uxr-style-oldies', get_stylesheet_directory_uri() . "/style-lte-ie8.css", array(), $last_update_css_ie8, 'screen' );
 	$wp_styles->add_data( 'uxr-style-oldies', 'conditional', 'lte IE 8' );

	/* Load the main stylesheet */
	$last_update_css 		= filemtime( get_stylesheet_directory() . '/style.css' );	
	wp_enqueue_style( 'uxr-style', get_stylesheet_uri(), array(), $last_update_css, 'screen' );

	/* Load the print stylesheet */
	// $last_update_css_print 	= filemtime( get_stylesheet_directory() . '/style-print.css' );	
	// wp_enqueue_style( 'uxr-style-print', get_stylesheet_directory_uri() . '/style-print.css', array(), $last_update_css_print, 'print' );

	/* Load Modernizr */
	$last_update_modernizr	= filemtime( get_stylesheet_directory() . '/assets/components/modernizr/modernizr.min.js' );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/components/modernizr/modernizr.min.js', '', $last_update_modernizr );

	/* Get JS */
	// $last_update_js 		= filemtime( get_stylesheet_directory() . '/assets/js/scripts.min.js' );
	// wp_enqueue_script( 'uxr-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), $last_update_js );

	$last_update_js 		= filemtime( get_stylesheet_directory() . '/assets/js/scripts.js' );
	wp_enqueue_script( 'uxr-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), $last_update_js, true );


	// Load the Gravity Forms placeholder polyfill for IE9
    wp_register_script( 'placeholders-polyfill', get_template_directory_uri() . '/assets/components/placeholders-polyfill/placeholders.jquery.min.js', array('jquery'), '3.0.2' );
    wp_script_add_data( 'placeholders-polyfill', 'conditional', 'IE 9' );
    wp_enqueue_script(  'placeholders-polyfill' );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'uxr_scripts', 21 );

/**
 * Add conditional comments around IE-specific style sheet link.
 *
 * @author Gary Jones & Michael Fields (@_mfields)
 * @link http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
 *
 * @param string $tag    Existing style sheet tag.
 * @param string $handle Name of the enqueued style sheet.
 * 
 * @return string Amended markup
 */
add_filter( 'style_loader_tag', 'uxr_add_main_stylesheet_conditional', 10, 2 );
function uxr_add_main_stylesheet_conditional( $tag, $handle ) {
	
	/* 	
		If we display the 'guide' CPT (archive or single), we use a fallback IE8 stylesheet
		thus we don't want IE8 to load the main stylesheet.
	 */
	if ( 'uxr-style' == $handle )
	{
		// We need to change the conditional comment's syntax in order to be understood only by browsers that are not equal or less than IE8
		$tag = '<!--[if ! lte IE 8]><!-->' . "\n" . $tag . '<!--<![endif]-->' . "\n";
		
	}

	return $tag;
}

/**
 * Load inline JS
 * @link https://wordpress.org/support/topic/adding-javascript-to-a-single-page
 */
function uxr_load_inline_js($pid)
{
   if (is_front_page())
   {
		// Load the MeetUp button JS on the homepage
   		if ( defined('UXR_ENV') && (UXR_ENV === 'DEV') )
   		{
			echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s); js.id=id;js.async=true;js.src="https://a248.e.akamai.net/secure.meetupstatic.com/s/script/2012676015776998360572/api/mu.btns.js?id=8nivmb10n47bptfrf6eagcvuj4";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","mu-bootjs");</script>';
		}
		else 
		{
			echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s); js.id=id;js.async=true;js.src="https://a248.e.akamai.net/secure.meetupstatic.com/s/script/2012676015776998360572/api/mu.btns.js?id=lmuu7ijjbie4ekj4dakqouva3j";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","mu-bootjs");</script>';
		}
   }
}
//add_action( 'wp_footer', 'uxr_load_inline_js' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Import custom post types
 */
require get_template_directory() . '/inc/cpt-events.php';
//require get_template_directory() . '/inc/cpt-places.php';
require get_template_directory() . '/inc/cpt-talks.php';

/**
 * Disable emojis
 */
function disable_emojis() {
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


/**
 * Remove the recent comments widget styles from wp_head
 */
add_action( 'widgets_init', 'uxr_remove_recent_comments_style' );
function uxr_remove_recent_comments_style() {  
	global $wp_widget_factory;  
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}


/**
 * TinyMCE: remove the h1 and pre choices from the list
 */
add_filter('tiny_mce_before_init', 'uxr_myformatTinyMCE' );
function uxr_myformatTinyMCE($in) {
  $in['block_formats'] = "Paragraph=p;Header 2=h2;Header 3=h3;Header 4=h4;Header 5=h5;Header 6=h6";
  return $in;
}


/*
 * Adds gallery shortcode custom defaults
 * @author http://amethystwebsitedesign.com/how-to-get-larger-images-in-a-wordpress-gallery/#method2
 */
//add_filter( 'shortcode_atts_gallery', 'uxr_gallery_atts', 10, 3 );
function uxr_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array(
		'columns' 	=> '3',
		'size' 		=> 'medium',
		'link' 		=> 'file',
		), $atts );

	$out['columns'] = $atts['columns'];
	$out['size'] = $atts['size'];
	$out['link'] = $atts['link'];

	return $out;

}
 
 
/**
 * @subsection Sanitize Uploads Name to Prevent 404
 * @link https://wpchannel.com/renommer-automatiquement-fichiers-accentues-wordpress/
 */
add_filter('sanitize_file_name', 'wpc_sanitize_french_chars', 10);
 
function wpc_sanitize_french_chars($filename) {
     
    // Force the file name in UTF-8 (encoding Windows / Mac / Linux)
    $filemane = mb_convert_encoding($filename, "UTF-8");
 
    $char_not_clean = array('/@/','/À/','/Á/','/Â/','/Ã/','/Ä/','/Å/','/Ç/','/È/','/É/','/Ê/','/Ë/','/Ì/','/Í/','/Î/','/Ï/','/Ò/','/Ó/','/Ô/','/Õ/','/Ö/','/Ù/','/Ú/','/Û/','/Ü/','/Ý/','/à/','/á/','/â/','/ã/','/ä/','/å/','/ç/','/è/','/é/','/ê/','/ë/','/ì/','/í/','/î/','/ï/','/ð/','/ò/','/ó/','/ô/','/õ/','/ö/','/ù/','/ú/','/û/','/ü/','/ý/','/ÿ/', '/©/');
    $clean = array('a','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy');
 
    $friendly_filename = preg_replace($char_not_clean, $clean, $filename);
 
    // After replacement, we destroy the last residues
    $friendly_filename = utf8_decode($friendly_filename);
    $friendly_filename = preg_replace('/\?/', '', $friendly_filename);
 
    // Lowercase
    $friendly_filename = strtolower($friendly_filename);
 
    return $friendly_filename;
}


/**
 * Non-breakable spaces
 */
function nonBreakableSpaces($text)  
{  
	$dirtyspaces	= array(' :', ' ;', '« ', ' »', ' !', ' ?', 'Aleks Crément', ' euros');
	$cleanspaces	= array('&nbsp;:', '&nbsp;;', '«&nbsp;', '&nbsp;»', '&nbsp;!', '&nbsp;?', 'Aleks&nbsp;Crément', '&nbsp;euros');
	$output = str_replace($dirtyspaces, $cleanspaces, $text);
	
	return $output;
}  
add_filter('the_content', 'nonBreakableSpaces', 15);
add_filter('the_title', 'nonBreakableSpaces', 15);
add_filter('comment_text', 'nonBreakableSpaces', 30);	// commentaires

/**
 * Filter Yoast Meta Priority
 */
add_filter( 'wpseo_metabox_prio', function() { return 'low';});


/*
 * Force medium and large images to crop
 * @link http://wordpress.org/support/topic/force-crop-to-medium-size
 */
if(false === get_option("medium_crop"))
	add_option("medium_crop", "1");
else
	update_option("medium_crop", "1");

if(false === get_option("large_crop"))
	add_option("large_crop", "1");
else
	update_option("large_crop", "1");


/**
 * Add an Options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> esc_html__('Theme options', 'rm'),
		'menu_title'	=> esc_html__('Options', 'rm'),
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> esc_html__('Something', 'rm'),
	// 	'menu_title'	=> esc_html__('Something', 'rm'),
	// 	'parent_slug'	=> 'theme-options'
	// ));
}
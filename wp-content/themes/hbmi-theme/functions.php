<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

include_once( CHILD_DIR . '/assets/functions/widgets.php' );

// Include theme-functions.php
include_once( CHILD_DIR  . '/assets/functions/theme-functions.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'HBMI Theme' );
define( 'CHILD_THEME_URL', 'http://hbmi-local.dev' );
define( 'CHILD_THEME_VERSION', '1.0.0' );
define( 'CHILD_DOMAIN', 'hbmi-theme' );


add_action( 'wp_enqueue_scripts', 'hbmi_custom_scripts_styles' );
/**
 * Enqueue scripts and styles
 *
 * @author Joe Dooley
 *
 */
function hbmi_custom_scripts_styles() {
	wp_enqueue_style( 'font-styles', get_stylesheet_directory_uri() . '/assets/fonts/stylesheet.css', CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'vendorsjs', get_stylesheet_directory_uri() . '/assets/js/vendors.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}


add_action( 'after_setup_theme', 'hbmi_add_theme_support' );
/**
 * Adds theme features
 *
 * @author Joe Dooley
 *
 */
function hbmi_add_theme_support() {

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		add_theme_support( 'genesis-responsive-viewport' );
		add_theme_support( 'genesis-after-entry-widget-area' );
		add_theme_support( 'genesis-accessibility', array( 'headings', 'search-form', 'hbmiip-links', 'rems' ) );
		//add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer' ) );
}


// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


add_filter( 'theme_page_templates', 'hbmi_remove_genesis_page_templates' );
/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function hbmi_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

/**
 * Move Primary Nav to Header Right
 */
unregister_sidebar( 'header-right' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );


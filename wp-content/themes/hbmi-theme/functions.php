<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Include theme-functions.php
require_once( CHILD_DIR . '/lib/theme-functions.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'HBMI Theme' );
define( 'CHILD_THEME_URL', 'http://dev-hbmi.pantheon.io/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );
define( 'CHILD_DOMAIN', 'hbmi-theme' );


//* Enable Support for WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );


add_action( 'wp_enqueue_scripts', 'hbmi_custom_scripts_styles' );
/**
 * Enqueue scripts and styles
 *
 * @author Joe Dooley
 *
 */
function hbmi_custom_scripts_styles() {

	wp_enqueue_style( 'font-styles', get_stylesheet_directory_uri() . '/fonts/stylesheet.css', CHILD_THEME_VERSION );


	wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_script( 'responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	//wp_enqueue_script( 'backstretch',  get_stylesheet_directory_uri() . '/js/jquery.backstretch.min.js', array('jquery' ), '', true );

	//wp_enqueue_script( 'backstretch-set',  get_stylesheet_directory_uri() . '/js/backstretch-set.js', array('backstretch' ), CHILD_THEME_VERSION, true );


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

		// Add Accessibility support
		// add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu', 'search-form',
	// 'hbmiip-links', 'rems' ) );
		add_theme_support( 'genesis-accessibility', array( 'headings', 'search-form', 'hbmiip-links', 'rems' ) );




	// Remove wrap from .site-inner
		add_theme_support( 'genesis-structural-wraps', array(
		  'header',
		//'nav',
		//'subnav',
		// 'site-inner',
			'footer-widgets',
			'footer'
		));

}


// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );



// Customize the previous page link
add_filter ( 'genesis_prev_link_text' , 'hbmi_previous_page_link' );
function hbmi_previous_page_link ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Previous Page', CHILD_DOMAIN );
}

// Customize the next page link
add_filter ( 'genesis_next_link_text' , 'hbmi_next_page_link' );
function hbmi_next_page_link ( $text ) {
	return __( 'Next Page', CHILD_DOMAIN ) . g_ent( ' &raquo; ' );
}


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
	//unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

/**
 * Move Primary Nav to Header Right
 */
unregister_sidebar( 'header-right' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );
add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'footer-widgets', 'footer' ) );



/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function hbmi_gf_body_class( $classes ) {
	$classes[] = 'form-submitted';
	return $classes;
}



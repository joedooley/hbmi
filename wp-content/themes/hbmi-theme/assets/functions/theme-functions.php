<?php
/**
 * Theme Functions
 * @author    Joe Dooley
 * @package   HBMI Theme
 *
 */

/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * Fixes Genesis bug - when using static front page and blog page (admin reading settings) Home page is <p> tag and Blog page is <h1> tag
 *
 * Replaces "is_home" with "is_front_page" to correctly display Home page wit <h1> tag and Blog page with <p> tag
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 *
 * @edited by Sridhar Katakam
 * @link http://www.sridharkatakam.com/use-inline-logo-instead-background-image-genesis/
 *
************************************/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'genesis_seo_title', 'hbmi_header_inline_logo', 10, 3 );
function hbmi_header_inline_logo( $title, $inside, $wrap ) {

	$logo = '<img src="' . get_stylesheet_directory_uri() . '/assets/images/svg/logo.svg" alt="' . esc_attr(
			get_bloginfo(
					'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="315" height="130" />';

	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );

	// Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	// A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );

}





// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Enable PHP in widgets
add_filter('widget_text','hbmi_execute_php',100);
function hbmi_execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}


add_filter( 'upload_mimes', 'hbmi_svg_mime_types' );
/**
* Allow SVG's in the WordPress uploader.
* @author Joe Dooley
*/
function hbmi_svg_mime_types( $mimetypes ){
  $mimetypes['svg'] = 'image/svg+xml';
  return $mimetypes;
}

add_action('admin_head', 'hbmi_svg_size');
/**
* Hack to make SVG's look normal in the WordPress media library.
* @author Joe Dooley
*/
function hbmi_svg_size() {
  echo '<style>
    svg, img[src*=".svg"] {
      max-width: 150px !important;
      max-height: 150px !important;
    }
  </style>';
}


/**
 * Date function to display copyright in the footer
 */
function hbmi_echo_date() {

  $fromYear = 2009;
  $thisYear = (int)date('Y');
    $copyrightText = '&copy; Copyright &copy; ';
    $copyrightCompanyInfo = 'Quantize Courses. All Rights Reserved.';
    if ( ( $fromYear !== $thisYear ) ) {
        $fromYearToThisYear = $fromYear . ( '-' . $thisYear . '&nbsp' );
    } else {
        $fromYearToThisYear = $fromYear . ( '' );
    }

    echo '<div class="footer-copyright-info"><small class="copyright-years">' . $copyrightText . $fromYearToThisYear . $copyrightCompanyInfo . '</small></div>';

}
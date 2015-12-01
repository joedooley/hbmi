<?php
namespace HBMI;

/**
 * Scripts and stylesheets
 *
 * Path to compiled resources : wp-content/themes/hbmi-theme/public
 *
 * Enqueue stylesheets in the following order:
 * 1. /hbmi-theme/public/css/app.css
 *
 * Enqueue scripts in the following order:
 * 1. /hbmi-theme/public/js/modernizr.flexbox.min.js
 * 2. /hbmi-theme/public/js/app.js
 */
function asset_path($filename) {

	$dist_path = get_stylesheet_directory() . bourboneat_dist_dir;
	$directory = dirname($filename) . '/';
	$file = basename($filename);
    return $dist_path . $directory . $file;

}

function assets() {
	wp_enqueue_style('bourboneat_css', asset_path('styles/main.css'), false, null);
    // IE stylesheet
    //wp_enqueue_style('bourboneat_css_ie8', asset_path('styles/main-ie8.css'), array('bourboneat_css'));
    //wp_style_add_data('bourboneat_css_ie8', 'conditional', 'lt IE 9);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Modernizr
	//wp_enqueue_script('modernizr', asset_path('scripts/modernizr.js'), [], null, false);
	wp_enqueue_script('bourboneat_js', asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
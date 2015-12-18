<?php
/**
 * Product page template
 *
 * @package hbmi-theme
 * @author  Joe Dooley\Developing Designs
 * @license GPL-2.0+
 * @link    http://www.developingdesigns.com
 */

/**
 * Template Name: Product
 */

add_action( 'get_header', 'hbmi_products_check' );
/**
 * Return if this is the Products page
 */
function hbmi_products_check() {

  if ( is_page( 'Products' ) ) {

    add_filter( 'body_class', 'hbmi_product_body_class' );

    remove_action( 'genesis_loop', 'genesis_do_loop' );

    add_action( 'genesis_loop', 'hbmi_product_icons' );

  }

}


/**
 * Getting in home-icons.php partial
 */
function hbmi_product_icons() {
  get_template_part( 'assets/views/partials/product', 'icons' );
}


/**
 * Adds .products to the body class on the Product Page
 *
 * @param $classes
 *
 * @return array
 */
function hbmi_product_body_class( $classes ) {
  $classes[] = 'products';

  return $classes;
}

genesis();


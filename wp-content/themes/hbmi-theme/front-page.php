<?php
/**
 * This file adds the Home Page to the hbmi Pro Theme.
 *
 * @author Joe Dooley
 * @package HBMI Theme
 * @subpackage Customizations
 */

// Function displaying Flexible Content Field
function hbmi_display_fc() {

		// loop through the rows of data
	while ( have_rows('flexible_content') ) : the_row();


			// "Hero" Layout
		if ( get_row_layout() === 'hero_row' ) { ?>


			<section class="row content-area hero-row <?php the_sub_field( 'css_class' ); ?>" style="background-image: url('<?php the_sub_field( 'hero_image' ); ?>');">
				<div class="wrap">
					<div class="heading-container-wrap">
						<div class="hero-content">
							<?php the_sub_field( 'hero_content' ); ?>
						</div>
					</div>
				</div>
			</section>



		 <?php } elseif( get_row_layout() === 'full_row' ) { ?>

			<section class="row content-area <?php the_sub_field( 'css_class' ); ?>">
					<div class="wrap">
						<div class="heading-wrap">
							<h2 class="section-heading"><?php the_sub_field( 'section_heading' ); ?></h2>
						</div>
						<?php the_sub_field( 'content_area' ); ?>
					</div>
			</section>

			<?php

			} elseif( get_row_layout() === 'partner_client_row' ) { ?>


				<section class="row image-area <?php the_sub_field( 'css_class' ); ?>">
					<div class="wrap">
						<div class="heading-wrap">
							<h2 class="section-heading"><?php the_sub_field( 'section_heading' ); ?></h2>
						</div>						
						<?php the_sub_field( 'content_area' ); ?>
					</div>

				</section>

			<?php }


	endwhile;


}



add_action( 'get_header', 'hbmi_fc_check' );
function hbmi_fc_check() {
	// If "Flexible Content" field has rows of data
	if( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'hbmi_flexbox_support_check' );

		// Force full width content
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Remove the default Page content
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Show Flexible Content field in the content area
		add_action( 'genesis_loop', 'hbmi_display_fc' );


		// Add custom body class
		add_filter( 'body_class', 'hbmi_body_class' );
	}
}


function hbmi_flexbox_support_check() {
	wp_enqueue_script( 'modernizer', get_stylesheet_directory_uri() . '/js/modernizer.flexbox.min.js' );
}

function hbmi_body_class( $classes ) {
	$classes[] = 'flexible-content';
	return $classes;
}


genesis();
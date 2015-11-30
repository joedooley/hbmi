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
	while ( have_rows( 'flexible_content' ) ) : the_row();

			// "Hero" Layout
			if ( get_row_layout() === 'hero_row' ) {

				$bg_image = get_sub_field( 'hero_image' ); ?>

				<section class="row content-section hero-row <?php the_sub_field( 'css_class' ); ?>" style="background: url(<?= $bg_image['url']; ?>); background-size: cover;">
					<div class="wrap">
						<div class="heading-container-wrap">
							<div class="hero-content">
								<?php if ( get_sub_field( 'hero_content' ) ) :
									the_sub_field( 'hero_content' );
								endif; ?>
							</div>
						</div>
					</div>
				</section>

			<?php } elseif ( get_row_layout() === 'row_with_heading' ) {

				$bg_color = get_sub_field( 'background_color' );
				?>

				<section class="row content-section <?= the_sub_field( 'css_class' ); ?>" style="background-color: <?= $bg_color; ?>;">
					<div class="wrap">
						<div class="heading-wrap">
							<h2 class="section-heading">
								<?php if ( get_sub_field( 'section_heading' ) ) :
									the_sub_field( 'section_heading' );
								endif; ?>
							</h2>
						</div>
						<div class="content-area">
							<?php if ( get_sub_field( 'content_area' ) ) :
								the_sub_field( 'content_area' );
							endif; ?>
						</div>
					</div>
				</section>


			<?php } elseif ( get_row_layout() === 'row_without_heading' ) {

				$background_image = get_sub_field( 'background_image' ) ? get_sub_field( 'background_image' ) : ''; ?>

				<section class="row content-section <?php the_sub_field( 'css_class' ); ?>" style="background: url(<?= $background_image['url']; ?>); background-size: cover;">
					<div class="wrap">
						<div class="content-area">
							<?php if ( get_sub_field( 'content_area' ) ) :
								the_sub_field( 'content_area' );
							endif; ?>
						</div>
					</div>
				</section>

			<?php }

	endwhile;

}



add_action( 'get_header', 'hbmi_fc_check' );
function hbmi_fc_check() {
	// If "Flexible Content" field has rows of data
	if( ! is_admin() ) {

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

function hbmi_body_class( $classes ) {
	$classes[] = 'flexible-content';
	return $classes;
}


genesis();
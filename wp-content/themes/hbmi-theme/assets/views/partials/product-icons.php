<?php
/**
 * Product Icons Partial
 * @package page-products.php
 */

?>
<article class="type-page status-publish entry" itemscope="" itemtype="http://schema
    .org/CreativeWork">
	<div class="outer-container">
		<div class="row">
			<div class="list-icon">
				<a class="icon walker" href="medical-suppliesdme-supplies">
					<svg class="icon walker">
						<use xlink:href="#walker"></use>
					</svg>
				</a>
			</div>
			<div class="icon-description">
				<?php if ( get_field( 'standard_dme' ) ) :
					the_field( 'standard_dme' );
				endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="list-icon">
				<a class="icon sock" href="orthotics">
					<svg class="icon">
						<use xlink:href="#sock"></use>
					</svg>
				</a>
			</div>
			<div class="icon-description">
				<?php if ( get_field( 'orthotics_and_prosthetics' ) ) :
					the_field( 'orthotics_and_prosthetics' );
				endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="list-icon">
				<a class="icon plus-sign" href="#">
					<svg class="icon">
						<use xlink:href="#plus-sign"></use>
					</svg>
				</a>
			</div>
			<div class="icon-description">
				<?php if ( get_field( 'medical_supplies' ) ) :
					the_field( 'medical_supplies' );
				endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="list-icon">
				<a class="icon scooter" href="#">
					<svg class="icon">
						<use xlink:href="#scooter"></use>
					</svg>
				</a>
			</div>
			<div class="icon-description">
				<?php if ( get_field( 'specialty_rehab_equipment' ) ) :
					the_field( 'specialty_rehab_equipment' );
				endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="list-icon">
				<a class="icon phone" href="electron-therapy-and-supplies">
					<svg class="icon">
						<use xlink:href="#phone"></use>
					</svg>
				</a>
			</div>
			<div class="icon-description">
				<?php if ( get_field( 'electrotherapy_units_and_supplies' ) ) :
					the_field( 'electrotherapy_units_and_supplies' );
				endif; ?>
			</div>
		</div>
	</div>
</article>

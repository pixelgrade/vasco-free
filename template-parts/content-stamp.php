<?php
/**
 * Template part for displaying the the stamp.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// We will rely on the options set in Customizer > General > Stamps

// First determine what kind of stamp we will output: a auto-generated one or an image based one
if ( 'auto' === pixelgrade_option( 'stamp_style' ) ) {
	// Auto-generated stamp it is then
	// We need the text and the icon
	$stamp_text = pixelgrade_option( 'stamp_text' );
	// We parse the content tags, if any, and trim the whole thing
	$stamp_text = trim( pixelgrade_parse_content_tags( $stamp_text ) );

	// For the icon, we currently use 10 SVG icons from assets/icons/xxx.svg
	$stamp_icon = pixelgrade_option( 'stamp_icon' );
	?>

	<div class="c-stamp c-stamp--auto">
		<div class="c-stamp__text"><?php echo $stamp_text; ?></div>
		<div class="c-stamp__image">
			<?php get_template_part( '/assets/icons/' . $stamp_icon ); ?>
		</div>
	</div>

<?php
} elseif ( 'custom' === pixelgrade_option( 'stamp_style' ) ) {
	$stamp_dark_image_id  = absint( pixelgrade_option( 'stamp_dark_image' ) );
	$stamp_light_image_id = absint( pixelgrade_option( 'stamp_light_image' ) );

	if ( ! empty( $stamp_dark_image_id ) || ! empty( $stamp_light_image_id ) ) { ?>

		<div class="c-stamp c-stamp--custom">

			<?php
			if ( ! empty( $stamp_dark_image_id ) ) {
				echo wp_get_attachment_image( $stamp_dark_image_id, 'vasco-stamp-image', false, array( 'class' => 'c-stamp__image c-stamp__image--dark' ) );
			}
			if ( ! empty( $stamp_light_image_id ) ) {
				echo wp_get_attachment_image( $stamp_light_image_id, 'vasco-stamp-image', false, array( 'class' => 'c-stamp__image c-stamp__image--light' ) );
			} ?>

		</div>

		<?php
	}
}


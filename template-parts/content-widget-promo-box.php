<?php
/**
 * Template part for displaying the Promo Box widget.
 *
 * @global int $image The image attachment ID.
 * @global string $title The headline text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<div class="c-promo__content">

		<?php if ( ! empty( $title ) ) { ?>
			<div class="c-promo__title"><div><?php echo $title ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $description ) ) { ?>
			<div class="c-promo__description"><div><?php echo $description; ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<div class="c-promo__action">
				<a href="<?php echo $button_url; ?>" class="c-promo__btn c-btn"><?php echo $button_text; ?></a>
			</div>
		<?php } ?>

	</div>

<?php } ?>

<?php if ( ! empty ( $image ) ) { ?>
	<div class="c-promo__media">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	</div>

	<?php if ( pixelgrade_option( 'show_stamps' ) ) {
		get_template_part( 'content-stamp' );
	} ?>

<?php } ?>

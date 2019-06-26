<?php
/**
 * Template part for displaying the Promo Box widget.
 *
 * The variables bellow, that are available in the scope of this file, are already sanitized in the
 * Pixelgrade_WidgetFields class with the sanitizeFields() method.
 *
 * @global int $image The image attachment ID.
 * @global string $title The headline text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<div class="c-promo__content">

		<?php if ( ! empty( $title ) ) { ?>
			<div class="c-promo__title"><div><?php echo wp_kses_post( $title ); ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $description ) ) { ?>
			<div class="c-promo__description"><div><?php echo wp_kses_post( $description ); ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<div class="c-promo__action">
				<a href="<?php echo esc_url( $button_url ); ?>" class="c-promo__btn c-btn"><?php echo wp_kses_post( $button_text ); ?></a>
			</div>
		<?php } ?>

	</div>

<?php } ?>

<?php if ( ! empty ( $image ) ) { ?>
	<div class="c-promo__media">
		<?php echo wp_get_attachment_image( $image, 'pixelgrade_single_portrait' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php if ( pixelgrade_option( 'show_stamps' ) ) {
			get_template_part( 'template-parts/content-stamp' );
		} ?>
	</div>

<?php } ?>

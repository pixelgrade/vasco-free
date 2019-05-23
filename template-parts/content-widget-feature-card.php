<?php
/**
 * Template part for displaying the Feature Card widget.
 *
 * The variables bellow, that are available in the scope of this file, are already sanitized in the
 * Pixelgrade_WidgetFields class with the sanitizeFields() method.
 *
 * @global array $args The widget display options.
 * @global string $title The title text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 * @global int $image The feature image attachment ID.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<div class="c-feature__content u-content-width">
		<?php if ( ! empty( $title ) ) { ?>
			<div class="c-feature__title h3"><span><?php echo wp_kses_post( $title ); ?></span></div>
		<?php } ?>

		<?php if ( ! empty( $description ) ) { ?>
			<div class="c-feature__description"><?php echo wp_kses_post( $description ); ?></div>
		<?php } ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<div class="c-feature__action">
				<a href="<?php echo esc_url( $button_url ); ?>" class="c-feature__btn c-btn"><?php echo wp_kses_post( $button_text ); ?></a>
			</div>
		<?php } ?>

	</div>

	<?php if ( ! empty( $button_url ) ) {
		if ( ! empty( $button_text ) ) { ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="c-feature__link u-mq-below-pad"></a>
		<?php } else { ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="c-feature__link"></a>
		<?php }
	} ?>

<?php } ?>

<div class="c-feature__media">
	<?php if ( ! empty ( $image ) ) {
		echo wp_get_attachment_image( $image, 'pixelgrade_single_landscape' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} ?>
</div>

<?php
/**
 * Template part for displaying the Callout Box widget.
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

if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<div class="c-callout__content">

		<?php
		if ( pixelgrade_option( 'show_stamps' ) ) {
			get_template_part( 'template-parts/content-stamp' );
		}

		if ( ! empty( $title ) ) { ?>
			<div class="c-callout__title"><?php echo wp_kses_post( $title ); ?></div>
		<?php }

		if ( ! empty( $description ) ) { ?>
			<div class="c-callout__description"><?php echo wp_kses_post( $description ); ?></div>
		<?php }

		if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<div class="c-callout__action">
				<a href="<?php echo esc_url( $button_url ); ?>" class="c-callout__btn c-btn c-btn--default"><?php echo wp_kses_post( $button_text ); ?></a>
			</div>
		<?php } ?>

	</div>

<?php }

if ( ! empty ( $image ) ) { ?>
	<div class="c-callout__media">
		<?php echo wp_get_attachment_image( $image, 'pixelgrade_single_landscape' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
<?php }


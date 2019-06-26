<?php
/**
 * Template part for displaying the Profile widget.
 *
 * The variables bellow, that are available in the scope of this file, are already sanitized in the
 * Pixelgrade_WidgetFields class with the sanitizeFields() method.
 *
 * @global array $args The widget display options.
 * @global string $title The title text.
 * @global string $subtitle The subtitle text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 * @global int $image The profile image attachment ID.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="c-profile">

<?php if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) {

	if ( ! empty( $title ) ) { ?>
		<div class="c-profile__dropcap"><?php echo substr( wp_kses( $title, array() ), 0, 1 ); ?></div>
	<?php } ?>

	<div class="c-profile__content">

		<?php if ( ! empty( $subtitle ) ) { ?>
			<div class="c-profile__subtitle h5"><?php echo wp_kses_post( $subtitle ); ?></div>
		<?php }

		if ( ! empty( $title ) ) { ?>
			<div class="c-profile__title h2"><?php echo wp_kses_post( $title ); ?></div>
		<?php }

		if ( ! empty( $description ) ) { ?>
			<p class="c-profile__description"><?php echo wp_kses_post( $description ); ?></p>
		<?php }

		if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="c-profile__btn c-btn"><?php echo wp_kses_post( $button_text ); ?></a>
		<?php } ?>

	</div><!-- .c-profile__content -->

<?php }

if ( ! empty ( $image ) ) { ?>

	<div class="c-profile__media">

		<?php
		/**
		 * pixelgrade_widget_profile_before_profile_image hook.
		 */
		do_action( 'pixelgrade_widget_profile_before_profile_image', $args );
		?>
		<!-- pixelgrade_widget_profile_before_profile_image -->

		<?php echo wp_get_attachment_image( $image, 'pixelgrade_single_landscape' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php
		/**
		 * pixelgrade_widget_profile_after_profile_image hook.
		 */
		do_action( 'pixelgrade_widget_profile_after_profile_image', $args );
		?>
		<!-- pixelgrade_widget_profile_after_profile_image -->

	</div><!-- .c-profile__media -->

<?php } ?>
</div><!-- .c-profile -->

<?php
/**
 * Template part for displaying the Profile widget.
 *
 * @global array $args The widget display options.
 * @global array $args The widget display options.
 * @global string $title The title text.
 * @global string $subtitle The subtitle text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 * @global int $image The profile image attachment ID.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="c-profile">

<?php if ( ! empty( $title ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<?php if ( ! empty( $title ) ) { ?>
		<div class="c-profile__dropcap"><?php echo substr( $title, 0, 1 ); ?></div>
	<?php } ?>

	<div class="c-profile__content">

		<?php if ( ! empty( $subtitle ) ) { ?>
			<div class="c-profile__subtitle h6"><?php echo $subtitle; ?></div>
		<?php } ?>

		<?php if ( ! empty( $title ) ) { ?>
			<div class="c-profile__title h2"><?php echo $title ?></div>
		<?php } ?>

		<?php if ( ! empty( $description ) ) { ?>
			<p class="c-profile__description"><?php echo $description; ?></p>
		<?php } ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<a href="<?php echo $button_url; ?>" class="c-profile__btn c-btn"><?php echo $button_text; ?></a>
		<?php } ?>

	</div>

<?php } ?>

<?php if ( ! empty ( $image ) ) { ?>

	<div class="c-profile__media">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>

		<?php if ( pixelgrade_option( 'show_stamps' ) ) {
			get_template_part( 'template-parts/content-stamp' );
		} ?>

		<?php if ( pixelgrade_option( 'show_blobs' ) ) {
			get_template_part( 'template-parts/content-blob' );
		} ?>
	</div>

<?php } ?>
</div>

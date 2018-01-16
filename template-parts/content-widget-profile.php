<?php
/**
 * Template part for displaying the Profile widget.
 *
 * @global int $featured_image The featured image attachment ID.
 * @global string $headline The headline text.
 * @global string $description The description text.
 * @global string $button_text The button text.
 * @global string $button_url The button link URL.
 * @global string $box_style The box style (currently either 'light' or 'dark').
 * @global bool $switch_content_order Whether to switch the content order.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $headline ) || ! empty( $description ) || ( ! empty( $button_text ) && ! empty( $button_url ) ) ) { ?>

	<div class="c-profile__content">

		<?php if ( ! empty( $secondary_headline ) ) { ?>
			<div class="c-profile__subtitle h6"><?php echo $secondary_headline; ?></div>
		<?php } ?>

		<?php if ( ! empty( $headline ) ) { ?>
			<div class="c-profile__title"><div><?php echo $headline ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $description ) ) { ?>
			<div class="c-profile__description"><div><?php echo $description; ?></div></div>
		<?php } ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
			<div class="c-profile__action">
				<a href="<?php echo $button_url; ?>" class="c-profile__btn c-btn"><?php echo $button_text; ?></a>
			</div>
		<?php } ?>

	</div>

<?php } ?>

<?php if ( ! empty ( $profile_image ) ) { ?>
	<div class="c-profile__media">
		<?php echo wp_get_attachment_image( $profile_image, 'full' ); ?>
	</div>
<?php } ?>

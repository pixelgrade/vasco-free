<?php
/**
 * Template part for displaying the Location widget.
 *
 * @global array $args The widget display options.
 * @global string $title The title text.
 * @global string $subtitle The subtitle text.
 * @global string $location_url The location link URL.
 * @global int $image The location image attachment ID.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ! empty( $image ) ) {
	if ( ! empty( $location_url ) ) { ?>
		<a href="<?php echo $location_url; ?>" class="c-location__link">
	<?php } ?>

		<div class="c-location__content">

			<?php if ( ! empty( $subtitle ) ) { ?>
				<h4 class="c-location__subtitle h4"><?php echo $subtitle; ?></h4>
			<?php } ?>

			<?php if ( ! empty( $title ) ) { ?>
				<h2 class="c-location__title h2"><?php echo $title ?></h2>
			<?php } ?>

		</div>

		<?php if ( ! empty ( $image ) ) { ?>
			<div class="c-location__media">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
		<?php } ?>

	<?php if ( ! empty( $location_url ) ) { ?>
		</a><!-- .c-location__link -->
	<?php }
} ?>

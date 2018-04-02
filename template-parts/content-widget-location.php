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
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ! empty( $image ) ) { ?>

	<div class="c-location">

		<div class="c-location__content">

			<div class="c-location__icon">
				<?php get_template_part( 'template-parts/svg/icon-location' ); ?>
			</div>

			<?php if ( ! empty( $subtitle ) || ! empty( $title ) ) { ?>
				<div class="c-location__text">
					<?php if ( ! empty( $subtitle ) ) { ?>
						<h4 class="c-location__subtitle h4"><?php echo $subtitle; ?></h4>
					<?php } ?>

					<?php if ( ! empty( $title ) ) { ?>
						<h2 class="c-location__title h2"><?php echo $title ?></h2>
					<?php } ?>
				</div>
			<?php } ?>

		</div>

		<div class="c-location__media">
			<?php if ( ! empty ( $image ) ) {
				echo wp_get_attachment_image( $image, 'pixelgrade_single_landscape' );
			} ?>
		</div>

		<?php if ( ! empty( $location_url ) ) { ?>
			<a href="<?php echo $location_url; ?>" class="c-location__link"></a><!-- .c-location__link -->
		<?php } ?>

	</div>

<?php } ?>

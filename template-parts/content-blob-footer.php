<?php
/**
 * Template part for displaying the blobs in the footer.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="blobs  blobs--footer">
	<div class="blob">
		<div class="blob-rotation">
			<div class="blob-dispersion  blob--shape  blob--shape-3  blob--color-3"></div>
		</div>
	</div>
	<div class="blob">
		<div class="blob-rotation">
			<div class="blob-dispersion  blob--shape  blob--shape-2  blob--color-2"></div>
		</div>
	</div>
	<div class="blob">
		<div class="blob-rotation">
			<div class="blob-dispersion  blob--shape  blob--shape-1  blob--color-3"></div>
		</div>
	</div>
	<div class="blob">
		<div class="blob-rotation">
			<div class="blob-dispersion  blob--shape  blob--shape-2  blob--color-1"></div>
		</div>
	</div>
</div>

<svg class="hidden">
	<defs>
		<filter id="goo">
			<?php
			$blobs_smoothness = pixelgrade_option( 'blobs_smoothness', 10 );
			?>
			<feGaussianBlur in="SourceGraphic" stdDeviation="<?php echo esc_attr( $blobs_smoothness ); ?>" result="blur"/>
			<feColorMatrix
				in="blur"
				mode="matrix"
				values="1 0 0 0 0
					0 1 0 0 0
					0 0 1 0 0
					0 0 0 <?php echo esc_attr( 1 + $blobs_smoothness . ' -' . $blobs_smoothness / 3 ); ?>"
				result="goo"/>
		</filter>
		<?php if ( ! is_customize_preview() && $blobs_smoothness > 20 ): ?>
			<filter id="goo2">
				<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
				<feColorMatrix
					in="blur"
					mode="matrix"
					values="1 0 0 0 0
						0 1 0 0 0
						0 0 1 0 0
						0 0 0 10 -5"
					result="goo2"/>
			</filter>
		<?php endif ?>
	</defs>
</svg>

<?php
/**
 * Template part for displaying the blobs in the footer.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="blobs  blobs--footer">
	<div class="blob  blob--shape-3  blob--color-3"></div>
	<div class="blob  blob--shape-2  blob--color-2"></div>
	<div class="blob  blob--shape-3  blob--color-3"></div>
	<div class="blob  blob--shape-3  blob--color-1"></div>
</div>

<svg>
	<defs>
		<filter id="goo">
			<?php
			$blobs_smoothness = pixelgrade_option( 'blobs_smoothness', 10 );
			?>
			<feGaussianBlur in="SourceGraphic" stdDeviation="<?php echo $blobs_smoothness; ?>" result="blur"/>
			<feColorMatrix
				in="blur"
				mode="matrix"
				values="
					1 0 0 0 0
					0 1 0 0 0
					0 0 1 0 0
					0 0 0 <?php echo 1 + $blobs_smoothness . ' -' . $blobs_smoothness / 3; ?>"
				result="goo"/>
		</filter>
		<?php if ( ! is_customize_preview() && $blobs_smoothness > 20 ): ?>
			<filter id="goo2">
				<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
				<feColorMatrix
					in="blur"
					mode="matrix"
					values="
						1 0 0 0 0
						0 1 0 0 0
						0 0 1 0 0
						0 0 0 10 -5"
					result="goo"/>
			</filter>
		<?php endif ?>
	</defs>
</svg>

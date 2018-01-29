<?php
/**
 * Template part for displaying the Stamp widget.
 *
 * @global array $args The widget display options.
 * @global string $box_style The box style to use: 'dark' or 'light'.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( pixelgrade_option( 'show_stamps' ) ) {
	get_template_part( 'template-parts/content-stamp' );
} ?>

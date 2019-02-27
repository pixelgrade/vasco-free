<?php
/**
 * Template part for displaying the Stamp widget.
 *
 * The variables bellow, that are available in the scope of this file, are already sanitized in the
 * Pixelgrade_WidgetFields class with the sanitizeFields() method.
 *
 * @global array $args The widget display options.
 * @global string $box_style The box style to use: 'dark' or 'light'.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( pixelgrade_option( 'show_stamps' ) ) {
	get_template_part( 'template-parts/content-stamp' );
}

<?php
/**
 * WP Instagram Widget Compatibility File.
 *
 * @link https://wordpress.org/plugins/wp-instagram-widget/
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Force the WP Instagram Widget plugin to use our template part for rendering individual images/entries.
 *
 * @param string $template_part
 *
 * @return string
 */
function vasco_wp_instagram_widget_entry_template( $template_part ) {
	return 'template-parts/content-wp-instagram-widget-entry.php';
}
add_filter( 'wpiw_template_part', 'vasco_wp_instagram_widget_entry_template', 10, 1 );

<?php
/**
 * The Footer - Featured Area sidebar, placed above the Footer widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vasco
 * @since 1.3.0
 */

if ( ! is_active_sidebar( 'footer-featured' ) ) {
	return;
}
?>

<?php dynamic_sidebar( 'footer-featured' ); ?>

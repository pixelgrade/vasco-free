<?php
/**
 * Template part for displaying a single image in the WP Instagram Widget output.
 *
 * @link https://wordpress.org/plugins/wp-instagram-widget/
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<li class="<?php echo esc_attr( $liclass ); ?>">
	<a href="<?php echo esc_url( $item['link'] ); ?>"
	   target="<?php echo esc_attr( $target ); ?>"
	   class="<?php echo esc_attr( $aclass ); ?>">
		<img src="<?php echo esc_url( $item[ $size ] ) ?>"
		     title="<?php if ( ! is_customize_preview() ) { echo esc_attr( vasco_remove_emoji( $item['description'] ) ); } ?>"
		     alt="<?php if ( ! is_customize_preview() ) { echo esc_attr( vasco_remove_emoji( $item['description'] ) ); } ?>"
		     class="<?php echo esc_attr( $imgclass ) ?>"/>
	</a>
</li>

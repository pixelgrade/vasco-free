<?php
/**
 * Template part for displaying a single image in the WP Instagram Widget output.
 *
 * @link https://wordpress.org/plugins/wp-instagram-widget/
 *
 * @package Bobo
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
		     title='<?php echo wp_strip_all_tags( esc_attr( $item['description'] ) ); ?>'
		     alt='<?php echo wp_strip_all_tags( esc_attr( $item['description'] ) ); ?>'
		     class="<?php echo esc_attr( $imgclass ) ?>"/>
	</a>
</li>

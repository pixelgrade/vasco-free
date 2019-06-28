<?php
/**
 * The sidebar containing the Front Page (#1) widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! is_active_sidebar( 'front-page-1' ) ) {
	return;
}
?>

<div class="widget-area  widget-area--main  widget-area--front-page-1">
	<?php dynamic_sidebar( 'front-page-1' ); ?>
</div><!-- .o-layout__main -->

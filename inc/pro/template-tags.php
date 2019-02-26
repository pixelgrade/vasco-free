<?php
/**
 * Custom template tags for the pro version of the theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vasco
 * @since 1.4.0
 */


/**
 * Output mobile search trigger icon
 */
if ( ! function_exists( 'vasco_output_footer_search_trigger' ) ) {
	function vasco_output_footer_search_trigger() {
		echo '<div class="js-search-trigger  js-mobile-search-trigger"></div>';
	}
}

<?php
/**
 * Custom template tags for the pro version of the theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vasco
 * @since 1.3.4
 */

/**
 * Output mobile search trigger icon
 */
if ( ! function_exists( 'vasco_the_footer_search_trigger' ) ) {
	function vasco_the_footer_search_trigger() {
		echo '<div class="js-search-trigger  js-mobile-search-trigger"></div>';
	}
}

<?php
/**
 * Custom template tags for the pro version of the theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vasco
 * @since 1.4.0
 */

// @todo Not so sure these are right! Vasco is different than Felt or Julia.

if ( ! function_exists( 'vasco_output_sticky_header' ) ) {
	/**
	 *
	 */
	function vasco_output_sticky_header() {
		$header_position = pixelgrade_option( 'header_position' );
		if ( empty( $header_position ) || 'sticky' === $header_position ) {
			get_template_part( 'template-parts/site-header-sticky' );
		}
	}
}

if ( ! function_exists( 'vasco_output_search_overlay_trigger' ) ) {
	/**
	 *
	 */
	function vasco_output_search_overlay_trigger() { ?>
		<button class="c-btn--reset  c-btn--search  search-trigger  js-search-trigger  u-hidden">
			<?php get_template_part( 'template-parts/svg/icon-search' ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', '__theme_txtd' ); ?></span>
		</button>
		<?php
	}
}

if ( ! function_exists( 'vasco_output_search_overlay' ) ) {
	/**
	 *
	 */
	function vasco_output_search_overlay() {
		ob_start();
		get_template_part( 'template-parts/search-overlay' );
		$search_overlay = ob_get_clean();
		echo apply_filters( 'vasco_search_overlay_markup', $search_overlay );
	}
}

if ( ! function_exists( 'vasco_output_menu_label' ) ) {
	/**
	 *
	 */
	function vasco_output_menu_label() {
		$menu_label = '<span class="u-hidden  js-menu-mobile-label">' . esc_html__( 'Menu', '__theme_txtd' ) . '</span>';
		echo apply_filters( 'vasco_menu_label_markup', $menu_label );
	}
}

/**
 * Output mobile search trigger icon
 */
if ( ! function_exists( 'vasco_output_footer_search_trigger' ) ) {
	function vasco_output_footer_search_trigger() {
		echo '<div class="js-search-trigger  js-mobile-search-trigger"></div>';
	}
}

<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package Vasco
 * @since 2.3.0
 */

if ( ! function_exists( 'vasco_pro_setup' ) ) {
	/**
	 * Sets up pro theme features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vasco_pro_setup() {

		add_action( 'pixelgrade_after_footer', 'vasco_output_sticky_header', 10 );
		add_action( 'pixelgrade_after_footer', 'vasco_output_search_overlay_trigger', 15 );
		add_action( 'pixelgrade_after_footer', 'vasco_output_search_overlay', 16 );
		add_action( 'pixelgrade_after_footer', 'vasco_output_menu_label', 25 );

		/**
		 * Enable support for the Style Manager Customizer section (via Customify).
		 */
		add_theme_support( 'customizer_style_manager' );
	}
}
add_action( 'after_setup_theme', 'vasco_pro_setup' );

/**
 * Register Footer sidebar for the Pro version.
 */
function vasco_pro_footer_sidebar() {


}
add_action( 'widgets_init', 'vasco_pro_footer_sidebar', 31 );

function vasco_pro_custom_widgets_init() {
	/**
     * Promo Box Widget available only in PRO version
     */
	$path = pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-PromoBoxWidget.php' );
	if ( ! empty( $path ) ) {
		require_once $path;
		register_widget( 'Pixelgrade_PromoBoxWidget' );
	}
}
add_action( 'widgets_init', 'vasco_pro_custom_widgets_init', 32 );

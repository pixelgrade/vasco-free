<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package Vasco
 * @since 2.3.0
 */


/**
 * Sets up pro theme features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vasco_pro_setup() {

	add_action( 'pixelgrade_before_header', 'vasco_announcement_bar', 5 );
	add_action( 'pixelgrade_after_header', 'vasco_the_toolbar', 10 );
	add_action( 'pixelgrade_footer_after_content', 'vasco_the_footer_search_trigger', 30 );

	/**
	 * Enable support for the Style Manager Customizer section (via Customify).
	 */
	add_theme_support( 'customizer_style_manager' );
}
add_action( 'after_setup_theme', 'vasco_pro_setup' );

/**
 * Output side toolbar
 */
function vasco_the_toolbar() {

	get_template_part( 'template-parts/toolbar' );
}

function vasco_pro_custom_widgets_init() {
	/**
	 * Promo Box Widget available only in the PRO version
	 */
	$path = pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-PromoBoxWidget.php' );
	if ( ! empty( $path ) ) {
		require_once $path;
		register_widget( 'Pixelgrade_PromoBoxWidget' );
	}
}
add_action( 'widgets_init', 'vasco_pro_custom_widgets_init', 32 );

/**
 * Display the announcement bar.
 */
function vasco_announcement_bar() {
	if ( pixelgrade_option( 'show_announcement_bar' ) ) {
		get_template_part( 'template-parts/announcement-bar' );
	}
}

function vasco_blobs_preset_body_attribute( $attributes ) {
	$attributes['data-blobs-preset'] = pixelgrade_option( 'blobs_preset', 357 );
	$attributes['data-blobs-complexity'] = pixelgrade_option( 'blobs_complexity', 84 );
	return $attributes;
}
add_filter( 'pixelgrade_body_attributes', 'vasco_blobs_preset_body_attribute' );

/**
 * Display blobs for the footer.
 */
function vasco_add_blobs_to_footer() {
	// Show the blobs only if allowed to by the user
	if ( pixelgrade_option( 'show_blobs', false ) ) {
		get_template_part( 'template-parts/content-blob-footer' );
	}
}
add_action( 'pixelgrade_footer_before_content', 'vasco_add_blobs_to_footer', 10 );

function vasco_product_blobs() {
	if ( pixelgrade_option( 'show_blobs' ) ) {
		get_template_part( 'template-parts/content-blob' );
	}
}
add_action( 'woocommerce_before_single_product_summary', 'vasco_product_blobs', 9 );

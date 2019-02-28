<?php
/**
 * Handle the specific Components integration.
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Setup components by adding support for the ones needed.
 */
function vasco_setup_components() {
	/*
	 * Declare support for the Pixelgrade Components the theme uses.
	 * Please note that some components will load regardless (like Base, Blog, Header, Footer).
	 * It is safe although to declare support for all that you use (for future proofing).
	 */
	add_theme_support( 'pixelgrade-base-component' );
	add_theme_support( 'pixelgrade-blog-component' );
	add_theme_support( 'pixelgrade-header-component' );
	add_theme_support( 'pixelgrade-footer-component' );
	add_theme_support( 'pixelgrade-gallery-settings-component' );

	if ( pixelgrade_user_has_access( 'woocommerce' ) ) {
		add_theme_support( 'pixelgrade-woocommerce-component' );
	}
}
add_action( 'after_setup_theme', 'vasco_setup_components', 10 );

/**
 * Customize the Header component config.
 *
 * @param array $config
 *
 * @return array
 */
function vasco_customize_header_config( $config ) {
	// We will remove the Jetpack Social Menu from the header as we will display it in the side toolbar.
	unset( $config['menu_locations']['jetpack-social-menu'] );

	return $config;
}
add_filter( 'pixelgrade_header_config', 'vasco_customize_header_config', 10, 1 );

/**
 * Customize the Footer component config.
 *
 * @param array $config
 *
 * @return array
 */
function vasco_customize_footer_config( $config ) {
	// Don't output empty markup in the footer
	$config['zones']['middle']['display_blank'] = false;
	$config['zones']['bottom']['display_blank'] = false;

	if ( ! pixelgrade_user_has_access( 'pro-features' ) ) {
		unset( $config['sidebars']['sidebar-footer'] );
	}

	return $config;
}
add_filter( 'pixelgrade_footer_config', 'vasco_customize_footer_config', 10, 1 );

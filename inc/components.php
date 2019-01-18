<?php
/**
 * Handle the specific Components integration.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Vasco
 * @since 1.0.0
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

function vasco_customize_footer_config( $config ) {
	// Don't output empty markup in the footer
	$config['zones']['middle']['display_blank'] = false;
	$config['zones']['bottom']['display_blank'] = false;

	return $config;
}
add_filter( 'pixelgrade_footer_config', 'vasco_customize_footer_config', 10, 1 );

<?php
/**
 * Vasco Theme admin dashboard logic.
 *
 * @package Vasco
 */

function vasco_lite_admin_setup() {

	/**
	 * Load and initialize Pixelgrade Care notice logic.
	 */
	require_once 'pixcare-notice/class-notice.php';
	PixelgradeCare_Install_Notice::init();
}
add_action( 'after_setup_theme', 'vasco_lite_admin_setup' );

function vasco_lite_admin_assets() {
	wp_enqueue_style( 'vasco_lite_admin_style', get_template_directory_uri() . '/inc/lite/admin/css/admin.css', array(), '1.3.4.3', false );
}
add_action( 'admin_enqueue_scripts', 'vasco_lite_admin_assets' );

<?php
/**
 * Vasco Lite admin logic.
 *
 * @package Vasco Lite
 */

function vasco_lite_admin_setup() {

	/**
	 * Load and initialize Pixelgrade Assistant notice logic.
	 * @link https://wordpress.org/plugins/pixelgrade-assistant/
	 */
	require_once trailingslashit( get_template_directory() ) . 'inc/lite/admin/pixelgrade-assistant-notice/class-notice.php';
	PixelgradeAssistant_Install_Notice::init();
}
add_action('after_setup_theme', 'vasco_lite_admin_setup' );

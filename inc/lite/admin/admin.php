<?php
/**
 * Vasco Theme admin dashboard logic.
 *
 * @package Vasco
 */

function vasco_lite_admin_assets() {
	wp_enqueue_style( 'vasco_lite_admin_style', get_template_directory_uri() . '/inc/lite/admin/css/admin.css', array(), '1.3.5', false );
}
add_action( 'admin_enqueue_scripts', 'vasco_lite_admin_assets' );

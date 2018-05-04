<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Components
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	throw new Exception( "Could not find $_tests_dir/includes/functions.php, have you run .bin/install-wp-tests.sh ?" );
}

require __DIR__ . '/vendor/autoload.php';

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

function _register_theme() {

	$theme_dir = dirname( __FILE__, 3 );
	$theme_root = dirname( $theme_dir );
	$current_theme = basename( $theme_dir );

	register_theme_directory( $theme_root );

	add_filter( 'pre_option_template', function() use ( $current_theme ) {
		return $current_theme;
	});
	add_filter( 'pre_option_template_root', function() use ( $theme_root ) {
		return $theme_root;
	});
	add_filter( 'pre_option_stylesheet', function() use ( $current_theme ) {
		return $current_theme;
	});
	add_filter( 'pre_option_stylesheet_root', function() use ( $theme_root ) {
		return $theme_root;
	});
}
tests_add_filter( 'muplugins_loaded', '_register_theme' );



// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
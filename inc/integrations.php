<?php
/**
 * Require files that deal with various plugins integrations.
 *
 * @codingStandardsIgnoreFile
 * phpcs:ignoreFile
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Load Customify compatibility file.
 * http://pixelgrade.com/
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/customify.php' );

/**
 * Load Jetpack compatibility file.
 * https://jetpack.me/
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/jetpack.php' );

/**
 * Load WP Instagram Widget compatibility file.
 * https://wordpress.org/plugins/wp-instagram-widget/
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/wp-instagram-widget.php' );

/**
 * Load Starter Content Exporter compatibility file.
 * https://github.com/pixelgrade/starter_content_exporter
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/starter_content_exporter.php' );

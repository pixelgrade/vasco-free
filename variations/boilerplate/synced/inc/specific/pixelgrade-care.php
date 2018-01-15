<?php
/**
 * Handle the specific Pixelgrade Care integration.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Bobo
 * @since 1.0.0
 */

function bobo_setup_pixelgrade_care() {
	/*
	 * Declare support for Pixelgrade Care
	 */
	add_theme_support( 'pixelgrade_care', array(
			'support_url'   => 'https://pixelgrade.com/docs/bobo/',
			'changelog_url' => 'https://wupdates.com/bobo-changelog',
		)
	);
}
add_action( 'after_setup_theme', 'bobo_setup_pixelgrade_care', 10 );
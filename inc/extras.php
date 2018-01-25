<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bobo
 * @since 1.0.0
 */

/**
 * Generate the YoungSerif font URL
 *
 * @since Bobo 1.0
 *
 * @return string
 */
function bobo_youngserif_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by YoungSerif, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$youngserif = esc_html_x( 'on', 'YoungSerif font: on or off', '__theme_txtd' );
	if ( 'off' !== $youngserif ) {
		return get_template_directory_uri() . '/assets/fonts/youngserif/stylesheet.css';
	}

	return '';
}

/**
 * Generate the HK Grotesk font URL
 *
 * @since Bobo 1.0
 *
 * @return string
 */
function bobo_hkgrotesk_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by HK Grotesk, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$hkgrotesk = esc_html_x( 'on', 'HK Grotesk font: on or off', '__theme_txtd' );
	if ( 'off' !== $hkgrotesk ) {
		return get_template_directory_uri() . '/assets/fonts/hkgrotesk/stylesheet.css';
	}

	return '';
}


/**
 * Generate the Bebas Neue font URL
 *
 * @since Bobo 1.0
 *
 * @return string
 */
function bobo_bebasneue_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by Bebas Neue, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$bebasneue = esc_html_x( 'on', 'Bebas Neue font: on or off', '__theme_txtd' );
	if ( 'off' !== $bebasneue ) {
		return get_template_directory_uri() . '/assets/fonts/bebasneue/stylesheet.css';
	}

	return '';
}

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $buttons The buttons in the advanced buttons bar (the second bar) of the TinyMCE editor.
 *
 * @return array
 */
function bobo_mce_editor_buttons( $buttons ) {
	// Add the styleselect entry at the beginning of the array
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'bobo_mce_editor_buttons', 10, 1 );

/**
 * Add styles/classes to the "Styles" drop-down.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $settings The settings for TinyMCE before initialization.
 *
 * @return array
 */
function bobo_mce_before_init( $settings ) {

	$style_formats = array(
		array( 'title' => esc_html__( 'Display', '__theme_txtd' ), 'block' => 'h1', 'classes' => 'h0' ),
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro' ),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array( 'title' => esc_html__( 'Button', '__theme_txtd' ), 'selector' => 'a', 'classes' => 'button' ),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'bobo_mce_before_init', 10, 1 );

/**
 * Display blobs for the footer.
 */
function bobo_add_blobs_to_footer() {
	// Show the blobs only if allowed to by the user
	if ( pixelgrade_option( 'show_blobs', false ) ) {
		get_template_part( 'template-parts/content-blob-footer' );
	}
}
add_action( 'pixelgrade_footer_after_content', 'bobo_add_blobs_to_footer', 10 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bobo_body_classes( $classes ) {

	$classes[] = 'has-toolbar';

	return $classes;
}
add_filter( 'body_class', 'bobo_body_classes' );

/**
 * Output mobile search trigger icon
 */
function bobo_output_footer_search_trigger() {
	echo '<div class="js-search-trigger  js-mobile-search-trigger"></div>';
}
add_action( 'pixelgrade_footer_after_content', 'bobo_output_footer_search_trigger' );

/**
 * Customize the Header component config.
 *
 * @param array $config
 *
 * @return array
 */
function bobo_customize_header_config( $config ) {
	// Don't output empty markup
	$config['zones']['left']['display_blank'] = false;
	$config['zones']['right']['display_blank'] = false;

	// The Social Menu should be in the left zone
	unset($config['menu_locations']['jetpack-social-menu']);

	return $config;
}
add_filter( 'pixelgrade_header_config', 'bobo_customize_header_config', 10, 1 );

/**
 * Output side toolbar
 */
function bobo_output_toolbar() {
	get_template_part( 'template-parts/toolbar' );
}
add_action( 'pixelgrade_after_header', 'bobo_output_toolbar', 10 );

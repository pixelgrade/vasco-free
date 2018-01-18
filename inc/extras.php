<?php

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

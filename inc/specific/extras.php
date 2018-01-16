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
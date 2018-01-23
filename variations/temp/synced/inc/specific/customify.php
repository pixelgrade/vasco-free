<?php
/**
 * Custom functions related to Customify.
 *
 * Some of the Customify controls come straight from components.
 * If you need to customize the settings for those controls you can use the appropriate filter.
 * For details search for the addCustomifyOptions() method in the main component class (usually in class-ComponentName.php).
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Temp
 * @since 1.0.0
 */

add_filter( 'pixelgrade_customify_general_section_options', 'temp_change_customify_general_section', 20, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'temp_change_customify_header_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'temp_change_customify_main_content', 20, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'temp_change_customify_buttons', 20, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'temp_change_customify_footer_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'temp_change_customify_blog_grid_section', 20, 2 );

define( 'VARIATION_TEXT_COLOR', '#2B3D39' );
define( 'VARIATION_ACCENT_COLOR', '#DE2D16' );

define( 'VARIATION_BODY_FONT', 'Lora' );
define( 'VARIATION_HEADINGS_FONT', 'YoungSerif' );
define( 'VARIATION_HEADINGS_FONT_ALT', 'HK Grotesk' );
define( 'VARIATION_SITE_TITLE_FONT', 'Bebas Neue' );

/**
 * Modify the Customify config for the General Section - it comes from the Blog Component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_general_section( $section_options, $options ) {

	$modified_config = array(
		'general' => array(
			'options' => array(
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

/**
 * Modify the Customify config for the Main Content Section - it comes from the Blog Component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_main_content( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$modified_config = array(
		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_body_text_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'body',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.entry-content .dropcap, 
								.entry-content .cats[class] > a,
								.single .header-meta .byline, 
								.single .header-meta .posted-on,
								.comment-form .form-submit .submit',
						),
					),
				),
				'main_content_body_link_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_body_link_active_color'   => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'main_content_heading_1_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_2_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_3_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_4_color'          => array(
					'default' => VARIATION_ACCENT_COLOR,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.entry-content h4, .h4, h4, .single .entry-header .cats',
						),
					),
				),
				'main_content_heading_5_color'          => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'main_content_heading_6_color'          => array(
					'default' => VARIATION_ACCENT_COLOR,
				),

				// [Sub Section] Backgrounds
				'main_content_content_background_color' => array(
					'default' => '#F5F6F1',
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.u-content-background, .mce-content-body, .related-posts-title span',
						),
						array(
							'property' => 'color',
							'selector' => '
								.entry-content .dropcap, 
								.single .header-meta .byline, 
								.single .header-meta .posted-on,
								.entry-content .cats[class] > a,
								.comment-form .form-submit .submit',
						),
					),
				),

				// [Section] FONTS
				'main_content_page_title_font'          => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-size'      => 72,
						'line-height'    => 1.11,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 17,
						'line-height'    => 1.647,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_paragraph_text_font' => array(
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.66,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// [Sub Section] Headings Fonts
				'main_content_heading_1_font'   => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 48,
						'line-height'    => 1.167,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 24,
						'line-height'    => 1.417,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 19,
						'line-height'    => 1.21,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_5_font' => array(
					'selector' => '
						.entry-content h5, .h5, h5, 
						.nav-links__label',
					'default'  => array(
						'font-family'    => VARIATION_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 14,
						'line-height'    => 1.25,
						'letter-spacing' => 0.07,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 12,
						'line-height'    => 1.25,
						'letter-spacing' => 0.08,
						'text-transform' => 'uppercase',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

/**
 * Modify the Customify config for the Buttons Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_buttons( $section_options, $options ) {

	$button_selector = '
		.c-btn,
		.c-card__action,
		button[type=button],
		button[type=reset],
		button[type=submit],
		input[type=button],
		input[type=submit],
		.widget_pages,
		.featured-posts__more';

	$modified_config = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_color'      => array(
					'default' => VARIATION_ACCENT_COLOR,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => $button_selector,
						),
					),
				),
				'buttons_text_color' => array(
					'default' => '#FFFFFF',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => $button_selector,
						),
					),
				),
				'buttons_font'       => array(
					'selector' => $button_selector,
					'default'  => array(
						'font-family'    => VARIATION_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 17,
						'line-height'    => 1.94,
						'letter-spacing' => 0,
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}


/**
 * Modify the Customify config for the Blog Grid Section - from the Base component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$modified_config = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				// [Section] Layout
				'blog_items_aspect_ratio'        => array(
					'default' => 50,
				),
				'blog_items_vertical_spacing'    => array(
					'default' => 32,
				),
				'blog_items_horizontal_spacing'  => array(
					'default' => 32,
				),
				// [Section] COLORS
				'blog_item_title_color'          => array(
					'default' => '#333131',
				),
				'blog_item_meta_primary_color'   => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'blog_item_meta_secondary_color' => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				// [Section] FONTS
				'blog_item_title_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'default' => array(
						'font-family'    => VARIATION_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 13,
						'line-height'    => 1.1,
						'letter-spacing' => 0.1,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font'         => array(
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => '400',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}


/**
 * Modify the Customify config for the Header Component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_header_section_options( $section_options, $options ) {

	$modified_config = array(
		'header_section' => array(
			'options' => array(
				// [Section] Layout
				'header_navigation_links_spacing' => array(
					'default' => 56,
				),
				// [Section] Colors
				'header_navigation_links_color'   => array(
					'default' => '#323232',
				),
				'header_links_active_color'       => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'header_background'               => array(
					'default' => '#F5F6F1',
				),
				'header_site_title_font'          => array(
					'fields'  => array(
						'font-size' => array(
							'max' => 150,
						),
					),
					'default' => array(
						'font-family'    => VARIATION_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 30,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'          => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none'
					),
				),
			),
		),
	);

	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}


/**
 * Modify the Customify config for the Footer Component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array The modified specific config
 */
function temp_change_customify_footer_section_options( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$modified_config = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				'footer_top_spacing'     => array(
					'default' => 80,
					'css'     => array(
						// Component
						array(
							'property'        => 'padding-top',
							'selector'        => '.u-footer-top-spacing',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						// Custom for Julia/Felt
						array(
							'property'        => 'margin-top',
							'selector'        => '.c-footer__zone:not(:empty)+.c-footer__zone',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'footer_bottom_spacing'  => array(
					'default' => 56,
					'css'     => array(
						// Component
						array(
							'property'        => 'padding-bottom',
							'selector'        => '.u-footer-bottom-spacing',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						// Custom for Julia/Felt
						array(
							'property'        => 'padding-top',
							'selector'        => '.c-footer__zone--bottom:not(:first-child)',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				// [Section] COLORS
				'footer_body_text_color' => array(
					'default' => '#2B3D39',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer, .widget.dark'
						),
					),
				),
				'footer_links_color'     => array(
					'default' => '#2B3D39'
				),
				'footer_background'      => array(
					'default' => '#F5F6F1',
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.u-footer-background, .widget.dark',
						),
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

// Custom single post header width for the case in which there is no sidebar.
// In this case, the header's width is container-width + sidebar-width (300)
// @todo Are these needed in the BOILERPLATE and is their place here?
function temp_container_width_single_header( $value, $selector, $property, $unit ) {
	$output = '';
	$value  = $value - 300;

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . $value . $unit . ';' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}

function temp_single_header_width( $value, $selector, $property, $unit ) {
	$output = '';

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . ( $value + 300 + 112 + 56 ) . 'px;' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}
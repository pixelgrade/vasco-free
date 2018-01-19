<?php
/**
 * Bobo Customizer Options Config
 *
 * @package Bobo
 * @since 1.0.0
 */

/**
 * Hook into the Customify's fields and settings.
 *
 * The config can turn to be complex so is better to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param $options array - Contains the plugin's options array right before they are used, so edit with care
 *
 * @return mixed The return of options is required, if you don't need options return an empty array
 *
 */

/* =============
 * For customizing the components Customify options you need to use the /inc/components.php file.
 * Also there you will find the example code for making changes.
 * ============= */

add_filter( 'customify_filter_fields', 'bobo_add_customify_options', 11, 1 );

// Modify Customify Config
add_filter( 'pixelgrade_customify_general_section_options', 'bobo_customify_general_section', 10, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'bobo_customify_header_section', 10, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'bobo_customify_main_content_section', 10, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'bobo_customify_buttons_section', 10, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'bobo_customify_footer_section', 10, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'bobo_customify_blog_grid_section', 10, 2 );

function bobo_add_customify_options( $options ) {
	$options['opt-name'] = 'bobo_options';

	//start with a clean slate - no Customify default sections
	$options['sections'] = array();

	return $options;
}

/**
 * Modify the Customify config for the General Section - from the Base component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $general_section The modified specific config
 */
function bobo_customify_general_section( $section_options, $options ) {

	$new_section_options = array(
		// General
		'general' => array(
			'options' => array(
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	// Remove Ajax Loading Option
	unset( $section_options['general']['options']['use_ajax_loading'] );

	return $section_options;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_main_content_section( $section_options, $options ) {

	$new_section_options = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_container_width'          => array(
					'default' => 1300,
				),
				'main_content_container_sides_spacing'  => array(
					'default' => 42,
				),
				'main_content_container_padding'        => array(
					'default' => 0,
				),
				'main_content_content_width'            => array(
					'default' => 720,
				),
				'main_content_border_width'             => array(
					'default' => 0,
				),
				'main_content_border_color'             => array(
					'default' => '#F7F6F5',
				),

				// [Section] COLORS
				'main_content_page_title_color'         => array(
					'default' => '#222222',
				),
				'main_content_body_text_color'          => array(
					'default' => '#383c50',
				),
				'main_content_body_link_color'          => array(
					'default' => '#383c50',
				),
				'main_content_body_link_active_color'   => array(
					'default' => '#222222',
				),
				'main_content_underlined_body_links'    => array(
					'default' => 1,
				),

				// [Sub Section] Headings Color
				'main_content_heading_1_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_2_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_3_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_4_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_5_color'          => array(
					'default' => '#383c50',
					'css' => array(
						array(
							'selector' => '.nav-links__label',
							'property' => 'color'
						),
					),
				),
				'main_content_heading_6_color'          => array(
					'default' => '#383c50',
				),
				'main_content_page_title_font' => array(
					'selector' => '.single .entry-title, .page .entry-title, .h0[class]'
				),

				// [Sub Section] Backgrounds
				'main_content_content_background_color' => array(
					'default' => '#F5F6F1',
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	$section_options['main_content']['options'] = Pixelgrade_Array::insertAfterKey( $section_options['main_content']['options'], 'main_content_quote_block_font', array(
		'main_content_badge_font' => array(
			'type'        => 'font',
			'label'       => esc_html__( 'Badge Font', '__components_txtd' ),
			'desc'        => '',
			'selector'    => '.single .header-meta, .entry-content .cats[class] > a',
			'callback'    => 'typeline_font_cb',

			'default' => array(
				'font-family'    => VARIATION_SITE_TITLE_FONT,
				'font-weight'    => 'regular',
				'font-size'      => 19,
				'line-height'    => 1.21,
				'letter-spacing' => 0,
				'text-transform' => 'none',
			),

			// Sub Fields Configuration (optional)
			'fields'      => array(
				'font-size'       => array(                           // Set custom values for a range slider
					'min'  => 8,
					'max'  => 90,
					'step' => 1,
					'unit' => 'px',
				),
				'line-height'     => array( 0, 2, 0.1, '' ),
				// Short-hand version
				'letter-spacing'  => array( - 1, 2, 0.01, 'em' ),
				'text-align'      => false,
				// Disable sub-field (False by default)
				'text-transform'  => true,
				'text-decoration' => false,
			),
		),
	) );

	return $section_options;
}

/**
 * Buttons Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_buttons_section( $section_options, $options ) {

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_style' => array(
					'default' => 'solid'
				),
				'buttons_shape' => array(
					'default' => 'rounded'
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Blog Grid Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				'blog_grid_width'                    => array(
					'default' => 1300,
				),
				'blog_container_sides_spacing'       => array(
					'default' => 42,
				),
				'blog_grid_layout'                   => array(
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'default' => 133,
				),
				'blog_items_per_row'                 => array(
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'default' => 42,
				),
				'blog_items_horizontal_spacing'      => array(
					'default' => 42,
				),
				// [Sub Section] Items Title
				'blog_items_title_position'          => array(
					'default' => 'below',
				),
				'blog_items_title_alignment_nearby'  => array(
					'default' => 'left',
				),
				'blog_items_title_alignment_overlay' => array(
					'default' => 'middle-center',
				),
				// Title Visiblity
				'blog_items_title_visibility'        => array(
					'default' => 1,
				),
				// Excerpt Visiblity
				'blog_items_excerpt_visibility'      => array(
					'default' => 1,
				),
				// [Sub Section] Items Meta
				'blog_items_primary_meta'            => array(
					'default' => 'category',
				),
				'blog_items_secondary_meta'          => array(
					'default' => 'date',
				),
				'blog_item_title_color'              => array(
					'default' => '#383c50',
				),
				'blog_item_meta_primary_color'       => array(
					'default' => '#383c50',
				),
				'blog_item_meta_secondary_color'     => array(
					'default' => '#383c50',
				),
				'blog_item_thumbnail_background'     => array(
					'default' => '#000000',
				),
				'blog_item_excerpt_color'              => array(
					'default' => '#383c50',
				),

				// [Sub Section] Thumbnail Hover
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
				),
				'blog_item_title_font' => array(
					'selector' => '.c-card__title, .c-card__letter',
				),
				'blog_item_meta_font' => array(
					'selector' => '.c-meta__primary, .c-meta__secondary',
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Header Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_header_section( $section_options, $options ) {

	$new_section_options = array(
		'header_section' => array(
			'options' => array(
				'header_logo_height'              => array(
					'default' => 30,
				),
				'header_height'                   => array(
					'default' => 87,
				),
				'header_navigation_links_spacing' => array(
					'default' => 56,
				),
				'header_position'                 => array(
					'default' => 'sticky',
				),
				'header_width'                    => array(
					'default' => 'full',
				),
				'header_sides_spacing'            => array(
					'default' => 42,
				),
				'header_navigation_links_color'   => array(
					'default' => '#252525',
				),
				'header_links_active_color'       => array(
					'default' => '#161616',
				),
				'header_links_active_style'       => array(
					'default' => 'active',
				),
				'header_background'               => array(
					'default' => '#E7F2F8',
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Footer Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_footer_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				// [Section] Layout
				'copyright_text'               => array(
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'           => array(
					'default' => 112,
				),
				'footer_bottom_spacing'        => array(
					'default' => 112,
				),
				'footer_hide_back_to_top_link' => array(
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'default' => false,
				),
				'footer_layout'                => array(
					'default' => 'stacked',
				),
				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default' => '#383c50',
				),
				'footer_links_color'           => array(
					'default' => '#161616',
				),
				'footer_background'            => array(
					'default' => '#f7f6f5',
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

function bobo_add_customify_theme_fonts( $fonts ) {
	$fonts['YoungSerif'] = array(
		'family'   => 'YoungSerif',
		'src'      => get_template_directory_uri() . '/assets/fonts/youngserif/stylesheet.css',
		'variants' => array( 'regular' )
	);

	$fonts['HK Grotesk'] = array(
		'family'   => 'HK Grotesk',
		'src'      => get_template_directory_uri() . '/assets/fonts/hkgrotesk/stylesheet.css',
		'variants' => array( '300', '400', '500', '700' )
	);

	$fonts['Bebas Neue'] = array(
		'family'   => 'Bebas Neue',
		'src'      => get_template_directory_uri() . '/assets/fonts/bebasneue/stylesheet.css',
		'variants' => array( 'regular' )
	);

	return $fonts;
}
add_filter( 'customify_theme_fonts', 'bobo_add_customify_theme_fonts' );

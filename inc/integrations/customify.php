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
 * The config can turn to be complex so is best to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param array $options Contains the plugin's options array right before they are used, so edit with care
 *
 * @return array The returned options are required, if you don't need options return an empty array
 */
add_filter( 'customify_filter_fields', 'bobo_add_customify_options', 11, 1 );

// Modify Customify Config
add_filter( 'pixelgrade_customify_general_section_options', 'bobo_customify_general_section', 10, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'bobo_customify_header_section', 10, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'bobo_customify_main_content_section', 10, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'bobo_customify_buttons_section', 10, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'bobo_customify_footer_section', 10, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'bobo_customify_blog_grid_section', 10, 2 );

define( 'THEME_TEXT_COLOR', '#2B3D39' );
define( 'THEME_ACCENT_COLOR', '#DE2D16' );

define( 'THEME_BODY_FONT', 'Lora' );
define( 'THEME_HEADINGS_FONT', 'YoungSerif' );
define( 'THEME_HEADINGS_FONT_ALT', 'HK Grotesk' );
define( 'THEME_SITE_TITLE_FONT', 'Bebas Neue' );

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
				'general_options_customizer_tabs'      => array(
					'type' => 'html',
					'html' => '<nav class="section-navigation  js-section-navigation">
							<a href="#section-title-general-blobs">' . esc_html__( 'Blobs', '__theme_txtd' ) . '</a>
							<a href="#section-title-general-stamps">' . esc_html__( 'Stamps', '__theme_txtd' ) . '</a>
							</nav>',
				),
				// [Section] Blobs
				'general_title_blobs_section'         => array(
					'type' => 'html',
					// @todo Adjust the section icon
					'html' => '<span id="section-title-general-blobs" class="separator section label large">&#x1f4d0; ' . esc_html__( 'Blobs', '__theme_txtd' ) . '</span>',
				),
				'show_blobs'           => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show Blobs', '__theme_txtd' ),
					'default' => true,
				),
				'blob_main_color'      => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Blobs Main Color', '__theme_txtd' ),
					'live'    => true,
					'default' => '#DE2D16',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.blob__part--1',
						),
					),
				),
				'blob_secondary_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Blobs Secondary Color', '__theme_txtd' ),
					'live'    => true,
					'default' => '#FFDCCE',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.blob__part--2',
						),
					),
				),
				'blob_tertiary_color'  => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Blobs Tertiary Color', '__theme_txtd' ),
					'live'    => true,
					'default' => '#171512',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.blob__part--3',
						),
					),
				),

				// [Section] Stamps
				'general_title_stamps_section'         => array(
					'type' => 'html',
					// @todo Adjust the section icon
					'html' => '<span id="section-title-general-stamps" class="separator section label large">&#x1f4d0; ' . esc_html__( 'Stamps', '__theme_txtd' ) . '</span>',
				),
				'show_stamps'       => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show Stamps', '__theme_txtd' ),
					'default' => true,
				),
				'stamp_style'       => array(
					'type'    => 'radio',
					'label'   => esc_html__( 'Stamp Style', '__theme_txtd' ),
					'desc'    => esc_html__( 'Set how the stamp is defined.', '__theme_txtd' ),
					'default' => 'auto',
					'choices' => array(
						'auto'   => esc_html__( 'Auto-Generated', '__theme_txtd' ),
						'custom' => esc_html__( 'Custom Image', '__theme_txtd' ),
					),
				),
				'stamp_text'        => array(
					'type'              => 'text',
					'label'             => esc_html__( 'Stamp Text', '__theme_txtd' ),
					'desc'              => esc_html__( 'Set the text that will appear around the stamp.', '__theme_txtd' ),
					'default'           => '%site_title%',
					'sanitize_callback' => 'wp_kses_post',
					//@todo Adjust this class according to the stamp markup
					'live'              => array( '.c-stamp__text' ),
					'active_callback'   => 'bobo_stamp_text_control_show',
				),
				'stamp_icon'        => array(
					'type'            => 'select',
					'label'           => esc_html__( 'Stamp Icon', '__theme_txtd' ),
					'desc'            => esc_html__( 'Select an icon to be placed in the middle of the stamp.', '__theme_txtd' ),
					'default'         => 'star',
					'choices'         => array(
						'backpack' => esc_html__( 'Backpack', '__theme_txtd' ),
						'bike'     => esc_html__( 'Bike', '__theme_txtd' ),
						'cabin'    => esc_html__( 'Cabin', '__theme_txtd' ),
						'campfire' => esc_html__( 'Campfire', '__theme_txtd' ),
						'compass'  => esc_html__( 'Compass', '__theme_txtd' ),
						'mountain' => esc_html__( 'Mountain', '__theme_txtd' ),
						'radio'    => esc_html__( 'Radio', '__theme_txtd' ),
						'star'     => esc_html__( 'Star', '__theme_txtd' ),
						'tent'     => esc_html__( 'Tent', '__theme_txtd' ),
						'torch'    => esc_html__( 'Torch', '__theme_txtd' ),
					),
					'active_callback' => 'bobo_stamp_icon_control_show',
				),
				'stamp_dark_image'  => array(
					'type'            => 'media',
					'label'           => esc_html__( 'Dark Stamp Image', '__theme_txtd' ),
					'desc'            => '',
					'active_callback' => 'bobo_stamp_dark_image_control_show',
				),
				'stamp_light_image' => array(
					'type'            => 'media',
					'label'           => esc_html__( 'Light Stamp Image', '__theme_txtd' ),
					'desc'            => '',
					'active_callback' => 'bobo_stamp_light_image_control_show',
				),
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

	$modified_config = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_container_width'          => array(
					'default' => 1240,
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
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_body_text_color'          => array(
					'default' => THEME_TEXT_COLOR,
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
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_body_link_active_color'   => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'main_content_underlined_body_links'    => array(
					'default' => 1,
				),

				// [Sub Section] Headings Color
				'main_content_heading_1_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_2_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_3_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_4_color'          => array(
					'default' => THEME_ACCENT_COLOR,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.entry-content h4, .h4, h4, .single .entry-header .cats',
						),
					),
				),
				'main_content_heading_5_color'          => array(
					'default' => THEME_ACCENT_COLOR,
					'css' => array(
						array(
							'selector' => '.nav-links__label',
							'property' => 'color'
						),
					),
				),
				'main_content_heading_6_color'          => array(
					'default' => THEME_ACCENT_COLOR,
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
					'selector' => '.single .entry-title, .page .entry-title, .h0[class]',
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-size'      => 72,
						'line-height'    => 1.11,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 17,
						'line-height'    => 1.647,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_paragraph_text_font' => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.66,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
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
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 48,
						'line-height'    => 1.167,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 24,
						'line-height'    => 1.417,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
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
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 14,
						'line-height'    => 1.25,
						'letter-spacing' => 0.07,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 12,
						'line-height'    => 1.25,
						'letter-spacing' => 0.08,
						'text-transform' => 'uppercase',
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	$section_options['main_content']['options'] = Pixelgrade_Array::insertAfterKey( $section_options['main_content']['options'], 'main_content_quote_block_font', array(
		'main_content_badge_font' => array(
			'type'        => 'font',
			'label'       => esc_html__( 'Badge Font', '__theme_txtd' ),
			'desc'        => '',
			'selector'    => '
				.single .header-meta .byline, 
				.single .header-meta .posted-on, 
				.entry-content .cats[class] > a',
			'callback'    => 'typeline_font_cb',

			'default' => array(
				'font-family'    => THEME_SITE_TITLE_FONT,
				'font-weight'    => '400',
				'font-size'      => 19,
				'line-height'    => 1.21,
				'letter-spacing' => 0.052,
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
				'letter-spacing'  => array( -1, 2, 0.01, 'em' ),
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
				'buttons_style' => array(
					'default' => 'solid',
				),
				'buttons_shape' => array(
					'default' => 'rounded',
				),
				'buttons_color'      => array(
					'default' => THEME_ACCENT_COLOR,
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
						'font-family'    => THEME_HEADINGS_FONT_ALT,
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
	$modified_config = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				// [Section] Layout
				'blog_grid_width'                    => array(
					'default' => 1240,
				),
				'blog_container_sides_spacing'       => array(
					'default' => 42,
				),
				// [Sub Section] Items Grid
				'blog_grid_layout'                   => array(
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'default' => 50,
				),
				'blog_items_per_row'                 => array(
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'default' => 32,
				),
				'blog_items_horizontal_spacing'      => array(
					'default' => 32,
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

				// [Section] COLORS
				'blog_item_title_color'              => array(
					'default' => '#333131',
				),
				'blog_item_meta_primary_color'       => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_meta_secondary_color'     => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_thumbnail_background'     => array(
					'default' => '#000000',
				),
				'blog_item_excerpt_color'              => array(
					'default' => THEME_ACCENT_COLOR,
				),

				// [Sub Section] Thumbnail Hover
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
				),

				// [Section] FONTS
				'blog_item_title_font'           => array(
					'selector' => '.c-card__title, .c-card__letter',
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'selector' => '.c-meta__primary, .c-meta__secondary',
					'default' => array(
						'font-family'    => THEME_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 13,
						'line-height'    => 1.1,
						'letter-spacing' => 0.1,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font'         => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
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
 * Header Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function bobo_customify_header_section( $section_options, $options ) {

	$modified_config = array(
		'header_section' => array(
			'options' => array(
				// [Section] Layout
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

				// [Section] COLORS
				'header_navigation_links_color'   => array(
					'default' => '#323232',
				),
				'header_links_active_color'       => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'header_links_active_style'       => array(
					'default' => 'active',
				),
				'header_background'               => array(
					'default' => '#F5F6F1',
				),

				// [Section] FONTS
				'header_site_title_font'          => array(
					'fields'  => array(
						'font-size' => array(
							'max' => 150,
						),
					),
					'default' => array(
						'font-family'    => THEME_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 30,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'          => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
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

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

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
	$modified_config = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				// [Section] Layout
				'copyright_text'               => array(
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
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
						// Custom for Bobo
						array(
							'property'        => 'padding-top',
							'selector'        => '.c-footer__zone--bottom:not(:first-child)',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'footer_hide_back_to_top_link' => array(
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'default' => false,
				),
				'footer_layout'                => array(
					'default' => 'row',
				),

				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default' => '#2B3D39',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer, .widget.dark'
						),
					),
				),
				'footer_links_color'           => array(
					'default' => '#2B3D39',
				),
				'footer_background'            => array(
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

/**
 * Add out custom self-hosted fonts to the Customizer font control options.
 *
 * @param array $fonts
 *
 * @return array
 */
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
		'variants' => array( '100', '200', '300', '400', '700' )
	);

	return $fonts;
}
add_filter( 'customify_theme_fonts', 'bobo_add_customify_theme_fonts' );

/* ===============================
 * STAMP CONTROLS CONDITIONALS
 * =============================== */

/**
 * Decides when to show the stamp text control in the Customizer.
 *
 * @return bool
 */
function bobo_stamp_text_control_show() {
	if ( 'auto' !== pixelgrade_option( 'stamp_style' ) ) {
		return false;
	}

	return true;
}

/**
 * Decides when to show the stamp icon control in the Customizer.
 *
 * @return bool
 */
function bobo_stamp_icon_control_show() {
	if ( 'auto' !== pixelgrade_option( 'stamp_style' ) ) {
		return false;
	}

	return true;
}

/**
 * Decides when to show the stamp dark image control in the Customizer.
 *
 * @return bool
 */
function bobo_stamp_dark_image_control_show() {
	if ( 'custom' !== pixelgrade_option( 'stamp_style' ) ) {
		return false;
	}

	return true;
}

/**
 * Decides when to show the stamp light image control in the Customizer.
 *
 * @return bool
 */
function bobo_stamp_light_image_control_show() {
	if ( 'custom' !== pixelgrade_option( 'stamp_style' ) ) {
		return false;
	}

	return true;
}

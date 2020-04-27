<?php
/**
 * Vasco Lite Customizer Options Config
 *
 * @package Vasco
 * @since 1.3.8
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

add_filter( 'customify_filter_fields', 'vasco_lite_add_customify_options', 11, 1 );
add_filter( 'customify_filter_fields', 'vasco_lite_add_customify_style_manager_section', 13, 1 );

add_filter( 'customify_filter_fields', 'vasco_lite_fill_customify_options', 50 );

// Color Constants
define( 'VASCOLITE_SM_COLOR_PRIMARY', '#38c3c8' );
define( 'VASCOLITE_SM_COLOR_SECONDARY', '#f59828' );
define( 'VASCOLITE_SM_COLOR_TERTIARY', '#fb551c' );

define( 'VASCOLITE_SM_DARK_PRIMARY', '#2b2b28' );
define( 'VASCOLITE_SM_DARK_SECONDARY', '#2b3d39' );
define( 'VASCOLITE_SM_DARK_TERTIARY', '#65726f' );

define( 'VASCOLITE_SM_LIGHT_PRIMARY', '#f5f6f1' );
define( 'VASCOLITE_SM_LIGHT_SECONDARY', '#e6f7f7' );
define( 'VASCOLITE_SM_LIGHT_TERTIARY', '#faede8' );

// Font Family Constants
define( 'VASCOLITE_BODY_FONT', 'Lora' );
define( 'VASCOLITE_HEADINGS_FONT', 'YoungSerif' );
define( 'VASCOLITE_HEADINGS_FONT_ALT', 'HK Grotesk' );
define( 'VASCOLITE_SITE_TITLE_FONT', 'Bebas Neue' );

function vasco_lite_add_customify_options( $options ) {
	$options['opt-name'] = 'vasco_options';

	//start with a clean slate - no Customify default sections
	$options['sections'] = array();

	return $options;
}

/**
 * Add the Style Manager cross-theme Customizer section.
 *
 * @param array $options
 *
 * @return array
 */
function vasco_lite_add_customify_style_manager_section( $options ) {
	// If the theme hasn't declared support for style manager, bail.
	if ( ! current_theme_supports( 'customizer_style_manager' ) ) {
		return $options;
	}

	if ( ! isset( $options['sections']['style_manager_section'] ) ) {
		$options['sections']['style_manager_section'] = array();
	}

	$new_config = array(
		'options' => array(
			'sm_color_primary'   => array(
				'default'          => VASCOLITE_SM_COLOR_PRIMARY,
				'connected_fields' => array(
					'blob_secondary_color',
					'announcement_bar_background_color',
					'buttons_color',
				),
			),
			'sm_color_secondary' => array(
				'default'          => VASCOLITE_SM_COLOR_SECONDARY,
				'connected_fields' => array(
					'accent_color',
					'blob_main_color',
					'main_content_body_link_active_color',
					'header_links_active_color',
					'main_content_heading_4_color',
					'main_content_heading_5_color',
					'main_content_heading_6_color',
					'blog_item_meta_primary_color',
					'woocommerce_item_meta_primary_color',
					'blog_item_footer_color',
					'woocommerce_item_footer_color',
				),
			),
			'sm_color_tertiary'  => array(
				'default' => VASCOLITE_SM_COLOR_TERTIARY,
			),
			'sm_dark_primary'    => array(
				'default'          => VASCOLITE_SM_DARK_PRIMARY,
				'connected_fields' => array(
					// DARK COLOR
					'accent_dark_color',
					'blob_tertiary_color',
					'header_navigation_links_color',
					'blog_item_thumbnail_background',
					'woocommerce_item_thumbnail_background',
					'footer_links_color',
					'footer_body_text_color',
				),
			),
			'sm_dark_secondary'  => array(
				'default'          => VASCOLITE_SM_DARK_SECONDARY,
				'connected_fields' => array(
					// TEXT COLOR
					'main_content_body_link_color',
					'main_content_heading_1_color',
					'main_content_heading_2_color',
					'main_content_page_title_color',
					'blog_item_title_color',
					'woocommerce_item_title_color',
					'main_content_heading_3_color',
					'blog_item_excerpt_color',
					'woocommerce_item_excerpt_color',
					'main_content_body_text_color',
				),
			),
			'sm_dark_tertiary'   => array(
				'default' => VASCOLITE_SM_DARK_TERTIARY,
			),
			'sm_light_primary'   => array(
				'default'          => VASCOLITE_SM_LIGHT_PRIMARY,
				'connected_fields' => array(
					'header_background',
					'main_content_content_background_color',
					'footer_background',
					'buttons_text_color',
					'header_submenu_background',
					'main_content_fields_background_color',
					'main_content_border_color',
					'announcement_bar_text_color',
				),
			),
			'sm_light_secondary' => array(
				'default' => VASCOLITE_SM_LIGHT_SECONDARY,
			),
			'sm_light_tertiary'  => array(
				'default' => VASCOLITE_SM_LIGHT_TERTIARY,
			),
		),
	);

	$options['sections']['style_manager_section'] = Pixelgrade_Config::merge( $options['sections']['style_manager_section'], $new_config );

	return $options;
}

function vasco_lite_fill_customify_options( $options ) {
	$buttons = apply_filters( 'pixelgrade_button_selectors_array', array(
		'.c-btn',
		'.button:not(.default)',
		'button[type=button]',
		'button[type=reset]',
		'button[type=submit]',
		'input[type=button]',
		'input[type=submit]',
		'.featured-posts__more',
		'.page-numbers.next[class][class]',
		'.page-numbers.prev[class][class]',
		'.page-numbers.current[class][class]',
		'#infinite-handle[id] span button',
		'[class*=-instagram-feed] p > a',
		'div.wpforms-container[class] .wpforms-form .wpforms-submit',
	) );

	$buttons_default = implode( ',', $buttons );
	$buttons_solid   = implode( ',', array_map( 'vasco_prefix_solid_buttons', $buttons ) );
	$buttons_outline = implode( ',', array_map( 'vasco_prefix_outline_buttons', $buttons ) );

	$buttons_active = implode( ',', array(
			implode( ',', $buttons ),
			implode( ',', array_map( 'vasco_suffix_hover_buttons', $buttons ) ),
			implode( ',', array_map( 'vasco_suffix_active_buttons', $buttons ) ),
			implode( ',', array_map( 'vasco_suffix_focus_buttons', $buttons ) ),
		)
	);

	$new_config = array(
		'general'               => array(
			'title' => '',
			'type'  => 'hidden',
			'options'   => array(
				'accent_color'                           => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.widget_mc4wp_form_widget,
								.accent-image-filter:after, 
								.bypostauthor .comment__avatar:after, 
								.c-author__avatar:after, 
								.c-feature__media:after, 
								.c-location__media:after, 
								.instagram-pics>li a:after,
								.social-instagram-group .vertical-separator:before,
								.widget_callout_box .c-callout__content,
								.c-alert
							',
						),
					),
				),
				'accent_dark_color'                      => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_PRIMARY,
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.c-stamp__container.is-dark,
								.social-instagram-group .widget_wpcom_social_media_icons_widget,
								.social-instagram-group .jetpack_widget_social_icons,
								.widget_promo_box .c-promo,
								.widget_mc4wp_form_widget[class] input[type=submit],
	
								.u-buttons-solid .button.default,
								.u-buttons-solid .c-btn--default[class],
								.u-buttons-solid .not-found .search-form .search-submit,
								.u-buttons-solid .comment-form .form-submit .submit,
								.u-buttons-solid .c-comments-toggle__label
							',
						),
					),
				),
				'blob_main_color'                        => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.blob--color-1',
						),
					),
				),
				'blob_secondary_color'                   => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_PRIMARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.blob--color-2',
						),
					),
				),
				'blob_tertiary_color'                    => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_PRIMARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.blob--color-3',
						),
					),
				),
				'announcement_bar_background_color'      => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_PRIMARY,
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-announcement-bar',
						),
					),
				),
				'announcement_bar_text_color'            => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '
							    .c-announcement-bar .c-announcement-bar__close,
							    .c-announcement-bar .c-announcement-bar__close:hover,
							    .c-announcement-bar .c-announcement-bar__text:hover,
							    .c-announcement-bar .c-announcement-bar__text',
						),
					),
				),
			)
		),
		'header_section'        => array(
			'title'     => '',
			'type'      => 'hidden',
			'options'   => array(
				// [Section] Layout
				'header_logo_height'              => array(
					'type'      => 'hidden_control',
					'default' => 40,
				),
				'header_height'                   => array(
					'type'      => 'hidden_control',
					'default' => 87,
					'css'     => array(
						array(
							'property' => 'height',
							'selector' => '.u-header-height, .c-navbar .sub-menu',
							'unit'     => 'px',
						),
						array(
							'property' => 'padding-top',
							'selector' => '.u-header-height-padding-top',
							'unit'     => 'px',
						),
					),
				),
				'header_navigation_links_spacing' => array(
					'type'      => 'hidden_control',
					'default' => 28,
					'css'     => array(
						array(
							'property'        => 'padding-left',
							'selector'        => '.c-navbar a',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						array(
							'property'        => 'padding-right',
							'selector'        => '.c-navbar a',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'header_position'                 => array(
					'type'      => 'hidden_control',
					'default' => 'sticky',
				),
				'header_width'                    => array(
					'type'      => 'hidden_control',
					'default' => 'full',
				),
				'header_sides_spacing'            => array(
					'type'      => 'hidden_control',
					'default' => 42,
					'css'     => array(
						array(
							'property'        => 'padding-left',
							'selector'        => '.u-header-sides-spacing, .c-navbar__zone',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						array(
							'property'        => 'padding-right',
							'selector'        => '.u-header-sides-spacing, .c-navbar__zone',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						array(
							'property'        => 'right',
							'selector'        => '.site-header-mobile .js-search-trigger',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),

				'header_navigation_links_color'   => array(
					'type'      => 'hidden_control',
					'live'    => true,
					'default' => VASCOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-navbar, .c-navbar li',
						),
					),
				),
				'header_links_active_color'       => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '
								.c-navbar [class*="current-menu"],
								.c-navbar li:hover',
						),
						array(
							'property' => 'border-top-color',
							'selector' => '.c-navbar [class*="children"]:hover:after',
						),
					),
				),
				'header_background'               => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '.u-header-background',
						),
					),
				),
				'header_submenu_background' => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-navbar[class] .sub-menu',
						),
						array(
							'property' => 'color',
							'selector' => '.widget_mc4wp_form_widget,
						.c-stamp__container.is-dark .c-stamp.c-stamp--auto, 
						.c-feature__content, 
						.c-location__content,
						.c-alert,
						.c-callout__content,
						.c-promo__content,
						.c-promo__media .c-stamp',
						),
					),
				),

				// [Section] FONTS
				'header_site_title_font'          => array(
					'type'      => 'hidden_control',
					'fields'  => array(
						'font-size' => array(
							'max' => 150,
						),
					),
					'default' => array(
						'font-family'    => VASCOLITE_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 30,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'          => array(
					'type'      => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 17,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none'
					),
				),
			)
		),
		'main_content'          => array(
			'title'     => '',
			'type'      => 'hidden',
			'options'   => array(
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
					'css'     => array(
						array(
							'property' => 'max-width',
							'selector' => '
									.u-content-width > :not(.wp-block-image):not([class*="align"]):not([class*="gallery"]):not(blockquote),
									.mce-content-body:not([class*="page-template-full-width"]) > :not(.wp-block-image):not([class*="align"]):not([data-wpview-type*="gallery"]):not(blockquote):not(.mceTemp),
									.swp_social_panel',
							'unit'     => 'px',
						),
					),
				),
				'main_content_border_width'             => array(
					'default' => 0,
					'css'     => array(
						array(
							'property' => 'border-width',
							'selector' => 'html',
							'unit'     => 'px',
						),
						array(
							'property' => 'border-top-width',
							'selector' => '.site-header, .c-toolbar',
							'unit'     => 'px',
						),
						array(
							'property' => 'right',
							'selector' => '.site-header, .c-toolbar, .back-to-top',
							'unit'     => 'px',
						),
						array(
							'property' => 'bottom',
							'selector' => '.c-toolbar',
							'unit'     => 'px',
						),
						array(
							'property' => 'left',
							'selector' => '.site-header',
							'unit'     => 'px',
						),
					),
				),
				'main_content_underlined_body_links'    => array(
					'default' => 1,
				),

				'main_content_border_color'             => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'border-color',
							'selector' => 'html',
						),
						array(
							'property' => 'border-top-color',
							'selector' => '.site-header, .c-toolbar',
						),
					),
				),
				'main_content_page_title_color'         => array(
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.u-page-title-color,
								.edit-post-visual-editor .editor-post-title__block .editor-post-title__input[class]'
						),
					),
				),
				'main_content_body_text_color'          => array(
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'body,
								textarea,
								.c-stamp__container.is-light .c-stamp.c-stamp--auto,
								.u-buttons-outline .button.default,
								.u-buttons-outline .c-btn--default[class],
								.u-buttons-outline .not-found .search-form .search-submit,
								.u-buttons-outline .comment-form .form-submit .submit,
								.u-buttons-outline .c-btn--default,
								.u-buttons-outline .c-comments-toggle__label,
								.u-buttons-outline .not-found .search-form .search-submit,
								.c-search-overlay .search-field,
								.u-buttons-solid .c-feature__btn[class],
								.u-buttons-solid .c-feature__btn[class]:hover,
								.comment-form label',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.entry-content .dropcap,
								.entry-content .cats[class] > a,
								.single .header-meta .byline, 
								.single .header-meta .posted-on,
								.c-meta__secondary[class],
								.c-btn--sale-flash,
								.widget_wpcom_social_media_icons_widget[class] ul li,
								.jetpack_widget_social_icons[class] ul li,
								.widget_categories .cat-link-count',
						),
						array(
							'property' => 'border-color',
							'selector' => '
								.c-stamp__container.is-light .c-stamp.c-stamp--auto,
								.c-stamp__container.is-light .c-stamp.c-stamp--auto:before',
						),
					),
				),
				'main_content_body_link_color'              => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'a',
						),
					),
				),
				'main_content_body_link_active_color'   => array(
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'a:hover, a:active, .c-footer a:hover',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.widget_callout_box .c-feature__content,
								.widget_categories .cat-item a:hover .cat-link-count,
								.widget_categories .cat-item a:active .cat-link-count,
								.widget_wpcom_social_media_icons_widget[class] ul li:hover,
								.jetpack_widget_social_icons[class] ul li:hover,
								.jetpack_widget_social_icons[class] ul li:active,
								.widget_wpcom_social_media_icons_widget[class] ul li:active',
						),
					),
				),
				'main_content_heading_1_color'              => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'h1, .h1',
						),
					),
				),
				'main_content_heading_2_color'              => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'h2, .h2',
						),
					),
				),
				'main_content_heading_3_color'              => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'h3, .h3',
						),
					),
				),
				'main_content_heading_4_color'          => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => 'h4, .h4, .single .entry-header .cats',
						),
					),
				),
				'main_content_heading_5_color'          => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'css'       => array(
						array(
							'selector' => 'h5, .h5, .post-navigation .nav-links__label, .c-author__links a',
							'property' => 'color'
						),
					),
				),
				'main_content_heading_6_color'          => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
				),
				'main_content_content_background_color' => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.u-content-background, 
								.mce-content-body, 
								.related-posts-title span,
								.u-buttons-solid .c-feature__btn[class],
								.u-buttons-solid .c-feature__btn[class]:hover,
								.edit-post-visual-editor',
						),
						array(
							'property' => 'color',
							'selector' => '
								.u-buttons-outline .c-feature__btn[class],
								.u-buttons-outline .c-feature__btn[class]:hover,
								.u-buttons-solid .button.default,
								.u-buttons-solid .c-btn--default[class],
								.u-buttons-solid .not-found .search-form .search-submit,
								.u-buttons-solid .comment-form .form-submit .submit,
								.u-buttons-solid .c-comments-toggle__label[class],
								.entry-content .dropcap, 
								.single .header-meta .byline, 
								.single .header-meta .posted-on,
								.c-meta__secondary[class],
								.c-btn--sale-flash,
								.entry-content .cats[class] > a,
								.c-meta__primary .comments,
								.widget_categories .cat-link-count,
								.social-instagram-group .widget_wpcom_social_media_icons_widget,
								.social-instagram-group .jetpack_widget_social_icons,
								.widget_wpcom_social_media_icons_widget[class] ul a,
								.jetpack_widget_social_icons[class] ul a',
						),
					),
				),
				'main_content_fields_background_color' => array(
					'type'    => 'hidden_color',
					'default' => '#FFFFFF',
					'label'   => esc_html__( 'Fields Background Color', '__theme_txtd' ),
					'desc'    => '',
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '
						input[type=date],
						input[type=email],
						input[type=number],
						input[type=password],
						input[type=search],
						input[type=tel],
						input[type=text],
						input[type=url],
						select, textarea'
						),
					),
				),

				// [Section] FONTS
				'main_content_page_title_font'          => array(
					'type'      => 'hidden_control',
					'selector' => '
						.single-post .entry-title,
						.page .entry-title,
						.archive .entry-title,
						.search .entry-title,
						.no-results .page-title,
						.h0[class],
						.c-search-overlay .search-field,
						.edit-post-visual-editor .editor-post-title__block .editor-post-title__input[class],
						.woocommerce-products-header__title',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-size'      => 72,
						'line-height'    => 1.11,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
						body,
						.o-layout__side .c-profile__content .c-profile__title,
						.o-layout__side .widget_categories .cat-item,
						.o-layout__side .widget_categories .cat-link',
					'default'  => array(
						'font-family'    => VASCOLITE_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 17,
						'line-height'    => 1.647,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_paragraph_text_font' => array(
					'type'      => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.66,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'type'      => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 32,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// [Sub Section] Headings Fonts
				'main_content_heading_1_font'   => array(
					'type'      => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 48,
						'line-height'    => 1.167,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
							.widget_promo_box .c-promo__title,
							 h2,
							 .h2',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
						.widget_callout_box .c-feature__title,
						 h3,
						 .h3',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 24,
						'line-height'    => 1.417,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
						h4, .h4,
						.wp-caption-text,
						.widget_categories .cat-link,
						.c-announcement-bar__text,
						.widget-area:not(.widget-area--footer-featured) .widget_wpcom_social_media_icons_widget .widget__title,
						.widget-area:not(.widget-area--footer-featured) .jetpack_widget_social_icons .widget__title,
						.c-stamp',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 18,
						'line-height'    => 1.21,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_5_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
						.h5, h5,
						.wp-caption-text .credit,
						.site-description, 
						.nav-links__label,
						.c-footer__zone--bottom .menu,
						.c-cart-trigger .cart-count,
						table th,
						.shop_attributes[class][class][class] th',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 14,
						'line-height'    => 1.25,
						'letter-spacing' => 0.07,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'type'      => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 12,
						'line-height'    => 1.25,
						'letter-spacing' => 0.08,
						'text-transform' => 'uppercase',
					),
				),
				'main_content_badge_font' => array(
					'type'      => 'hidden_control',
					'selector' => '
				.single .header-meta .byline, 
				.single .header-meta .posted-on,  
				.c-meta__secondary[class],
				.c-btn--sale-flash,
				.entry-content .cats[class] > a',
					'callback' => 'typeline_font_cb',

					'default' => array(
						'font-family'    => VASCOLITE_SITE_TITLE_FONT,
						'font-weight'    => '700',
						'font-size'      => 19,
						'line-height'    => 1.21,
						'letter-spacing' => 0.052,
						'text-transform' => 'none',
					),

					// Sub Fields Configuration (optional)
					'fields'  => array(
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
			)
		),
		'footer_section'        => array(
			'title'     => '',
			'type'      => 'hidden',
			'options'   => array(
				// [Section] Layout
				'copyright_text'               => array(
					'type'      => 'hidden_control',
					/* translators: %year%: current year, %site-title%: the site title */
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'           => array(
					'type'      => 'hidden_control',
					'default' => 80,
				),
				'footer_bottom_spacing'        => array(
					'type'      => 'hidden_control',
					'default' => 98,
					'css'     => array(
						// Component
						array(
							'property'        => 'padding-bottom',
							'selector'        => '.u-footer-bottom-spacing',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						// Custom for Vasco
						array(
							'property'        => 'padding-top',
							'selector'        => '.c-footer__zone--bottom:not(:first-child)',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'footer_hide_back_to_top_link' => array(
					'type'      => 'hidden_control',
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'type'      => 'hidden_control',
					'default' => false,
				),
				'footer_layout'                => array(
					'type'      => 'hidden_control',
					'default' => 'stacked',
				),

				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default'   => VASCOLITE_SM_DARK_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer, .widget.dark'
						),
					),
				),
				'footer_links_color'             => array(
					'type'      => 'hidden_control',
					'live'      => true,
					'default'   => VASCOLITE_SM_DARK_PRIMARY,
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer a',
						),
					),
				),
				'footer_background'            => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '.u-footer-background, .widget.dark',
						),
					),
				),
			)
		),
		'buttons'               => array(
			'title'     => '',
			'type'      => 'hidden',
			'options'   => array(
				'buttons_color'      => array(
					'default'   => VASCOLITE_SM_COLOR_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => $buttons_solid . ', .c-card--product .c-meta__secondary[class], .c-btn--sale-flash',
						),
						array(
							'property' => 'color',
							'selector' => $buttons_outline,
						),
					),
				),
				'buttons_text_color' => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => $buttons_active
						),
					),
				),
				'buttons_font'       => array(
					'type'      => 'hidden_control',
					'selector' => $buttons_default . ',
						.button.default,
						.not-found .search-form .search-submit, 
						.contact-form > div > .grunion-field-label:not(.checkbox):not(.radio),
						.nf-form-cont .label-above .nf-field-label label,
						.nf-form-cont .list-checkbox-wrap .nf-field-element li label, 
						.nf-form-cont .list-radio-wrap .nf-field-element li label,
						input[type=date], 
						input[type=email], 
						input[type=number], 
						input[type=password], 
						input[type=search], 
						input[type=tel], 
						input[type=text], 
						input[type=url],
						.c-card__action,
						textarea,
						select,
						div.wpforms-container[class] .wpforms-form .wpforms-field-label,
						div.wpforms-container[class] .wpforms-form input, 
						div.wpforms-container[class] .wpforms-form select, 
						div.wpforms-container[class] .wpforms-form textarea, 
						.widgets-list-layout-links a',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 17,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
					),
				),
			)
		),
		'blog_grid'             => array(
			'title'     => '',
			'type'      => 'hidden',
			'options'   => array(
				// [Section] Layout
				'blog_grid_width'                    => array(
					'type'    => 'hidden_control',
					'default' => 1200,
				),
				'blog_container_sides_spacing'       => array(
					'type'    => 'hidden_control',
					'default' => 42,
				),
				// [Sub Section] Items Grid
				'blog_grid_layout'                   => array(
					'type'    => 'hidden_control',
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'type'    => 'hidden_control',
					'default' => 40,
					'css'     => array(
						array(
							'property'        => 'column-gap',
							'selector'        => '.c-card__frame',
							'callback_filter' => 'pixelgrade_aspect_ratio_cb',
							'unit'            => '%',
						),
					),
				),
				'blog_items_per_row'                 => array(
					'type'    => 'hidden_control',
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'type'    => 'hidden_control',
					'default' => 0,
				),
				'blog_items_horizontal_spacing'      => array(
					'type'    => 'hidden_control',
					'default' => 32,
				),
				// [Sub Section] Items Title
				'blog_items_title_position'          => array(
					'type'    => 'hidden_control',
					'default' => 'below',
				),
				'blog_items_title_alignment_nearby'  => array(
					'default' => 'left',
				),
				'blog_items_title_alignment_overlay' => array(
					'type'    => 'hidden_control',
					'default' => 'middle-center',
				),
				// Title Visiblity
				'blog_items_title_visibility'        => array(
					'type'    => 'hidden_control',
					'default' => 1,
				),
				// Excerpt Visiblity
				'blog_items_excerpt_visibility'      => array(
					'type'    => 'hidden_control',
					'default' => 1,
				),
				// [Sub Section] Items Meta
				'blog_items_heading'                 => array(
					'type'    => 'hidden_control',
					'default' => 'title',
				),
				'blog_items_content'                 => array(
					'type'    => 'hidden_control',
					'default' => 'excerpt',
				),
				'blog_items_footer'                  => array(
					'type'    => 'hidden_control',
					'default' => 'read_more',
				),
				'blog_items_primary_meta'            => array(
					'type'    => 'hidden_control',
					'default' => 'comments_category',
					'choices' => array(
						// Add a new option
						'comments_category' => esc_html__( 'Comments + Category', '__theme_txtd' ),
					),
				),
				'blog_items_secondary_meta'          => array(
					'type'    => 'hidden_control',
					'default' => 'date',
				),

				'blog_item_title_color'              => array(
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.c-card__title',
						),
					),
				),
				'blog_item_meta_primary_color'       => array(
					'default'   => VASCOLITE_SM_COLOR_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '
							.c-card__thumbnail-background:before, 
							.c-meta__primary,
							.c-card__action, 
							.archive-title__pre-title',
						),
						array(
							'property' => 'background-color',
							'selector' => '.c-meta__primary .comments',
						),
						array(
							'property' => 'border-color',
							'selector' => '.c-card__thumbnail-background:before',
						),
					),
				),
				'blog_item_thumbnail_background'     => array(
					'default'   => VASCOLITE_SM_LIGHT_PRIMARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-card__thumbnail-background',
						),
					),
				),
				'blog_item_excerpt_color'            => array(
					'default'   => VASCOLITE_SM_DARK_SECONDARY,
					'type'      => 'hidden_control',
					'css'       => array(
						array(
							'property' => 'color',
							'selector' => '.c-card__excerpt, .c-gallery--title-overlay .c-card__action',
						),
					),
				),
				'blog_item_footer_color'                  => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => VASCOLITE_SM_COLOR_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-gallery--blog .c-card__footer',
						),
					),
				),

				// [Sub Section] Thumbnail Hover
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
					'css'     => array(
						array(
							'property' => 'opacity',
							'selector' => '.c-card:hover .c-card__frame',
							'unit'     => '',
						),
					),
				),

				// [Section] FONTS
				'blog_item_title_font'               => array(
					'type'    => 'hidden_control',
					'selector' => '.c-card__title, .c-card__letter',
					'default'  => array(
						'font-family'    => VASCOLITE_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 1.25,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'                => array(
					'type'    => 'hidden_control',
					'selector' => '.c-meta__primary, .archive-title__pre-title',
					'default'  => array(
						'font-family' => VASCOLITE_HEADINGS_FONT_ALT,
						'font-weight' => '500',
						'font-size'   => 19,
						'line-height' => 1.1
					),
				),
				'blog_item_excerpt_font'             => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_BODY_FONT,
						'font-weight'    => '400',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_footer_font'             => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => VASCOLITE_BODY_FONT,
						'font-weight'    => '400',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			)
		)
	);

	$options['sections'] = Pixelgrade_Config::merge( $options['sections'], $new_config );

	return $options;
}

/*
 * Helper functions for the buttons section config.
 */
function vasco_prefix_solid_buttons( $value ) {
	return '.u-buttons-solid ' . $value;
}

function vasco_suffix_hover_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':hover';
}

function vasco_suffix_active_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':active';
}

function vasco_suffix_focus_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':focus';
}

function vasco_prefix_outline_buttons( $value ) {
	return '.u-buttons-outline ' . $value;
}

/**
 * Add out custom self-hosted fonts to the Customizer font control options.
 *
 * @param array $fonts
 *
 * @return array
 */
function vasco_lite_add_customify_theme_fonts( $fonts ) {
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
		'variants' => array( '700' )
	);

	return $fonts;
}
add_filter( 'customify_theme_fonts', 'vasco_lite_add_customify_theme_fonts' );

function vasco_lite_add_default_color_palette( $color_palettes ) {

	$color_palettes = array_merge( array(
		'default' => array(
			'label'   => esc_html__( 'Theme Default', '__theme_txtd' ),
			'preview' => array(
				'background_image_url' => 'http://pxgcdn.com/images/style-manager/color-palettes/vasco-theme-palette.jpg',
			),
			'options' => array(
				'sm_color_primary'   => VASCOLITE_SM_COLOR_PRIMARY,
				'sm_color_secondary' => VASCOLITE_SM_COLOR_SECONDARY,
				'sm_color_tertiary'  => VASCOLITE_SM_COLOR_TERTIARY,
				'sm_dark_primary'    => VASCOLITE_SM_DARK_PRIMARY,
				'sm_dark_secondary'  => VASCOLITE_SM_DARK_SECONDARY,
				'sm_dark_tertiary'   => VASCOLITE_SM_DARK_TERTIARY,
				'sm_light_primary'   => VASCOLITE_SM_LIGHT_PRIMARY,
				'sm_light_secondary' => VASCOLITE_SM_LIGHT_SECONDARY,
				'sm_light_tertiary'  => VASCOLITE_SM_LIGHT_TERTIARY,
			),
		),
	), $color_palettes );

	return $color_palettes;
}

add_filter( 'customify_get_color_palettes', 'vasco_lite_add_default_color_palette' );


<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Generate the YoungSerif font URL
 *
 * @since Vasco 1.0
 *
 * @return string
 */
function vasco_youngserif_font_url() {

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
 * @since Vasco 1.0
 *
 * @return string
 */
function vasco_hkgrotesk_font_url() {

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
 * @since Vasco 1.0
 *
 * @return string
 */
function vasco_bebasneue_font_url() {

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
 * Generate the Edo font URL
 *
 * @since Vasco 1.3.4
 *
 * @return string
 */
function vasco_edo_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by Edo, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$edo = esc_html_x( 'on', 'Edo font: on or off', '__theme_txtd' );
	if ( 'off' !== $edo ) {
		return get_template_directory_uri() . '/assets/fonts/edo/stylesheet.css';
	}

	return '';
}


if ( ! function_exists( 'vasco_google_fonts_url' ) ) :
	/**
	 * Register Google fonts for Vasco.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function vasco_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* Translators: If there are characters in your language that are not
		* supported by Lora, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'Lora font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'Lora:400,700';
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = esc_html_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', '__theme_txtd' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	} #function
endif;

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $buttons The buttons in the advanced buttons bar (the second bar) of the TinyMCE editor.
 *
 * @return array
 */
function vasco_mce_editor_buttons( $buttons ) {
	// Add the styleselect entry at the beginning of the array
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'vasco_mce_editor_buttons', 10, 1 );

/**
 * Add styles/classes to the "Styles" drop-down.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $settings The settings for TinyMCE before initialization.
 *
 * @return array
 */
function vasco_mce_before_init( $settings ) {

	$style_formats = array(
		array( 'title' => esc_html__( 'Display', '__theme_txtd' ), 'block' => 'h1', 'classes' => 'h0' ),
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro' ),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array( 'title' => esc_html__( 'Button', '__theme_txtd' ), 'selector' => 'a', 'classes' => 'button' ),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'vasco_mce_before_init', 10, 1 );

/**
 * Display blobs for the footer.
 */
function vasco_add_blobs_to_footer() {
	// Show the blobs only if allowed to by the user
	if ( pixelgrade_option( 'show_blobs', false ) ) {
		get_template_part( 'template-parts/content-blob-footer' );
	}
}
add_action( 'pixelgrade_footer_before_content', 'vasco_add_blobs_to_footer', 10 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vasco_body_classes( $classes ) {

	$classes[] = 'has-toolbar';

	return $classes;
}

add_filter( 'body_class', 'vasco_body_classes' );

/**
 * Customize the Header component config.
 *
 * @param array $config
 *
 * @return array
 */
function vasco_customize_header_config( $config ) {
	// We will remove the Jetpack Social Menu from the header as we will display it in the side toolbar.
	unset( $config['menu_locations']['jetpack-social-menu'] );

	return $config;
}

add_filter( 'pixelgrade_header_config', 'vasco_customize_header_config', 10, 1 );

/**
 * Create the output needed for the comments_category post meta and add it to the array.
 *
 * @param array $meta
 * @param string $key
 *
 * @return array
 */
function vasco_handle_comments_category_post_meta( $meta, $key ) {
	// We will only add the comments_category meta if it is actually needed, to keep things speedy.
	// We do the work if the exact key has been requested, or if all of the keys has been requested.
	if ( 'comments_category' === $key || false === $key ) {
		$comments_meta = '';
		$category_meta = '';

		// We only want the comments number
		if ( comments_open() ) {
			$comments_meta = get_comments_number(); // get_comments_number returns only a numeric value
		}

		// If we already have the category meta, we will use it
		if ( ! empty( $meta['category'] ) ) {
			$category_meta = $meta['category'];
		} else {
			if ( is_page() ) {
				// If we are on a page then we only want the main category
				$main_category = pixelgrade_get_main_category_link();
				if ( ! empty( $main_category ) ) {
					$category_meta .= '<span class="screen-reader-text">' . esc_html__( 'Main Category', '__theme_txtd' ) . '</span><ul>' . PHP_EOL;
					$category_meta .= '<li>' . $main_category . '</li>' . PHP_EOL;
					$category_meta .= '</ul>' . PHP_EOL;
				}
			} else {
				// On archives we want to show all the categories, not just the main one
				$categories = get_the_terms( get_the_ID(), 'category' );
				if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
					$category_meta .= '<span class="screen-reader-text">' . esc_html__( 'Categories', '__theme_txtd' ) . '</span><ul>' . PHP_EOL;
					foreach ( $categories as $this_category ) {
						$category_meta .= '<li><a href="' . esc_url( get_category_link( $this_category ) ) . '" rel="category">' . $this_category->name . '</a></li>' . PHP_EOL;
					};
					$category_meta .= '</ul>' . PHP_EOL;
				}
			}
		}

		$meta['comments_category'] = '';
		if ( ! empty( $comments_meta ) ) {
			$meta['comments_category'] .= '<span class="comments">' . $comments_meta . '</span>';
		}

		if ( ! empty( $category_meta ) ) {
			$meta['comments_category'] .= $category_meta;
		}
	}

	return $meta;
}
add_filter( 'pixelgrade_get_post_meta', 'vasco_handle_comments_category_post_meta', 10, 2 );

/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function vasco_change_tag_cloud_font_sizes( array $args ) {
	$args['smallest'] = '1.25';
	$args['largest'] = '2';
	$args['unit'] = 'rem';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'vasco_change_tag_cloud_font_sizes');

/**
 * Filter the Featured Posts widget wrapper classes.
 *
 * This function is used to make the Grid Posts Widget card inherit properties from the options in the Blog Grid
 * section from the Customizer.
 *
 * We have to avoid using the packed and masonry layout so we don't ignore the columns and aspect ratio options
 * of the widget
 *
 * @param array $classes
 *
 * @return array Array of classes
 */
function vasco_featured_posts_widget_classes( $classes = array() ) {
	$widget_classes = array();

	$widget_classes[] = 'c-gallery';
	$widget_classes = array_merge( $widget_classes, pixelgrade_get_blog_grid_layout_class() );
	$widget_classes = array_merge( $widget_classes, pixelgrade_get_blog_grid_alignment_class() );

	$classes = array_merge( $classes, $widget_classes );
	$classes = str_replace( 'c-gallery--packed', 'c-gallery--regular', $classes );
	$classes = str_replace( 'c-gallery--masonry', 'c-gallery--regular  c-gallery--cropped', $classes );
	$classes[] = 'c-gallery--widget';

	return $classes;
}
add_filter( 'pixelgrade_featured_posts_widget_classes', 'vasco_featured_posts_widget_classes', 10, 1 );

function vasco_remove_emoji( $text ) {

	$clean_text = "";

	// Match Emoticons
	$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	$clean_text = preg_replace($regexEmoticons, '', $text);

	// Match Miscellaneous Symbols and Pictographs
	$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	$clean_text = preg_replace($regexSymbols, '', $clean_text);

	// Match Transport And Map Symbols
	$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	$clean_text = preg_replace($regexTransport, '', $clean_text);

	// Match Miscellaneous Symbols
	$regexMisc = '/[\x{2600}-\x{26FF}]/u';
	$clean_text = preg_replace($regexMisc, '', $clean_text);

	// Match Dingbats
	$regexDingbats = '/[\x{2700}-\x{27BF}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	// Match Flags
	$regexDingbats = '/[\x{1F1E6}-\x{1F1FF}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	// Others
	$regexDingbats = '/[\x{1F910}-\x{1F95E}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	$regexDingbats = '/[\x{1F980}-\x{1F991}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	$regexDingbats = '/[\x{1F9C0}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	$regexDingbats = '/[\x{1F9F9}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	return $clean_text;
}

/**
 * Display the announcement bar.
 */
function vasco_announcement_bar() {
	if ( pixelgrade_option( 'show_announcement_bar' ) ) {
		get_template_part( 'template-parts/announcement-bar' );
	}
}
add_action( 'pixelgrade_before_header', 'vasco_announcement_bar', 5 );

function vasco_kses_anchor_content( $content ) {
	$allowedtags = array(
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'br' => array(),
		'button' => array(
			'disabled' => true,
			'name' => true,
			'type' => true,
			'value' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'div' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'em' => array(),
		'h1' => array(
			'align' => true,
		),
		'h2' => array(
			'align' => true,
		),
		'h3' => array(
			'align' => true,
		),
		'h4' => array(
			'align' => true,
		),
		'h5' => array(
			'align' => true,
		),
		'h6' => array(
			'align' => true,
		),
		'hr' => array(
			'align' => true,
			'noshade' => true,
			'size' => true,
			'width' => true,
		),
		'i' => array(),
		'p' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'q' => array(
			'cite' => true,
		),
		'small' => array(),
		'span'  => array(),
		'strike' => array(),
		'strong' => array(),
	);

	return wp_kses( $content, $allowedtags );
}

function vasco_blobs_preset_body_attribute( $attributes ) {
	$attributes['data-blobs-preset'] = pixelgrade_option( 'blobs_preset', 357 );
	$attributes['data-blobs-complexity'] = pixelgrade_option( 'blobs_complexity', 84 );
	return $attributes;
}
add_filter( 'pixelgrade_body_attributes', 'vasco_blobs_preset_body_attribute' );

function vasco_product_blobs() {
	if ( pixelgrade_option( 'show_blobs' ) ) {
		get_template_part( 'template-parts/content-blob' );
	}
}
add_action( 'woocommerce_before_single_product_summary', 'vasco_product_blobs', 9 );

function vasco_maybe_load_pro_features() {
	if ( true === pixelgrade_user_has_access( 'pro-features' ) ) {
		pixelgrade_autoload_dir( 'inc/pro' );
	} else {
		pixelgrade_autoload_dir( 'inc/lite' );
	}
}
// We want to do this as early as possible. So the zero priority is as intended.
add_action( 'after_setup_theme', 'vasco_maybe_load_pro_features', 0 );

function vasco_change_cart_menu_item_location( $location ) {
	$location = false;
	return $location;
}
add_action( 'pixelgrade_cart_menu_item_location', 'vasco_change_cart_menu_item_location', 10 );

function vasco_change_sale_flash_markup( $sale_flash, $post, $product ) {
	return '<span class="c-btn--sale-flash">' . esc_html__( 'Sale!', '__theme_txtd' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'vasco_change_sale_flash_markup', 35, 3 );

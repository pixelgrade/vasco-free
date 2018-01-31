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
 * Generate the Dry Brush font URL
 *
 * @since Bobo 1.0
 *
 * @return string
 */
function bobo_drybrush_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by HK Grotesk, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$drybrush = esc_html_x( 'on', 'HK Grotesk font: on or off', '__theme_txtd' );
	if ( 'off' !== $drybrush ) {
		return get_template_directory_uri() . '/assets/fonts/drybrush/stylesheet.css';
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
add_action( 'pixelgrade_footer_before_content', 'bobo_add_blobs_to_footer', 10 );

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
	unset( $config['menu_locations']['jetpack-social-menu'] );

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

/**
 * Create the output needed for the comments_category post meta and add it to the array.
 *
 * @param array $meta
 * @param string $key
 *
 * @return array
 */
function bobo_handle_comments_category_post_meta( $meta, $key ) {
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
					$category_meta .= '<span class="screen-reader-text">' . esc_html__( 'Main Category', '__components_txtd' ) . '</span><ul>' . PHP_EOL;
					$category_meta .= '<li>' . $main_category . '</li>' . PHP_EOL;
					$category_meta .= '</ul>' . PHP_EOL;
				}
			} else {
				// On archives we want to show all the categories, not just the main one
				$categories = get_the_terms( get_the_ID(), 'category' );
				if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
					$category_meta .= '<span class="screen-reader-text">' . esc_html__( 'Categories', '__components_txtd' ) . '</span><ul>' . PHP_EOL;
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
add_filter( 'pixelgrade_get_post_meta', 'bobo_handle_comments_category_post_meta', 10, 2 );

/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function bobo_change_tag_cloud_font_sizes( array $args ) {
	$args['smallest'] = '1.25';
	$args['largest'] = '2';
	$args['unit'] = 'rem';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'bobo_change_tag_cloud_font_sizes');

/**
 * Filter the Featured Posts widget wrapper classes.
 *
 * @param array $classes
 *
 * @return array Array of classes
 */
function bobo_featured_posts_widget_classes( $classes = array() ) {
	$widget_classes = array();

	$widget_classes[] = 'c-gallery';
	$widget_classes = array_merge( $widget_classes, pixelgrade_get_blog_grid_layout_class() );
	$widget_classes = array_merge( $widget_classes, pixelgrade_get_blog_grid_alignment_class() );

	$classes = array_merge( $classes, $widget_classes );
	$classes = str_replace( 'c-gallery--packed', 'c-gallery--regular', $classes );
	$classes[] = 'c-gallery--widget';

	return $classes;
}
add_filter( 'pixelgrade_featured_posts_widget_classes', 'bobo_featured_posts_widget_classes', 10, 1 );

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
 * We will look at the entire widgets list and
 * if certain conditions are matched we will add certain hooks before or after the widget to output certain wrappers.
 * We rely on the fact that all of our widgets provide dynamic before and after hooks
 * like `'pixelgrade_widget_start_' . $this->id`.
 * This way if we have the widget unique ID we can safely output a wrapper only for that widget instance.
 *
 * @param string $index The sidebar ID
 */
function bobo_handle_front_page_widgets_nesting( $index ) {
	global $wp_registered_sidebars, $wp_registered_widgets;

	// We only want to deal with the front page widget area
	if ( 'front-page-1' !== $index ) {
		return;
	}

	// Get all the sidebar widgets
	$sidebars_widgets = wp_get_sidebars_widgets();
	$front_page_sidebar_widgets = (array) $sidebars_widgets[ $index ];

	// Now go through the widgets list of our target sidebar and see what we can do.
	$no_widgets = count( $front_page_sidebar_widgets );
	for ( $idx = 0; $idx < $no_widgets; $idx++ ) {
		$widget_id = $front_page_sidebar_widgets[ $idx ];

		if ( ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
			continue;
		}

		// We currently can handle only our widgets
		if ( 0 !== strpos( $widget_id, 'pixelgrade' ) ) {
			continue;
		}

		$widget_type = bobo_get_widget_type_from_id( $widget_id );

		if ( empty( $widget_type ) ) {
			continue;
		}

		// If we encounter a stamp widget, we need to see if there is a MailChimp newsletter widget after it - if there is we wrap both
		if ( 'pixelgrade-stamp' === $widget_type &&
		     $idx < ( $no_widgets - 1 ) &&
		     'mc4wp_form_widget' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the stamp widget and one after the subscribe form widget
			add_action( 'pixelgrade_widget_before_' . $widget_id, 'bobo_front_page_nesting_wrapper_open', 10, 2 );

			// For the after wrapper, since the newsletter widget is not one of ours, we need to do it the hard way.
			$filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}


		// Now the other way around, first the newletter and then the stamp
		if ( 'mc4wp_form_widget' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'pixelgrade-stamp' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the stamp widget and one after the subscribe form widget
			add_action( 'pixelgrade_widget_before_' . $widget_id, 'bobo_front_page_nesting_wrapper_open', 10, 2 );

			// For the after wrapper, since the newsletter widget is not one of ours, we need to do it the hard way.
			$filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now handle multiple feature card widgets (2, 3, or 4)
		if ( 'pixelgrade-feature-card' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'pixelgrade-feature-card' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We have at least 2 consecutive Feature Card widgets - we have work to do

			// We will output a wrapper before the first feature card widget
			add_action( 'pixelgrade_widget_before_' . $widget_id, 'bobo_front_page_nesting_wrapper_open', 10, 2 );

			// Increase the index to point to the second widget in the group
			$idx++;
			// Now we need to see if we have 3 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				$idx++;
			}
			// Now we need to see if we have 4 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				$idx++;
			}

			// Output the closing wrapper tag after the last feature card widget in the group
			add_action( 'pixelgrade_widget_after_' . $front_page_sidebar_widgets[ $idx ], 'bobo_front_page_nesting_wrapper_close', 10, 2 );

			continue;
		}

		// Now handle the case where we have a Social Media Icons (Jetpack) widget + Instagram widget
		// @todo Need a little more info regarding the plugin we use for the isntagram widget
	}
}
add_action( 'dynamic_sidebar_before', 'bobo_handle_front_page_widgets_nesting', 10 );

/**
 * Extract the widget type by removing the instance number at the end.
 *
 * @param $widget_id
 *
 * @return bool|string
 */
function bobo_get_widget_type_from_id( $widget_id ) {
	return substr( $widget_id, 0, strrpos( $widget_id, '-') );
}

/**
 * Display the opening tag for our nesting wrapper.
 *
 * @param array $args
 * @param array $instance
 */
function bobo_front_page_nesting_wrapper_open( $args, $instance ) {
	echo PHP_EOL . '<div class="wrapper-nesting1">' . PHP_EOL;
}

/**
 * Display a closing tag for our nesting wrappers.
 *
 * @param array $args
 * @param array $instance
 */
function bobo_front_page_nesting_wrapper_close( $args, $instance ) {
	echo '</div><!-- close nesting wrapper -->' . PHP_EOL;
}

// We need to use a class so we can pass the $class variable to the filter function
class Bobo_AddWidgetIdWrapperClosingTag {
	private $widget_id;

	function __construct( $widget_id ) {
		$this->widget_id = $widget_id;
	}

	public function filter( $params ) {
		// Only add the closing tag for the target widget ID
		if ( $params[0]['widget_id'] === $this->widget_id ) {
			$params[0]['after_widget'] = $params[0]['after_widget'] . PHP_EOL . '</div><!-- close nesting wrapper -->' . PHP_EOL;

			// A little bit of cleanup since this filter should only be applied once
			remove_filter( 'dynamic_sidebar_params', array( $this, 'filter' ), 10 );
		}

		return $params;
	}
}

<?php
/**
 * Handles the definition of sidebars and the loading of various widgets
 *
 * @package Bobo
 * @since 1.0.0
 */

/**
 * Register the theme specific widget areas, besides the ones registered by components.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bobo_widget_areas_init() {
	/**
	 * The Front Page Widget Area
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page', '__theme_txtd' ),
		'id'            => 'front-page-1',
		'description'   => esc_html__( 'Add widgets here.', '__theme_txtd' ),
		'before_widget' => '<section id="%1$s" class="widget widget--full %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget__title h3">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bobo_widget_areas_init', 10 );

/**
 * Register the our custom widgets for use in Appearance -> Widgets
 */
function bobo_custom_widgets_init() {
    /**
     * Load and register the custom Featured Posts Widgets
     */

    // The Featured Posts - Grid Widget
    require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/featured-posts/class-FeaturedPosts-GridWidget.php' );
    register_widget( 'Pixelgrade_FeaturedPosts_GridWidget' );

    /**
     * Load other custom widgets
     */

	// The Profile Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-ProfileWidget.php' );
	register_widget( 'Pixelgrade_ProfileWidget' );

	// The Location Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-LocationWidget.php' );
	register_widget( 'Pixelgrade_LocationWidget' );

	// The Feature Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-FeatureCardWidget.php' );
	register_widget( 'Pixelgrade_FeatureCardWidget' );

	// The Callout Box Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-CalloutBoxWidget.php' );
	register_widget( 'Pixelgrade_CalloutBoxWidget' );

	// The Categories Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-CategoriesWidget.php' );
	register_widget( 'Pixelgrade_CategoriesWidget' );

	// The Stamp Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-StampWidget.php' );
	register_widget( 'Pixelgrade_StampWidget' );

	// The Promo Box Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-PromoBoxWidget.php' );
	register_widget( 'Pixelgrade_PromoBoxWidget' );
}
add_action( 'widgets_init', 'bobo_custom_widgets_init', 10 );

/**
 * We will look at the entire front page widgets list and, if certain conditions are met,
 * we will add certain wrappers around the widget groups.
 * Right now we handle these nesting situations:
 * - Pixelgrade Stamp + MailChimp Subscribe Form (in any order)
 * - 2, 3, or 4 consecutive Pixelgrade Feature Card widgets
 * - Social Icons Menu (Jetpack) + WP Instagram Widget (in any order)
 * - Social Icons Menu (Jetpack) + Text Widget with the [instagram-feed] shortcode (in any order)
 *
 * @see https://wordpress.org/plugins/wp-instagram-widget/
 * @see https://wordpress.org/plugins/instagram-feed/
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

		// If the widget is not registered, continue
		if ( ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
			continue;
		}

		$widget_type = bobo_get_widget_type_from_id( $widget_id );

		// Bail if for some reason we couldn't extract a widget type from the ID (this would be weird indeed).
		if ( empty( $widget_type ) ) {
			continue;
		}

		// If we encounter a stamp widget, we need to see if there is a MailChimp newsletter widget after it - if there is we wrap both
		if ( 'pixelgrade-stamp' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'mc4wp_form_widget' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the stamp widget and one after the subscribe form widget
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}


		// Now the other way around, first the newletter and then the stamp widget.
		if ( 'mc4wp_form_widget' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'pixelgrade-stamp' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the newsletter form widget.
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag.
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

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
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// Increase the index to point to the second widget in the group
			$idx++;

			// Now we need to see if we have 3 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				// Increase the index to point to the third widget
				$idx++;
			}

			// Now we need to see if we have 4 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				// Increase the index to point to the fourth widget
				$idx++;
			}

			// Output the closing wrapper tag after the last Feature Card widget in the group
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			continue;
		}

		// Now handle the case where we have a Social Media Icons (Jetpack) widget + Instagram widget
		// If we encounter a Social Media Icons widget, we need to see if there is a Instagram widget after it - if there is we wrap both
		if ( 'wpcom_social_media_icons_widget' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'null-instagram-feed' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the Social Media Icons widget
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now the other way around, first the Instagram widget and then the Social Media Icons widget.
		if ( 'null-instagram-feed' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'wpcom_social_media_icons_widget' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the Social Media Icons widget
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now handle the case where we have a Social Media Icons (Jetpack) widget + a text widget with the [instagram-feed] shortcode in it
		// We do this last because it is a more complicated logic because we need to look at the content and search for the shortcode
		// @see https://wordpress.org/plugins/instagram-feed/
		if ( 'wpcom_social_media_icons_widget' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'text' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     bobo_text_widget_has_instagram_feed_shortcode( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {

			// We will output a wrapper before the Social Media Icons widget
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx ++;
			continue;
		}

		// Now the other way around
		if ( 'text' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'wpcom_social_media_icons_widget' === bobo_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     bobo_text_widget_has_instagram_feed_shortcode( $widget_id ) ) {

			// We will output a wrapper before the text widget
			// @todo Set the class or classes here
			$opening_filter = new Bobo_AddWidgetIdWrapperOpeningTag( 'wrapper-nesting1', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Bobo_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx ++;
			continue;
		}
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
 * Determine if a Text widget has the [instagram-feed] shortcode in it's content.
 *
 * @see https://wordpress.org/plugins/instagram-feed/
 *
 * @param string $widget_id
 *
 * @return bool
 */
function bobo_text_widget_has_instagram_feed_shortcode( $widget_id ) {
	global $wp_registered_widgets;

	// Now we need to see if the shortcode is present in the text widget
	$has_instagram_feed_shortcode = false;

	// Bail if the shortcode hasn't been registered - maybe the Instagram Feed plugin is not activate
	if ( ! shortcode_exists( 'instagram-feed' ) ) {
		return $has_instagram_feed_shortcode;
	}

	// Get the widget details
	$text_widget = $wp_registered_widgets[ $widget_id ];

	// Get the widget instance
	/** @var WP_Widget $text_widget_instance */
	$text_widget_instance = isset( $text_widget['callback'][0] ) ? $text_widget['callback'][0] : null;
	if ( ! empty( $text_widget_instance ) ) {
		$instances = $text_widget_instance->get_settings();
		if ( isset( $text_widget['params'][0]['number'] ) && array_key_exists( $text_widget['params'][0]['number'], $instances ) ) {
			$instance = $instances[ $text_widget['params'][0]['number'] ];

			// Now we need to look at the 'text' entry in the instance values
			if ( ! empty( $instance['text'] ) && has_shortcode( $instance['text'], 'instagram-feed' ) ) {
				$has_instagram_feed_shortcode = true;
			}
		}
	}

	return $has_instagram_feed_shortcode;
}

/**
 * Helper class to add a opening tag (with classes) before the markup of a widget.
 *
 * We need to use a class so we can pass the $class and $widget_id variable to the filter function
 */
class Bobo_AddWidgetIdWrapperOpeningTag {
	private $class;
	private $widget_id;

	function __construct( $class, $widget_id ) {
		$this->class = $class;
		$this->widget_id = $widget_id;
	}

	public function filter( $params ) {
		// Only add the closing tag for the target widget ID
		if ( $params[0]['widget_id'] === $this->widget_id ) {
			$params[0]['before_widget'] = PHP_EOL . '<div class="' . $this->class . '">' . PHP_EOL . $params[0]['before_widget'];

			// A little bit of cleanup since this filter should only be applied once
			remove_filter( 'dynamic_sidebar_params', array( $this, 'filter' ), 10 );
		}

		return $params;
	}
}

/**
 * Helper class to add a closing tag (</div>) after the markup of a widget.
 *
 * We need to use a class so we can pass the $widget_id variable to the filter function
 */
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

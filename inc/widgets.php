<?php
/**
 * Handles the definition of sidebars and the loading of various widgets
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Register the theme specific widget areas, besides the ones registered by components.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vasco_widget_areas_init() {
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

	// Footer - Featured Area
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - Featured Area', '__theme_txtd' ),
		'id'            => 'footer-featured',
		'description'   => 'Site-wide widgets displayed above the Footer Area of your website.', // WPCS: XSS OK.
		'before_widget' => '<section id="%1$s" class="widget widget--full %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget__title h3"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'vasco_widget_areas_init', 10 );

/**
 * Register the our custom widgets for use in Appearance -> Widgets
 */
function vasco_custom_widgets_init() {
	// @codingStandardsIgnoreStart
    /**
     * Load and register the custom Featured Posts Widgets
     */

    // The Featured Posts - Grid Widget
    require_once pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'widgets/featured-posts/class-FeaturedPosts-GridWidget.php' );
    register_widget( 'Pixelgrade_FeaturedPosts_GridWidget' );

    /**
     * Load other custom widgets
     */

	// The Profile Widget
	require_once pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'widgets/class-ProfileWidget.php' );
	register_widget( 'Pixelgrade_ProfileWidget' );

	// The Location Widget
	require_once pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'widgets/class-LocationWidget.php' );
	register_widget( 'Pixelgrade_LocationWidget' );

	// @codingStandardsIgnoreEnd
}
add_action( 'widgets_init', 'vasco_custom_widgets_init', 10 );

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
function vasco_handle_front_page_widgets_nesting( $index ) {
	global $wp_registered_sidebars, $wp_registered_widgets;

	// We only want to do the nesting in the frontend because JS will take care of it in the customizer preview
	if ( is_admin() ) {
		return;
	}

	// We also want to deal only with the front page main widget area, or the footer featured widget area
	if ( 'front-page-1' !== $index && 'footer-featured' !== $index ) {
		return;
	}

	// Get all the sidebar widgets
	$sidebars_widgets = wp_get_sidebars_widgets();
	$front_page_sidebar_widgets = (array) $sidebars_widgets[ $index ];
	$front_page_sidebar_widgets = array_values( $front_page_sidebar_widgets );

	// Now go through the widgets list of our target sidebar and see what we can do.
	$no_widgets = count( $front_page_sidebar_widgets );
	for ( $idx = 0; $idx < $no_widgets; $idx++ ) {
		$widget_id = $front_page_sidebar_widgets[ $idx ];

		// If the widget is not registered, continue
		if ( ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
			continue;
		}

		$widget_type = vasco_get_widget_type_from_id( $widget_id );

		// Bail if for some reason we couldn't extract a widget type from the ID (this would be weird indeed).
		if ( empty( $widget_type ) ) {
			continue;
		}

		// If we encounter a stamp widget, we need to see if there is a MailChimp newsletter widget after it - if there is we wrap both
		if ( 'pixelgrade-stamp' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'mc4wp_form_widget' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			 class_exists( 'MC4WP_Form_Widget' ) ) {
			// We will output a wrapper before the stamp widget and one after the subscribe form widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group stamp-newsletter-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}


		// Now the other way around, first the newletter and then the stamp widget.
		if ( 'mc4wp_form_widget' === $widget_type &&
		     class_exists( 'MC4WP_Form_Widget' ) &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'pixelgrade-stamp' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We will output a wrapper before the newsletter form widget.
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group stamp-newsletter-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag.
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now handle multiple feature card widgets (2, 3, or 4)
		if ( 'pixelgrade-feature-card' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'pixelgrade-feature-card' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
			// We have at least 2 consecutive Feature Card widgets - we have work to do

			// Increase the index to point to the second widget in the group
			$idx++;
			$widget_count = 2;

			// Now we need to see if we have 3 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				// Increase the index to point to the third widget
				$idx++;
				$widget_count = 3;
			}

			// Now we need to see if we have 4 consecutive feature card widgets
			if ( isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			     'pixelgrade-feature-card' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {
				// Increase the index to point to the fourth widget
				$idx++;
				$widget_count = 4;
			}

			// We will output a wrapper before the first feature card widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group feature-group-' . $widget_count, $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// Output the closing wrapper tag after the last Feature Card widget in the group
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			continue;
		}

		// Now handle the case where we have a Social Icons (Jetpack) or Social Media Icons (Jetpack - Deprecated) widget + Instagram widget
		// If we encounter a Social Media Icons widget, we need to see if there is a Instagram widget after it - if there is we wrap both
		if ( ( 'jetpack_widget_social_icons' === $widget_type || 'wpcom_social_media_icons_widget' === $widget_type ) &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'null-instagram-feed' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
			 class_exists( 'null_instagram_widget' ) ) {
			// We will output a wrapper before the Social Media Icons widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group social-instagram-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// We will also insert a link to the Instagram account configured in the Instagram widget, before the Social Icons widget content.
			$social_media_icons_filter = new Vasco_AddInstagramBeforeSocialIconsInGroup( $widget_id, $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $social_media_icons_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now the other way around, first the Instagram widget and then the Social Icons (Jetpack) or Social Media Icons (Jetpack - Deprecated) widget.
		if ( 'null-instagram-feed' === $widget_type &&
		     class_exists( 'null_instagram_widget' ) &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     ( 'jetpack_widget_social_icons' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) || 'wpcom_social_media_icons_widget' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) ) {
			// We will output a wrapper before the Social Media Icons widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group social-instagram-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And the closing wrapper tag
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// We will also insert a link to the Instagram account configured in the Instagram widget, before the Social Media Icons widget content.
			$social_media_icons_filter = new Vasco_AddInstagramBeforeSocialIconsInGroup( $front_page_sidebar_widgets[ $idx + 1 ], $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $social_media_icons_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx++;
			continue;
		}

		// Now handle the case where we have a Social Icons (Jetpack) or Social Media Icons (Jetpack - Deprecated) widget + a text widget with the [instagram-feed] shortcode in it
		// We do this last because it is a more complicated logic because we need to look at the content and search for the shortcode
		// @see https://wordpress.org/plugins/instagram-feed/
		if ( ( 'jetpack_widget_social_icons' === $widget_type || 'wpcom_social_media_icons_widget' === $widget_type ) &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     'text' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     vasco_text_widget_has_instagram_feed_shortcode( $front_page_sidebar_widgets[ $idx + 1 ] ) ) {

			// We will output a wrapper before the Social Media Icons widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group social-instagram-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx ++;
			continue;
		}

		// Now the other way around
		if ( 'text' === $widget_type &&
		     isset( $front_page_sidebar_widgets[ $idx + 1 ] ) &&
		     ( 'jetpack_widget_social_icons' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) || 'wpcom_social_media_icons_widget' === vasco_get_widget_type_from_id( $front_page_sidebar_widgets[ $idx + 1 ] ) ) &&
		     vasco_text_widget_has_instagram_feed_shortcode( $widget_id ) ) {

			// We will output a wrapper before the text widget
			$opening_filter = new Vasco_AddWidgetIdWrapperOpeningTag( 'widget-group social-instagram-group', $widget_id );
			add_filter( 'dynamic_sidebar_params', array( $opening_filter, 'filter' ), 10, 1 );

			// And closing wrapper tag.
			$closing_filter = new Vasco_AddWidgetIdWrapperClosingTag( $front_page_sidebar_widgets[ $idx + 1 ] );
			add_filter( 'dynamic_sidebar_params', array( $closing_filter, 'filter' ), 10, 1 );

			// Increase the index and continue
			$idx ++;
			continue;
		}
	}
}
add_action( 'dynamic_sidebar_before', 'vasco_handle_front_page_widgets_nesting', 10 );

/**
 * Extract the widget type by removing the instance number at the end.
 *
 * @param $widget_id
 *
 * @return bool|string
 */
function vasco_get_widget_type_from_id( $widget_id ) {
	return substr( $widget_id, 0, strrpos( $widget_id, '-' ) );
}

/**
 * Extract the widget instance number by removing the widget type in front from a widget id.
 *
 * @param $widget_id
 *
 * @return bool|string
 */
function vasco_get_widget_instance_number_from_id( $widget_id ) {
	return substr( $widget_id, strrpos( $widget_id, '-' ) + 1 );
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
function vasco_text_widget_has_instagram_feed_shortcode( $widget_id ) {
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
class Vasco_AddWidgetIdWrapperOpeningTag {
	private $class;
	private $widget_id;

	function __construct( $class, $widget_id ) {
		$this->class = $class;
		$this->widget_id = $widget_id;
	}

	public function filter( $params ) {
		// Only add the closing tag for the target widget ID
		if ( $params[0]['widget_id'] === $this->widget_id ) {
			$params[0]['before_widget'] = "\n<div class=\"" . esc_attr( $this->class ) . "\">\n" . $params[0]['before_widget'];

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
class Vasco_AddWidgetIdWrapperClosingTag {
	private $widget_id;

	function __construct( $widget_id ) {
		$this->widget_id = $widget_id;
	}

	public function filter( $params ) {
		// Only add the closing tag for the target widget ID
		if ( $params[0]['widget_id'] === $this->widget_id ) {
			$params[0]['after_widget'] = $params[0]['after_widget'] . "\n</div><!-- close nesting wrapper -->\n";

			// A little bit of cleanup since this filter should only be applied once
			remove_filter( 'dynamic_sidebar_params', array( $this, 'filter' ), 10 );
		}

		return $params;
	}
}

/**
 * Helper class to add the Instagram account before the Social Media Icons widget.
 *
 * We need to use a class so we can pass the $html and $widget_id variable to the filter function
 */
class Vasco_AddInstagramBeforeSocialIconsInGroup {
	private $social_icons_widget_id;
	private $instagram_widget_id;

	function __construct( $social_icons_widget_id, $instagram_widget_id ) {
		$this->social_icons_widget_id = $social_icons_widget_id;
		$this->instagram_widget_id    = $instagram_widget_id;
	}

	public function filter( $params ) {
		// Only add the markup for the target widget ID
		if ( $params[0]['widget_id'] === $this->social_icons_widget_id ) {
			// Get the data from the Instagram widget
			$widget_type = vasco_get_widget_type_from_id( $this->instagram_widget_id );
			$instance_number = vasco_get_widget_instance_number_from_id( $this->instagram_widget_id );
			$instagram_widgets_data = get_option( 'widget_' . $widget_type );

			if ( ! empty( $instagram_widgets_data[ $instance_number ]['username'] ) ) {
				$username = $instagram_widgets_data[ $instance_number ]['username'];
				switch ( substr( $username, 0, 1 ) ) {
					case '#':
						$url = '//instagram.com/explore/tags/' . str_replace( '#', '', $username );
						break;

					default:
						$url = '//instagram.com/' . str_replace( '@', '', $username );
						break;
				}

				// Construct the HTML for the Instagram link in the Social Media Icons widget.
				$icon = pixelgrade_get_template_part_html( 'svg/icon-instagram', 'template-parts' );
				$html = '<div class="instagram-insert">' .
							'<div class="instagram-icon">' . $icon .'</div>' .
					        '<a class="instagram-link" href="' . esc_url( $url ) . '" rel="me" target="' . esc_attr( $instagram_widgets_data[ $instance_number ]['target'] ) . '" >' . esc_html( $username ) . '</a>' .
				        '</div>' .
				        '<div class="vertical-separator"></div>' .
						'<div>';

				$params[0]['before_widget'] = $params[0]['before_widget'] . "\n" . $html . "\n";
				$params[0]['after_widget'] = '</div>' . $params[0]['after_widget'];

			}

			// A little bit of cleanup since this filter should only be applied once
			remove_filter( 'dynamic_sidebar_params', array( $this, 'filter' ), 10 );
		}

		return $params;
	}
}

if ( ! function_exists( 'vasco_the_footer_featured_area' ) ) {
	function vasco_the_footer_featured_area( $location ) {
		if ( is_active_sidebar( 'footer-featured' ) ) { ?>

			<div class="u-container-sides-spacing">
				<div class="o-wrapper u-container-width">
					<div class="o-layout">
						<div class="o-layout__full  widget-area  widget-area--footer-featured">
							<?php
							// The Footer - Featured Area
							pixelgrade_get_sidebar( 'footer-featured' );
							?>
						</div><!-- .widget-area -->
					</div><!-- .o-layout -->
				</div><!-- .o-wrapper .u-container-width -->
			</div><!-- .u-container-sides-spacing -->

		<?php }
	}
}
add_action( 'pixelgrade_before_footer', 'vasco_the_footer_featured_area', 10, 1 );

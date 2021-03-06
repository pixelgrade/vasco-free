<?php
/**
 * The Location Widget class
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Pixelgrade_LocationWidget' ) ) :

	/**
	 * Class used to implement the Pixelgrade Location widget.
	 *
	 * @see Pixelgrade_Widget_Fields
	 * @see WP_Widget
	 */
	class Pixelgrade_LocationWidget extends Pixelgrade_WidgetFields {

		/**
		 * Sets up a new Location widget instance.
		 *
		 * @access public
		 */
		public function __construct() {
			// Set up the widget config
			$config = array(
			    'fields_sections' => array(
                    'content' => array(
                        'title' => esc_html__( 'Content', '__theme_txtd' ),
                        'default_state' => 'open',
                        'priority' => 10,
                    ),
                ),
			    'fields' => array(

				    // Content Section
				    'subtitle'          => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Subtitle:', '__theme_txtd' ),
					    'default'  => 'I\'m currently having fun in:',
					    'section'  => 'content',
					    'priority' => 20,
				    ),
				    'title'             => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Location:', '__theme_txtd' ),
					    'default'  => 'New South Whales, Australia',
					    'section'  => 'content',
					    // This will be applied before rendering the widget output
					    'filter_callbacks' => 'pixelgrade_parse_content_tags',
					    'priority' => 30,
				    ),
				    'location_url'           => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Location Link URL:', '__theme_txtd' ),
					    'default'  => '#',
					    'section'  => 'content',
					    'priority' => 40,
				    ),
				    'image'       => array(
					    'type'     => 'image',
					    'label'    => esc_html__( 'Image:', '__theme_txtd' ),
					    'default'  => 0, // This is the attachment ID
					    'section'  => 'content',
					    'priority' => 50,
				    ),
			    ),
			    'posts'    => array(
				    'classes'   => array(),
				    // You can have multiple templates here (array of arrays) and we will use the first one that passes processing and is found
				    // @see Pixelgrade_Config::evaluateTemplateParts()
				    'templates' => array(
					    'component_slug'    => Pixelgrade_Blog::COMPONENT_SLUG,
					    'slug'              => 'content-widget',
					    'name'              => 'location',
					    'lookup_parts_root' => true,
				    ),
			    ),
			);

            // Set up the widget options
            $widget_ops = array(
                'classname'                   => 'widget_location',
                'description'                 => esc_html__( 'Use this area to display your current location to keep your visistors up-to-date and create a sense of belonging.', '__theme_txtd' ),
                'customize_selective_refresh' => true,
            );

			// Initialize the widget
			parent::__construct( 'pixelgrade-location',
				apply_filters( 'pixelgrade_location_widget_name', esc_html__( '&#32; Pixelgrade: Location', '__theme_txtd' ) ),
				$widget_ops,
                $config );

			// Set up an alternate widget options name
			$this->alt_option_name = 'widget_pixelgrade_location';
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @access public
		 *
		 * @param array $args Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Featured Posts widget instance.
		 */
		public function widget( $args, $instance ) {
			// First, process the sidebars that are not supported by the current widget instance, if any.
			if ( false === $this->showInSidebar( $args, $instance ) ) {
				$this->sidebarNotSupportedMessage( $args, $instance );
				return;
			}

			// There is no point in doing anything of we don't have a template part to display with.
			// So first try and find a template part to use
			$found_template = false;
			if ( ! empty( $this->config['posts']['templates'] ) ) {
				$found_template = Pixelgrade_Config::evaluateTemplateParts( $this->config['posts']['templates'] );
			}
			if ( ! empty( $found_template ) ) {
				// Make sure that we have the defaults in place, where there entry is missing
				$instance = wp_parse_args( $instance, $this->getDefaults() );

				// Make sure that we have properly sanitized values (although they should be sanitized on save/update)
				$instance = $this->sanitizeFields( $instance );

				// Make sure that we apply any configured filters to the field values
				$instance = $this->applyFilters( $instance );

				// Make every instance entry a variable in the current symbol table (scope in plain English)
				foreach ( $instance as $k => $v ) {
					if ( ! $this->isFieldDisabled( $k ) ) {
						// Add the variable
						$$k = $v;
					}
				}

				/**
				 * Filters the widget title.
				 *
				 * @var string $title
				 *
				 * @param string $title The widget title.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

				$classes = array();
				if ( ! empty( $this->config['posts']['classes'] ) ) {
					$classes = array_merge( $classes, (array) $this->config['posts']['classes'] );
				}

				/**
				 * Filter the widget wrapper classes.
				 *
				 * Allow others (maybe other widgets that extend this) to change the classes.
				 *
				 * @var array $classes
				 *
				 * @param array $classes The widget wrapper classes.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				$classes = apply_filters( 'pixelgrade_location_widget_classes', $classes, $instance, $this->id_base );

				/**
				 * Filter the widget wrapper attributes.
				 *
				 * Allow others (maybe other widgets that extend this) to change the attributes.
				 *
				 * @var array $attributes
				 *
				 * @param array $attributes The widget wrapper attributes.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				$attributes = apply_filters( 'pixelgrade_location_widget_attributes', array(), $instance, $this->id_base );

				/**
				 * Fires before the widget markup, including the <section>.
				 *
				 * This is a dynamic action specific to each widget instance.
				 *
				 * @param array $args     Display arguments including 'before_title', 'after_title',
				 *                        'before_widget', and 'after_widget'.
				 * @param array $instance An array of the widget's settings.
				 */
				do_action( 'pixelgrade_widget_before_' . $this->id, $args, $instance );

				/*
				 * Start outputting the widget markup
				 */
				echo $args['before_widget']; // @codingStandardsIgnoreLine

				/**
				 * Fires at the beginning of the widget.
				 *
				 * @param array $args     Display arguments including 'before_title', 'after_title',
				 *                        'before_widget', and 'after_widget'.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				do_action( 'pixelgrade_location_widget_start', $args, $instance, $this->id_base ); ?>

				<div <?php pixelgrade_css_class( $classes ); ?> <?php pixelgrade_element_attributes( $attributes ); ?>>

					<?php
					// We use include so the template part gets access to all the variables defined above
					// @codingStandardsIgnoreLine
					include( $found_template ); ?>

				</div>

				<?php

				/**
				 * Fires at the end of the widget.
				 *
				 * @param array $args     Display arguments including 'before_title', 'after_title',
				 *                        'before_widget', and 'after_widget'.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				do_action( 'pixelgrade_location_widget_end', $args, $instance, $this->id_base );

				echo $args['after_widget']; // @codingStandardsIgnoreLine

				/**
				 * Fires after the widget markup, including the closing </section>.
				 *
				 * This is a dynamic action specific to each widget instance.
				 *
				 * @param array $args     Display arguments including 'before_title', 'after_title',
				 *                        'before_widget', and 'after_widget'.
				 * @param array $instance An array of the widget's settings.
				 */
				do_action( 'pixelgrade_widget_after_' . $this->id, $args, $instance );
			} else {
				// Let the developers know that something is amiss
				/* translators: %s: the widget name. */
				_doing_it_wrong( __METHOD__, sprintf( 'Couldn\'t find a template part to use for displaying widget posts in the %s widget!', esc_html( $this->name ) ), null );
			}
		}

		/**
		 * Handle various export logic specific to this widget's fields.
		 *
		 * @param array $widget_data The widget instance values.
		 * @param string $widget_type The widget type.
		 * @param array $matching_data The matching import/export data like old-new post IDs, old-new attachment IDs, etc.
		 *
		 * @return array The modified widget data.
		 */
		public function custom_export_logic( $widget_data, $widget_type, $matching_data ) {
			// We need to replace the image attachment ID with the new one
			if ( ! empty( $widget_data['image'] ) && ( ! empty( $matching_data['placeholders'] ) || ! empty( $matching_data['ignored_images'] ) ) ) {
				$current_id = absint( $widget_data['image'] );
				$new_id = false;

				// Search through the placeholder attachments
				foreach ( $matching_data['placeholders'] as $old_id => $new_attachment_details ) {
					if ( $current_id === $old_id && ! empty( $new_attachment_details['id'] ) ) {
						$new_id = $new_attachment_details['id'];
						break;
					}
				}

				if ( empty( $new_id ) ) {
					// Search through the ignored attachments
					foreach ( $matching_data['ignored_images'] as $old_id => $new_attachment_details ) {
						if ( $current_id === $old_id && ! empty( $new_attachment_details['id'] ) ) {
							$new_id = $new_attachment_details['id'];
							break;
						}
					}
				}

				if ( ! empty( $new_id ) ) {
					$widget_data['image'] = $new_id;
				}
			}

			// To avoid troublesome button URLs, we will just empty it
			$widget_data['button_url'] = '#';

			return $widget_data;
		}
	}

endif;

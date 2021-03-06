<?php
/**
 * The Profile Widget class
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Pixelgrade_ProfileWidget' ) ) :

	/**
	 * Class used to implement the Pixelgrade Profile widget.
	 *
	 * @see Pixelgrade_Widget_Fields
	 * @see WP_Widget
	 */
	class Pixelgrade_ProfileWidget extends Pixelgrade_WidgetFields {

		/**
		 * Sets up a new Profile widget instance.
		 *
		 * @access public
		 */
		public function __construct() {
			// Set up the widget config
			$config = array(
				'fields_sections' => array(
					'content' => array(
						'title'         => esc_html__( 'Content', '__theme_txtd' ),
						'default_state' => 'open',
						'priority'      => 10,
					),
				),
				'fields'          => array(

					// Content Section
					'title'         => array(
						'type'            => 'textarea',
						'label'           => esc_html__( 'Headline:', '__theme_txtd' ),
						'rows'            => 3,
						// translators: the first name of the author
						'default'         => 'Howdy! I\'m %first_name%, a millennial traveler<span class="hidden-mobile"> eager to wander the world and inspire others do the same</span>.',
						'section'         => 'content',
						// This will be applied before rendering the widget output
						'filter_callbacks' => 'pixelgrade_parse_content_tags',
						'priority'        => 20,
					),
					'subtitle'      => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Secondary Headline:', '__theme_txtd' ),
						'default'  => esc_html__( 'Welcome to My Blog', '__theme_txtd' ),
						'section'  => 'content',
						'priority' => 30,
					),
					'description'   => array(
						'type'     => 'textarea',
						'label'    => esc_html__( 'Description:', '__theme_txtd' ),
						'rows'     => 5,
						'default'  => 'I just quit my demanding job to travel full time around the world and share authentic stories.<span class="hidden-mobile">If you want to achieve your travel goals this is the right place to be. Enjoy the ride!</span>',
						'section'  => 'content',
						'priority' => 40,
					),
					'button_text'   => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Button Text:', '__theme_txtd' ),
						'default'  => 'Find out my story',
						'section'  => 'content',
						'priority' => 50,
					),
					'button_url'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Button Link URL:', '__theme_txtd' ),
						'default'  => '#',
						'section'  => 'content',
						'priority' => 60,
					),
					'image' => array(
						'type'     => 'image',
						'label'    => esc_html__( 'Image:', '__theme_txtd' ),
						'default'  => 0, // This is the attachment ID
						'section'  => 'content',
						'priority' => 70,
					),
				),
			    'posts'    => array(
				    'classes'   => array(),
				    // You can have multiple templates here (array of arrays) and we will use the first one that passes processing and is found
				    // @see Pixelgrade_Config::evaluateTemplateParts()
				    'templates' => array(
					    'component_slug'    => Pixelgrade_Blog::COMPONENT_SLUG,
					    'slug'              => 'content-widget',
					    'name'              => 'profile',
					    'lookup_parts_root' => true,
				    ),
			    ),
				'sidebars_not_supported' => array(
					'sidebar-2',
					'sidebar-footer',
				),
			);

            // Set up the widget options
            $widget_ops = array(
                'classname'                   => 'widget_profile',
                'description'                 => esc_html__( 'Use this area to showcase a summary of who you are and what\'s your blog about.', '__theme_txtd' ),
                'customize_selective_refresh' => true,
            );

			// Initialize the widget
			parent::__construct( 'pixelgrade-profile',
				apply_filters( 'pixelgrade_profile_widget_name', esc_html__( '&#32; Pixelgrade: Profile', '__theme_txtd' ) ),
				$widget_ops,
                $config );

			// Set up an alternate widget options name
			$this->alt_option_name = 'widget_pixelgrade_profile';
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @access public
		 *
		 * @param array $args Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current widget instance.
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
				$classes = apply_filters( 'pixelgrade_profile_widget_classes', $classes, $instance, $this->id_base );

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
				$attributes = apply_filters( 'pixelgrade_profile_widget_attributes', array(), $instance, $this->id_base );

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
				do_action( 'pixelgrade_profile_widget_start', $args, $instance, $this->id_base ); ?>

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
				do_action( 'pixelgrade_profile_widget_end', $args, $instance, $this->id_base );

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

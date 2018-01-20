<?php
/**
 * The Location Widget class
 *
 * @package Bobo
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
					    'default'  => esc_html__('I\'m currently in:', '__theme_txtd' ),
					    'section'  => 'content',
					    'priority' => 20,
				    ),
				    'title'             => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Location:', '__theme_txtd' ),
					    'default'  => 'New South Whales, Australia',
					    'section'  => 'content',
					    'filter_callback' => 'pixelgrade_parse_content_tags', // This will be applied before rendering the widget output
					    'priority' => 30,
				    ),
				    'location_url'           => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Location Link URL:', '__theme_txtd' ),
					    'default'  => esc_html__('#', '__theme_txtd' ),
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
				    'classes'   => array( 'c-location' ),
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
                'description'                 => esc_html__( 'Say something about you, in style.', '__theme_txtd' ),
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
				echo $args['before_widget'];

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

				echo $args['after_widget'];

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
				_doing_it_wrong( __METHOD__, sprintf( 'Couldn\'t find a template part to use for displaying widget posts in the %s widget!', $this->name ), null );
			}
		}
	}

endif;

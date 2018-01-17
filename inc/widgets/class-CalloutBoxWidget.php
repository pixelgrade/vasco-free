<?php
/**
 * The Callout Box Widget class
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Pixelgrade_CalloutBoxWidget' ) ) :

	/**
	 * Class used to implement the Pixelgrade Callout Box widget.
	 *
	 * @see Pixelgrade_Widget_Fields
	 * @see WP_Widget
	 */
	class Pixelgrade_CalloutBoxWidget extends Pixelgrade_WidgetFields {

		/**
		 * Sets up a new Callout Box widget instance.
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
					'title'      => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Headline:', '__theme_txtd' ),
						'default'  => esc_html__( 'Travel with Me', '__theme_txtd' ),
						'section'  => 'content',
						'priority' => 10,
					),
					'description'   => array(
						'type'     => 'textarea',
						'label'    => esc_html__( 'Description:', '__theme_txtd' ),
						'rows'     => 5,
						'default'  => 'If you are planning to visit Australia, or if you are an Aussie like us and want to explore more of it, we can help.',
						'section'  => 'content',
						'priority' => 20,
					),
					'button_text'   => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Button Text:', '__theme_txtd' ),
						'default'  => esc_html__( 'Discover', '__theme_txtd' ),
						'section'  => 'content',
						'priority' => 30,
					),
					'button_url'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Button Link URL:', '__theme_txtd' ),
						'default'  => esc_html__( '#', '__theme_txtd' ),
						'section'  => 'content',
						'priority' => 40,
					),
					'image' => array(
						'type'     => 'image',
						'label'    => esc_html__( 'Image:', '__theme_txtd' ),
						'default'  => 0, // This is the attachment ID
						'section'  => 'content',
						'priority' => 50,
					),
				),
			    'posts'    => array(
				    'classes'   => array( 'c-callout-box' ),
				    // You can have multiple templates here (array of arrays) and we will use the first one that passes processing and is found
				    // @see Pixelgrade_Config::evaluateTemplateParts()
				    'templates' => array(
					    'component_slug'    => Pixelgrade_Blog::COMPONENT_SLUG,
					    'slug'              => 'content-widget',
					    'name'              => 'callout-box',
					    'lookup_parts_root' => true,
				    ),
			    ),
			);

            // Set up the widget options
            $widget_ops = array(
                'classname'                   => 'widget_callout_box',
                'description'                 => esc_html__( 'Say something about you, in style.', '__theme_txtd' ),
                'customize_selective_refresh' => true,
            );

			// Initialize the widget
			parent::__construct( 'pixelgrade-callout_box',
				apply_filters( 'pixelgrade_callout_box_widget_name', esc_html__( '&#32; Pixelgrade: Callout Box', '__theme_txtd' ) ),
				$widget_ops,
                $config );

			// Set up an alternate widget options name
			$this->alt_option_name = 'widget_pixelgrade_callout_box';
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
				$classes = apply_filters( 'pixelgrade_callout_box_widget_classes', $classes, $instance, $this->id_base );

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
				$attributes = apply_filters( 'pixelgrade_callout_box_widget_attributes', array(), $instance, $this->id_base );

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
				do_action( 'pixelgrade_callout_box_widget_start', $args, $instance, $this->id_base ); ?>

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
				do_action( 'pixelgrade_callout_box_widget_end', $args, $instance, $this->id_base );

				echo $args['after_widget'];
			} else {
				// Let the developers know that something is amiss
				_doing_it_wrong( __METHOD__, sprintf( 'Couldn\'t find a template part to use for displaying widget posts in the %s widget!', $this->name ), null );
			}
		}
	}

endif;

<?php
/**
 * The Profile Widget class
 *
 * @package Bobo
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

		// These are the widget args
		public $args = array(
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
			'before_widget' => '<div class="widget-wrap">',
			'after_widget'  => '</div></div>'
		);

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
                        'title' => esc_html__( 'Content', '__theme_txtd' ),
                        'default_state' => 'open',
                        'priority' => 10,
                    ),
                ),
			    'fields' => array(

				    // Content Section
				    'headline'             => array(
					    'type'     => 'textarea',
					    'label'    => esc_html__( 'Headline:', '__theme_txtd' ),
					    'default'  => 'Howdy! I\'m %first_name%, a millennial traveler looking to see the world and help others do the same.',
					    'section'  => 'content',
					    'filter_callback' => 'pixelgrade_parse_content_tags', // This will be applied before rendering the widget output
					    'priority' => 20,
				    ),
				    'secondary_headline'          => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Secondary Headline:', '__theme_txtd' ),
					    'default'  => esc_html__('Welcome to My Blog', '__theme_txtd' ),
					    'section'  => 'content',
					    'priority' => 30,
				    ),
				    'description'          => array(
					    'type'     => 'textarea',
					    'label'    => esc_html__( 'Description:', '__theme_txtd' ),
					    'default'  => 'I recently quit my corporate job to travel full time and I will be sharing the experience along the way. Are you ready to achieve your travel goals? Join me and follow my adventures!',
					    'section'  => 'content',
					    'priority' => 40,
				    ),
				    'button_text'          => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Button Text:', '__theme_txtd' ),
					    'default'  => esc_html__('Subscribe', '__theme_txtd' ),
					    'section'  => 'content',
					    'priority' => 50,
				    ),
				    'button_url'           => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Button Link URL:', '__theme_txtd' ),
					    'default'  => esc_html__('#', '__theme_txtd' ),
					    'section'  => 'content',
					    'priority' => 60,
				    ),
				    'profile_image'       => array(
					    'type'     => 'image',
					    'label'    => esc_html__( 'Image:', '__theme_txtd' ),
					    'default'  => 0, // This is the attachment ID
					    'section'  => 'content',
					    'priority' => 70,
				    ),
			    ),
			    'posts'    => array(
				    'classes'   => array( 'c-profile' ),
				    // You can have multiple templates here (array of arrays) and we will use the first one that passes processing and is found
				    // @see Pixelgrade_Config::evaluateTemplateParts()
				    'templates' => array(
					    'component_slug'    => Pixelgrade_Blog::COMPONENT_SLUG,
					    'slug'              => 'content-widget',
					    'name'              => 'profile',
					    'lookup_parts_root' => true,
				    ),
			    ),
			);

            // Set up the widget options
            $widget_ops = array(
                'classname'                   => 'widget_profile',
                'description'                 => esc_html__( 'Say something about you, in style.', '__theme_txtd' ),
                'customize_selective_refresh' => true,
            );

			// Initialize the widget
			parent::__construct( 'pixelgrade-profile',
				apply_filters( 'pixelgrade_profile_widget_name', esc_html__( '&#32; Pixelgrade: Profile', '__theme_txtd' ) ),
				$widget_ops,
                $config );

			// Set up an alternate widget options name
			$this->alt_option_name = 'widget_profile';
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

				$classes = array();
				if ( ! empty( $this->config['posts']['classes'] ) ) {
					$classes = array_merge( $classes, (array) $this->config['posts']['classes'] );
				}

				// Allow others (maybe other widgets that extend this) to change the classes
				$classes = apply_filters( 'pixelgrade_profile_widget_classes', $classes, $instance );

				// Allow others (maybe other widgets that extend this) to change the attributes
				$attributes = apply_filters( 'pixelgrade_profile_widget_attributes', array(), $instance );

				/*
				 * Start outputting the widget markup
				 */
				echo $args['before_widget'];

				/**
				 * Fires at the beginning of the widget, after the title.
				 */
				do_action( 'pixelgrade_profile_widget_start', $instance, $args ); ?>

				<div <?php pixelgrade_css_class( $classes ); ?> <?php pixelgrade_element_attributes( $attributes ); ?>>

					<?php
					// We use include so the template part gets access to all the variables defined above
					include( $found_template ); ?>

				</div>

				<?php
				/**
				 * Fires at the end of the Promo Box widget.
				 */
				do_action( 'pixelgrade_profile_widget_end', $instance, $args );

				echo $args['after_widget'];
			} else {
				// Let the developers know that something is amiss
				_doing_it_wrong( __METHOD__, sprintf( 'Couldn\'t find a template part to use for displaying widget posts in the %s widget!', $this->name ), null );
			}
		}
	}

endif;

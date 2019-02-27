<?php
/**
 * The Categories Widget
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Pixelgrade_CategoriesWidget' ) ) :

	/**
	 * Class used to implement a Categories widget.
	 *
	 * @see WP_Widget
	 */
	class Pixelgrade_CategoriesWidget extends Pixelgrade_WidgetFields {

		/**
		 * Sets up a new Categories widget instance.
		 *
		 * @access public
		 */
		public function __construct() {

			// Set up the widget config
			$config = array(
				'fields_sections' => array(
					'default' => array(
						'title'    => '',
						'priority' => 1, // This section should really be the first as it is not part of the accordion
					),
				),
			    'fields' => array(

				    // Title Section
				    'title' => array(
					    'type'     => 'text',
					    'label'    => esc_html__( 'Title:', '__theme_txtd' ),
					    'default'  => esc_html__( 'Categories', '__theme_txtd' ),
					    'section'  => 'default',
					    'priority' => 10,
				    ),

				    'source'              => array(
					    'type'     => 'radio_group',
					    'label'    => esc_html__( 'Display:', '__theme_txtd' ),
					    'options'  => array(
						    'all'                 => esc_html__( 'All Categories', '__theme_txtd' ),
						    'selected_categories' => esc_html__( 'Selected Categories', '__theme_txtd' ),
					    ),
					    'default'  => 'all',
					    'section'  => 'default',
					    'priority' => 10,
				    ),
				    'selected_categories' => array(
					    'type'       => 'select2',
					    'label'      => esc_html__( 'Categories:', '__theme_txtd' ),
					    'desc'       => esc_html__( 'Choose what categories should be shown and in what order.', '__theme_txtd' ),
					    'options'    => array( $this, 'categoriesForOptions' ),
					    'default'    => '',
					    'multiple'   => true, // We allow for multiple values to be selected
					    'display_on' => array(
						    'display' => true,
						    'on'      => array(
							    'field' => 'source',
							    'value' => 'selected_categories',
						    ),
					    ),
					    'section'    => 'default',
					    'priority'   => 40,
				    ),
				    'orderby'             => array(
					    'type'       => 'select',
					    'label'      => esc_html__( 'Order by:', '__theme_txtd' ),
					    'options'    => array(
						    'count' => esc_html__( 'Posts Count', '__theme_txtd' ),
						    'name'  => esc_html__( 'Name', '__theme_txtd' ),
					    ),
					    'default'    => 'posts',
					    'display_on' => array(
						    'display' => true,
						    'on'      => array(
							    'field' => 'source',
							    'value' => 'all',
						    ),
					    ),
					    'section'    => 'default',
					    'priority'   => 50,
				    ),
				    'number'              => array(
					    'type'              => 'number',
					    'label'             => esc_html__( 'Number of items:', '__theme_txtd' ),
					    'sanitize_callback' => array( $this, 'sanitize_positive_int' ),
					    'min'               => 1,
					    'step'              => 1,
					    'default'           => 5,
					    'display_on'        => array(
						    'display' => true,
						    'on'      => array(
							    'field' => 'source',
							    'value' => 'all',
						    ),
					    ),
					    'section'           => 'default',
					    'priority'          => 60,
				    ),
				    'show_subcategories'  => array(
					    'type'       => 'checkbox',
					    'label'      => esc_html__( 'Show Sub-categories', '__theme_txtd' ),
					    'desc'       => '',
					    'default'    => true,
					    'display_on' => array(
						    'display' => true,
						    'on'      => array(
							    'field' => 'source',
							    'value' => 'all',
						    ),
					    ),
					    'section'    => 'default',
					    'priority'   => 70,
				    ),
				    'show_count'          => array(
					    'type'     => 'checkbox',
					    'label'    => esc_html__( 'Show Post Count', '__theme_txtd' ),
					    'desc'     => '',
					    'default'  => true,
					    'section'  => 'default',
					    'priority' => 80,
				    ),
			    ),
			    'posts'    => array(
				    'classes'   => array( 'c-categories' ),
				    // You can have multiple templates here (array of arrays) and we will use the first one that passes processing and is found
				    // @see Pixelgrade_Config::evaluateTemplateParts()
				    'templates' => array(
					    'component_slug'    => Pixelgrade_Blog::COMPONENT_SLUG,
					    'slug'              => 'content-widget',
					    'name'              => 'categories',
					    'lookup_parts_root' => true,
				    ),
			    ),
			);

			if ( ! pixelgrade_user_has_access( 'pro-features' ) ) {
				if ( empty( $config['sidebars_not_supported'] ) ) {
					$config['sidebars_not_supported'] = array();
				}

				// @todo Maybe use an entry like 'all' to target any sidebar. Just to avoid working in the fields!
				$config['sidebars_not_supported'] = array_merge( $config['sidebars_not_supported'], array(
					'sidebar-1',
					'sidebar-2',
					'front-page-1',
					'footer-featured',
					'sidebar-footer',
				) );
			}

			$widget_ops = array(
				'classname'                   => 'widget_categories',
				'description'                 => esc_html__( 'Displays your categories with more control.', '__theme_txtd' ),
				'customize_selective_refresh' => true,
			);

			parent::__construct( 'pixelgrade-categories',
				apply_filters( 'pixelgrade_categories_widget_name', esc_html__( '&#32; Pixelgrade: Categories', '__theme_txtd' ) ),
				$widget_ops,
                $config );

			$this->alt_option_name = 'widget_pixelgrade_categories';
		}

		/**
		 * Outputs the content for the current Categories widget instance.
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

				/*
				 * Build up the query args and get the queried categories.
				 */
				$query_args   = array(
					'taxonomy' => 'category',
					'orderby'      => 'name',
					'show_count'   => 0,
					'hierarchical' => true,
				);

				if ( ! $this->isFieldDisabled( 'source' ) ) {
					if ( 'all' == $instance['source'] ) {
						if ( ! $this->isFieldDisabled( 'orderby' ) ) {
							$query_args['orderby'] = $instance['orderby'];
						}

						if ( ! $this->isFieldDisabled( 'number' ) ) {
							$query_args['number'] = $instance['number'];
						}

						if ( ! $this->isFieldDisabled( 'show_subcategories' ) && empty( $instance['show_subcategories'] ) ) {
							// We will only show the top level categories
							$query_args['parent'] = 0;
						}
					} elseif ( ! $this->isFieldDisabled( 'selected_categories' )
					           && 'selected_categories' == $instance['source']
					           && ! empty( $instance['selected_categories'] ) ) {

						// Transform and sanitize the ids
						$category_ids = Pixelgrade_Value::maybeExplodeList( $instance['selected_categories'] );
						if ( ! empty( $category_ids ) ) {
							foreach ( $category_ids as $key => $value ) {
								if ( ! is_numeric( $value ) ) {
									unset( $category_ids[ $key ] );
								} else {
									$category_ids[ $key ] = intval( $value );
								}
							}

							$query_args['include'] = $category_ids;
							$query_args['orderby'] = 'include';
						}
					}
				}
				/**
				 * Filter the query args used to get the category widget's categories.
				 *
				 * @var array $query_args
				 *
				 * @param array $query_args The query args.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				$query_args = apply_filters( 'pixelgrade_categories_widget_query_args', $query_args, $instance, $this->id_base );

				/**
				 * Filter the queried categories used for the category widget.
				 *
				 * @var array $queried_categories
				 *
				 * @param array $queried_categories The queried categories.
				 * @param array $query_args The query args.
				 * @param array $instance An array of the widget's settings.
				 * @param mixed $id_base The widget ID.
				 */
				$queried_categories = apply_filters( 'pixelgrade_categories_widget_queried_categories', get_categories( $query_args ), $query_args, $instance, $this->id_base );

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
				$classes = apply_filters( 'pixelgrade_categories_widget_classes', $classes, $instance, $this->id_base );

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
				$attributes = apply_filters( 'pixelgrade_categories_widget_attributes', array(), $instance, $this->id_base );

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
				do_action( 'pixelgrade_categories_widget_start', $args, $instance, $this->id_base ); ?>

				<div <?php pixelgrade_css_class( $classes ); ?> <?php pixelgrade_element_attributes( $attributes ); ?>>

					<?php
					// We use include so the template part gets access to all the variables defined above
					include( $found_template ); // @codingStandardsIgnoreLine ?>

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
				do_action( 'pixelgrade_categories_widget_end', $args, $instance, $this->id_base );

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
		 * Get the categories to be used for a options.
		 *
		 * @param string $field_name
		 * @param array $field_config
		 * @param array $instance
		 *
		 * @return array
		 */
		public function categoriesForOptions( $field_name, $field_config, $instance ) {
			$query_args   = array(
				'taxonomy' => 'category',
				'orderby'      => 'name',
				'show_count'   => false,
				'hierarchical' => false,
				'fields' => 'id=>name',
			);

			$categories = array();

			if ( ! $this->isFieldDisabled( 'selected_categories' )
			     && 'selected_categories' == $instance['source']
			     && ! empty( $instance['selected_categories'] ) ) {

				// Transform and sanitize the ids
				$category_ids = Pixelgrade_Value::maybeExplodeList( $instance['selected_categories'] );
				if ( ! empty( $category_ids ) ) {
					foreach ( $category_ids as $key => $value ) {
						if ( ! is_numeric( $value ) ) {
							unset( $category_ids[ $key ] );
						} else {
							$category_ids[ $key ] = intval( $value );
						}
					}

					// We will exclude the current selected categories so we can add them at the end and thus keep the order.
					// Select2 weirdness: https://github.com/select2/select2/issues/3106
					$query_args['exclude'] = $category_ids;

					$categories = get_categories( $query_args );

					// Now we need to add the selected categories at the end, in the order they were saved
					// This way the order is maintained
					foreach ( $category_ids as $category_id ) {
						$category = get_term( $category_id, 'category' );
						if ( ! empty( $category ) && ! is_wp_error( $category ) ) {
							$categories = $categories + array( $category->term_id => $category->name );
						}
					}
				}
			} else {
				$categories = get_categories( $query_args );
			}

			return $categories;
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
			// We need to replace each category in the `selected_categories` field with the new category IDs
			if ( ! empty( $widget_data['selected_categories'] ) && ! empty( $matching_data['taxonomies']['category'] ) ) {
				foreach ( $widget_data['selected_categories'] as $key => $old_id ) {
					if ( array_key_exists( $old_id, $matching_data['taxonomies']['category'] ) ) {
						$widget_data['selected_categories'][ $key ] = $matching_data['taxonomies']['category'][ $old_id ];
					}
				}
			}

			return $widget_data;
		}
	}

endif;

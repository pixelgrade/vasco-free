<?php
/**
 * Template part for displaying the Categories widget.
 *
 * The variables bellow, that are available in the scope of this file, are already sanitized in the
 * Pixelgrade_WidgetFields class with the sanitizeFields() method.
 *
 * @global array $args The widget display options.
 * @global array $queried_categories The queried categories.
 * @global string $title The title text.
 * @global string $source The categories source: 'all' or 'selected_categories'.
 * @global string $selected_categories The selected categories if the source is set to 'selected_categories'.
 * @global string $orderby The ordering: 'count' or 'name'.
 * @global int $number The number of categories to show.
 * @global bool $show_subcategories Whether to show subcategories or not.
 * @global bool $show_count Whether to show categories count or not.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! empty( $queried_categories ) || ! is_wp_error( $queried_categories ) ) {

	if ( ! empty( $title ) ) {
		echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} ?>

	<div class="c-categories__content">
		<ul>
			<?php
			/** @var WP_Term $category */
			foreach ( $queried_categories as $category ) {
				/** This filter is documented in wp-includes/category-template.php */
				$cat_name = apply_filters(
					'list_cats',
					esc_attr( $category->name ),
					$category
				);

				$classes = 'cat-item cat-item-' . $category->term_id;

				/* Assemble the category output */
				$output = '<li class="' . esc_attr( $classes ) . "\">\n";
				// The category link
				$output .= '<a class="cat-link" href="' . esc_url( get_term_link( $category ) ) . '" >';
				// The category count
				if ( $show_count ) {
					$output .= '<span class="cat-link-count">' . $category->count . '</span>';
				}
				// The category name
				$output .= '<span class="cat-link-name">' . $cat_name . '</span>';
				$output .= "</a>\n";
				$output .= "</li>\n";

				/**
				 * Filters the HTML output of a category in the Categories widget
				 */
				echo apply_filters( 'pixelgrade_category_widget', $output, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} ?>
		</ul>
	</div>
<?php
}

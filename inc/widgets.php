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
		'before_title'  => '<h2 class="widget__title h3"><span>',
		'after_title'   => '</span></h2>',
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

	// The Promo Box Widget
	require_once pixelgrade_get_parent_theme_file_path( 'inc/widgets/class-PromoBoxWidget.php' );
	register_widget( 'Pixelgrade_PromoBoxWidget' );
}
add_action( 'widgets_init', 'bobo_custom_widgets_init', 10 );

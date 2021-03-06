<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Vasco
 * @since 1.3.4
 */

/**
 * Assets that will be loaded for the customizer sidebar
 */
function vasco_lite_customizer_assets() {
	wp_enqueue_style( 'vasco_lite_customizer_style', get_template_directory_uri() . '/inc/lite/admin/css/customizer.css', null, '1.3.5', false );
}
add_action( 'customize_controls_enqueue_scripts', 'vasco_lite_customizer_assets' );

/**
 * Add PRO Tab in Customizer
 *
 * @param WP_Customize_Manager $wp_customize
 */
function vasco_lite_customize_register( $wp_customize ) {
	// View Pro
	$wp_customize->add_section(
		'pro__section', array(
			'title'       => esc_html__( 'View PRO Version', '__theme_txtd' ),
			'priority'    => 2,
			'description' => sprintf(
			/* translators: %s: The upsell link. */
				__(
					'<div class="upsell-container">
				<h2>Need More? Go PRO</h2>
				<p>Take it to the next level and stand out. See the hotspots of Vasco PRO:</p>
				<ul class="upsell-features">
                        <li>
                            <h4>Personalize to Match Your Style</h4>
                            <div class="description">Having different tastes and preferences might be tricky for users, but not with Vasco onboard. It has Style Manager, an intuitive and catchy interface that allows you to change color palettes and fonts with a few clicks.</div>
                        </li>

                        <li>
                            <h4>New Widgets for More Flexibility</h4>
                            <div class="description">Besides the Grid Posts and Profile widgets, the PRO version comes with much more: Feature Card, Callout Box, Categories, Promo Box and many others. You also get more layout options and widget areas to play with such as Sidebar, Footer and Below Post.</div>
                        </li>

                        <li>
                            <h4>Advanced Features for a Unique Look</h4>
                            <div class="description">Vasco PRO takes everything to the next level, unlocking features like custom Stamps & Blobs for compelling visual identity. You also get access to Sticky Menu, Announcement Bar at the top of your website, Reading Progress Bar, Author Info Box and Related Posts to display below your articles.</div>
                        </li>

                        <li>
                            <h4>Premium Customer Support</h4>
                            <div class="description">You will benefit from priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.</div>
                        </li>
                        
                </ul> %s </div>', '__theme_txtd'
				),
				sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( vasco_lite_get_pro_link() ), esc_html__( 'Get Vasco Pro', '__theme_txtd' ) )
			),
		)
	);

	// This is just an empty control so that the section will show up.
	$wp_customize->add_setting(
		'vasco_lite_style_view_pro_desc', array(
			'default'           => '',
			'sanitize_callback' => '__return_true',
		)
	);
	$wp_customize->add_control(
		'vasco_lite_style_view_pro_desc', array(
			'section' => 'pro__section',
			'type'    => 'hidden',
		)
	);
}
add_action( 'customize_register', 'vasco_lite_customize_register' );

/**
 * Generate a link to the Vasco (Free) info page.
 */
function vasco_lite_get_pro_link() {
	return 'https://pixelgrade.com/themes/blogging/vasco-pro?utm_source=vasco-lite-clients&utm_medium=customizer&utm_campaign=vasco-lite';
}

function vasco_lite_footer_credits_url( $url ) {
	return 'https://pixelgrade.com/?utm_source=vasco-lite-clients&utm_medium=footer&utm_campaign=vasco-lite';
}
add_filter( 'pixelgrade_footer_credits_url', 'vasco_lite_footer_credits_url' );

function vasco_lite_body_classes( $classes ) {

	$classes[] = 'lite-version';
	$classes[] = 'u-buttons-rounded';
	$classes[] = 'u-buttons-solid';

	return $classes;
}
add_filter( 'body_class', 'vasco_lite_body_classes' );

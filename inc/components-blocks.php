<?php
/**
 * Custom functions related to the Components Blocks system.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Register new blog blocks, besides the ones provided by the blog component.
 *
 * @param string $component_slug The component's slug.
 * @param array $component_config The component entire component config.
 */
function vasco_register_blog_blocks( $component_slug, $component_config ) {

	Pixelgrade_BlocksManager()->registerBlock( 'blog/content-stamp', array(
		'type'      => 'template_part',
		'templates' => array(
			array(
				'slug' => 'content-stamp',
			),
		),
		'checks' => array(
			array(
				'callback' => 'pixelgrade_option',
				'args' => array( 'show_stamps' ),
			),
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single', array(
		'extend' => 'blog/default',
		'blocks' => array(
			'container' => array(
				'extend' => 'blog/container',
				'blocks' => array(
					'entry-header-single' => array(
						'wrappers' => array(
							array(
								'classes' => 'u-content-width'
							),
						),
						'blocks' => array(
							'blog/entry-header-single',
							'blog/entry-thumbnail',
						),
					),
					'layout' => array(
						'extend' => 'blog/layout',
						'blocks' => array(
							'main' => array(
								'extend' => 'blog/main',
								'blocks' => array(
									'blog/entry-content',
									'sidebar-below-post' => array(
										'blocks' => array(
											'blog/sidebar-below-post',
										),
										'wrappers' => array(
											array(
												'classes' => 'entry-aside u-content-width',
											),
										),
									),
									'blog/entry-footer',
								),
							),
							'side' => array(
								'extend' => 'blog/side',
								'blocks' => array(
									'blog/sidebar',
								),
							),
						),
					),
				),
			),
			'stamp' => array(
				'wrappers' => array(
					array(
						'classes' => 'c-stamp__wrapper',
					),
				),
				'blocks' => array(
					'blog/content-stamp',
				),
			),
			'blog/related-posts',
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/archive', array(
		'extend'   => 'blog/default',
		'wrappers' => array(
			'sides-spacing' => array( 'classes' => 'u-blog-sides-spacing' ),
			'wrapper'       => array( 'classes' => 'o-wrapper u-blog-grid-width' ),
		),
		'blocks'   => array(
			'blog/entry-header-archive',
			'layout' => array(
				'extend' => 'blog/layout',
				'wrappers' => array(
					'layout' => array(
						'extend_classes' => 'o-layout--blog',
					),
				),
				'blocks' => array(
					'main' => array(
						'extend' => 'blog/main',
						'blocks' => array(
							'blog/loop', // These two are mutually exclusive
							'blog/loop-none',
						),
					),
					'side' => array(
						'extend' => 'blog/side',
						'blocks' => array( 'blog/sidebar' ),
					),
				),
			),
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/front-page', array(
		'extend' => 'blog/default',
		'blocks' => array(
			'content' => array(
				'extend' => 'blog/container',
				'blocks' => array(
					'layout' => array(
						'extend' => 'blog/layout',
						'blocks' => array(
							'main' => array(
								'blocks' => array(
									'front-page-sidebar' => array(
										'type'     => 'callback',
										'callback' => 'pixelgrade_get_sidebar',
										'args' => array(
											'front-page',
										),
									),
								),
							),
						),
					),
				),
			),
		),
	) );
}
add_action( 'pixelgrade_blog_after_register_blocks', 'vasco_register_blog_blocks', 10, 2 );

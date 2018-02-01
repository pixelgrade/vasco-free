<?php
/**
 * Custom functions related to the Components Blocks system.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Bobo
 * @since 1.0.0
 */

/**
 * Register new blog blocks, besides the ones provided by the blog component.
 *
 * @param string $component_slug The component's slug.
 * @param array $component_config The component entire component config.
 */
function bobo_register_blog_blocks( $component_slug, $component_config ) {

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
				'args' => array( 'show_stamps' )
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
						),
					),
					'blog/entry-thumbnail',
					'blog/entry-content',
					'sidebar-below-post' => array(
						'blocks' => array(
							'blog/sidebar-below-post',
						),
						'wrappers' => array(
							array(
								'classes' => 'entry-aside u-content-width'
							),
						),
					),
					'blog/entry-footer'
				),
			),
			'stamp' => array(
				'wrappers' => array(
					array(
						'classes' => 'c-stamp__wrapper'
					),
				),
				'blocks' => array(
					'blog/content-stamp',
				),
			),
			'blog/related-posts',
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
add_action( 'pixelgrade_blog_after_register_blocks', 'bobo_register_blog_blocks', 10, 2 );

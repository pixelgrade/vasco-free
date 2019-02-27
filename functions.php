<?php
/**
 * Vasco functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * =========================
 * A few (wise) words
 *
 * For consistency amongst our themes, we have put as much of the theme behaviour (both logical and stylistic)
 * in components (the `components` directory). This includes the "classic" theme files like `archive.php`, `single.php`,
 * `header.php`, or `sidebar.php`.
 * Do no worry. You can still have those files in a theme, or a child theme. It will automagically work!
 *
 * We prefer not to use those files if the theme design allows us to stick to the markup patterns common to our themes,
 * available in our components.
 * This will make for more solid themes, faster update cycles and faster development for new themes.
 *
 * Now, let the show begin!
 * Oh snap... it already began :)
 * =========================
 */

/*
 * =========================
 * Autoload the Pixelgrade Components FTW!
 * This must be the FIRST thing a theme does!
 * =========================
 */
require_once trailingslashit( get_template_directory() ) . 'components/components-autoload.php';
Pixelgrade_Components_Autoload();


if ( ! function_exists( 'vasco_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vasco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on '__theme_txtd', use a find and replace
		 * to change '__theme_txtd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '__theme_txtd', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Add image sizes used specifically by theme, apart from those already registered by components.
		 */
		// Used for stamp image
		add_image_size( 'vasco-stamp-image', 300, 300, false );
		// Large image
		add_image_size( 'vasco-large-image', 1200, 1200, false );

		/*
		 * Add theme support for site logo
		 *
		 * First, it's the image size we want to use for the logo thumbnails
		 * Second, the 2 classes we want to use for the "Display Header Text" Customizer logic
		 */
		add_theme_support( 'custom-logo', apply_filters( 'vasco_header_site_logo', array(
			'height'      => 600,
			'width'       => 1360,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array(
				'site-title',
				'site-description-text',
			)
		) ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Remove themes' post formats support
		 */
		remove_theme_support( 'post-formats' );

		/*
		 * Add the editor style and fonts
		 */
		add_editor_style(
			array(
				'editor-style.css',
			)
		);

		/*
		 * Enable support for Visible Edit Shortcuts in the Customizer Preview
		 *
		 * @link https://make.wordpress.org/core/2016/11/10/visible-edit-shortcuts-in-the-customizer-preview/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Enable support for the Style Manager Customizer section (via Customify).
		 */
		add_theme_support( 'customizer_style_manager' );
	}
}
add_action( 'after_setup_theme', 'vasco_setup', 10 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vasco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vasco_content_width', 720 );
}
add_action( 'after_setup_theme', 'vasco_content_width', 0 );

function vasco_custom_tiled_gallery_width() {
	$width = pixelgrade_option( 'main_content_container_width', 1240 );

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$width = pixelgrade_option( 'main_content_container_width', 1240 ) - 300 - 56;
	}

	return $width;
}
add_filter( 'tiled_gallery_content_width', 'vasco_custom_tiled_gallery_width' );

/**
 * Enqueue scripts and styles.
 */
function vasco_scripts() {
	$theme           = wp_get_theme();
	$main_style_deps = array();

	/* Default Google Fonts */
	wp_enqueue_style( 'vasco-google-fonts', vasco_google_fonts_url() );

	// Default Self-hosted Fonts should be loaded when Customify is off
	// When Customify is active, the CSS is added only if the font is used in any of the customizer font options
	if ( ! class_exists( 'PixCustomifyPlugin' ) || ! pixelgrade_user_has_access( 'pro-features' ) ) {
		wp_enqueue_style( 'vasco-fonts-youngserif', vasco_youngserif_font_url() );
		$main_style_deps[] = 'vasco-fonts-youngserif';

		wp_enqueue_style( 'vasco-fonts-hkgrotesk', vasco_hkgrotesk_font_url() );
		$main_style_deps[] = 'vasco-fonts-hkgrotesk';

		wp_enqueue_style( 'vasco-fonts-bebasneue', vasco_bebasneue_font_url() );
		$main_style_deps[] = 'vasco-fonts-bebasneue';
	}

	wp_enqueue_style( 'vasco-fonts-edo', vasco_edo_font_url() );
	$main_style_deps[] = 'vasco-fonts-edo';

	/* The main theme stylesheet */
	wp_enqueue_style( 'vasco-style', get_template_directory_uri() . '/style.css', $main_style_deps, $theme->get( 'Version' ) );

	wp_style_add_data( 'vasco-style', 'rtl', 'replace' );

	/* Scripts */

	// The main script
	wp_enqueue_script( 'vasco-commons-scripts', get_theme_file_uri( '/assets/js/commons.js' ), array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_enqueue_script( 'vasco-scripts', get_theme_file_uri( '/assets/js/app.bundle.js' ), array( 'vasco-commons-scripts','masonry', 'hoverIntent' ), $theme->get( 'Version' ), true );

	wp_localize_script( 'vasco-main-scripts', 'vascoStrings', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'vasco_scripts' );

function vasco_gutenberg_styles() {
	wp_enqueue_style( 'vasco-gutenberg', get_theme_file_uri( '/editor.css' ), false );
	wp_enqueue_style( 'vasco-fonts-youngserif', vasco_youngserif_font_url() );
	wp_enqueue_style( 'vasco-fonts-hkgrotesk', vasco_hkgrotesk_font_url() );
	wp_enqueue_style( 'vasco-google-fonts', vasco_google_fonts_url() );

	$content_width = pixelgrade_option( 'main_content_content_width' );
	$container_width = pixelgrade_option( 'main_content_container_width', 1240 ) - 356;

	$style = '
	    .edit-post-visual-editor[class] .editor-block-list__block,
        .edit-post-visual-editor[class] .editor-post-title__block {
            max-width: ' . $content_width . 'px;
        }
        
        /*.editor-block-list__layout .editor-block-list__block[data-type="core/gallery"],
        .editor-block-list__layout .editor-block-list__block[data-align=left], 
        .editor-block-list__layout .editor-block-list__block[data-align=right] {
            max-width: ' . $container_width . 'px;
        }*/';
	wp_add_inline_style( 'vasco-gutenberg', $style );

}
add_action( 'enqueue_block_editor_assets', 'vasco_gutenberg_styles' );

function vasco_load_wp_admin_style() {
	wp_register_style( 'vasco_wp_admin_css', get_template_directory_uri() . '/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'vasco_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'vasco_load_wp_admin_style' );

/*
 * ==================================================
 * Load all the files directly in the `inc` directory
 * ==================================================
 */
pixelgrade_autoload_dir( 'inc' );

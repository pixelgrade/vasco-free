<?php
/**
 * Template part for displaying the toolbar.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( pixelgrade_user_has_access( 'pro-features' ) ) { ?>
    <div class="c-toolbar  u-content-background">
        <div class="search-trigger  js-search-trigger">
            <?php get_template_part( 'template-parts/svg/search-blob' ); ?>
        </div>
        <?php if ( function_exists( 'jetpack_social_menu' ) ) {
            jetpack_social_menu();
        } ?>
    </div>
<?php } ?>
<?php get_template_part( 'template-parts/search-overlay' ); ?>

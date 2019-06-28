<?php
/**
 * Template part for displaying the announcement bar.
 *
 * @package Vasco
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$bar_text = pixelgrade_option( 'announcement_bar_text' );
$bar_link = pixelgrade_option( 'announcement_bar_link' );

?>
<div class="c-announcement-bar c-announcement-bar--hidden">
    <a class="c-announcement-bar__text" href="<?php echo esc_url( $bar_link ); ?>" target="_blank">
        <?php echo wp_kses_post( $bar_text ); ?>
    </a>
    <a href class="c-announcement-bar__close js-announcement-bar__close">
        <?php get_template_part( 'template-parts/svg/icon-close' ); ?>
    </a>
</div>

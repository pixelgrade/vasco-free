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

$text = pixelgrade_option( 'announcement_bar_text' );
$link = pixelgrade_option( 'announcement_bar_link' );
?>

<div class="c-announcement-bar c-announcement-bar--hidden">
	<a class="c-announcement-bar__text" href="<?php echo esc_url( $link ); ?>" target="_blank">
		<?php echo $text; ?>
	</a>
	<a href class="c-announcement-bar__close js-announcement-bar__close">
		<?php get_template_part( 'template-parts/svg/icon-close' ); ?>
	</a>
</div>

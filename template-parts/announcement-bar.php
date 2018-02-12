<?php
/**
 * Template part for displaying the announcement bar.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$text = pixelgrade_option( 'announcement_bar_text' );
$link = pixelgrade_option( 'announcement_bar_link' );
?>

<div class="c-announcement-bar">
	<a href="<?php echo esc_url( $link ); ?>" target="_blank">
		<?php echo $text; ?>
	</a>
</div>

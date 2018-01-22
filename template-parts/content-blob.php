<?php
/**
 * Template part for displaying the entry thumbnail blobs.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="blob">
	<div class="blob__part  blob__part--1">
		<?php get_template_part( 'template-parts/svg/content-blob-1' ); ?>
	</div>
	<div class="blob__part  blob__part--2">
		<?php get_template_part( 'template-parts/svg/content-blob-2' ); ?>
	</div>
	<div class="blob__part  blob__part--3">
		<?php get_template_part( 'template-parts/svg/content-blob-3' ); ?>
	</div>
</div>

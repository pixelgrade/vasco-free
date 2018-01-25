<?php
/**
 * Template part for displaying the toolbar.
 *
 * @package Bobo
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="c-toolbar  u-content-background">
	<?php get_template_part( 'template-parts/search-overlay' );

	 if ( function_exists( 'jetpack_social_menu' ) ) {
		jetpack_social_menu();
	}
	?>
</div>

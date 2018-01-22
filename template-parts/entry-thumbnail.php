<?php
/**
 * The template part used for displaying the entry thumbnail.
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in the root `/template-parts/entry-thumbnail.php` or in `/template-parts/blog/entry-thumbnail.php`.
 * @see pixelgrade_locate_component_template_part()
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Blog
 * @version    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( has_post_thumbnail() ) { ?>

	<div class="entry-thumbnail">
		<div><?php the_post_thumbnail( 'single-' . pixelgrade_get_post_thumbnail_aspect_ratio_class() ); ?></div>
		<?php get_template_part( 'template-parts/content-blob' ); ?>
	</div>

<?php } ?>

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
    <div class="c-toolbar  u-content-background">
        <div class="search-trigger  js-search-trigger">
            <?php get_template_part( 'template-parts/svg/search-blob' ); ?>
        </div>
        <?php if ( pixelgrade_user_has_access( 'woocommerce' ) ) {
	        $cart_item_count = WC()->cart->get_cart_contents_count();
	        $cart_count_span = '';

	        if ( $cart_item_count ) {
		        $cart_count_span = '<div class="cart-count"><span>' . $cart_item_count . '</span></div>';
	        }

            echo '<div class="c-cart-trigger">';
            echo '<a class="js-open-cart" href="' . esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ) . '">';
	        get_template_part( 'template-parts/svg/icon-bag-svg' );
            echo $cart_count_span;
	        echo '</a>';
	        echo '</div>';
        } ?>
        <?php if ( function_exists( 'jetpack_social_menu' ) ) {
            jetpack_social_menu();
        } ?>
    </div>

<?php get_template_part( 'template-parts/search-overlay' ); ?>

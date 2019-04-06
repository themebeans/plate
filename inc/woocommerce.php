<?php
/**
 * WooCommerce Compatibility File
 * See: https://wordpress.org/plugins/woocommerce/
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

/**
 * Add support for WooCommerce to Plate.
 */
if ( ! function_exists( 'plate_woocommerce_setup' ) ) :
	function plate_woocommerce_setup() {

		add_theme_support( 'woocommerce' );

	}
endif;
add_action( 'after_setup_theme', 'plate_woocommerce_setup' );



/**
 * Add a div around the product description.
 */
function plate_woocommerce_short_description( $desc ) {
	global $product;

	if ( is_single( $product->id ) ) {
		echo '<div class="product-description">' . $desc . '</div>';
	}
}
add_filter( 'woocommerce_short_description', 'plate_woocommerce_short_description' );



/**
 * Remove results functionality site-wide.
 */
function woocommerce_result_count() {
	return;
}


/**
 * Unhook the sidebar on WooCommerce archive pages.
 */
function plate_woocommerce_remove_catalog_ordering() {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
add_action( 'init', 'plate_woocommerce_remove_catalog_ordering' );



/**
 * Add required layout changes at the start.
 */
function plate_woocommerce_start_layout() {
	echo '<div id="primary" class="content-area has-background"><main id="main" class="site-main"><article class="content-wrap">';
}
add_action( 'woocommerce_before_main_content', 'plate_woocommerce_start_layout', 2 );



/**
 * Add required layout changes at the end.
 */
function plate_woocommerce_end_layout() {
	echo '</article></main></div>';
}
add_action( 'woocommerce_after_main_content', 'plate_woocommerce_end_layout', 2 );



/**
 * Don't show the page title.
 */
add_filter(
	'woocommerce_show_page_title', function() {
		return false;
	}
);



/**
 * Unhook the sidebar on WooCommerce archive pages.
 */
function plate_woocommerce_remove_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'init', 'plate_woocommerce_remove_sidebar' );



/**
 * Unhook the breadcrumbs.
 */
function plate_woocommerce_remove_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'plate_woocommerce_remove_breadcrumbs' );



/**
 * Add masonry layout modifications at the start.
 */
function woocommerce_product_loop_start() {
	echo '<ul class="products masonry-feed">';
}



/**
 * Add masonry layout modifications at the end.
 */
function woocommerce_product_loop_end() {
	echo '</ul>';
}



/**
 * Add 'post' to the product post array.
 */
function plate_category_id_class( $classes ) {
	global $post;
	$classes[] = 'post';
	return $classes;
}
add_filter( 'post_class', 'plate_category_id_class' );

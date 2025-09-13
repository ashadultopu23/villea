<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is valid and visible.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
    return;
}


// global $villea_option;

// $main_shop_grid_columns = esc_attr(wc_get_loop_prop('columns'));

// $shop_grid_columns = !empty($villea_option['shop_grid_columns']) ? $villea_option['shop_grid_columns'] : $main_shop_grid_columns;

?>

<?php
global $villea_option;

// Get default WooCommerce loop columns
$main_shop_grid_columns = (int) wc_get_loop_prop('columns');

// Mapping: Woo columns → Bootstrap col-xl-* values
$woocommerce_to_bootstrap_columns = array(
    1  => 12, // 1 product per row
    2  => 6,  // 2 per row
    3  => 4,  // 3 per row
    4  => 3,  // 4 per row
    6  => 2,  // 6 per row
    12 => 1,  // 12 per row
);

// Get custom or fallback to Woo default
$woo_columns = !empty($villea_option['shop_grid_columns']) ? (int) $villea_option['shop_grid_columns'] : $main_shop_grid_columns;

// Bootstrap column width
$shop_grid_columns = isset($woocommerce_to_bootstrap_columns[$woo_columns]) ? $woocommerce_to_bootstrap_columns[$woo_columns] : 3;


?>


<div <?php wc_product_class('col-sm-6 col-xl-' . esc_attr($shop_grid_columns) . ' product_card_grid', $product); ?>>
    <?php cus_woo_product_item(); ?>
</div>
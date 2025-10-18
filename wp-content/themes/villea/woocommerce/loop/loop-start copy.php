<?php

/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (! defined('ABSPATH')) {
    exit;
}

global $villea_option;

$shop_grid_columns = !empty($villea_option['shop_grid_columns']) ? $villea_option['shop_grid_columns'] : '3';
$shop_list_columns = !empty($villea_option['shop_list_columns']) ? $villea_option['shop_list_columns'] : '1';
$single_releted_products_col = !empty($villea_option['single_releted_products_col']) ?  'releted-' . $villea_option['single_releted_products_col'] : '4';
$shop_layout_style = !empty($villea_option['shop_layout_style']) ? $villea_option['shop_layout_style'] : 'grid';

// Determine the column value based on the page type
if (is_shop()) {
    if ($shop_layout_style === 'grid') {
        $columns = $shop_grid_columns;
    } else {
        $columns = $shop_list_columns;
    }
} elseif (is_product()) {
    $columns = $single_releted_products_col;
} elseif (is_product_category()) {
    if ($shop_layout_style === 'grid') {
        $columns = $shop_grid_columns;
    } else {
        $columns = $shop_list_columns;
    }
} elseif (is_product_tag()) {
    if ($shop_layout_style === 'grid') {
        $columns = $shop_grid_columns;
    } else {
        $columns = $shop_list_columns;
    }
} else {
    $columns = wc_get_loop_prop('columns');
}
?>

<!-- <div class="products columns-<?php // echo esc_attr($columns); 
                                    ?>"> -->
<div class="products columns-<?php echo esc_attr($columns); ?>" data-grid-columns="<?php echo esc_attr($shop_grid_columns); ?>" data-list-columns="<?php echo esc_attr($shop_list_columns); ?>">
    <!-- Layout Switch Buttons -->
    <!--  -->
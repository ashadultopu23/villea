<?php

/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if (! defined('ABSPATH')) {
    exit;
}


$category = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false, // Set to true if you only want categories with products
) );


?>
<div <?php wc_product_cat_class('col-12 product_card_list'); ?>>
    <div class="product_card overflow-hidden d-flex <?php //echo esc_attr($has_second_image); 
                                                    ?>">
        <div class="product_card_thumb position-relative">
            <a href="<?php echo esc_url(get_term_link($category)); ?>">
                <div class="product_thumb_main h-100">
                    <?php woocommerce_subcategory_thumbnail($category); ?>
                </div>
                <?php if (!empty($tp_product_2nd_img)) : ?>
                    <img src="<?php echo esc_url($tp_product_2nd_img); ?>" class="product_2nd_img" alt="<?php echo esc_attr(get_the_title()); ?>">
                <?php endif; ?>
            </a>
        </div>

        <div class="product_info d-flex flex-column gap-1">
            <h5 class="product_title m-0"><a href="<?php echo esc_url(get_term_link($category)); ?>">
                    <?php echo esc_html($category->name);

                    if ($category->count > 0) {
                        echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                    }
                    ?></a>
            </h5>
        </div>
    </div>
</div>
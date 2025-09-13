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
?>
<?php
if ($category->count > 0) :
?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="product_category_card d-flex gap-2">
            <div class="product_category_thumb_main h-100">
                <?php woocommerce_subcategory_thumbnail($category); ?>
            </div>
            <div class="product_category_info d-flex flex-column gap-2 justify-content-center">
                <h6 class="category_title m-0">
                    <?php echo esc_html($category->name);
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category); ?>
                </h6>
            </div>
        </a>
    </div>
<?php
endif;
?>
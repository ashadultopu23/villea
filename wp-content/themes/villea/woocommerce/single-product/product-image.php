<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (! function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	)
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<?php
		if ($post_thumbnail_id) { ?>
			<div class="woocommerce-product-gallery__image is-active">
				<img
					id="main-product-image"
					src="<?php echo esc_url(wp_get_attachment_image_url($post_thumbnail_id, 'woocommerce_single')); ?>"
					data-large="<?php echo esc_url(wp_get_attachment_image_url($post_thumbnail_id, 'woocommerce_single')); ?>"
					alt="<?php echo esc_attr(get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true)); ?>" />
			</div>
		<?php
		} else {
			// Placeholder fallback
			$wrapper_classname = $product->is_type(ProductType::VARIABLE) && ! empty($product->get_available_variations('image')) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			echo sprintf('<div class="%s">', esc_attr($wrapper_classname));
			echo sprintf(
				'<img src="%s" alt="%s" class="wp-post-image" />',
				esc_url(wc_placeholder_img_src('woocommerce_single')),
				esc_html__('Awaiting product image', 'tradexy')
			);
			echo '</div>';
		}

		do_action('woocommerce_product_thumbnails');
		?>
	</div>
</div>
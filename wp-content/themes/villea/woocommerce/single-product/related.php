<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 */

if (! defined('ABSPATH')) {
	exit;
}

if ($related_products) :
	global $villea_option;
	$related_count = count($related_products);
	$single_releted_products_col = !empty($villea_option['single_releted_products_col']) ?  $villea_option['single_releted_products_col'] : '4';
	$slider_related_products = $related_count > $single_releted_products_col; // Only use slider if less than 4 products

?>
	<div class="col-12">
		<section class="related products <?php echo esc_attr($slider_related_products ? 'related-slider-wrapper' : ''); ?>">
			<?php
			$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'villea'));

			if ($heading) :
			?>
				<h2><?php echo esc_html($heading); ?></h2>
			<?php endif; ?>

			<?php if ($slider_related_products): ?>
				<!-- Swiper wrapper -->
				<div class="swiper related-swiper">
					<div class="swiper-wrapper">
					<?php else: ?>
						<?php woocommerce_product_loop_start(); ?>
					<?php endif; ?>

					<?php foreach ($related_products as $related_product) : ?>
						<?php
						$post_object = get_post($related_product->get_id());
						setup_postdata($GLOBALS['post'] = $post_object);

						if ($slider_related_products) {
							echo '<div class="swiper-slide">';
							wc_get_template_part('content', 'product-related');
							echo '</div>';
						} else {
							wc_get_template_part('content', 'product-related');
						}
						?>
					<?php endforeach; ?>

					<?php if ($slider_related_products): ?>
					</div>
				</div> <!-- .swiper -->
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			<?php else: ?>
				<?php woocommerce_product_loop_end(); ?>
			<?php endif; ?>

		</section>
	</div>


<?php
	wp_reset_postdata();
endif;

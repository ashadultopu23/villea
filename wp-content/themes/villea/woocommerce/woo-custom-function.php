<?php
if (class_exists('WooCommerce')) {
	// remove woocommerce defauly style
	add_filter('woocommerce_enqueue_styles', '__return_false');

	// product card remove_action
	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

	// product category 
	remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
	remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
	remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
	remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
	remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

	// product details
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);

	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
	// remove_action('woocommerce_single_product_summary', 'WC_Structured_Data::generate_product_data', 60);
	// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	// remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

	add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
	// remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}



// wc_num_product_per_page
add_filter('loop_shop_per_page', 'tradexy_set_products_per_page', 12);
function tradexy_set_products_per_page($cols)
{
	global $villea_option;
	$product_per_page = isset($villea_option['wc_num_product_per_page']) ? $villea_option['wc_num_product_per_page'] : 9;

	if (isset($product_per_page)) {
		return intval($product_per_page);
	}

	return $cols;
}



// Layout grid or list start
// Grid Layout Function
function cus_woo_product_item()
{
	global $product;
	global $villea_option;

	$terms = wc_get_product_terms($product->get_id(), 'pa_color', ['fields' => 'names']);
	$tp_product_2nd_img = get_post_meta(get_the_ID(), 'tp_product_2nd_img', true);
	$has_second_image = !empty($tp_product_2nd_img) ? 'has_2nd_img' : '';
	$wc_wishlist_icon = !empty($villea_option['wc_wishlist_icon']) ? $villea_option['wc_wishlist_icon'] : '';
	$wc_quickview_icon = !empty($villea_option['wc_quickview_icon']) ? $villea_option['wc_quickview_icon'] : '';
	$wc_compare_icon = !empty($villea_option['wc_compare_icon']) ? $villea_option['wc_compare_icon'] : '';
	$wc_cart_icon = !empty($villea_option['wc_cart_icon']) ? $villea_option['wc_cart_icon'] : '';


?>

	<div class="product_card overflow-hidden d-flex <?php echo esc_attr($has_second_image); ?>">
		<div class="product_card_thumb position-relative">
			<a href="<?php the_permalink(); ?>">
				<div class="product_thumb_main">
					<?php woocommerce_template_loop_product_thumbnail(); ?>
				</div>
				<?php if (!empty($tp_product_2nd_img)) : ?>
					<img src="<?php echo esc_url($tp_product_2nd_img); ?>" class="product_2nd_img" alt="<?php echo esc_attr(get_the_title()); ?>">
				<?php endif; ?>
			</a>

			<!-- badges -->
			<?php custom_woocommerce_badges(); ?>

			<?php $product_id = $product->get_id();
			$success_message  = sprintf(__('“%s” has been added to your cart', 'tradexy'), $product->get_name());
			$product_classes  = implode(' ', array_map('esc_attr', $product->get_type() === 'simple' ? ['button', 'product_type_simple', 'add_to_cart_button', 'ajax_add_to_cart'] : wc_get_product_class('', $product))); ?>

			<div class="product_icon_actions">
				<?php if (!empty($wc_quickview_icon)) : ?>
					<div class="product_icon quickview">
						<?php echo do_shortcode('[woosq product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_wishlist_icon)) : ?>
					<div class="product_icon heart">
						<?php echo do_shortcode('[woosw product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_compare_icon)) : ?>
					<div class="product_icon compare">
						<?php echo do_shortcode('[woosc product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_cart_icon)) : ?>
					<div class="product_icon cart">
						<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr($product_id); ?>" class="<?php echo esc_attr($product_classes); ?>" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="<?php echo esc_attr($product->add_to_cart_description()); ?>" rel="nofollow" data-success_message="<?php echo esc_attr($success_message); ?>"> <i class="tp tp-cart-shopping"></i></a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Color Options -->
			<div class="product_color_options">
				<?php foreach ($terms as $term_name) : ?>
					<button class="variant_color" style="background-color: <?php echo esc_attr($term_name); ?> !important" title="<?php echo esc_attr($term_name); ?>"></button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="product_info d-flex flex-column gap-1">
			<?php if (wc_get_rating_html(get_post_meta(get_the_ID(), '_wc_average_rating', true))) : ?>
				<div class="product_rating"><?php woocommerce_template_loop_rating(); ?></div>
			<?php endif; ?>
			<h5 class="product_title m-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<div class="product_price"><?php woocommerce_template_loop_price(); ?></div>
		</div>
	</div>
<?php
}


// List Layout Function
function cus_woo_product_item_list()
{
	global $product, $villea_option;

	$terms = wc_get_product_terms($product->get_id(), 'pa_color', ['fields' => 'names']);
	$tp_product_2nd_img = get_post_meta(get_the_ID(), 'tp_product_2nd_img', true);
	$has_second_image = !empty($tp_product_2nd_img) ? 'has_2nd_img' : '';
	$excerpt_words = !empty($villea_option['product_excerpt_trim_words']) ? $villea_option['product_excerpt_trim_words'] : 20;
	$wc_wishlist_icon = !empty($villea_option['wc_wishlist_icon']) ? $villea_option['wc_wishlist_icon'] : '';
	$wc_quickview_icon = !empty($villea_option['wc_quickview_icon']) ? $villea_option['wc_quickview_icon'] : '';
	$wc_compare_icon = !empty($villea_option['wc_compare_icon']) ? $villea_option['wc_compare_icon'] : '';
	$wc_cart_icon = !empty($villea_option['wc_cart_icon']) ? $villea_option['wc_cart_icon'] : '';

?>
	<div class="product_card overflow-hidden d-flex <?php echo esc_attr($has_second_image); ?>">
		<div class="product_card_thumb position-relative">
			<a href="<?php the_permalink(); ?>">
				<div class="product_thumb_main">
					<?php woocommerce_template_loop_product_thumbnail(); ?>
				</div>
				<?php if (!empty($tp_product_2nd_img)) : ?>
					<img src="<?php echo esc_url($tp_product_2nd_img); ?>" class="product_2nd_img" alt="<?php echo esc_attr(get_the_title()); ?>">
				<?php endif; ?>
			</a>

			<!-- badges -->
			<?php custom_woocommerce_badges(); ?>

			<?php $product_id = $product->get_id();
			$success_message  = sprintf(__('“%s” has been added to your cart', 'tradexy'), $product->get_name());
			$product_classes  = implode(' ', array_map('esc_attr', $product->get_type() === 'simple' ? ['button', 'product_type_simple', 'add_to_cart_button', 'ajax_add_to_cart'] : wc_get_product_class('', $product))); ?>

			<div class="product_icon_actions">
				<?php if (!empty($wc_quickview_icon)) : ?>
					<div class="product_icon quickview">
						<?php echo do_shortcode('[woosq product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_wishlist_icon)) : ?>
					<div class="product_icon heart">
						<?php echo do_shortcode('[woosw product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_compare_icon)) : ?>
					<div class="product_icon compare">
						<?php echo do_shortcode('[woosc product_id="' . $product_id . '"]'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($wc_cart_icon)) : ?>
					<div class="product_icon cart">
						<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr($product_id); ?>" class="<?php echo esc_attr($product_classes); ?>" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="<?php echo esc_attr($product->add_to_cart_description()); ?>" rel="nofollow" data-success_message="<?php echo esc_attr($success_message); ?>"> <i class="tp tp-cart-shopping"></i></a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Color Options -->
			<div class="product_color_options">
				<?php foreach ($terms as $term_name) : ?>
					<button class="variant_color" style="background-color: <?php echo esc_attr($term_name); ?> !important" title="<?php echo esc_attr($term_name); ?>"></button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="product_info d-flex flex-column gap-1">
			<?php if (wc_get_rating_html(get_post_meta(get_the_ID(), '_wc_average_rating', true))) : ?>
				<div class="product_rating"><?php woocommerce_template_loop_rating(); ?></div>
			<?php endif; ?>
			<h5 class="product_title m-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<div class="product_price"><?php woocommerce_template_loop_price(); ?></div>
			<p class="mt-12 mb-0"><?php echo wp_trim_words(get_the_excerpt(), $excerpt_words, '...'); ?></p>
			<div class="woo_card_btn mt-30"><?php woocommerce_template_loop_add_to_cart(); ?></div>
		</div>
	</div>
<?php
}
// Layout grid or list end


// product_sale_percentage
function product_sale_percentage()
{
	global $product;
	$output = '';
	$icon = esc_html__("-", 'tradexy');

	if ($product->is_on_sale() && $product->is_type('variable')) {
		$percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
		$output .= '<span class="tp-product-details-offer">' . $icon . $percentage . '%</span>';
	} elseif ($product->is_on_sale() && $product->get_regular_price() && !$product->is_type('grouped')) {
		$percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
		$output .= '<span class="tp-product-details-offer">' . $icon . $percentage . '%</span>';
	}
	return $output;
}



// single product Image
add_action('woocommerce_before_single_product_summary', 'single_product_image_and_badge', 10);
function single_product_image_and_badge()
{
?>
	<div class="woocommerce_single_image">

		<?php
		global $product, $villea_option;
		$wc_show_new = !empty($villea_option['wc_show_new']) ? $villea_option['wc_show_new'] : '';
		$wc_new_product_days = !empty($villea_option['wc_new_product_days']) ? $villea_option['wc_new_product_days'] : '';
		$wc_show_hot = !empty($villea_option['wc_show_hot']) ? $villea_option['wc_show_hot'] : '';
		$wc_hot_product_product = !empty($villea_option['wc_hot_product_product']) ? $villea_option['wc_hot_product_product'] : '';
		$wc_show_sale = !empty($villea_option['wc_show_sale']) ? $villea_option['wc_show_sale'] : '';


		echo '<div class="product_badge">';
		// 👉 New Badge - if product is published within last 30 days
		$post_date = get_the_date('U', $product->get_id());
		$days_diff = (current_time('timestamp') - $post_date) / DAY_IN_SECONDS;
		if (!empty($wc_show_new)) {
			if ($days_diff <= $wc_new_product_days) {
				echo '<span class="custom-badge new">' . esc_html__('New', 'tradexy') . '</span>';
			}
		}
		// 👉 Sale Badge - if product is on sale
		if (!empty($wc_show_sale)) {
			if ($product->is_on_sale()) {
				echo '<span class="custom-badge sale">' . esc_html__('Sale!', 'tradexy') . '</span>';
			}
		}
		// 👉 Hot Badge - based on total_sales or custom field
		if (!empty($wc_show_hot)) {
			$total_sales = $product->get_total_sales(); // built-in WooCommerce
			if ($total_sales >= $wc_hot_product_product) { // you can adjust the number
				echo '<span class="custom-badge hot">' . esc_html__('Hot!', 'tradexy') .  '</span>';
			}
		}
		echo '</div>';


		woocommerce_show_product_images();
		?>

	</div>
<?php

}

// single product info
add_action('woocommerce_single_product_summary', 'single_product_info', 10);
function single_product_info()
{ ?>
	<div class="woocommerce_basic_info">
		<h3 class="single_product_title m-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if (wc_get_rating_html(get_post_meta(get_the_ID(), '_wc_average_rating', true))) : ?>
			<div class="d-flex align-items-center">
				<?php woocommerce_template_single_rating(); ?>
			</div>
		<?php endif; ?>

		<?php
		global $product;
		global $villea_option;
		$wc_show_percentage = !empty($villea_option['wc_show_percentage']) ? $villea_option['wc_show_percentage'] : '';

		if ($product->get_price() !== '') : ?>
			<div class="single_product_price fs-4 fw-medium">
				<?php woocommerce_template_single_price(); ?>

				<?php
				if (!empty($wc_show_percentage)) {
					$sale_percentage = product_sale_percentage();
					if (!empty($sale_percentage)) {
						// Output the sale percentage safely
						echo wp_kses_post($sale_percentage);
					}
				}
				?>
			</div>
		<?php endif; ?>

		<?php if (get_the_excerpt()) : ?>
			<?php woocommerce_template_single_excerpt(); ?>
		<?php endif; ?>
	</div>
	<div class="woocommerce_others_info">
		<?php
		if (function_exists('woocommerce_template_single_add_to_cart')) {
			woocommerce_template_single_add_to_cart();
		}
		if (function_exists('woocommerce_template_single_meta')) {
			woocommerce_template_single_meta();
		}
		if (function_exists('woocommerce_template_single_sharing')) {
			woocommerce_template_single_sharing();
		}
		?>


		<!-- Color Options -->
		<!-- <div class="product_color_options">
			<label class="fs-5"><?php //echo esc_html__('Color', 'tradexy'); 
								?></label>
			<?php
			// global $product;
			// $terms = wc_get_product_terms($product->get_id(), 'pa_color', ['fields' => 'names']);

			// foreach ($terms as $term_name) : 
			?>
			// 	<button class="variant_color" style="background-color: <?php //echo esc_attr($term_name); 
																			?> !important" title="<?php //echo esc_attr($term_name); 
																									?>"></button>
			// <?php //endforeach; 
				?>
		</div>
		<div class="product_size_options">
			<label class="fs-5"><?php //echo esc_html__('Size', 'tradexy'); 
								?></label>
			<?php
			// $size_terms = wc_get_product_terms($product->get_id(), 'pa_size', ['fields' => 'names']);

			// if (!empty($size_terms)) {
			// 	foreach ($size_terms as $size) {
			// 		echo '<span class="size-btn me-2">' . esc_html($size) . '</span>';
			// 	}
			// } else {
			// 	echo '<span class="text-muted">' . esc_html__('No sizes available', 'tradexy') . '</span>';
			// }
			?>
		</div> -->

	</div>


<?php
} // End of single product function



// Custom WooCommerce Badges
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_badges', 10);
function custom_woocommerce_badges()
{
	global $product;
	global $villea_option;
	$icon = esc_html__("-", 'tradexy');
	$wc_show_new = !empty($villea_option['wc_show_new']) ? $villea_option['wc_show_new'] : '';
	$wc_new_product_days = !empty($villea_option['wc_new_product_days']) ? $villea_option['wc_new_product_days'] : '';
	$wc_show_hot = !empty($villea_option['wc_show_hot']) ? $villea_option['wc_show_hot'] : '';
	$wc_hot_product_product = !empty($villea_option['wc_hot_product_product']) ? $villea_option['wc_hot_product_product'] : '';
	$wc_show_sale = !empty($villea_option['wc_show_sale']) ? $villea_option['wc_show_sale'] : '';
	$wc_show_percentage = !empty($villea_option['wc_show_percentage']) ? $villea_option['wc_show_percentage'] : '';


	echo '<div class="product_badge">';
	// 👉 New Badge - if product is published within last 30 days
	$post_date = get_the_date('U', $product->get_id());
	$days_diff = (current_time('timestamp') - $post_date) / DAY_IN_SECONDS;

	if (!empty($wc_show_new)) {
		if ($days_diff <= $wc_new_product_days) {
			echo '<span class="custom-badge new">' . esc_html__('New', 'tradexy') . '</span>';
		}
	}

	// 👉 Sale Badge - if product is on sale
	if (!empty($wc_show_sale)) {
		if ($product->is_on_sale()) {
			echo '<span class="custom-badge sale">' . esc_html__('Sale!', 'tradexy') . '</span>';
		}
	}

	// 👉 Hot Badge - based on total_sales or custom field
	if (!empty($wc_show_hot)) {
		$total_sales = $product->get_total_sales(); // built-in WooCommerce
		if ($total_sales >= $wc_hot_product_product) { // you can adjust the number
			echo '<span class="custom-badge hot">' . esc_html__('Hot!', 'tradexy') .  '</span>';
		}
	}

	if (!empty($wc_show_percentage)) {
		// 👉 Percentage Badge
		if ($product->is_on_sale() && $product->is_type('variable')) {
			$percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
			echo '<span class="tp-product-details-offer">' . $icon . $percentage . '%</span>';
		} elseif ($product->is_on_sale() && $product->get_regular_price() && !$product->is_type('grouped')) {
			$percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
			echo '<span class="tp-product-details-offer">' . $icon . $percentage . '%</span>';
		}
	}
	echo '</div>';
}




// woocommerce quantity Show plus minus buttons
add_action('woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus');
function bbloomer_display_quantity_plus()
{
	echo '<button type="button" class="plus"><i class="fas fa-plus"></i></button>';
}

add_action('woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus');
function bbloomer_display_quantity_minus()
{
	echo '<button type="button" class="minus"><i class="fas fa-minus"></i></button>';
}

// Trigger update quantity script
add_action('woocommerce_init', 'bbloomer_add_cart_quantity_plus_minus');
function bbloomer_add_cart_quantity_plus_minus()
{
	if (!function_exists('is_product') || !function_exists('wc_enqueue_js')) {
		return;
	}

	// Debugging output
	error_log('Function bbloomer_add_cart_quantity_plus_minus is running.');

	wc_enqueue_js("
     $(document).on( 'click', 'button.plus, button.minus', function() {
        var qty = $( this ).parent( '.quantity' ).find( '.qty' );
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr( 'max' ));
        var min = parseFloat(qty.attr( 'min' ));
        var step = parseFloat(qty.attr( 'step' ));

        if ( $( this ).is( '.plus' ) ) {
           if ( max && ( max <= val ) ) {
              qty.val( max ).change();
           } else {
              qty.val( val + step ).change();
           }
        } else {
           if ( min && ( min >= val ) ) {
              qty.val( min ).change();
           } else if ( val > 1 ) {
              qty.val( val - step ).change();
           }
        }
     });
  ");
}





add_action('woocommerce_after_add_to_cart_button', 'woosc_btn_single_product');

function woosc_btn_single_product()
{
	global $product, $villea_option;
	$product_id = $product->get_id();
	$wc_wishlist_icon = !empty($villea_option['wc_wishlist_icon']) ? $villea_option['wc_wishlist_icon'] : '';
	$wc_compare_icon = !empty($villea_option['wc_compare_icon']) ? $villea_option['wc_compare_icon'] : '';
?>
	<div class="product_icon_actions">
		<?php if (!empty($wc_wishlist_icon)) : ?>
			<div class="product_icon heart">
				<?php echo do_shortcode('[woosw product_id="' . $product_id . '"]'); ?>
			</div>
		<?php endif; ?>
		<?php if (!empty($wc_compare_icon)) : ?>
			<div class="product_icon compare">
				<?php echo do_shortcode('[woosc product_id="' . $product_id . '"]'); ?>
			</div>
		<?php endif; ?>
	</div>
<?php
}



// // Remove WooCommerce default thumbnails
// // remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

// // Add custom swiper output
// add_action('woocommerce_product_thumbnails', 'custom_woocommerce_thumbnail_slider', 20);
// function custom_woocommerce_thumbnail_slider()
// {
// 	get_template_part('woocommerce/single-product/custom-thumbnails-swiper');
// }


remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

add_action('woocommerce_product_thumbnails', 'custom_woocommerce_product_thumbnails_swiper', 20);
function custom_woocommerce_product_thumbnails_swiper()
{
	global $product;

	$attachment_ids = $product->get_gallery_image_ids();
	if (empty($attachment_ids)) return;

	echo '<div class="swiper swiper-thumbnail-slider">';
	echo '<div class="swiper-wrapper">';

	foreach ($attachment_ids as $attachment_id) {
		$thumbnail_url = wp_get_attachment_image_url($attachment_id, 'woocommerce_thumbnail');
		$large_url     = wp_get_attachment_image_url($attachment_id, 'woocommerce_single');
		$alt           = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

		echo '<div class="swiper-slide">';
		echo '<img class="product-thumb" src="' . esc_url($thumbnail_url) . '" data-large="' . esc_url($large_url) . '" alt="' . esc_attr($alt) . '">';
		echo '</div>';
	}

	echo '</div></div>';
}

// related products slider
function enqueue_related_products_slider_script()
{
	if (function_exists('is_product') && is_product()) {
		global $product, $villea_option;

		// Get number of columns from theme option or default to 4
		$col = !empty($villea_option['single_releted_products_col']) ? $villea_option['single_releted_products_col'] : 4;

		wp_enqueue_script('swiper'); // make sure swiper is enqueued
		wp_add_inline_script('swiper', "
			document.addEventListener('DOMContentLoaded', function() {
				if(document.querySelector('.related-swiper')) {
					new Swiper('.related-swiper', {
						slidesPerView: 1,
						spaceBetween: 30,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						breakpoints: {
							768: {
								slidesPerView: 2
							},
							1024: {
								slidesPerView: {$col}
							}
						}
					});
				}
			});
		");
	}
}
add_action('wp_enqueue_scripts', 'enqueue_related_products_slider_script');

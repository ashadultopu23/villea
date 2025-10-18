<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
do_action('woocommerce_before_main_content');

//checking shop layout form option  
$col         = '';
$shop_layout = '';
$column      = '';
$layout      = '';
$grid_active_btn   = '';
$list_active_btn   = '';


if (!empty($villea_option['shop-layout']) || !is_active_sidebar('woocommerce')) {

    $shop_layout = !empty($villea_option['shop-layout']) ? $villea_option['shop-layout'] : '';
    $shop_layout_style = !empty($villea_option['shop_layout_style']) ? $villea_option['shop_layout_style'] : 'grid';
    $shop_sidebar_icon_position = !empty($villea_option['shop_sidebar_icon_position']) ? $villea_option['shop_sidebar_icon_position'] : 'left';
    $shop_sidebar_layout_style = !empty($villea_option['shop_sidebar_layout_style']) ? $villea_option['shop_sidebar_layout_style'] : '';
    $sidebar_icon_type = !empty($villea_option['sidebar_icon_type']) ? $villea_option['sidebar_icon_type'] : '';

    if ($shop_layout_style == 'grid') {

        $grid_type       = 'grid';
        $list_type       = '';
        $grid_active_btn = 'active';
        $list_active_btn = '';
        $grid_active_content = 'active show';
        $list_active_content = '';
    } else {
        $grid_type       = '';
        $list_type       = 'list';
        $grid_active_btn = '';
        $list_active_btn = 'active';
        $grid_active_content = '';
        $list_active_content = 'active show';
    }

    if ($shop_layout == 'full') {
        $layout = 'full-layout';
        $col    = '-12';
        $column = 'sidebar-none';
    } elseif ($shop_layout == 'left-col') {
        $layout = 'full-layout-left';
        $col    = '-8';
    } elseif ($shop_layout == 'right-col') {
        $layout = 'full-layout-right';
        $col    = '-8';
    } else {
        $col = '-12';
        $shop_layout = '';
    }
} else {
    $col         = '';
    $shop_layout = '';
    $layout      = '';
    $grid_active_btn = 'active';
    $shop_layout_style   = 'grid';
    $grid_active_content = 'active show';
    $list_active_content = '';
}

// Get subcategories
$args = [
    'taxonomy'   => 'product_cat',
    'parent'     => get_queried_object_id(),
    'hide_empty' => false,
];
$categories = get_terms($args);

?>

<?php
// Display main category name, description, and image
$main_category = get_queried_object();
if ($main_category && !is_wp_error($main_category)) {
    $thumbnail_id = get_term_meta($main_category->term_id, 'thumbnail_id', true);
    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
    $placeholder_url = wc_placeholder_img_src(); // WooCommerce placeholder image
?>
    <div class="main-category-info mb-4 d-flex align-items-center gap-3">
        <img src="<?php echo esc_url($image_url ? $image_url : $placeholder_url); ?>" alt="<?php echo esc_attr($main_category->name); ?>" class="main-category-image">
        <div>
            <h4 class="main-category-title mb-1"><?php echo esc_html($main_category->name); ?></h4>
            <?php if ($main_category->description): ?>
                <div class="main-category-description"><?php echo wp_kses_post($main_category->description); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php
}
// Show categories only if setting is 'both' or 'subcategories'
$shop_display = get_option('woocommerce_shop_page_display');

if (in_array($shop_display, ['both', 'subcategories']) && !empty($categories)) :
?>
    <div class="row g-2 mb-5">
        <?php
        foreach ($categories as $category) {
            wc_get_template('content-product-cat-list.php', ['category' => $category]);
        }
        ?>
    </div>
<?php endif; ?>

<div class="row layout-<?php echo esc_attr($layout) ?> shop-layout-style-<?php echo esc_attr($shop_layout_style); ?> sidebar_<?php echo esc_attr($shop_sidebar_layout_style); ?>">
    <div class="contents-sticky col-lg<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>">
        <!-- new add tab style start -->
        <?php
        /**
         * Hook: woocommerce_shop_loop_header.
         *
         * @since 8.6.0
         *
         * @hooked woocommerce_product_taxonomy_archive_header - 10
         */

        do_action('woocommerce_shop_loop_header');

        if (woocommerce_product_loop()) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */

            // do_action('woocommerce_before_shop_loop');

            woocommerce_output_all_notices();
        ?>


            <div class="tp_shop_top_portion p-sm-3 mb-4 shop_topbar_position_<?php echo esc_attr($shop_sidebar_icon_position); ?>">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="tp_shop_top_portion_bar d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="bar_area d-flex align-items-center gap-3">
                                <?php if (in_array($shop_sidebar_layout_style ?? '', ['flyout', 'modern']) && in_array($shop_layout, ['right-col', 'left-col'])) : ?>
                                    <button class="sidebar_link border-0 p-0 lh-1">
                                        <?php
                                        if ($sidebar_icon_type === 'image' && !empty($villea_option['icon_image_upload']['url'])) {
                                            echo '<img src="' . esc_url($villea_option['icon_image_upload']['url']) . '" alt="Icon" class="sidebar-icon-image" />';
                                        } elseif ($sidebar_icon_type === 'font' && !empty($villea_option['fontawesome_icon_class'])) {
                                            echo '<i class="' . esc_attr($villea_option['fontawesome_icon_class']) . '" ></i>';
                                        } else { ?>
                                            <svg class="icon icon-filter" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.091 21.25V15.9295H11.3475V17.9668H19.75V19.223H11.3475V21.25H10.091ZM2.25 19.223V17.9668H7.8345V19.223H2.25ZM6.57825 15.155V13.1283H2.25V11.8717H6.57825V9.8245H7.8345V15.155H6.57825ZM10.091 13.1283V11.8717H19.75V13.1283H10.091ZM14.1655 9.064V3.75H15.4218V5.777H19.75V7.03325H15.4218V9.064H14.1655ZM2.25 7.03325V5.777H11.909V7.03325H2.25Z" fill="currentColor"></path>
                                            </svg>
                                        <?php } ?>
                                    </button>

                                <?php endif; ?>
                                <?php woocommerce_result_count(); ?>
                            </div>
                            <div class="layout_area d-flex align-center gap-3">
                                <?php woocommerce_catalog_ordering(); ?>
                                <div class="nav nav-tabs gap-2 gap-sm-3 flex-nowrap align-items-center layout " id="productTab" role="tablist">
                                    <button class="nav-link border-0 p-0 lh-1 <?php echo esc_attr($grid_active_btn); ?>" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid-tab-pane" type="button" role="tab" aria-controls="grid-tab-pane" aria-selected="true">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <button class="nav-link border-0 p-0 lh-1 <?php echo esc_attr($list_active_btn); ?>" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="true">
                                        <svg width="14" height="14" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 7.11108H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 1H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 13.2222H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tp-shop-items-wrapper tp-shop-item-primary">
                <div class="tab-content" id="productTabContent">
                    <!-- Grid View Tab -->
                    <div class="tab-pane fade <?php echo esc_attr($grid_active_content); ?>" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab" tabindex="0">
                        <?php
                        woocommerce_product_loop_start();

                        // Display product in grid view
                        if (wc_get_loop_prop('total')) {
                            while (have_posts()) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product-grid');
                            }
                        }

                        woocommerce_product_loop_end(); ?>
                    </div>

                    <!-- List View Tab -->
                    <div class="tab-pane fade <?php echo esc_attr($list_active_content); ?>" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
                        <?php
                        woocommerce_product_loop_start();

                        // Display product in list view
                        if (wc_get_loop_prop('total')) {
                            while (have_posts()) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product-list');
                            }
                        }

                        woocommerce_product_loop_end(); ?>
                    </div>
                <?php
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
            }
                ?>
                </div>
            </div>
    </div>
    <?php if ($layout != 'full-layout'):
        get_sidebar();
    endif;

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');

    /**
     * Hook: woocommerce_sidebar.
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    // do_action('woocommerce_sidebar');



    get_footer('shop');
    ?>
</div>
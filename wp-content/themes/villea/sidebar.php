<div class="col-lg-4 post_sidebar">
    <aside id="secondary" class="widget-area">
        <?php
        if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_product())) {

            global $villea_option;
            $shop_sidebar_layout_style = !empty($villea_option['shop_sidebar_layout_style']) ? $villea_option['shop_sidebar_layout_style'] : '';

            // Show filter title only if layout style is 'flyout'
            if ($shop_sidebar_layout_style === 'flyout'): ?>
                <div class="filter_title mb-4 d-flex gap-4 align-items-center justify-content-between">
                    <h4 class="title_bar m-0"><?php echo esc_html__("Filter", "villea"); ?></h4>
                    <button class="cross_bar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
        <?php
            endif;
        }
        ?>


        <div class="themephi-sideabr dynamic-sidebar">
            <?php
            if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_product())) {
                // WooCommerce Sidebar
                if (! is_active_sidebar('woocommerce')) {
                    echo '<div class="alert alert-warning">Please add widgets to the <strong>WooCommerce Sidebar</strong>.</div>';
                } else {
                    dynamic_sidebar('woocommerce');
                }
            } elseif (is_singular('portfolios') || is_post_type_archive('portfolios') || is_tax('portfolio-category')) {
                // Portfolio Sidebar
                if (! is_active_sidebar('sidebar-portfolio')) {
                    echo '<div class="alert alert-warning">Please add widgets to the <strong>Portfolio Sidebar</strong>.</div>';
                } else {
                    dynamic_sidebar('sidebar-portfolio');
                }
            } elseif (is_singular('services') || is_post_type_archive('services') || is_tax('service-category')) {
                // Services Sidebar
                if (! is_active_sidebar('sidebar-service')) {
                    echo '<div class="alert alert-warning">Please add widgets to the <strong>Service Sidebar</strong>.</div>';
                } else {
                    dynamic_sidebar('sidebar-service');
                }
            } elseif (is_singular('market-analysis') || is_post_type_archive('market-analysis') || is_tax('market-analysis-category')) {
                // Market Analysis Sidebar
                if (! is_active_sidebar('sidebar-market-analysis')) {
                    echo '<div class="alert alert-warning">Please add widgets to the <strong>Service Sidebar</strong>.</div>';
                } else {
                    dynamic_sidebar('sidebar-market-analysis');
                }
            } else {
                // Default Blog Sidebar
                if (! is_active_sidebar('sidebar-1')) {
                    echo '<div class="alert alert-warning">Please add widgets to the <strong>Default Sidebar</strong>.</div>';
                } else {
                    dynamic_sidebar('sidebar-1');
                }
            }

            ?>
        </div>
    </aside>
    <!-- #secondary -->
</div>
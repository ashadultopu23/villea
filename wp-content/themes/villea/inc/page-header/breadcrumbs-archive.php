<?php
global $villea_option;
$post_id = get_the_ID();

$header_width_meta = get_post_meta($post_id, 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

// Banner and background logic
$banner_hide = get_post_meta($post_id, 'banner_hide', true);
$banner_image = get_post_meta($post_id, 'banner_image', true);
$bg_color = !empty($villea_option['breadcrumb_bg_color']) ? $villea_option['breadcrumb_bg_color'] : '';
$default_banner = !empty($villea_option['page_banner_main']['url']) ? $villea_option['page_banner_main']['url'] : '';

$banner_img = ($banner_hide === 'show' || $banner_hide === '') ? ($banner_image ?: $default_banner) : '';
$bg_style = $banner_img ? 'background:' . esc_attr($bg_color) : ($banner_hide === 'show' || $banner_hide === '' ? 'background:' . esc_attr($bg_color) : '');

$post_menu_type = get_post_meta($post_id, 'menu-type', true);
$content_banner = get_post_meta($post_id, 'content_banner', true);
$intro_content_banner = get_post_meta($post_id, 'intro_content_banner', true);
$post_meta_title = get_post_meta($post_id, 'select-title', true);
$show_title = ($post_meta_title != 'hide');
$post_meta_bread = get_post_meta($post_id, 'select-bread', true);
$show_breadcrumb = (!empty($villea_option['off_breadcrumb']) && $post_meta_bread != 'hide');

$page_title = '';

if (is_home() || is_front_page()) {
    // Blog page or homepage
    $page_title = get_the_title(get_option('page_for_posts'));
} elseif (is_singular('page')) {
    // Single page
    $page_title = get_the_title();
} elseif (is_singular('post')) {
    // Single post
    $page_title = get_the_title();
} elseif (is_archive()) {
    // Regular archives (category, tag, author, date)
    $page_title = strip_tags(get_the_archive_title());
} elseif (is_search()) {
    // Search results page
    $page_title = sprintf(__('Search Results for: %s', 'villea'), get_search_query());
} elseif (is_404()) {
    // 404 page
    $page_title = __('Page Not Found', 'villea');
} else {
    // Fallback
    $page_title = get_the_title();
}

// Use custom banner content if provided
$page_title = $content_banner ?: $page_title;

?>

<?php if ($banner_img || $bg_style): ?>
    <div class="themephi-breadcrumbs archive-breadcrumbs with-bg">
        <div class="breadcrumbs-single" style="<?php echo esc_attr($bg_style); ?>">
            <?php if ($banner_img): ?>
                <img src="<?php echo esc_url($banner_img); ?>" alt="<?php esc_attr_e('breadcrumb image', 'villea'); ?>">
            <?php endif; ?>
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                    <div class="row gap-2">
                        <div class="col-12">
                            <?php if ($show_title): ?>
                                <?php if (!empty($intro_content_banner)): ?>
                                    <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                <?php endif; ?>
                                <h1 class="page-title"><?php echo esc_html($page_title); ?></h1>
                            <?php endif; ?>
                        </div>
                        <?php if ($show_breadcrumb): ?>
                            <div class="col-12">
                                <?php if (function_exists('bcn_display')): ?>
                                    <div class="breadcrumbs-title"><?php bcn_display(); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($post_meta_bread == 'show' || $post_meta_bread == ''): ?>
    <div class="themephi-breadcrumbs archive-breadcrumbs no-bg">
        <div class="themephi-breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                    <div class="row">
                        <div class="col-12">
                            <?php if ($show_title): ?>
                                <?php if (!empty($intro_content_banner)): ?>
                                    <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                <?php endif; ?>
                                <h1 class="page-title"><?php echo esc_html($page_title); ?></h1>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
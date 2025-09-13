<?php
global $villea_option;

$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

$post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
//theme option chekcing
if ($post_meta_data == '') {
    if (!empty($villea_option['course_banner_main']['url'])):
        $post_meta_data = $villea_option['course_banner_main']['url'];
    endif;
}
$banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);
if ('show' == $banner_hide ||  $banner_hide == '') {
    $post_meta_data = $post_meta_data;
} else {
    $post_meta_data = '';
}
$post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
$content_banner = get_post_meta(get_the_ID(), 'content_banner', true);

if (!empty($villea_option['show_banner__course'])):
    $post_meta_data = $villea_option['show_banner__course'];
endif;


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


<?php if ($post_meta_data != '') {
    $course_banner_bg_color = !empty($villea_option['course_banner_bg_color']) ? $villea_option['course_banner_bg_color'] : '';
    $breadcrumb_bg_color = !empty($villea_option['breadcrumb_bg_color']) ? $villea_option['breadcrumb_bg_color'] : '';

    $post_meta_data2 = !empty($course_banner_bg_color) ? $course_banner_bg_color : $breadcrumb_bg_color;
?>

    <div class="themephi-breadcrumbs market-analysis-breadcrumbs with-bg">
        <div class="breadcrumbs-single" style="background: <?php echo esc_attr($post_meta_data2); ?>">
            <img src="<?php echo esc_url($post_meta_data); ?>" alt="<?php echo esc_attr__('breadcrumb image', 'villea'); ?>">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                    <div class="row gap-2">

                        <div class="col-12">
                            <?php $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                            <?php if ($post_meta_title != 'hide') {
                                if (!empty($intro_content_banner)): ?>
                                    <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                <?php endif; ?>

                                <h1 class="page-title">
                                    <?php echo esc_html($page_title); ?>
                                </h1>
                            <?php }
                            ?>
                        </div>
                        <div class="col-12">
                            <?php if (!empty($villea_option['off_breadcrumb'])) {
                                $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                                if ($rs_breadcrumbs != 'hide'):
                                    if (function_exists('bcn_display')) { ?>
                                        <div class="breadcrumbs-title"> <?php bcn_display(); ?></div>
                            <?php }
                                endif;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($post_meta_data2 != '') { ?>
    <div class="themephi-breadcrumbs market-analysis-breadcrumbs no-bg">
        <div class="breadcrumbs-single" style="background:<?php echo esc_attr($post_meta_data2); ?>">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                    <div class="row">
                        <div class="col-12">
                            <?php $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                            <?php if ($post_meta_title != 'hide') {
                                if (!empty($intro_content_banner)): ?>
                                    <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                <?php endif; ?>

                                <h1 class="page-title">
                                    <?php echo esc_html($page_title); ?>
                                </h1>
                            <?php }
                            ?>
                        </div>
                        <div class="col-12">
                            <?php if (!empty($villea_option['off_breadcrumb'])) {
                                $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                                if ($rs_breadcrumbs != 'hide'):
                                    if (function_exists('bcn_display')) { ?>
                                        <div class="breadcrumbs-title"> <?php bcn_display(); ?></div>
                            <?php }
                                endif;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

} else {
    $post_meta_bread = get_post_meta(get_the_ID(), 'select-bread', true); ?>
    <?php if ($post_meta_bread == 'show' || $post_meta_bread == '') { ?>
        <div class="themephi-breadcrumbs market-analysis-breadcrumbs">
            <div class="themephi-breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                <div class="<?php echo esc_attr($header_width); ?>">
                    <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                        <div class="row">

                            <div class="col-12">
                                <?php

                                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                                <?php if ($post_meta_title != 'hide') {
                                    if (!empty($intro_content_banner)): ?>
                                        <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                    <?php endif; ?>
                                    <h1 class="page-title">
                                        <?php echo esc_html($page_title); ?>
                                    </h1>
                                <?php }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

?>
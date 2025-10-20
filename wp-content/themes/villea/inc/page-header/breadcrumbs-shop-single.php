<?php
global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);

$shop_single_container_class = (!empty($villea_option['shop_single_container_class'])) ? $villea_option['shop_single_container_class'] : '';
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($shop_single_container_class)) {
    $header_width = ($shop_single_container_class == 'fluid') ? 'container-fluid' : 'container';
} elseif (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

?>


<?php
$post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
$post_meta_data2 = '';
//theme option chekcing
if ($post_meta_data == '') {
    if (!empty($villea_option['shop_banner_single']['url'])):
        $post_meta_data = $villea_option['shop_banner_single']['url'];
    elseif (!empty($villea_option['shop_banner_main']['url'])):
        $post_meta_data = $villea_option['shop_banner_main']['url'];
    elseif (!empty($villea_option['page_banner_main']['url'])):
        $post_meta_data = $villea_option['page_banner_main']['url'];

    else: {
            $post_meta_data2 = !empty($villea_option['breadcrumb_bg_color']) ? $villea_option['breadcrumb_bg_color'] : '';
        }
    endif;
}

$banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);
if ('show' == $banner_hide ||  $banner_hide == '') {
    $post_meta_data = $post_meta_data;
    $post_meta_data2 = $post_meta_data2;
} else {
    $post_meta_data = '';
    $post_meta_data2 = '';
}
$post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
$content_banner = get_post_meta(get_the_ID(), 'content_banner', true);
$intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true);
?>

<?php if ($post_meta_data != '') {
    $shop_banner_bg_color = !empty($villea_option['shop_banner_bg_color']) ? $villea_option['shop_banner_bg_color'] : '';
    $breadcrumb_bg_color = !empty($villea_option['breadcrumb_bg_color']) ? $villea_option['breadcrumb_bg_color'] : '';

    $post_meta_data2 = !empty($shop_banner_bg_color) ? $shop_banner_bg_color : $breadcrumb_bg_color;
?>

    <div class="themephi-breadcrumbs shop-single-breadcrumbs with-bg">
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
                                    <?php if ($content_banner != '') {
                                        echo esc_html($content_banner);
                                    } else {
                                        the_title();
                                    }
                                    ?>
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
    <div class="themephi-breadcrumbs shop-single-breadcrumbs no-bg">
        <div class="breadcrumbs-single" style="background: <?php echo esc_attr($post_meta_data2); ?>">
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
                                    <?php if ($content_banner != '') {
                                        echo esc_html($content_banner);
                                    } else {
                                        the_title();
                                    }
                                    ?>
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
        <div class="themephi-breadcrumbs shop-single-breadcrumbs">
            <div class="themephi-breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                <div class="<?php echo esc_attr($header_width); ?>">
                    <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                        <div class="row gap-2">

                            <div class="col-12">
                                <?php

                                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                                <?php if ($post_meta_title != 'hide') {
                                    if (!empty($intro_content_banner)): ?>
                                        <span class="sub-title"><?php echo esc_html($intro_content_banner); ?></span>
                                    <?php endif; ?>
                                    <h1 class="page-title">
                                        <?php if ($content_banner != '') {
                                            echo esc_html($content_banner);
                                        } else {
                                            the_title();
                                        }
                                        ?>
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
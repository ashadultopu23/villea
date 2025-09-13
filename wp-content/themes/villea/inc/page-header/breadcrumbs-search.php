<?php
global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

?>
<div class="themephi-breadcrumbs search-breadcrumbs">
    <?php
    global $villea_option;

    if (!empty($villea_option['page_banner_main']['url'])) { ?>
        <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($villea_option['page_banner_main']['url']); ?>')">
        <?php } elseif (!empty($villea_option['breadcrumb_bg_color'])) { ?>
            <div class="breadcrumbs-single" style="background:<?php echo esc_attr($villea_option['breadcrumb_bg_color']); ?>">
            <?php } else { ?>
                <div class="breadcrumbs-single">
                    <div class="themephi-breadcrumbs-inner">
                    <?php } ?>

                    <div class="<?php echo esc_attr($header_width); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="breadcrumbs-inner">
                                    <h1 class="page-title">
                                        <?php printf(__('Search Results for: %s', 'villea'), '<span>' . get_search_query() . '</span>'); ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (empty($villea_option['page_banner_main']['url']) && empty($villea_option['breadcrumb_bg_color'])) { ?>
                    </div><!-- .themephi-breadcrumbs-inner -->
                <?php } ?>
                </div><!-- .breadcrumbs-single -->
            </div><!-- .themephi-breadcrumbs -->
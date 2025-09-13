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
$post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
$content_banner = get_post_meta(get_the_ID(), 'content_banner', true);
$intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true);
?>
<div class="themephi-breadcrumbs team-breadcrumbs">
    <?php if ($post_meta_data != '') { ?>
        <div class="breadcrumbs-single" style="background:<?php echo esc_attr($villea_option['breadcrumb_bg_color']); ?>">
            <img src="<?php echo esc_url($post_meta_data); ?>" alt="<?php echo esc_attr__('breadcrumb image', 'villea'); ?>">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="row">

                    <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                        <div class="row gap-2">
                            <div class="col-12">

                                <?php
                                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                                <?php if ($post_meta_title != 'hide') {
                                ?>
                                    <?php if (!empty($villea_option['team_page_subtitle'])) : ?>
                                        <span class="sub-title"><?php echo esc_html($villea_option['team_page_subtitle']); ?></span>
                                    <?php endif; ?>
                                    <h1 class="page-title">
                                        <?php if (!empty($villea_option['team_page_title'])) {
                                            echo esc_html($villea_option['team_page_title']);
                                        } else {
                                            echo esc_html('Team Details', 'villea');
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
    <?php } elseif (!empty($villea_option['team_single_image']['url'])) { ?>
        <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($villea_option['team_single_image']['url']); ?>')">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                    <div class="row gap-2">

                        <div class="col-12">

                            <?php
                            $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                            <?php if ($post_meta_title != 'hide') {
                            ?>
                                <?php if (!empty($villea_option['team_page_subtitle'])) : ?>
                                    <span class="sub-title"><?php echo esc_html($villea_option['team_page_subtitle']); ?></span>
                                <?php endif; ?>
                                <h1 class="page-title">
                                    <?php if (!empty($villea_option['team_page_title'])) {
                                        echo esc_html($villea_option['team_page_title']);
                                    } else {
                                        echo esc_html('Team Details', 'villea');
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

    <?php } else { ?>
        <div class="breadcrumbs-single" style="background:<?php echo esc_attr($villea_option['breadcrumb_bg_color']); ?>">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">

                            <?php
                            $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                            <?php if ($post_meta_title != 'hide') {
                            ?>
                                <h1 class="page-title">
                                    <?php if ($content_banner != '') {
                                        echo esc_html($content_banner);
                                    } else {
                                        echo esc_html('Team Details', 'villea');
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
    <?php } ?>
</div>
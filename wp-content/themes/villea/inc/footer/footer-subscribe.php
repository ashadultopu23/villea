<?php

global $villea_option;
require get_parent_theme_file_path('inc/footer/footer-options.php');

$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

if ($hide_footer_subscribe != 'yes') {
    if (!empty($villea_option['call_tilte']) || !empty($villea_option['call_des'])) { ?>


        <?php
        $call_to_bg_show = !empty($villea_option['call_to_bg']['url']) ? 'style="background:url(' . $villea_option['call_to_bg']['url'] . ')"' : '';
        $icon_width        = !empty($villea_option['icons_to_d_size']) ? 'style = "max-width: ' . $villea_option['icons_to_d_size'] . '"' : '';

        $news_title_icon   =  get_post_meta(get_queried_object_id(), 'newsletter_title_icon_img', true);
        ?>


        <?php if (is_active_sidebar('footer_top')) { ?>
            <div class="themephi-newsletter themephi-newsletters">
                <div class="<?php echo esc_attr($header_width); ?>">
                    <?php if (!empty($newsletter_bg_img)): ?>
                        <div class="newsletter-wrap" style="background-image: url('<?php echo esc_url($newsletter_bg_img); ?>');">
                        <?php else: ?>
                            <div class="newsletter-wrap" <?php echo wp_kses($call_to_bg_show, 'villea'); ?>>
                            <?php endif; ?>
                            <div class="row y-middle">
                                <div class="col-lg-6">
                                    <div class="sec-title">

                                        <?php if (!empty($villea_option['call_tilte'])) { ?>
                                            <div class="title-icon">
                                                <?php if ($news_title_icon != '') { ?>

                                                    <img <?php echo wp_kses($icon_width, 'villea'); ?> src="<?php echo esc_url($news_title_icon); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">

                                                    <?php } else {
                                                    if (!empty($villea_option['icons_to_d']['url'])) { ?>
                                                        <img <?php echo wp_kses($icon_width, 'villea'); ?> src="<?php echo esc_url($villea_option['icons_to_d']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                                <?php }
                                                } ?>

                                                <h2 class="title" style="color:<?php echo wp_kses($villea_option['call_tilte_color'], 'villea'); ?>"><?php echo wp_kses($villea_option['call_tilte'], 'villea'); ?></h2>
                                            </div>
                                        <?php } ?>

                                        <?php if (!empty($villea_option['call_des'])) { ?>
                                            <div class="sub-title" style="color:<?php echo wp_kses($villea_option['call_des_color'], 'villea'); ?>"><?php echo wp_kses($villea_option['call_des'], 'villea'); ?></div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <?php if (is_active_sidebar('footer_top')):
                                        dynamic_sidebar('footer_top');
                                    endif; ?>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
    <?php }
    }
} ?>
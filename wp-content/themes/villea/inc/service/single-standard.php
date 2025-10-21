<?php

/**
 *  Service Single Standard Template
 *  
 * @package Villea
 * @since 1.0.0
 * 
 */

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';


//checking page layout
$page_layout = get_post_meta($post->ID, 'layout', true);
$page_sidebar = get_post_meta($post->ID, 'custom_sidebar', true);
$col_side = '';
$col_left = '';
if ($page_layout == '2left') {
    $col_side = '8';
    $col_left = 'left-sidebar';
} else if ($page_layout == '2right') {
    $col_side = '8';
    $col_left = 'right-sidebar';
} else {
    $col_side = '12';
}

if (
    class_exists('\Elementor\Plugin') &&
    is_a(\Elementor\Plugin::$instance, '\Elementor\Plugin') &&
    \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor()
) {

    $document = \Elementor\Plugin::$instance->documents->get($post->ID);
    $settings = $document->get_settings('general');

    if (!empty($settings['layout']) && $settings['layout'] === 'elementor_full_width') {
        $header_width = 'container-fluid custom-container';
    } else {
        $header_width = 'container';
    }
} else {
    if (!empty($container_class)) {
        $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
    } else {
        $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
    }
}

?>

<!--service details-->
<div class="themephi-blog-details service-details">
    <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row padding-<?php echo esc_attr($col_left) ?>">
            <?php
            if (($page_layout == '2left')):
                get_sidebar('single');
            endif;
            ?>
            <div class="col-lg-<?php echo esc_attr($col_side); ?> <?php echo esc_attr($col_left); ?> ">
                <div class="blog-post-details-inner service-post-details-inner mb-40">
                    <?php while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="bs-img mb-40">
                                    <?php the_post_thumbnail() ?>
                                </div>
                            <?php } ?>
                            <div class="content-area">
                                <?php
                                the_content();
                                ?>
                            </div>

                            <div class="clear-fix"></div>
                        </article>

                    <?php endwhile;
                    wp_reset_query(); ?>

                    <?php
                    $next_post = get_next_post();
                    $previous_post = get_previous_post();
                    if (!empty($next_post) || !empty($previous_post)): ?>
                        <div class="service-navigation">
                            <?php
                            $url_next = is_object($next_post) ? get_permalink($next_post->ID) : '';
                            $title    = is_object($next_post) ? get_the_title($next_post->ID) : '';
                            ?>
                            <div class="row align-items-center justify-content-between tps-left-write-blog-wrapper-main">
                                <div class="col-lg-6 col-sm-6">
                                    <?php if ($next_post): ?>
                                        <div class="left-icon-area single">
                                            <div class="icon-1">
                                                <a href="<?php echo esc_url($url_next) ?>">
                                                    <i class="tp-arrow-left"></i>
                                                </a>
                                            </div>
                                            <div class="writing-content">
                                                <a href="<?php echo esc_url($url_next) ?>"><span><?php echo esc_html__('Previous', 'villea'); ?></span>
                                                    <h6 class="title"><?php echo esc_html($title); ?></h6>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php $url_previous = is_object($previous_post) ? get_permalink($previous_post->ID) : '';
                                    $title = is_object($previous_post) ? get_the_title($previous_post->ID) : ''; ?>
                                    <?php if ($previous_post): ?>
                                        <div class="right-icon-area single justify-content-end">
                                            <div class="writing-content">
                                                <a href="<?php echo esc_url($url_previous) ?>"><span><?php echo esc_html__('Next', 'villea'); ?></span>
                                                    <h6 class="title">
                                                        <?php echo esc_html($title); ?>
                                                    </h6>
                                                </a>
                                            </div>
                                            <div class="icon-1">
                                                <a href="<?php echo esc_url($url_previous) ?>"> <i class="tp-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            if (($page_layout == '2right')):
                get_sidebar('single');
            endif;
            ?>
        </div>
    </div>
</div>
<!--service details-->
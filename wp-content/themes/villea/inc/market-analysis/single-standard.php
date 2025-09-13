<?php

/**
 *  Market Analysis Single Standard Template
 * 
 * @package Villea
 * @since 1.0.0
 */

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

//checking page layout
$page_layout = get_post_meta($post->ID, 'layout', true);
$page_sidebar = get_post_meta($post->ID, 'custom_sidebar', true);
$col_side = '';
$col_letf = '';
if ($page_layout == '2left') {
    $col_side = '8';
    $col_letf = 'left-sidebar';
} else if ($page_layout == '2right') {
    $col_side = '8';
    $col_letf = 'right-sidebar';
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
<!-- Blog Detail Start -->
<div class="themephi-blog-details market-analysis-details">
    <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row padding-<?php echo esc_attr($col_letf) ?>">
            <?php
            if (($page_layout == '2left')):
                get_sidebar('single');
            endif;
            ?>
            <div class="col-lg-<?php echo esc_attr($col_side); ?> <?php echo esc_attr($col_letf); ?> ">
                <div class="blog-post-details-inner market-analysis-post-details-inner">
                    <?php
                    while (have_posts()) : the_post();
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="bs-img mb-40">
                                    <?php the_post_thumbnail() ?>
                                </div>
                            <?php } ?>

                            <?php
                            get_template_part('template-parts/post/content', get_post_format());
                            ?>
                            <div class="clear-fix"></div>
                        </article>

                    <?php
                        if (!empty($villea_option['analysis-comments']) && $villea_option['analysis-comments'] == 'show') :
                            $blog_author = '';
                            if ($blog_author == "") {
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                            } else {
                                $blog_author = $villea_option['analysis-comments'];
                                if ($blog_author == 'show') {
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if (comments_open() || get_comments_number()) :
                                        comments_template();
                                    endif;
                                }
                            }
                        endif;
                    endwhile; // End of the loop.
                    ?>
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
<!-- Blog Detail End -->
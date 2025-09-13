<?php

/**
 * Template part for displaying posts
 * user info (author, date, categories, tags)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package villea
 */

global $villea_option;

?>

<div class="user-info d-flex align-items-center column-gap-3 row-gap-1 flex-wrap">
    <!-- single info -->
    <div class="single-info">
        <i class="tp tp-circle-user-regular"></i>
        <span><?php echo esc_html__('by', 'villea'); ?>
            <?php if (!empty($villea_option['blog-author-post'])) {
                if ($villea_option['blog-author-post'] == 'show'): ?>

                    <?php
                    if (!empty($first_name) && !empty($last_name)) {
                        echo esc_html($first_name) . ' ' . esc_html($last_name);
                    } else {
                        echo get_the_author();
                    }  ?>

                <?php endif;
            } else { ?>


                <?php

                if (!empty($first_name) && !empty($last_name)) {
                    echo esc_html($first_name) . ' ' . esc_html($last_name);
                } else {
                    echo get_the_author();
                } ?>

            <?php }; ?>
        </span>
    </div>
    <!-- single info end -->

    <!-- single info -->
    <div class="single-info">
        <i class="tp tp-clock-regular"></i>
        <span><?php echo get_the_date(); ?></span>
    </div>
    <!-- single info end -->

    <!-- single info -->
    <div class="single-info cat">
        <i class="tp tp-tags"></i>
        <span>
            <?php
            $post_type = get_post_type(get_the_ID());

            if ($post_type === 'post') {
                // Default blog post => show WordPress categories
                if (!empty($villea_option['blog-category']) && $villea_option['blog-category'] == 'show') {
                    the_category(', ');
                } else {
                    the_category(', ');
                }
            } else {
                // For other post types => get their first taxonomy
                $taxonomies = get_object_taxonomies($post_type, 'objects');
                if (!empty($taxonomies)) {
                    foreach ($taxonomies as $taxonomy) {
                        if ($taxonomy->hierarchical) { // like categories
                            $terms = get_the_terms(get_the_ID(), $taxonomy->name);
                            if (!empty($terms) && !is_wp_error($terms)) {
                                $term_links = array();
                                foreach ($terms as $term) {
                                    $term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                }
                                echo implode(', ', $term_links);
                            }
                            break; // show only first hierarchical taxonomy
                        }
                    }
                }
            }
            ?>
        </span>
    </div>
    <!-- single info end -->
</div>
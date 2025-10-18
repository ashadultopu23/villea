<div class="grid-item col-xxl-<?php echo esc_attr($col_xxl); ?> col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-<?php echo esc_attr($col_xs); ?> <?php echo esc_attr($termsString); ?>">
    <div class="blog-item themephi-blog-grid4">

        <?php if ($settings['blog_image'] == 'yes') : ?>
            <div class="image-part <?php echo $settings['image_gray']; ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="blog-content">


            <?php if (($settings['blog_meta_show_hide'] == 'yes')) { ?>

                <ul class="blog-meta">
                    <?php if (($settings['blog_cat_show_hide'] == 'yes') && ! empty($category) && ! is_wp_error($category)) { ?>
                        <li>
                            <a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>" class="meta_category"><?php echo esc_html($category[0]->cat_name); ?></a>
                        </li>
                    <?php } ?>
                    <?php if (($settings['blog_date_show_hide'] == 'yes')) { ?>
                        <li><span class="meta_date"><i class="tp tp-calendar-days"></i> <?php echo esc_html($full_date); ?></span></li>
                    <?php } ?>
                    <?php if (($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount)) { ?>
                        <li><span class="meta_comments"><i class="tp tp-message"></i> <?php echo esc_html($comment_ccount)  . esc_html__(' Comments', 'tp-elements'); ?></span></li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <<?php echo $settings['title_tag'] ?> class="title dd <?php echo !empty($settings['title_line_clamp']) ? esc_attr($settings['title_line_clamp']) : ''; ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </<?php echo $settings['title_tag'] ?>>

            <?php if ($settings['blog_content_show_hide'] == 'yes') { ?>
                <p class="blog-excerpt txt <?php echo !empty($settings['description_line_clamp']) ? esc_attr($settings['description_line_clamp']) : ''; ?>">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php } ?>

            <div class="d-flex align-items-center justify-content-between">
                <?php if (($settings['blog_meta_show_hide'] == 'yes')) { ?>
                    <?php if (($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin)) { ?>
                        <span class="meta_author">
                            <span class="author-avatar">
                                <?php echo $post_admin_avatar; ?>
                            </span>
                            <?php echo esc_html($post_admin); ?></span>
                    <?php } ?>
                <?php } ?>

                <?php if ($settings['blog_readmore_show_hide'] == 'yes' && $settings['blog_btn_text'] || $settings['blog_btn_icon']) : ?>
                    <div class="btn-part">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($settings['blog_btn_icon'] && $settings['blog_btn_icon_position'] == 'left') : ?>
                                <span class="icon <?php echo esc_attr($settings['blog_btn_icon_position']); ?>">
                                    <i class="<?php echo esc_attr($settings['blog_btn_icon']); ?>"></i>
                                </span>
                            <?php endif; ?>
                            <?php echo $settings['blog_btn_text']; ?>

                            <?php if ($settings['blog_btn_icon'] && $settings['blog_btn_icon_position'] == 'right') : ?>
                                <span class="icon <?php echo esc_attr($settings['blog_btn_icon_position']); ?>">
                                    <i class="<?php echo esc_attr($settings['blog_btn_icon']); ?>"></i>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>
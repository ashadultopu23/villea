    <?php
    var_dump($settings['gallery_style']);
    ?>

    <!-- Gallery style 2 -->
    <div class="rs-galleys elementor-image-gallery">
        <?php

        if (!empty($settings['gallery_image_single']['id'])) :
            $gallery_item   = wp_get_attachment_image_url($settings['gallery_image_single']['id'], $settings['thumbnail_size']);
            $gallery_titles = get_post_field('post_title', $settings['gallery_image_single']['id']);
        ?>
            <div class="gallery-single-item">
                <div class="galley-img <?php echo esc_attr($settings['gallery_effice']); ?> <?php echo esc_attr($settings['gallery_style']); ?>">
                    <a class="image-popup zoom-icon" href="<?php echo esc_url(wp_get_attachment_image_url($settings['gallery_image_single']['id'], 'full')); ?>">
                        <i class="<?php echo esc_attr($settings['selected_icon']); ?>"></i>
                    </a>
                    <a class="img-wrap" href="<?php echo esc_url(wp_get_attachment_image_url($settings['gallery_image_single']['id'], 'full')); ?>" title="<?php echo esc_attr($gallery_titles); ?>">
                        <img src="<?php echo esc_url($gallery_item); ?>" alt="<?php echo esc_attr($gallery_titles); ?>" class="w-100">
                    </a>
                    <?php if (!empty($gallery_titles) && ($settings['gallery_cation_style'] == 'show')) : ?>
                        <h5 class="gallery-titles"><?php echo esc_html($gallery_titles); ?></h5>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <!-- Fallback when no image is selected -->
            <p><?php echo esc_html__('Please select an image from the widget settings.', 'tp-elements'); ?></p>
        <?php endif; ?>
    </div>
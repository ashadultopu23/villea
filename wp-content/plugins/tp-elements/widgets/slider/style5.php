<div class="swiper-slide tp-slide-item">
    <div class="single--item">

        <div class="user-info-wrapper">
            <?php if (!empty($settings['show_user_img'] && $settings['show_user_img'] == 'yes')) : ?>
                <div class="banner-image">
                    <img class="banner-img" src="<?php echo esc_url($image); ?>" alt="image">
                </div>
            <?php endif; ?>

            <div class="user-info-content">
                <?php if (!empty($title)): ?>
                    <h5 class="slider-title tp-el-title"><?php echo wp_kses_post($title); ?></h5>
                <?php endif; ?>
                <?php if (!empty($sub_title)): ?>
                    <p class="slider-subtitle tp-el-subtitle mb-0"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="review-body">
            <?php if (!empty($top_title)): ?>
                <p class="slider-title tp-el-top-title"><?php echo wp_kses_post($top_title); ?></p>
            <?php endif; ?>
            <div class="desc">
                <?php echo wp_kses_post($description); ?>
            </div>
        </div>

        <div class="review-footer">

            <div class="review-footer-content">
                <?php if ($settings['show_rating'] == 'yes') : ?>
                    <ul class="d-flex gap-2 tp-el-star">
                        <?php
                        if (is_numeric($tp_rating)) {
                            $filled_stars = floor($tp_rating);
                            $half_star = $tp_rating - $filled_stars;

                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $filled_stars) {
                                    echo '<li class="rating"><i class="fa fa-star"></i></li>';
                                } elseif ($i == ($filled_stars + 1) && $half_star > 0) {
                                    echo '<li class="rating"><i class="fa fa-star-half"></i></li>';
                                } else {
                                    echo '<li class="rating"><i class="fa fa-star-o"></i></li>';
                                }
                            }
                        } else {
                            for ($i = 1; $i <= 5; $i++) {
                                echo '<li class="rating"><i class="fa fa-star-o"></i></li>';
                            }
                        }
                        ?>
                    </ul>
                <?php endif; ?>

                <div class="">
                    <?php if (!empty($user_name)): ?>
                        <p class="slider-user-name tp-el-user-name mb-0"><?php echo wp_kses_post($user_name); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($post_date)): ?>
                        <p class="slider-post-date tp-el-post-date mb-0"><?php echo wp_kses_post($post_date); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($settings['show_quote_icon']) && $settings['show_quote_icon'] == 'yes'): ?>
                <div class="quote-icon">
                    <?php if (!empty($sub_img_link)): ?>
                        <img class="quote" src="<?php echo esc_attr($sub_img_link); ?>" alt="Icon">
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>
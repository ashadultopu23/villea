<!-- <div class="swiper-slide tp-slide-item"> 
    <div class="slider-content-area">
    <?php if (!empty($description)): ?>
                <div class="slider-description"><?php echo wp_kses_post($description); ?></div>
            <?php endif; ?>

        <div class="bottom--area">
            <?php $img_gap = !empty($img_gap) ? 'style="margin-right:' . $img_gap . '"' : ''; ?>
            <div class="content--box">
                <?php if (!empty($title)): ?>
                    <h5 class="slider-title"><?php echo wp_kses_post($title); ?></h5>
                <?php endif; ?>
                <?php if (!empty($sub_title)): ?>
                    <p class="slider-subtitle"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif; ?>

            </div>
                       
        </div>
    </div>
</div>  -->




<div class="swiper-slide tp-slide-item">
    <div class="single--item">

        <div class="quote-icon">
            <?php if (!empty($sub_img_link)): ?>
                <img class="quote" src="<?php echo esc_attr($sub_img_link); ?>" alt="Icon">
            <?php endif; ?>
        </div>


        <div class="test-upper-portion">
            <?php if ($settings['show_rating'] == 'yes') : ?>
                <ul class="d-flex gap-2 tp-el-star <?php if ($settings['show_rating_in_first'] == 'yes') : ?> order-in-first <?php endif; ?>">

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
        </div>

        <div class="review-body">
            <div class="desc">
                <?php echo wp_kses_post($description); ?>
            </div>
        </div>

        <div class="content--box">
            <div class="banner-image">
                <img class="banner-img" src="<?php echo esc_url($image); ?>" alt="image">
            </div>
            <div class="description">
                <?php if (!empty($title)): ?>
                    <h5 class="slider-title tp-el-title"><?php echo wp_kses_post($title); ?></h5>
                <?php endif; ?>
                <?php if (!empty($sub_title)): ?>
                    <p class="slider-subtitle tp-el-subtitle mb-0"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<section class="expert-solutions">
  <div class="container">
    <div class="row g-20">

      <!-- Image Column -->
      <div class="col-lg-6">
        <div class="solution-image-container">
          <div class="img_border">
            <img src="<?php echo esc_url($settings['default_image']['url']); ?>"
              class="solution-img"
              alt="<?php echo esc_attr(get_post_meta($settings['default_image']['id'], '_wp_attachment_image_alt', true)); ?>" />
          </div>
        </div>
      </div>

      <!-- Solution Items Column -->
      <div class="col-lg-6">
        <div class="solution-items">
          <?php
          if (!empty($settings['list_repeater']) && is_array($settings['list_repeater'])) :
            $index = 1;
            foreach ($settings['list_repeater'] as $item) :
              $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
              $title = isset($item['list_title']) ? $item['list_title'] : '';
          ?>
              <!-- Solution Item -->
              <div class="solution-item" data-img="<?php echo esc_url($image_url); ?>">
                <i class="tp-arrow-up-right"></i>
                <div class="content">
                  <?php if (!empty($title)) : ?>
                    <h3 class="solution-title inactive"><?php echo wp_kses_post($title); ?></h3>
                  <?php endif; ?>
                  <h6 class="solution-index inactive"><?php echo sprintf("%02d", $index); ?></h6>
                </div>
              </div>
          <?php
              $index++;
            endforeach;
          endif;
          ?>
        </div>
      </div>

    </div>
  </div>
</section>
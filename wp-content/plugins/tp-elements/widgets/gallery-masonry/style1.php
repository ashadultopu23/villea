<!-- Gallery style 1 -->
<?php
$x = 1;
$details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'Case Details';

if (!empty($settings['rs-gallery']) && is_array($settings['rs-gallery'])):
	foreach ($settings['rs-gallery'] as $gallery_item) {
		$image_id = $gallery_item['image']['id'];
		$gallery_img = wp_get_attachment_image_url($image_id, $settings['thumbnail_size']);
		$gallery_titles = $gallery_item['title'];
		$gallery_link = !empty($gallery_item['link']['url']) ? $gallery_item['link']['url'] : '';
		$gallery_category = !empty($gallery_item['category']) ? $gallery_item['category'] : '';

		// Build filter classes
		$termsString = "";
		if (!empty($gallery_category)) {
			$sanitized_category = sanitize_title($gallery_category);
			$termsString = 'filter_' . $sanitized_category;
		}
?>

		<div class="col grid-item <?php echo esc_attr($termsString); ?>">
			<div class="masonry-gallery-item <?php echo esc_attr($row_gap); ?>">
				<div class="masonry-gallery-item-image gallery-image-overlay-gradient">
					<?php
					// Determine what type of content to show
					$show_image_content = in_array($settings['gallery_content_type'], ['without_content', 'both_content']);
					$show_text_content = in_array($settings['gallery_content_type'], ['with_content', 'both_content']);

					// Show image with appropriate link/popup
					if ($show_image_content) :
						if ($settings['gallery_popup_type'] == 'icon_with_popup') :
					?>
							<a class="popup-images" href="<?php echo esc_url($gallery_img); ?>">
								<img src="<?php echo esc_url($gallery_img); ?>" alt="<?php echo esc_attr($gallery_titles); ?>">
								<?php if (!empty($settings['gallery_icon'])) : ?>
									<span class="popup-icon">
										<?php \Elementor\Icons_Manager::render_icon($settings['gallery_icon'], ['aria-hidden' => 'true']); ?>
									</span>
								<?php endif; ?>
							</a>
						<?php elseif ($settings['gallery_popup_type'] == 'icon_with_link') : ?>
							<a href="<?php echo esc_url($gallery_link); ?>">
								<img src="<?php echo esc_url($gallery_img); ?>" alt="<?php echo esc_attr($gallery_titles); ?>">
								<?php if (!empty($settings['gallery_icon'])) : ?>
									<span class="popup-icon">
										<?php \Elementor\Icons_Manager::render_icon($settings['gallery_icon'], ['aria-hidden' => 'true']); ?>
									</span>
								<?php endif; ?>
							</a>
						<?php else : ?>
							<img src="<?php echo esc_url($gallery_img); ?>" alt="<?php echo esc_attr($gallery_titles); ?>">
						<?php endif; ?>
					<?php else : ?>
						<!-- Just show the image without any overlay/icons -->
						<img src="<?php echo esc_url($gallery_img); ?>" alt="<?php echo esc_attr($gallery_titles); ?>">
					<?php endif; ?>
				</div>

				<?php if ($show_text_content) : ?>
					<div class="masonry-gallery-item-content masonry-gallery-item-content-absolute">
						<div class="masonry-gallery-item-content-inner">
							<div class="masonry-gallery-item-content-inner-text">
								<?php if (!empty($gallery_titles)): ?>
									<h4 class="gallery-title mb-0">
										<a href="<?php echo esc_url($gallery_link); ?>">
											<?php echo esc_html($gallery_titles); ?>
										</a>
									</h4>
								<?php endif; ?>

								<?php if ($settings['gallery_cat_show_hide'] == 'yes' && !empty($gallery_category)): ?>
									<div class="gallery-cat">
										<a href="#"><?php echo esc_html($gallery_category); ?></a>
									</div>
								<?php endif; ?>
							</div>

							<?php if ($settings['gallery_btn_show_hide'] == 'yes') : ?>
								<div class="gallerys-btn-part">
									<?php
									$link_open = $settings['gallery_btn_link_open'] == 'yes' ? 'target=_blank' : '';
									$icon_position = $settings['gallery_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
									?>
									<a class="gallerys-btn <?php echo esc_attr($icon_position); ?>" href="<?php echo esc_url($gallery_link); ?>" <?php echo wp_kses_post($link_open); ?>>
										<?php if ($settings['gallery_btn_icon_position'] == 'before' && !empty($settings['gallery_btn_icon'])) : ?>
											<?php \Elementor\Icons_Manager::render_icon($settings['gallery_btn_icon'], ['aria-hidden' => 'true']); ?>
										<?php endif; ?>

										<?php if (!empty($settings['gallery_btn_text'])) : ?>
											<span class="btn_text">
												<?php echo esc_html($settings['gallery_btn_text']); ?>
											</span>
										<?php endif; ?>

										<?php if ($settings['gallery_btn_icon_position'] == 'after' && !empty($settings['gallery_btn_icon'])) : ?>
											<?php \Elementor\Icons_Manager::render_icon($settings['gallery_btn_icon'], ['aria-hidden' => 'true']); ?>
										<?php endif; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
<?php
		$x++;
	}
endif;
?>